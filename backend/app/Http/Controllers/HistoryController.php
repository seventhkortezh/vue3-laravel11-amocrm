<?php

namespace App\Http\Controllers;

use App\Http\Resources\HistoryResource;
use App\Models\History;

class HistoryController extends Controller
{
    public function index()
    {
        $history = History::all();
        return response()->json(HistoryResource::collection($history));
    }
}
