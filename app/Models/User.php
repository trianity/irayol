<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

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
        'email',
        'email_verified_at',
        'name',
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Get the blogs for this model.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function blogs()
    {
        return $this->hasMany('App\Models\Blog','user_id','id');
    }

    /**
     * Get the media for this model.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function media()
    {
        return $this->hasMany('App\Models\Medium','user_id','id');
    }

    /**
     * Get the pages for this model.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function pages()
    {
        return $this->hasMany('App\Models\Page','user_id','id');
    }

    /**
     * Set the email_verified_at.
     *
     * @param  string  $value
     * @return void
     */
    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = !empty($value) ? \DateTime::createFromFormat('[% date_format %]', $value) : null;
    }

    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getCreatedAtAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('Y-m-d h:i:s');
    }

    /**
     * Get email_verified_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getEmailVerifiedAtAttribute($value)
    {
        if ($value !== null) {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('Y-m-d h:i:s');
        } else {
            return '';
        }
    }

    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('Y-m-d h:i:s');
    }

    public function page()
    {
        return $this->hasMany('App\Models\Page');
    }

    public function blog()
    {
        return $this->hasMany('App\Models\Blog');
    }
}
