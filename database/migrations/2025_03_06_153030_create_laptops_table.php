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
        Schema::create('laptops', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Add name column
            $table->string('brand');
            $table->string('processor');
            $table->string('processorGeneration');
            $table->integer('ram');
            $table->string('viga');
            $table->string('hard');
            $table->boolean('isTouch');
            $table->boolean('camera');
            $table->boolean('keyboardBacklight');
            $table->boolean('additionalHard');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->boolean('visibility');
            $table->boolean('inAED');
            $table->string('image')->nullable(); // Add image column
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laptops');
    }
};
