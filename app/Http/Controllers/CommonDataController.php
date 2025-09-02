<?php

namespace App\Http\Controllers;

use App\Models\CommonData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;




/**
 * @OA\Tag(
 *   name="Common Data",
 *   description="Endpoints for managing common data (programs, donors, banks, etc.)"
 * )
 */
class CommonDataController extends Controller
{

    //  /**
    //  * @OA\Get(
    //  *   path="/common-data",
    //  *   tags={"Common Data"},
    //  *   summary="Fetch all common data records",
    //  *   @OA\Response(
    //  *     response=200,
    //  *     description="List of all records",
    //  *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CommonData"))
    //  *   )
    //  * )
    //  */
    // public function index()
    // {
    //     return response()->json(CommonData::all());
    // }



    /**
     * @OA\Get(
     *   path="/common-data/master",
     *   tags={"Common Data"},
     *   summary="Fetch grouped master data",
     *   description="Returns data grouped by type (programs, donors, banks, etc.)",
     *   @OA\Response(
     *     response=200,
     *     description="Grouped data by categories",
     *     @OA\JsonContent(type="object",
     *       @OA\Property(property="programTypes", type="array", @OA\Items(ref="#/components/schemas/CommonData")),
     *       @OA\Property(property="programs", type="array", @OA\Items(ref="#/components/schemas/CommonData")),
     *       @OA\Property(property="donors", type="array", @OA\Items(ref="#/components/schemas/CommonData")),
     *       @OA\Property(property="designations", type="array", @OA\Items(ref="#/components/schemas/CommonData")),
     *       @OA\Property(property="psuMailGroups", type="array", @OA\Items(ref="#/components/schemas/CommonData")),
     *       @OA\Property(property="fileTypes", type="array", @OA\Items(ref="#/components/schemas/CommonData")),
     *       @OA\Property(property="seniorMailGroups", type="array", @OA\Items(ref="#/components/schemas/CommonData")),
     *       @OA\Property(property="bankAccountTypes", type="array", @OA\Items(ref="#/components/schemas/CommonData")),
     *       @OA\Property(property="banks", type="array", @OA\Items(ref="#/components/schemas/CommonData")),
     *       @OA\Property(property="currencies", type="array", @OA\Items(ref="#/components/schemas/CommonData")),
     *       @OA\Property(property="years", type="array", @OA\Items(ref="#/components/schemas/CommonData")),
     *       @OA\Property(property="operationMailGroups", type="array", @OA\Items(ref="#/components/schemas/CommonData")),
     *       @OA\Property(property="groups", type="array", @OA\Items(ref="#/components/schemas/CommonData"))
     *     )
     *   )
     * )
     */
    public function getMasterData()
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



    /**
     * @OA\Post(
     *   path="/common-data",
     *   tags={"Common Data"},
     *   summary="Fetch common data by type",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       required={"type"},
     *       @OA\Property(property="type", type="string", example="PRG")
     *     )
     *   ),
     *   @OA\Response(response=200, description="Records found", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CommonData"))),
     *   @OA\Response(response=400, description="Missing type"),
     *   @OA\Response(response=404, description="No records found")
     * )
     */
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




    /**
     * @OA\Post(
     *   path="/common-data/regions",
     *   tags={"Common Data"},
     *   summary="Fetch regions by type and parent ID",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       required={"type","parentId"},
     *       @OA\Property(property="type", type="string", example="RGN"),
     *       @OA\Property(property="parentId", type="integer", example=5)
     *     )
     *   ),
     *   @OA\Response(response=200, description="Records found", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CommonData"))),
     *   @OA\Response(response=400, description="Missing parameters"),
     *   @OA\Response(response=404, description="No records found")
     * )
     */
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



    /**
     * @OA\Get(
     *   path="/common-data/{id}",
     *   tags={"Common Data"},
     *   summary="Fetch a record by ID",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=200, description="Record found", @OA\JsonContent(ref="#/components/schemas/CommonData")),
     *   @OA\Response(response=404, description="Not found")
     * )
     */
    public function fetchById($id)
    {
        $data = CommonData::find($id);
        if (!$data) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json($data);
    }




    // /**
    //  * @OA\Post(
    //  *   path="/common-data",
    //  *   tags={"Common Data"},
    //  *   summary="Create a new common data record",
    //  *   @OA\RequestBody(
    //  *     required=true,
    //  *     @OA\JsonContent(ref="#/components/schemas/CommonData")
    //  *   ),
    //  *   @OA\Response(response=201, description="Created", @OA\JsonContent(ref="#/components/schemas/CommonData")),
    //  *   @OA\Response(response=422, description="Validation error")
    //  * )
    //  */
    // public function store(Request $request)
    // {
    //     $data = CommonData::create($request->all());
    //     return response()->json($data, 201);
    // }

    
    

    // /**
    //  * @OA\Put(
    //  *   path="/common-data/{id}",
    //  *   tags={"Common Data"},
    //  *   summary="Update an existing record",
    //  *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
    //  *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/CommonData")),
    //  *   @OA\Response(response=200, description="Updated successfully", @OA\JsonContent(ref="#/components/schemas/CommonData")),
    //  *   @OA\Response(response=404, description="Not found")
    //  * )
    //  */
    // public function update(Request $request, $id)
    // {
    //     $data = CommonData::find($id);
    //     if (!$data) {
    //         return response()->json(['message' => 'Not found'], 404);
    //     }
    //     $data->update($request->all());
    //     return response()->json($data);
    // }

    
    

    //  /**
    //  * @OA\Delete(
    //  *   path="/common-data/{id}",
    //  *   tags={"Common Data"},
    //  *   summary="Delete a record",
    //  *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
    //  *   @OA\Response(response=200, description="Deleted successfully"),
    //  *   @OA\Response(response=404, description="Not found")
    //  * )
    //  */
    // public function destroy($id)
    // {
    //     $data = CommonData::find($id);
    //     if (!$data) {
    //         return response()->json(['message' => 'Not found'], 404);
    //     }
    //     $data->delete();
    //     return response()->json(['message' => 'Deleted successfully']);
    // }
}
