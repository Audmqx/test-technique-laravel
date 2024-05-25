<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CandidateResource;

class CandidateController extends Controller
{
    public function index(): mixed
    {
        $candidates = Candidate::all();

        if ($candidates->isEmpty()) {
            return response()->json(['message' => 'No candidates found'], 200);
        }

        return CandidateResource::collection($candidates);
    }
}
