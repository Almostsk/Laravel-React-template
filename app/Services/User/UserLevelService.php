<?php


namespace App\Services\User;


use App\Entities\User;

class UserLevelService
{
    const LEVEL_1 = 0;
    const LEVEL_2 = 300;
    const LEVEL_3 = 600;
    const LEVEL_4 = 900;
    const LEVEL_5 = 1600;
    const LEVEL_6 = 2500;
    const LEVEL_7 = 4800;
    const LEVEL_8 = 7200;
    const LEVEL_9 = 10000;
    const LEVEL_10 = 15000;

    /**
     * @param User $user
     * @return int
     */
    public function getLevel(User $user)
    {
        $userPoints = $user->getPoints();
        if($userPoints <= self::LEVEL_2){return 1;}
        elseif($userPoints <= self::LEVEL_3){ return 2;}
        elseif($userPoints <= self::LEVEL_4){ return 3;}
        elseif($userPoints <= self::LEVEL_5){ return 4;}
        elseif($userPoints <= self::LEVEL_6){ return 5;}
        elseif($userPoints <= self::LEVEL_7){ return 6;}
        elseif($userPoints <= self::LEVEL_8){ return 7;}
        elseif($userPoints <= self::LEVEL_9){ return 8;}
        elseif($userPoints <= self::LEVEL_10){ return 9;}
        elseif($userPoints > self::LEVEL_10){ return 10;}

        return 0;
    }
}