<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDictionaryLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dictionary_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dictionary_id')->constrained('dictionaries')->onDelete('cascade');
            $table->foreignId('language_id')->constrained('localizations')->onDelete('cascade');
            $table->string('value');      
            $table->index(['dictionary_id', 'language_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dictionary_languages');
    }
}
