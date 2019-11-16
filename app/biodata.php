<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class biodata extends Model
{
   protected $fillable = ['name', 'email', 'address','mobile'];
}
