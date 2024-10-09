<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Contracts\View\View;
use App\Action\Admin\CreateQuestion;
use App\Action\Admin\UpdateQuestion;
use App\Service\Question\GetQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Http\Requests\Question\QuestionRequest;

class QuestionController extends Controller
{
    public function createQuestion(): View|Factory|Application
    {
        return view('admin.question.create');
    }

    public function storeQuestion(QuestionRequest $request, CreateQuestion $createQuestion): RedirectResponse
    {
        $validatedQuestionRequest = $request->validated();

        if ($validatedQuestionRequest) {
            $createQuestion->createQuestionAndAnswers($validatedQuestionRequest);
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
    ): RedirectResponse {
        $validatedUpdateQuestionRequest = $request->validated();

        if ($validatedUpdateQuestionRequest) {
            $updateQuestion->UpdateQuestion($questionId, $validatedUpdateQuestionRequest);
        }

        return redirect()->route('dashboard');
    }

    public function deleteQuestion(string $questionId): RedirectResponse
    {
        $question = GetQuestion::getQuestionByQuestionId($questionId);

        $question->delete();

        return redirect()->route('dashboard');
    }
}
