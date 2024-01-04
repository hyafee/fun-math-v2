<?php

// app/Models/Quiz.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'answer', 'choices'];

    public function getQuestionAttribute()
    {
        return $this->attributes['question'];
    }

    public function updateQuiz(array $data)
    {
        return $this->update($data);
    }

    public function deleteQuiz()
    {
        return $this->delete();
    }

}
