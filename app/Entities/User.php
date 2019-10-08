<?php

namespace App\Entities;

use App\Services\User\UserLevelService;
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        $userLevelService = new UserLevelService();
        return $userLevelService->getLevel($this);
    }
}
