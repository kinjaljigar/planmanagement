<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

//DB::enableQueryLog();
//dd(DB::getQueryLog());
            

class PlanManagementController extends Controller
{
    private $attributes;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('LoginCheck', ['except' => [
            'check_credential'
            ]
        ]);
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    // this check login credential

    public function check_credential(Request $request)
    {

          
		$Unm = $request->txt_username;
		$Pwd = $request->txt_password;
		$res = DB::table('user_master')
			->where('User_Name',$Unm)
			->where('Password',$Pwd)
			->get()
			->first();
		// if(count($res)==0)
		// {
            // return redirect('/')->with('error', "Please Enter Correct UserName Or Password");
		// }
		// else
		// {
		if(isset($res) )
		{
			session()->put('username', $request->txt_username);
            //session()->put('password', $request->txt_password);
			session()->put('role',$res->Role);
			session()->put('User_Id',$res->User_Id);
            $sql="Select count(*) as cnt from customer__masters ";
			$sql .= " where Start_Date='" . date('y-m-d') . "'";
			$sql .= " And Enabled=0";
			$dbRes = DB::select($sql);
			$NewCust = $dbRes[0]->cnt;
			//$dbRow = mysqli_fetch_array($dbRes);
			
			$sql="Select count(*) as cnt from customer__masters ";
			$sql .= " where DoD='" . date('y-m-d') . "'";
			$sql .= " And Enabled=0";
			$dbRes = DB::select($sql);
			$ClosedCust = $dbRes[0]->cnt;
			
			$sql="Select count(*) as cnt from customer__masters ";
			$sql .= " where Enabled=0";
			$dbRes = DB::select($sql);
			$CustCount = $dbRes[0]->cnt;
			
			$sql = "Select sum(";
			
            return view('home')->with(
				[
					'NewCust' => $NewCust,
					'ClosedCust' => $ClosedCust,
					'CustCount' => $CustCount
					
				]
			);
			
		}
		else
		{
            return redirect('/')->with('error', 'Please Enter Correct UserName Or Password');
		}

    }


    //this for check session

    public function check_session()
    {

       
        //if (session()->has('username') && session()->has('password')) {
        if (session()->has('username')) {

            $sql="Select count(*) as cnt from customer__masters ";
			$sql .= " where Start_Date='" . date('y-m-d') . "'";
			$sql .= " And Enabled=0";
			$dbRes = DB::select($sql);
			$NewCust = $dbRes[0]->cnt;
			//$dbRow = mysqli_fetch_array($dbRes);
			
			$sql="Select count(*) as cnt from customer__masters ";
			$sql .= " where DoD='" . date('y-m-d') . "'";
			$sql .= " And Enabled=0";
			$dbRes = DB::select($sql);
			$ClosedCust = $dbRes[0]->cnt;
			
			$sql="Select count(*) as cnt from customer__masters ";
			$sql .= " where Enabled=0";
			$dbRes = DB::select($sql);
			$CustCount = $dbRes[0]->cnt;
			
            return view('home')->with(
				[
					'NewCust' => $NewCust,
					'ClosedCust' => $ClosedCust,
					'CustCount' => $CustCount
					
				]
			);

        } else {

            return view('login');
        }


    }


    //this for logout


