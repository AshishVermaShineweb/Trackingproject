<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Project;

class TrackerInfo extends Model
{
    use HasFactory;
    protected $fillable=['user_id','project_id','trackingHours','trackingDate','tracking','timezone'];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function projects(){
        return $this->belongsTo(Project::class);
    }
}
