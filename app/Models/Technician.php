<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Technician extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'id',
        'name',
        'hp',
        'address'
    ];

    public function onProgressTask()
    {
        return $this->hasMany(TaskTechnician::class, 'technician_id', 'id')->join('tasks', 'tasks.id', '=', 'task_technicians.task_id')->where('tasks.status', 'progress');
    }
    public function task()
    {
        return $this->hasMany(Task::class);
    }
    

}
