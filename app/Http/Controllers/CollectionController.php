<?php

namespace App\Http\Controllers;

use App\Models\UserCollection;
use Illuminate\Http\Request;
use App\Http\Resources\CollectionResource;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        return CollectionResource::collection($request->user()->collection);
    }

    public function store(Request $request)
    {
        $request->validate([
            'brickheadz_id' => 'required|exists:brickheadz,id',
            'date_acquired' => 'nullable|date',
            'price_acquired' => 'nullable|numeric',
            'status' => 'nullable|in:Nuevo,Usado,Dañado',
        ]);

        $collection = $request->user()->collection()->create($request->all());

        return new CollectionResource($collection);
    }
}

