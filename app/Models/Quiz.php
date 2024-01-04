<?php

// app/Models/Quiz.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'answer', 'choices', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

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

    public function category_id($query, $categoryId)
{
    return $query->whereHas('category', function ($query) use ($categoryId) {
        $query->where('id', $categoryId);
    });
}

}
