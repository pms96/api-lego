<?php

namespace App\Http\Controllers;

use App\Models\Brickheadz;
use App\Http\Resources\BrickheadzResource;
use Illuminate\Http\Request;

class BrickheadzController extends Controller
{
    public function index()
    {
        return BrickheadzResource::collection(Brickheadz::paginate(12));
    }

    public function show($id)
    {
        return new BrickheadzResource(Brickheadz::findOrFail($id));
    }
}

