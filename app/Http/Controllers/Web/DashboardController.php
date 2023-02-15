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
        for ($i = 1; $i <= 12; $i++) {
            $approve[] = Task::whereMonth('updated_at', $i)->whereYear('updated_at', date('Y'))->where('status', 'success')->count();
            $reject[] = Task::whereMonth('updated_at', $i)->whereYear('updated_at', date('Y'))->where('status', 'reject')->count();

        }
        $charts = [

            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            'datasets' => [
                [
                    'label' => 'Approve',
                    'backgroundColor' =>  'rgba(105, 0, 132, .2)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 1,
                    'data' => $approve,
                ],
                [
                    'label' => 'Reject',
                    'backgroundColor' =>  'rgba(0, 137, 132, .2)',
                    'borderColor' =>  'rgba(0, 10, 130, .7)',
                    'borderWidth' => 1,
                    'data' => $reject,
                ]
            ]
        ];

        return view('dashboard', compact(['progress', 'success', 'pending', 'charts']));
    }
}
