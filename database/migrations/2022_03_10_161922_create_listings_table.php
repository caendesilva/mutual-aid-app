<?php

use App\Models\User;
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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class); // The user who posted the listing
            
            $table->string('subject', 128); // The main title
            $table->string('location', 255); // The location (zip/area code or address)
            $table->string('contacts', 128)->nullable(); // The contact information string
            $table->string('body', 2048)->nullable(); // Extra details, supports basic Markdown

            $table->enum('type', ['request', 'offer'])->nullable(false); // The type of listing

            $table->json('resources')->nullable(); // Array of the resources offered/needed
            $table->json('metadata')->nullable(); // Metadata object, for example, to filter religious posts

            $table->dateTime('expires_at')->nullable(); // Does the offer expire within a date?
            $table->dateTime('closed_at')->nullable(); // When was the request/offer fulfilled?
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
};
