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
            $table->string('phone', 16) // Phone number, compatible with the E.164 standard.
                ->after('email')
                ->unique()
                ->nullable();
            $table->string('area', 12) // The area identifier (ZIP code)
                ->after('phone')
                ->nullable();
            $table->string('location', 128) // The longer, optional, address
                ->after('area')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
