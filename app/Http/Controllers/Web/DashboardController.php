<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $progress = Task::where('status', 'progress')->count();
        $success = Task::where('status', 'success')->count();
        $pending = Task::where('status', 'pending')->count();
        return view('dashboard', compact(['progress', 'success', 'pending']));
    }
}
