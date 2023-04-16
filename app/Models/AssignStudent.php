<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static latest()
 * @property mixed $student_id
 * @property mixed $year_id
 * @property mixed $group_id
 * @property mixed $class_id
 * @property mixed $shift_id
 */
class AssignStudent extends Model
{
    use HasFactory;


    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function discount(): BelongsTo
    {
        return $this->belongsTo(DiscountStudent::class, 'id', 'assign_student_id');
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }

    public function year(): BelongsTo
    {
        return $this->belongsTo(StudentYear::class, 'year_id', 'id');
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(StudentShift::class, 'shift_id', 'id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(StudentGroup::class, 'group_id', 'id');
    }


}
