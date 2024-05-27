<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CandidateResource;
use Illuminate\Http\Request;

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

    public function destroy(Request $request, Candidate $candidate): JsonResponse
    {
        try {
            $candidate->delete();
            return response()->json(['message' => 'Candidat supprimé'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur est survenue'], 500);
        }
    }    
}
