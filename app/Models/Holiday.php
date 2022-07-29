<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Holiday extends Model
{
    use HasFactory;

    protected $holidays = ['holiday_date'];

    protected $fillable = [
        'id',
        'name',
        'holiday_date'
    ];
}
