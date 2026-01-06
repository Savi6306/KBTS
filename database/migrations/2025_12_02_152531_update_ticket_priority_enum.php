<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        DB::statement("ALTER TABLE tickets MODIFY priority ENUM('Low','Medium','High') NOT NULL DEFAULT 'Low'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE tickets MODIFY priority ENUM('Low','High') NOT NULL DEFAULT 'Low'");
    }
};
