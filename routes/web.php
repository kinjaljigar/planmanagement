<?php

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

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {

    return view('login');

});
// Route::get('/GoToLogin', function () {

//     return view('home');

// });
Route::get('/GoToLogin', [

    'uses' => 'PlanManagementController@check_session',
    

])->middleware('LoginCheck');


Route::get('/', [

    'uses' => 'PlanManagementController@check_session',
    'as' => 'checksession'

]);


Route::post('/GoToLogin', [

    'uses' => 'PlanManagementController@check_credential',
    'as' => 'checkcredential'

]);

// this for logout
Route::get('/GoToLogout', [

    'uses' => 'PlanManagementController@gotologout',
    'as' => 'user.logout'

]);


/*start bottle type*/

/*list bottle type*/

Route::get('ListBottleType',[
   'uses'=>'PlanManagementController@list_bottletype',
    'as'=>'bottletype.list'
]);

/*add bottle type*/

Route::get('/AddBottleType', function () {

    return view('bottle_type_master_add');

});


/*store bottle type*/

Route::post('StoreBottleType',[
    'uses'=>'PlanManagementController@store_bottletype',
    'as'=>'bottletype.store'
]);


/*delete bottle type*/

Route::post('DeleteBottleType',[
   'uses'=>'PlanManagementController@destroy_bottletype',
   'as'=>'bottletype.delete'
]);

/*show bottle type*/

Route::get('ShowBottleType/{id}',[
   'uses'=>'PlanManagementController@show_bottletype',
   'as'=>'bottletype.show'
]);

/*edit bottle type*/

Route::post('EditBottleType',[
    'uses'=>'PlanManagementController@edit_bottletype',
    'as'=>'bottletype.edit'
]);



/*end bottle type*/




/*start paln master*/

/*list plan master*/

Route::get('ListPlan',[
    'uses'=>'PlanManagementController@list_plan',
    'as'=>'plan.list'
]);

/*add plan master*/

Route::get('AddPlan',[
    'uses'=>'PlanManagementController@add_bottleforplan',
    'as'=>'plan.add'
]);


/*store plan master*/

Route::post('Storeplan',[
    'uses'=>'PlanManagementController@store_plan',
    'as'=>'plan.store'
]);


/*delete plan master*/

Route::post('Deleteplan',[
    'uses'=>'PlanManagementController@destroy_plan',
    'as'=>'plan.delete'
]);

/*show plan master*/

Route::get('Showplan/{id}',[
    'uses'=>'PlanManagementController@show_plan',
    'as'=>'plan.show'
]);

/*edit plan master*/

Route::post('Editplan',[
    'uses'=>'PlanManagementController@edit_plan',
    'as'=>'plan.edit'
]);



/*end plan master*/

/*start country*/

//list country

Route::get('ListCountry',[
    'uses'=>'PlanManagementController@list_country',
    'as'=>'country.list'
]);

//add country

Route::get('/AddCountry', function () {

    return view('country_add');

});

//store country

Route::post('StoreCountry',[
    'uses'=>'PlanManagementController@store_country',
    'as'=>'country.store'
]);

//delete country

Route::post('DeleteCountry',[
    'uses'=>'PlanManagementController@destroy_country',
    'as'=>'country.delete'
]);

//show country

Route::get('ShowCountry/{id}',[
    'uses'=>'PlanManagementController@show_country',
    'as'=>'country.show'
]);

//edit country

Route::post('EditCountry',[
    'uses'=>'PlanManagementController@edit_country',
    'as'=>'country.edit'
]);


/*start state*/

//list state

Route::get('ListState',[
    'uses'=>'PlanManagementController@list_state',
    'as'=>'state.list'
]);

//add state

Route::get('/AddState',[
    'uses'=>'PlanManagementController@add_countryforstate',
    'as'=>'state.add'
]);

//store state

Route::post('StoreState',[
    'uses'=>'PlanManagementController@store_state',
    'as'=>'state.store'
]);

//delete state
Route::post('DeleteState',[
    'uses'=>'PlanManagementController@destroy_state',
    'as'=>'state.delete'
]);

//show state

Route::get('ShowState/{id}',[
    'uses'=>'PlanManagementController@show_state',
    'as'=>'state.show'
]);

//edit state

Route::post('EditState',[
    'uses'=>'PlanManagementController@edit_state',
    'as'=>'state.edit'
]);




/*end state*/


/*start city*/

//list city

Route::get('ListCity',[
    'uses'=>'PlanManagementController@list_city',
    'as'=>'city.list'
]);

//add city

Route::get('/AddCity',[
    'uses'=>'PlanManagementController@add_stateforcity',
    'as'=>'city.add'
]);

