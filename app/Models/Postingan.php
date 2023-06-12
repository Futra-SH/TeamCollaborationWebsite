<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postingan extends Model
{
    use HasFactory;
    protected $guarded = ["id","created_at","update_at"];

    public function author(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function files(){
        return $this->hasMany(file::class,"id_postingan");
    }
    
}
