<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blog';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $dataFormat = 'Y/m/d H:i:s';

    protected $fillable = ['header','bodytext','image_one', 'image_two', 'author', 'published'];
}
