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
        'finish_note',
        'start_at',
        'end_at',
    ];
    protected static function booted()
    {
        static::created(function ($model) {
            $jml = $model->count();
            $prefix = 100000 + $jml + 1;
            $model->task_number = $prefix;
            $model->save();
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function technician()
    {
        return $this->hasMany(TaskTechnician::class);
    }

    public function images()
    {
        return $this->hasMany(TaskImage::class);
    }
}
