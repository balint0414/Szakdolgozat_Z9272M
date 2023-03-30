<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TrainingBooking;
use Illuminate\Support\Facades\Auth;

class TrainingBookingController extends Controller
{
    public function index(Request $request)
    {
        $trainer_id = $request->query('trainer_id');
        $trainer = User::findOrFail($trainer_id);

        $training_sessions = TrainingBooking::where('trainer_id', $trainer_id)
        ->where('status', 'Elérhető')->get();

        return view('booking.view', [
            'sessions' => $training_sessions,
            'trainer' => $trainer,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'trainer_id' => 'required|exists:users,id',
            'location' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|after:start_time',
        ]);

        $session = new TrainingBooking($request->all());
        $session->save();

        return redirect()->route('booking.index', ['trainer_id' => $request->trainer_id])
        ->with('success', 'Az edzési időpont sikeresen létrejött!');
    }

    public function booking(Request $request, TrainingBooking $session)
    {
        $student_id = $request->input('student_id');
        $session->student_id = $student_id;
        $session->status = 'Foglalt';
        $session->save();

        return redirect()->route('booking.index', ['trainer_id' => $session->trainer_id])
                         ->with('success', 'Az időpontot sikeresen lefoglaltad!');
    }

    public function create()
    {
        return view('booking.create');
    }

    public function destroy($id)
    {
        $training_session = TrainingBooking::findOrFail($id);
        $training_session_2 = TrainingBooking::findOrFail($id);
        $trainer = User::findOrFail($training_session_2->trainer_id);
        if(Auth::user()->id == $training_session->trainer_id || Auth::user()->role=='admin')
        {
            $training_session->delete();
            return view('booking.view', [
                'sessions' => $training_session_2,
                'trainer' => $trainer,
            ])
            ->with('success', 'Időpont törölve.');
        }
        else
        {
            return abort(403);
        }
    }

    public function setAvailable($id)
    {
        $training_session = TrainingBooking::findOrFail($id);
        $training_session_2 = TrainingBooking::findOrFail($id);
        $trainer = User::findOrFail($training_session_2->trainer_id);
        if(Auth::user()->id == $training_session->trainer_id || Auth::user()->role=='admin')
        {
            $training_session->update(['status' => 'Elérhető']);

            return view('booking.view', [
                'sessions' => $training_session_2,
                'trainer' => $trainer,
            ])
                ->with('success', 'Időpont állapota frissítve.');
        }
        else
        {
            return abort(403);
        }
    }

    public function bookedSessions(Request $request)
    {
        $user = $request->user();
        if ($user->role === 'Edző') {
            $booked_sessions = TrainingBooking::where('trainer_id', $user->id)
                ->where('status', 'Foglalt')
                ->with('student')
                ->get();
        } else {
            $booked_sessions = TrainingBooking::where('student_id', $user->id)
                ->where('status', 'Foglalt')
                ->with('trainer')
                ->get();
        }

        return view('booking.booked_session', compact('booked_sessions', 'user'));
    }
}
