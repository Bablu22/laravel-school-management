<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $name
 * @method static latest()
 */
class StudentClass extends Model
{
    protected $fillable = ['name'];
    use HasFactory;
}
