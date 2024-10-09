<?php

namespace App\Action\Admin;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use App\Structure\AnswerExtractorInterface;

class CreateQuestion
{
    protected AnswerExtractorInterface $answerExtractor;

    public function __construct(AnswerExtractorInterface $answerExtractor)
    {
        $this->answerExtractor = $answerExtractor;
    }

    public function createQuestionAndAnswers(array $validatedQuestionRequest): RedirectResponse
    {
        $question = Question::create([
            'question' => $validatedQuestionRequest['question'],
            'correct_answer' => $validatedQuestionRequest['correct'],
        ]);

        if (! $question) {
            return redirect()->route('dashboard');
        }

        $extractedAnswers = $this->answerExtractor->extractAnswers($validatedQuestionRequest);

        foreach ($extractedAnswers as $answer) {
            Answer::create([
                'question_id' => $question->id,
                'answer' => $answer['answer'],
            ]);
        }

        return redirect()->route('dashboard');
    }
}
