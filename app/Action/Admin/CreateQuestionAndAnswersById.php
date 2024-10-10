<?php

namespace App\Action\Admin;

class CreateQuestionAndAnswersById
{
    public function __invoke($question): array
    {
        list($answer1, $answer2, $answer3, $answer4) = $this->extractAnswerFromQuestionRecord($question);

        return [
            'question' => $question,
            'correct_answer' => $question->correct_answer,
            'answer1' => $answer1,
            'answer2' => $answer2,
            'answer3' => $answer3,
            'answer4' => $answer4,
        ];
    }

    public function extractAnswerFromQuestionRecord($question): array
    {
        $answer1 = $question->answers[0]->answer;
        $answer2 = $question->answers[1]->answer;
        $answer3 = $question->answers[2]->answer;
        $answer4 = $question->answers[3]->answer;
        return array($answer1, $answer2, $answer3, $answer4);
    }
}
