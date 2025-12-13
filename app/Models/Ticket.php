<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    const STATUS_NEW = 'New';
    const STATUS_IN_PROGRESS = 'In Progress';
    const STATUS_COMPLETED = 'Completed';

    protected $fillable = [
        'title', 'description', 'status', 'user_id', 'category_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
