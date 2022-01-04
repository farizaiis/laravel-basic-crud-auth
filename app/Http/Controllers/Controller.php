<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
     * @OA\OpenApi(
     *     @OA\Info(
     *         version="1.0",
     *         title="News Api",
     *         description="Demo News Api",
     *     )
     * ),
     * @OA\SecurityScheme(
     *   securityScheme="token",
     *   type="http",
     *   scheme="bearer",
     *   name="Authorization",
     *   in="header"
     * ),
     */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
