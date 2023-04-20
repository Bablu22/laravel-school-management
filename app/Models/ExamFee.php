<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamFee extends Model
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

    public function group(): BelongsTo
    {
        return $this->belongsTo(StudentGroup::class, 'group_id', 'id');
    }

    public function exam_type(): BelongsTo
    {
        return $this->belongsTo(ExamType::class, 'exam_type_id', 'id');
    }
}
