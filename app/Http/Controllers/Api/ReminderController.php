<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reminder;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Reminder::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'message' => 'required',
            'email' => 'required|email',
            'remind_at' => 'required|date',
        ]);

        return Reminder::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Reminder::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reminder = Reminder::findOrFail($id);
        
        $data = $request->validate([
            'title' => 'required',
            'message' => 'required',
            'email' => 'required|email',
            'remind_at' => 'required|date',
            'is_sent' => 'boolean',
        ]);
        
        $reminder->update($data);
        
        return $reminder;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reminder = Reminder::findOrFail($id);
        $reminder->delete();
        
        return response()->json(['message' => 'Reminder deleted successfully']);
    }
}
