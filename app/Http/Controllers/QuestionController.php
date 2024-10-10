<?php

namespace App\Http\Controllers;

use App\Action\Admin\CreateQuestionAndAnswersById;
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

    public function editQuestion(
        string $questionId,
        CreateQuestionAndAnswersById $createQuestionAndAnswersById
    ): View|Factory|Application
    {
        $question = Question::with('answers')->findOrFail($questionId);

        $allQuestionsAndRelatedAnswers = $createQuestionAndAnswersById($question);

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
