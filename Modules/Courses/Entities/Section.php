<?php

namespace Modules\Courses\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'course_id',
        'title',
        'slug',
        'duration',
        'order',
        'access',
        'is_active'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Courses\Database\factories\SectionFactory::new();
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function classes()
    {
        return $this->hasMany(Classe::class)->orderBy('order');
    }
}
