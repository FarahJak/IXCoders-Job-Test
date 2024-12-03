<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'user_id'];

    /**____________________ Model Relationships ____________________ */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function taskImages(): HasMany
    {
        return $this->hasMany(TaskImage::class);
    }
}
