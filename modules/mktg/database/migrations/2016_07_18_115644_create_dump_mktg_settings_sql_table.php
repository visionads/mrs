<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDumpMktgSettingsSqlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(file_get_contents("modules/mktg/database/sql_dump/mktg_settings.sql"));
        DB::unprepared(file_get_contents("modules/mktg/database/sql_dump/mktg_material.sql"));
        DB::unprepared(file_get_contents("modules/mktg/database/sql_dump/mktg_artwork.sql"));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
