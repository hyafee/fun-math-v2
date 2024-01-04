<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Quiz;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\QuizResult;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Create a default user with the role 'user'
        DB::table('users')->insert([
            'name' => 'afif',
            'email' => 'afif@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('@afif123'),
            'role' => 'user',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Create an admin user
        DB::table('users')->insert([
            'name' => 'freya',
            'email' => 'freya@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('@freya123'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed categories
        Category::create(['name' => 'Penjumlahan']);
        Category::create(['name' => 'Pengurangan']);

        // Seed quizzes
        $categories = Category::all();

        foreach ($categories as $category) {
            $this->createQuizzes($category);
        }

        $users = \App\Models\User::factory(10)->create();

        foreach ($users as $user) {
            $this->seedQuizResults($user);
        }

        dd('Seed berhasil dijalankan!');
    }

    private function createQuizzes(Category $category)
    {
        for ($i = 1; $i <= 100; $i++) {

            $operator;

            if ($category->name === 'Penjumlahan') {
                $num1 = rand(10, 50);
                $num2 = rand(10, 50);
            } elseif ($category->name === 'Pengurangan') {
                $num1 = rand(30, 50);
                $num2 = rand(10, 20);
            }

            switch ($category->name) {
                case 'Penjumlahan':
                    $answer = $num1 + $num2;
                    $operator = '+';
                    break;
                case 'Pengurangan':
                    $answer = $num1 - $num2;
                    $operator = '-';
                    break;
                default:
                    $answer = $num1 + $num2;
            }

        // Generate random choices around $answer
        $minChoice = $answer - 2;
        $maxChoice = $answer + 2;

        $choices = [];
        for ($j = 0; $j < 4; $j++) {
            $choices[] = rand($minChoice, $maxChoice);
        }

        // Ensure there are no duplicate choices
        $choices = array_unique($choices);

        // If the number of choices is less than 4, add random choices until there are 4
        while (count($choices) < 4) {
            $choices[] = rand($minChoice, $maxChoice);
            $choices = array_unique($choices);
        }

        // Check if the correct answer is included in choices, if not, add it
        if (!in_array($answer, $choices)) {
            $index = array_rand($choices);
            $choices[$index] = $answer;
        }

        shuffle($choices); // Shuffle the choices to randomize their order

            Quiz::create([
                'question' => "$num1 $operator $num2",
                'answer' => (string)$answer,
                'choices' => json_encode($choices), // Store choices as JSON
                'category_id' => $category->id,
            ]);
        }
    }

    private function seedQuizResults(User $user)
{
    // Fetch all quizzes
    $quizzes = Quiz::all();

    // Generate random quiz results for the user
    $resultList = [];
    $score = 0;

    foreach ($quizzes as $quiz) {
        $choices = json_decode($quiz->choices, true); // Decode choices

        // Select a random user answer from the decoded choices
        $userAnswer = $choices[array_rand($choices)];
        $isCorrect = $userAnswer == $quiz->answer;

        $resultList[] = [
            'quiz_id' => $quiz->id,
            'user_answer' => $userAnswer,
        ];

        if ($isCorrect) {
            $score++;
        }
    }

    // Save the quiz results in the database
    QuizResult::create([
        'user_id' => $user->id,
        'result_list' => json_encode($resultList),
        'score' => $score,
    ]);
}


}
