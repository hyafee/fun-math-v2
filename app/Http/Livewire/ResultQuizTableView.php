<?php

namespace App\Http\Livewire;

use App\Models\QuizResult;
use App\Models\User;
use LaravelViews\Views\TableView;
use LaravelViews\Facades\UI;
use App\Actions\DeleteResultQuiz;
use LaravelViews\Views\Traits\WithAlerts;
use LaravelViews\Facades\Header;


class ResultQuizTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected $model = QuizResult::class;
    protected $paginate = 20;
    use WithAlerts;

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            'ID',
            'User Name',
            'User Email',
            Header::title('Score')->sortBy('score'),
            'Updated'
        ];    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        $user = User::find($model->user_id);

        return [
            $model->id,
            $user ? $user->name : 'N/A',
            $user ? $user->email : 'N/A',
            UI::editable($model, "score"),
            $model->updated_at,
        ];
    }
    protected function actionsByRow()
    {
        return [
            new DeleteResultQuiz,
        ];
    }

    public function update(QuizResult $quiz, $data)
    {
        $quiz->updateResult($data);
        $this->success();
    }


}
