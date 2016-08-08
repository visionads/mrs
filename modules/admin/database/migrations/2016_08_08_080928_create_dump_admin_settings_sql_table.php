<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDumpAdminSettingsSqlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(file_get_contents("modules/admin/database/sql_dump/solution_type.sql"));
        DB::unprepared(file_get_contents("modules/admin/database/sql_dump/print_material.sql"));
        DB::unprepared(file_get_contents("modules/admin/database/sql_dump/print_material_size.sql"));
        DB::unprepared(file_get_contents("modules/admin/database/sql_dump/photography_package.sql"));
        DB::unprepared(file_get_contents("modules/admin/database/sql_dump/photography_options.sql"));
        DB::unprepared(file_get_contents("modules/admin/database/sql_dump/package.sql"));
        DB::unprepared(file_get_contents("modules/admin/database/sql_dump/package_option.sql"));
        DB::unprepared(file_get_contents("modules/admin/database/sql_dump/local_media.sql"));
        DB::unprepared(file_get_contents("modules/admin/database/sql_dump/local_media_option.sql"));
        DB::unprepared(file_get_contents("modules/admin/database/sql_dump/signboard_package.sql"));
        DB::unprepared(file_get_contents("modules/admin/database/sql_dump/signboard_package_size.sql"));
        DB::unprepared(file_get_contents("modules/admin/database/sql_dump/digital_media.sql"));
        DB::unprepared(file_get_contents("modules/admin/database/sql_dump/settings.sql"));

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
