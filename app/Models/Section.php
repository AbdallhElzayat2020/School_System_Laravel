<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Section extends Model
{
      use HasFactory, HasTranslations;

      protected $table = 'sections';
      public $translatable = ['section_name'];

      protected $fillable = [
            'section_name',
            'grade_id',
            'classroom_id',
      ];

      // Relationships between sections and classrooms to get the name of the class
      public function My_classes()
      {
            return $this->belongsTo(Classroom::class, 'classroom_id');
      }
}
