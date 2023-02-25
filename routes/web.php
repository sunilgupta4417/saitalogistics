<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\WebController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\DashboardController;
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



//WEBSITE ROUTES
Route::get('/', [WebController::class, 'index'])->name('home');
Route::get('/about', [WebController::class, 'about'])->name('about');
Route::get('/services', [WebController::class, 'services'])->name('services');
Route::get('/tracking', [WebController::class, 'tracking'])->name('tracking');
Route::get('/shipping', [WebController::class, 'shipping'])->name('shipping');
Route::get('/support', [WebController::class, 'support'])->name('support');
Route::get('/faq', [WebController::class, 'faq'])->name('faq');
Route::get('/privacy-policy', [WebController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('/terms-condition', [WebController::class, 'terms_conditions'])->name('terms_conditions');
Route::get('/user-login', [AuthController::class, 'login'])->name('user.login');
Route::get('/user-logout', [AuthController::class, 'logout'])->name('user.logout');
Route::get('/user-register', [AuthController::class, 'register'])->name('user.register');
Route::post('/user/authenticate', [AuthController::class, 'authenticate']);
Route::post('/user/register', [AuthController::class, 'store']);


Route::group(['prefix' => 'user', 'middleware' => ['user:web']], function () {

Route::get('/dashboard', [DashboardController::class, 'home'])->name('user.dashboard');
Route::post('/profile/update', [DashboardController::class, 'update_profile']);
Route::post('/profile/password', [DashboardController::class, 'update_password']);
Route::get('/shipment/history', [DashboardController::class, 'get_shipment'])->name('user.get_shipment');
Route::get('/shipment/create', [DashboardController::class, 'create_shipment'])->name('user.create_shipment');
Route::post('/shipment/store', [DashboardController::class, 'store_shipment']);
Route::get('/shipping/success', [DashboardController::class, 'shipping_success'])->name('user.shipping.success');


});     






Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){

    Route::resource('user', userController::class);
    Route::get('user/unlink/{id}/{image}', [userController::class, 'unlink']);

    Route::get('packet-booking', [PacketBookingController::class, 'packetBooking']);
    Route::get('packet-listing',[PacketBookingController::class,'packetListing'])->name('packet.listing');
    Route::get('packet-view/{id}',[PacketBookingController::class,'packetView'])->name('packet.view');
    Route::post('packet-listing-expo',[PacketBookingController::class,'packetListingExpo'])->name('packet.listing.expo');

    Route::post('save-packet-booking', [PacketBookingController::class, 'savePacketBooking']);
    Route::post('search-packet-booking', [PacketBookingController::class, 'searchPacketBooking']);

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


});