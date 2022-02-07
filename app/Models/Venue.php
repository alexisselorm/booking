<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = ['name','status','user_id','alias','department_id','location_id','description','image']; 
    // protected $guarded=[];

    // A venue belongs to a department
    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }
    // A venue belongs to a user from a certain department
    public function user(){
        return $this->hasMany(User::class,'user_id');
    }
}
