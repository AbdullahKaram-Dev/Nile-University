<?php
declare(strict_types=1);

namespace App\Http\Traits\Web\Admin;

use Illuminate\Http\JsonResponse;

trait ValidationResponse
{
    public function validationToJson($data):JsonResponse
    {
        return response()->json($data);
    }
}
