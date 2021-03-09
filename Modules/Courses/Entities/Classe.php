<?php

namespace Modules\Courses\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'section_id',
        'title',
        'slug',
        'note',
        'media_type',
        'url',
        'order',
        'duration',
        'access',
        'is_active'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Courses\Database\factories\ClasseFactory::new();
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function viewClass()
    {
        return $this->hasMany(UserClase::class, 'class_id', 'id');
    }

    public function checkViewed($user_id){        
        if ($this->viewClass()->where('user_id', $user_id)->first()){
            return true;
        }else{
            return false;
        }
    }
}