//store city

Route::post('StoreCity',[
    'uses'=>'PlanManagementController@store_city',
    'as'=>'city.store'
]);

//delete city

Route::post('DeleteCity',[
    'uses'=>'PlanManagementController@destroy_city',
    'as'=>'city.delete'
]);

//show city

Route::get('ShowCity/{id}',[
    'uses'=>'PlanManagementController@show_city',
    'as'=>'city.show'
]);

//edit city

Route::post('EditCity',[
    'uses'=>'PlanManagementController@edit_city',
    'as'=>'city.edit'
]);




/*end state*/

/*start dilevery boy master*/

//list delivery boy master

Route::get('ListDeliveryBoy',[
    'uses'=>'PlanManagementController@list_deliveryboy',
    'as'=>'deliveryboy.list'
]);


//add delivery boy master

Route::get('AddDeliveryBoy',[
    'uses'=>'PlanManagementController@add_deliveryboy',
    'as'=>'deliveryboy.add'
]);

//store delivery boy master

Route::post('/StoreDeliveryBoy',[
   'uses'=> 'PlanManagementController@store_deliveryboymaster',
    'as'=> 'deliveryboy.store'
]);

//delete delivery boy master
Route::post('DeleteDeliveryBoy',[
    'uses'=>'PlanManagementController@destroy_deliveryboymaster',
    'as'=>'deliveryboy.delete'
]);

//show delivery boy master

Route::get('showDeliveryBoy/{id}',[
    'uses'=>'PlanManagementController@show_deliveryboymaster',
    'as'=>'deliveryboy.show'
]);

//edit delivery boy master

Route::post('EditDeliveryBoyr',[
    'uses'=>'PlanManagementController@edit_deliveryboymaster',
    'as'=>'deliveryboy.edit'
]);


/*end delivery boy master*/



/*start customer*/

//list customer

Route::get('ListCustomer',[
    'uses'=>'PlanManagementController@list_customer',
    'as'=>'customer.list'
]);


Route::post('ListCustomerShow',[
    'uses'=>'PlanManagementController@list_customer_show',
    'as'=>'customer.list.show'
]);

//add customer

Route::get('AddCustomer',[
    'uses'=>'PlanManagementController@add_areaforcustomer',
    'as'=>'customer.add'
]);

//store customer

Route::post('StoreCustomer',[
    'uses'=>'PlanManagementController@store_customer',
    'as'=>'customer.store'
]);

//destroy customer

Route::post('DeleteCustomer',[
    'uses'=>'PlanManagementController@destroy_customer',
    'as'=>'customer.delete'
]);

//show customer

Route::get('showCustomer/{id}',[
    'uses'=>'PlanManagementController@show_customer',
    'as'=>'customer.delete'
]);

//edit customer

Route::post('EditCustomer',[
    'uses'=>'PlanManagementController@edit_customer',
    'as'=>'customer.edit'
]);




/*end customer*/

Route::get('ListArea',[
    'uses'=>'PlanManagementController@list_area',
    'as'=>'area.list'
]);

Route::get('AddArea',[
    'uses'=>'PlanManagementController@Add_cityforarea',
    'as'=>'area.add'
]);

Route::post('StoreArea',[
    'uses'=>'PlanManagementController@store_area',
    'as'=>'area.store'
]);

Route::post('DeleteArea',[
    'uses'=>'PlanManagementController@destory_area',
    'as'=>'area.delete'
]);

Route::get('ShowArea/{id}',[
    'uses'=>'PlanManagementController@show_area',
    'as'=>'area.show'
]);

Route::post('EditArea',[
    'uses'=>'PlanManagementController@edit_area',
    'as'=>'area.edit'
]);





Route::get('ListMonthlyBottleAllocation',[
    'uses'=>'PlanManagementController@list_MonthlyBottleAllocation',
    'as'=>'MonBoyAll.list'
]);

Route::get('/AddMonthlyBottleAllocation', function () {

    return view('monthly_bottle_allocation_add');

});



/*start customer plan*/

/*list customer plan*/

Route::get('ListCustomerPlan',[
    'uses'=>'PlanManagementController@list_customerplan',
    'as'=>'CustomerPlan.list'
]);

/*add bottle type*/

Route::get('/AddCustomerPlan',[
    'uses'=>'PlanManagementController@Add_customerplan',
    'as'=>'CustomerPlan.add'
]);



/*store bottle type*/

Route::post('StoreCustomerPlan',[
    'uses'=>'PlanManagementController@store_customerplan',
    'as'=>'CustomerPlan.store'
]);


/*delete bottle type*/

