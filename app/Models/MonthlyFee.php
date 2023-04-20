<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthlyFee extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }

    public function year(): BelongsTo
    {
        return $this->belongsTo(StudentYear::class, 'year_id', 'id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(StudentGroup::class, 'group_id', 'id');
    }

}
