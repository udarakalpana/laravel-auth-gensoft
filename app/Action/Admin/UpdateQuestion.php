<?php

namespace App\Action\Admin;

use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateQuestion
{
    public function __invoke(string $questionId, array $validatedUpdateQuestionRequest): RedirectResponse
    {
        try {
            DB::transaction(function () use ($questionId, $validatedUpdateQuestionRequest) {
                $question = Question::findOrFail($questionId);

                $question->update([
                    'question' => $validatedUpdateQuestionRequest['question'],
                    'correct_answer' => $validatedUpdateQuestionRequest['correct'],
                ]);


                $answersFromRequest = $this->getAnswersFromUpdateRequest($validatedUpdateQuestionRequest);


                $alreadyExistingAnswers = $question->answers()->get();

                $alreadyExistingAnswers->each(function ($answer, $index) use ($answersFromRequest) {
                    $answer->update($answersFromRequest[$index]);
                });

            });

            return redirect()->route('dashboard');
        }
        catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('dashboard')->withErrors('Failed to update question');
        }
    }

    public function getAnswersFromUpdateRequest(array $validatedUpdateQuestionRequest): Collection
    {
        return collect(range(1, 4))->map(function ($number) use ($validatedUpdateQuestionRequest) {

            return ['answer' => $validatedUpdateQuestionRequest["answer{$number}"]];
        });
    }
}
