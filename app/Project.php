<?php

namespace App;

use App\Mail\ProjectCreated;
use Illuminate\Database\Facades\Mail;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    //
    protected $fillable = [
        'title', 'description','owner_id'
    ];

    protected $dispatchesEvents = [
        'created' => ProjectCreated::class
    ];

    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function addTask($task){
        $this->tasks()->create($task);
    }
}


