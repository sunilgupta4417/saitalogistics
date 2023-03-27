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
        Schema::create('vendor_service_types', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id')->default(0)->comment('vendor id');
            $table->string('forwarder')->nullable();
            $table->string('service_name')->nullable();
            $table->string('packagin_group')->nullable();
            $table->string('mode')->nullable();
            $table->tinyInteger('isActive')->defaukt(0)->comment('1=active,0=inactive');
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
        Schema::dropIfExists('vendor_service_types');
    }
};
