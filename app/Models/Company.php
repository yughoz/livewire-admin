<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'ms_company';
    protected $primaryKey = 'pid';
    protected $guarded = [];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';


    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }


    public function scopeSelect2($query)
    {
        return $query->select('company_name as text', 'pid as value');
    }

}
