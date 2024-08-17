<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends BaseController
{
    public function index()
    {
        try {
            return $this->successResponse([
                'data' => Team::paginate(10),
            ],"Team insert successfully!");
        }catch (\Exception $e){
            return $this->failedResponseWithError($e," Failed!");
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:teams,name',
        ]);

        try {
            return $this->successResponse([
                'data' => Team::create($request->all()),
            ],"Team insert successfully!");
        }catch (\Exception $e){
            return $this->failedResponseWithError($e," Failed!");
        }
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:teams,name,' . $team->id,
        ]);

        try {
            $team->update($request->all());

            return $this->successResponse([
                'data' => $team,
            ],"Team update successfully!");
        }catch (\Exception $e){
            return $this->failedResponseWithError($e," Failed!");
        }
    }

    public function destroy(Team $team)
    {
        try {
            $team->delete();

            return $this->successResponse([
                'data' => [],
            ],"Team delete successfully!");
        }catch (\Exception $e){
            return $this->failedResponseWithError($e," Failed!");
        }return response()->noContent();
    }
}
