<?php


namespace App\Entities\League;


use Illuminate\Database\Eloquent\Model;

class LeagueRole extends Model
{
    protected $table = 'league_roles';

    protected $fillable = ['name'];
}