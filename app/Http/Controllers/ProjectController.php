<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->get();
        return response()->json([
            'message' => 'All Projects fetched successfully.',
            'data' => $projects,
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string',
            'name' => 'required|string',
            'start_date' => 'required|date',
            'program' => 'required|string',
            'type' => 'required|string',
            'donor' => 'required|string',
            'lifetime' => 'required|string',
            'running' => 'required|string',
            'fund_proposed' => 'required|numeric',
        ]);

        $project = Project::create($validated);

        return response()->json([
            'message' => 'Project created successfully.',
            'data' => $project,
        ], 201);
    }

    public function bulkStore(Request $request)
        {
            $validItems = [];
            $invalidItems = [];
            $createdProjects = [];

            foreach ($request->all() as $item) {
                $validator = Validator::make($item, [
                    'code' => 'required|string|unique:projects,code',
                    'name' => 'required',
                    'start_date' => 'required',
                    'program' => 'required',
                    'type' => 'required',
                    'donor' => 'required',
                    'lifetime' => 'required',
                    'running' => 'required',
                    'fund_proposed' => 'required',
                ]);

                if ($validator->fails()) {
                    $invalidItems[] = $item['code'] ?? null;
                } else {
                    $validItems[] = $item;
                }
            }

            if (!empty($validItems)) {
                Project::insert($validItems);

                $codes = array_column($validItems, 'code');
                $createdProjects = Project::whereIn('code', $codes)->get();
            }

            return response()->json([
                'message' => 'Bulk insertion successful',
                'created_count' => count($validItems),
                'invalid_count' => count($invalidItems),
                'invalid_items' => $invalidItems,
                'data' => $createdProjects
            ], !empty($invalidItems) ? 207 : 201);
        }



    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        return response()->json([
            'message' => 'Project fetched successfully.',
            'data' => $project,
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'name' => 'required|string',
            'start_date' => 'required|date',
            'program' => 'required|string',
            'type' => 'required|string',
            'donor' => 'required|string',
            'lifetime' => 'required|string',
            'running' => 'required|string',
            'fund_proposed' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $project->update($validator->validated());


        return response()->json([
            'message' => 'Project updated successfully.',
            'data' => $project,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
