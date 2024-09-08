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
        Schema::table('news', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['category_id']);

            // Then drop the column
            $table->dropColumn('category_id');
        });
    }

    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            // Re-add the category_id column
            $table->unsignedBigInteger('category_id')->nullable();

            // Re-create the foreign key constraint
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }


};
