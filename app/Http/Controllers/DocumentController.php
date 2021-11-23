<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Document\StoreRequest;
use App\Services\PhpWordService;

class DocumentController extends Controller
{
    public function create()
    {
        return view('document.create');
    }
    
    public function store(StoreRequest $request)
    {
        $templatePath = '../storage/app/public/template/template.docx';
        
        $filePath = '../storage/app/public/document/' . $request->get('name') . '.docx';
        
        $phpWordService = new PhpWordService($request);
        
        $phpWordService->replaceTemplateWord($templatePath, $filePath);
        
        $phpWordService->convertToPdf($filePath);
        
        return redirect()->route('document.create')->with('success', 'Document successfully stored');
    }
    
    public function storeCreate(StoreRequest $request)
    {
        $fileName = $request->get('name') . '.docx';
        
        $phpWordService = new PhpWordService($request);
        
        $phpWordService->convertToWord($fileName);
        
        return redirect()->route('document.create')->with('success', 'Document successfully stored');
    }
}
