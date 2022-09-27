<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frontuser extends Model
{
    use HasFactory;
    protected $fillable=['firstname','lastname','email','password','email_verified_at','company_id','username','token','department','dob','phone','screen_capture','desktop_mode','notify_user','timezone','loginip','last_logindate'];
}
