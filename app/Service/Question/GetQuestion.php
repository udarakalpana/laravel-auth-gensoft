<?php

namespace App\Service\Question;

use App\Models\Question;

class GetQuestion
{
    public static function getQuestionByQuestionId(string $questionId): Question
    {
        return Question::findOrFail($questionId);
    }
}
