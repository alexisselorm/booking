<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use  HasApiTokens, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'email',
        'password',
        'department'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Encrypt the user password
    public function setPasswordAttribute($password){
        $this->attributes['password']=bcrypt($password);
    }
    // A venue be in charge of many(hAS Many) Departments
    public function venues(){
        return $this->hasMany(Venue::class);
    }
    // A user belongs to a department
    public function department(){
        return $this->belongsTo(Department::class);
    }
}
