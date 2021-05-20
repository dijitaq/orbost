<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
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
            $table->integer('listing_id');
            $table->string('slug');
            $table->string('classification')->nullable();
            $table->string('listingtype')->nullable();
            $table->string('status')->nullable();
            $table->string('price')->nullable();
            $table->json('location')->nullable();
            $table->json('facilities')->nullable();
            $table->string('heading')->nullable();
            $table->text('description')->nullable();
            $table->json('images')->nullable();
            $table->json('agents')->nullable();
            $table->dateTime('modifydate');
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
        Schema::dropIfExists('properties');
    }
}
