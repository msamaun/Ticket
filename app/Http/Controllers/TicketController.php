<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $trips = Trip::all();
        return view('tickets.index', compact('trips'));
    }

    public function purchase(Request $request)
    {
        $ticket = Ticket::create([
            'user_id' => auth()->user()->id,
            'trip_id' => $request->input('trip_id'),

        ]);

        return redirect()->route('tickets.show', $ticket)->with('success', 'Ticket purchased successfully!');
    }

    public function show(User $user)
    {
        $userTickets = $user->tickets()->with('trip')->get();
        return view('tickets.show', compact('userTickets'));
    }

    public function cancelTicket(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.show', auth()->user())->with('success', 'Ticket canceled successfully!');
    }
}
