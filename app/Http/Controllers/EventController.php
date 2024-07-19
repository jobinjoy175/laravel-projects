<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Invite;
use App\Mail\EventInvite;
use App\Mail\EventInviteRemove;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();
    
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                  ->orWhere('start_date', 'LIKE', "%$search%")
                  ->orWhere('end_date', 'LIKE', "%$search%");
            });
        }
    
        if ($request->filled('start_date') && $request->filled('end_date')) {
            try {
                $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
                $endDate = Carbon::parse($request->input('end_date'))->endOfDay();
                $query->where(function($q) use ($startDate, $endDate) {
                    $q->whereBetween('start_date', [$startDate, $endDate])
                      ->orWhereBetween('end_date', [$startDate, $endDate]);
                });
            } catch (\Exception $e) {
                // Handle invalid date format
                return redirect()->back()->withErrors('Invalid date format');
            }
        }
    
        $events = $query->paginate(10);
    
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $event = new Event();
        $event->name = $request->name;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->user_id = Auth::id();
        $event->save();

        return response()->json(['success' => true, 'event_id' => $event->id]);
    }

    public function invite(Request $request)
    {
        // return 1;
        
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'email' => 'required|email',
        ]);
       
        $invite = new Invite();
        $invite->event_id = $request->event_id;
        $invite->email = $request->email;
        $invite->save();
        // dd($invite->email);
        Mail::to($request->email)->send(new EventInvite($invite));

        return response()->json(['success' => true,'invite_id' => $invite->id]);
    }

    public function removeInvite(Request $request)
    {
        $request->validate([
            'invite_id' => 'required|exists:invites,id',
        ]);

        $invite = Invite::find($request->invite_id);
        Mail::to($invite->email)->send(new EventInviteRemove($invite));
        $invite->delete();

        return response()->json(['success' => true]);
    }
}