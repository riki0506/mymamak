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
        Schema::table('posts', function (Blueprint $table) {
            // Drop the existing 'image' column
            $table->dropColumn('image');

            // Add the new 'image_url' column
            $table->string('image_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Drop the new 'image_url' column
            $table->dropColumn('image_url');

            // Add back the 'image' column
            $table->string('image', 100)->nullable();
        });
    }
};
