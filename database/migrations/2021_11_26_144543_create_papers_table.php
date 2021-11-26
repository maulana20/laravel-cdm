<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->timestamps();
        });
        
        Schema::create('paper_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paper_id');
            $table->string('attachment');
            $table->string('quarter')->nullable();
            $table->string('final')->nullable();
        });
        
        Schema::create('paper_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paper_id');
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('papers');
        Schema::dropIfExists('paper_documents');
        Schema::dropIfExists('paper_images');
    }
}
