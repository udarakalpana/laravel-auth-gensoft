<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\UserAnswer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUserDashboard(): View|Factory|Application
    {
        $questions = Question::with('answers')->get();

        return view('user.dashboard')->with('questions', $questions);
    }

    public function answerForQuestion(string $questionId, Request $request): RedirectResponse
    {
       $validatedAnswerRequest = $request->validate([
           'answer' => ['required', 'string']
       ]);

       $user = $request->user();

       $question = Question::findOrFail($questionId);

       $isCorrect = trim($validatedAnswerRequest['answer']) === trim($question->correct_answer);

       UserAnswer::create([
           'user_id' => $user->id,
           'question_id' => $question->id,
           'answer' => $validatedAnswerRequest['answer'],
           'is_correct' => $isCorrect,
       ]);

       $message = $isCorrect ? 'Your answer is correct' : 'Your answer is wrong';


        return redirect()->route('user-dashboard')->with('message', $message);
    }
}
