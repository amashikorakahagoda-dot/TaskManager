<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Add this

class Project extends Model
{
    use HasFactory, SoftDeletes; // Add SoftDeletes

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'status'
    ];

    protected $dates = ['deleted_at']; // Add this

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: Project has many Tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}