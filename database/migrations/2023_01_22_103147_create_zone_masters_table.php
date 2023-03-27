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
        Schema::create('zone_masters', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id')->default(0)->comment('vendor master id');
            $table->string('service_name')->nullable();
            $table->string('zone_name')->nullable();
            $table->string('zone_type')->nullable();
            $table->string('effctv_from')->nullable();
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
        Schema::dropIfExists('zone_masters');
    }
};
