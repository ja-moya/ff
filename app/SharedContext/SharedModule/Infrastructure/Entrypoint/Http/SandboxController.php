<?php

declare(strict_types=1);

namespace App\SharedContext\SharedModule\Infrastructure\Entrypoint\Http;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SandboxController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json();
    }
}
