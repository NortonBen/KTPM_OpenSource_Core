<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caption extends Model
{
    protected $fillable = ['user_id','text'];
}
