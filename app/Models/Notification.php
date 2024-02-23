<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'status',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Custom Methods

    /**
     * Mark the notification as read.
     *
     * @return void
     */
    public function markAsRead()
    {
        $this->update(['status' => 'read']);
    }

    /**
     * Get the formatted content with a timestamp.
     *
     * @return string
     */
    public function getFormattedContentAttribute()
    {
        return "[{$this->created_at->diffForHumans()}] {$this->content}";
    }

    /**
     * Scope a query to only include unread notifications.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    /**
     * Get the notifications for a specific user.
     *
     * @param  int  $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Get the latest notifications.
     *
     * @param  int  $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function latestNotifications($limit = 10)
    {
        return static::latest()->limit($limit)->get();
    }
}
