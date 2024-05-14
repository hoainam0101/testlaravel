<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagerPrice extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'user_id',
        'manager_id',
        'price',
        'quantity',
        'created_at',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_group()
    {
        return $this->belongsTo(UserGroup::class,'manager_id');
    }
}
