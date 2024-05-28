<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CandidateResource;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CandidateController extends Controller
{
    public function index(Request $request): JsonResponse | AnonymousResourceCollection
    {
        $endDate = $request->query('end_date');

        if (is_string($endDate)) {
            try {
                $parsedDate = Carbon::parse($endDate);
                $candidates = Candidate::withMissionEndingOn($parsedDate);
                return CandidateResource::collection($candidates);
            } catch (\Exception $e) {
                return response()->json(['message' => 'La date est invalide'], 400);
            }
        }

        $candidates = Candidate::all();
        if ($candidates->isEmpty()) {
            return response()->json(['message' => 'Veuillez ajouter des candidats'], 200);
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
