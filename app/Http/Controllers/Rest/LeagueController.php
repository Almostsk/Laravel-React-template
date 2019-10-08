<?php


namespace App\Http\Controllers\Rest;


use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLeagueRequest;
use App\Services\League\LeagueService;
use Illuminate\Support\Facades\Auth;

class LeagueController extends Controller
{
    /**
     * @var LeagueService
     */
    private $leagueService;

    public function __construct(LeagueService $leagueService)
    {
        $this->leagueService = $leagueService;
    }

    public function create(CreateLeagueRequest $request)
    {
        try{
            $cUser = Auth::guard()->user();
            $data = [
                'name' => $request->name
            ];
            $this->leagueService->createLeague($data, $cUser);
            return ['success' => true];
        }catch (\Exception $e){
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}