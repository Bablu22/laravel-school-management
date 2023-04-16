<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $assign_student_id
 * @property mixed|string $fee_category_id
 * @property mixed $discount
 */
class DiscountStudent extends Model
{
    use HasFactory;
}
