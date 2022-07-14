<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;
class Users_detail extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'users_detail';
    protected $primaryKey = 'user_id';

    // public function user()
    // {
    //     return $this->belongsTo('App\Models\UserManagement\User' , 'user_id');
    // }


    public function company()
    {
        return $this->hasOne(Company::class,'pid','company_pid');
    }

}
