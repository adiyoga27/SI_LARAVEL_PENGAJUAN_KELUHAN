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
            $tasks[] = Task::whereMonth('updated_at', $i)->whereYear('updated_at', date('Y'))->where('status', 'success')->count();
        }
        $charts = [

            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            'datasets' => [
                [
                    'label' => 'Pengajuan Selesai',
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 1,
                    'hoverBackgroundColor' => 'rgba(255, 99, 132, 0.4)',
                    'hoverBorderColor' => 'rgba(255, 99, 132, 1)',
                    'data' => $tasks,
                ]
            ]
        ];

        return view('dashboard', compact(['progress', 'success', 'pending', 'charts']));
    }
}
