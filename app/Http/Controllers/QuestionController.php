<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\QuestionRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function createQuestion(): View|Factory|Application
    {
        return view('admin.question.create');
    }

    public function storeQuestion(QuestionRequest $request)
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
}
