<?php

namespace App\Http\Controllers;

use App\Repositories\ITicketPriceRepository;
use App\Repositories\TicketPriceRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TicketPriceController extends Controller
{
    protected ITicketPriceRepository $repository;
    public function __construct(TicketPriceRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {
        $ticketPrice = $this->repository->getTicketPriceAll();
        return response()->json($ticketPrice);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $ticketPrice = $this->repository->createTicketPrice($request);

        return response()->json($ticketPrice, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticketPrice = $this->repository->getTicketPrice($id);
        if (!$ticketPrice) {
            return response()->json(['error' => 'Ticket price not found'], 404);
        }
        return response()->json($ticketPrice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Update user with new data
        $this->repository->updateTicketPrice($id, $request);

        return response()->json(['message' => 'Ticket price is Updated'], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete the user
        $this->repository->destroyTicketPrice($id);

        return response()->json(['message' => 'Ticket price is Deleted'], Response::HTTP_OK);
    }
}
