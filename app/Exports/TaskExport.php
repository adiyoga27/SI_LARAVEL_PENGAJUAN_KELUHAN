<?php

namespace App\Exports;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TaskExport implements FromView
{
    public function __construct(protected $start_at, protected $end_at)
    {
        $this->start_at = $start_at;
        $this->end_at = $end_at;
    }
    public function view(): View
    {
        return view('exports.task-export', [
            'tasks' => Task::where('status', 'success')->where('start_at', '>=', $this->start_at)->where('end_at', '<=', $this->end_at)->get()
        ]);
    }
}
