<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskImage extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'file_name', 'type'];

    protected $appends = ['file_name_only'];

    /**_________________ Accessors and Mutators _________________ */

    public function getFileNameAttribute($value)
    {
        return $value ? url("storage/images/tasks/$value") : null;
    }

    public function getFileNameOnlyAttribute()
    {
        return basename($this->file_name);
    }

    /**____________________ Model Relationships ____________________ */

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
