<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Imagick;

class PDFToImageConverter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pdf2image:convert { document : document location }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Converter PDF TO IMAGE Via Imagick GhostScript.';

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
            
            for ($iteration = 0; $iteration < $pages; $iteration++) {
                
                $im = new Imagick();
                
                $im->setResolution(400, 400);
                
                $im->readimage($source. "[$iteration]");
                
                $im->setBackgroundColor('white');
                
                $im->setImageFormat('jpg');
                
                $im->setImageUnits(imagick::RESOLUTION_PIXELSPERINCH);
                
                $im->setImageCompression(imagick::COMPRESSION_JPEG);
                
                $im->setImageCompressionQuality(100);
                
                $im->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN);
                
                $im->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
                
                $filePathStorage = Storage::disk('public')->path('document') . DIRECTORY_SEPARATOR . explode('.', basename($document))[0] . "{$iteration}.jpg";
                
                $im->writeImage($filePathStorage);
                
                $im->clear();
                
                $im->destroy();
            }
            
        } catch (Exception $e) {
            
            $this->error($e->getMessage());
            
            return false;
        }
        
        $this->info("Convert success");
        
        return Command::SUCCESS;
    }
}
