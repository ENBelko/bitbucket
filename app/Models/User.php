<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');

    }

    public function isEventer($numb = null)
    {

        if ($numb) {
            if ($this->name == "Eventer$numb") return true;
            return $this->hasRole("Eventer$numb");
        } else {

            if ($this->roles()->where('slug', 'like', '%eventer%')->count()) {
                return true;
            }
            return false;
        }
    }

    public function isAdmin()
    {
        if ($this->name == 'Admin') return true;/*если зашел под именем админ или есть роль admin*/
        return $this->hasRole('admin');

    }

    public function hasRole(... $roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }
}