Route::post('DeleteCustomerPlan',[
    'uses'=>'PlanManagementController@destroy_customerplan',
    'as'=>'CustomerPlan.delete'
]);

/*show bottle type*/

Route::get('ShowCustomerPlan/{id}',[
    'uses'=>'PlanManagementController@show_customerplan',
    'as'=>'CustomerPlan.show'
]);

/*edit bottle type*/

Route::post('EditCustomerPlan',[
    'uses'=>'PlanManagementController@edit_customerplan',
    'as'=>'CustomerPlan.edit'
]);

// selected coutry state list
Route::get('/selected_planlist', function () {

    $input = Input::get('option');
    $obj = DB::table('plan_masters')
        ->where('plan_masters.Id', '=', $input)
        ->where('Enabled', '=', 0)
        ->orderBy('Name')
        ->get();
    return Response::json($obj, 200);


});



/*end bottle type*/

/*start delivery boy base bottle*/

//list delivery boy base bottle

Route::get('ListDeliveryBoyBaseBottle',[
    'uses'=>'PlanManagementController@list_DeliveryBoyBaseBottle',
    'as'=>'DeliveryBoyBaseBottle.list'
]);

/*add delivery boy base bottle*/

Route::get('/AddDeliveryBoyBaseBottle',[
    'uses'=>'PlanManagementController@Add_DeliveryBoyBaseBottle',
    'as'=>'DeliveryBoyBaseBottle.add'
]);



/*store delivery boy base bottle*/

Route::post('StoreDeliveryBoyBaseBottle',[
    'uses'=>'PlanManagementController@store_DeliveryBoyBaseBottle',
    'as'=>'DeliveryBoyBaseBottle.store'
]);


/*delete delivery boy base bottle*/

Route::post('DeleteDeliveryBoyBaseBottle',[
    'uses'=>'PlanManagementController@destroy_DeliveryBoyBaseBottle',
    'as'=>'DeliveryBoyBaseBottle.delete'
]);

/*show delivery boy base bottle*/

Route::get('ShowDeliveryBoyBaseBottle/{id}',[
    'uses'=>'PlanManagementController@show_DeliveryBoyBaseBottle',
    'as'=>'DeliveryBoyBaseBottle.show'
]);

/*edit delivery boy base bottle*/

Route::post('EditDeliveryBoyBaseBottle',[
    'uses'=>'PlanManagementController@edit_DeliveryBoyBaseBottle',
    'as'=>'DeliveryBoyBaseBottle.edit'
]);

/*end delivery boy base bottle*/



/*start dealer*/

//list dealer

Route::get('ListDealer',[
    'uses'=>'PlanManagementController@list_dealer',
    'as'=>'dealer.list'
]);

//add dealer

Route::get('AddDealer',[
    'uses'=>'PlanManagementController@Add_areafordealer',
    'as'=>'dealer.add'
]);

//store dealer

Route::post('StoreDealer',[
    'uses'=>'PlanManagementController@store_dealer',
    'as'=>'dealer.store'
]);

//delete dealer

Route::post('DeleteDealer',[
    'uses'=>'PlanManagementController@destroy_dealer',
    'as'=>'dealer.delete'
]);

//show dealer

Route::get('ShowDealer/{id}',[
    'uses'=>'PlanManagementController@show_dealer',
    'as'=>'dealer.show'
]);

//edit dealer

Route::post('EditDealer',[
    'uses'=>'PlanManagementController@edit_dealer',
    'as'=>'dealer.edit'
]);


/*end dealer*/



/*start dealer plan relation*/

//list dealer plan relation

Route::get('ListDealerPlanRel',[
    'uses'=>'PlanManagementController@list_dealer_plan_rel',
    'as'=>'DealerPlanRel.list'
]);

//add dealer plan relation

Route::get('AddDealerPlanRel',[
    'uses'=>'PlanManagementController@Add_dealer_plan_rel',
    'as'=>'DealerPlanRel.add'
]);

//store dealer plan relation

Route::post('StoreDealerPlanRel',[
    'uses'=>'PlanManagementController@store_dealer_plan_rel',
    'as'=>'DealerPlanRel.store'
]);

//delete dealer plan relation

Route::post('DeleteDealerPlanRel',[
    'uses'=>'PlanManagementController@destroy_dealer_plan_rel',
    'as'=>'DealerPlanRel.delete'
]);

//show dealer plan relation

Route::get('ShowDealerPlanRel/{id}',[
    'uses'=>'PlanManagementController@show_dealer_plan_rel',
    'as'=>'DealerPlanRel.show'
]);

//edit dealer plan relation

