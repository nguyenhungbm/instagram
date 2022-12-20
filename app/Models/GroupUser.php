<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    use HasFactory;

    protected $table = 'group_user';
    protected $fillable = [
        'id',
        'group_id',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
