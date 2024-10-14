<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    // use HasFactory;
    use HasTranslations;

    protected $table = 'classrooms';
    public $translatable = ['Name'];
    protected $fillable = ['Name', 'grade_id'];
    public $timestamps = true;

    public function Grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

}
