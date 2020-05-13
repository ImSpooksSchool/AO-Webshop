<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property Role $role
 * @package App
 */
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function assignRole($role) {
        $this->role()->associate($role);
        $this->save();
    }

    public function getRoleNames() {
        return $this->role->flatten()->pluck("name")->unique();
    }

    public function hasRole($role): bool {
        if (is_int($role)) {
            return $this->role->getId() >= $role;
        } else if (is_string($role)) {
            $role = Role::where("name", "=", $role)->first();
            if ($role != null) {
                return $this->role->getId() >= $role->getId();
            }
        }
        return false;
    }
}
