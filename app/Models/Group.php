<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'admin_prefix',
        'admin_name',
        'admin_email',
        'keycode',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
