<?php

namespace App\Http\Controllers;

use App\Action\Admin\UpdateQuestion;
use App\Http\Requests\Question\QuestionRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function createQuestion(): View|Factory|Application
    {
        return view('admin.question.create');
    }

    public function storeQuestion(QuestionRequest $request): RedirectResponse
    {
       $validatedQuestionRequest = $request->validated();

       $question = Question::create([
           'question' => $validatedQuestionRequest['question'],
           'correct_answer' => $validatedQuestionRequest['correct'],
       ]);

       if (!$question) {
           return redirect()->route('dashboard');
       }

        $answers = [
            'answer1' => $validatedQuestionRequest['answer1'],
            'answer2' => $validatedQuestionRequest['answer2'],
            'answer3' => $validatedQuestionRequest['answer3'],
            'answer4' => $validatedQuestionRequest['answer4'],
        ];

        foreach ($answers as $answer) {
           Answer::create([
               'question_id' => $question->id,
               'answer' => $answer
           ]);
       }

        return redirect()->route('dashboard');

    }

    public function editQuestion(string $questionId): View|Factory|Application
    {
        $question = Question::with('answers')->findOrFail($questionId);

        $answer1 = $question->answers[0]->answer;
        $answer2 = $question->answers[1]->answer;
        $answer3 = $question->answers[2]->answer;
        $answer4 = $question->answers[3]->answer;

        $allQuestionsAndRelatedAnswers = [
            'question' => $question,
            'correct_answer' => $question->correct_answer,
            'answer1' => $answer1,
            'answer2' => $answer2,
            'answer3' => $answer3,
            'answer4' => $answer4,
        ];

        return view('admin.question.update')->with($allQuestionsAndRelatedAnswers);
    }

    public function updateQuestion(
        string $questionId,
        QuestionRequest $request,
        UpdateQuestion $updateQuestion
    ): RedirectResponse
    {
        $validatedUpdateQuestionRequest = $request->validated();

        if ($validatedUpdateQuestionRequest) {
            $updateQuestion($questionId, $validatedUpdateQuestionRequest);
        }

        return redirect()->route('dashboard');

    }
}
