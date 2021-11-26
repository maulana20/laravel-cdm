<?php

namespace App\Services;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;

class PhpWordService extends PhpWord
{
    protected $request;
    
    public function __construct($request)
    {
        parent::__construct();
        
        $this->request = $request;
    }
    
    private function _parserXml($value)
    {
        $parser = new \HTMLtoOpenXML\Parser();
        
        return $parser->fromHTML($value);
    }
    
    public function convertToWord($fileName) : void
    {
        $section = $this->addSection();
        
        Html::addHtml($section, $this->request->get('content'), false, false);
        
        header('Content-Type: application/octet-stream');
        
        header('Content-Disposition: attachment;filename="' . $fileName);
        
        $wordWriter = IOFactory::createWriter($this, 'Word2007');
        
        $wordWriter->save('php://output');
    }
    
    public function convertToPdf($documentPath) : void
    {
        Settings::setPdfRendererName(Settings::PDF_RENDERER_MPDF);
        
        $wordDocument = IOFactory::load($documentPath);
        
        Settings::setPdfRendererPath(dirname($documentPath));
        
        $ext = pathinfo($documentPath, PATHINFO_EXTENSION);
        
        $pdfWriter = IOFactory::createWriter($wordDocument, 'PDF');
        
        $pdfWriter->save(str_replace($ext, 'pdf', $documentPath));
    }
    
    public function replaceTemplateWord($templatePath, $filePath) : void
    {
        $wordTemplate = new TemplateProcessor($templatePath);
        
        $wordTemplate->setValue('name', $this->request->get('name'));
        
        $wordTemplate->setValue('content', $this->_parserXml($this->request->get('content')));
        
        $wordTemplate->saveAs($filePath);
    }
}
