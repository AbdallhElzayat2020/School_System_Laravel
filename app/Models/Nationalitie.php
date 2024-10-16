<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationalitie extends Model
{
      use HasFactory;
      public $translatable = ['Name'];

      protected $fillable = [
            'Name',
      ];

}
