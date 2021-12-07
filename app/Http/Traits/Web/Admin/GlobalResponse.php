<?php
declare(strict_types=1);

namespace App\Http\Traits\Web\Admin;

use Illuminate\Http\JsonResponse;

trait GlobalResponse
{
    private function responseJson(string $type, int $status): JsonResponse
    {
        $messages = [
            'success' => [
                'success' => __('dashboard.operation_done_successfully')
            ],
            'error' => [
                'error' => __('dashboard.oops_an_error_occurred')
            ]
        ];

        return response()->json($messages[$type], $status);
    }

}
