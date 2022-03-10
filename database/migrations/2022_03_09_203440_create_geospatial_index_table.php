<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * @see https://enlear.academy/working-with-geo-coordinates-in-mysql-5451e54cddec
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geospatial_index', function (Blueprint $table) {
            $table->id();

            $table->decimal('latitude', 8, 5);
            $table->decimal('longitude', 8, 5);

            $table->enum('for', ['user', 'request', 'offer']);
            $table->unsignedBigInteger('model_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geospatial_index');
    }
};
