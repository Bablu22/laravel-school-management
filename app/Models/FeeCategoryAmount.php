<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static latest()
 */
class FeeCategoryAmount extends Model
{
    use HasFactory;

    protected $fillable = ['fee_category_id', 'class_id', 'amount'];

    public function fee_category(): BelongsTo
    {
        return $this->belongsTo(FeeCategory::class, 'fee_category_id', 'id');
    }

    public function student_class(): BelongsTo
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }
}
