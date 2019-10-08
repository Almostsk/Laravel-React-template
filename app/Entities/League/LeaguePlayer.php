<?php


namespace App\Entities\League;


use Illuminate\Database\Eloquent\Model;

class LeaguePlayer extends Model
{
    protected $table = 'league_players';

    protected $fillable = ['user_id', 'role_id', 'league_id'];
}