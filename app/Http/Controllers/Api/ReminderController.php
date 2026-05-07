<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reminder;

class ReminderController extends Controller
{
    public function index()
    {
        return Reminder::all();
    }

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

    public function show(string $id)
    {
        return Reminder::findOrFail($id);
    }

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

    public function destroy(string $id)
    {
        $reminder = Reminder::findOrFail($id);
        $reminder->delete();
        
        return response()->json(['message' => 'Reminder deleted successfully']);
    }
}
