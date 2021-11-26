<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Paper\StoreRequest;
use App\Models\Paper;

class PaperController extends Controller
{
    public function create()
    {
        return view('paper.create');
    }
    
    public function store(StoreRequest $request)
    {
        $paper = Paper::create($request->getPaper());
        
        $paper->document()->create($request->getDocument());
        
        return redirect()->route('paper.create')->with('success', 'Paper successfully stored');
    }
}
