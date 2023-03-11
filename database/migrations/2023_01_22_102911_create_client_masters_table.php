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
        Schema::create('client_masters', function (Blueprint $table) {
            $table->id();
            $table->string('client_code')->nullable();
            $table->string('client_name')->nullable();
            $table->string('sales_person')->nullable();
            $table->string('client')->nullable();
            $table->string('address1')->nullable();
            $table->string('state_id')->nullable();
            $table->string('email_id')->nullable();
            $table->string('address2')->nullable();
            $table->integer('country_id')->default_(0)->comment('country table id');
            $table->string('pan')->nullable();
            $table->string('pincode')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('gstin')->nullable();
            $table->string('city_id')->nullable();
            $table->string('office_phone_no')->nullable();
            $table->string('iec')->nullable();
            $table->string('aadhaar_no')->nullable();
            $table->string('bill_payment_type')->nullable();
            $table->float('bill_credit_amount')->nullable();
            $table->tinyInteger('bill_isActive')->default(0)->comment('1=active,0=inactive');
            $table->tinyInteger('bill_tax_applicable')->default(0)->comment('1=yes,0=no');
            $table->string('bill_vol')->nullable();
            $table->string('bill_currency')->nullable();
            $table->tinyInteger('bill_self_service')->default(0)->comment('1=yes,0=no');
            $table->tinyInteger('bill_mail_notification')->default(0)->comment('1=yes,0=no');
            $table->tinyInteger('bill_fuel_applicable')->default(0)->comment('1=yes,0=no');
            $table->tinyInteger('bill_enable_fedex_tpc')->default(0)->comment('1=yes,0=no');
            $table->tinyInteger('bill_generate_label')->default(0)->comment('1=yes,0=no');
            $table->tinyInteger('bill_no_invoice_amount')->default(0)->comment('1=yes,0=no');
            $table->string('booking_API_token')->nullable();
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
        Schema::dropIfExists('client_masters');
    }
};
