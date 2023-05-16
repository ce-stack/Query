<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillabe = ['name' , 'amount' , 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
