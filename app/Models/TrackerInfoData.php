<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TrackerInfo;

class TrackerInfoData extends Model
{
    use HasFactory;
    protected $fillable=['tracker_id','tracking_data','hours','tracking_date'];

    public function tracker_infos(){
        return $this->hasMany(TrackerInfo::class);
    }
}
