<?php

namespace App\Http\Controllers;

use App\Models\UserCollection;
use Illuminate\Http\Request;
use App\Http\Resources\CollectionResource;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        return CollectionResource::collection($request->user()->collection()->paginate(12));
    }

    public function store(Request $request)
    {
        $request->validate([
            'brickheadz_id' => 'required|exists:brickheadzs,id',
            'user_id' => 'required|exists:users,id',
            'date_acquired' => 'nullable|date',
            'price_acquired' => 'nullable',
            'status' => 'nullable|in:NEW,BOX AND INSTRUCTIONS,ONLY BOX,INSTRUCTIONS,COMPLETE,INCOMPLETE',
        ]);

        $collection = $request->user()->collection()->create($request->all());

        return new CollectionResource($collection);
    }

    public function update(Request $request, UserCollection $collection)
    {
        $request->validate([
            'brickheadz_id' => 'sometimes|exists:brickheadzs,id',
            'date_acquired' => 'nullable|date',
            'price_acquired' => 'nullable',
            'status' => 'nullable|in:NEW,BOX AND INSTRUCTIONS,ONLY BOX,INSTRUCTIONS,COMPLETE,INCOMPLETE',
        ]);

        $this->authorize('update', $collection);

        $collection->update($request->all());

        return new CollectionResource($collection);
    }

}