Route::post('EditDealerPlanRel',[
    'uses'=>'PlanManagementController@edit_dealer_plan_rel',
    'as'=>'DealerPlanRel.edit'
]);


/*Route::get('/getDealerBottles', function () {

    $input = Input::get('option');
    $obj = DB::table('bottel_type_masters')
        ->where('bottel_type_masters.Name', '=', $input)
        ->where('bottel_type_masters.Enabled', '=', '0')
        ->get();
    return Response::json($obj, 200);


});*/


/*end dealer plan relation*/


/*start delivery boy area relation*/

//list delivery boy  area relation

Route::get('ListDelBoyAraRel',[
    'uses'=>'PlanManagementController@list_delivery_boy_area_relation',
    'as'=>'DelBoyAraRel.list'
]);

//add delivery boy area relation

Route::get('AddDelBoyAreaRel',[
   'uses'=>'PlanManagementController@add_delivery_boy_area_relation',
    'as'=>'DelBoyAreaRel.add'
]);

//store delivery boy area relation

Route::post('StoreDelBoyAreaRel',[
    'uses'=>'PlanManagementController@store_delivery_boy_area_relation',
    'as'=>'DelBoyAreaRel.store'
]);

//destroy delivery boy area relation

Route::post('DeleteDelBoyAreaRel',[
    'uses'=>'PlanManagementController@destroy_delivery_boy_area_relation',
    'as'=>'DelBoyAreaRel.delete'
]);

//show delivery boy area relation

Route::get('ShowDelBoyAreaRel/{id}',[
    'uses'=>'PlanManagementController@show_delivery_boy_area_relation',
    'as'=>'DelBoyAreaRel.show'
]);

//edit delivery boy ara relation

Route::post('EditDelBoyAreaRel',[
    'uses'=>'PlanManagementController@edit_delivery_boy_area_relation',
    'as'=>'DelBoyAreaRel.edit'
]);

/*end delivery boy  area relation*/






/*start customer boy daily relation*/

//list customer boy daily relation

Route::get('ListCusBoyDailyRel',[
    'uses'=>'PlanManagementController@list_customer_boy_daily_relation',
    'as'=>'CusBoyDailyRel.list'
]);

//add customer boy daily relation

Route::get('AddCusBoyDailyRel',[
    'uses'=>'PlanManagementController@add_customer_boy_daily_relation',
    'as'=>'CusBoyDailyRel.add'
]);

//store customer boy daily relation

Route::post('StoreCusBoyDailyRel',[
    'uses'=>'PlanManagementController@store_customer_boy_daily_relation',
    'as'=>'CusBoyDailyRel.store'
]);

//delete customer boy daily relation

Route::post('DeleteCusBoyDailyRel',[
    'uses'=>'PlanManagementController@destroy_customer_boy_daily_relation',
    'as'=>'CusBoyDailyRel.delete'
]);



//show customer boy daily relation

Route::get('ShowCusBoyDailyRel/{id}',[
    'uses'=>'PlanManagementController@show_customer_boy_daily_relation',
    'as'=>'CusBoyDailyRel.show'
]);

//edit customer boy daily relation

Route::post('EditCusBoyDailyRel',[
    'uses'=>'PlanManagementController@edit_customer_boy_daily_relation',
    'as'=>'CusBoyDailyRel.edit'
]);






/*start delivery boy in out*/

//list delivery boy in out

Route::get('ListDelBoyInOut',[
    'uses'=>'PlanManagementController@list_delivery_boy_in_out',
    'as'=>'DelBoyInOut.list'
]);

//add delivery boy in out

Route::get('AddDelBoyInOut',[
    'uses'=>'PlanManagementController@add_delivery_boy_in_out',
    'as'=>'DelBoyInOut.add'
]);

//store delivery boy in out

Route::post('StoreDelBoyInOut',[
    'uses'=>'PlanManagementController@store_delivery_boy_in_out',
    'as'=>'DelBoyInOut.store'
]);

//delete delivery boy in out

Route::post('DeleteDelBoyInOut',[
    'uses'=>'PlanManagementController@destroy_delivery_boy_in_out',
    'as'=>'DelBoyInOut.delete'
]);



//show delivery boy in out

Route::get('ShowDelBoyInOut/{id}',[
    'uses'=>'PlanManagementController@show_delivery_boy_in_out',
    'as'=>'DelBoyInOut.show'
]);

//edit delivery boy in out

Route::post('EditDelBoyInOut',[
    'uses'=>'PlanManagementController@edit_delivery_boy_in_out',
    'as'=>'DelBoyInOut.edit'
]);


/*end delivery boy in out*/

