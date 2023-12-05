<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function showReports()
    {
        $users = User::with('posts')->get();
        return view('reports', compact('users'));

    }
}
