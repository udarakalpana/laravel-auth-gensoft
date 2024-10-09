<?php

namespace App\Structure;

use Illuminate\Support\Collection;

interface AnswerExtractorInterface
{
    public function extractAnswers(array $requestData): Collection;
}