Route::get('/getPlanDetails', function () {

    $input = Input::get('option');
	$Plan = DB::table('plan_masters')
        ->where('Id','=',$input)
        ->where('Enabled', '=', 0)
        ->first();

    return Response::json($Plan, 200);
});


Route::get('/getCustDetails', function () {

    $input = Input::get('option');
	$Plan = DB::table('customer__masters')
        ->where('Id','=',$input)
        ->where('Enabled', '=', 0)
        ->first();

    return Response::json($Plan, 200);
});


Route::get('/getCustListFrmArea', function () {

    $input = Input::get('option');
    $Plan = DB::table('customer__masters')
        ->where('Area_Id', '=', $input)
        ->where('Enabled', '=', 0)
		->orderBy('Agency_Name')
        ->get();

    return Response::json($Plan, 200);
});


/*end customer delivery  boy relation*/




/*start dealer daily transaction*/

//list dealer daily transaction

Route::get('ListDeaDailyTran',[
   'uses'=>'PlanManagementController@list_dealer_daily_transaction',
   'as'=>'DeaDailyTran.list'
]);

//add dealer daily transaction

Route::get('AddDeaDailyTran',[
    'uses'=>'PlanManagementController@add_dealer_daily_transaction',
    'as'=>'DeaDailyTran.add'
]);


//store dealer daily transaction

Route::post('StoreDeaDailyTran',[
    'uses'=>'PlanManagementController@store_dealer_daily_transaction',
    'as'=>'DeaDailyTran.store'
]);

//destroy dealer daily transaction

Route::post('DeleteDeaDailyTran',[
    'uses'=>'PlanManagementController@destroy_dealer_daily_transaction',
    'as'=>'DeaDailyTran.delete'
]);

//show dealer daily transaction

Route::get('ShowDeaDailyTran/{id}',[
    'uses'=>'PlanManagementController@show_dealer_daily_transaction',
    'as'=>'DeaDailyTran.show'
]);

//edit dealer daily transaction

Route::post('EditDeaDailyTran',[
    'uses'=>'PlanManagementController@edit_dealer_daily_transaction',
    'as'=>'DeaDailyTran.edit'
]);

/*end dealer daily transaction*/



/*start attendance*/

//list attendance

Route::get('ListAttendance',[
    'uses'=>'PlanManagementController@list_attendance',
    'as'=>'attendance.list'
]);
Route::post('ListAttendanceShow',[
    'uses'=>'PlanManagementController@list_attendance_show',
    'as'=>'attendance_list.show'
]);
//store attendance

Route::post('StoreAttendance',[
    'uses'=>'PlanManagementController@store_attendance',
    'as'=>'attendance.store'
]);

//add attendance

Route::get('AddAttendance',[
    'uses'=>'PlanManagementController@add_attendance',
    'as'=>'attendance.store_attendance'
]);

// Add customer Daily transaction

Route::get('AddCustDailyTransaction',[
    'uses'=>'PlanManagementController@add_cust_daily_transaction',
    'as'=>'cust_daily_transaction.add'
]);

//delete attendance

Route::post('DeleteAttendance',[
    'uses'=>'PlanManagementController@destroy_attendance',
    'as'=>'attendance.delete'
]);

//show attendance

Route::get('ShowAttendance/{id}',[
    'uses'=>'PlanManagementController@show_attendace',
    'as'=>'attendance.show'
]);

//edit attendance

Route::post('EditAttendance',[
    'uses'=>'PlanManagementController@edit_attendance',
    'as'=>'attendance.edit'
]);

/*end attendance*/


/*start customer plan bottle allocated*/

//list customer plan bottle allocated

Route::get('ListCustPlanBottleAlloc',[
   'uses'=> 'PlanManagementController@list_customer_plan_bottle_allocated',
    'as'=>'CustPlanBottleAlloc.list'
]);

//add customer plan bottle allocated

Route::get('AddCustPlanBottleAlloc',[
    'uses'=> 'PlanManagementController@add_customer_plan_bottle_allocated',
    'as'=>'CustPlanBottleAlloc.add'
]);

//store customer plan bottle allocated

Route::post('StoreCustPlanBottleAlloc',[
    'uses'=> 'PlanManagementController@store_customer_plan_bottle_allocated',
    'as'=>'CustPlanBottleAlloc.store'
]);

//destroy customer plan bottle allocated

Route::post('DeleteCustPlanBottleAlloc',[
    'uses'=> 'PlanManagementController@destroy_customer_plan_bottle_allocated',
    'as'=>'CustPlanBottleAlloc.destroy'
]);

//show customer plan bottle allocated

Route::get('ShowCustPlanBottleAlloc/{id}',[
    'uses'=> 'PlanManagementController@show_customer_plan_bottle_allocated',
    'as'=>'CustPlanBottleAlloc.show'
]);

