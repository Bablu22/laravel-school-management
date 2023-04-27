<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccountStudentFee extends Model
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


    public function student_class(): BelongsTo
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }


    public function student_year(): BelongsTo
    {
        return $this->belongsTo(StudentYear::class, 'year_id', 'id');
    }


    public function group(): BelongsTo
    {
        return $this->belongsTo(StudentGroup::class, 'group_id', 'id');
    }


    public function shift(): BelongsTo
    {
        return $this->belongsTo(StudentShift::class, 'shift_id', 'id');
    }

    public function fee_category(): BelongsTo
    {
        return $this->belongsTo(FeeCategory::class, 'fee_category_id', 'id');
    }
}
