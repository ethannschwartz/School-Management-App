<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'section',
        'code',
        'description',
        'user_id',
        'keycode',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class)->with('user')->orderBy('created_at', 'desc');
    }

    /**
     * @return HasMany
     */
    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class)->orderBy('created_at', 'desc');
    }

    /**
     * @return BelongsToMany
     */
    public function course_followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_user','user_id', 'course_id')
            ->with('announcements', 'assignments')
            ->withTimestamps();
    }
}
