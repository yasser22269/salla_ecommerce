<?php

namespace App\Http\Controllers;

use App\Events\NotificationCreated;
use App\Http\Requests\NotificationRequest;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return view('notifications.index', compact('notifications'));
    }

    public function show(Notification $notification)
    {
        return view('notifications.show', compact('notification'));
    }

    public function create()
    {
        return view('notifications.create');
    }

    public function store(NotificationRequest $request)
    {
        $notification = Notification::create($request->validated());

        // Trigger the event
        event(new NotificationCreated($notification));

        return response()->json(['message' => 'Notification stored successfully', 'data' => $notification], 201);
    }

    public function edit(Notification $notification)
    {
        return view('notifications.edit', compact('notification'));
    }

    public function update(NotificationRequest $request, Notification $notification)
    {
        $notification->update($request->validated());

        // Trigger the event
        event(new NotificationCreated($notification));

        return response()->json(['message' => 'Notification updated successfully', 'data' => $notification], 201);
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();

        return redirect()->route('notifications.index')
            ->with('success', 'Notification deleted successfully.');
    }
}
