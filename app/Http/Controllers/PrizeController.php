<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prize;
use App\Models\User;

class PrizeController extends Controller
{
    public function index()
    {
        $prizes = Prize::all();
        $user = auth()->user();

        return view('prizes.index', compact('prizes', 'user'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        // Assuming you want to associate the prize with the authenticated user
        $prize = auth()->user()->prizes()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        // Check if the created prize meets any achievement criteria for the user
        $this->checkAchievements(auth()->user());

        return redirect()->route('prizes.index')->with('success', 'Prijs succesvol toegevoegd');
    }

    // Other methods like show, edit, update, destroy...

    private function checkAchievements(User $user)
    {
        $prizes = Prize::all();

        foreach ($prizes as $prize) {
            $methodName = 'check' . str_replace(' ', '', ucwords(strtolower($prize->title))) . 'Achievement';
            if (method_exists($this, $methodName)) {
                $this->$methodName($user);
            }
        }
    }

    private function checkFirstLapAchievement(User $user)
    {
        if ($user->laps()->where('validated', true)->exists() && !$user->prizes()->where('title', 'First Lap')->exists()) {
            $this->attachPrizeToUser($user, 'First Lap');
        }
    }

    private function checkSecondLapAchievement(User $user)
    {
        if ($user->laps()->where('validated', true)->count() >= 2 && !$user->prizes()->where('title', 'Second Lap')->exists()) {
            $this->attachPrizeToUser($user, 'Second Lap');
        }
    }

    // Add more achievement check methods as needed

    private function attachPrizeToUser(User $user, $prizeTitle)
    {
        $prize = Prize::where('title', $prizeTitle)->first();
        if ($prize) {
            $user->prizes()->attach($prize->id);
        }
    }
}
