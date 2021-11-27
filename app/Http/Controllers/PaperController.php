<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Paper\StoreRequest;
use App\Models\Paper;
use Illuminate\Support\Facades\Artisan;

class PaperController extends Controller
{
    public function index()
    {
        $papers = Paper::all();
        
        return view('paper.index', compact('papers'));
    }
    
    public function create()
    {
        return view('paper.create');
    }
    
    public function store(StoreRequest $request)
    {
        $paper = Paper::create($request->getPaper());
        
        $paper->document()->create($request->getDocument());
        
        try {
            
            Artisan::call("docx2pdf:convert {$paper->id}");
            
            Artisan::call("pdf2image:convert {$paper->id}");
            
            Artisan::call("image2pdf:convert {$paper->id}");
        
        } catch (\Exception $e) {}
        
        return redirect()->route('paper.create')->with('success', 'Paper successfully stored');
    }
}
