<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContentColumnToPageLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_languages', function (Blueprint $table) {
            $table->text('content_2')->nullable()->after('content');
            $table->text('content_3')->nullable()->after('content_2');
            $table->text('content_4')->nullable()->after('content_3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_languages', function (Blueprint $table) {
            //
        });
    }
}
