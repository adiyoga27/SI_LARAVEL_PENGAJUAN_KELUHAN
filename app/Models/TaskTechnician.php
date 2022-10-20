<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTechnician extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_id',
        'technician_id',
    ];
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