    public function gotologout()
    {

        try {
            session()->remove('username');
            session()->remove('password');


            return redirect('/');

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    /*start bottle type*/

    /*list bottle type*/

    public function list_bottletype()
    {
        try {

            $bottle = DB::table('bottel_type_masters')
                ->where('bottel_type_masters.Enabled', '=', 0)
                ->get();


            return view('bottle_type_master_list')->with('bottle', $bottle);


        } catch (Exception $e) {


            return view('excaption');

        }
    }



    /*store bottle type*/

    public function store_bottletype(Request $request)
    {
        try {
            $current_time = Carbon::now()->toDateTimeString();

            $city = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Name')
                ->where('bottel_type_masters.Name', '=', $request->txt_bottlename)
                ->where('bottel_type_masters.Enabled', '=', '0')
                ->get()->count();

            /*if ($city > 0) {

                return redirect()->back()->withInput()
                    ->with('error', 'Bottle ' . $request->txt_bottlename . ' Alredy Exist');

            } else {*/
                $obj = DB::table('bottel_type_masters')
                    ->insert(['Name'=>$request->txt_bottlename,
                        'Rate'=>$request->txt_rate,
						'User'=>$request->txt_user,
                        'created_at' => $current_time]);
				if($request->txt_user == 'Dealer')
				{
					$BT = DB::table('bottel_type_masters')
						->where('Enabled','=',0)
						->orderby('Id','desc')
						->get()
						->first();
					$BT_Id = $BT->Id;
					
					$del = DB::table('dealer_masters')
						->get();
					foreach($del as $u)
					{
						$dbb=DB::table('dealer_plan_rels')
							->insert(['Dealer_Id'=>$u->Id,
								'Bottle_Id'=>$BT_Id,
								'Rate'=>$request->txt_rate,
								'No_of_bottle'=>1
							]);
					}
				}			
                return redirect('ListBottleType');
           // }


        } catch (Exception $e) {

			return $e->getMessage();
            //return view('excaption');

        }


    }


    public function destroy_bottletype(Request $request)
    {
        try {

            $user = DB::table('bottel_type_masters')->where('Id', $request->id)
                ->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));

            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }



        } catch (Exception $e) {


            return view('excaption');

        }


    }


    public function show_bottletype($id)
    {
        try {

            $user = DB::table('bottel_type_masters')->where('Id', '=', $id)->first();

            return view('bottle_type_master_edit')->with(['bottle' => $user]);

        } catch (Exception $e) {


            return view('excaption');

        }


    }

    //edit bottle type master

    public function edit_bottletype(Request $request)
    {
        try {

            $current_time = Carbon::now()->toDateTimeString();
			$Old_Data = DB::table('bottel_type_masters')
				->where('Id','=',$request->txt_id)
				->get()
				->first();
            $user = DB::table('bottel_type_masters')
                ->where('Id', $request->txt_id)
                ->update([
                    'Name'=>$request->txt_bottlename,
                    'Rate'=>$request->txt_rate,
					'User'=>$request->txt_user,
                    'updated_at' => $current_time]);

			//Check and change rate in dealer_plan_rels if rate is changed?
			if($request->txt_user=='Dealer')
			{
				if($request->txt_rate != $Old_Data->Rate && $Old_Data->User=='Dealer')
				{
					$del = DB::table('dealer_plan_rels')
						->where('dealer_plan_rels.Bottle_Id','=',$request->txt_id)
						->where('Rate','=',$Old_Data->Rate)
						->update(['Rate' => $request->txt_rate]);
						
					
				}
				else
				{
					$del = DB::table('dealer_masters')
						->get();
					foreach($del as $u)
					{
						$dbb=DB::table('dealer_plan_rels')
							->insert(['Dealer_Id'=>$u->Id,
								'Bottle_Id'=>$request->txt_id,
								'Rate'=>$request->txt_rate,
								'No_of_bottle'=>1
							]);
					}
				}
			}
            return redirect('ListBottleType')->with('success', "Record Updated Successfully");

        } catch (Exception $e) {

return $e->getMessage();
           // return view('excaption');

        }


    }


    /*start plan master*/

    /*list plan master*/

    public function list_plan()
    {
        try {

            $paln = DB::table('plan_masters')
                ->where('plan_masters.Enabled', '=', 0)
                ->get();


            return view('plan_list')->with('plan', $paln);


        } catch (Exception $e) {


            return view('excaption');

        }


    }


    /*store plan master*/

    public function store_plan(Request $request)
    {
        try {
            //for sunday

            if ($request->has('chk_sunday')) {

                $sunday = true;

            } else {

                $sunday = false;
            }

            //for monday

            if ($request->has('chk_monday')) {

                $monday = true;

            } else {

                $monday = false;
            }

            //for tuesday

            if ($request->has('chk_tuesday')) {

                $tuesday = true;

            } else {

                $tuesday = false;
            }

            //for wednesday

            if ($request->has('chk_wednesday')) {

                $wednesday = true;

            } else {

                $wednesday = false;
            }

            //for thursday

            if ($request->has('chk_thursday')) {

                $thursday = true;

            } else {

                $thursday = false;
            }

            //for firiday

            if ($request->has('chk_friday')) {

                $firiday = true;

            } else {

                $firiday = false;
            }

            //for saturday

            if ($request->has('chk_saturday')) {

                $saturday = true;

            } else {

                $saturday = false;
            }

            $current_time = Carbon::now()->toDateTimeString();

            $city = DB::table('plan_masters')
                ->select('plan_masters.Name')
                ->where('plan_masters.Name', '=', $request->txt_palnname)
                ->where('plan_masters.Enabled', '=', '0')
                ->get()->count();

            if ($city > 0) {

                return redirect()->back()->withInput()
                    ->with('error', 'Plan ' . $request->txt_palnname . ' Alredy Exist');

            } else {
                $user = DB::table('plan_masters')
                    ->insert([
                        'Name'=>$request->txt_palnname,
                        'Plan_Type'=>$request->txt_plantype,
                        'Rate'=>$request->txt_rate,
                        'Bottle_Type_Id'=>$request->txt_bottletype,
                        'Int_Sunday'=>$sunday,
                        'Int_Monday'=>$monday,
                        'Int_Tuesday'=>$tuesday,
                        'Int_Wednesday'=>$wednesday,
                        'Int_Thursday'=>$thursday,
                        'Int_Friday'=>$firiday,
                        'Int_Saturday'=>$saturday,
                        'created_at' => $current_time]);

                return redirect('ListPlan')->with('success', "Record Stored Successfully");                }


        }catch (Exception $e) {

            return $e->getMessage();
            //return view('excaption');

        }


    }

    //add bottle for plan

    public function add_bottleforplan()
    {
        try {
            $plan = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name','bottel_type_masters.User')
				->where('bottel_type_masters.User','=','DB')
                ->orderBy('Name')
                ->get();

            return view('plan_add')->with([
                'plans' => $plan,
            ]);

        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }
    }

    //delete plan

    public function destroy_plan(Request $request)
    {
        try {

            /*$user = DB::table('bottel_type_masters')->where('Id', $id)->delete();

            return redirect('ListBottleType')->with('success','Record Deleted Successfully');*/

            $user = DB::table('plan_masters')->where('Id', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }



        } catch (Exception $e) {


            return view('excaption');

        }


    }



    /*show plan master*/

    public function show_plan($id)
    {
        try {

            $user = DB::table('plan_masters')->where('Id', '=', $id)->first();

            $plan = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name','bottel_type_masters.User')
				->where('bottel_type_masters.User','=','DB')
                ->orderBy('Name')
                ->get();



            return view('plan_edit')->with(['plan' => $user,'bottle'=>$plan]);

        } catch (Exception $e) {


            return view('excaption');

        }


    }


    /*edit plan master*/

    public function edit_plan(Request $request)
    {
        try {

            $current_time = Carbon::now()->toDateTimeString();

            $user = DB::table('plan_masters')
                ->where('Id',$request->txt_id)->update([
                    'Name'=>$request->txt_palnname,
                    'Plan_Type'=>$request->txt_plantype,
                    'Rate'=>$request->txt_rate,
                    'Bottle_Type_Id'=>$request->txt_bottletype,
                    'Int_Sunday'=>$request->chk_sunday!= null ? true : false,
                    'Int_Monday'=>$request->chk_monday!= null ? true : false,
                    'Int_Tuesday'=>$request->chk_tuesday!= null ? true : false,
                    'Int_Wednesday'=>$request->chk_wednesday!= null ? true : false,
                    'Int_Thursday'=>$request->chk_thursday!= null ? true : false,
                    'Int_Friday'=>$request->chk_friday!= null ? true : false,
                    'Int_Saturday'=>$request->chk_saturday!= null ? true : false,
                    'updated_at' => $current_time]);

            return redirect('ListPlan')->with('success', "Record Updated Successfully");




        } catch (Exception $e) {

            return $e->getMessage();
           // return view('excaption');

        }


    }



    /*end plan master*/

    /*start country*/

    //list country

    public function list_country()
    {
        try {

            $countrys = DB::table('country_masters')
                ->where('Enabled', '=', 0)
                ->get();


            return view('country_list')->with('country', $countrys);


        } catch (Exception $e) {

            return $e->getMessage();
            //return view('excaption');

        }


    }

    //store country

    public function store_country(Request $request)
    {
        try {
            $current_time = Carbon::now()->toDateTimeString();

            $city = DB::table('country_masters')
                ->select('country_masters.Country_Name')
                ->where('country_masters.Country_Name', '=', $request->txt_countryname)
                ->where('country_masters.Enabled', '=', '0')
                ->get()->count();

            if ($city > 0) {

                return redirect()->back()->withInput()
                    ->with('error', 'Country ' . $request->txt_countryname . ' Alredy Exist');

            } else {
                $country = DB::table('country_masters')
                    ->insert(['Country_Name'=>$request->txt_countryname,
                        'created_at'=>$current_time]);

                return redirect('ListCountry')->with('success','Record Stored Successfully');


            }

        }catch (Exception $e)
        {
            return $e->getMessage();
            //return view('excaption');

        }
    }

    //delete country

    public function destroy_country(Request $request)
    {

        try {

            $user = DB::table('country_masters')->where('Id', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //show country

    public function show_country($id)
    {
        try {

            $user = DB::table('country_masters')->where('Id', '=', $id)->first();

            return view('coutry_edit')->with(['country' => $user]);

        } catch (Exception $e) {


            return view('excaption');

        }


    }

    //edit country

    public function edit_country(Request $request)
    {
        try {

            $current_time = Carbon::now()->toDateTimeString();

            $country = DB::table('country_masters')->where('Id',$request->txt_countryid)
                ->update(['Country_Name'=>$request->txt_countryname,
                    'created_at'=>$current_time]);

            return redirect('ListCountry')->with('success','Record Updated Successfully');



        }catch (Exception $e)
        {
            return $e->getMessage();
            //return view('excaption');

        }
    }

    /*end country*/

    /*start state*/

    //list state

    public function list_state()
    {
        try {

            $state = DB::table('state_masters')
                ->join('country_masters', 'state_masters.Country_Id',
                    '=', 'country_masters.Id')
                ->select('state_masters.*', 'country_masters.Country_Name')
                ->where('state_masters.Enabled', '=', 0)
                ->get();


            return view('state_list')->with('states', $state);


        } catch (Exception $e) {

            return $e->getMessage();
           // return view('excaption');

        }


    }

    //store state

    public function store_state(Request $request)
    {
        try {
            $current_time = Carbon::now()->toDateTimeString();

            $city = DB::table('state_masters')
                ->select('state_masters.State_Name')
                ->where('state_masters.State_Name', '=', $request->txt_statename)
                ->where('state_masters.Enabled', '=', '0')
                ->get()->count();

            if ($city > 0) {

                return redirect()->back()->withInput()
                    ->with('error', 'State ' . $request->txt_statename . ' Alredy Exist');

            } else {
                $state = DB::table('state_masters')
                    ->insert(['State_Name'=>$request->txt_statename,
                        'Country_Id'=>$request->txt_countryid,
                        'created_at'=>$current_time,
                    ]);


                return redirect('ListState')->with('success','Record Stored Successfully');


            }

        } catch (Exception $e) {

            return $e->getMessage();
            //return view('excaption');

        }
    }

    //delete state

    public function destroy_state(Request $request)
    {

        try {

            $user = DB::table('state_masters')->where('Id', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //add coutry for state

    public function add_countryforstate()
    {
        try {
            $customer = DB::table('country_masters')
                ->select('country_masters.Id', 'country_masters.Country_Name')
                ->where('country_masters.Enabled', '=', '0')
                ->orderBy('Country_Name')
                ->get();

            return view('state_add')->with([
                'country' => $customer,
            ]);

        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }
    }

    /*show plan master*/

    public function show_state($id)
    {
        try {

            $user = DB::table('state_masters')->where('Id', '=', $id)->first();

            $customer = DB::table('country_masters')
                ->select('country_masters.Id','country_masters.Country_Name')
                ->where('country_masters.Enabled', '=', '0')
                ->orderBy('Country_Name')
                ->get();

            return view('state_edit')->with(['state' => $user,'country' => $customer]);

        } catch (Exception $e) {


            return view('excaption');

        }


    }

    //store delivery boy master

    public function edit_state(Request $request)
    {
        try {

            $current_time = Carbon::now()->toDateTimeString();

            $deliveryboy = DB::table('state_masters')->where('Id',$request->txt_id)
                ->update(['State_Name'=>$request->txt_statename,
                    'Country_Id'=>$request->txt_countryid,
                    'updated_at'=>$current_time,
                ]);


            return redirect('ListState')->with('success','Record Updated Successfully');


        } catch (Exception $e) {

            return $e->getMessage();
            //return view('excaption');

        }
    }



    /*end state*/

    /*start city*/

    //list city

    public function list_city()
    {
        try {

            $state = DB::table('city_masters')
                ->join('state_masters', 'city_masters.State_Id',
                    '=', 'state_masters.Id')
                ->select('city_masters.*', 'state_masters.State_Name')
                ->where('city_masters.Enabled', '=', 0)

                ->get();


            return view('city_list')->with('cities', $state);


        } catch (Exception $e) {

            return $e->getMessage();
          //  return view('excaption');

        }


    }

    //store city

    public function store_city(Request $request)
    {
        try{

            $current_time = Carbon::now()->toDateTimeString();

            $city = DB::table('city_masters')
                ->select('city_masters.City_Name')
                ->where('city_masters.City_Name', '=', $request->txt_cityname)
                ->where('city_masters.Enabled', '=', '0')
                ->get()->count();

            if ($city > 0) {

                return redirect()->back()->withInput()
                    ->with('error', 'City ' . $request->txt_cityname . ' Alredy Exist');

            } else {
                $obj = DB::table('city_masters')
                    ->insert(['City_Name'=>$request->txt_cityname,
                        'State_Id'=>$request->txt_state,
                        'created_at' => $current_time]);


                return redirect('ListCity')->with('success','Record Stored Successfully');
            }


        } catch (Exception $e) {

            return $e->getMessage();
            //return view('excaption');

        }
    }

    //delete city

    public function destroy_city(Request $request)
    {

        try {

            $user = DB::table('city_masters')->where('Id', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //add state for city

    public function add_stateforcity()
    {
        try {
            $customer = DB::table('state_masters')
                ->select('state_masters.Id','state_masters.State_Name')
                ->where('state_masters.Enabled', '=', '0')
                ->orderBy('State_Name')
                ->get();

            return view('city_add')->with([
                'state' => $customer,
            ]);

        } catch (Exception $e) {


             return $e->getMessage();

          //  return view('excaption');

        }
    }

    /*show city*/

    public function show_city($id)
    {
        try {

            $user = DB::table('city_masters')->where('Id', '=', $id)->first();

            $customer = DB::table('state_masters')
                ->select('state_masters.Id','state_masters.State_Name')
                ->where('state_masters.Enabled', '=', '0')
                ->orderBy('State_Name')
                ->get();

            return view('city_edit')->with(['states' => $customer,'city' => $user]);

        } catch (Exception $e) {


            return view('excaption');

        }


    }

    //store city

    public function edit_city(Request $request)
    {
        try {

            $current_time = Carbon::now()->toDateTimeString();



                $obj = DB::table('city_masters')->where('Id',$request->txt_id)
                    ->update(['City_Name'=>$request->txt_cityname,
                        'State_Id'=>$request->txt_state,
                        'updated_at' => $current_time]);


                return redirect('ListCity')->with('success','Record Updated Successfully');



        } catch (Exception $e) {

            return $e->getMessage();
            //return view('excaption');

        }
    }



    /*end city*/

    /*start delivery boy master*/

    //list delivery boy master

    public function list_deliveryboy()
    {
        try {

            $deliveryboy = DB::table('delivery_boy_masters')
                ->where('Enabled', '=', 0)

                ->get();


            return view('delivery_boy_list')->with('deliveryboys', $deliveryboy);


        } catch (Exception $e) {


            return view('excaption');

        }


    }

    //add delivery boy master

    public function add_deliveryboy()
    {
        try {
            $bottle = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name','bottel_type_masters.User')
                ->where('Enabled', '=', 0)
                ->orderBy('Name')
                ->get();

            return view('delivery_boy_add')->with([
                'Bottles' => $bottle,
            ]);

        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }
    }


    //store delivery boy master

    public function store_deliveryboymaster(Request $request)
    {
        try {
            $current_time = Carbon::now()->toDateTimeString();

            $city = DB::table('delivery_boy_masters')
                ->select('delivery_boy_masters.Boy_Name')
                ->where('delivery_boy_masters.Boy_Name', '=', $request->txt_name)
                ->where('delivery_boy_masters.Enabled', '=', '0')
                ->get()->count();

            if ($city > 0) {

                return redirect()->back()->withInput()
                    ->with('error', 'Delivery Boy ' . $request->txt_name . ' Alredy Exist');

            } else {
                $deliveryboy = DB::table('delivery_boy_masters')
                    ->insert(['Boy_Name'=>$request->txt_name,
                        'Address'=>$request->txt_address,
                        'Phone_No'=>$request->txt_PhoneNo,
                        'Vehicle_No'=>$request->txt_VehicleNo != null ? $request->txt_VehicleNo : '',
                        'Vehical_Type'=>$request->txt_VehicleType != null ? $request->txt_VehicleType : '',
                        'Bottle_Id'=>$request->txtB ,
                        'created_at'=>$current_time
                    ]);


                $db = DB::table('delivery_boy_masters')
                    ->orderBy('Id','desc')
                    ->get()->first();
                $db_Id=$db->Id;

                $user = DB::table('bottel_type_masters')
					->where('bottel_type_masters.User','=','DB')
                    ->get();
                foreach($user as $u)
                {
                    $str = "txtB" . $u->Id;
                    $cnt = $request->$str;
					if(is_numeric($cnt))
					{
						if($cnt<>0)
						{
							$dbb=DB::table('delivery_boy_base_bottles')
								->insert(['Delivery_Boy_Id'=>$db_Id,
									'Bottle_Id'=>$u->Id,
									'Count'=>$cnt
								]);
						}
					}
                }

                return redirect('ListDeliveryBoy')->with('success','Record Stored Successfully');





            }

        } catch (Exception $e) {

            return $e->getMessage();
            //return view('excaption');

        }
    }

    //delete delivery boy master

    public function destroy_deliveryboymaster(Request $request)
    {

        try {

            $user = DB::table('delivery_boy_masters')->where('Id', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    /*show plan master*/

    public function show_deliveryboymaster($id)
    {
        try {

            $user = DB::table('delivery_boy_masters')->where('Id', '=', $id)->first();
			$d_id = $id;
            $bottle = DB::table('bottel_type_masters as b')
                ->select('b.Id', 'b.Name','d.Count')
                ->where('b.Enabled', '=', 0)
				->where('b.User','=','DB')
				->leftJoin('delivery_boy_base_bottles as d',function($join) use($d_id){
					$join->on('d.Bottle_Id','=','b.Id')
						->where('d.Delivery_Boy_Id','=',$d_id);
				})
                ->orderBy('Name')
                ->get();

            return view('delivery_boy_edit')->with(['deliveryboy' => $user,'bottles' => $bottle]);

        } catch (Exception $e) {

			return $e->getMessage();
            //return view('excaption');

        }


    }

    //store delivery boy master

    public function edit_deliveryboymaster(Request $request)
    {
        try {

            $current_time = Carbon::now()->toDateTimeString();

            $deliveryboy = DB::table('delivery_boy_masters')->where('Id',$request->txt_id)
                ->update(['Boy_Name'=>$request->txt_name,
                    'Address'=>$request->txt_address,
                    'Phone_No'=>$request->txt_PhoneNo,
                    'Vehicle_No'=>$request->txt_VehicleNo != null ? $request->txt_VehicleNo : '',
                    'Vehical_Type'=>$request->txt_VehicleType != null ? $request->txt_VehicleType : '',
                    'Bottle_Id'=>$request->txtB,
                    'updated_at'=>$current_time,
                ]);


            $db_Id=$request->txt_id;
			DB::delete('delete from delivery_boy_base_bottles where Delivery_Boy_Id = ?',[$db_Id]);
            $user = DB::table('bottel_type_masters')
				->where('bottel_type_masters.User','=','DB')
                ->get();
            foreach($user as $u)
            {
                $str = "txtB" . $u->Id;
                $cnt = $request->$str;
				if(is_numeric($cnt))
				{
					if($cnt<>0)
					{
						$dbb=DB::table('delivery_boy_base_bottles')
							->insert(['Delivery_Boy_Id'=>$db_Id,
								'Bottle_Id'=>$u->Id,
								'Count'=>$cnt
							]);
					}
				}
            }


            return redirect('ListDeliveryBoy')->with('success','Record Updated Successfully');


        } catch (Exception $e) {

            return $e->getMessage();
            //return view('excaption');

        }
    }

    /*end delivery boy master*/




    /*start customer*/

    //list customer

    public function list_customer()
    {
        try {

          //  Date::make('DoB')->format('DD/MM/YYYY');
			$Area_Sel=0;
			$Area = DB::table('area_masters')
					->where('Enabled','=',0)
					->orderBy('Area_Name')
					->get();
///DB::enableQueryLog();

            // $cust= DB::table('customer__masters')
                // ->join('area_masters','customer__masters.Area_Id','area_masters.Id')
              // //  ->join('plan_masters','customer__masters.Id','plan_masters.Id')
                // ->where('customer__masters.Enabled', '=', 0)
				// ->leftJoin('customer_plans','customer_plans.Cust_Id','=','customer__masters.Id')
				// ->leftJoin('plan_masters','plan_masters.Id','=','customer_plans.Plan_Id')
				// ->leftJoin('cust_plan_bottle_allocated as cpb','cpb.Cust_Plan_Id','=','customer_plans.Id')
				// ->leftJoin('bottel_type_masters','bottel_type_masters.Id','=','cpb.Bottle_Id')
                // ->select('customer__masters.*','area_masters.Area_Name','customer_plans.No_Bottle','plan_masters.Name as Plan','customer_plans.Rate','bottel_type_masters.Name as Bottle_Name','cpb.No_Of_Bottles')
                // ->get();
				
			$sql = "Select c.*,a.Area_Name, cp.No_Bottle,p.Name as Plan,cp.Rate ";
			$sql .= ", cpb1.No_Of_Bottles as Jug_20L";
			$sql .= ", cpb2.No_Of_Bottles as Bot_20L";
			//$sql .= ", Case when cpb1.No_Of_Bottles<>null then cpb1.No_Of_Bottles else 0 end as Jug_20L";
			//$sql .= ", Case when cpb2.No_Of_Bottles<>null then cpb2.No_Of_Bottles else 0 end as Bot_20L";
			
			$sql .= " From area_masters a, customer__masters c";
			$sql .= " left join customer_plans cp on cp.Cust_Id = c.Id";
			$sql .= " left join plan_masters p on p.Id=cp.Plan_Id";
			$sql .= " left join cust_plan_bottle_allocated cpb1 on cpb1.Cust_Plan_Id=cp.Id and cpb1.Bottle_Id=16";
			$sql .= " left join cust_plan_bottle_allocated cpb2 on cpb2.Cust_Plan_Id=cp.Id and cpb2.Bottle_Id=17";
			$sql .= " Where a.Id=c.Area_Id";
			$sql .= " and c.Enabled=0";
			//echo $sql;
			$cust = DB::select($sql);
//dd(DB::getQueryLog());

           // print_r($cust);


           /* $cust= DB::table('customer__masters')
                ->join('area_masters','customer__masters.Area_Id','area_masters.Id')
                ->where('customer__masters.Enabled', '=', 0)
                ->select('customer__masters.*','area_masters.Area_Name')
                ->select('customer__masters.DoB as DoB',
                    'date_format(customer__masters.DoB,%Y-%m-%d) as DoB')
                ->get();*/


            /*$cust = DB::table("customer__masters")
                ->join('area_masters','customer__masters.Area_Id','area_masters.Id')
                ->where(DB::raw("(DATE_FORMAT(customer__masters.DoB,'%d-%m-%y'))"),'=' ,'')
                ->select('customer__masters.*','area_masters.Area_Name')
                ->get();*/



           // print_r($cust);


            return view('customer_list')->with(['customer'=> $cust,
											'Area_Sel'=>$Area_Sel,
											'Area'=>$Area]);


        } catch (Exception $e) {

            return $e->getMessage();
          //  return view('excaption');

        }


    }
	
	
    public function list_customer_show(Request $request)
    {
        try {

          //  Date::make('DoB')->format('DD/MM/YYYY');
			$Area_Sel=$request->cmbArea;
			$Area = DB::table('area_masters')
					->where('Enabled','=',0)
					->orderBy('Area_Name')
					->get();

			if($Area_Sel==0)
			{
				// $cust= DB::table('customer__masters')
					// ->join('area_masters','customer__masters.Area_Id','area_masters.Id')
				  // //  ->join('plan_masters','customer__masters.Id','plan_masters.Id')
					// ->where('customer__masters.Enabled', '=', 0)
					// ->leftJoin('customer_plans','customer_plans.Cust_Id','=','customer__masters.Id')
					// ->leftJoin('plan_masters','plan_masters.Id','=','customer_plans.Plan_Id')
					// ->leftJoin('cust_plan_bottle_allocated as cpb','cpb.Cust_Plan_Id','=','plan_masters.Id')
				// ->leftJoin('bottel_type_masters','bottel_type_masters.Id','=','cpb.Bottle_Id')
                // ->select('customer__masters.*','area_masters.Area_Name','customer_plans.No_Bottle','plan_masters.Name as Plan','customer_plans.Rate','bottel_type_masters.Name as Bottle_Name','cpb.No_Of_Bottles')
                // ->get();
			   // dd($cust);
			   			$sql = "Select c.*,a.Area_Name, cp.No_Bottle,p.Name as Plan,cp.Rate ";
				//$sql .= ", Case when cpb1.No_Of_Bottles<>null then cpb1.No_Of_Bottles else 0 end as Jug_20L";
				//$sql .= ", Case when cpb2.No_Of_Bottles<>null then cpb2.No_Of_Bottles else 0 end as Bot_20L";
				$sql .= ", cpb1.No_Of_Bottles as Jug_20L";
			$sql .= ", cpb2.No_Of_Bottles as Bot_20L";
			
				$sql .= " From area_masters a, customer__masters c";
				$sql .= " left join customer_plans cp on cp.Cust_Id = c.Id";
				$sql .= " left join plan_masters p on p.Id=cp.Plan_Id";
				$sql .= " left join cust_plan_bottle_allocated cpb1 on cpb1.Cust_Plan_Id=cp.Id and cpb1.Bottle_Id=16";
				$sql .= " left join cust_plan_bottle_allocated cpb2 on cpb2.Cust_Plan_Id=cp.Id and cpb2.Bottle_Id=17";
				$sql .= " Where a.Id=c.Area_Id";
				$sql .= " and c.Enabled=0";
				
				$cust = DB::select($sql);
			}
			else
			{
				// $cust= DB::table('customer__masters')
					// ->join('area_masters','customer__masters.Area_Id','area_masters.Id')
				  // //  ->join('plan_masters','customer__masters.Id','plan_masters.Id')
					// ->where('customer__masters.Enabled', '=', 0)
					// ->leftJoin('customer_plans','customer_plans.Cust_Id','=','customer__masters.Id')
					// ->leftJoin('plan_masters','plan_masters.Id','=','customer_plans.Plan_Id')
					// ->where('area_masters.Id','=',$Area_Sel)
					// ->leftJoin('cust_plan_bottle_allocated as cpb','cpb.Cust_Plan_Id','=','plan_masters.Id')
				// ->leftJoin('bottel_type_masters','bottel_type_masters.Id','=','cpb.Bottle_Id')
                // ->select('customer__masters.*','area_masters.Area_Name','customer_plans.No_Bottle','plan_masters.Name as Plan','customer_plans.Rate','bottel_type_masters.Name as Bottle_Name','cpb.No_Of_Bottles')
                // ->get();
				$sql = "Select c.*,a.Area_Name, cp.No_Bottle,p.Name as Plan,cp.Rate ";
				//$sql .= ", Case when cpb1.No_Of_Bottles<>null then cpb1.No_Of_Bottles else 0 end as Jug_20L";
				//$sql .= ", Case when cpb2.No_Of_Bottles<>null then cpb2.No_Of_Bottles else 0 end as Bot_20L";
				$sql .= ", cpb1.No_Of_Bottles as Jug_20L";
			$sql .= ", cpb2.No_Of_Bottles as Bot_20L";
			
				$sql .= " From area_masters a, customer__masters c";
				$sql .= " left join customer_plans cp on cp.Cust_Id = c.Id";
				$sql .= " left join plan_masters p on p.Id=cp.Plan_Id";
				
				$sql .= " left join cust_plan_bottle_allocated cpb1 on cpb1.Cust_Plan_Id=cp.Id and cpb1.Bottle_Id=16";
				$sql .= " left join cust_plan_bottle_allocated cpb2 on cpb2.Cust_Plan_Id=cp.Id and cpb2.Bottle_Id=17";
				$sql .= " Where a.Id=c.Area_Id";
				$sql .= " and c.Enabled=0";
				$sql .= " and a.Id=" . $Area_Sel;
				$cust = DB::select($sql);
			}
 
            return view('customer_list')->with(['customer'=> $cust,
											'Area_Sel'=>$Area_Sel,
											'Area'=>$Area]);


        } catch (Exception $e) {

            return $e->getMessage();
          //  return view('excaption');

        }


    }


    public function add_areaforcustomer()
    {
        try {
            $areas = DB::table('area_masters')
                ->select('area_masters.Id', 'area_masters.Area_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Area_Name')
                ->get();

			$plan = DB::table('plan_masters')
                ->select('plan_masters.Id', 'plan_masters.Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Name')
                ->get();


            $bottle = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name')
                ->where('Enabled', '=', 0)
				->where('bottel_type_masters.User','=','DB')
                ->orderBy('Name')
                ->get();


            return view('customer_add')->with([
                'area' => $areas,
				'plans' => $plan,
				'Bottles' => $bottle
            ]);

        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }
    }

    //store customer

    public function store_customer(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        try {

            $cust = DB::table('customer__masters')
                ->insert(['Agency_Name'=>$request->txt_Agencyname,
                    'Cust_Name'=>$request->txt_customername,
                    'Address'=>$request->txt_address,
                    'Area_Id'=>$request->txt_area,
                    'Phone_No'=>$request->txt_PhoneNo,
                   'DoB'=>$request->dt_dob,
                    'GST_No'=>$request->txt_gstno!= null ? $request->txt_gstno : '',
                    'isActive'=>1,
                    'Start_Date'=>$request->dt_start,
                    'Email_id'=>$request->txt_EmailID!= null ? $request->txt_EmailID : '',
                    'Sequence_no'=>$request->txt_sequenceno,
                    'created_at'=>$current_time
                    ]);


			$cust = DB::table('customer__masters')
					->orderBy('Id','desc')
					->get()
					->first();

			$cust_Id = $cust->Id;
			//////////////////////////////////////////////////////////////////
			//// Add customer plan
			$cust = DB::table('customer_plans')
                ->insert(['Cust_Id'=>$cust_Id,
                    'Plan_Id'=>$request->txt_planid!= null ? $request->txt_planid : '',
                    'No_Bottle'=>$request->txt_bottleno!= null ? $request->txt_bottleno : '',
                    'Rate'=>$request->txt_rate!= null ? $request->txt_rate : '',
                    'Address'=>$request->txt_address!= null ? $request->txt_address : '',
                    'Area_Id'=>$request->txt_area!= null ? $request->txt_area : '',
                    'Phone_No'=>$request->txt_PhoneNo != null ? $request->txt_PhoneNo : '',
                    //'Deposit_Bottle'=>$request->txt_depositbottle != null ? $request->txt_depositbottle : '',
                    'created_at'=>$current_time
                ]);


            $db = DB::table('customer_plans')
                ->orderBy('Id','desc')
                ->get()
                ->first();

            $db_Id=$db->Id;

			///////// ADD Customer Deposited Bottles
            $user = DB::table('bottel_type_masters')
				->where('bottel_type_masters.User','=','DB')
                ->get();
            foreach($user as $u)
            {
                $str = "txtB" . $u->Id;
                //$cnt = $request->$str;
                $bottle = $request->$str;
				if(is_numeric($bottle))
				{
					if($bottle<>0)
					{
						$dbb=DB::table('cust_plan_bottle_allocated')
							->insert(['Cust_Plan_Id'=>$db_Id,
								'Bottle_Id'=>$u->Id,
								'No_Of_Bottles'=>$bottle
							]);
					}
				}
            }

			//////////////////////////////////////////////////////////////////
			/////////// Add delivery boy <-> customer relation ///////////
			$res = DB::table('cust_delivery_boy_rels')
					->insert(['Customer_Id'=>$cust_Id,
							'Delivery_Boy_Id'=>$request->txt_db,
							'DoA'=>date('Y-m-d'),
							'isActive'=>1,
							'Enabled'=>0,
							'created_at'=>$current_time
						]);
							
							
/*
$obj = DB::table('customer_plans')
                ->insert(['Cust_Id'=>$cust_Id,
                    'Plan_Id'=>$request->txt_planid!= null ? $request->txt_planid : '',
                    'No_Bottle'=>$request->txt_bottleno!= null ? $request->txt_bottleno : '',
                    'Rate'=>$request->txt_rate!= null ? $request->txt_rate : '',
                    'Address'=>$request->txt_address!= null ? $request->txt_address : '',
                    'Area_Id'=>$request->txt_area!= null ? $request->txt_area : '',
                    'Phone_No'=>$request->txt_PhoneNo != null ? $request->txt_PhoneNo : '',
                    //'Deposit_Bottle'=>$request->txt_depositbottle != null ? $request->txt_depositbottle : '',
                    'created_at'=>$current_time
                ]);
				*/

           // return $date->format('d-m-Y');

            return redirect('ListCustomer')->with('success', "Record Stored Successfully");


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //delete customer

    public function destroy_customer(Request $request)
    {

        try {

            $user = DB::table('customer__masters')->where('Id', $request->id)
					->update(['Enabled' => 1,
							'DoD'=>date('Y-m-d')]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    /*show plan master*/

    public function show_customer($id)
    {
        try {
			$Plan_Type='Monthly';
            $user = DB::table('customer__masters')->where('Id', '=', $id)->first();
			$cust_plan=DB::table('customer_plans')
				->where('customer_plans.Cust_Id','=',$id)
				->where('customer_plans.Enabled','=',0)
				->join('plan_masters','plan_masters.Id','=','customer_plans.Plan_Id')
				->select('customer_plans.*','plan_masters.Plan_Type')
				->get()
				->first();
			if(is_null($cust_plan)==true)
			{
				$cnt=0;
			}
			else
			{
				$cnt = 1;
				$Plan_Type=$cust_plan->Plan_Type;
			}
			if($cnt==0)
			{
				$cust_plan_id=0;
				$cust_plan_id1=0;
			}
			else
			{
				$cust_plan_id = $cust_plan->Plan_Id;
				$cust_plan_id1= $cust_plan->Id;
			}

            $areas = DB::table('area_masters')
                ->select('area_masters.Id', 'area_masters.Area_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Area_Name')
                ->get();

			$plan = DB::table('plan_masters')
                ->select('plan_masters.Id', 'plan_masters.Name')
                ->where('Enabled', '=', 0)
				->where('Plan_Type','=',$Plan_Type)
                ->orderBy('Name')
                ->get();

			$sql = "Select bt.Id,bt.Name,cp.No_Of_Bottles";
			$sql .= " From bottel_type_masters bt ";
			$sql .= " Left Join	cust_plan_bottle_allocated cp on cp.Bottle_Id=bt.Id And cp.Cust_Plan_Id=" . $cust_plan_id1;
			$sql .= " Where bt.Enabled=0";
			$sql .= " And bt.User='DB'";
			//$sql .= " And cp.Cust_Plan_Id
			$sql .= " Order by bt.Name";
			
			$bottle = DB::select($sql);
            // $bottle = DB::table('bottel_type_masters')
				// ->leftJoin('cust_plan_bottle_allocated','cust_plan_bottle_allocated.Bottle_Id','=','bottel_type_masters.Id')
                // ->select('bottel_type_masters.Id', 'bottel_type_masters.Name','cust_plan_bottle_allocated.No_Of_Bottles')
                // ->where('bottel_type_masters.Enabled', '=', 0)
				// ->where('cust_plan_bottle_allocated.Cust_Plan_Id','=',$cust_plan_id)
                // ->orderBy('Name')
                // ->get();
			$Del_Boy = DB::table('delivery_boy_masters')
					->where('Enabled','=',0)
					
					->orderBy('Boy_Name')
					
					->get();
			$Cust_Boy_rel = DB::table('cust_delivery_boy_rels')
						->where('Customer_Id','=',$id)
						->where('Enabled','=',0)
						->get()
						->first();
            return view('customer_edit')->with(['customer' => $user,'area' => $areas,
					'plans' => $plan,
					'Bottles' => $bottle,
					'cust_plan_id' => $cust_plan_id,
					'cust_plan' => $cust_plan,
					'cust_boy_rel' => $Cust_Boy_rel,
					'Del_Boy'=>$Del_Boy
					
				]);

        } catch (Exception $e) {

			return $e->getMessage();
            //return view('excaption');

        }


    }

    //edit customer

    public function edit_customer(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        try {

            if ($request->has('chk_isActive')) {
                $isActive =1;

            } else {
                $isActive = 0;
            }
		$Cust_Id = $request->txt_id;
		$Old_Cust=DB::table('customer__masters')
				->where('Id','=',$Cust_Id)
				->get()
				->first();

           /* $data = $request->all();
            $data['DoB'] = Carbon::createFromFormat('m/d/Y', $request->dt_dob)->format('d-m-y');
            $transaction = Transaction::create($data);*/

            //$date = Carbon::parse($request);


            $cust = DB::table('customer__masters')
                ->where('Id',$request->txt_id)
                ->update(['Agency_Name'=>$request->txt_Agencyname,
                    'Cust_Name'=>$request->txt_customername,
                    'Address'=>$request->txt_address,
                    'Area_Id'=>$request->txt_area,
                    'Phone_No'=>$request->txt_PhoneNo,
                    'DoB'=>$request->dt_dob,
                    //'Dob'=>$convert_date,
                    'GST_No'=>$request->txt_gstno!= null ? $request->txt_gstno : '',
                    'isActive'=>1,
                    'Start_Date'=>$request->dt_start,
                    'Email_id'=>$request->txt_EmailID!= null ? $request->txt_EmailID : '',
                    'Sequence_no'=>$request->txt_sequenceno,
                    'updated_at'=>$current_time
                ]);

			$cust_Id=$request->txt_id;
			//////////////////////////////////////////////////////////////////
			//// Add/Update customer plan
			$cnt = DB::table('customer_plans')
				->where('Cust_Id','=',$cust_Id)
				->where('Enabled','=',0)
				->get()
				->count();
			if($cnt>=1)
			{
				$cust_plan = DB::table('customer_plans')
					->where('Cust_Id','=',$cust_Id)
					->where('Enabled','=',0)
					->get()->first();
				$obj = DB::table('customer_plans')
					->where('Id','=',$cust_plan->Id)
					->update(['Cust_Id'=>$cust_Id,
							'Plan_Id'=>$request->txt_planid!= null ? $request->txt_planid : '',
							'No_Bottle'=>$request->txt_bottleno!= null ? $request->txt_bottleno : '',
							'Rate'=>$request->txt_rate!= null ? $request->txt_rate : '',
							'Address'=>$request->txt_address!= null ? $request->txt_address : '',
							'Area_Id'=>$request->txt_area!= null ? $request->txt_area : '',
							'Phone_No'=>$request->txt_PhoneNo!= null ? $request->txt_PhoneNo : '',
							//'Deposit_Bottle'=>$request->txt_depositbottle != null ? $request->txt_depositbottle : '',
							'updated_at'=>$current_time
						]);
			}
			else
			{
				$obj = DB::table('customer_plans')
                ->insert(['Cust_Id'=>$cust_Id,
                    'Plan_Id'=>$request->txt_planid!= null ? $request->txt_planid : '',
                    'No_Bottle'=>$request->txt_bottleno!= null ? $request->txt_bottleno : '',
                    'Rate'=>$request->txt_rate!= null ? $request->txt_rate : '',
                    'Address'=>$request->txt_address!= null ? $request->txt_address : '',
                    'Area_Id'=>$request->txt_area!= null ? $request->txt_area : '',
                    'Phone_No'=>$request->txt_PhoneNo != null ? $request->txt_PhoneNo : '',
                    //'Deposit_Bottle'=>$request->txt_depositbottle != null ? $request->txt_depositbottle : '',
                    'created_at'=>$current_time
                ]);
			}
			$db = DB::table('customer_plans')
                ->where('Cust_Id','=',$cust_Id)
				->where('Enabled','=',0)
                ->get()
                ->first();

            $db_Id=$db->Id;

			$obj = DB::table('cust_plan_bottle_allocated')
				->where('Cust_Plan_Id','=',$db_Id)
				->delete();

			///////// ADD Customer Deposited Bottles
            $user = DB::table('bottel_type_masters')
				->where('bottel_type_masters.User','=','DB')
                ->get();
            foreach($user as $u)
            {
                $str = "txtB" . $u->Id;
                //$cnt = $request->$str;
                $bottle = $request->$str;
				if(is_numeric($bottle))
				{
					if($bottle<>0)
					{
						$dbb=DB::table('cust_plan_bottle_allocated')
							->insert(['Cust_Plan_Id'=>$db_Id,
								'Bottle_Id'=>$u->Id,
								'No_Of_Bottles'=>$bottle
							]);
					}
				}
            }
			
			//////////////  Set cust - delivery boy relation  //////////////////
			if($Old_Cust->Area_Id<>$request->txt_area)
			{
				$tmp = DB::table('cust_delivery_boy_rels')
					->where('Customer_Id','=',$Cust_Id)
					->delete();
				$res = DB::table('cust_delivery_boy_rels')
					->insert(['Customer_Id'=>$Cust_Id,
							'Delivery_Boy_Id'=>$request->txt_db,
							'DoA'=>date('Y-m-d'),
							'isActive'=>1,
							'Enabled'=>0,
							'created_at'=>$current_time
						]);
			}
			//////////////////////////////////////////////////////////////////


            return redirect('ListCustomer')->with('success', "Record Updated Successfully");

        //    return $date->format('d-m-Y');


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }



    /*end customer*/





    public function list_MonthlyBottleAllocation()
    {
        try {

            $araa = DB::table('cust_daily_transactions')
                ->where('Enabled', '=', 0)
                ->get();


            return view('monthly_bottle_allocation_list')->with('custdaitran', $araa);


        } catch (Exception $e) {


            return view('excaption');

        }


    }


    /*start customer plan master*/

    //list customer plan master

    public function list_customerplan()
    {
        $custplan=DB::table('customer_plans')
            ->join('customer__masters', 'customer_plans.Cust_Id',
                '=', 'customer__masters.Id')
            ->join('plan_masters', 'customer_plans.Plan_Id',
                '=', 'plan_masters.Id')
            ->select('customer_plans.*', 'customer__masters.Cust_Name', 'plan_masters.Name')
            ->where('customer_plans.Enabled', '=', 0)
            ->get();

        return view('customer_plan_list')->with('customerlan',$custplan);
    }

    //add customer plan

    public function Add_customerplan()
    {
        try {
            $customer = DB::table('customer__masters')
                ->select('customer__masters.Id', 'customer__masters.Cust_Name',
                    'customer__masters.Agency_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Cust_Name')
                ->get();

            $plan = DB::table('plan_masters')
                ->select('plan_masters.Id', 'plan_masters.Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Name')
                ->get();

            $area = DB::table('area_masters')
                ->select('area_masters.Id', 'area_masters.Area_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Area_Name')
                ->get();

            $bottle = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name')
                ->where('Enabled', '=', 0)
				->where('User','=','DB')
                ->orderBy('Name')
                ->get();

            return view('customer_plan_add')->with([
                'customers' => $customer,
                'plans' => $plan,
                'areas'=>$area,
                'Bottles'=>$bottle
            ]);

        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }
    }



    //store customer plan


    public function store_customerplan(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        try {

            $cust = DB::table('customer_plans')
                ->insert(['Cust_Id'=>$request->txt_custid!= null ? $request->txt_custid : '',
                    'Plan_Id'=>$request->txt_planid!= null ? $request->txt_planid : '',
                    'No_Bottle'=>$request->txt_bottleno!= null ? $request->txt_bottleno : '',
                    'Rate'=>$request->txt_rate!= null ? $request->txt_rate : '',
                    'Address'=>$request->txt_address!= null ? $request->txt_address : '',
                    'Area_Id'=>$request->txt_area!= null ? $request->txt_area : '',
                    'Phone_No'=>$request->txt_PhoneNo != null ? $request->txt_PhoneNo : '',
                    //'Deposit_Bottle'=>$request->txt_depositbottle != null ? $request->txt_depositbottle : '',
                    'created_at'=>$current_time
                ]);


            $db = DB::table('customer_plans')
                ->orderBy('Id','desc')
                ->get()
                ->first();

            $db_Id=$db->Id;

            $user = DB::table('bottel_type_masters')
				->where('bottel_type_masters.User','=','DB')
                ->get();
            foreach($user as $u)
            {
                $str = "txtB" . $u->Id;
                //$cnt = $request->$str;
                $bottle = $request->$str;
                $dbb=DB::table('cust_plan_bottle_allocated')
                    ->insert(['Cust_Plan_Id'=>$db_Id,
                        'Bottle_Id'=>$u->Id,
                        'No_Of_Bottles'=>$bottle
                    ]);
            }


            return redirect('ListCustomerPlan')->with('success', "Record Updated Successfully");


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //delete customer

    public function destroy_customerplan(Request $request)
    {

        try {

            $user = DB::table('customer_plans')->where('Id', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    /*show plan master*/

    public function show_customerplan($id)
    {
        try {

            $customer = DB::table('customer__masters')
                ->select('customer__masters.Id', 'customer__masters.Cust_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Cust_Name')
                ->get();

            $plan = DB::table('plan_masters')
                ->select('plan_masters.Id', 'plan_masters.Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Name')
                ->get();

            $area = DB::table('area_masters')
                ->select('area_masters.Id', 'area_masters.Area_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Area_Name')
                ->get();

            $bottle = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name','bottel_type_masters.User')
                ->where('Enabled', '=', 0)
				->where('User','=','DB')
                ->orderBy('Name')
                ->get();

            $user = DB::table('customer_plans')->where('Id', '=', $id)->first();

            return view('customer_plan_edit')->with([
                'customers' => $customer,
                'plans' => $plan,
                'areas'=>$area,
                'Bottles'=>$bottle,
                'customerplan'=>$user
            ]);

        } catch (Exception $e) {


            return view('excaption');

        }


    }

    //edit customer

    public function edit_customerplan(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        try {

            $cust = DB::table('customer_plans')
                ->where('Id',$request->txt_id)
                ->update(['Cust_Id'=>$request->txt_custid!= null ? $request->txt_custid : '',
                    'Plan_Id'=>$request->txt_planid!= null ? $request->txt_planid : '',
                    'No_Bottle'=>$request->txt_bottleno!= null ? $request->txt_bottleno : '',
                    'Rate'=>$request->txt_rate!= null ? $request->txt_rate : '',
                    'Address'=>$request->txt_address!= null ? $request->txt_address : '',
                    'Area_Id'=>$request->txt_area!= null ? $request->txt_area : '',
                    'Phone_No'=>$request->txt_PhoneNo!= null ? $request->txt_PhoneNo : '',
                    'Deposit_Bottle'=>$request->txt_depositbottle != null ? $request->txt_depositbottle : '',
                    'updated_at'=>$current_time
                ]);

            $db = DB::table('customer_plans')
                ->orderBy('Id','desc')
                ->get()
                ->first();

            $db_Id=$db->Id;

            $user = DB::table('bottel_type_masters')
				->where('User','=','DB')
                ->get();
            foreach($user as $u)
            {
                $str = "txtB" . $u->Id;
                //$cnt = $request->$str;
                $bottle = $request->$str;
                $dbb=DB::table('cust_plan_bottle_allocated')->where('Id',$request->txt_id)
                    ->update(['Cust_Plan_Id'=>$db_Id,
                        'Bottle_Id'=>$u->Id,
                        'No_Of_Bottles'=>$bottle
                    ]);
            }




            return redirect('ListCustomerPlan')->with('success', "Record Updated Successfully");


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }
    /*end customer plan master*/


    /*start delivery boy base bottle*/

    //list delivery boy base bottle

    public function list_DeliveryBoyBaseBottle()
    {
        $deliveryboy=DB::table('delivery_boy_base_bottles')
            ->join('delivery_boy_masters', 'delivery_boy_base_bottles.Delivery_Boy_Id',
                '=', 'delivery_boy_masters.Id')
            ->join('bottel_type_masters', 'delivery_boy_base_bottles.Bottle_Id',
                '=', 'bottel_type_masters.Id')
            ->select('delivery_boy_base_bottles.*', 'delivery_boy_masters.Boy_Name', 'bottel_type_masters.Name')
            ->where('delivery_boy_base_bottles.Enabled', '=', 0)
			->where('bottel_type_masters.User','=','DB')
            ->get();

        return view('delivery_boy_base_bottle_list')->with('deliveryboys',$deliveryboy);
    }

    //add delivery boy base bottle

    public function Add_DeliveryBoyBaseBottle()
    {
        try {
            $deliveryboy = DB::table('delivery_boy_masters')
                ->select('delivery_boy_masters.Id', 'delivery_boy_masters.Boy_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Boy_Name')
                ->get();

            $bottletype = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name')
                ->where('Enabled', '=', 0)
				->where('User','=','DB')
                ->orderBy('Name')
                ->get();

            return view('delivery_boy_base_bottle_add')->with([
                'deliveryboys' => $deliveryboy,
                'bottletypes' => $bottletype,
                ]);

        } catch (Exception $e) {


            return $e->getMessage();

          //  return view('excaption');

        }
    }

    //store delivery boy base bottle


    public function store_DeliveryBoyBaseBottle(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        try {

            $cust = DB::table('delivery_boy_base_bottles')
                ->insert(['Delivery_Boy_Id'=>$request->txt_deliveryboyid!= null ? $request->txt_deliveryboyid : '',
                    'Bottle_Id'=>$request->txt_bottleid!= null ? $request->txt_bottleid : '',
                    'Count'=>$request->txt_count!= null ? $request->txt_count : '',
                    'created_at'=>$current_time
                ]);


            return redirect('ListDeliveryBoyBaseBottle')->with('success', "Record Updated Successfully");


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //delete delivery boy base bottle

    public function destroy_DeliveryBoyBaseBottle(Request $request)
    {

        try {

            $user = DB::table('delivery_boy_base_bottles')->where('Id', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    /*show delivery boy base bottle*/
    public function show_DeliveryBoyBaseBottle($id)
    {
        try {


            $user = DB::table('delivery_boy_base_bottles')->where('Id', '=', $id)->first();

            $deliveryboy = DB::table('delivery_boy_masters')
                ->select('delivery_boy_masters.Id', 'delivery_boy_masters.Boy_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Boy_Name')
                ->get();

            $bottletype = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name')
				->where('bottel_type_masters.User','=','DB')
                ->where('Enabled', '=', 0)
                ->orderBy('Name')
                ->get();

            return view('delivery_boy_base_bottle_edit')->with([
                'deliveryboys' => $deliveryboy,
                'bottletypes' => $bottletype,
                'dbbb'=>$user
            ]);



        } catch (Exception $e) {

            return $e->getMessage();
           // return view('excaption');

        }


    }

    //edit delivery boy base bottle

    public function edit_DeliveryBoyBaseBottle(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        try {

            $cust = DB::table('delivery_boy_base_bottles')
                ->where('Id',$request->txt_id)
                ->update(['Delivery_Boy_Id'=>$request->txt_deliveryboyid!= null ? $request->txt_deliveryboyid : '',
                    'Bottle_Id'=>$request->txt_bottleid!= null ? $request->txt_bottleid : '',
                    'Count'=>$request->txt_count!= null ? $request->txt_count : '',
                    'updated_at'=>$current_time
                ]);


            return redirect('ListDeliveryBoyBaseBottle')->with('success', "Record Updated Successfully");


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    /*end customer plan master*/

    /*start area*/


    //list area

    public function list_area()
    {
        try {

            $araa = DB::table('area_masters')
                ->join('city_masters','area_masters.City_Id','city_masters.Id')
                ->select('area_masters.*','city_masters.City_Name')
                ->where('area_masters.Enabled', '=', 0)
                ->get();


            return view('area_list')->with('area', $araa);


        } catch (Exception $e) {


            return view('excaption');

        }


    }

    //add city for area

    public function Add_cityforarea()
    {
        try {
            $user = DB::table('city_masters')
                ->select('city_masters.Id', 'city_masters.City_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('City_Name')
                ->get();

            return view('area_add')->with([
                'city' => $user,
            ]);

        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }
    }

    //store area

    public function store_area(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        try {
            $current_time = Carbon::now()->toDateTimeString();

            $city = DB::table('area_masters')
                ->select('area_masters.Area_Name')
                ->where('area_masters.Area_Name', '=', $request->txt_areaname)
                ->where('area_masters.Enabled', '=', '0')
                ->get()->count();

            if ($city > 0) {

                return redirect()->back()->withInput()
                    ->with('error', 'State ' . $request->txt_areaname . ' Alredy Exist');

            } else {
                $user = DB::table('area_masters')
                    ->insert(['Area_Name'=>$request->txt_areaname,
                        'City_Id'=>$request->txt_cityid,
                        'created_at'=> $current_time
                    ]);

                return redirect('ListArea')->with('success', "Record Stored Successfully");





            }

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //delete delivery boy base bottle

    public function destory_area(Request $request)
    {

        try {

            $user = DB::table('area_masters')->where('Id', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }



        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    /*show delivery boy base bottle*/

    public function show_area($id)
    {
        try {


            $user = DB::table('area_masters')->where('Id', '=', $id)->first();

            $city = DB::table('city_masters')
                ->select('city_masters.Id', 'city_masters.City_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('City_Name')
                ->get();

            return view('area_edit')->with([
                'area' => $user,
                'city'=>$city
            ]);



        } catch (Exception $e) {


            return view('excaption');

        }


    }

    //edit delivery boy base bottle

    public function edit_area(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        try {

            $cust = DB::table('area_masters')
                ->where('Id',$request->txt_id)
                ->update(['Area_Name'=>$request->txt_areaname,
                    'City_Id'=>$request->txt_cityid,
                    'updated_at'=>$current_time
                ]);


            return redirect('ListArea')->with('success', "Record Updated Successfully");


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }


    /*end area*/

    /*start dealer*/

    //list dealer

    public function list_dealer()
    {
        try {

            $dealers = DB::table('dealer_masters')
                ->where('Enabled', '=', 0)
                ->get();


            return view('dealer_list')->with('dealer', $dealers);


        } catch (Exception $e) {


            return view('excaption');

        }


    }

    //add area for dealer

    public function Add_areafordealer()
    {
        try {
            $user = DB::table('area_masters')
                ->select('area_masters.Id', 'area_masters.Area_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Area_Name')
                ->get();

            $bottle = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name')
                ->where('Enabled', '=', 0)
				->where('User','=','Dealer')
                ->orderBy('Name')
                ->get();

            return view('dealer_add')->with([
                'area' => $user,'Bottles' => $bottle,
            ]);

        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }
    }

    //store dealer

    public function store_dealer(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        try {

            $cust = DB::table('dealer_masters')
                ->insert(['Dealer_Name'=>$request->txt_name,
                    'Address'=>$request->txt_address,
                    'Area_Id'=>$request->txt_area,
                    'Phone_No'=>$request->txt_PhoneNo!= null ? $request->txt_PhoneNo : '',
                    'Agency_Name'=>$request->txt_AgencyName!= null ? $request->txt_AgencyName : '',
                    'GST_No'=>$request->txt_gstno!= null ? $request->txt_gstno : '',
                    'Vehicle_No'=>$request->txt_VehicleNo!= null ? $request->txt_VehicleNo : '',
                    'Vehicle_Type'=>$request->txt_VehicleType!= null ? $request->txt_VehicleType : '',
                    'Email_id'=>$request->txt_EmailID!= null ? $request->txt_EmailID : '',
                    'created_at'=>$current_time
                ]);





            $db = DB::table('dealer_masters')
                ->orderBy('Id','desc')
                ->get()
                ->first();

            $db_Id=$db->Id;

            $user = DB::table('bottel_type_masters')
				->where('User','=','Dealer')
                ->get();
            foreach($user as $u)
            {
                $str = "txtB" . $u->Id;
                $cnt = $request->$str;
				$bottle = $request->$str;
				if(is_numeric($bottle))
				{
					if($bottle<>0)
					{
						$dbb=DB::table('dealer_plan_rels')
							->insert(['Dealer_Id'=>$db_Id,
								'Bottle_Id'=>$u->Id,
								'Rate'=>$cnt,
								'No_of_bottle'=>$bottle
							]);

					}
				}
			}

            return redirect('ListDealer')->with('success', "Record Stored Successfully");




        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //delete dealer

    public function destroy_dealer(Request $request)
    {

        try {

            $user = DB::table('dealer_masters')->where('Id', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //show dealer

    public function show_dealer($id)
    {
        try {


            $dealer = DB::table('dealer_masters')->where('Id', '=', $id)->first();

            $area = DB::table('area_masters')
                ->select('area_masters.Id', 'area_masters.Area_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Area_Name')
                ->get();

			$sql = "SELECT b.*, case when d.Rate is null then 0 else d.Rate end as Rate1 ";
			$sql .= " from `bottel_type_masters` b left JOIN dealer_plan_rels d on d.Bottle_Id=b.Id and d.Dealer_Id=? ";
			$sql .= " where b.Enabled=0 ";
			$sql .= " And b.User='Dealer'";
			$sql .= " Order by b.Name";
            $bottle = DB::select($sql,[$id]);
				// ->leftJoin('dealer_plan_rels','dealer_plan_rels.Bottle_Id','=','bottel_type_masters.Id')
                // ->select('bottel_type_masters.Id', 'bottel_type_masters.Name','dealer_plan_rels.Rate')
                // ->where('bottel_type_masters.Enabled', '=', 0)
				// ->where('dealer_plan_rels.Dealer_Id','=',$id)
                // ->orderBy('Name')
                // ->get();

            return view('dealer_edit')->with([
                'area' => $area,
                'dealer'=>$dealer,
                'Bottles' => $bottle
            ]);



        } catch (Exception $e) {

			return $e->getMessage();
            //return view('excaption');

        }


    }


    //edit dealer

    public function edit_dealer(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        try {

            $cust = DB::table('dealer_masters')->where('Id',$request->txt_id)
                ->update(['Dealer_Name'=>$request->txt_name,
                    'Address'=>$request->txt_address,
                    'Area_Id'=>$request->txt_area,
                    'Phone_No'=>$request->txt_PhoneNo!= null ? $request->txt_PhoneNo : '',
                    'Agency_Name'=>$request->txt_AgencyName!= null ? $request->txt_AgencyName : '',
                    'GST_No'=>$request->txt_gstno!= null ? $request->txt_gstno : '',
                    'Vehicle_No'=>$request->txt_VehicleNo!= null ? $request->txt_VehicleNo : '',
                    'Vehicle_Type'=>$request->txt_VehicleType!= null ? $request->txt_VehicleType : '',
                    'Email_id'=>$request->txt_EmailID!= null ? $request->txt_EmailID : '',
                    'updated_at'=>$current_time
                ]);


            $db_Id=$request->txt_id;
			$tmp1 = DB::table('dealer_plan_rels')
				->where('Dealer_Id','=',$db_Id)
				->delete();
            $user = DB::table('bottel_type_masters')
				->where('User','=','Dealer')
                ->get();
            foreach($user as $u)
            {
                $str = "txtB" . $u->Id;
                $cnt = $request->$str;
                $bottle = $request->$str;
                $dbb=DB::table('dealer_plan_rels')
                    ->insert(['Dealer_Id'=>$db_Id,
                        'Bottle_Id'=>$u->Id,
                        'Rate'=>$cnt,
                        'No_of_bottle'=>$bottle
                    ]);
            }


            return redirect('ListDealer')->with('success', "Record Updated Successfully");


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }




    /*end dealer*/





    /*start dealer*/

    //list dealer

    public function list_dealer_plan_rel()
    {
        try {

            $dealersplanrels = DB::table('dealer_plan_rels')
                ->join('dealer_masters','dealer_plan_rels.Dealer_Id','dealer_masters.Id')
                ->join('bottel_type_masters','dealer_plan_rels.Bottle_Id','bottel_type_masters.Id')
                ->select('dealer_plan_rels.*','dealer_masters.Dealer_Name','bottel_type_masters.Name')
                ->where('dealer_plan_rels.Enabled', '=', 0)
				->where('bottel_type_masters.User','=','Dealer')
                ->get();


            return view('dealer_plan_rel_list')->with('dealerplanrel', $dealersplanrels);


        } catch (Exception $e) {


            return view('excaption');

        }


    }

    //add area for dealer

    public function Add_dealer_plan_rel()
    {
        try {
            $dealer = DB::table('dealer_masters')
                ->select('dealer_masters.Id', 'dealer_masters.Dealer_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Dealer_Name')
                ->get();

            $bottle = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name')
				->where('bottel_type_masters.User','=','Dealer')
                ->where('Enabled', '=', 0)
                ->orderBy('Name')
                ->get();

            return view('dealer_plan_rel_add')->with([
                'dealers' => $dealer,'bottles'=>$bottle
            ]);

        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }
    }

    //store dealer

    public function store_dealer_plan_rel(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        try {

            $cust = DB::table('dealer_plan_rels')
                ->insert(['Dealer_Id'=>$request->txt_dealerid,
                    'Bottle_Id'=>$request->txt_bottleid,
                    'Rate'=>$request->txt_rate,
                    'No_of_bottle'=>$request->txt_noofbotttle,
                    'created_at'=>$current_time
                ]);




            return redirect('ListDealerPlanRel')->with('success', "Record Stored Successfully");


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //delete dealer

    public function destroy_dealer_plan_rel(Request $request)
    {

        try {

            $user = DB::table('dealer_plan_rels')->where('Id', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //show dealer

    public function show_dealer_plan_rel($id)
    {
        try {


            $dealerplan = DB::table('dealer_plan_rels')->where('Id', '=', $id)->first();

            $dealer = DB::table('dealer_masters')
                ->select('dealer_masters.Id', 'dealer_masters.Dealer_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Dealer_Name')
                ->get();

            $bottle = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name')
                ->where('Enabled', '=', 0)
				->where('bottel_type_masters.User','=','Dealer')
                ->orderBy('Name')
                ->get();

            return view('dealer_plan_rel_edit')->with([
                'dealers' => $dealer,'bottles'=>$bottle,'dlrplanrel'=>$dealerplan
            ]);



        } catch (Exception $e) {


            return view('excaption');

        }


    }


    //edit dealer

    public function edit_dealer_plan_rel(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        try {

            $cust = DB::table('dealer_plan_rels')->where('Id',$request->txt_id)
                ->update(['Dealer_Id'=>$request->txt_dealerid,
                    'Bottle_Id'=>$request->txt_bottleid,
                    'Rate'=>$request->txt_rate,
                    'No_of_bottle'=>$request->txt_noofbotttle,
                    'updated_at'=>$current_time
                ]);


            return redirect('ListDealerPlanRel')->with('success', "Record Updated Successfully");


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    /*end dealer*/


    /*start delivery boy area relation*/

    //list delivery boy  area relation

    public function list_delivery_boy_area_relation()
    {

        try {

            $DelBoyAraRel = DB::table('delivery_boy_area_relations')
                ->join('delivery_boy_masters','delivery_boy_area_relations.delivery_boy_id','delivery_boy_masters.id')
                ->join('area_masters','delivery_boy_area_relations.area_id','area_masters.id')
                ->select('delivery_boy_area_relations.*',
                    'delivery_boy_masters.Boy_Name','area_masters.Area_Name')
                ->where('delivery_boy_area_relations.enabled', '=', 0)
                ->get();

			//Keyur:2020_07_27: Following code to show all the delivery boys with/without area allocation
			// $sql = "Select dba.*,db.Boy_Name,a.Area_Name ";
			// $sql .= " From delivery_boy_masters db ";
			// $sql .= " left join  delivery_boy_area_relations dba on dba.Delivery_Boy_Id = db.Id ";
			// $sql .= " left join area_masters a on a.Id=dba.Area_Id ";
			// $sql .= " Where db.Enabled=0";
			
			// $DelBoyAraRel=DB::select($sql);
            return view('delivery_boy_area_relation_list')->with('DelBoyAraRel',$DelBoyAraRel);




        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //add delivery boy area relation

    public function add_delivery_boy_area_relation()
    {

        try {


            $deliveryboy = DB::table('delivery_boy_masters')
                ->select('delivery_boy_masters.Id', 'delivery_boy_masters.Boy_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Boy_Name')
                ->get();

            $area = DB::table('area_masters')
                ->select('area_masters.Id', 'area_masters.Area_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Area_Name')
                ->get();



            return view('delivery_boy_area_relation_add')->with([
                'deliveryboys' => $deliveryboy,'area'=>$area
            ]);







        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //store delivery boy area relation

   public function store_delivery_boy_area_relation(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        try {

            if ($request->has('chk_isActive')) {

                $trainer_email = true;

            } else {
                $trainer_email = false;
            }

            /*$cust = DB::table('delivery_boy_area_relations')
                ->insert(['Delivery_Boy_Id'=>$request->txt_deliveryboyid,
                    'Area_Id'=>$request->txt_areaid,
                    'DoA'=>$request->dt_doa,
                    'isActive'=>$trainer_email,
                    'created_at'=>$current_time

                ]);*/

            $func = DB::table('area_masters')
                ->get();

            foreach($func as $f)
            {
                $chk='txt_areaid' . $f->Id;

                if($request->has($chk)) {

                    $obj = DB::table('delivery_boy_area_relations')
                        ->insert(['isActive'=>1,
                            'Delivery_Boy_Id'=>$request->txt_deliveryboyid,
                            'Area_Id' => $f->Id,
                            'DoA'=>$request->dt_doa,
                            'created_at' => $current_time

                        ]);
					$tmp = DB::table('customer__masters')
						->where('Area_Id','=',$f->Id)
						->get();
					foreach($tmp as $t)
					{
						$obj1 = DB::table('cust_delivery_boy_rels')
							->insert(['Customer_Id'=>$t->Id,
									'Delivery_Boy_Id'=>$request->txt_deliveryboyid,
									'DoA'=>$request->dt_doa,
									'isActive'=>1,
									'created_at'=>$current_time
									]);

					}
                }
            }

            return redirect('ListDelBoyAraRel')->with('success', "Record Stored Successfully");


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //destroy delivery boy area relation

    public function destroy_delivery_boy_area_relation(Request $request)
    {

        try {

            $user = DB::table('delivery_boy_area_relations')->where('Id', $request->id)->delete();

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //show delivery boy area relation

    public function show_delivery_boy_area_relation($id)
    {
        try {


            $dealerboyarerel = DB::table('delivery_boy_area_relations')->where('Id', '=', $id)->first();

            $deliveryboy = DB::table('delivery_boy_masters')
                ->select('delivery_boy_masters.Id', 'delivery_boy_masters.Boy_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Boy_Name')
                ->get();

            $area = DB::table('area_masters')
                ->select('area_masters.Id', 'area_masters.Area_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Area_Name')
                ->get();



            return view('delivery_boy_area_relation_edit')->with([
                'deliveryboys' => $deliveryboy,
                'area'=>$area,
                'dlrplanrel'=>$dealerboyarerel
            ]);



        } catch (Exception $e) {


            return view('excaption');

        }


    }

    //edit delivery boy ara relation

    public function edit_delivery_boy_area_relation(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        try {

            if ($request->has('chk_isActive')) {

                $trainer_email = true;

            } else {
                $trainer_email = false;
            }


            $cust = DB::table('delivery_boy_area_relations')->where('Id',$request->txt_id)
                ->update(['Delivery_Boy_Id'=>$request->txt_deliveryboyid,
                    'Area_Id'=>$request->txt_areaid,
                    'DoA'=>$request->dt_doa,
                    'isActive'=>$trainer_email,
                    'updated_at'=>$current_time

                ]);


            return redirect('ListDelBoyAraRel')->with('success', "Record Updated Successfully");


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    /*end delivery boy  area relation*/




    /*start customer delivery boy relation*/

    //list customer delivery  boy relation

    public function list_customer_boy_daily_relation()
    {

        try {

            $CusBoyDailyRel = DB::table('cust_delivery_boy_rels')
                ->join('customer__masters','cust_delivery_boy_rels.Customer_Id',
                    'customer__masters.Id')
                ->join('delivery_boy_masters','cust_delivery_boy_rels.Delivery_Boy_Id',
                    'delivery_boy_masters.Id')
                ->select('cust_delivery_boy_rels.*',
                    DB::raw('DATE_FORMAT(cust_delivery_boy_rels.DoA, "%d-%m-%Y") as DoA'),
                    'delivery_boy_masters.Boy_Name','customer__masters.Cust_Name')
                ->where('cust_delivery_boy_rels.Enabled', '=', 0)
                ->get();

            return view('customer_boy_daily_relation_list')->with('CusBoyDailyRels',$CusBoyDailyRel);




        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //add customer delivery  boy relation

    public function add_customer_boy_daily_relation()
    {

        try {


            $deliveryboy = DB::table('delivery_boy_masters')
                ->select('delivery_boy_masters.Id', 'delivery_boy_masters.Boy_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Boy_Name')
                ->get();

            $custmr = DB::table('customer__masters')
                ->select('customer__masters.Id', 'customer__masters.Cust_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Cust_Name')
                ->get();



            return view('customer_boy_daily_relation_add')->with([
                'deliveryboys' => $deliveryboy,'customer'=>$custmr
            ]);







        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //store customer delivery  boy relation

    public function store_customer_boy_daily_relation(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        try {
            $func = DB::table('customer__masters')
                ->get();

            foreach($func as $f)
            {
                $chk='txt_customerid' . $f->Id;

                if($request->has($chk)) {

                    $obj = DB::table('cust_delivery_boy_rels')
                        ->insert(['isActive'=>1,
                            'Delivery_Boy_Id'=>$request->txt_deliveryboyid,
                            'Customer_Id' => $f->Id,
                            'DoA'=>$request->dt_doa,
                            'created_at' => $current_time

                        ]);

                }

            }
            return redirect('ListCusBoyDailyRel')->with('success', "Record Stored Successfully");

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }

    //destroy customer delivery  boy relation

    public function destroy_customer_boy_daily_relation(Request $request)
    {

        try {

            $user = DB::table('cust_delivery_boy_rels')->where('Id', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //show customer delivery  boy relation

    public function show_customer_boy_daily_relation($id)
    {
        try {


            $CusBoyDailyRelss = DB::table('cust_delivery_boy_rels')->where('Id', '=', $id)->first();

            $deliveryboy = DB::table('delivery_boy_masters')
                ->select('delivery_boy_masters.Id', 'delivery_boy_masters.Boy_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Boy_Name')
                ->get();

            $cust = DB::table('customer__masters')
                ->select('customer__masters.Id', 'customer__masters.Cust_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Cust_Name')
                ->get();



            return view('customer_boy_daily_relation_edit')->with([
                'deliveryboys' => $deliveryboy,
                'customer'=>$cust,
                'CusBoyDailyRel'=>$CusBoyDailyRelss
            ]);



        } catch (Exception $e) {


            return view('excaption');

        }


    }

    //edit customer delivery  boy relation

    public function edit_customer_boy_daily_relation(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        try {

            /*if ($request->has('chk_isActive')) {

                $trainer_email = true;

            } else {
                $trainer_email = false;
            }


            $cust = DB::table('cust_delivery_boy_rels')->where('Id',$request->txt_id)
                ->update(['Customer_Id'=>$request->txt_customerid,
                    'Delivery_Boy_Id'=>$request->txt_deliveryboyid,
                    'DoA'=>$request->dt_doa,
                    'isActive'=>$trainer_email,
                    'updated_at'=>$current_time

                ]);*/

            $func = DB::table('customer__masters')
                ->get();

            foreach($func as $f)
            {
                $chk='Customer_Id' . $f->Id;

                if($request->has($chk)) {

                    $cust = DB::table('cust_delivery_boy_rels')->where('Id',$request->txt_id)
                        ->update(['Customer_Id'=>$f->Id,
                            'Delivery_Boy_Id'=>$request->txt_deliveryboyid,
                            'DoA'=>$request->dt_doa,
                            'isActive'=>1,
                            'updated_at'=>$current_time

                        ]);

                }

            }


           // dd($cust);

            return redirect('ListCusBoyDailyRel')->with('success', "Record Updated Successfully");


        } catch (Exception $e) {

            //return $e->getMessage();
              return view('excaption');

        }


    }

    /*end customer delivery  boy relation*/



    /*start customer delivery boy relation*/

    //list customer delivery  boy relation

    public function list_delivery_boy_in_out()
    {

        try {
			$Del_Boy = DB::table("delivery_boy_masters")
					->where('Enabled','=',0)
					->get();
            $DelBoyInOuts = DB::table('delivery_boy_daily_transactions')
                ->join('bottel_type_masters','delivery_boy_daily_transactions.Bottle_Type_Id',
                    'bottel_type_masters.Id')
                ->join('delivery_boy_masters','delivery_boy_daily_transactions.Delivery_Boy_Id',
                    'delivery_boy_masters.Id')
                ->select('delivery_boy_daily_transactions.*',
                    'delivery_boy_masters.Boy_Name','bottel_type_masters.Name')
                ->where('delivery_boy_daily_transactions.Enabled', '=', 0)
				->where('bottel_type_masters.User','=','DB')
				->orderBy('delivery_boy_daily_transactions.DoT','desc')
				->orderBy('delivery_boy_masters.Boy_Name')
				->orderBy('bottel_type_masters.Name')
				->orderBy('delivery_boy_daily_transactions.In_Out','desc')
                ->get();

            return view('delivery_boy_in_out_list')->with('DelBoyInOut',$DelBoyInOuts);




        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //add customer delivery  boy relation

    public function add_delivery_boy_in_out()
    {

        try {


            $deliveryboy = DB::table('delivery_boy_masters')
                ->select('delivery_boy_masters.Id', 'delivery_boy_masters.Boy_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Boy_Name')
                ->get();

            $bottle = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name')
                ->where('Enabled', '=', 0)
				->where('bottel_type_masters.User','=','DB')
                ->orderBy('Name')
                ->get();



            return view('delivery_boy_in_out_add')->with([
                'deliveryboys' => $deliveryboy,'bottles'=>$bottle
            ]);







        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //store customer delivery  boy relation

    public function store_delivery_boy_in_out(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        try {

            // $cust = DB::table('delivery_boy_daily_transactions')
                // ->insert(['Delivery_Boy_Id'=>$request->txt_deliveryboyid,
                    // 'Bottle_Type_Id'=>$request->txt_bottleid,
                    // 'In_Out'=>$request->txt_inout,
                    // 'DoT'=>$request->dt_dot,
                    // 'created_at'=>$current_time

                // ]);

            $deliveryboy = DB::table('delivery_boy_masters')
                ->select('delivery_boy_masters.Id', 'delivery_boy_masters.Boy_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Boy_Name')
                ->get();

            $bottle = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name')
                ->where('Enabled', '=', 0)
				->where('User','=','DB')
                ->orderBy('Name')
                ->get();


			$i=0;
            foreach($deliveryboy as $d)
            {
				//echo "i; " . $i;
				foreach($bottle as $b)
				{
					$str = "txt_nof" . $i;

					//echo "2";
					$cnt = $request->txt_nof[$i];
					//echo "3";
					//echo $request->txt_nof[$i];
					if(is_numeric($cnt))
					{
						if($cnt<>0)
						{
							$cust = DB::table('delivery_boy_daily_transactions')
							->insert(['Delivery_Boy_Id'=>$d->Id,
								'Bottle_Type_Id'=>$b->Id,
								'In_Out'=>'Out',
								'DoT'=>$request->dt_dot,
								'Count'=>$cnt,
								'created_at'=>$current_time

							]);
						}
					}
					$i = $i+1;
				}
				foreach($bottle as $b)
				{
					$str = "txt_nof" . $i;

					//echo "2";
					$cnt = $request->txt_nof[$i];
					//echo "3";
					//echo $request->txt_nof[$i];
					if(is_numeric($cnt))
					{
						if($cnt<>0)
						{
							$cust = DB::table('delivery_boy_daily_transactions')
							->insert(['Delivery_Boy_Id'=>$d->Id,
								'Bottle_Type_Id'=>$b->Id,
								'In_Out'=>'In',
								'DoT'=>$request->dt_dot,
								'Count'=>$cnt,
								'created_at'=>$current_time

							]);
						}
					}
					$i = $i+1;
				}
            }

            return redirect('ListDelBoyInOut')->with('success', "Record Stored Successfully");


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //destroy customer delivery  boy relation

    public function destroy_delivery_boy_in_out(Request $request)
    {

        try {

            $user = DB::table('delivery_boy_daily_transactions')->where('Id', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //show customer delivery  boy relation

    public function show_delivery_boy_in_out($id)
    {
        try {


            $delboyinout = DB::table('delivery_boy_daily_transactions')->where('Id', '=', $id)->first();

            $deliveryboy = DB::table('delivery_boy_masters')
                ->select('delivery_boy_masters.Id', 'delivery_boy_masters.Boy_Name')
                ->where('Enabled', '=', 0)
                ->orderBy('Boy_Name')
                ->get();

            $bottle = DB::table('bottel_type_masters')
				->leftJoin('delivery_boy_daily_transactions','delivery_boy_daily_transactions.Bottle_Type_Id','bottel_type_masters.Id')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name','delivery_boy_daily_transactions.Count')
                ->where('bottel_type_masters.Enabled', '=', 0)
				->where('delivery_boy_daily_transactions.Id','=',$id)
				->where('bottel_type_masters.User','=','DB')
                ->orderBy('Name')
                ->get();



            return view('delivery_boy_in_out_edit')->with([
                'deliveryboys' => $deliveryboy,'bottles'=>$bottle,
                'DelBoyinout'=>$delboyinout
            ]);



        } catch (Exception $e) {

			return $e->getMessage();
            //return view('excaption');

        }


    }

    //edit customer delivery  boy relation

    public function edit_delivery_boy_in_out(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        try {



            $cust = DB::table('delivery_boy_daily_transactions')->where('Id',$request->txt_id)
                ->update(['Delivery_Boy_Id'=>$request->txt_deliveryboyid,
                    'Count'=>$request->txt_bottleid,
                    'In_Out'=>$request->txt_inout,
                    'DoT'=>$request->dt_dot,
                    'updated_at'=>$current_time

                ]);


            return redirect('ListDelBoyInOut')->with('success', "Record Updated Successfully");


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    /*end customer delivery  boy relation*/



    /*start dealer daily transaction*/

    //list dealer daily transaction

    public function list_dealer_daily_transaction()
    {

        try {

            $DeaDailyTrans = DB::table('dealer_daily_transactions')
                ->join('bottel_type_masters','dealer_daily_transactions.Bottle_Type',
                    'bottel_type_masters.Id')
                ->join('dealer_masters','dealer_daily_transactions.Dealer_Id',
                    'dealer_masters.Id')
                ->select('dealer_daily_transactions.*',
                    'dealer_masters.Dealer_Name','bottel_type_masters.Name')
                ->where('dealer_daily_transactions.Enabled', '=', 0)
				->where('bottel_type_masters.User','=','Dealer')
                ->get();

            return view('dealer_daily_transaction_list')->with('DeaDailyTran',$DeaDailyTrans);




        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //add dealer daily transaction


    public function add_dealer_daily_transaction()
    {
        try {

            $dealer = DB::table('dealer_masters')
                ->select('dealer_masters.Id', 'dealer_masters.Dealer_Name')
                ->where('dealer_masters.Enabled', '=', 0)
                ->orderBy('Dealer_Name')
                ->get();

            $bottle = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name')
                ->where('bottel_type_masters.Enabled', '=', 0)
				->where('bottel_type_masters.User','=','Dealer')
                ->orderBy('Name')
                ->get();
			$DoT = date('Y-m-d');

            return view('dealer_daily_transaction_add')->with([
                'dealers' => $dealer,'bottles'=>$bottle,'dot'=>$DoT
            ]);



        } catch (Exception $e) {

            //return $e->getMessage();
            return view('excaption');

        }


    }

    //store dealer daily transaction


    public function store_dealer_daily_transaction(Request $request)
    {
        try {

            $current_time = Carbon::now()->toDateTimeString();
			$Bottle_Type = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name')
                ->where('bottel_type_masters.Enabled', '=', 0)
				->where('bottel_type_masters.User','=','Dealer')
                ->orderBy('Name')
                ->get();
			$Dealers = DB::table('dealer_masters')
                ->select('dealer_masters.Id', 'dealer_masters.Dealer_Name')
                ->where('dealer_masters.Enabled', '=', 0)
                ->orderBy('Dealer_Name')
                ->get();
			$i=0;
			foreach($Dealers as $d)
			{
				foreach($Bottle_Type as $b)
				{

					$cnt = $request->txt_nob[$i];
					if(is_numeric($cnt))
					{
						if($cnt<>0)
						{
						//$cnt1 = $request->$str;
							$deadailytran = DB::table('dealer_daily_transactions')
								->insert(['Dealer_Id'=>$d->Id,
									'DoT'=>$request->dt_dot,
									'No_Of_Bottle'=>$cnt,
									'Bottle_Type'=>$b->Id,
									'created_at'=>$current_time]);
						}
					}
					$i=$i+1;

				}
			}
            return redirect('ListDeaDailyTran')->with('success','Record Stored Successfully');

        } catch (Exception $e) {


            return $e->getMessage();
           // return view('excaption');

        }
    }

    //destroy dealer daily transaction

    public function destroy_dealer_daily_transaction(Request $request)
    {

        try {

            $user = DB::table('dealer_daily_transactions')->where('Id', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }


    //show dealer daily transaction

    public function show_dealer_daily_transaction($id)
    {
        try {


            $dealerdailytrans = DB::table('dealer_daily_transactions')->where('Id', '=', $id)->first();

            $dealer = DB::table('dealer_masters')
                ->select('dealer_masters.Id', 'dealer_masters.Dealer_Name')
                ->where('dealer_masters.Enabled', '=', 0)
                ->orderBy('Dealer_Name')
                ->get();

            $bottle = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name')
                ->where('bottel_type_masters.Enabled', '=', 0)
				->where('bottel_type_masters.User','=','Dealer')
                ->orderBy('Name')
                ->get();



            return view('dealer_daily_transaction_edit')->with([
                'dealers' => $dealer,'bottles'=>$bottle,'Dealerdailytrans'=>$dealerdailytrans
            ]);



        } catch (Exception $e) {


            return view('excaption');

        }


    }

    //edit dealer daily transaction

    public function edit_dealer_daily_transaction(Request $request)
    {
        try {

            $current_time = Carbon::now()->toDateTimeString();

            $deadailytran = DB::table('dealer_daily_transactions')
                ->where('Id',$request->txt_id)
                ->update(['Dealer_Id'=>$request->txt_dealerid,
                    'DoT'=>$request->dt_dot,
                    'No_Of_Bottle'=>$request->txt_noofbottle,
                    'Bottle_Type'=>$request->txt_bottleid,
                    'created_at'=>$current_time]);


            return redirect('ListDeaDailyTran')->with('success','Record Updated Successfully');

        } catch (Exception $e) {


            //return $e->getMessage();
            return view('excaption');

        }
    }


    /*end dealer daily transaction*/


    /*start attendance*/

    //list attendance

    public function list_attendance()
    {
        try {
			$dtFrom=date('Y-m-d');
			$dtTo=date('Y-m-d');
			$Area_Id=0;
			$area = DB::table('area_masters')
					->where('Enabled','=',0)
					->orderBy('Area_Name')
					->get();
					

            $attendances = DB::table('cust_daily_transactions')
                ->join('customer__masters', 'customer__masters.Id',
                    '=', 'cust_daily_transactions.Cust_Id')
                ->join('bottel_type_masters', 'bottel_type_masters.Id',
                    '=', 'cust_daily_transactions.Bottle_Type')
                ->select('cust_daily_transactions.*', 'customer__masters.Cust_Name',
                    'bottel_type_masters.Name')
                ->where('cust_daily_transactions.Enabled','=',0)
				->where('cust_daily_transactions.DoT','=',$dtFrom)
				->where('bottel_type_masters.User','=','DB')
                ->get();

            return view('attendance_list')->with(['attendance'=>$attendances,
						'dtFrom'=>$dtFrom,
						'dtTo'=>$dtTo,
						'Area_Id'=>$Area_Id,
						'area'=>$area
						]);

        }catch (Exception $e){
            return $e->getMessage();
            //return view('excaption');


        }

    }
	
	public function list_attendance_show(Request $request)
    {
        try {
			$dtFrom=$request->dtFrom;
			$dtTo=$request->dtTo;
			$Area_Id=$request->txt_area;
			$area = DB::table('area_masters')
					->where('Enabled','=',0)
					->orderBy('Area_Name')
					->get();
					
			//DB::enableQueryLog();
            $attendances = DB::table('cust_daily_transactions')
                ->join('customer__masters', 'customer__masters.Id',
                    '=', 'cust_daily_transactions.Cust_Id')
                ->join('bottel_type_masters', 'bottel_type_masters.Id',
                    '=', 'cust_daily_transactions.Bottle_Type')
                ->select('cust_daily_transactions.*', 'customer__masters.Cust_Name',
                    'bottel_type_masters.Name')
                ->where('cust_daily_transactions.Enabled','=',0)
				//->where('bottel_type_masters.User','=','DB')
				->where('cust_daily_transactions.DoT','>=',$dtFrom)
				->where('cust_daily_transactions.DoT','<=',$dtTo)
				->where('customer__masters.Area_Id','=',$Area_Id)
                ->get();
			//DB::enableQueryLog();
			//dd(DB::getQueryLog());
            return view('attendance_list')->with(['attendance'=>$attendances,
						'dtFrom'=>$dtFrom,
						'dtTo'=>$dtTo,
						'Area_Id'=>$Area_Id,
						'area'=>$area
						]);

        }catch (Exception $e){
            return $e->getMessage();
            //return view('excaption');


        }

    }

    //store attendance

    public function store_attendance(Request $request)
    {
        try {
			echo "Step1;";
			$AttType=$request->AttType;
			$current_time = Carbon::now()->toDateTimeString();
			echo "Step2:" . $AttType;
			if($AttType=='Monthly')
			{
				echo "Step3";
				$No_Days = cal_days_in_month(CAL_GREGORIAN, $request->dp_month, $request->txt_year);
				$From_Date = $request->txt_year . "-" . $request->dp_month . '-01';
				$To_Date = $request->txt_year . "-" . $request->dp_month . '-' . cal_days_in_month(CAL_GREGORIAN, $request->dp_month, $request->txt_year);
				$sql = "Select c.Id,Cust_Name,cp.No_Bottle,p.Bottle_Type_Id ";
				$sql .= ", p.Int_Sunday, p.Int_Monday, p.Int_Tuesday, p.Int_Wednesday , p.Int_Thursday, p.Int_Friday,";
				$sql .= "p.Int_Saturday ";
				$sql .= " From customer__masters c, plan_masters p, customer_plans cp";
				$sql .= " Where c.Id = cp.Cust_Id ";
				$sql .= " And cp.Plan_Id = p.Id";
				$sql .= " And p.Plan_Type='Monthly'";
				$sql .= " And c.Enabled=0";
				echo $sql;
				$Cust = DB::select($sql);

				foreach($Cust as $c)
				{
					$cnt = DB::table('cust_daily_transactions')
						->where('Cust_Id', '=', $c->Id)
						->whereBetween('DoT',[$From_Date,$To_Date])
						->get()->count();
					if(isset($cnt) && $cnt>=1)
					{
						//Ignore that customer
					}
					else
					{
						for($i=1;$i<=$No_Days;$i++)
						{
							$strDate = $request->txt_year . "-" . $request->dp_month . '-' . $i;
							$timestamp = strtotime($strDate);
							$day = date('l', $timestamp);
							$strFld = "Int_" . $day;
							if($c->$strFld==1)
							{
								$attendance = DB::table('cust_daily_transactions')
											->insert(['Cust_Id'=>$c->Id,
											'No_Of_Bottle'=>$c->No_Bottle,
											'Bottle_Type'=>$c->Bottle_Type_Id,
											'DoT'=>$strDate,
											'created_at'=>$current_time]);
							}
						}
					}
				}
			}
			else
			{
				$DoT = $request->txtDoT;
				$sql = "Select c.Id,c.Cust_Name,c.Agency_Name ";
				$sql .= " From customer__masters c, customer_plans cp ";
				$sql .= " where cp.Cust_Id=c.Id";
				$sql .= " and cp.Plan_Id in (Select Id from plan_masters where Plan_Type='Daily')";
				
				$customer = DB::select($sql);
				$bottle = db::table('bottel_type_masters')
					 ->select('bottel_type_masters.Id', 'bottel_type_masters.Name')
					 ->where('bottel_type_masters.enabled', '=', 0)
					 ->where('bottel_type_masters.User','=','DB')
					 ->orderby('name')
					 ->get();
				$i=0;
				foreach($customer as $c)
				{
					foreach($bottle as $b)
					{
						$cnt = $request->txt_nob[$i];
						if(is_numeric($cnt))
						{
							if($cnt<>0)
							{
								$attendance = DB::table('cust_daily_transactions')
											->insert(['Cust_Id'=>$c->Id,
											'No_Of_Bottle'=>$cnt,
											'Bottle_Type'=>$b->Id,
											'DoT'=>$DoT,
											'created_at'=>$current_time]);
							}
						}
						$i=$i+1;
					}
					
					
				}
			}



            return redirect('ListAttendance')->with('success','Record Stored Successfully.');

        }catch (Exception $e){
            return $e->getMessage();
            //return view('excaption');


        }

    }

    //add attendance

    public function add_attendance()
    {
        try {

            $customer = DB::table('customer__masters')
            ->select('customer__masters.Id', 'customer__masters.Cust_Name')
            ->where('customer__masters.Enabled', '=', 0)
            ->orderBy('Cust_Name')
            ->get();

            $bottle = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name')
                ->where('bottel_type_masters.Enabled', '=', 0)
				->where('bottel_type_masters.User','=','DB')
                ->orderBy('Name')
                ->get();

            return view('attendance_add')->with([
                'customers' => $customer,'bottles'=>$bottle,
            ]);



        }catch (Exception $e){
            //return $e->getMessage();
            return view('excaption');


        }

    }

	// Add Customer Daily transaction
	public function add_cust_daily_transaction()
    {
        try {
			$DoT = date('Y-m-d');
			$Area = DB::table('area_masters')
				->where('City_Id','=',2)
				->orderBy('Area_Name')
				->get();

            // $customer = db::table('customer__masters')
             // ->select('customer__masters.Id', 'customer__masters.Cust_Name','Agency_Name')
             // ->where('customer__masters.enabled', '=', 0)
			 
             // ->orderby('cust_name')
             // ->get();
			
			$sql = "Select c.Id,c.Cust_Name,c.Agency_Name ";
			$sql .= " From customer__masters c, customer_plans cp ";
			$sql .= " where cp.Cust_Id=c.Id";
			$sql .= " and cp.Plan_Id in (Select Id from plan_masters where Plan_Type='Daily')";
			
			$customer = DB::select($sql);
            $bottle = db::table('bottel_type_masters')
                 ->select('bottel_type_masters.Id', 'bottel_type_masters.Name')
                 ->where('bottel_type_masters.enabled', '=', 0)
				 ->where('bottel_type_masters.User','=','DB')
                 ->orderby('name')
                 ->get();

            return view('cust_daily_transaction_add')->with([
                'Area' => $Area,'DoT'=>$DoT,
				'Cust' => $customer,
				'bottles' => $bottle
            ]);



        }catch (Exception $e){
            //return $e->getMessage();
            return view('excaption');


        }

    }

    //delete attendance

    public function destroy_attendance(Request $request)
    {
        try {
            $user = DB::table('cust_daily_transactions')->where('Id', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }




        }catch (Exception $e){
            //return $e->getMessage();
            return view('excaption');


        }

    }

    //show attendance

    public function show_attendace($id)
    {
        try {

			//$From_Url = $From_Url;
            $user = DB::table('cust_daily_transactions')->where('Id', '=', $id)->first();

            $customer = DB::table('customer__masters')
                ->select('customer__masters.Id', 'customer__masters.Cust_Name')
                ->where('customer__masters.Enabled', '=', 0)
                ->orderBy('Cust_Name')
                ->get();

            // $bottle = DB::table('bottel_type_masters')
                // ->select('bottel_type_masters.Id', 'bottel_type_masters.Name')
                // ->where('bottel_type_masters.Enabled', '=', 0)
				// ->where('bottel_type_masters.User','=','DB')
                // ->orderBy('Name')
                // ->get();

			$sql = "Select bt.Id,bt.Name,cp.No_Of_Bottles";
			$sql .= " From bottel_type_masters bt ";
			$sql .= " Left Join	cust_plan_bottle_allocated cp on cp.Bottle_Id=bt.Id And cp.Cust_Plan_Id in (select Id from customer_plans where Cust_Id=" . $user->Cust_Id . ")";
			$sql .= " Where bt.Enabled=0";
			$sql .= " And bt.User='DB'";
			//$sql .= " And cp.Cust_Plan_Id
			$sql .= " Order by bt.Name";
			
			$bottle = DB::select($sql);

            return view('attendance_edit')->with([
                'customers' => $customer,'bottles'=>$bottle,'attendanc'=>$user
				
            ]);


        }catch (Exception $e){
            return $e->getMessage();
            //return view('excaption');


        }

    }

    //edit attendance

    public function edit_attendance(Request $request)
    {
        try {
			//echo "Step1 ";
			//$From_Url = $request->From_Url;
			$ChangeOn = $request->cmbChangeOn;
			//echo "Step1 ";
            $current_time = Carbon::now()->toDateTimeString();
//DB::enableQueryLog();
			$CustTrans = DB::table('cust_daily_transactions')
						->where('Id','=',$request->txt_id)
						->get()->first();
//dd(DB::getQueryLog());
			if($ChangeOn=='Current Day')
			{
				//echo "Step Current Day ";
				$attendance = DB::table('cust_daily_transactions')
					->where('Id',$request->txt_id)
					->update([//'Cust_Id'=>$request->txt_customerid,
						'No_Of_Bottle'=>$request->txt_bottlesno,
						'Bottle_Type'=>$request->txt_bottletype,
						'updated_at'=>$current_time]);
			}
			else
			{
				echo "Step All ";
				//$DoT = $request->dtDoT;
				//echo "Step : " . $DoT;
				//$Cust_Id = $request->txt_customerid;
				//echo "Step : " . $Cust_Id;
//DB::enableQueryLog();
				$att = DB::table('cust_daily_transactions')
					->where('DoT','>=',$CustTrans->DoT)
					->where('Cust_Id','=',$CustTrans->Cust_Id)
					->update(['No_Of_Bottle'=>$request->txt_bottlesno,
							'updated_at'=>$current_time]);
//dd(DB::getQueryLog());
				// $sql = "Select bt.Id,bt.Name";
				// $sql .= " From bottel_type_masters bt ";
				// $sql .= " Where bt.Enabled=0";
				// $sql .= " And bt.User='DB'";
				// //$sql .= " And cp.Cust_Plan_Id
				// $sql .= " Order by bt.Name";
				// $bottle = DB::select($sql);
				//$Cust1 = DB::table('customer_plans')
				//echo "Step 1";
				$cust_plan = DB::table('customer_plans')
							->where('Cust_Id','=',$CustTrans->Cust_Id)
							->where('Enabled','=',0)
							->get()
							->first();
				//echo "Step 2";
 //DB::enableQueryLog();
				$bottle = DB::table('bottel_type_masters')
						->where('Enabled','=',0)
						->where('User','=','DB')
						->orderBy('Name')
						->get();
//dd(db::getquerylog());
//				dd($bottle);
				echo "step 3";
				$res = DB::table('cust_plan_bottle_allocated')
					->where('cust_plan_id','=',$cust_plan->Id==null?0:$cust_plan->Id)
					//->where('cust_plan_id','=',$cust_plan->id)
					->delete();
				foreach($bottle as $b)
				{
					echo "step 4";
					$str = "txtb" . $b->Id;
					echo "str : " . $str;
					//$cnt = $request->$str;
					$bot = $request->$str;
					echo "bot : " . $bot;
					if(is_numeric($bot))
					{
						if($bot<>0)
						{
							$dbb=db::table('cust_plan_bottle_allocated')
								->insert(['cust_plan_id'=>$cust_plan->Id,
									'bottle_id'=>$b->Id,
									'no_of_bottles'=>$bot
								]);
						}
					}
				}
					
			}
			//$Url = explode('_',$From_Url);
            return redirect('Monthly_Attendance')->with('success','Record Updated Successfully');

        }catch (Exception $e){


            return $e->getMessage();
            //return view('excaption');


        }

    }

    /*end attendance*/

    /*start customer plan bottle allocated*/

    //list customer plan bottle allocated

    public function list_customer_plan_bottle_allocated()
    {
        try {

            $custplbottall = DB::table('cust_plan_bottle_allocated')
                ->join('plan_masters', 'plan_masters.Id',
                    '=', 'cust_plan_bottle_allocated.Cust_Plan_Id')
                ->join('customer__masters', 'customer__masters.Id',
                    '=', 'cust_plan_bottle_allocated.Cust_Plan_Id')
                ->join('bottel_type_masters', 'bottel_type_masters.Id',
                    '=', 'cust_plan_bottle_allocated.Bottle_Id')
                ->select('cust_plan_bottle_allocated.*', 'plan_masters.Name',
                    'bottel_type_masters.Name','customer__masters.Cust_Name')
                ->where('cust_plan_bottle_allocated.Enabled','=',0)
				->where('bottel_type_masters.User','=','DB')
                ->get();

            return view('customer_plan_bottle_allocated_list')->with('CustPlanBottleAlloc',$custplbottall);


        }catch (Exception $e)
        {
            return $e->getMessage();
            //return view('excaption');
        }
    }

    //add customer plan bottle allocated

    public function add_customer_plan_bottle_allocated()
    {
        try {

           /* $customer = DB::table('customer__masters')
                ->select('customer__masters.Id', 'customer__masters.Cust_Name')
                ->where('customer__masters.Enabled', '=', 0)
                ->orderBy('Cust_Name')
                ->get();

            $paln = DB::table('plan_masters')
                ->select('plan_masters.Id', 'plan_masters.Name')
                ->where('plan_masters.Enabled', '=', 0)
                ->orderBy('Name')
                ->get();*/

            $bottle = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name')
                ->where('bottel_type_masters.Enabled', '=', 0)
				->where('bottel_type_masters.User','=','DB')
                ->orderBy('Name')
                ->get();

            $cusplan = DB::table('customer_plans')
                ->select(DB::raw('CONCAT(Cust_Id, " - ", Plan_Id ) as name'),
                    'Id as Id')
                ->where('customer_plans.Enabled', '=', '0')
                ->orderBy('customer_plans.Cust_Id')
                ->get();




            return view('customer_plan_bottle_allocated_add')->with([
                'customers' => $cusplan,'bottles'=>$bottle,
                //'plan'=>$paln
            ]);


        }catch (Exception $e){
            return $e->getMessage();
         //   return view('excaption');


        }

    }

    //store customer plan bottle allocated

    public function store_customer_plan_bottle_allocated(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        try {

            $cust = DB::table('cust_plan_bottle_allocated')
                ->insert(['Bottle_Id'=>$request->txt_bottleid,
                    'Cust_Plan_Id'=>$request->txt_customerplanid,
                    'No_Of_Bottles'=>$request->txt_bottleno,
                    'created_at'=>$current_time
                ]);




            return redirect('ListCustPlanBottleAlloc')->with('success', "Record Stored Successfully");


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }

    //destroy customer plan bottle allocated

    public function destroy_customer_plan_bottle_allocated(Request $request)
    {
        try {
            $user = DB::table('cust_plan_bottle_allocated')->where('Id', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }




        }catch (Exception $e){
            //return $e->getMessage();
            return view('excaption');


        }

    }


    // show customer plan bottle allocated

    public function show_customer_plan_bottle_allocated($id)
    {
        try {

            $user = DB::table('cust_plan_bottle_allocated')->where('Id', '=', $id)->first();

            $bottle = DB::table('bottel_type_masters')
                ->select('bottel_type_masters.Id', 'bottel_type_masters.Name')
                ->where('bottel_type_masters.Enabled', '=', 0)
				->where('bottel_type_masters.User','=','DB')
                ->orderBy('Name')
                ->get();

            $cusplan = DB::table('customer_plans')
                ->select(DB::raw('CONCAT(Cust_Id, " - ", Plan_Id ) as name'),
                    'Id as Id')
                ->where('customer_plans.Enabled', '=', '0')
                ->orderBy('customer_plans.Cust_Id')
                ->get();




            return view('customer_plan_bottle_allocated_edit')->with([
                'customers' => $cusplan,'bottles'=>$bottle,
                'custplanbottallo'=>$user
            ]);


        }catch (Exception $e){
            //return $e->getMessage();
            return view('excaption');


        }

    }

    // edit customer plan bottle allocated

    public function edit_customer_plan_bottle_allocated(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        try {

            $cust = DB::table('cust_plan_bottle_allocated')->where('Id',$request->txt_id)
                ->update(['Bottle_Id'=>$request->txt_bottleid,
                    'Cust_Plan_Id'=>$request->txt_customerplanid,
                    'No_Of_Bottles'=>$request->txt_bottleno,
                    'updated_at'=>$current_time
                ]);



            return redirect('ListCustPlanBottleAlloc')->with('success', "Record Updated Successfully");


        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }


    /*end customer plan bottle allocated*/

	// Invoice Menu
	// Customer Invoice List
	public function list_CustInvoice()
	{
		try
		{
			
			$Area = DB::table('area_masters')
					->where('Enabled','=',0)
					->orderBy('Area_Name')
					->get();
				
			$sql="Select c.Cust_Name,c.Agency_Name,c.Id,c.Sequence_no,p.Name as Plan,";
			$sql .= "a.Area_Name,i.Amount,i.isPaid,i.Month1,i.Year1,c.Phone_No,i.Invoice_No";
			$sql .= " From customer__masters c,invoice_master_custs i, area_masters a, plan_masters p,customer_plans cp";
			$sql .= " Where c.Id=cp.Cust_Id";
			$sql .= " And cp.Plan_Id=p.Id";
			$sql .= " And c.Area_Id=a.Id";
			$sql .= " and c.Id=i.Cust_Id";
			$sql .= " Order by i.Year1 desc,i.Month1 desc,c.Sequence_no";
			//$sql = "select * from invoice_master_custs";
			$Invoice = DB::select($sql);
			return view('customer_incoice_list')->with([
				'Invoice'=>$Invoice
			]);
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}
	
	// Dealer Invoice List
	public function list_DealerInvoice()
	{
		try
		{
			$sql="Select c.Cust_Name,c.Agency_Name,c.Id,c.Sequence_no,p.Name as Plan";
			$sql .= "";
			$sql = "select * from invoice_master_custs";
			$sql = "Select di.Id,di.Month1, di.Year1, di.Invoice_No, ";
			$sql .= "d.Dealer_Name, d.Agency_Name, d.Phone_No, a.Area_Name,di.Amount,di.isPaid";
			$sql .= " From dealer_masters d, invoice_master_dealer di,area_masters a";
			$sql .= " Where d.Area_Id = a.Id";
			$sql .= " And d.Id=di.Dealer_Id ";
			$sql .= " Order by di.DoI desc,d.Agency_Name";
			
			$Invoice = DB::select($sql);
			return view('dealer_invoice_list')->with([
				'Invoice'=>$Invoice
			]);
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}

	// Generate Invoice
	public function Invoice_Genrate()
	{
		try
		{
			$Month1=date('m');
			$Year1=date('Y');
			
			return view('invoice_genrate')->with([
				'Month1'=>$Month1,
				'Year1'=>$Year1
			]);
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}

	public function Invoice_Generate_Store(Request $request)
	{
		try
		{
			$CD = $request->cmbCustDealer;
			$Year1 = $request->txt_year;
			$Month1 = $request->dp_month;
			$dt=date('Y-m-d');
			$current_time = Carbon::now()->toDateTimeString();
			if($CD=='Customer')
			{
				// $CustInv1=DB::table("invoice_master_custs")
					// ->where("Month1",'=',$Month)
					// ->where("Year1",'=',$Year);
				// $Cust=DB::table("customer__masters")
					// ->join("invoice");
				
				//Selct the customers whose current month's invoice is not created
				$sql = " select c.Id,c.Address, c.Agency_Name,c.Area_Id, c.Cust_Name,c.GST_No, c.isActive, c.Start_Date, ";
				$sql .= " c.Phone_No,cp.Plan_Id as Cust_Plan_Id,p.Bottle_Type_Id as Bottle_Id,";
				$sql .= " cp.No_Bottle as No_Of_Bottles,c.DoD ";
				$sql .= " , sum(ct.No_Of_Bottle) as cnt, b.Rate as Bottle_Rate ";
				$sql .= " from customer__masters c,customer_plans cp, cust_daily_transactions ct ";
				$sql .= " , bottel_type_masters b,plan_masters p ";
				$sql .= " where c.id not in (select cust_id from invoice_master_custs ";
				$sql .= " where month1 = " . $Month1;
				$sql .= " and year1 = " . $Year1 . ")";
				$sql .= " and cp.Cust_Id=c.Id";
				$sql .= " and ct.Cust_Id=c.Id";
				$sql .= " and p.Bottle_Type_Id=b.Id ";
				$sql .= " And cp.Plan_Id=p.Id ";
				$sql .= " Group by c.Id,c.Address, c.Agency_Name,c.Area_Id, c.Cust_Name,c.GST_No, c.isActive, c.Start_Date, ";
				$sql .= " c.Phone_No,cp.Plan_Id,p.Bottle_Type_Id, cp.No_Bottle,b.Rate,c.DoD ";
				echo $sql;
				$cust = db::select($sql);

				foreach($cust as $c)
				{
					echo "step 1;";
					$Inv_No= DB::table('invoice_master_custs')
							->orderby('Invoice_No','desc')
							->get()
							->first();
					$Invoice_No = $Inv_No->Invoice_No + 1;
					
					$Plan_det = DB::table('plan_masters')
							->where('Id',$c->Cust_Plan_Id)
							->get()
							->first();
					$dayCount=cal_days_in_month(CAL_GREGORIAN, $Month1, $Year1);
					$Bottle_count=0;
					$Amount=0;
					$MonthStart = $Year1 . "-" . $Month1 . "-1";
					$MonthEnd=$Year1 . "-" . $Month1 . "-" . $dayCount;
					$Extra_Bottles=0;
					$Invoice_Type = "";
					if($Plan_det->Plan_Type=='Monthly' && $c->Start_Date <= $MonthStart && ($c->DoD >= $MonthEnd || $c->DoD==NULL))
					{
						echo "step 2;";
						$Invoice_Type="Monthly";
						for($i=1;$i<=15;$i++)
						{
							$strDt = $Year1 . "-" . $Month1 . "-" . $i;
							//$strDt1 = new DateTime($strDt);
							$dayOfWeek = date('w',strtotime($strDt));
							//$dayOfWeek = strDt1->format('w');
							if($Plan_det->Int_Monday==1 && $dayOfWeek==0)
								$dayCount=$dayCount+1;
							elseif($Plan_det->Int_Tuesday==1 && $dayOfWeek==1)
								$dayCount=$dayCount+1;
							elseif($Plan_det->Int_Wednesday==1 && $dayOfWeek==2)
								$dayCount=$dayCount+1;
							elseif($Plan_det->Int_Thursday==1 && $dayOfWeek==3)
								$dayCount=$dayCount+1;
							elseif($Plan_det->Int_Friday==1 && $dayOfWeek==4)
								$dayCount=$dayCount+1;
							elseif($Plan_det->Int_Saturday==1 && $dayOfWeek==5)
								$dayCount=$dayCount+1;
							elseif($Plan_det->Int_Sunday==1 && $dayOfWeek==6)
								$dayCount=$dayCount+1;
						}
						$Bottle_count=$dayCount* $c->No_Of_Bottles;
						$Extra_Bottles = $c->cnt - $Bottle_count;
						if($Extra_Bottles>=1)
							$Amount = $Plan_det->Rate * $c->No_Of_Bottles + $Extra_Bottles * $c->Bottle_Rate ;
					}
					else
					{
						echo "step 3;";
						$Amount=$c->Bottle_Rate * $c->cnt;
						$Invoice_Type="Daily";
						//$Amount = $Bottle_count * $Plan_det->Rate;
					}
					
				//check for the plan and extra bottles
					//$cntBottle = getExtraBottleCount($c->Id,$month,$year);
				// Temporary set data same amount as of plan
					$sql = "Select ";
					$res = DB::table('invoice_master_custs')
						->insert(['Cust_Id'=>$c->Id,
								'Name'=>$c->Agency_Name,
								'Address'=>$c->Address,
								'GST_No'=>$c->GST_No,
								'DoI'=>$dt,
								'Invoice_No'=>$Invoice_No,
								'Month1'=>$Month1,
								'Year1'=>$Year1,
								'isPaid'=>false,
								'Plan_Id'=>$c->Cust_Plan_Id,
								'Default_Bottles'=>$Bottle_count,
								'Extra_Bottles'=>0,
								'Total_Bottles'=>$Bottle_count,
								'Remark'=>$Invoice_Type,
								'created_at'=>$current_time,
								'Amount'=>$Amount]);
								
				//input data in invoice_cust_master
					$inv = DB::table('invoice_master_custs')
						->orderBy('Id','desc')
						->get()
						->first();
					$res = DB::table('invoice_details_cust')
						->insert(['Bottle_Id'=>$Plan_det->Bottle_Type_Id,
								'Inv_Mst_Cust_Id'=>$inv->Id,
								'No_Of_Bottles'=>$Bottle_count,
								'Rate'=>$Plan_det->Rate,
								'Remark'=>'',
								'Amount'=>$Amount,
								'Plan_Type'=>$Plan_det->Plan_Type]);
								
								
				//input data in invoice_cust_details
				
				}
				//return redirect('ListCustInvoice');
			}
			elseif($CD=='Dealer')
			{
				//Select the dealer of which invoice are not made in the selected month.
				// But the transsactions are available.
				$sql = "Select * from dealer_masters";
				$sql .= " Where Id in (Select Dealer_Id from dealer_daily_transactions";
				$sql .= " Where month(DoT)=" . $Month1;
				$sql .= " And year(DoT)=" . $Year1 .")";
				$sql .= " And Id not in (Select Dealer_Id from invoice_master_dealer ";
				$sql .= " Where Month1=" . $Month1;
				$sql .= " And Year1=" . $Year1 . ")";
				$dealers = DB::select($sql);
				echo $sql;
				//Store the data in Invoice Master.
				//loop through the dealers and get the data for invoice details dealer
				foreach($dealers as $d)
				{	
					$Max_Inv=1;
					$Max_Inv1 = DB::table('invoice_master_dealer')
							->orderBy('Invoice_No','desc')
							->get()
							->first();
					if(isset($Max_Inv1))
					{
						$Max_Inv = $Max_Inv1->Invoice_No;
						$Max_Inv = $Max_Inv + 1;
					}
					$res = DB::table('invoice_master_dealer')
						->insert(['Dealer_Id'=>$d->Id,'Dealer_Name'=>$d->Dealer_Name,
								'Agency_Name'=>$d->Agency_Name,
								'Month1'=>$Month1,
								'Year1'=>$Year1,
								'DoI'=>$dt,
								'Amount'=>0,
								'GST_No'=>$d->GST_No,
								'isPaid'=>false,
								'Remark'=>'',
								'Invoice_No'=>$Max_Inv,
								'Address'=>$d->Address]);
					
					$d_Id = DB::table('invoice_master_dealer')
							->orderBy('Id','desc')
							->get()
							->first();
					$sql = "Select dt.Bottle_Type, sum(dt.No_Of_Bottle) as No_Of_Bottles,dp.Rate,";
					$sql .= " sum(dt.No_Of_Bottle * dp.Rate) as Total";
					$sql .= " from dealer_daily_transactions dt,dealer_plan_rels dp";
					$sql .= " Where dt.Dealer_Id=" . $d->Id;
					$sql .= " And month(DoT)=" . $Month1;
					$sql .= " And year(DoT)=" . $Year1;
					$sql .= " And dt.Dealer_Id=dp.Dealer_Id";
					$sql .= " And dt.Bottle_Type = dp.Bottle_Id";
					$sql .= " Group by dt.Bottle_Type,dp.Rate";
					
					$Trans_Det = DB::select($sql);
					$Amt=0;
					foreach($Trans_Det as $t)
					{
						$res = DB::table('invoice_details_dealer')
							->insert(['Inv_Mst_Dealer_Id'=>$d_Id->Id,'Bottle_Id'=>$t->Bottle_Type,
									'No_Of_Bottles'=>$t->No_Of_Bottles,
									'Rate'=>$t->Rate,
									'Amount'=>$t->Total,
									'Remark'=>'']);
						$Amt = $Amt + $t->Total;
					}
					//$sql = "Update invoice_master_dealer set Amount=" . $Amt;
					//$sql .= " Where Id=" . $d->Id;
					$dealer_update = DB::table('invoice_master_dealer')->where('Id',$d_Id->Id)
						->update(['Amount'=>$Amt]);
							
					
				}
				
				
				//return to Invoice list
				
				// $sql = "Select d.Dealer_Name,d.Address,a.Name as Area,d.Agency_Name,d.GST_No,";
				// $sql .= " sum(dt.No_Of_Bottle * dp.Rate) as Amount, dt.No_Of_Bottle,dp.Rate,b.Name as BottleName ";
				// $sql .= " From dealer_masters d, area_masters a,dealer_daily_transactions dt,";
				// $sql .= " dealer_plan_rels dp, bottel_type_masters b";
				// $sql .= " Where d.Area_Id=a.Id ";
				// $sql .= " And dt.Dealer_Id=d.Id";
				// $sql .= " And dp.Bottle_Id=b.Id";
				// $sql .= " And dp.Dealer_Id=d.Id";
				// $sql .= " And month(dt.DoT)=" . $Month;
				// $sql .= " And year(dt.DoT)=" . $Year;
				// $d_inv = DB::select($sql);
				// foreach($d_inv as $d_inv1)
				// {
					// $res = DB:table('invoice_master_dealer')
						// ->insert([''
					
		// //			$country = DB::table('country_masters')
        // //            ->insert(['Country_Name'=>$request->txt_countryname,
        // //                'created_at'=>$current_time]);
				// }
				return redirect('ListDealerInvoice');
			}
			
			
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}
	
	////////////////// Get the Bottle count for customer for given Month according to plan
	function getExtraBottleCount($cid,$Month1,$Year1,$pid)
	{
		try
		{
			$Plan = DB::table("plan_masters")
				->where('Id','=',$pid);
			$cust = DB::table("customer__masters")
				->where('Id','=',$cid);
			$startDate = $Year1 . "-" . $Month1 . "-1";
			$endDate = $Year1 . "-" . $Month1 . date('t');
			for($d=$startDate;$d<=$endDate;$d++)
			{
				//if(date('N',$d)==1 && )
					
			}
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}
	/* End Invoice Menu */

    public function Customer_Collection()
    {
        try
        {
            $sql="Select c.Cust_Name,c.Agency_Name,c.Id,c.Sequence_no,p.Name as Plan";
			$sql .= "";
			$sql = "select * from invoice_master_custs";
			$Invoice = DB::select($sql);
					
			return view('customer_collection_list')->with([
				'Invoice'=>$Invoice
			]);
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }

	public function Customer_Collection_Show(Request $request)
    {
        try
        {
            $sql="Select c.Cust_Name,c.Agency_Name,c.Id,c.Sequence_no,p.Name as Plan";
			$sql .= "";
			$sql = "select * from invoice_master_custs";
			$Invoice = DB::select($sql);
					
			return view('customer_collection_list')->with([
				'Invoice'=>$Invoice
			]);
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }
	
    public function Dealer_Collection()
    {
        try
        {
			
			$sql="Select c.Cust_Name,c.Agency_Name,c.Id,c.Sequence_no,p.Name as Plan";
			$sql .= "";
			$sql = "select * from invoice_master_custs";
			$Invoice = DB::select($sql);
					
			
            return view('dealer_collection_list')->with([
				'Invoice'=>$Invoice
			]);
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }


    public function Monthly_Attendance()
    {
        try
        {
			$Year1 = date('Y');
			$Month1 = date('m');
			$selArea = 0;
			$Area = DB::table("area_masters")
					->where('Enabled','=',0)
					->orderBy('Area_Name')
					->get();
            return view('monthly_attendance_report')->with([
					'Area'=>$Area,
					'Year1'=>$Year1,
					'Month1'=>$Month1,
					'Att'=>null,
					'selArea'=>$selArea
					]);
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }
	
	public function Monthly_Attendance_Show(Request $request)
	{
		try
		{
			$Area = DB::table("area_masters")
					->where('Enabled','=',0)
					->orderBy('Area_Name')
					->get();
			$selArea = $request->cmbArea;
			$Month1 = $request->cmbMonth;
			$Year1 = $request->txtYear;
			
			$sql = "Select c.Id,c.Agency_Name, c.Cust_Name, p.Name as Plan,p.Plan_Type,cp.No_Bottle";
			$sql .= ", c.Sequence_no";
			//$sql .= ", Case when cpb1.No_Of_Bottles<>null then cpb1.No_Of_Bottles else 0 end as Jug_20L";
			//$sql .= ", Case when cpb2.No_Of_Bottles<>null then cpb2.No_Of_Bottles else 0 end as Bot_20L";
			$sql .= ", cpb1.No_Of_Bottles as Jug_20L";
			$sql .= ", cpb2.No_Of_Bottles as Bot_20L";
			
			$sql .= " From customer__masters c,plan_masters p, customer_plans cp";
			$sql .= " left join cust_plan_bottle_allocated cpb1 on cpb1.Cust_Plan_Id=cp.Id and cpb1.Bottle_Id=16";
			$sql .= " left join cust_plan_bottle_allocated cpb2 on cpb2.Cust_Plan_Id=cp.Id and cpb2.Bottle_Id=17";
			//$sql .= " left join bottel_type_masters b1 on cpb1.Bottle_Id=b1.Id";
			//$sql .= " left join bottel_type_masters b2 on cpb2.Bottle_Id=b1.Id";
			$sql .= " Where c.Id=cp.Cust_Id";
			$sql .= " and p.Id=cp.Plan_Id";
			$sql .= " And c.Area_Id=" . $selArea;
			$sql .= " And p.Plan_Type='Monthly'";
			$cust = DB::select($sql);
			$att = array();
			foreach($cust as $c)
			{
				$att1=array();
				//array_push($att1,'Name'=>$c->Agency_Name . ' - ' . $c->Cust_Name);
				array_push($att1,$c->Agency_Name . ' - ' . $c->Cust_Name);
				array_push($att1,$c->Sequence_no);
				array_push($att1,$c->Jug_20L);
				array_push($att1,$c->Bot_20L);
				$sql = "Select ct.Id,day(ct.DoT) as Day1,ct.No_Of_Bottle,ct.DoT, b.Name as Bottle_Name ";
				$sql .= " from cust_daily_transactions ct, bottel_type_masters b";
				$sql .= " Where Cust_Id=" . $c->Id;
				$sql .= " And b.Id = ct.Bottle_Type ";
				$sql .= " And month(DoT)=" . $Month1;
				$sql .= " And year(DoT)=" . $Year1;
				$sql .= " Order by DoT";
				$res = DB::select($sql);
				$i=1;
				
				if(is_null($res)==true)
				{
					for($j=1;$j<=31;$j++)
					{
						array_push($att1,0);
					}
				}
				else
				{
					foreach($res as $r)
					{
						if($r->Day1 > $i)
						{
							for($i;$i<$r->Day1;$i++)
								array_push($att1,0,0);
						}
						
							array_push($att1,$r->No_Of_Bottle,$r->Id);
							$i=$i+1;
						
					}
					for($i=$i;$i<=31;$i++)
						array_push($att1,0,0);
				}
				array_push($att,$att1);
			}
            return view('monthly_attendance_report')->with([
					'Area'=>$Area,
					'Year1'=>$Year1,
					'Month1'=>$Month1,
					'Att'=>$att,
					'selArea'=>$selArea
					]);
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}

	// Monthly Attendance list: Code before edit data added. Working
/*	public function Monthly_Attendance_Show(Request $request)
	{
		try
		{
			$Area = DB::table("area_masters")
					->where('Enabled','=',0)
					->orderBy('Area_Name')
					->get();
			$selArea = $request->cmbArea;
			$Month1 = $request->cmbMonth;
			$Year1 = $request->txtYear;
			
			$sql = "Select c.Id,c.Agency_Name, c.Cust_Name, p.Name as Plan,p.Plan_Type,cp.No_Bottle";
			$sql .= ", c.Sequence_no";
			//$sql .= ", Case when cpb1.No_Of_Bottles<>null then cpb1.No_Of_Bottles else 0 end as Jug_20L";
			//$sql .= ", Case when cpb2.No_Of_Bottles<>null then cpb2.No_Of_Bottles else 0 end as Bot_20L";
			$sql .= ", cpb1.No_Of_Bottles as Jug_20L";
			$sql .= ", cpb2.No_Of_Bottles as Bot_20L";
			
			$sql .= " From customer__masters c,plan_masters p, customer_plans cp";
			$sql .= " left join cust_plan_bottle_allocated cpb1 on cpb1.Cust_Plan_Id=cp.Id and cpb1.Bottle_Id=16";
			$sql .= " left join cust_plan_bottle_allocated cpb2 on cpb2.Cust_Plan_Id=cp.Id and cpb2.Bottle_Id=17";
			//$sql .= " left join bottel_type_masters b1 on cpb1.Bottle_Id=b1.Id";
			//$sql .= " left join bottel_type_masters b2 on cpb2.Bottle_Id=b1.Id";
			$sql .= " Where c.Id=cp.Cust_Id";
			$sql .= " and p.Id=cp.Plan_Id";
			$sql .= " And c.Area_Id=" . $selArea;
			$sql .= " And p.Plan_Type='Monthly'";
			$cust = DB::select($sql);
			$att = array();
			foreach($cust as $c)
			{
				$att1=array();
				//array_push($att1,'Name'=>$c->Agency_Name . ' - ' . $c->Cust_Name);
				array_push($att1,$c->Agency_Name . ' - ' . $c->Cust_Name);
				array_push($att1,$c->Sequence_no);
				array_push($att1,$c->Jug_20L);
				array_push($att1,$c->Bot_20L);
				$sql = "Select Id,day(DoT) as Day1,No_Of_Bottle from cust_daily_transactions ";
				$sql .= " Where Cust_Id=" . $c->Id;
				$sql .= " And month(DoT)=" . $Month1;
				$sql .= " And year(DoT)=" . $Year1;
				$sql .= " Order by DoT";
				$res = DB::select($sql);
				$i=1;
				
				if(is_null($res)==true)
				{
					for($j=1;$j<=31;$j++)
					{
						array_push($att1,0);
					}
				}
				else
				{
					foreach($res as $r)
					{
						if($r->Day1 > $i)
						{
							for($i;$i<$r->Day1;$i++)
								array_push($att1,0,0);
						}
						
							array_push($att1,$r->No_Of_Bottle,$r->Id);
							$i=$i+1;
						
					}
					for($i=$i;$i<=31;$i++)
						array_push($att1,0,0);
				}
				array_push($att,$att1);
			}
            return view('monthly_attendance_report')->with([
					'Area'=>$Area,
					'Year1'=>$Year1,
					'Month1'=>$Month1,
					'Att'=>$att,
					'selArea'=>$selArea
					]);
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}
*/

    public function Dealer_Transaction()
    {
        try
        {
            return view('dealer_transaction_report');
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }

	//Show Attendance Edit page on click of Attendance report
	public function Edit_Attendance_Single($Id)
	{
		try
		{
			$sql = "Select c.Agency_Name,c.Cust_Name,cp.No_Bottle,p.Name as Plan,ct.*";
			$sql .= " From customer__masters c,customer_plans cp, cust_daily_transactions ct ";
			$sql .= " c.Id=cp.Cust_Id";
			$sql .= " c.Id=ct.Cust_Id";
			$sql .= " ct.Id="  . $Id;
			$Att = DB::select($sql);
			
			return view('attedance_edit')->with([
					'attendance'=>$Att
					]);
					
		}
		catch(Exception $e)
		{
			return$e->getMessage();
		}
	}

	// Blank Attendance Sheet blank page
    public function rptBlank_Att_Sheet()
    {

        try {

            $Year1 = date('Y');
			$Month1 = date('m');
			$Type = "Daily";
			$Area = DB::table("area_masters")
				->orderBy("Area_Name")	// "Select * from area_masters order by Area_Name";
				->get();
				
            return view('rpt_blank_monthly_att')->with(
				[
					'Month1'=>$Month1,
					'Year1' => $Year1,
					'Type' => $Type,
					'Area' => $Area,
					'Area_Sel' => 0,
					'Cust_List' => null
					
				]
			);

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }

    }

	public function rptBlank_Att_Sheet_Show(Request $request)
    {

        try {

            //$Year1 = $request->txtYear;
			//$Month1 = $request->cmbMonth;
			$Type = $request->cmbType;
			$Area = DB::table("area_masters")
				->orderBy("Area_Name")	// "Select * from area_masters order by Area_Name";
				->get();
			$Area_Sel = $request->cmbArea;
			//echo 'Area : ' . $Area_Sel . ";plan_Type:" . $Type;
			
			if($Area_Sel==0)
			{
				// $cust = DB::table("customer__masters")
					// ->join('customer_plans','customer_plans.Cust_Id','=','customer__masters.Id')
					// ->join('plan_masters','plan_masters.Id','=','customer_plans.Plan_Id')
					// ->where('plan_masters.Plan_Type','=','$Type')
					// ->get();
				$sql = "select c.* ";
				$sql .= " from customer__masters c,customer_plans cp,plan_masters p ";
				$sql .= " where c.Id=cp.Cust_Id ";
				$sql .= " and p.Id=cp.Plan_Id ";
				$sql .= " Order by c.Area_Id,c.Sequence_no";
				//$sql .= " and cp.Area_Id=" . $Area_Sel;
				//$sql .= " and p.Plan_Type='" . $Type . "' ";
				$cust = DB::select($sql);	
			}
			else
			{
				//$cust = DB::table("customer__masters")
					// ->join('customer_plans','customer_plans.Cust_Id','=','customer__masters.Id')
					// ->join('plan_masters','plan_masters.Id','=','customer_plans.Plan_Id')
					// ->where('plan_masters.Plan_Type','=','$Type')
					// ->where('customer_plans.Area_Id','=',$Area_Sel)
					// ->where('customer__masters.Enabled','=',0)
					// ->get();
				$sql = "select c.* ";
				$sql .= " from customer__masters c,customer_plans cp,plan_masters p ";
				$sql .= " where c.Id=cp.Cust_Id ";
				$sql .= " and p.Id=cp.Plan_Id ";
				$sql .= " and cp.Area_Id=" . $Area_Sel;
				$sql .= " and p.Plan_Type='" . $Type . "' ";
				$sql .= " Order by c.Sequence_no";
				$cust = DB::select($sql);
			}
			
            return view('rpt_blank_monthly_att')->with(
				[
					//'Month1'=>$Month1,
					//'Year1' => $Year1,
					'Type' => $Type,
					'Area' => $Area,
					'Area_Sel' => $Area_Sel,
					'Cust_List' => $cust
				]
			);

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }
	
	// Customer Report
    public function rptCust_Report()
    {

        try 
		{
			$dtFrom = date('Y-m-d');
			$dtTo = date('Y-m-d');
            
				
            return view('rpt_cust_report')->with(
				[
					'dtFrom' => $dtFrom,
					'dtTo' => $dtTo,
					'Cust_List' => null
				]
			);

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }

	public function rptCust_Report_Show(Request $request)
    {

        try {

            $dtFrom = $request->dtFrom;
			$dtTo = $request->dtTo;
			$sql = "Select c.Agency_Name,c.Start_Date,c.DoD,p.Name as Plan,a.Area_Name as Area,d.Boy_Name as DeliveryBoy ";
			$sql .= " From customer__masters c,plan_masters p, area_masters a, delivery_boy_masters d, ";
			$sql .= " customer_plans cp, cust_delivery_boy_rels cb";
			$sql .= " Where c.Id=cp.Cust_Id";
			$sql .= " And cp.Plan_Id=p.Id";
			$sql .= " And a.Id=cp.Area_Id";
			$sql .= " And d.Id=cb.Delivery_Boy_Id";
			$sql .= " And c.Id=cb.Customer_Id";
			$sql .= " And ((c.Start_Date>='$dtFrom' And c.Start_Date<='$dtTo') ";
			$sql .= " OR (c.DoD>='$dtFrom' And c.DoD<='$dtTo')) ";
			$Cust_List = DB::select($sql);
			return view('rpt_cust_report')->with(
				[
					'dtFrom' => $dtFrom,
					'dtTo' => $dtTo,
					'Cust_List' => $Cust_List
				]
			);
        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }
	
	// Next Day Bottle count Report
    public function rptNext_Day_Bottle_Count()
    {

        try 
		{
			$dtFrom = date('Y-m-d');
			
            $dtFrom = date('Y-m-d', strtotime($dtFrom .' +1 day'));
				
            return view('rpt_next_day_bottle_count')->with(
				[
					'dtFrom' => $dtFrom,
					
					'Cust_List' => null
				]
			);

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }

	public function rptNext_Day_Bottle_Count_Show(Request $request)
    {

        try {

            $dtFrom = $request->dtFrom;
			//$dtTo = $request->dtTo;
			$sql = "select d.Boy_Name,b.Name as Bottle_Name,sum(cp.No_Bottle) as bottle_count,";
			$sql .= " sum(case when p.Plan_Type='Daily' then cp.No_Bottle else case when weekday('" . $dtFrom . "')=0 then p.Int_Monday * cp.No_Bottle";
			$sql .= " when weekday('" . $dtFrom . "')=1 then p.Int_Tuesday * cp.No_Bottle";
			$sql .= " when weekday('" . $dtFrom . "')=2 then p.Int_Wednesday * cp.No_Bottle";
			$sql .= " when weekday('" . $dtFrom . "')=3 then p.Int_Thursday * cp.No_Bottle";
			$sql .= " when weekday('" . $dtFrom . "')=4 then p.Int_Friday * cp.No_Bottle";
			$sql .= " when weekday('" . $dtFrom . "')=5 then p.Int_Saturday * cp.No_Bottle";
			$sql .= " else p.Int_Sunday * cp.No_Bottle end end) as Bottle_Cnt_1";
			$sql .= " ,a.Area_Name ";
			$sql .= " from delivery_boy_masters d,bottel_type_masters b, customer_plans cp,plan_masters p, cust_delivery_boy_rels cb, customer__masters c, area_masters a ";
			$sql .= " where d.Id=cb.Delivery_Boy_Id";
			$sql .= " and cb.Customer_Id = c.Id";
			$sql .= " and cp.Cust_Id = c.Id";
			$sql .= " and cp.Plan_Id = p.Id";
			$sql .= " and p.Bottle_Type_Id = b.Id";
			$sql .= " and b.User='DB'";
			$sql .= " And a.Id=cp.Area_Id ";
			$sql .= " Group by d.Boy_Name,b.Name,a.Area_Name";
			//echo $sql;
			$Cust_List = DB::select($sql);
			return view('rpt_next_day_bottle_count')->with(
				[
					'dtFrom' => $dtFrom,
					//'dtTo' => $dtTo,
					'Cust_List' => $Cust_List
				]
			);
        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }
	
		// Daily Bottles Trans Report : Takes Date. and return 
		// Delivery boy has to take bottles/ How much he take/ Attendance on his rout (Cust*Bottles count)
    public function rptDeaily_Bottles_Trans()
    {

        try 
		{
			$dtFrom = date('Y-m-d');
			//$dtTo = date('Y-m-d');
            
			
            return view('rpt_daily_report_bottle_count')->with(
				[
					'dtFrom' => $dtFrom,
					//'dtTo' => $dtTo,
					'Cust_List' => null
				]
			);

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }

	public function rptDeaily_Bottles_Trans_Show(Request $request)
    {

        try {

            $dtFrom = $request->dtFrom;
			//$dtTo = $request->dtTo;
			
			
			$sql = "select d.Boy_Name,sum(case when dt1.In_Out='In' then dt1.Count else 0 end) as dIn, ";
			$sql .= " sum(case when dt2.In_Out='Out' then dt2.Count else 0 end) as dOut,";
			$sql .= " sum(ct.No_Of_Bottle) as Att, b.Name as BottleName ,d.Id";
			$sql .= " from  delivery_boy_daily_transactions dt1,delivery_boy_daily_transactions dt2,";
			$sql .= " bottel_type_masters b, delivery_boy_masters d";
			$sql .= " left join cust_delivery_boy_rels cd on cd.Delivery_Boy_Id=d.Id";
			$sql .= " left JOIN cust_daily_transactions ct on ct.Cust_Id=cd.Customer_Id";
			$sql .= " where d.Id=dt1.Delivery_Boy_Id ";
			$sql .= " and  d.Id=dt2.Delivery_Boy_Id ";
			$sql .= " and b.Id=ct.Bottle_Type and dt1.Bottle_Type_Id = b.Id ";
			$sql .= " and dt2.Bottle_Type_Id = b.Id ";
			$sql .= " and dt1.DoT = '" . $dtFrom . "' ";
			$sql .= " and dt2.DoT = '" . $dtFrom . "' ";
			$sql .= " and dt1.In_Out='In'";
			$sql .= " and dt2.In_Out='Out'";
			$sql .= " and b.User='DB'";
			$sql .= " and ct.DoT='" . $dtFrom . "' ";
			$sql .= " group by d.Boy_Name,d.Id,b.Name";
						
			//echo $sql;
			$Cust_List = DB::select($sql);
			return view('rpt_daily_report_bottle_count')->with(
				[
					'dtFrom' => $dtFrom,
					//'dtTo' => $dtTo,
					'Cust_List' => $Cust_List
				]
			);
        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }
	
	//Dealer_Payment_Collection with Invoice Id
	public function Dealer_Payment_Collection($Id)
	{
		try
		{
			$DoT = date('Y-m-d');
			// Get the dealer details with given invoice id's details
			// Also get the total pending amount
			$sql = "Select i.*,d.Dealer_Name,d.Agency_Name ";
			$sql .= " From invoice_master_dealer i, dealer_masters d ";
			$sql .= " where d.Id=i.Dealer_Id";
			//$sql .= " c.Id=ct.Cust_Id";
			$sql .= " and i.Id="  . $Id;
			$Inv_details = DB::select($sql);//
					//->get()
					//->first();
			$sql = "Select ifnull(sum(i.Amount),0) - ifnull(sum(dc.Amount),0) - ifnull(sum(dc.Discount),0) as amt";
			$sql .= " From invoice_master_dealer i,dealer_collection dc ";
			$sql .= " Where i.Dealer_Id = dc.Dealer_Id ";
			$sql .= " And i.Dealer_Id = (Select Dealer_Id from invoice_master_dealer where Id=" . $Id . ")";
			//echo $sql;
			$Total_Pending = DB::select($sql);
			foreach($Inv_details as $inv1)
				$Inv_Amt = $inv1->Amount;
			//$Prev_Pending = $Total_Pending - $Inv_Amt;
				//->get()
				//->first();
			return view('dealer_collection')->with([
					'Inv_Details'=>$Inv_details[0],
					'Total_Pending'=> $Total_Pending[0],
					'DoT'=>$DoT
					
					]);
					
		}
		catch(Exception $e)
		{
			return$e->getMessage();
		}
	}
	
	public function store_Dealer_Payment_Collection(Request $request)
	{
		try
		{
			//check if payment amount = bill amount?
			//If yes then mark that payment as isPaid true
			$Id=$request->txt_id;
			$sql = "Select sum(i.Amount) - sum(dc.Amount) - sum(dc.Discount) as amt";
			$sql .= " From invoice_master_dealer i,dealer_collection dc ";
			$sql .= " Where i.Dealer_Id = dc.Dealer_Id ";
			$sql .= " And i.Dealer_Id = (Select Dealer_Id from invoice_master_dealer where Id=" . $Id . ")";
			$Total_Pending = DB::select($sql);
				//->get()
				//->first();
			$Inv = db::table('invoice_master_dealer')
				->where('Id','=',$request->txt_id)
				->get()
				->first();
			$sql = "Select * from dealer_masters where id in (Select Dealer_Id from invoice_master_dealer ";
			$sql .= " where Id=" . $request->txt_id & ")";
			$dealer = DB::table('dealer_masters')
				->join('invoice_master_dealer','invoice_master_dealer.Dealer_Id','dealer_masters.Id')
				->select('dealer_masters.Id')
				->where('invoice_master_dealer.Id','=',$request->txt_id)
				->get()
				->first();
				
			
				$res = DB::table("dealer_collection")
					->insert(['Dealer_Id'=>$dealer->Id,
							'DoT'=>$request->txt_Date,
							'Amount'=>$request->txtAmount,
							'Invoice_No'=>$Inv->Invoice_No,
							'Discount'=>$request->txtDiscount,
							'Remark'=>'']);
								
					
							// //			$country = DB::table('country_masters')
        // //            ->insert(['Country_Name'=>$request->txt_countryname,
        // //                'created_at'=>$current_time]);
			if($Total_Pending[0]->amt <= $request->txtAmount + $request->txtDiscount)
			{
				$res = DB::table('invoice_master_dealer')
					->where('Dealer_Id',$dealer->Id)
					->update(['isPaid'=>true]);
					//;
			}
			//Else save with isPaid=false
			
			//Save the record in dealer_collection table
			
			
					
			return redirect('ListDealerInvoice')->with('success','Collection Stored Successfully');
					
		}
		catch(Exception $e)
		{
			return$e->getMessage();
		}
	}
	
	//Customer_Payment_Collection with Invoice Id
	public function Customer_Payment_Collection($Id)
	{
		try
		{
			$DoT = date('Y-m-d');
			// Get the dealer details with given invoice id's details
			// Also get the total pending amount
			$sql = "Select i.*,c.Cust_Name,c.Agency_Name ";
			$sql .= " From invoice_master_custs i, customer__masters c ";
			$sql .= " where c.Id=i.Cust_Id";
			//$sql .= " c.Id=ct.Cust_Id";
			$sql .= " and i.Id="  . $Id;
			//$Inv_details = DB::select($sql)->first();//
			$Inv_details = DB::table('invoice_master_custs as i')
							->join('customer__masters as c','c.Id','=','i.Cust_Id')
							->where('c.Id','=',$Id)
							->get()
							->first();
			//$Inv_details = $Inv_details1[0];
					//->get()
					//->first();
			$sql = "Select sum(i.Amount) - sum(dc.Amount) - sum(dc.Discount) as amt";
			$sql .= " From invoice_master_custs i,customer_collection dc ";
			$sql .= " Where i.Cust_Id = dc.Cust_Id ";
			$sql .= " And i.Cust_Id = (Select Cust_Id from invoice_master_custs where Id=" . $Id . ")";
			$Total_Pending = DB::select($sql);
				//->get()
				//->first();
			return view('customer_collection')->with([
					'Inv_Details'=>$Inv_details,
					'Total_Pending'=> $Total_Pending[0]->amt,
					'DoT'=>$DoT
					]);
					
		}
		catch(Exception $e)
		{
			return$e->getMessage();
		}
	}
	
	public function store_Customer_Payment_Collection(Request $request)
	{
		try
		{
			//check if payment amount = bill amount?
			//If yes then mark that payment as isPaid true
			$Id=$request->txt_id;
			//echo $Id;
			$sql = "Select sum(i.Amount) - sum(dc.Amount) - sum(dc.Discount) as amt";
			$sql .= " From invoice_master_custs i,customer_collection dc ";
			$sql .= " Where i.Cust_Id = dc.Cust_Id ";
			$sql .= " And i.Cust_Id = " . $Id  ;
			//echo $sql;
			$Total_Pending = DB::select($sql);
				//->get()
				//->first();
			$Inv = db::table('invoice_master_custs')
				->where('Id','=',$Id)
				->orderBy('Invoice_No','desc')
				->get()
				->first();
			$sql = "Select * from customer__masters where id in (Select Cust_Id from invoice_master_custs ";
			$sql .= " where Id=" . $Id & ")";
			echo $sql;
			// $dealer = DB::table('customer__masters')
				// ->join('invoice_master_custs','invoice_master_custs.Cust_Id','=','customer__masters.Id')
				// //->select('customer__masters.Id')
				// ->where('invoice_master_custs.Id','=',$Id)
				// ->get()
				// ->first();
				
			echo "Step1:";
			
			//echo $request->txtDiscount . ":";
			//echo $Inv->Invoice_No . ":";
			
			//echo $Inv->Cust_Id . ":";
			$res = DB::table("customer_collection")
					->insert(['Cust_Id'=>$Id,
							'DoT'=>$request->txt_Date,
							'Amount'=>$request->txtAmount,
							'Invoice_No'=>0,
							'Discount'=>$request->txtDiscount==null || $request->txtDiscount==''?0:$request->txtDiscount,
							'Remark'=>'']);
								
			//echo "Step2";	
			if($Total_Pending[0]->amt <= $request->txtAmount + $request->txtDiscount)
			{
				$res = DB::table('invoice_master_custs')
					->where('Cust_Id',$Id)
					->update(['isPaid'=>true]);
					//;
			}
			//Else save with isPaid=false
			
			//Save the record in dealer_collection table
			
			
					
			return redirect('ListCustInvAreaWise')->with('success','Collection Stored Successfully');
					
		}
		catch(Exception $e)
		{
			return$e->getMessage();
		}
	}
	
	public function destroy_invoice_dealer(Request $request)
    {
        try {
            $user1 = DB::table('invoice_details_dealer')->where('Inv_Mst_Dealer_Id', $request->id)->delete();
			$user = DB::table('invoice_master_dealer')->where('Id',$request->Id)->delete();
            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }




        }catch (Exception $e){
            //return $e->getMessage();
            return view('excaption');


        }

    }
	
	public function destroy_Invoice_Customer(Request $request)
    {
        try {
            $user1 = DB::table('invoice_details_cust')->where('Inv_Mst_Cust_Id', $request->id)->delete();
			$user = DB::table('invoice_master_custs')->where('Id',$request->Id)->delete();
            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }




        }catch (Exception $e){
            //return $e->getMessage();
            return view('excaption');


        }

    }
	
	public function rptDealer_Invoice_Print($Id)
    {
        try 
		{
			$Invoice = DB::table('invoice_master_dealer')
					->where('Id','=',$Id)
					->get()
					->first();
			$Invoice_Detail = DB::table('invoice_details_dealer')
					->join('bottel_type_masters','bottel_type_masters.Id','invoice_details_dealer.Bottle_Id')
					->select('invoice_details_dealer.*','bottel_type_masters.Name')
					->where('Inv_Mst_Dealer_Id','=',$Id)
					->where('bottel_type_masters.User','=','Dealer')
					->get();
					
            $dealer = DB::table('dealer_masters')
                //->select('customer__masters.Id', 'customer__masters.Cust_Name')
                ->where('Id', '=', $Invoice->Dealer_Id)
                //->orderBy('Cust_Name')
                ->get()
				->first();

            

            return view('rptdealer_invoice_print')->with([
                'Invoice' => $Invoice,
                'Invoice_Detail' => $Invoice_Detail,
                'Dealer'=>$dealer
            ]);

        } catch (Exception $e) {

return $e->getMessage();
            //return view('excaption');

        }


    }
	
	public function rptCustomer_Invoice_Print($Id)
    {
        try 
		{
			$Invoice = DB::table('invoice_master_custs')
					->where('Id','=',$Id)
					->get()
					->first();
			$Invoice_Detail = DB::table('invoice_details_cust')
					->join('bottel_type_masters','bottel_type_masters.Id','invoice_details_cust.Bottle_Id')
					->select('invoice_details_cust.*','bottel_type_masters.Name')
					->where('Inv_Mst_Cust_Id','=',$Id)
					->where('bottel_type_masters.User','=','DB')
					->get();
					
            $cust = DB::table('customer__masters')
                //->select('customer__masters.Id', 'customer__masters.Cust_Name')
                ->where('Id', '=', $Invoice->Cust_Id)
                //->orderBy('Cust_Name')
                ->get()
				->first();

            

            return view('rptcust_invoice_print')->with([
                'Invoice' => $Invoice,
                'Invoice_Detail' => $Invoice_Detail,
                'Cust'=>$cust
            ]);

        } catch (Exception $e) {

return $e->getMessage();
            //return view('excaption');

        }


    }
	
	// Collection Report Summary Group By Area
    public function rptCollection_Summary_Group_By_Area()
    {

        try 
		{
			
			$Month1=date('m');
			$Year1=date('Y');
            
				
            return view('rpt_collection_summary_group_by_area')->with(
				[
					'Month1' => $Month1,
					'Year1'=>$Year1,
					'Cust_List' => null
				]
			);

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }

	public function rptCollection_Summary_Group_By_Area_Show(Request $request)
    {

        try 
		{
			$Year1 = $request->txt_year;
			$Month1 = $request->dp_month;
			$dt=date('y-m-d');
			$sql = "Select a.Area_Name,count(c.Id) as Cust_Count,sum(i.Amount) as Bill_Generated,";
			$sql .= "sum(case when i.isPaid=true then i.Amount else 0 end) as Bill_Paid,";
			$sql .= " sum(case when i.isPaid=false then i.Amount  else 0 end) as Bill_Pending";
			$sql .= " From area_masters a,customer__masters c ";
			$sql .= " Left join invoice_master_custs i on (i.Cust_Id=c.Id ";
			$sql .= " And i.Month1 = " . $Month1;
			$sql .= " And i.Year1 = " . $Year1 . ")";
			$sql .= " Where a.Id=c.Area_Id";
			//$sql .= " And c.Id=i.Cust_Id";
			$sql .= " Group by a.Area_Name ";
			$Cust_List = DB::select($sql);
			return view('rpt_collection_summary_group_by_area')->with(
				[
					'Month1' => $Month1,
					'Year1'=>$Year1,
					'Cust_List' => $Cust_List
				]
			);
        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }
	
	// Collection Report Summary Area Wise
    public function rptCollection_Summary_Area_Wise()
    {

        try 
		{
			
			$Month1=date('m');
			$Year1=date('Y');
            $Area_Id=0;
				
            return view('rpt_collection_summary_area_wise')->with(
				[
					'Month1' => $Month1,
					'Year1'=>$Year1,
					'Area_Id'=>$Area_Id,
					'Cust_List' => null
				]
			);

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }

	public function rptCollection_Summary_Area_Wise_Show(Request $request)
    {

        try 
		{
			$Year1 = $request->txt_year;
			$Month1 = $request->dp_month;
			$dt=date('y-m-d');
			$sql = "Select a.Area_Name,count(c.Id) as Cust_Count,sum(i.Amount) as Bill_Generated,";
			$sql .= "sum(case when i.isPaid=true then i.Amount else 0 end) as Bill_Paid,";
			$sql .= " sum(case when i.isPaid=false then i.Amount  else 0 end) as Bill_Pending";
			$sql .= " From area_masters a,customer__masters c ";
			$sql .= " Left join invoice_master_custs i on (i.Cust_Id=c.Id ";
			$sql .= " And i.Month1 = " . $Month1;
			$sql .= " And i.Year1 = " . $Year1 . ")";
			$sql .= " Where a.Id=c.Area_Id";
			//$sql .= " And c.Id=i.Cust_Id";
			$sql .= " Group by a.Area_Name ";
			$Cust_List = DB::select($sql);
			return view('rpt_collection_summary_area_wise')->with(
				[
					'Month1' => $Month1,
					'Year1'=>$Year1,
					'Cust_List' => $Cust_List
				]
			);
        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }
	
	////////// Delete Sa
	public function destory_area_sa(Request $request)
    {

        try {

            //$user = DB::table('area_masters')->where('Id', $request->id)->update(['Enabled' => 1]);
			$user = DB::table('area_masters')->where('Id',$request->Id)->delete();
            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }



        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }
	
	public function destroy_bottletype_sa(Request $request)
    {
        try {

            $user = DB::table('bottel_type_masters')->where('Id', $request->id)->delete();
                //->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));

            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }



        } catch (Exception $e) {


            return view('excaption');

        }


    }
	
	// Delivery Boy Daily Report
	public function rptDB_Daily()
    {

        try 
		{
			$dtFrom = date('Y-m-d');
			//$dtTo = date('Y-m-d');
            $Bottle = DB::table("bottel_type_masters")
					->where('Enabled','=',0)
					->where('User','=','DB')
					->get();
			$DelBoy = DB::table("delivery_boy_masters")
					->where('Enabled','=',0)
					->get();
			
            return view('rpt_delivery_boy_daily_transaction')->with(
				[
					'dtFrom' => $dtFrom,
					'Bottle' => $Bottle,
					'DeliveryBoy' => $DelBoy,
					'Att' => null
				]
			);

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }


	public function rptDB_Daily_Show(Request $request)
    {

        try {

            $dtFrom = $request->dtFrom;
			//$dtTo = $request->dtTo;
			$Bottle = DB::table("bottel_type_masters")
					->where('Enabled','=',0)
					->where('User','=','DB')
					->get();
			$DelBoy = DB::table("delivery_boy_masters")
					->where('Enabled','=',0)
					->get();
			$att = array();
			foreach($DelBoy as $d)
			{
				$att1 = array();
				array_push($att1,$d->Boy_Name);
				foreach($Bottle as $b)
				{
					$sql = "Select * from delivery_boy_daily_transactions";
					$sql .= " Where Delivery_Boy_Id=" . $d->Id;
					$sql .= " And DoT='" . $dtFrom . "' ";
					$sql .= " And Bottle_Type_Id=" . $b->Id;
					$sql .= " And In_Out = 'Out'";
					$res = DB::select($sql);
					if(is_null($res)==true)
					{
						array_push($att1,0);
					}
					else
					{
						array_push($att1,$res->count());
					}
					
					$sql = "Select * from delivery_boy_daily_transactions";
					$sql .= " Where Delivery_Boy_Id=" . $d->Id;
					$sql .= " And DoT='" . $dtFrom . "' ";
					$sql .= " And Bottle_Type_Id=" . $b->Id;
					$sql .= " And In_Out = 'In'";
					$res = DB::select($sql);
					if(is_null($res)==true)
					{
						array_push($att1,0);
					}
					else
					{
						array_push($att1,$res->Count);
					}
				}
				array_push($att,$att1);
			}
			
			return view('rpt_delivery_boy_daily_transaction')->with(
				[
					'dtFrom' => $dtFrom,
					'Bottle' => $Bottle,
					'DeliveryBoy' => $DelBoy,
					'Att' => $att
				]
			);
        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }
	
	// Delivery Boy Monthly Report
	public function rptDB_Monthly()
    {

        try 
		{
			$Year1 = date('Y');
			$Month1 = date('m');
            $Bottle = DB::table("bottel_type_masters")
					->where('Enabled','=',0)
					->where('User','=','DB')
					->get();
			$DelBoy = DB::table("delivery_boy_masters")
					->where('Enabled','=',0)
					->get();
			
            return view('rpt_delivery_boy_daily_transaction')->with(
				[
					'Month1' => $Month1,
					'Year1' => $Year1,
					'Bottle' => $Bottle,
					'DeliveryBoy' => $DelBoy,
					'Att' => null
				]
			);

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }


	public function rptDB_Monthly_Show(Request $request)
    {

        try {

            $Month1 = $request->cmbMonth;
			$Year1 = $request->txtYear;
			
			$Bottle = DB::table("bottel_type_masters")
					->where('Enabled','=',0)
					->where('User','=','DB')
					->get();
			$DelBoy = DB::table("delivery_boy_masters")
					->where('Enabled','=',0)
					->get();
			$att = array();
			foreach($DelBoy as $d)
			{
				$att1 = array();
				array_push($att1,$d->Boy_Name);
				foreach($Bottle as $b)
				{
					$sql = "Select sum(Count) as Count from delivery_boy_daily_transactions";
					$sql .= " Where Delivery_Boy_Id=" . $d->Id;
					$sql .= " And DoT='" . $From_Date . "' ";
					$sql .= " And Bottle_Type_Id=" . $b->Id;
					$sql .= " And In_Out = 'Out'";
					$res = DB::select($sql);
					if(is_null($res)==true)
					{
						array_push($att1,0);
					}
					else
					{
						array_push($att1,$res->Count);
					}
					
					$sql = "Select sum(Count) as Count from delivery_boy_daily_transactions";
					$sql .= " Where Delivery_Boy_Id=" . $d->Id;
					$sql .= " And month(DoT)=" . $Month1 . " ";
					$sql .= " And year(DoT)=" . $Year1;
					$sql .= " And Bottle_Type_Id=" . $b->Id;
					$sql .= " And In_Out = 'In'";
					
					
					$res = DB::select($sql);
					if(is_null($res)==true)
					{
						array_push($att1,0);
					}
					else
					{
						array_push($att1,$res->Count);
					}
				}
				array_push($att,$att1);
			}
			
			return view('rpt_delivery_boy_daily_transaction')->with(
				[
					'Month1' => $Month1,
					'Year1' => $Year1,
					'Bottle' => $Bottle,
					'DeliveryBoy' => $DelBoy,
					'Att' => $att
				]
			);
        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }
	
	// Dealer Transaction Report between Dates
	public function rptDealer_DateWise_Trans()
    {
        try 
		{
			$dtFrom = date('Y-m-d');
			$dtTo = date('Y-m-d');
            $Bottle = DB::table("bottel_type_masters")
					->where('Enabled','=',0)
					->where('User','=','Dealer')
					->get();
			$Dealer = DB::table("dealer_masters")
					->where('Enabled','=',0)
					->get();
			
            return view('rpt_dealer_date_wise_transaction')->with(
				[
					'dtFrom' => $dtFrom,
					'dtTo'=>$dtTo,
					'Bottle' => $Bottle,
					'Dealer' => $Dealer,
					'Att' => null
				]
			);

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }


	public function rptDealer_DateWise_Trans_Show(Request $request)
    {

        try {

            $dtFrom = $request->dtFrom;
			$dtTo = $request->dtTo;
			$Bottle = DB::table("bottel_type_masters")
					->where('Enabled','=',0)
					->where('User','=','Dealer')
					->get();
			$Dealer = DB::table("dealer_masters")
					->where('Enabled','=',0)
					->get();
			$att = array();
			foreach($Dealer as $d)
			{
				$att1 = array();
				array_push($att1,$d->Dealer_Name);
				foreach($Bottle as $b)
				{
					$sql = "Select sum(No_Of_Bottle) as cnt from dealer_daily_transactions";
					$sql .= " Where Dealer_Id=" . $d->Id;
					$sql .= " And DoT>='" . $dtFrom . "' ";
					$sql .= " And DoT<='" . $dtTo . "' ";
					$sql .= " And Bottle_Type=" . $b->Id;
					//$sql .= " And In_Out = 'Out'";
					$res = DB::select($sql);
					if(is_null($res)==true)
					{
						array_push($att1,0);
					}
					else
					{
						
						array_push($att1,$res[0]->cnt);
					}
					
					
				}
				array_push($att,$att1);
			}
			
			return view('rpt_dealer_date_wise_transaction')->with(
				[
					'dtFrom' => $dtFrom,
					'dtTo' => $dtTo,
					'Bottle' => $Bottle,
					'Dealer' => $Dealer,
					'Att' => $att
				]
			);
        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }
	
	
	    /*start collector*/

    //list collector

    public function list_collector()
    {
        try {

            $countrys = DB::table('collector_master')
				->leftJoin('user_master','user_master.User_Id','=','collector_master.Id')
                ->where('collector_master.Enabled', '=', 0)
				->select('collector_master.*','user_master.User_Name')
                ->get();


            return view('collector_list')->with('collector', $countrys);


        } catch (Exception $e) {

            return $e->getMessage();
            //return view('excaption');

        }


    }

    //store country

    public function store_collector(Request $request)
    {
        try {
            $current_time = Carbon::now()->toDateTimeString();

            
                $country = DB::table('collector_master')
                    ->insert(['Name'=>$request->txtName,
						'Phone'=>$request->txtPhoneNo,
						'Address'=>$request->txt_address,
						'DoB'=>$request->dt_dob,
						'DoA'=>$request->dt_doa,
						'Email'=>$request->txt_EmailID,
						
                        'created_at'=>$current_time]);

                return redirect('ListCollector')->with('success','Record Stored Successfully');


            

        }catch (Exception $e)
        {
            return $e->getMessage();
            //return view('excaption');

        }
    }

    //delete country

    public function destroy_collector(Request $request)
    {

        try {

            $user = DB::table('collector_master')->where('Id', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }


	 public function create_user_collector($id)
    {

        try 
		{
				$coll = DB::table('user_master')->where('User_Id','=', $id)
					->where('Role','=','collector')
					->get();
				if(count($coll)>=1)
				{
					/*foreach($coll as $c)
					{
						//$sql = "Delete from user_master where Id=" . $c->Id;
						$res = DB::table('user_master')->delete($c->Id);
					}*/
					return redirect('ListCollector')->with('Failed','User Already exists');
					//return response()->json(['msg' => 'User already available', 'status' => 'failed']);
				}
            $user = DB::table('collector_master')->where('Id', $id)->get()->first();
			$res = DB::table('user_master')
				->insert(['User_Name'=>$user->Phone,
						'Password'=>$user->Phone,
						'Role'=>'collector',
						'User_Id'=>$user->Id
						]);
			$msg = 'User Created Successfully with UserName/Pwd="' . $user->Phone . '"';

            if ($res) {

                return redirect('ListCollector')->with('success',$msg);
				//response()->json((['msg' => 'User Created Successfully', 'status' => 'success']));
            } else {
				return redirect('ListCollector')->with('failed','Failed to create User. Please check the Collector details');
                //return response()->json(['msg' => 'Failed to create User. Please check the Collector details', 'status' => 'failed']);
            }

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }


    }
    //show collector

    public function show_collector($id)
    {
        try {

            $user = DB::table('collector_master')->where('Id', '=', $id)->first();

            return view('collector_edit')->with(['coll' => $user]);

        } catch (Exception $e) {


            return view('excaption');

        }


    }

    //edit collector

    public function edit_collector(Request $request)
    {
        try {

            $current_time = Carbon::now()->toDateTimeString();

            $country = DB::table('collector_master')->where('Id',$request->txt_id)
                ->update(['Name'=>$request->txtName,
						'Phone'=>$request->txtPhoneNo,
						'Address'=>$request->txt_address,
						'DoB'=>$request->dt_dob,
						'DoA'=>$request->dt_doa,
						'Email'=>$request->txt_EmailID,
						'updated_at'=>$current_time]);

            return redirect('ListCollector')->with('success','Record Updated Successfully');



        }catch (Exception $e)
        {
            return $e->getMessage();
            //return view('excaption');

        }
    }

    /*end collector*/
	
	// Report : New Customer started between two dates
	public function rptCust_New_Start()
    {

        try 
		{
			$dtFrom = date('Y-m-d');
			$dtTo = date('Y-m-d');
            
			
            return view('rpt_cust_start_report')->with(
				[
					'dtFrom' => $dtFrom,
					'dtTo' => $dtTo,
					'Cust_List' => null
				]
			);

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }

	public function rptCust_New_Start_Show(Request $request)
    {

        try {
			
            $dtFrom = $request->dtFrom;
			$dtTo = $request->dtTo;
			$sql = "select c.Agency_Name,c.Cust_Name,c.Start_Date,c.DoD as End_Date, a.Area_Name,db.Boy_Name, ";
			$sql .= " c.isActive ";
			$sql .= " From area_masters a, customer__masters c";
			$sql .= " left join cust_delivery_boy_rels cd on cd.Customer_Id=c.Id ";
			$sql .= " left join delivery_boy_masters d on d.Id=cd.Dilivery_Boy_Id";
			$sql .= " Where a.Id=c.Area_Id";
			$sql .= " And c.Start_Date>='" . $dtFrom . "' ";
			$sql .= " And c.Start_Date<='" . $dtTo . "' ";
			$sql .= " Order by c.Start_Date";
			//echo $sql;
			$Cust_List = DB::select($sql);
			return view('rpt_cust_start_report')->with(
				[
					'dtFrom' => $dtFrom,
					'dtTo' => $dtTo,
					'Cust_List' => $Cust_List
				]
			);
        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }
	
	// Report : Closed Customer started between two dates
	public function rptCust_Closed()
    {

        try 
		{
			$dtFrom = date('Y-m-d');
			$dtTo = date('Y-m-d');
            
			
            return view('rpt_cust_closed_report')->with(
				[
					'dtFrom' => $dtFrom,
					'dtTo' => $dtTo,
					'Cust_List' => null
				]
			);

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }

	public function rptCust_Closed_Show(Request $request)
    {

        try {
			
            $dtFrom = $request->dtFrom;
			$dtTo = $request->dtTo;
			$sql = "select c.Agency_Name,c.Cust_Name,c.Start_Date,c.DoD as End_Date, a.Area_Name,db.Boy_Name, ";
			$sql .= " c.isActive ";
			$sql .= " From area_masters a, customer__masters c";
			$sql .= " left join cust_delivery_boy_rels cd on cd.Customer_Id=c.Id ";
			$sql .= " left join delivery_boy_masters d on d.Id=cd.Dilivery_Boy_Id";
			$sql .= " Where a.Id=c.Area_Id";
			$sql .= " And c.DoD>='" . $dtFrom . "' ";
			$sql .= " And c.DoD<='" . $dtTo . "' ";
			$sql .= " Order by c.DoD";
			//echo $sql;
			$Cust_List = DB::select($sql);
			return view('rpt_cust_closed_report')->with(
				[
					'dtFrom' => $dtFrom,
					'dtTo' => $dtTo,
					'Cust_List' => $Cust_List
				]
			);
        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }
	
	// Customer Invoice list Area wise : This will show the customers with total pending by area
// This will also filtered with collector's login
	public function Cust_Inv_Area_Wise_List()
    {
        try
        {
			$Area_Sel = 0;
			$coll_Id =0;
            if(session()->get('role')=='Collector')
			{
				$coll_Id = session()->get('User_Id');
				$Area = DB::table('area_masters')
						->where('Enabled','=',0)
						->join('collector_area_rel','collector_area_rel.Area_Id','area_masters.Id')
						->where('collector_area_rel.Collector_Id','=',$coll_Id)
						->orderBy('Area_Name')
						->get();
			}
			else
			{
				$Area = DB::table('area_masters')
						->where('Enabled','=',0)
						->orderBy('Area_Name')
						->get();
			}
			$sql="Select c.Cust_Name,c.Agency_Name,c.Id,c.Sequence_no,";
			$sql .= " sum(i.Amount) as Bill_Amt, sum(case when cc.Amount=null then 0 else cc.Amount end) as Paid_Amt, ";
			$sql .= " sum(case when cc.Discount=null then 0 else cc.Discount end) as Discount_Amt ";
			$sql .= " From invoice_master_custs i, customer__masters c ";
			$sql .= " left join customer_collection cc on cc.Cust_Id=c.Id";
			$sql .= " Where i.Cust_Id = c.Id";
			//$sql .= " And cc.Cust_Id = c.Id";
			
			if(session()->get('role')=='Collector')
			{
				$sql .= " And c.Area_Id in (Select Area_Id from collector_area_rel ";
				$sql .= " where Collector_Id=" . $coll_Id . ")";
			}
			$sql .= " group by c.Cust_Name,c.Agency_Name,c.Id,c.Sequence_no ";
			$sql .= " order by c.Sequence_no";
			//echo $sql;
			$Cust_List = DB::select($sql);
			
			return view('cust_inv_area_wise_list')->with([
				'Area'=>$Area,
				'Cust_List'=>null,
				'Area_Sel'=>$Area_Sel
			]);
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }

	public function Cust_Inv_Area_Wise_List_Show(Request $request)
    {
        try
        {
			$Area_Sel = $request->cmbArea;
			if(session()->get('role')=='Collector')
			{
				$coll_Id = session()->get('User_Id');
				$Area = DB::table('area_masters')
						->where('Enabled','=',0)
						->join('collector_area_rel','collector_area_rel.Area_Id','area_masters.Id')
						->where('collector_area_rel.Collector_Id','=',$coll_Id)
						->orderBy('Area_Name')
						->get();
			}
			else
			{
				$Area = DB::table('area_masters')
						->where('Enabled','=',0)
						->orderBy('Area_Name')
						->get();
			}			
            $sql="Select c.Cust_Name,c.Agency_Name,c.Id,c.Sequence_no,";
			$sql .= " sum(i.Amount) as Bill_Amt, sum(case when cc.Amount=null then 0 else cc.Amount end) as Paid_Amt, ";
			$sql .= " sum(case when cc.Discount=null then 0 else cc.Discount end) as Discount_Amt ";
			$sql .= " From invoice_master_custs i, customer__masters c ";
			$sql .= " left join customer_collection cc on cc.Cust_Id=c.Id";
			$sql .= " Where i.Cust_Id = c.Id";
			//$sql .= " And cc.Cust_Id = c.Id";
			
			if($Area_Sel>=1)
				$sql .= " And c.Area_Id=" . $Area_Sel;
			$sql .= " group by c.Cust_Name,c.Agency_Name,c.Id,c.Sequence_no ";
			$sql .= " order by c.Sequence_no";
			//echo $sql;
			$Cust_List = DB::select($sql);
					
			return view('cust_inv_area_wise_list')->with([
				'Area'=>$Area,
				'Cust_List'=>$Cust_List,
				'Area_Sel'=>$Area_Sel
			]);
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }
	
	// Report:Dealer Rate Card
	public function rptDealer_Rate_Card()
    {
        try
        {
			$Bottles = DB::table('bottel_type_masters')
				->where('User','=','Dealer')
				->where('Enabled','=',0)
				->orderBy('Id')
				->get();
			
			$Dealers = DB::table('dealer_masters')
				->where('Enabled','=',0)
				->get();
			$Deal_Rate=array();
			foreach($Dealers as $d)
			{
				$array1 = array();
				array_push($array1,$d->Dealer_Name);
				
				foreach($Bottles as $b)
				{
					$sql = "Select  Rate from dealer_plan_rels";
					$sql .= " where Dealer_Id=" . $d->Id;
					$sql .= " and Bottle_Id=" . $b->Id;
					$res = DB::table('dealer_plan_rels')
						->where('Dealer_Id','=',$d->Id)
						->where('Bottle_Id','=',$b->Id)
						->get()
						->first();
					//echo $sql;
					//$res = DB::select($sql);
					if(is_null($res))
					{
						array_push($array1,0);
					}
					else
					{
						array_push($array1,$res->Rate);
					}
					
				}
				array_push($Deal_Rate,$array1);
			}
			///////////////////////////////////////////////////////////////
		/*
			$cust = DB::select($sql);
			$att = array();
			foreach($cust as $c)
			{
				$att1=array();
				//array_push($att1,'Name'=>$c->Agency_Name . ' - ' . $c->Cust_Name);
				array_push($att1,$c->Agency_Name . ' - ' . $c->Cust_Name);
				$sql = "Select Id,day(DoT) as Day1,No_Of_Bottle from cust_daily_transactions ";
				$sql .= " Where Cust_Id=" . $c->Id;
				$sql .= " And month(DoT)=" . $Month1;
				$sql .= " And year(DoT)=" . $Year1;
				$sql .= " Order by DoT";
				$res = DB::select($sql);
				$i=1;
				
				if(is_null($res)==true)
				{
					for($j=1;$j<=31;$j++)
					{
						array_push($att1,0);
					}
				}
				else
				{
					foreach($res as $r)
					{
						if($r->Day1 > $i)
						{
							for($i;$i<$r->Day1;$i++)
								array_push($att1,0,0);
						}
						
							array_push($att1,$r->No_Of_Bottle,$r->Id);
							$i=$i+1;
						
					}
					for($i=$i;$i<=31;$i++)
						array_push($att1,0,0);
				}
				array_push($att,$att1);
			}
			///////////////////////////////
				
            if(session()->get('role')=='Collector')
			{
				$coll_Id = session()->get('User_Id');
				$Area = DB::table('area_masters')
						->where('Enabled','=',0)
						->join('collector_area_rel','collector_area_rel.Area_Id','area_masters.Id')
						->where('collector_area_rel.Collector_Id','=',$coll_Id)
						->get();
			}
			else
			{
				$Area = DB::table('area_masters')
						->where('Enabled','=',0)
						->get();
			}*/
			return view('rpt_dealer_rate_card')->with([
				'Dealer_Det'=>$Deal_Rate,
				'Bottles'=>$Bottles
				
			]);
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }

	// Report : Customer Ledger
	public function rptCust_Ledger()
    {

        try 
		{
			$dtFrom = date('Y-m-d');
			$dtTo = date('Y-m-d');
            $cust = DB::table('customer__masters')
					->orderBy('Agency_Name')
					->get();
			$Area = DB::table('area_masters')
					->where('Enabled','=',0)
					->orderBy('Area_Name')
					->get();
			
            return view('rpt_cust_ledger')->with(
				[
					'dtFrom' => $dtFrom,
					'dtTo' => $dtTo,
					'cust'=>$cust,
					'Cust_Sel'=>0,
					'Cust_List' => null,
					'Area'=>$Area,
					'Area_Sel'=>0
				]
			);

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }

	public function rptCust_Ledger_Show(Request $request)
    {

        try {
			$Cust_Sel = $request->cmbCust;
			$Area_Sel = $request->cmbArea;
            $dtFrom = $request->dtFrom;
			$dtTo = $request->dtTo;
			$Area = DB::table('area_masters')
					->where('Enabled','=',0)
					->orderBy('Area_Name')
					->get();
			$cust = DB::table('customer__masters')
					->where('Area_Id','=',$Area_Sel)
					->orderBy('Agency_Name')
					->get();
			$sql = "Select DoI as DoT,concat('Invoice For - ',Month1,'/',Year1) as Remark,Amount as Dr_Amount,0 as Cr_Amount";
			$sql .= " ,0 as Discount";
			$sql .= " From invoice_master_custs";
			$sql .= " Where Cust_Id=" . $Cust_Sel;
			$sql .= " Union ";
			$sql .= " Select cc.DoT,";
			//$sql .= " concat('Payment Collected-',case when c.Name=null then '' else c.Name end) as Remark,";
			$sql .= " 'Payment Collected' as Remark, ";
			$sql .= " 0 as Dr_Amount,cc.Amount as Cr_Amount ";
			$sql .= " ,cc.Discount ";
			$sql .= " from customer_collection cc ";
			$sql .= " Left join collector_master c on cc.Collector_Id=c.Id";
			$sql .= " Where cc.Cust_id=" . $Cust_Sel;
			$sql .= " Order by DoT";
			echo $sql;
			$Cust_List = DB::select($sql);
			return view('rpt_cust_ledger')->with(
				[
					'dtFrom' => $dtFrom,
					'dtTo' => $dtTo,
					'Cust_List' => $Cust_List,
					'cust'=>$cust,
					'Cust_Sel'=>$Cust_Sel,
					'Area'=>$Area,
					'Area_Sel'=>$Area_Sel
				]
			);
        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }
	// Report : Dealer Ledger
	public function rptDealer_Ledger()
    {

        try 
		{
			$dtFrom = date('Y-m-d');
			$dtTo = date('Y-m-d');
            $Dealer = DB::table('dealer_masters')
					->get();
			
            return view('rpt_dealer_ledger')->with(
				[
					'dtFrom' => $dtFrom,
					'dtTo' => $dtTo,
					'Dealer'=>$Dealer,
					'Dealer_Sel'=>0,
					'Dealer_list' => null
					
				]
			);

        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }

	public function rptDealer_Ledger_Show(Request $request)
    {

        try {
			
            $dtFrom = $request->dtFrom;
			$dtTo = $request->dtTo;
			$Dealer = DB::table('dealer_masters')
					->get();
			$Dealer_Sel = $request->cmbDealer;
			$sql = "Select DoI as DoT,concat('Invoice For - ',Month1,'/',Year1) as Remark,Amount as Dr_Amount,0 as Cr_Amount";
			$sql .= " ,0 as Discount";
			$sql .= " From invoice_master_dealer";
			$sql .= " Where Dealer_Id=" . $Dealer_Sel;
			$sql .= " Union ";
			$sql .= " Select cc.DoT,";
			//$sql .= " concat('Payment Collected-',case when c.Name=null then '' else c.Name end) as Remark,";
			$sql .= " 'Payment Collected' as Remark, ";
			$sql .= " 0 as Dr_Amount,cc.Amount as Cr_Amount ";
			$sql .= " ,cc.Discount ";
			$sql .= " from dealer_collection cc ";
			$sql .= " Left join collector_master c on cc.Collector_Id=c.Id";
			$sql .= " Where cc.Dealer_id=" . $Dealer_Sel;
			$sql .= " Order by DoT";
			//echo $sql;
			// $sql = "select c.Agency_Name,c.Cust_Name,c.Start_Date,c.DoD as End_Date, a.Area_Name,db.Boy_Name, ";
			// $sql .= " c.isActive ";
			// $sql .= " From area_masters a, customer__masters c";
			// $sql .= " left join cust_delivery_boy_rels cd on cd.Customer_Id=c.Id ";
			// $sql .= " left join delivery_boy_masters d on d.Id=cd.Dilivery_Boy_Id";
			// $sql .= " Where a.Id=c.Area_Id";
			// $sql .= " And c.DoD>='" . $dtFrom . "' ";
			// $sql .= " And c.DoD<='" . $dtTo . "' ";
			// $sql .= " Order by c.DoD";
			//echo $sql;
			$Dealer_list = DB::select($sql);
			return view('rpt_dealer_ledger')->with(
				[
					'dtFrom' => $dtFrom,
					'dtTo' => $dtTo,
					'Dealer'=>$Dealer,
					'Dealer_Sel'=>0,
					'Dealer_list' => $Dealer_list
				]
			);
        } catch (Exception $e) {

            return $e->getMessage();
            //  return view('excaption');

        }
    }
	
	// List Closed Customers
	public function list_closed_customer()
    {
        try {

          //  Date::make('DoB')->format('DD/MM/YYYY');

            $cust= DB::table('customer__masters')
                ->join('area_masters','customer__masters.Area_Id','area_masters.Id')
              //  ->join('plan_masters','customer__masters.Id','plan_masters.Id')
                ->where('customer__masters.Enabled', '=', 1)
				//->where('customer__masters.DoD','<>',NULL)
				->leftJoin('customer_plans','customer_plans.Cust_Id','=','customer__masters.Id')
				->leftJoin('plan_masters','plan_masters.Id','=','customer_plans.Plan_Id')
                ->select('customer__masters.*','area_masters.Area_Name','customer_plans.No_Bottle','plan_masters.Name as Plan','customer_plans.Rate')
                ->get();
           // dd($cust);

         

            return view('customer_list_closed')->with('customer', $cust);


        } catch (Exception $e) {

            return $e->getMessage();
          //  return view('excaption');

        }


    }
	
	// Report : Monthly Attendance Report
	public function rptMonthly_Attendance()
    {
        try
        {
			$Year1 = date('Y');
			$Month1 = date('m');
			$selArea = 0;
			$Area = DB::table("area_masters")
					->where('Enabled','=',0)
					->orderBy('Area_Name')
					->get();
            return view('rpt_monthly_attendance_report')->with([
					'Area'=>$Area,
					'Year1'=>$Year1,
					'Month1'=>$Month1,
					'Att'=>null,
					'selArea'=>$selArea
					]);
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }
	
	public function rptMonthly_Attendance_Show(Request $request)
	{
		try
		{
			$Area = DB::table("area_masters")
					->where('Enabled','=',0)
					->orderBy('Area_Name')
					->get();
			$selArea = $request->cmbArea;
			$Month1 = $request->cmbMonth;
			$Year1 = $request->txtYear;
			
			$sql = "Select c.Id,c.Agency_Name, c.Cust_Name, p.Name as Plan,p.Plan_Type,cp.No_Bottle";
			$sql .= ", c.Sequence_no ";	//,b.Name as Bottle_Name,cpb.No_Of_Bottles";
			//$sql .= ", Case when cpb1.No_Of_Bottles<>null then cpb1.No_Of_Bottles else 0 end as Jug_20L";
			//$sql .= ", Case when cpb2.No_Of_Bottles<>null then cpb2.No_Of_Bottles else 0 end as Bot_20L";
			$sql .= ", cpb1.No_Of_Bottles as Jug_20L";
			$sql .= ", cpb2.No_Of_Bottles as Bot_20L";
			
			$sql .= " From customer__masters c,plan_masters p, customer_plans cp";
			$sql .= " left join cust_plan_bottle_allocated cpb1 on cpb1.Cust_Plan_Id=cp.Id and cpb1.Bottle_Id=16";
			$sql .= " left join cust_plan_bottle_allocated cpb2 on cpb2.Cust_Plan_Id=cp.Id and cpb2.Bottle_Id=17";
			//$sql .= " left join cust_plan_bottle_allocated cpb on cpb.Cust_Plan_Id=cp.Id ";
			//$sql .= " left join bottel_type_masters b on cpb.Bottle_Id=b.Id";
			$sql .= " Where c.Id=cp.Cust_Id";
			$sql .= " and p.Id=cp.Plan_Id";
			$sql .= " And c.Area_Id=" . $selArea;
			$cust = DB::select($sql);
			$att = array();
			foreach($cust as $c)
			{
				$att1=array();
				//array_push($att1,'Name'=>$c->Agency_Name . ' - ' . $c->Cust_Name);
				array_push($att1,$c->Agency_Name );		//. ' - ' . $c->Cust_Name);
				array_push($att1,$c->Sequence_no);
				array_push($att1,$c->Jug_20L);
				array_push($att1,$c->Bot_20L);
				$sql = "Select Id,day(DoT) as Day1,No_Of_Bottle from cust_daily_transactions ";
				$sql .= " Where Cust_Id=" . $c->Id;
				$sql .= " And month(DoT)=" . $Month1;
				$sql .= " And year(DoT)=" . $Year1;
				$sql .= " Order by DoT";
				$res = DB::select($sql);
				$i=1;
				
				if(is_null($res)==true)
				{
					for($j=1;$j<=31;$j++)
					{
						array_push($att1,0);
					}
				}
				else
				{
					foreach($res as $r)
					{
						if($r->Day1 > $i)
						{
							for($i;$i<$r->Day1;$i++)
								array_push($att1,0,0);
						}
						
							array_push($att1,$r->No_Of_Bottle,$r->Id);
							$i=$i+1;
						
					}
					for($i=$i;$i<=31;$i++)
						array_push($att1,0,0);
				}
				array_push($att,$att1);
			}
            return view('rpt_monthly_attendance_report')->with([
					'Area'=>$Area,
					'Year1'=>$Year1,
					'Month1'=>$Month1,
					'Att'=>$att,
					'selArea'=>$selArea
					]);
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}

	// csutomer Monthly Attendance list for Daily Parties

	public function List_DailyCust_Monthly_Att()
    {
        try
        {
			$Year1 = date('Y');
			$Month1 = date('m');
			//$selArea = 0;
			//$Area = DB::table("area_masters")
			//		->where('Enabled','=',0)
			//		->get();
            return view('cust_daily_transaction_list_monthly_view')->with([
			//		'Area'=>$Area,
					'Year1'=>$Year1,
					'Month1'=>$Month1,
					'Att'=>null,
			//		'selArea'=>$selArea
					]);
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }
	
	public function List_DailyCust_Monthly_Att_Show(Request $request)
	{
		try
		{
			//$Area = DB::table("area_masters")
			//		->where('Enabled','=',0)
			//		->get();
			//$selArea = $request->cmbArea;
			$Month1 = $request->cmbMonth;
			$Year1 = $request->txtYear;
			
			$sql = "Select c.Id,c.Agency_Name, c.Cust_Name, p.Name as Plan,p.Plan_Type,cp.No_Bottle";
			$sql .= ", c.Sequence_no ";	//,b.Name as Bottle_Name,cpb.No_Of_Bottles";
			//$sql .= ", Case when cpb1.No_Of_Bottles<>null then cpb1.No_Of_Bottles else 0 end as Jug_20L";
			//$sql .= ", Case when cpb2.No_Of_Bottles<>null then cpb2.No_Of_Bottles else 0 end as Bot_20L";
			$sql .= ", cpb1.No_Of_Bottles as Jug_20L";
			$sql .= ", cpb2.No_Of_Bottles as Bot_20L";
			
			$sql .= " From customer__masters c,plan_masters p, customer_plans cp";
			$sql .= " left join cust_plan_bottle_allocated cpb1 on cpb1.Cust_Plan_Id=cp.Id and cpb1.Bottle_Id=16";
			$sql .= " left join cust_plan_bottle_allocated cpb2 on cpb2.Cust_Plan_Id=cp.Id and cpb2.Bottle_Id=17";
			//$sql .= " left join cust_plan_bottle_allocated cpb on cpb.Cust_Plan_Id=cp.Id ";
			//$sql .= " left join bottel_type_masters b on cpb.Bottle_Id=b.Id";
			$sql .= " Where c.Id=cp.Cust_Id";
			$sql .= " and p.Id=cp.Plan_Id";
			$sql .= " and p.Plan_Type='Daily' ";
			//$sql .= " And c.Area_Id=" . $selArea;
			$cust = DB::select($sql);
			$att = array();
			foreach($cust as $c)
			{
				$att1=array();
				//array_push($att1,'Name'=>$c->Agency_Name . ' - ' . $c->Cust_Name);
				array_push($att1,$c->Agency_Name . ' - ' . $c->Cust_Name);
				array_push($att1,$c->Sequence_no);
				array_push($att1,$c->Jug_20L);
				array_push($att1,$c->Bot_20L);
				$sql = "Select Id,day(DoT) as Day1,No_Of_Bottle from cust_daily_transactions ";
				$sql .= " Where Cust_Id=" . $c->Id;
				$sql .= " And month(DoT)=" . $Month1;
				$sql .= " And year(DoT)=" . $Year1;
				$sql .= " Order by DoT";
				$res = DB::select($sql);
				$i=1;
				
				if(is_null($res)==true)
				{
					for($j=1;$j<=31;$j++)
					{
						array_push($att1,0);
					}
				}
				else
				{
					foreach($res as $r)
					{
						if($r->Day1 > $i)
						{
							for($i;$i<$r->Day1;$i++)
								array_push($att1,0,0);
						}
						
							array_push($att1,$r->No_Of_Bottle,$r->Id);
							$i=$i+1;
						
					}
					for($i=$i;$i<=31;$i++)
						array_push($att1,0,0);
				}
				array_push($att,$att1);
			}
            return view('cust_daily_transaction_list_monthly_view')->with([
			//		'Area'=>$Area,
					'Year1'=>$Year1,
					'Month1'=>$Month1,
					'Att'=>$att,
			//		'selArea'=>$selArea
					]);
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}
	
	public function Model_Test()
    {
        try
        {
			//$Year1 = date('Y');
			//$Month1 = date('m');
			//$selArea = 0;
			//$Area = DB::table("area_masters")
			//		->where('Enabled','=',0)
			//		->get();
            return view('model_test')->with([
			//		'Area'=>$Area,
			//		'Year1'=>$Year1,
			//		'Month1'=>$Month1,
			//		'Att'=>null,
			//		'selArea'=>$selArea
					]);
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }
	

}
