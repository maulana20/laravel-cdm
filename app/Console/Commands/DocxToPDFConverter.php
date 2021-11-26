<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DocxToPDFConverter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docx2pdf:convert { document : document location }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Converter DOCX TO PDF Via Command LibreOffice Headless.';

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
        try {
            
            $this->info("Starting covert...");
            
            $document = $this->argument('document');
            
            if ( empty($document) ) {
                
                $this->error("Document must to fill.");
                
                return false;
            }
            
            if ( empty(config('cdmsupport.libreoffice')) ) {
                
                $this->error("Environtment CDMSUPPORT_LIBREOFFICE must to fill.");
                
                return false;
            }
            
            shell_exec('"' . config('cdmsupport.libreoffice') . '"' . " --headless --convert-to pdf " . Storage::disk('public')->path($document) . " --outdir " . Storage::disk('public')->path('document'));
            
        } catch (Exception $e) {
            
            $this->error($e->getMessage());
            
            return false;
        }
        
        $this->info("Convert success");
        
        return Command::SUCCESS;
    }
}
