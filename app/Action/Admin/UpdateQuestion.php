<?php

namespace App\Action\Admin;

use App\Helper\AnswersHelper;
use App\Models\Question;
use App\Structure\AnswerExtractorInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Service\Question\GetQuestion;
use Illuminate\Http\RedirectResponse;

class UpdateQuestion
{
    protected AnswerExtractorInterface $answerExtractor;

    public function __construct(AnswerExtractorInterface $answerExtractor)
    {
        $this->answerExtractor = $answerExtractor;
    }
    public function UpdateQuestion(string $questionId, array $validatedUpdateQuestionRequest): RedirectResponse
    {
        try {
            DB::transaction(function () use ($questionId, $validatedUpdateQuestionRequest) {
//                $question = GetQuestion::getQuestionByQuestionId($questionId);

                $question = Question::findOrFail($questionId);

                $question->update([
                    'question' => $validatedUpdateQuestionRequest['question'],
                    'correct_answer' => $validatedUpdateQuestionRequest['correct'],
                ]);

                $extractedAnswers = $this->answerExtractor->extractAnswers($validatedUpdateQuestionRequest);

                $alreadyExistingAnswers = $question->answers()->get();

                $alreadyExistingAnswers->each(function ($answer, $index) use ($extractedAnswers) {
                    $answer->update($extractedAnswers[$index]);
                });
            });

            return redirect()->route('dashboard');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return redirect()->route('dashboard')->withErrors('Failed to update question');
        }
    }
}
