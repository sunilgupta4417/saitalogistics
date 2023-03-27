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
        Schema::create('vendor_masters', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('vendor_code')->nullable();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('gstin')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('pincode')->nullable();
            $table->string('city_id')->nullable();
            $table->string('state_id')->nullable();
            $table->string('country_id')->nullable();
            $table->tinyInteger('isActive')->default(0)->comment('1=active,0=inactive');
            $table->tinyInteger('selfVendor')->default(0)->comment('1=self vendor');
            $table->tinyInteger('third_party_tracking')->default(0)->comment('1=yes,0=no');
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
        Schema::dropIfExists('vendor_masters');
    }
};
