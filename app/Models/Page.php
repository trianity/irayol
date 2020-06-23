<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Page extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content','titleseo','descseo','keywordseo',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
