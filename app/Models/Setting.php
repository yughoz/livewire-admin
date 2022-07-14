<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = [];
    

    public function scopeCompany($query)
    {
        if (!Auth()->user()->can('all companies')) {
            return $query->where('pid' , Auth::user()->details->company_pid);
        }
    }
}
