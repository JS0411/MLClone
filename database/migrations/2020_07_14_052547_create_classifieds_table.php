<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassifiedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifieds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_profile_id')
                ->constrained('seller_profiles')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('description');
            $table->integer('price');
            $table->string('usage');
            $table->string('category');
            $table->json('images');
            $table->boolean('active')->default(true);
            $table->unsignedInteger('question_count')->default(0);
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
        Schema::dropIfExists('classifieds');
    }
}
