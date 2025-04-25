<?php

namespace App\Http\Controllers;

use App\Models\UserCollection;
use Illuminate\Http\Request;
use App\Http\Resources\CollectionResource;
use App\Models\Brickheadz;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        return CollectionResource::collection($request->user()->collection()->paginate(60));
    }    

    public function store(Request $request)
    {
        $request->validate([
            'brickheadz_id' => 'required|exists:brickheadzs,id',
            'user_id' => 'required|exists:users,id',
            'date_acquired' => 'nullable|date',
            'price_acquired' => 'nullable',
            'status' => 'nullable|in:NEW,BOX_AND_INSTRUCTIONS,ONLY_BOX,INSTRUCTIONS,COMPLETE,INCOMPLETE',
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
            'status' => 'nullable|in:NEW,BOX_AND_INSTRUCTIONS,ONLY_BOX,INSTRUCTIONS,COMPLETE,INCOMPLETE',
        ]); 

        $collection->update($request->all());

        return new CollectionResource($collection);
    }


    public function delete(Request $request, UserCollection $collection)
    {
        if ($request->user()->id !== $collection->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $collection->delete();

        return response()->json(['message' => 'Collection item deleted successfully.']);
    }

}

