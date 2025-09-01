<?php

namespace App\Http\Controllers;

use App\Models\CommonData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommonDataController extends Controller
{
    // Fetch all standing datas
    public function index()
    {
        return response()->json(CommonData::all());
    }

    public function getMasterData(Request $request)
    {
        $data = DB::table('common_data')->get();

        // Group by type
        $grouped = $data->groupBy('type');
    
        // Now build your custom response
        $response = [
            'programTypes' => $grouped->get('PRT') ?? [],
            'programs'    => $grouped->get('PRG') ?? [],
            'donors'    => $grouped->get('DNR') ?? [],
            'designations'    => $grouped->get('PRL') ?? [],
            'psuMailGroups'    => $grouped->get('PSM') ?? [],
            'fileTypes'    => $grouped->get('FTP') ?? [],
            'seniorMailGroups'    => $grouped->get('SMM') ?? [],
            'bankAccountTypes'    => $grouped->get('ACT') ?? [],
            'banks'    => $grouped->get('BNK') ?? [],
            'currencies'    => $grouped->get('CUR') ?? [],
            'years'    => $grouped->get('YER') ?? [],
            'operationMailGroups'    => $grouped->get('OPM') ?? [],
            'groups'    => $grouped->get('TPS') ?? [],

            // add more mappings if you have other types
        ];
    
        return response()->json($response);
    }

    public function getCommonData(Request $request)
    {
        // read values from JSON body
        $type = strtoupper($request->input('type'));

        if (!$type) {
            return response()->json(['message' => 'type is required'], 400);
        }

        $data = CommonData::where('type', $type)->get();

        if ($data->isEmpty()) {
            return response()->json([
                'message' => "No records found for type: {$type}"
            ], 404);
        }

        return response()->json($data);
    }

    public function getRegions(Request $request)
    {
        // read values from JSON body
        $type = strtoupper($request->input('type'));
        $parentId = $request->input('parentId');

        if (!$type || !$parentId) {
            return response()->json(['message' => 'type and parentId are required'], 400);
        }

        $data = CommonData::where('type', $type)
                        ->where('parent_id', $parentId)
                        ->get();

        if ($data->isEmpty()) {
            return response()->json([
                'message' => "No records found for type: {$type} and parentId: {$parentId}"
            ], 404);
        }

        return response()->json($data);
    }

    // Fetch a single record
    public function fetchById($id)
    {
        $data = CommonData::find($id);
        if (!$data) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json($data);
    }

    // Store new record
    public function store(Request $request)
    {
        $data = CommonData::create($request->all());
        return response()->json($data, 201);
    }

    // Update record
    public function update(Request $request, $id)
    {
        $data = CommonData::find($id);
        if (!$data) {
            return response()->json(['message' => 'Not found'], 404);
        }
        $data->update($request->all());
        return response()->json($data);
    }

    // Delete record
    public function destroy($id)
    {
        $data = CommonData::find($id);
        if (!$data) {
            return response()->json(['message' => 'Not found'], 404);
        }
        $data->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
