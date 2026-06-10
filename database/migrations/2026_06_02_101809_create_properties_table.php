<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->foreign()->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->decimal('rent_fee', 10, 2);
            $table->decimal('agency_fee',10,2);
            $table->text('address');
            $table->string('city');
            $table->string('type_of_house');
            $table->integer('number_of_bedrooms');
            $table->integer('number_of_bathrooms');
            $table->integer('number_of_parking_spaces');
            $table->string('is_furnished');
            $table->string('is_available');
            $table->string('images')->nullable(true);
            $table->string('roommate_preferences')->nullable(true);
            $table->string('contact_information')->nullable(true);
             $table->string('meta_data')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
