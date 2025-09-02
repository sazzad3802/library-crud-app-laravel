<?php

namespace App\OpenApi\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *   schema="CommonData",
 *   type="object",
 *   required={"id","type","name"},
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="pid", type="integer", nullable=true, example=null),
 *   @OA\Property(property="type", type="string", example="PRG"),
 *   @OA\Property(property="name", type="string", example="Education Program"),
 *   @OA\Property(property="description", type="string", nullable=true, example="Program related to education"),
 *   @OA\Property(property="is_active", type="boolean", example=true),
 *   @OA\Property(property="int_value", type="integer", nullable=true, example=5),
 *   @OA\Property(property="string_value", type="string", nullable=true, example="Extra info"),
 *   @OA\Property(property="latitude", type="number", format="float", nullable=true, example=23.8103),
 *   @OA\Property(property="longitude", type="number", format="float", nullable=true, example=90.4125),
 *   @OA\Property(property="parent_id", type="integer", nullable=true, example=10),
 *   @OA\Property(property="created_at", type="string", format="date-time"),
 *   @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class CommonData {}
