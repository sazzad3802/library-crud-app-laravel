<?php

namespace App\OpenApi;

use OpenApi\Annotations as OA;


if (!defined('L5_SWAGGER_CONST_APP_URL')) {
    define('L5_SWAGGER_CONST_APP_URL', env('APP_URL') . '/api/v1');
}

/**
 * @OA\Info(
 *   version="1.0.0",
 *   title="Your API",
 *   description="Interactive docs for Your API"
 * )
 *
 * @OA\Server(
 *   url=L5_SWAGGER_CONST_APP_URL,
 *   description="Local development server"
 * )
 * @OA\Server(
 *   url="https://staging.example.com/api",
 *   description="Staging server"
 * )
 * @OA\Server(
 *   url="https://api.example.com",
 *   description="Production server"
 * )
 *
 * 
 */
class OpenApi {} // empty on purpose; holds global annotations
