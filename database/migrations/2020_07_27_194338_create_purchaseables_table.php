<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')
                ->constrained('purchases')
                ->onDelete('cascade');
            $table->foreignId('purchaseable_id');
            $table->string('purchaseable_type');
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
        Schema::dropIfExists('purchaseables');
    }
}
