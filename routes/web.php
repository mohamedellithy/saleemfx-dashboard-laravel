<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('comman-arisan', function () {
    // \Artisan::call('make:migration add_affiliate_code_users --table=users');
    //\Artisan::call('migrate:refresh');
    //  \Artisan::call('storage:link');
    // \Artisan::call('migrate');
});



Auth::routes(['verify' => true]);


Route::get('admin-dashboard', 'AdminDashboardLoginController');
Route::get('/',function(){
    return redirect()->to('login');
});

Route::get('form-register-course/{course}', 'OrderCourseController@create');
Route::post('courses/store/{course}', 'OrderCourseController@store');

Route::get('run-expire-cashbacks','ExpireCashbacksController@index');

Route::middleware(['auth','IfAdmin'])->group(function(){
    Route::resource('forex-companies','ForexCompanyController');
    Route::resource('analytics-categories','AnalyticsCategoryController');

    Route::resource('users','UserController');
    Route::resource('accounts','AccountController');
    Route::post('update-accounts-bulk','AccountController@update_accounts_status_bulk');

    Route::resource('experts-files','ExpertsFilesController');
    Route::resource('wallet-recharge-orders','WalletRechargeOrderController');
    Route::resource('services-orders','ServicesOrdersController');

    Route::resource('experts-files-orders','FileOrderController')->only([
        'index','update'
    ]);

    Route::resource('directrix-files-orders','DirectrixOrderController')->only([
        'index','update'
    ]);

    Route::resource('directrix-files','DirectrixServicesController');

    Route::resource('settings','SettingController');

    Route::get('cashback/regenerate-cashback','CashBackController@create_cashback');
    Route::get('cashback/import-cashback','CashBackController@create_import_cashback');
    Route::post('cashback/import-cashback','CashBackController@store_import_cashback');
    Route::resource('cashback-accounts','CashBackController');
    Route::post('delete-cashbacks','CashBackController@delete_cashbacks_selected')->name('delete-cashbacks');

    Route::get('withdraw-orders/pending','WithdrawOrdersController@pending_order')->name('withdraw-orders-pending');
    Route::get('withdraw-orders/others','WithdrawOrdersController@others_order');
    Route::get('change-withdraw-order-status/{order_id}/{status}','WithdrawOrdersController@change_status');

    Route::get('courses-orders', 'OrderCourseController@index');
    Route::delete('course-order/{id}', 'OrderCourseController@destroy');


    Route::get('affiliaters','affiliatersController@show_affiliaters');
    Route::get('affiliate-employmee','affiliatersController@affiliates_employmees');
    Route::get('affiliates-profites','affiliatersController@profites_affiliaters');
    Route::get('affiliates-withdraw-profites','affiliatersController@affiliaters_withdraw_profits');
    Route::get('affiliater/{user}','affiliatersController@show_affiliater_details');
    Route::delete('affiliater/{user}','affiliatersController@delete_affiliater');
    Route::get('change-withdraw-affiliate-order-status/{order_id}/{status}','affiliatersController@change_status');
    Route::post('change-affiliter-position/{affiliate}','affiliatersController@change_affiliter_position');
    Route::post('affiliater-commission/{affiliate}','affiliatersController@change_affiliater_commission');



    Route::get('change-status-experts-files/{expert_id}/{status}','ExpertsFilesController@change_status');
    Route::get('change-status-account/{account_id}/{status}','AccountController@update');
    Route::get('change-wallet-recharge-orders/{order_id}/{status}','WalletRechargeOrderController@change_status');
    Route::get('change-status-services-order/{order_id}/{status}','ServicesOrdersController@change_status');
    Route::get('change-status-vip-order/{order_id}/{status}','VipServicesOrdersController@change_status');
    Route::get('change-status-experts-files-order/{order_id}/{status}','FileOrderController@change_status');
    Route::get('change-status-directrix-files-order/{order_id}/{status}','DirectrixOrderController@change_status');


    Route::post('add-salary-employee/{affiliate}','affiliatersController@add_salary_employee');
    Route::get('delete-employee-salary/{id}','affiliatersController@delete_salary_employee');

});

Route::middleware(['auth','verified','IfUser'])->group(function(){
    Route::resource('my-accounts','myAccountsController');
    Route::resource('my-wallet','WalletController');

    Route::resource('my-withdraw-orders','MyWithdrawOrdersController');

    Route::resource('my-services','MyServicesController');
    Route::resource('my-cashbacks','MyCashbackController');
    Route::resource('my-expire-cashbacks','MyExpireCashbackController');
    Route::resource('cashback-withdraw-orders','MyWithdrawOrdersController');

    Route::resource('my-experts-files','MyExpertsFilesController');

    Route::resource('experts-files-orders','FileOrderController')->only([
        'store'
    ]);

    Route::resource('directrix-files-orders','DirectrixOrderController')->only([
        'store'
    ]);


    Route::resource('vip-services','VipServicesOrdersController')->only([
      'create','store'
    ]);

    Route::get('me','MyInformationsController@index');
    Route::post('update-info','MyInformationsController@update');

    Route::resource('recommended-services','MyRecommendedServiceController')->only(['create','store']);
    Route::get('directrix-services','MyDirectrixServicesController@index');

});

Route::middleware(['auth','verified','IfAffiliater'])->group(function(){

    Route::get('me','MyInformationsController@index');
    Route::post('update-info','MyInformationsController@update');


    Route::get('affiliates/create','AffiliateController@create_affiliate');
    Route::post('affiliates/store','AffiliateController@store_affiliate');
    Route::get('affiliatees/show','AffiliateController@show_affiliatees');
    Route::get('affiliatees/my-profits','AffiliateController@my_profit_affiliatees');
    Route::post('affiliatees/order-withdraw','AffiliateController@order_withdraw_affiliatees');
    Route::get('affiliatees/withdraws','AffiliateController@affiliater_withdraws');
    Route::get('affiliatees/show-employee-salaries','AffiliateController@show_employee_salaries');
    Route::post('affiliatees/send-invitation','AffiliateController@send_invitation_email');

});



Route::resource('vip-services','VipServicesOrdersController')->except([
      'create','store'
])->middleware(['auth','IfAdmin']);

