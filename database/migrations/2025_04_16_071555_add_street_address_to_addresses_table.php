<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            // Menambahkan kolom street_address
            $table->string('street_address')->after('last_name');
        });
    }

    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            // Menghapus kolom street_address jika rollback
            $table->dropColumn('street_address');
        });
    }
};
