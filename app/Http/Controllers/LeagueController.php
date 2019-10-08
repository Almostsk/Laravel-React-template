<?php


namespace App\Http\Controllers;


class LeagueController extends Controller
{
    public function index()
    {
        return view('league.index');
    }
}