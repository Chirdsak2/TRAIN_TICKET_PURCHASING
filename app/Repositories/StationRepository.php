<?php 
namespace App\Repositories;

use App\Models\Station;
use Illuminate\Http\Request;

interface IStationRepository{
    public function getStationAll () : array;
    public function getStation(int $id): array;
    public function createStation(Request $request,string $filename ): array;
    public function updateStation(int $id,Request $request,string $filename ): bool;
    public function destroyStation(int $id): bool;
}

class StationRepository implements IStationRepository{

    public function getStationAll(): array
    {
        return Station::all()->toArray();
    }

    public function getStation(int $id): array
    {
        return Station::find($id)->toArray();
    }
    public function createStation(Request $request,string $filename ): array
    {
        return Station::create([
            'station_code' => $request->station_code,
            'station_number' => $request->station_code,
            'station_name' => $request->station_name,
            'station_detail' => $request->station_detail,
            'station_picture' =>  $filename
        ])->toArray();
    }
    public function updateStation(int $id,Request $request,string $filename ): bool
    {
        return Station::findOrFail($id)->update([
            'station_code' => $request->station_code,
            'station_number' => $request->station_number,
            'station_name' => $request->station_name,
            'station_detail' => $request->station_detail,
            'station_picture' => $filename
        ]);
    }

    public function destroyStation(int $id): bool
    {
        // Find the user by id
        return Station::findOrFail($id)->delete();
    }
}

?>