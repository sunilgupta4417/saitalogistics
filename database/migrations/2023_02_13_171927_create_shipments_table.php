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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->integer('awb_id')->default(0)->comment('packet booking AWB no');
            $table->dateTime('shipment_date')->nullable();
            $table->time('shipment_time')->nullable();
            $table->string('status')->nullable();
            $table->string('location')->nullable();
            $table->string('status_details')->nullable();
            $table->integer('created_by')->default(0)->comment('login user id');
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
        Schema::dropIfExists('shipments');
    }
};
