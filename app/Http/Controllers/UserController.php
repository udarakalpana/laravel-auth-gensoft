<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUserDashboard(): View|Factory|Application
    {
        $questions = Question::with('answers')->get();

        return view('user.dashboard')->with('questions', $questions);
    }
}
