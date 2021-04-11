<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReputationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reputations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('rating');
            $table->string('classified_name');
            $table->string('classified_id');
            $table->string('image');
            $table->string('description');
            $table->string('rater_name');
            $table->unsignedInteger('rater_id');
            $table->integer('reputationable_id');
            $table->string('reputationable_type');
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
        Schema::dropIfExists('reputations');
    }
}
