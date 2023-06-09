<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\WebController;
use App\Http\Controllers\Frontend\FedexController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\ShippingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PacketBookingController;
use App\Http\Controllers\OtherApiController;
use App\Http\Controllers\VendorMasterController;
use App\Http\Controllers\ClientMasterController;
use App\Http\Controllers\ZoneMasterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteSettingController;
use App\Http\Controllers\VendorMainFestController;
use App\Http\Controllers\RoleMangerController;
use App\Http\Controllers\CMSController;
use App\Http\Controllers\ShipmentController;



//WEBSITE ROUTES
Route::get('/', [WebController::class, 'index'])->name('home');
Route::get('/about', [WebController::class, 'about'])->name('about');
Route::get('/services', [WebController::class, 'services'])->name('services');
Route::get('/tracking', [WebController::class, 'tracking'])->name('tracking');
Route::get('/shipping', [WebController::class, 'shipping'])->name('shipping');
Route::get('/shipping/state/{id}', [WebController::class, 'shippingStateList'])->name('shipping.states');
Route::post('/shipping/rates', [WebController::class, 'shippingRates'])->name('shipping_rate');
Route::get('/support', [WebController::class, 'support'])->name('support');
Route::post('/support/save', [WebController::class, 'supportSave'])->name('support.store');
Route::post('/contactus/save', [WebController::class, 'contactusSave'])->name('contactus.store');
Route::get('/faq', [WebController::class, 'faq'])->name('faq');
Route::get('/privacy-policy', [WebController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('/terms-condition', [WebController::class, 'terms_conditions'])->name('terms_conditions');
Route::get('/user-login', [AuthController::class, 'login'])->name('user.login');
Route::get('/user-forgot-password', [AuthController::class, 'forgotPassword'])->name('user.forgot.password');
Route::post('/forget-password-link', [AuthController::class, 'forgetPasswordLink'])->name('user.forget.password.link');
Route::get('/user-logout', [AuthController::class, 'logout'])->name('user.logout');
Route::get('/user-register', [AuthController::class, 'register'])->name('user.register');
Route::post('/user/authenticate', [AuthController::class, 'authenticate']);
Route::post('/user/register', [AuthController::class, 'store']);
Route::get('/user/verify/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify');

Route::get('/user-transaction', function () {
    return view('frontend.transaction.transaction');

})->name('user.transaction');


Route::group(['prefix' => 'user', 'middleware' => ['user']], function () {

    Route::get('/dashboard', [DashboardController::class, 'home'])->name('user.dashboard');
    Route::post('/profile/update', [DashboardController::class, 'update_profile']);
    Route::post('/profile/password', [DashboardController::class, 'update_password']);
    Route::get('/shipment/history', [DashboardController::class, 'get_shipment'])->name('user.get_shipment');
    Route::get('/shipment/create', [DashboardController::class, 'create_shipment'])->name('user.create_shipment');
    Route::post('/shipment/store', [DashboardController::class, 'store_shipment'])->name('user.store_shipment');
    Route::get('/shipping/success', [DashboardController::class, 'shipping_success'])->name('user.shipping.success');
    Route::get('/shipment/payment/success/{shipment_id}', [DashboardController::class, 'shipping_success'])->name('user.shipment.payment.success');
    Route::post('/shipment/payment', [DashboardController::class, 'store_shipment_payment'])->name('user.store_shipment_payment');
    Route::get('/shipment/transaction', [DashboardController::class, 'getTransactions'])->name('user.transactions');

    Route::get('/shipment/create/courier', [DashboardController::class, 'create_courier_shipment'])->name('user.create_courier_shipment');
    Route::get('/shipment/create/air', [DashboardController::class, 'create_air_shipment'])->name('user.create_air_shipment');
    Route::get('/shipment/create/ocean', [DashboardController::class, 'create_ocean_shipment'])->name('user.create_ocean_shipment');
    Route::post('/shipment/store-new-shipment', [DashboardController::class, 'createNewShipment'])->name('user.store_new_shipment');
    Route::get('/shipment/payment/{shipment_id}', [DashboardController::class, 'createShipmentPayment'])->name('user.create.shipment.payment');

});
Route::post('/shipping/get-rates', [ShippingController::class, 'getRates']);
Route::get('/token', [ShippingController::class, 'getRates']);




Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

    Route::resource('user', userController::class);
    Route::get('user/unlink/{id}/{image}', [userController::class, 'unlink']);
    Route::get('shipment-rate', [PacketBookingController::class, 'shipmentRate'])->name('shipment.rate');
    Route::post('shipment-get-rate', [PacketBookingController::class, 'shipmentGetRate'])->name('shipment.get.rate');
    Route::get('packet-booking', [PacketBookingController::class, 'packetBooking']);
    Route::get('packet-listing',[PacketBookingController::class,'packetListing'])->name('packet.listing');
    Route::get('packet-view/{id}',[PacketBookingController::class,'packetView'])->name('packet.view');
    Route::post('packet-listing-expo',[PacketBookingController::class,'packetListingExpo'])->name('packet.listing.expo');
    Route::post('save-packet-booking', [PacketBookingController::class, 'savePacketBooking']);
    Route::post('search-packet-booking', [PacketBookingController::class, 'searchPacketBooking']);
    Route::post('update-shipping-charge',[PacketBookingController::class,'updateShippingRates'])->name('packet.update.shipping.charge');
    Route::get('send-shipment-payment-email-to-customer/{id}',[PacketBookingController::class,'sendShipmentPaymentEmailToCustomer'])->name('packet.send.shipment.payment.email.to.customer');
    Route::get('{courier_type}/packet-listing',[PacketBookingController::class,'packetListing'])->name('custom.packet.listing');
    Route::post('{courier_type}/packet-listing-expo',[PacketBookingController::class,'packetListingExpo'])->name('custom.packet.listing.expo');
    /*Route::get('courier-packet-listing',[PacketBookingController::class,'packetListing'])->name('courier.packet.listing');
    Route::get('air-freight-packet-listing',[PacketBookingController::class,'courierPacketListing'])->name('air.freight.packet.listing');
    Route::get('packet-listing',[PacketBookingController::class,'packetListing'])->name('packet.listing');*/

    Route::get('import-packet', [PacketBookingController::class, 'importPacket']);
    Route::post('import-packet-save', [PacketBookingController::class, 'importPacketSave'])->name('import.packet.save');

    
    Route::get('booking-report', [PacketBookingController::class, 'bookingReport'])->name('booking.report');
    Route::get('manifest-report', [PacketBookingController::class, 'manifestReport']);
    Route::get('delivered-report', [PacketBookingController::class, 'deliveredReport']);

    Route::get('print-awb-document', [OtherApiController::class, 'printAWBDocument']);
    Route::post('print-awb-doc-pdf',[OtherApiController::class,'printAwbDocPdf'])->name('print.awb.doc.pdf');
    Route::get('print-awb-label-pdf',[OtherApiController::class,'printAwbLabelPdf'])->name('print.awb.label.pdf');
    Route::get('shipment-movement', [OtherApiController::class, 'shipmentMovement'])->name('shipment.movement');
    Route::post('shipment-save', [OtherApiController::class, 'shipmentSave'])->name('shipment.save');
    Route::get('shipment-delete/{id}',[OtherApiController::class, 'shipmentDelete'])->name('shipment.delete');
    Route::get('pod-upload', [OtherApiController::class, 'podUpload']);

    Route::get('country-master', [OtherApiController::class, 'countryMaster']);
    Route::post('country-save',[OtherApiController::class,'countrySave'])->name('country.save');
    Route::get('country-list',[OtherApiController::class,'getCountryList'])->name('country.list');
    Route::get('country-delete/{id}',[OtherApiController::class,'countryDelete'])->name('country.delete');
    Route::post('country-update',[OtherApiController::class,'countryUpdate'])->name('country.update');
    //state
    Route::get('state/{id}',[OtherApiController::class,'stateAll'])->name('state.all');
    Route::post('state-save',[OtherApiController::class,'stateSave'])->name('state.save');
    Route::get('state-delete/{id}',[OtherApiController::class,'stateDelete'])->name('state.delete');
    Route::post('state-update',[OtherApiController::class,'stateUpdate'])->name('state.update');
    Route::get('export-state',[OtherApiController::class,'exportState'])->name('export.state');

    Route::get('reason-master', [OtherApiController::class, 'reasonMaster']);
    Route::post('reason-save', [OtherApiController::class,'reasonSave'])->name('reason.save');
    Route::get('reason-delete/{id}',[OtherApiController::class,'reasonDelete'])->name('reason.delete');
    Route::post('reason-update',[OtherApiController::class,'reasonUpdate'])->name('reason.update');
    Route::get('create-invoice', [OtherApiController::class, 'createInvoice']);
    Route::get('invoice', [OtherApiController::class, 'invoice']);
    Route::get('vendor-api-configuration', [OtherApiController::class, 'vendorApiConfiguration']);
    Route::get('export-country',[OtherApiController::class,'exportCountry'])->name('export.country');
    Route::get('export-reason',[OtherApiController::class,'exportReason'])->name('export.reason');
    
    Route::get('client-master', [ClientMasterController::class, 'clientMaster'])->name('client.master');
    Route::get('export-client-master', [ClientMasterController::class, 'exportClientMaster'])->name('export.client.master');
    Route::post('client-master-save',[ClientMasterController::class, 'clientMasterSave'])->name('client.master.save');
    Route::get('client-master-delete/{id}',[ClientMasterController::class, 'clientMasterDelete'])->name('client.master.delete');

    Route::get('zone-master', [ZoneMasterController::class, 'zoneMaster'])->name('zone.master');
    Route::post('zone-master-save', [ZoneMasterController::class, 'zoneMasterSave'])->name('zone.master.save');
    Route::get('zone-master-delete/{id}', [ZoneMasterController::class, 'zoneMasterDelete'])->name('zone.master.delete');
    Route::get('export-zone',[ZoneMasterController::class,'exportZone'])->name('export.zone');

    Route::get('manage-users', [UserController::class, 'manageUser'])->name('manage.user');
    Route::post('manage-users', [UserController::class, 'manageFilterUser'])->name('manage.post.user');
    Route::get('manage-frontend-users', [UserController::class, 'manageFrontEndUser'])->name('manage.frontend.user');
    Route::get('export-users/{userstatus}', [UserController::class, 'ExportUsers'])->name('export.users');

    Route::post('user-master-save',[UserController::class, 'userMasterSave'])->name('user.master.save');
    Route::post('user-master-update',[UserController::class, 'userMasterUpdate'])->name('user.master.update');
    Route::get('user-delete/{id}',[UserController::class, 'userMasterDelete'])->name('user.delete');

    Route::get('change-password', [UserController::class, 'changePassword']);
    Route::post('change-password-save',[UserController::class,'changePasswordSave'])->name('change.password.save');
    Route::get('payment-history', [UserController::class, 'paymentHistory']);
    Route::get('user-profile', [UserController::class, 'userProfile']);
    Route::post('user-profile-update',[UserController::class, 'userProfileUpdate'])->name('user.profile.update');
    Route::get('website-setting', [WebsiteSettingController::class, 'websiteSetting']);
    Route::post('website-setting-save', [WebsiteSettingController::class, 'websiteSettingSave'])->name('website.setting.save');
    
    // Route::get('vendor-manifest', [VendorMasterController::class, 'vendorManifest']);
    Route::get('vendor-master', [VendorMasterController::class, 'vendorMaster'])->name('vendor.master');
    Route::get('export-vendor-master', [VendorMasterController::class, 'exportVendorMaster'])->name('export.vendor.master');
    Route::post('vendor-master-save', [VendorMasterController::class, 'vendorMasterSave'])->name('vendor.master.save');
    Route::get('vendor-master-delete/{id}', [VendorMasterController::class, 'vendorMasterDelete'])->name('vendor.master.delete');
    Route::get('vendor-account-detail', [VendorMasterController::class, 'vendorAccountDetail'])->name('vendor.account.detail');
    Route::get('export-vendor-account-detail', [VendorMasterController::class, 'exportVendorAccountDetail'])->name('export.vendor.account.detail');
    
    Route::post('vendor-acccount-save',[VendorMasterController::class,'vendorAcccountSave'])->name('vendor.acccount.save');
    Route::post('get-vendor-service',[VendorMasterController::class,'getVendorService'])->name('get-vendor-service');
    Route::get('vendor-account-detail-delete/{id}',[VendorMasterController::class,'vendorAcccountDetailDelete'])->name('vendor.account.detail.delete');

    Route::resource('vendor-manifest', VendorMainFestController::class);
    Route::post('vendor-manifest', [VendorMainFestController::class,'create'])->name('vendor-manifest-create');

    Route::resource('role-manager', RoleMangerController::class);
    Route::get('role-manager-delete/{id}', [RoleMangerController::class, 'delete'])->name('role-manager.delete');
    Route::get('role-permission/{id}', [RoleMangerController::class, 'rolePermission'])->name('role-manager.role-permission');
    Route::post('role-permission', [RoleMangerController::class, 'saveRolePermission'])->name('save.rolePermission');

    Route::get('user-permission/{id}', [userController::class, 'userPermission'])->name('user.user-permission');
    Route::post('user-permission', [userController::class, 'saveUserPermission'])->name('save.user-permission');


    //CMS MENU
    Route::get('cms/page/{name}', [CMSController::class, 'get_page']);
    Route::post('cms/page/update', [CMSController::class, 'update_page'])->name('cms.page.update');

    Route::get('cms/about', [CMSController::class, 'get_about']);
    Route::get('cms/about/delete/{id}', [CMSController::class, 'delete_about']);
    Route::post('cms/about/store', [CMSController::class, 'store_about'])->name('cms.about.store');
    Route::post('cms/about/update', [CMSController::class, 'update_about'])->name('cms.about.update');

    Route::get('cms/service', [CMSController::class, 'get_service']);
    Route::get('cms/service/delete/{id}', [CMSController::class, 'delete_service']);
    Route::post('cms/service/store', [CMSController::class, 'store_service'])->name('cms.service.store');
    Route::post('cms/service/update', [CMSController::class, 'update_service'])->name('cms.service.update');

    Route::get('cms/faq', [CMSController::class, 'get_faq']);
    Route::get('cms/faq/delete/{id}', [CMSController::class, 'delete_faq']);
    Route::post('cms/faq/store', [CMSController::class, 'store_faq'])->name('cms.faq.store');
    Route::post('cms/faq/update', [CMSController::class, 'update_faq'])->name('cms.faq.update');


    Route::get('cms/setting', [CMSController::class, 'get_setting']);
    Route::post('cms/setting/update', [CMSController::class, 'update_setting'])->name('cms.setting.update');


    Route::get('cms/home', [CMSController::class, 'get_home']);
    Route::post('cms/home/update', [CMSController::class, 'update_home'])->name('cms.home.update');
    Route::post('cms/home/update1', [CMSController::class, 'update_home1'])->name('cms.home.update1');
    Route::post('cms/home/update2', [CMSController::class, 'update_home2'])->name('cms.home.update2');
    Route::post('cms/home/world-class-services', [CMSController::class, 'updareWordClassServices'])->name('cms.home.wordclass.services');
    Route::get('cms/home-about', [CMSController::class, 'get_home_about']);
    Route::post('cms/home-about/store', [CMSController::class, 'store_home_about'])->name('cms.home.about.store');
    Route::post('cms/home-about/update', [CMSController::class, 'update_home_about'])->name('cms.home.about.update');
    Route::get('cms/home-about/delete/{id}', [CMSController::class, 'delete_home_about']);

    Route::get('zone-rate', [ShipmentController::class, 'ZoneIndex'])->name('zone.index');
    Route::get('view-carrier-zone/{carrier}', [ShipmentController::class, 'CarrierZone'])->name('view.carrier.zone');
    Route::get('zone-edit/{id}', [ShipmentController::class, 'ZoneEdit'])->name('zone.edit');
    Route::post('zone-update', [ShipmentController::class, 'ZoneUpdate'])->name('zone.update');
    Route::get('import-zone-rates', [ShipmentController::class, 'ImportRates'])->name('import.zone.rates');
    Route::post('doimport-zone-rates', [ShipmentController::class, 'DoImportRates'])->name('doimport.zone.rates');
    Route::get('export-zone-rates/{carrier}', [ShipmentController::class, 'ExportRates'])->name('export.zone.rates');

    Route::get('support-lists', [CMSController::class, 'supportLists'])->name('support.lists');
    Route::get('inquiry-lists', [CMSController::class, 'inquiryLists'])->name('inquiry.lists');
});

Route::get('/get_rate', [FedexController::class, 'get_rate']);