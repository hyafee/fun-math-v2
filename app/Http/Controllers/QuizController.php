<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Auth;

use App\Models\Quiz;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function showQuiz()
    {
        // Fetch questions randomly from all available quizzes
        $quizzes = Quiz::inRandomOrder()->take(200)->get();

        // Pass the questions to the view
        return view('quiz', ['quizzes' => $quizzes]);
    }

    public function saveResult(Request $request)
    {
        try {
            $user = Auth::user();
            $result_list = $request->input('result_list');

            $validator = \Validator::make($request->all(), [
                'result_list' => 'required|array',
                'result_list.*.quiz_id' => 'required|exists:quizzes,id',
                'result_list.*.user_answer' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            DB::beginTransaction();

            try {
                $score = 0;

                foreach ($result_list as $result) {
                    $quiz = Quiz::find($result['quiz_id']);

                    if ($result['user_answer'] == $quiz->answer) {
                        $score++;
                    }
                }

                $existingQuizResult = QuizResult::where('user_id', $user->id)->first();

                if ($existingQuizResult) {
                    $existingQuizResult->update([
                        'result_list' => json_encode($result_list),
                        'score' => $score * 2,
                    ]);
                } else {
                    $quizResult = QuizResult::create([
                        'user_id' => $user->id,
                        'result_list' => json_encode($result_list),
                        'score' => $score * 2,
                    ]);
                }

                DB::commit();
                session()->forget(['result_list']);
                return response()->json(['id' => $quizResult->id ?? $existingQuizResult->id]);

            } catch (\Exception $e) {
                DB::rollBack();

                \Log::error('Error saving result: ' . $e->getMessage());
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        } catch (\Exception $e) {
            \Log::error('Error saving result: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function showResult($id)
    {
        $quizResult = QuizResult::findOrFail($id);

        return view('result', ['quizResult' => $quizResult]);
    }

    public function showReview($result_id)
    {
        try {
            $quizResult = QuizResult::findOrFail($result_id);
            $resultList = json_decode($quizResult->result_list, true);
            $quizIds = collect($resultList)->pluck('quiz_id')->toArray();
            $quizzes = Quiz::whereIn('id', $quizIds)->get();

            $quizData = [];

            foreach ($resultList as $result) {
                $quiz = $quizzes->find($result['quiz_id']);
                $quizData[] = [
                    'quiz_id' => $quiz->id,
                    'question' => $quiz->question, // Access the question attribute directly
                    'choices' => $quiz->choices,
                    'user_answer' => $result['user_answer'],
                    'is_correct' => $result['user_answer'] == $quiz->answer,
                    'correct_answer' => $quiz->answer,
                ];
            }

            // Pass the quiz data and result to the review view
            return view('review', [
                'quizResult' => $quizResult,
                'quizData' => $quizData,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error showing review: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getLeaderboard()
    {
        return QuizResult::getLeaderboard();
    }

    public function store(Request $request)
{
    try {
        $question = $request->input('question');
        $answer = $request->input('answer');

        // Retrieve choices from individual input fields and convert them to integers
        $choices = [
            intval($request->input('choices1')),
            intval($request->input('choices2')),
            intval($request->input('choices3')),
            intval($request->input('choices4')),
        ];

        // Validate choices to ensure they are numeric
        $choices = array_filter($choices, function ($choice) {
            return is_numeric($choice);
        });

        // Shuffle the choices to randomize their order
        shuffle($choices);

        $quiz = Quiz::create([
            'question' => $question,
            'answer' => (string)$answer,
            'choices' => json_encode($choices), // Store choices as JSON
        ]);

        return redirect()->route('admin-quiz')->with($this->success());
    } catch (\Exception $e) {
        \Log::error('Error adding quiz: ' . $e->getMessage());
        return redirect()->route('admin-quiz');
    }

}


}