//edit customer plan bottle allocated

Route::post('EditCustPlanBottleAlloc',[
    'uses'=> 'PlanManagementController@edit_customer_plan_bottle_allocated',
    'as'=>'CustPlanBottleAlloc.edit'
]);

/*end customer plan bottle alloacated*/

/* Invoice Menu */
Route::get('ListCustInvoice',[
    'uses'=>'PlanManagementController@list_CustInvoice',
    'as'=>'custInvoice.list'
]);

Route::get('ListDealerInvoice',[
    'uses'=>'PlanManagementController@list_DealerInvoice',
    'as'=>'DealerInvoice.list'
]);

Route::post('DeleteInvoiceDealer',[
    'uses'=>'PlanManagementController@destroy_invoice_dealer',
    'as'=>'InvoiceDealer.delete'
]);


Route::post('DeleteInvoiceCustomer',[
    'uses'=>'PlanManagementController@destroy_Invoice_Customer',
    'as'=>'InvoiceCustomer.delete'
]);

Route::get('GenerateInvoice',[
	'uses'=>'PlanManagementController@Invoice_Genrate',
	'as'=>'Generate.Invoice'
]);

Route::post('GenerateInvoiceStore',[
    'uses'=> 'PlanManagementController@Invoice_Generate_Store',
    'as'=>'Ganerate.Invoice.Store'
]);

Route::get('ListCustColl',[
    'uses'=>'PlanManagementController@Customer_Collection',
    'as'=>'Custcoll.list'
]);

Route::post('ListCustCollShow',[
    'uses'=>'PlanManagementController@Customer_Collection_Show',
    'as'=>'Custcoll_list.show'
]);

Route::get('ListDealerColl',[
    'uses'=>'PlanManagementController@Dealer_Collection',
    'as'=>'DealerColl.list'
]);

Route::get('ListMonAtte',[
    'uses'=>'PlanManagementController@Monthly_Attendance',
    'as'=>'MontAtte.list'
]);

Route::post('MonthlyAttendanceShow',[
    'uses'=> 'PlanManagementController@Monthly_Attendance_Show',
    'as'=>'MontAtte.list.Show'
]);

Route::get('ListDealerTrans',[
    'uses'=>'PlanManagementController@Dealer_Transaction',
    'as'=>'Dealertrans.list'
]);

// Show attendance in Edit mode
Route::get('EditAttendanceSingle/{id}',[
    'uses'=> 'PlanManagementController@Edit_Attendance_Single',
    'as'=>'Edit.AttendanceSingle'
]);

// Blank Attendance sheet
Route::get('rptBlankAttSheet',[
    'uses'=>'PlanManagementController@rptBlank_Att_Sheet',
    'as'=>'rptBlankAttSheet.list'
]);

Route::post('rptBlankAttSheetShow',[
    'uses'=> 'PlanManagementController@rptBlank_Att_Sheet_Show',
    'as'=>'rptBlankAttSheet.list.Show'
]);

// Customer wise report
Route::get('rptCustReport',[
    'uses'=>'PlanManagementController@rptCust_Report',
    'as'=>'rptCustReport.list'
]);

Route::post('rptCustReportShow',[
    'uses'=> 'PlanManagementController@rptCust_Report_Show',
    'as'=>'rptCustReport.list.Show'
]);

// Next Day Bottle count
Route::get('rptNextDayBottleCount',[
    'uses'=>'PlanManagementController@rptNext_Day_Bottle_Count',
    'as'=>'rptNextDayBottleCount.list'
]);

Route::post('rptNextDayBottleCountShow',[
    'uses'=> 'PlanManagementController@rptNext_Day_Bottle_Count_Show',
    'as'=>'rptNextDayBottleCount.list.Show'
]);

// Daily Bottles Trans Report
Route::get('rptDailyBottlesTrans',[
    'uses'=>'PlanManagementController@rptDeaily_Bottles_Trans',
    'as'=>'rptDailyBottlesTrans.list'
]);

Route::post('rptDailyBottlesTransShow',[
    'uses'=> 'PlanManagementController@rptDeaily_Bottles_Trans_Show',
    'as'=>'rptDailyBottlesTrans.list.Show'
]);

// Dealer Payment collection from with Invoice Id

Route::get('DealerPaymentCollection/{id}',[
    'uses'=>'PlanManagementController@Dealer_Payment_Collection',
    'as'=>'DealerPaymentCollection.view'
]);


Route::post('StoreDealerPaymentCollection',[
    'uses'=>'PlanManagementController@store_Dealer_Payment_Collection',
    'as'=>'DealerPaymentCollection.store'
]);

