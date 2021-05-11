<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'book';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $dataFormat = 'h:i:s';
}
