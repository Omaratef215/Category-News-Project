<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('temp_news', function (Blueprint $table) {
            $table->string('title')->after('id')->unique();
        });
    }

    public function down()
    {
        Schema::table('temp_news', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    }
};
