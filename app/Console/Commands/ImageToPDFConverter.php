<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Imagick;

class ImageToPDFConverter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image2pdf:convert { document : document location }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Converter IMAGE TO PDF Via Imagick GhostScript.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Starting covert...");
        
        try {
            
            $document = $this->argument('document');
            
            if ( empty($document) ) {
                
                $this->error("Document must to fill.");
                
                return false;
            }
            
            if ( !extension_loaded('imagick') ) {
                
                $this->error("Imagick not installed.");
                
                return false;
            }
            
            $source = Storage::disk('public')->path($document);
            
            $im = new Imagick();
            
            $im->readimage($source);
            
            $pages = $im->getNumberImages();
            
            $im->clear();
            
            $im->destroy();
            
            $template = "<body style='background-image: url(%s);
                background-position: top left;
                background-repeat: no-repeat;
                background-image-resize: 4;
                background-image-resolution: from-image;'>";
            
            $mpdf = new \Mpdf\Mpdf();
            
            for ($iteration = 0; $iteration < $pages; $iteration++) {
                
                $filePathStorage = Storage::disk('public')->path('document') . DIRECTORY_SEPARATOR . explode('.', basename($document))[0] . "{$iteration}.jpg";
                
                $mpdf->addPage();
                
                $mpdf->WriteHTML(sprintf($template, $filePathStorage));
                
            }
            
            $mpdf->Output(Storage::disk('public')->path('document') . DIRECTORY_SEPARATOR . 'result.pdf', 'F');
            
        } catch (Exception $e) {
            
            $this->error($e->getMessage());
            
            return false;
        }
        
        $this->info("Convert success");
        
        return Command::SUCCESS;
    }
}
