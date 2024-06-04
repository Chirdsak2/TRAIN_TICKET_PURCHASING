<?php 
namespace App\Repositories;

use App\Models\TicketPrice;
use Illuminate\Http\Request;

interface ITicketPriceRepository{
    public function getTicketPriceAll(): array;
    public function getTicketPrice(int $id): array;
    public function createTicketPrice(Request $request): array;
    public function updateTicketPrice(int $id,Request $request): bool;
    public function destroyTicketPrice(int $id): bool;
}

class TicketPriceRepository implements ITicketPriceRepository {
    public function getTicketPriceAll(): array
    {
        return TicketPrice::all()->toArray();
    }
    public function getTicketPrice(int $id): array
    {
        return TicketPrice::find($id)->toArray();
    }
    public function createTicketPrice(Request $request): array
    {
        return TicketPrice::create([
            'station_id' => $request->station_id,
            'next_station_price' => $request->next_station_price,
            'previous_station_price' => $request->previous_station_price
        ])->toArray();
    }
    public function updateTicketPrice(int $id,Request $request): bool
    {
        return TicketPrice::findOrFail($id)->update([
            'station_id' => $request->station_id,
            'next_station_price' => $request->next_station_price,
            'previous_station_price' => $request->previous_station_price
        ]);
    }
    public function destroyTicketPrice(int $id): bool
    {
        // Find the user by id
        return TicketPrice::findOrFail($id)->delete();
    }
}