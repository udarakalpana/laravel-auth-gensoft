<?php

namespace App\Extractor;

use Illuminate\Support\Collection;
use App\Structure\AnswerExtractorInterface;

class AnswersExtractor implements AnswerExtractorInterface
{
    public function extractAnswers(array $requestData): Collection
    {
        return collect(
            array_map(fn ($answerValue) => ['answer' => $answerValue], array_values(array_filter(
                $requestData,
                fn ($data) => str_starts_with($data, 'answer'),
                ARRAY_FILTER_USE_KEY
            )))
        );
    }
}
