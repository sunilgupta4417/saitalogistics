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
        Schema::create('vendor_main_fests', function (Blueprint $table) {
            $table->id();
            $table->string('booking_date')->nullable();
            $table->string('mani_fest_no')->nullable();
            $table->string('forwarder')->nullable();
            $table->string('mani_fest_date')->nullable();
            $table->string('remark')->nullable();
            $table->string('awbno')->nullable();
            $table->tinyInteger('is_update')->default('0');
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
        Schema::dropIfExists('vendor_main_fests');
    }
};
