<?php

namespace Modules\Courses\Entities;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'instructor_id',
        'title',
        'level',
        'slug',
        'keywords',
        'description',
        'required',
        'includes',
        'image',
        'visibility',
        'access'
    ];

    protected static function newFactory()
    {
        return \Modules\Courses\Database\factories\CourseFactory::new();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'course_categories', 'course_id', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function sectios()
    {
        return $this->hasMany(Section::class);
    }
}
