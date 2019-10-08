<?php


namespace App\Entities\League;


use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    protected $table = 'leagues';

    protected $fillable = ['name', 'emblem'];
}