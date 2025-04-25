<?php

namespace App\Http\Controllers;

use App\Models\Brickheadz;
use App\Http\Resources\BrickheadzResource;
use Illuminate\Http\Request;

class BrickheadzController extends Controller
{
    public function index()
    {
        return BrickheadzResource::collection(Brickheadz::paginate(60));
    }
        
    public function missing(Request $request, User $user)
    {
        if (!auth()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $userId = $user->id;
        $missings = Brickheadz::leftJoin('user_collections', function ($join) use ($userId) {
            $join->on('brickheadzs.id', '=', 'user_collections.brickheadz_id')
                 ->where('user_collections.user_id', '=', $userId);
        })
        ->whereNull('user_collections.id')
        ->select('brickheadzs.*')
        ->get();

        return BrickheadzResource::collection($missings);
    }

    public function show($id)
    {
        return new BrickheadzResource(Brickheadz::findOrFail($id));
    }
}

