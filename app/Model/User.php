<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'role_id',
        'tel',
        'birthday',
        'sex',
        'user_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role() 
    {
            return $this->belongsTo(Role::class);
    }
    
    /**
     * Check admin role
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role_id == 1;
    }
    
    public function Address()
    {
        return $this->hasMany(Address::class);
    }
    
    public function Contact()
    {
        return $this->hasMany(Contact::class);
    }
    
    public function Forum()
    {
        return $this->hasMany(Forum::class);
    }
    
    public function Reply()
    {
        return $this->hasMany(Reply::class);
    }
    
    public function OrderTemp()
    {
        return $this->hasOne(OrderTemp::class);
    }
}
