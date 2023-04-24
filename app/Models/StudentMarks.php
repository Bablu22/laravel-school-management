<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentMarks extends Model
{
    use HasFactory;

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function assign_subject(): BelongsTo
    {
        return $this->belongsTo(AssignSubject::class, 'assign_subject_id', 'id');
    }

    public function year(): BelongsTo
    {
        return $this->belongsTo(StudentYear::class, 'year_id', 'id');
    }

    public function student_class(): BelongsTo
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }

    public function exam_type(): BelongsTo
    {
        return $this->belongsTo(ExamType::class, 'exam_type_id', 'id');
    }


}
