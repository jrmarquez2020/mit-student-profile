<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = [
        'course_id',
        'name',
        'age',
        'address',
        'contact_number',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}