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
        Schema::create('packet_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('awb_no')->unique()->nullable();
            $table->string('reference_no')->nullable();
            $table->string('booking_date')->nullable();
            $table->integer('client_id')->default(0);

            $table->string('csr_consignor')->nullable();
            $table->string('csr_contact_person')->nullable();
            $table->string('csr_address1')->nullable();
            $table->string('csr_address2')->nullable();
            $table->string('csr_address3')->nullable();
            $table->string('csr_pincode')->nullable();
            $table->integer('csr_country_id')->default(0);
            $table->string('csr_state_id')->nullable();
            $table->string('csr_city_id')->nullable();
            $table->string('csr_mobile_no')->nullable();
            $table->string('csr_email_id')->nullable();
            $table->string('csr_pan')->nullable();
            $table->string('csr_gstin')->nullable();
            $table->string('csr_iec')->nullable();
            $table->string('csr_aadharno')->nullable();
            
            $table->string('csn_consignor')->nullable();
            $table->string('csn_contact_person')->nullable();
            $table->string('csn_address1')->nullable();
            $table->string('csn_address2')->nullable();
            $table->string('csn_address3')->nullable();
            $table->string('csn_pincode')->nullable();
            $table->integer('csn_country_id')->default(0);
            $table->string('csn_state_id')->nullable();
            $table->string('csn_city_id')->nullable();
            $table->string('csn_mobile_no')->nullable();
            $table->string('csn_email_id')->nullable();
            $table->string('csn_pan')->nullable();
            $table->string('csn_gstin')->nullable();
            $table->string('csn_iec')->nullable();
            $table->string('csn_aadharno')->nullable();

            $table->string('packet_type')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('packet_description')->nullable();
            
            $table->string('pcs_weight')->nullable();
            $table->string('actual_weight')->nullable();
            $table->string('vendor_weight')->nullable();
            $table->string('vendor_weight_type')->nullable();
            $table->string('total_weight')->nullable();
            $table->string('currency',25)->nullable();
            $table->string('devisor')->nullable();
            $table->string('operation_remark')->nullable();
            $table->string('accounting_remark')->nullable();
            
            $table->string('invoice_doc')->nullable();
            $table->integer('created_by')->default(0)->comment('login user id');
            $table->string('is_deleted')->nullable();
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
        Schema::dropIfExists('packet_bookings');
    }
};
