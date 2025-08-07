<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleSheetUrl extends Model
{
    use HasFactory;

    protected $fillable = ['url'];
}
