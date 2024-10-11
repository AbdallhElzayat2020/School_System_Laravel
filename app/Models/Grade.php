<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Grade extends Model
{
    use HasTranslations;

    protected $table = 'grades';
    protected $fillable = ['Name', 'Notes'];
    public $translatable = ['Name'];
    public $timestamps = true;
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

}
