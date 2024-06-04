<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Repositories\IStationRepository;
use App\Repositories\StationRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StationsController extends Controller
{
    protected IStationRepository $repository;
    public function __construct(StationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $stations = $this->repository->getStationAll();
        return response()->json($stations);
    }

    public function show($id)
    {
        $station = $this->repository->getStation($id);
        if (!$station) {
            return response()->json(['error' => 'Station not found'], 404);
        }
        return response()->json($station);
    }


    public function store(Request $request)
    {
        //
        //  dd($request);
        $filename = '';
        if ($request->hasfile('station_picture')) {
            $file = $request->file('station_picture');

            $extension = $file->getClientOriginalExtension();
            $filename = date('YmdHi') . bin2hex(random_bytes(8)) . '.' . $extension;
            $file->move(public_path('/uploads'), $filename);
        }

        $station = $this->repository->createStation($request, $filename);

        return response()->json($station, Response::HTTP_OK);
    }

    public function update(Request $request, string $id)
    {
        // dd($request->all());
        // $station = $this->repository->getStation($id);

        // Initialize the filename with the existing user picture filename
        $filename = "";

        // Check if a new picture is uploaded
        if ($request->hasfile('station_picture')) {
            $file = $request->file('station_picture');
            $extension = $file->getClientOriginalExtension();
            $filename = date('YmdHi') . bin2hex(random_bytes(8)) . '.' . $extension;
            $file->move(public_path('/uploads'), $filename);

            // Optionally delete the old picture if it exists
            if (!empty($request->station_picture) && file_exists(public_path('/uploads') . '/' . $request->station_picture)) {
                unlink(public_path('/uploads') . '/' . $request->station_picture);
            }
        }

        // Update user with new data
        $this->repository->updateStation($id, $request, $filename);


        return response()->json(['message' => 'Station is Updated'], Response::HTTP_OK);
    }

    public function destroy(string $id)
    {
        
        $station = $this->repository->getStation($id);
        //  dd($station);
        // Optionally delete the user's picture if it exists
        if (!empty($station['station_picture']) && file_exists(public_path('/uploads') . '/' . $station['station_picture'])) {
            unlink(public_path('/uploads') . '/' . $station['station_picture']);
        }

        // Delete the user
        $this->repository->destroyStation($id);

        return response()->json(['message' => 'Station is Deleted'], Response::HTTP_OK);
    }
}
