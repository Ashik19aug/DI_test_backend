<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends BaseController
{
    public function index()
    {
        try {
            return $this->successResponse([
                'data' => Event::with('team')->paginate(10),
            ],"Event fetch successfully!");
        }catch (\Exception $e){
            return $this->failedResponseWithError($e," Failed!");
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:155',
            'event_date' => 'required|date|before_or_equal:today',
            'team_id' => 'required|exists:teams,id',
        ]);

        try {
            return $this->successResponse([
                'data' => Event::create($request->all()),
            ],"Event insert successfully!");
        }catch (\Exception $e){
            return $this->failedResponseWithError($e," Failed!");
        }

    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:155',
            'event_date' => 'required|date|before_or_equal:today',
            'team_id' => 'required|exists:teams,id',
        ]);


        try {
            $event->update($request->all());

            return $this->successResponse([
                'data' => $event,
            ],"Event update successfully!");
        }catch (\Exception $e){
            return $this->failedResponseWithError($e," Failed!");
        }
    }

    public function destroy(Event $event)
    {
        $event->delete();
        try {
            return $this->successResponse([
                'data' => [],
            ],"Event delete successfully!");
        }catch (\Exception $e){
            return $this->failedResponseWithError($e," Failed!");
        }
    }
}
