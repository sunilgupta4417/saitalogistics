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
        Schema::create('client_other_charges', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->default(0);
            $table->string('charge_type')->nullable();
            $table->string('type')->nullable();
            $table->float('amount_per')->nullable();
            $table->string('deleted_at')->nullable();
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
        Schema::dropIfExists('client_other_charges');
    }
};
