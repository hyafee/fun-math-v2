<?php

namespace App\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;
use App\Models\QuizResult;
use LaravelViews\Views\Traits\WithAlerts;use LaravelViews\Actions\Confirmable;



class DeleteResultQuiz extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "Delete";
    use Confirmable;


    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "trash";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param Array $selectedModels Array with all the id of the selected models
     * @param $view Current view where the action was executed from
     */

     use WithAlerts;

    public function handle($selectedModels, View $view)
    {
        // Your code here
        $selectedModels->deleteResultQuiz();
        $this->success();
    }
}
