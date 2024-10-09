<?php

namespace App\Service\Question;

use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;

class GetQuestion
{
    public static function getQuestionByQuestionId(string $questionId): Collection
    {
        return Question::findOrFail($questionId);
    }
}
