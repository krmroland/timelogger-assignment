<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserTimeEntriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user, Request $request)
    {
        $query = $user->timeEntries();

        $request->validate(['date' => 'date']);

        $date = $request->date ? $request->date('date') : null;

        if ($request->mode === 'monthly') {
            return $query
                ->when($date, fn ($q) => $q->whereMonth('date', $date)->whereYear('date', $date))
                ->selectRaw("strftime('%Y-%m', date) AS month")
                ->selectRaw('sum(time_in_minutes) as time_in_minutes')
                ->groupBy('month')
                ->paginate();
        }

        return $query->when($date, fn ($q) => $q->whereDate('date', $date))->paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'time_in_minutes' => 'integer|min:1|max:1440',
            'description' => 'string|required|max:150',
            'categories' => 'array|required',
            'categories.*' => 'string',
        ]);

        $entry = $user->timeEntries()->create($data);

        return response()->json($entry, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
