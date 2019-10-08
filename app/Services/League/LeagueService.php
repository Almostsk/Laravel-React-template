<?php


namespace App\Services\League;


use App\Entities\User;
use App\Repositories\League\LeaguePlayerRepository;
use App\Repositories\League\LeagueRepository;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class LeagueService
{
    const MIN_USER_LEVEL = 3;

    const LEAGUE_ROLE_CREATOR = 1;
    const LEAGUE_ROLE_ADMIN = 2;
    const LEAGUE_ROLE_PLAYER = 3;

    /**
     * @var LeagueRepository
     */
    private $leagueRepository;

    /**
     * @var LeaguePlayerRepository
     */
    private $leaguePlayerRepository;


    public function __construct(
        LeagueRepository $leagueRepository,
        LeaguePlayerRepository $leaguePlayerRepository
    )
    {
        $this->leagueRepository = $leagueRepository;
        $this->leaguePlayerRepository = $leaguePlayerRepository;
    }

    public function createLeague(array $league, User $user)
    {
        if($user->getLevel() < self::MIN_USER_LEVEL ){
            throw new \LogicException('A minimum level 3 is required to create a league.');
        }

        $faker = Faker::create();
        $image_folder = '/storage/images/league/emblems/';
        $public_folder = '/public/images/league/emblems/';
        $filepath = public_path($image_folder);
        if (!File::exists($filepath)) {
            File::makeDirectory($filepath, 0777, true);
        }

        $filename = $faker->image($filepath, 200, 200, false, false);
        $emblem = $image_folder . $filename;

        $league['emblem'] = $emblem;


        try{
            DB::beginTransaction();
            $league = $this->leagueRepository->create($league);

            $player = [
                'user_id' => $user->id,
                'role_id' => self::LEAGUE_ROLE_CREATOR,
                'league_id' => $league->id
            ];

            $this->leaguePlayerRepository->create($player);

            DB::commit();
        }catch (\Exception $e)
        {
            DB::rollBack();
            Storage::delete($public_folder. $filename);
            throw new \Exception($e->getMessage());
        }

    }

}