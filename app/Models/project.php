<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];

    public function team(){
        // belong to user when class is exipred
        return $this->belongsToMany(User::class, 'project_teams','project_id',"user_id");
    }

    public function postingan(){
        return $this->hasMany(Postingan::class,"id_project")->orderBy("created_at","desc");
    }
}
