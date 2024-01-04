<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Category;
use App\Actions\DeleteQuiz;
use LaravelViews\Views\TableView;
use LaravelViews\Facades\UI;
use LaravelViews\Views\Traits\WithAlerts;
use App\Filters\CategoryFilter;
use LaravelViews\Facades\Header;



class QuizTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected $model = Quiz::class;
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
            'Question*',
            'Answer*',
            'Category',
            Header::title('Updated')->sortBy('updated_at'),
        ];    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        $category = Category::find($model->category_id);

        return [
            $model->id,
            UI::editable($model, 'question'),
            UI::editable($model, 'answer'),
            $category->name,
            $model->updated_at,

        ];
    }

    public function update(Quiz $quiz, $data)
    {
        $quiz->updateQuiz($data);
        $this->success();
    }

    protected function actionsByRow()
    {
        return [
            new DeleteQuiz,
        ];
    }

    protected function filters()
    {
        return [
            new CategoryFilter,
        ];
    }

}
