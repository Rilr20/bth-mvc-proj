<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highscores extends Model
{
    use HasFactory;

    protected $table = 'highscores';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $dataFormat = 'h:i:s';

    protected $fillable = ['username', 'score', 'achieved'];
}
