<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'task_number',
        'nik',
        'name',
        'hp',
        'complaint_village',
        'latitude',
        'longtitude',
        'title',
        'description',
        'status',
        'reject_note',
        'start_at',
        'end_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function technician()
    {
        return $this->hasMany(TaskTechnician::class);
    }
}
