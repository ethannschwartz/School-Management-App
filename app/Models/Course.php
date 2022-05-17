<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'section',
        'code',
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

    public function followers()
    {
        return $this->belongsTo(Follower::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class)->orderBy('created_at', 'desc');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class)->orderBy('created_at', 'desc');
    }
}
