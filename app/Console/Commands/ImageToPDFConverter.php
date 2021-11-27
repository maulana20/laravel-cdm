<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Imagick;
use App\Models\Paper;
use Ramsey\Uuid\Uuid;

class ImageToPDFConverter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image2pdf:convert { id : paper id }';

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
            
            if ( !extension_loaded('imagick') ) {
                
                $this->error("Imagick not installed.");
                
                return false;
            }
            
            $paper = Paper::find($this->argument('id'));
            
            if ( empty($paper) ) {
                
                $this->error("Paper not found.");
                
                return false;
            }
            
            $template = "<body style='background-image: url(%s);
                background-position: top left;
                background-repeat: no-repeat;
                background-image-resize: 4;
                background-image-resolution: from-image;'>";
            
            $mpdf = new \Mpdf\Mpdf();
            
            $images = $paper->images()->get();
            
            for ($iteration = 0; $iteration < $paper->images()->count(); $iteration++) {
                
                $filePathStorage = Storage::disk('public')->path($images[$iteration]->image);
                
                $mpdf->addPage();
                
                $mpdf->WriteHTML(sprintf($template, $filePathStorage));
                
            }
            
            $fileNameLocation = 'document/' . Uuid::uuid4()->toString() . '.pdf';
            
            $mpdf->Output(Storage::disk('public')->path($fileNameLocation), 'F');
            
            $paper->document->update([ 'final' => $fileNameLocation ]);
            
        } catch (Exception $e) {
            
            $this->error($e->getMessage());
            
            return false;
        }
        
        $this->info("Convert success");
        
        return Command::SUCCESS;
    }
}