// Customer Payment collection from with Invoice Id

Route::get('CustomerPaymentCollection/{id}',[
    'uses'=>'PlanManagementController@Customer_Payment_Collection',
    'as'=>'CustomerPaymentCollection.view'
]);


Route::post('StoreCustomerPaymentCollection',[
    'uses'=>'PlanManagementController@store_Customer_Payment_Collection',
    'as'=>'CustomerPaymentCollection.store'
]);

// Dealer Invoice Prit
Route::get('DealerInvoicePrint/{id}',[
    'uses'=>'PlanManagementController@rptDealer_Invoice_Print',
    'as'=>'DealerInvoice.Print'
]);

// Customer Invoice Prit
Route::get('CustomerInvoicePrint/{id}',[
    'uses'=>'PlanManagementController@rptCustomer_Invoice_Print',
    'as'=>'CustomerInvoice.Print'
]);

// Collection Report Summary Group By Area
Route::get('rptCollectionSummaryGroupByArea',[
    'uses'=>'PlanManagementController@rptCollection_Summary_Group_By_Area',
    'as'=>'rptCollectionSummaryGroupByArea.list'
]);

Route::post('rptCollectionSummaryGroupByAreaShow',[
    'uses'=> 'PlanManagementController@rptCollection_Summary_Group_By_Area_Show',
    'as'=>'rptCollectionSummaryGroupByArea.list.Show'
]);

// Collection Report Area Wise
Route::get('rptCollectionSummaryAreaWise',[
    'uses'=>'PlanManagementController@rptCollection_Summary_Area_Wise',
    'as'=>'rptCollectionSummaryAreaWise.list'
]);

Route::post('rptCollectionSummaryAreaWiseShow',[
    'uses'=> 'PlanManagementController@rptCollection_Summary_Area_Wise_Show',
    'as'=>'rptCollectionSummaryAreaWise.list.Show'
]);

// Collection Report For Dealer
Route::get('rptDealerCollection',[
    'uses'=>'PlanManagementController@rptDealer_Collection',
    'as'=>'rptDealerCollection.list'
]);

Route::post('rptDealerCollectionShow',[
    'uses'=> 'PlanManagementController@rptDealer_Collection_Show',
    'as'=>'rptDealerCollectionShow.list.Show'
]);

Route::post('DeleteAreaSA',[
    'uses'=>'PlanManagementController@destory_area_sa',
    'as'=>'area.delete.sa'
]);

/*delete bottle type*/

Route::post('DeleteBottleTypeSA',[
   'uses'=>'PlanManagementController@destroy_bottletype_sa',
   'as'=>'bottletype.delete.sa'
]);

// Delivery Boy Daily Report
Route::get('rptDBDaily',[
    'uses'=>'PlanManagementController@rptDB_Daily',
    'as'=>'rptDBDaily.list'
]);

Route::post('rptDBDailyShow',[
    'uses'=> 'PlanManagementController@rptDB_Daily_Show',
    'as'=>'rptDBDaily.list.Show'
]);

// Delivery Boy Monthly Report
Route::get('rptDBMonthly',[
    'uses'=>'PlanManagementController@rptDB_Monthly',
    'as'=>'rptDBMonthly.list'
]);

Route::post('rptDBMonthlyShow',[
    'uses'=> 'PlanManagementController@rptDB_Monthly_Show',
    'as'=>'rptDBMonthly.list.Show'
]);

// Dealer Transaction Report between Dates
Route::get('rptDealerDateWiseTrans',[
    'uses'=>'PlanManagementController@rptDealer_DateWise_Trans',
    'as'=>'rptDealerDateWiseTrans.list'
]);

Route::post('rptDealerDateWiseTransShow',[
    'uses'=> 'PlanManagementController@rptDealer_DateWise_Trans_Show',
    'as'=>'rptDealerDateWiseTrans.list.Show'
]);

//// Dealer Rate Card
Route::get('rptDealerRateCard',[
    'uses'=>'PlanManagementController@rptDealer_Rate_Card',
    'as'=>'rptDealerRateCard.list'
]);

/*  Combobox return */
// Get the Delivery boy from area_id
Route::get('/getDBFrmArea', function () {

    $input = Input::get('option');
    $obj = DB::table('delivery_boy_masters as db')
		->join('delivery_boy_area_relations as da','da.Delivery_Boy_Id','=','db.Id')
        ->where('da.Area_Id', '=', $input)
		->select('db.Boy_Name','db.Id','da.Area_Id')
        //->where('state_masters.Enabled', '=', '0')
       // ->orderBy('state_name')
        ->get();
    return Response::json($obj, 200);
});

