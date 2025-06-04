<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom email
            $table->dropColumn('email');
            
            // Tambahkan kolom username
            $table->string('username')->unique()->after('name');
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Jika rollback, kembalikan kolom email
            $table->string('email')->unique()->after('name');
            
            // Hapus kolom username
            $table->dropColumn('username');
        });
    }
    
};
