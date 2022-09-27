<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Project extends Model
{
    use HasFactory;
    protected $fillable=['company_id','user_id','name','hourLimit','description',"hourLimit"];

    public function user(){
        $this->belongsTo(User::class)->select("name","email");
    }

    public function tracker_infos(){
        return $this->hasMany(TrackerInfo::class);
    }


}
