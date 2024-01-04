<?php

// app/Models/QuizResult.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'result_list',
        'score',
    ];

    // Define the relationship with the User model if applicable
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getLeaderboard()
    {
        return self::select('user_id', \DB::raw('SUM(score) as total_score'))
            ->groupBy('user_id')
            ->orderByDesc('total_score')
            ->get();
    }
    public function deleteResultQuiz()
    {
        return $this->delete();
    }

    public function updateResult(array $data)
    {
        return $this->update($data);
    }
}