/*start Collector*/

//list Collector

Route::get('ListCollector',[
    'uses'=>'PlanManagementController@list_collector',
    'as'=>'collector.list'
]);

//add Collector

Route::get('/AddCollector', function () {

    return view('collector_add');

});

//store Collector

Route::post('StoreCollector',[
    'uses'=>'PlanManagementController@store_collector',
    'as'=>'collector.store'
]);

//delete Collector

Route::post('DeleteCollector',[
    'uses'=>'PlanManagementController@destroy_collector',
    'as'=>'collector.delete'
]);

//show Collector

Route::get('ShowCollector/{id}',[
    'uses'=>'PlanManagementController@show_collector',
    'as'=>'collector.show'
]);

//edit Collector

Route::post('EditCollector',[
    'uses'=>'PlanManagementController@edit_collector',
    'as'=>'collector.edit'
]);

Route::get('CreateUserCollector/{id}',[
    'uses'=>'PlanManagementController@create_user_collector',
    'as'=>'create_user.collector'
]);
/* End Collector */

// Report : New Customer started between two dates
Route::get('rptCustNewStart',[
    'uses'=>'PlanManagementController@rptCust_New_Start',
    'as'=>'rptCustNewStart.list'
]);

Route::post('rptCustNewStartShow',[
    'uses'=> 'PlanManagementController@rptCust_New_Start_Show',
    'as'=>'rptCustNewStart.list.Show'
]);

// Report : Closed Customer started between two dates
Route::get('rptCustClosed',[
    'uses'=>'PlanManagementController@rptCust_Closed',
    'as'=>'rptCustClosed.list'
]);

Route::post('rptCustClosedShow',[
    'uses'=> 'PlanManagementController@rptCust_Closed_Show',
    'as'=>'rptCustClosed.list.Show'
]);

// Customer Invoice list Area wise : This will show the customers with total pending by area
// This will also filtered with collector's login
Route::get('ListCustInvAreaWise',[
    'uses'=>'PlanManagementController@Cust_Inv_Area_Wise_List',
    'as'=>'CustInvAreaWise.list'
]);

Route::post('ListCustInvAreaWiseShow',[
    'uses'=>'PlanManagementController@Cust_Inv_Area_Wise_List_Show',
    'as'=>'CustInvAreaWise.list.show'
]);

// Report : Customer Ledger
Route::get('rptCustLedger',[
    'uses'=>'PlanManagementController@rptCust_Ledger',
    'as'=>'rptCustLedger.list'
]);

Route::post('rptCustLedgerShow',[
    'uses'=> 'PlanManagementController@rptCust_Ledger_Show',
    'as'=>'rptCustLedger.Show'
]);

// Report : Dealer Ledger
Route::get('rptDealerLedger',[
    'uses'=>'PlanManagementController@rptDealer_Ledger',
    'as'=>'rptDealerLedger.list'
]);

Route::post('rptDealerLedgerShow',[
    'uses'=> 'PlanManagementController@rptDealer_Ledger_Show',
    'as'=>'rptDealerLedger.Show'
]);

// List Closed customers
Route::get('ListClosedCustomer',[
    'uses'=>'PlanManagementController@list_closed_customer',
    'as'=>'closed_customer.list'
]);

/*  Combobox return */
// Get the Plan as per Plan Type
Route::get('/getPlanByType', function () {

    $input = Input::get('option');
    $obj = DB::table('plan_masters')
	   ->where('Plan_Type', '=', $input)
		->select('Id','Name')
        ->get();
    return Response::json($obj, 200);
});


// Report : Monthly Attendance Report
Route::get('rptListMonAtte',[
    'uses'=>'PlanManagementController@rptMonthly_Attendance',
    'as'=>'rptMontAtte.list'
]);

Route::post('rptMonthlyAttendanceShow',[
    'uses'=> 'PlanManagementController@rptMonthly_Attendance_Show',
    'as'=>'rptMontAtte.list.Show'
]);

// csutomer Monthly Attendance list for Daily Parties
Route::get('ListDailyCustMonthlyAtt',[
    'uses'=>'PlanManagementController@List_DailyCust_Monthly_Att',
    'as'=>'ListDailyCustMonthlyAtt.list'
]);

Route::post('ListDailyCustMonthlyShow',[
    'uses'=> 'PlanManagementController@List_DailyCust_Monthly_Att_Show',
    'as'=>'ListDailyCustMonthlyAtt.list.Show'
]);

Route::get('ModelTest',[
	'uses'=>'PlanManagementController@Model_Test',
    'as'=>'Model.Test'
]);
