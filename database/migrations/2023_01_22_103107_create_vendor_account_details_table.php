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
        Schema::create('vendor_account_details', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id')->default(0)->comment('vendor id');
            $table->string('token')->nullable();
            $table->string('meter_no')->nullable();
            $table->string('account_no')->nullable();
            $table->string('password')->nullable();
            $table->string('account_no1')->nullable();
            $table->string('environment')->nullable();
            $table->string('isActive')->default(0)->comment('1=active, 0=inactive');
            $table->string('company_name')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('pincode')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('address_1')->nullable();
            $table->string('city_id')->nullable();
            $table->string('email_id')->nullable();
            $table->string('address_2')->nullable();
            $table->string('state_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('address_3')->nullable();
            $table->integer('country_id')->default(0)->comment('country id');
            $table->string('deleted_at')->nullable()->comment('Delete date');
            $table->string('pickup_address')->nullable();
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
        Schema::dropIfExists('vendor_account_details');
    }
};
