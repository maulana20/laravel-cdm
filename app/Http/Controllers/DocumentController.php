<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Document\StoreRequest;
use App\Services\PhpWordService;
use Ramsey\Uuid\Uuid;

class DocumentController extends Controller
{
    public function create()
    {
        return view('document.create');
    }
    
    public function store(StoreRequest $request)
    {
        $templatePath = '../storage/app/public/template/template.docx';
        
        $fileName = Uuid::uuid4()->toString();
        
        $filePath = '../storage/app/public/document/' . $fileName . '.docx';
        
        $phpWordService = new PhpWordService($request);
        
        $phpWordService->replaceTemplateWord($templatePath, $filePath);
        
        $phpWordService->convertToPdf($filePath);
        
        return redirect()->route('document.create')->with([
            
            'success' => 'Document successfully stored',
            
            'pathDocx' => url('storage/document/' . $fileName . '.docx'),
            
            'pathPdf' => url('storage/document/' . $fileName . '.pdf')
            
        ]);
    }
    
    public function storeCreate(StoreRequest $request)
    {
        $fileName = $request->get('name') . '.docx';
        
        $phpWordService = new PhpWordService($request);
        
        $phpWordService->convertToWord($fileName);
        
        return redirect()->route('document.create')->with('success', 'Document successfully stored');
    }
}
