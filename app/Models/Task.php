<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Add this

class Task extends Model
{
    use HasFactory, SoftDeletes; // Add SoftDeletes

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'due_date',
        'priority',
        'status'
    ];

    protected $dates = ['deleted_at']; // Add this

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}