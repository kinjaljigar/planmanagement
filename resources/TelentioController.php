<?php

namespace App\Http\Controllers;

use App\topic_evaluation_master;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;





class TelentioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // this check login credential

    public function check_credential(Request $request)
    {

        // if ($request->txt_username == "admin" && $request->txt_password == "admin") {
		if($request->txt_username=="sa" && $request->txt_password=="sa@1810")
		{
			session()->put('User_Name','Super Admin');
			session()->put('user_id',"-99");
			$documnets = DB::table('department_masters')->where('Enabled', '=', '0')->get()->count();
            $organizations = DB::table('organization_masters')->where('Enabled', '=', '0')->get()->count();
            $skills = DB::table('skill_masters')->where('Enabled', '=', '0')->get()->count();
            $types = DB::table('type_masters')->where('Enabled', '=', '0')->get()->count();

            //Keyur:Code to put all the allocated_roles in session with Key->value pair
            $allocated_roles = DB::table('functionmasters')

                ->select('name')
                ->get();


            foreach($allocated_roles as $ar)
            {
                $tName = $ar->name;
                session()->put($tName,1);
            }
			$totEmps = DB::table('employee_masters')->where('Enabled', '=', '0')->get()->count();
            $totClgs = DB::table('course_masters')->where('course_masters.Enabled', '=', '0')//->whereYear('start_date', '=', date('Y'))
			->join('Program_Master','Program_Master.Program_Id' , '=' , 'course_masters.Program_Id')
			->get()->count();
            if(!isset($totEmps))
                $totEmps=0;
			$Month1 = date('m')+1;
			$Year1 = date('Y') - 1;
			if($Month1>11)
				$Month1=0;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
			$janemps = DB::table('employee_masters')->where('Enabled', '=', '0')
			//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)
			->get()->count();
			$janclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $febemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $febclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $maremps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $marclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $apremps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $aprclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $mayemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $mayclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $junemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $junclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $julyemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $julyclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $augemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $augclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $sepemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $sepclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $octemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $octclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $novemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $novclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $decemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
			$decclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();

			/*
            $janclgs = DB::table('course_masters')->where('Enabled', '=', '0')
                ->whereYear('start_date', '=', date('Y'))->whereMonth('start_date', '=', date('1'))->get()->count();
            $febclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', date('Y'))->whereMonth('start_date', '=', date('2'))->get()->count();
            $marclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', date('Y'))->whereMonth('start_date', '=', date('3'))->get()->count();
            $aprclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', date('Y'))->whereMonth('start_date', '=', date('4'))->get()->count();
            $mayclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', date('Y'))->whereMonth('start_date', '=', date('5'))->get()->count();
            $junclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', date('Y'))->whereMonth('start_date', '=', date('6'))->get()->count();
            $julyclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', date('Y'))->whereMonth('start_date', '=', date('7'))->get()->count();
            $augclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', date('Y'))->whereMonth('start_date', '=', date('8'))->get()->count();
            $sepclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', date('Y'))->whereMonth('start_date', '=', date('9'))->get()->count();
            $octclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', date('Y'))->whereMonth('start_date', '=', date('10'))->get()->count();
            $novclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', date('Y'))->whereMonth('start_date', '=', date('11'))->get()->count();
            $decclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', date('Y'))->whereMonth('start_date', '=', date('12'))->get()->count();
*/

            return view('home')->with(['d_count' => $documnets, 'orz_count' => $organizations,
                's_count' => $skills, 't_counts' => $types, 't_jan' => $janemps, 't_feb' => $febemps,
                't_mar' => $maremps, 't_apr' => $apremps,'t_may' => $mayemps, 't_jun' => $junemps,
                't_july' => $julyemps, 't_aug' => $augemps , 't_sep' => $sepemps, 't_oct' => $octemps,
                't_nov' => $novemps, 't_dec' => $decemps, 't_emps' => $totEmps, 'e_jan' => $janclgs,
                'e_feb' => $febclgs, 'e_mar' => $marclgs, 'e_apr' => $aprclgs,'e_may' => $mayclgs,
                'e_jun' => $junclgs, 'e_july' => $julyclgs, 'e_aug' => $augclgs , 'e_sep' => $sepclgs,
                'e_oct' => $octclgs, 'e_nov' => $novclgs, 'e_dec' => $decclgs, 't_clgs' => $totClgs]);

		}
		else
		{
			$user_check = DB::table('login_masters')
				->where('Password', '=', $request->txt_password)
				->where(function ($query) use ($request) {
					$query->where('Email', '=', $request->txt_username)
						->orWhere('Phone_No', '=', $request->txt_username);
				})->get()->first();


			if ($user_check) {

				session()->put('User_Name',$user_check->User_Name);
				session()->put('user_id', $user_check->UserId);

				$documnets = DB::table('department_masters')->where('Enabled', '=', '0')->get()->count();
				$organizations = DB::table('organization_masters')->where('Enabled', '=', '0')->get()->count();
				$skills = DB::table('skill_masters')->where('Enabled', '=', '0')->get()->count();
				$types = DB::table('type_masters')->where('Enabled', '=', '0')->get()->count();

				//Keyur:Code to put all the allocated_roles in session with Key->value pair
				$allocated_roles = DB::table('role__allocations')
					->join('role_masters', 'role_masters.Role_Id','=', 'role__allocations.Role_Id')
					->join('functionmasters', 'functionmasters.id', '=' , 'role__allocations.Fun_Id')
					->join('user__roles','user__roles.Role_Id','=','role__allocations.Role_Id')
					->select('functionmasters.name','role__allocations.isAllowed')
					//->where('role_masters.Role_Id' , '=' ,)
					->where('user__roles.User_Id','=',$user_check->UserId)
					->get();


				foreach($allocated_roles as $ar)
				{
					$tName = $ar->name;
					session()->put($tName,$ar->isAllowed);
				}

				//Code from Hemendrabhai

				$totEmps = DB::table('employee_masters')->where('Enabled', '=', '0')->get()->count();
            $totClgs = DB::table('course_masters')->where('course_masters.Enabled', '=', '0')//->whereYear('start_date', '=', date('Y'))
			->join('Program_Master','Program_Master.Program_Id' , '=' , 'course_masters.Program_Id')
			->get()->count();
            if(!isset($totEmps))
                $totEmps=0;
			$Month1 = date('m')+1;
			$Year1 = date('Y') - 1;
			if($Month1>11)
				$Month1=0;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
			$janemps = DB::table('employee_masters')->where('Enabled', '=', '0')
			//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)
			->get()->count();
			$janclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $febemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $febclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $maremps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $marclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $apremps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $aprclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $mayemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $mayclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $junemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $junclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $julyemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $julyclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $augemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $augclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $sepemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $sepclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $octemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $octclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $novemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $novclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $decemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
			$decclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();


				return view('home')->with(['d_count' => $documnets, 'orz_count' => $organizations,
					's_count' => $skills, 't_counts' => $types, 't_jan' => $janemps, 't_feb' => $febemps,
					't_mar' => $maremps, 't_apr' => $apremps,'t_may' => $mayemps, 't_jun' => $junemps,
					't_july' => $julyemps, 't_aug' => $augemps , 't_sep' => $sepemps, 't_oct' => $octemps,
					't_nov' => $novemps, 't_dec' => $decemps, 't_emps' => $totEmps, 'e_jan' => $janclgs,
					'e_feb' => $febclgs, 'e_mar' => $marclgs, 'e_apr' => $aprclgs,'e_may' => $mayclgs,
					'e_jun' => $junclgs, 'e_july' => $julyclgs, 'e_aug' => $augclgs , 'e_sep' => $sepclgs,
					'e_oct' => $octclgs, 'e_nov' => $novclgs, 'e_dec' => $decclgs, 't_clgs' => $totClgs]);

				/*return view('home')->
				with(['d_count' => $documnets, 'orz_count' => $organizations, 's_count' => $skills, 't_counts' => $types]);
	*/

			} else {

				return redirect('/')->with('error', "Please Enter Correct MobileNumber/Email Or Password");

			}
		}
        /*if ($request->txt_username == "admin" && $request->txt_password == "admin") {

            session()->put('username', $request->txt_username);
            session()->put('password', $request->txt_password);

            $documnets = DB::table('department_masters')->get()->count();
            $organizations = DB::table('organization_masters')->get()->count();
            $skills = DB::table('skill_masters')->get()->count();
            $types = DB::table('type_masters')->get()->count();


            return view('home')->with(['d_count' => $documnets, 'orz_count' => $organizations, 's_count' => $skills, 't_counts' => $types]);


        } else {


            return redirect('/')->with('error', "Please Enter Correct UserName Or Password");

        }*/


    }


    //this for check session

    public function check_session()
    {


        if (session()->has('user_id')) {


            $documnets = DB::table('department_masters')->where('Enabled', '=', '0')->get()->count();
            $organizations = DB::table('organization_masters')->where('Enabled', '=', '0')->get()->count();
            $skills = DB::table('skill_masters')->where('Enabled', '=', '0')->get()->count();
            $types = DB::table('type_masters')->where('Enabled', '=', '0')->get()->count();

            //Code from Hemendrabhai

            $totEmps = DB::table('employee_masters')->where('Enabled', '=', '0')->get()->count();
            $totClgs = DB::table('course_masters')->where('course_masters.Enabled', '=', '0')//->whereYear('start_date', '=', date('Y'))
			->join('Program_Master','Program_Master.Program_Id' , '=' , 'course_masters.Program_Id')
			->get()->count();
            if(!isset($totEmps))
                $totEmps=0;
			$Month1 = date('m')+1;
			$Year1 = date('Y') - 1;
			if($Month1>11)
				$Month1=0;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
			$janemps = DB::table('employee_masters')->where('Enabled', '=', '0')
			//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)
			->get()->count();
			$janclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $febemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $febclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $maremps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $marclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $apremps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $aprclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $mayemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $mayclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $junemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $junclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $julyemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $julyclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $augemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $augclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $sepemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $sepclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $octemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $octclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $novemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
            $novclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();
			if($Month1 == 11)
			{
				$Month1 = 0;
				$Year1 = $Year1 + 1;
			}
			else
				$Month1 = $Month1 + 1;
			$strDate = $Year1 . "-" . $Month1 . "-01";
			$strDate = date('Y-m-t',strtotime($strDate));
            $decemps = DB::table('employee_masters')->where('Enabled', '=', '0')//->whereYear('date_of_joining', '<=', $Year1)->whereMonth('date_of_joining', '<=', $Month1)
			->whereDate('date_of_joining','<=',$strDate)->get()->count();
			$decclgs = DB::table('course_masters')->where('Enabled', '=', '0')->whereYear('start_date', '=', $Year1)->whereMonth('start_date', '=', $Month1)->get()->count();


            /* return view('home')->with(['d_count' => $documnets, 'orz_count' => $organizations,
                 's_count' => $skills, 't_counts' => $types, 't_jan' => $janemps, 't_feb' => $febemps,
                 't_mar' => $maremps, 't_apr' => $apremps,'t_may' => $mayemps, 't_jun' => $junemps,
                 't_july' => $julyemps, 't_aug' => $augemps , 't_sep' => $sepemps, 't_oct' => $octemps,
                 't_nov' => $novemps, 't_dec' => $decemps, 't_emps' => $totEmps, 'e_jan' => $janclgs,
                 'e_feb' => $febclgs, 'e_mar' => $marclgs, 'e_apr' => $aprclgs,'e_may' => $mayclgs,
                 'e_jun' => $junclgs, 'e_july' => $julyclgs, 'e_aug' => $augclgs , 'e_sep' => $sepclgs,
                 'e_oct' => $octclgs, 'e_nov' => $novclgs, 'e_dec' => $decclgs, 't_clgs' => $totClgs]);
 */
            return view('home')->with(['d_count' => $documnets, 'orz_count' => $organizations,
                's_count' => $skills, 't_counts' => $types, 't_jan' => $janemps, 't_feb' => $febemps,
                't_mar' => $maremps, 't_apr' => $apremps,'t_may' => $mayemps, 't_jun' => $junemps,
                't_july' => $julyemps, 't_aug' => $augemps , 't_sep' => $sepemps, 't_oct' => $octemps,
                't_nov' => $novemps, 't_dec' => $decemps, 't_emps' => $totEmps, 'e_jan' => $janclgs,
                'e_feb' => $febclgs, 'e_mar' => $marclgs, 'e_apr' => $aprclgs,'e_may' => $mayclgs,
                'e_jun' => $junclgs, 'e_july' => $julyclgs, 'e_aug' => $augclgs , 'e_sep' => $sepclgs,
                'e_oct' => $octclgs, 'e_nov' => $novclgs, 'e_dec' => $decclgs, 't_clgs' => $totClgs]);


        } else {

            return view('login');
        }


    }


    //this for logout


    public function gotologout()
    {

        try {
            session()->put('user_id','0');
            session()->remove('user_id');
            session()->remove('menu');


            return redirect('/');

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }



    /*start city*/

    //    this for store city


    public function store_city(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_countryid == -1 || $request->txt_countryid == null) {

            return redirect()->back()->withInput()->with('error', 'Country Not Selectd');

        } else if ($request->txt_stateid == -1 || $request->txt_stateid == null) {

            return redirect()->back()->withInput()->with('error', 'State Not Selected');

        } else {
            try {

                $city = DB::table('city_masters')
                    ->select('city_masters.city_name')
                    ->where('city_masters.city_name', '=', $request->txt_cityname)
                    ->where('city_masters.Enabled', '=', '0')
                    ->get()->count();

                if ($city > 0) {

                    return redirect()->back()->withInput()
                        ->with('error', 'City ' . $request->txt_cityname . ' Already Exist');

                } else {
                    $obj = DB::table('city_masters')
                        ->insert(['city_name' => $request->txt_cityname != null ? $request->txt_cityname : '',
                            'state_id' => $request->txt_stateid != null ? $request->txt_stateid : '',
                            'country_id' => $request->txt_countryid != null ? $request->txt_countryid : '',
                            'Created_By' => session()->get('user_id'),
                            'created_at' => $current_time]);


                    return redirect('CityList');
                }


            } catch (Exception $e) {


                // return $e->getMessage();

                return view('excaption');

            }
        }


    }

    //for show city

    public function show_city($id)
    {

        try {


            $user = DB::table('city_masters')->where('city_id', '=', $id)->first();


            $obj = DB::table('country_masters')
                ->select('country_masters.country_id', 'country_masters.country_name')
                ->where('country_masters.Enabled', '=', '0')
				->orderBy('country_name')
                ->get();

            $obj1 = DB::table('state_masters')
                ->select('state_masters.state_id', 'state_masters.state_name')
                ->where('state_masters.Enabled', '=', '0')
                ->where('state_masters.country_id', '=', $user->country_id)
				->orderBy('state_name')
                ->get();


            return view('city_edit')->with(['city' => $user, 'countries' => $obj, 'states' => $obj1]);

        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }


    }

    // for edit city

    public function edit_city(Request $request)
    {
        //dd($request->txt_deptid.$request->txt_deptname);

        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_countryid == -1 || $request->txt_countryid == null) {

            return redirect('AddCity')->with('error', 'Country Not Selectd');

        } else if ($request->txt_stateid == -1 || $request->txt_stateid == null) {

            return redirect('AddCity')->with('error', 'State Not Selected');

        } else {

            try {

                $city = DB::table('city_masters')
                    ->select('city_masters.city_name')
                    ->where('city_masters.city_name', '=', $request->txt_cityname)
                    ->where('city_masters.city_id', '<>', $request->txt_city_id)
                    ->where('city_masters.Enabled', '=', '0')
                    ->get()->count();

                if ($city > 0) {

                    return redirect()->back()->withInput()
                        ->with('error', 'City ' . $request->txt_cityname . ' Already Exist');

                } else {

                    $user = DB::table('city_masters')
                        ->where('city_id', '=', $request->txt_city_id)
                        ->update(['city_name' => $request->txt_cityname != null ? $request->txt_cityname : '',
                            'state_id' => $request->txt_stateid != null ? $request->txt_stateid : '',
                            'country_id' => $request->txt_countryid != null ? $request->txt_countryid : '',
                            'LastUpdated_By' => session()->get('user_id'),
                            'updated_at' => $current_time]);


                    return redirect('CityList')->with('success', "Record Updated Successfully");

                }
            } catch
            (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }


        }
    }


    public function get_countriesforcity()
    {


        try {
            $country = DB::table('country_masters')
                ->select('country_masters.country_id', 'country_masters.country_name')
                ->where('Enabled', '=', '0')
				->orderBy('country_masters.country_name')
                ->get();

            $statee = DB::table('state_masters')
                ->select('state_masters.state_id', 'state_masters.state_name')
                ->where('Enabled', '=', '0')
				->orderBy('state_masters.state_name')
                ->get();


            return view('city_add')->with(['countries' => $country, 'states' => $statee]);

        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }


    }


    public function get_allcity()
    {

        try {


            $obj = DB::table('city_masters')
                ->join('country_masters', 'country_masters.country_id',
                    '=', 'city_masters.country_id')
                ->join('state_masters', 'state_masters.state_id',
                    '=', 'city_masters.state_id')
                ->select('city_masters.*', 'country_masters.country_name',
                    'state_masters.state_name')
                ->where('city_masters.Enabled', '=', 0)
                ->orderBy('city_masters.city_name')
                ->get();


            return view('city_list')->with('cities', $obj);


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }


    }


    // for delete city

    public function destroy_city(Request $request)
    {

        try {

            $check_collage = DB::table('collage_masters')
                ->where('city_id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('collage_masters.*')
                ->count();


            $check_org = DB::table('organization_masters')
                ->where('organization_city', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('organization_masters.*')
                ->count();


            $check_emp = DB::table('employee_masters')
                ->where('emp_city', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('employee_masters.*')
                ->count();

            $check_empper = DB::table('employee_masters')
                ->where('permanent_address_city', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('employee_masters.*')
                ->count();


            if ($check_collage > 0) {

                return response()->json(['msg' => 'College for this City is already set. Delete the College first before deleting City', 'status' => 'failed']);

            } else if ($check_org > 0) {

                return response()->json((['msg' => 'Organization for this City is already set. Delete the Organization first before deleting City', 'status' => 'failed']));

            } else if ($check_emp > 0) {

                return response()->json(['msg' => 'Employee for this City is already set. Delete the Employee first before deleting City', 'status' => 'failed']);

            } else if ($check_empper > 0) {

                return response()->json(['msg' => 'Employee for this City  is already set. Delete the Employee first before deleting City', 'status' => 'failed']);

            } else {

                $user = DB::table('city_masters')->where('city_id', $request->id)->update(['Enabled' => 1]);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
                }
                // return redirect('DeparmentList')->with('success',"Delete Record Successfully");

            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }






    /*end city*/


    /*start country*/

    //    this for store coutry


    public function store_country(Request $request)
    {

        try {
            $current_time = Carbon::now()->toDateTimeString();

            $user = DB::table('country_masters')
                ->select('country_masters.country_name')
                ->where('country_masters.country_name', '=', $request->txt_countryname)
                ->where('country_masters.Enabled', '=', '0')
                ->get()->count();

            if ($user > 0) {

                return redirect()->back()->withInput()->with('error', 'Country ' . $request->txt_countryname . ' Already Exist');

            } else {

                $obj = DB::table('country_masters')
                    ->insert(['country_name' => $request->txt_countryname != null ? $request->txt_countryname : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('CountryList');
            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    // for edit coutry

    public function edit_country(Request $request)
    {
        //dd($request->txt_deptid.$request->txt_deptname);
        $current_time = Carbon::now()->toDateTimeString();
        try {

            $country = DB::table('country_masters')
                ->select('country_masters.country_name')
                ->where('country_masters.country_name', '=', $request->txt_countryname)
                ->where('country_masters.country_id', '<>', $request->txt_countryid)
                ->where('country_masters.Enabled', '=', '0')
                ->get()->count();

            if ($country > 0) {

                return redirect()->back()->withInput()->with('error', 'Country ' . $request->txt_countryname . ' Already Exist');

            } else {

                $user = DB::table('country_masters')
                    ->where('country_id', $request->txt_countryid)
                    ->update(['country_name' => $request->txt_countryname != null ? $request->txt_countryname : '',
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('CountryList')->with('success', "Record Updated Successfully");

            }

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    public function get_allcountry()
    {

        try {
            $obj = DB::table('country_masters')
                ->where('Enabled', '=', 0)
				->orderBy('country_name')
				->get();

            return view('country_list')->with('coutrys', $obj);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    // for delete coutry

    public function destroy_country(Request $request)
    {

        try {

            $check_state = DB::table('state_masters')
                ->where('country_id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('state_masters.*')
                ->get()
                ->count();


            if ($check_state > 0) {

                return response()->json((['msg' => 'States for this Country is already set.Delete the states first before deleting County', 'status' => 'failed']));

            } else {


                $check_collage = DB::table('collage_masters')
                    ->where('country_id', '=', $request->id)
                    ->where('Enabled', '=', '0')
                    ->select('collage_masters.*')
                    ->get()
                    ->count();

                if ($check_collage > 0) {

                    return response()->json(['msg' => 'College for this Country is already set. Delete the College first before deleting Country', 'status' => 'failed']);

                } else {

                    $check_org = DB::table('organization_masters')
                        ->where('organization_country', '=', $request->id)
                        ->where('Enabled', '=', '0')
                        ->select('organization_masters.*')
                        ->get()
                        ->count();

                    if ($check_org > 0) {

                        return response()->json(['msg' => 'Organization for this Country is already set. Delete the Organization first before deleting Country', 'status' => 'failed']);

                    } else {

                        $check_city = DB::table('city_masters')
                            ->where('country_id', '=', $request->id)
                            ->where('Enabled', '=', '0')
                            ->select('city_masters.*')
                            ->get()
                            ->count();

                        if ($check_city > 0) {


                            return response()->json((['msg' => 'City for this Country is already set. Delete the City first before deleting Country', 'status' => 'failed']));

                        } else {

                            $check_emp = DB::table('employee_masters')
                                ->where('emp_country', '=', $request->id)
                                ->where('Enabled', '=', '0')
                                ->select('employee_masters.*')
                                ->get()
                                ->count();

                            if ($check_emp > 0) {

                                return response()->json(['msg' => 'Employee for this Country is already set. Delete the Employee first before deleting Country', 'status' => 'failed']);

                            } else {

                                $check_empper = DB::table('employee_masters')
                                    ->where('permanent_address_country', '=', $request->id)
                                    ->where('Enabled', '=', '0')
                                    ->select('employee_masters.*')
                                    ->get()
                                    ->count();

                                if ($check_empper > 0) {

                                    return response()->json(['msg' => 'Employee for this Country  is already set. Delete the Employee first before deleting Country', 'status' => 'failed']);

                                } else {
                                    $user = DB::table('country_masters')->where('country_id', $request->id)->update(['Enabled' => 1]);

                                    if ($user) {

                                        return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));

                                    } else {

                                        return response()->json((['msg' => 'Failed deleting the Record', 'status' => 'failed']));
                                    }

                                }
                            }

                        }


                    }


                }

            }


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }


    }

    //for show coutry

    public function show_country($id)
    {

        try {

            $user = DB::table('country_masters')->where('country_id', '=', $id)->first();

            return view('coutry_edit')->with(['countries' => $user]);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    /*end country*/


    /*start demo*/

    //    this for store demo


    public function store_demo(Request $request)
    {


        try {
            $current_time = Carbon::now()->toDateTimeString();

            $demo = DB::table('demo_masters')
                ->select('demo_masters.demo_desc')
                ->where('demo_masters.demo_desc', '=', $request->txt_demodesc)
                ->where('demo_masters.Enabled', '=', '0')
                ->get()->count();

            if ($demo > 0) {
                return redirect()->back()->withInput()->with('error', 'Demo ' . $request->txt_demodesc . ' Already Exist');

            } else {

                $obj = DB::table('demo_masters')
                    ->insert(['demo_desc' => $request->txt_demodesc != null ? $request->txt_demodesc : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('DemoList');

            }

        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }


    }

// for edit demo

    public function edit_demo(Request $request)
    {
        //dd($request->txt_deptid.$request->txt_deptname);

        try {

            $demo = DB::table('demo_masters')
                ->select('demo_masters.demo_desc')
                ->where('demo_masters.demo_desc', '=', $request->txt_demodesc)
                ->where('demo_masters.demo_id', '<>', $request->txt_demo_id)
                ->where('demo_masters.Enabled', '=', '0')
                ->get()->count();

            if ($demo > 0) {
                return redirect()->back()->withInput()->with('error', 'Demo ' . $request->txt_demodesc . ' Already Exist');

            } else {

                $current_time = Carbon::now()->toDateTimeString();
                $user = DB::table('demo_masters')
                    ->where('demo_id', $request->txt_demo_id)
                    ->update(['demo_desc' => $request->txt_demodesc != null ? $request->txt_demodesc : '',
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('DemoList')->with('success', "Record Updated Successfully");

            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    //this for demo list


    public function get_alldemo()
    {

        try {

            $obj = DB::table('demo_masters')
                ->where('Enabled', '=', '0')
                ->get();

            return view('demo_list')->with('demos', $obj);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    // for delete demo
    public function destroy_demo(Request $request)
    {

        try {

            $check_emp_primary = DB::table('intern__evaluations')
                ->where('Demo_ID', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('intern__evaluations.*')
                ->count();


            if ($check_emp_primary > 0) {
                return response()->json(['msg' => 'Demo for this Intern Evaluation is already set. Delete the Demo first before deleting Intern Evaluation', 'status' => 'failed']);

            } else {

                $user = DB::table('demo_masters')->where('demo_id', $request->id)->update(['Enabled' => 1]);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
                }

            }


            // return redirect('DeparmentList')->with('success',"Delete Record Successfully");


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    //for show demo

    public function show_demo($id)
    {

        try {
            $user = DB::table('demo_masters')->where('demo_id', '=', $id)->first();


            return view('demo_edit')->with(['demo' => $user]);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    /*end demo*/


//    this for store department


    public function store_department(Request $request)
    {


        try {
            $current_time = Carbon::now()->toDateTimeString();


            $demo = DB::table('department_masters')
                ->select('department_masters.department_name')
                ->where('department_masters.department_name', '=', $request->txt_deptname)
                ->where('department_masters.Enabled', '=', '')
                ->get()->count();


            if ($demo > 0) {

                return redirect()->back()->withInput()->with('error', 'Department ' . $request->txt_deptname . ' Already Exist');


            } else {
                $obj = DB::table('department_masters')
                    ->insert([
                        'department_name' => $request->txt_deptname != null ? $request->txt_deptname : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('DeparmentList');


            }


        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }


    }


    // for edit dapertment

    public function edit_department(Request $request)
    {
        //dd($request->txt_deptid.$request->txt_deptname);

        try {
            $current_time = Carbon::now()->toDateTimeString();

            $demo = DB::table('department_masters')
                ->select('department_masters.department_name')
                ->where('department_masters.department_name', '=', $request->txt_deptname)
                ->where('department_masters.department_id', '<>', $request->txt_deptid)
                ->where('department_masters.Enabled', '=', '0')
                ->get()->count();


            if ($demo > 0) {

                return redirect()->back()->with('error', 'Department ' . $request->txt_deptname . ' Already Exist');


            } else {

                $user = DB::table('department_masters')
                    ->where('department_id', $request->txt_deptid)
                    ->update(['department_name' => $request->txt_deptname != null ? $request->txt_deptname : '',
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('DeparmentList')->with('success', "Record Updated Successfully");

            }
        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

//    this for store designation


    public function store_designation(Request $request)
    {


        try {

            $current_time = Carbon::now()->toDateTimeString();

            $desig = DB::table('designation_masters')
                ->select('designation_masters.designation_name')
                ->where('designation_masters.designation_name', '=', $request->txt_designationname)
                ->where('designation_masters.Enabled', '=', '0')
                ->get()->count();

            if ($desig > 0) {

                return redirect()->back()->withInput()
                    ->with('error', 'Designation ' . $request->txt_designationname . ' Already Exist');

            } else {

                $obj = DB::table('designation_masters')
                    ->insert([
                        'designation_name' => $request->txt_designationname != null ? $request->txt_designationname : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('DesignationList');


            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    // for edit designation

    public function edit_designation(Request $request)
    {

        try {
            $current_time = Carbon::now()->toDateTimeString();

            $desig = DB::table('designation_masters')
                ->select('designation_masters.designation_name')
                ->where('designation_masters.designation_name', '=', $request->txt_designationname)
                ->where('designation_masters.designation_id', '<>', $request->txt_designationid)
                ->where('designation_masters.Enabled', '=', '0')
                ->get()->count();

            if ($desig > 0) {

                return redirect()->back()->withInput()
                    ->with('error', 'Designation ' . $request->txt_designationname . ' Already Exist');

            } else {

                $user = DB::table('designation_masters')
                    ->where('designation_id', $request->txt_designationid)
                    ->update(['designation_name' => $request->txt_designationname != null ? $request->txt_designationname : '',
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('DesignationList')->with('success', "Record Updated Successfully");

            }
        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    //this for store employee experience

    public function store_employeeExp(Request $request)
    {

        if ($request->txt_empid == -1 || $request->txt_empid == null) {

            return redirect()->back()->withInput()->with('error', 'Employee Name Not Selectd');

        } else {

            try {

                $from_date = trim($request->dt_fromdate);
                $to_date = trim($request->dt_todate);


                $chkEmpExp = DB::table('employee_experinces')
                    ->whereNotBetween('employee_experinces.Frome_Date', [$from_date, $to_date])
                    ->whereNotBetween('employee_experinces.To_Date',[$from_date,$to_date])
                    ->orWhere(function ($query) use ($from_date, $to_date) {

                        return $query->where('employee_experinces.Frome_Date', '>=', $from_date)
                            ->where('employee_experinces.To_Date', '=<', $to_date);
                    })
                    ->get()->count();
                $current_time = Carbon::now()->toDateTimeString();

                $maxcompanyname = DB::table('employee_experinces')
                    ->select('Comp_No')
                    ->where('Emp_id', '=', $request->txt_empid)
                    ->where('Enabled', '=', '0')
                    ->max('Comp_No');


                $obj = DB::table('employee_experinces')
                    ->insert(['Emp_id' => $request->txt_empid != null ? $request->txt_empid : '',
                        'Comp_No' => $maxcompanyname + 1,
                        'Company_Name' => $request->txt_companyname != null ? $request->txt_companyname : '',
                        'Frome_Date' => $request->dt_fromdate,
                        'To_Date' => $request->dt_todate,
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time
                    ]);


                return redirect('EmployeeExpList');


            } catch (Exception $e) {

                //return $e->getMessage();
                return view('excaption');

            }
        }
    }


    //this for edit employee experience

    public function edit_employeeExp(Request $request)
    {
        if ($request->txt_empid == -1 || $request->txt_empid == null) {

            return redirect()->back()->withInput()->with('error', 'Employee Name Not Selectd');

        } else {

            try {

                $from_date = trim($request->dt_fromdate);
                $to_date = trim($request->dt_todate);


                $chkEmpExp = DB::table('employee_experinces')
                    ->whereNotBetween('employee_experinces.Frome_Date', [$from_date, $to_date])
                    ->whereNotBetween('employee_experinces.To_Date',[$from_date,$to_date])
                    ->orWhere(function ($query) use ($from_date, $to_date) {

                        return $query->where('employee_experinces.Frome_Date', '>=', $from_date)
                            ->where('employee_experinces.To_Date', '=<', $to_date);
                    })
                    ->get()->count();
                $current_time = Carbon::now()->toDateTimeString();


                $empexp = DB::table('employee_experinces')
                    ->where('id', $request->txt_id)
                    ->update(['Emp_id' => $request->txt_empid != null ? $request->txt_empid : '',
                        'Company_Name' => $request->txt_companyname != null ? $request->txt_companyname : '',
                        'Frome_Date' => $request->dt_fromdate,
                        'To_Date' => $request->dt_todate,
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('EmployeeExpList')->with('success', "Record Updated Successfully");


            } catch (Exception $e) {


                //  return $e->getMessage();

                return view('excaption');

            }


        }
    }

    public function AddEmployeeExperience()
    {

        try {

            $EMPEXP = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('Enabled', '=', '0')
				->orderBy('employee_masters.emp_name')
                ->get();


            return view('employee_experience_add')->with(['emp' => $EMPEXP,

            ]);

        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }
    }

//this for show update employee experience

    public function show_employeeExp($id)
    {


        try {

            $empexp = DB::table('employee_experinces')->where('id', '=', $id)->first();

            $empexp1 = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('Enabled', '=', '0')
                ->get();

            return view('employee_experience_edit')->with(['empexpp' => $empexp, 'EMP' => $empexp1]);

        } catch (Exception $e) {

            //return $e->getMessage();

            return view('excaption');

        }

    }

//    this for store evalution


    public function store_evalution(Request $request)
    {

        try {
            $current_time = Carbon::now()->toDateTimeString();
            $user = DB::table('evalution_masters')
                ->select('eval_desc')
                ->where('eval_desc', '=', $request->txt_evaldesc)
                ->where('Enabled', '=', '0')
                ->get()
                ->count();

            if ($user > 0) {

                return redirect()->back()->withInput()->with('success', 'Evaluation ' . $request->txt_evaldesc . ' Already Exist');

            } else {
                $obj = DB::table('evalution_masters')
                    ->insert(['eval_desc' => $request->txt_evaldesc != null ? $request->txt_evaldesc : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('EvalutionList');


            }

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    // for edit evalution

    public function edit_evalution(Request $request)
    {
        //dd($request->txt_deptid.$request->txt_deptname);

        $current_time = Carbon::now()->toDateTimeString();


        try {

            $demo = DB::table('evalution_masters')
                ->select('evalution_masters.eval_desc')
                ->where('evalution_masters.eval_desc', '=', $request->txt_evaldesc)
                ->where('evalution_masters.eval_id', '<>', $request->txt_evalid)
                ->where('evalution_masters.Enabled', '=', '0')
                ->get()->count();

            if ($demo > 0) {
                return redirect()->back()->withInput()->with('error', 'Evalution ' . $request->txt_evaldesc . ' Already Exist');

            } else {

                $user = DB::table('evalution_masters')
                    ->where('eval_id', $request->txt_evalid)
                    ->update(['eval_desc' => $request->txt_evaldesc != null ? $request->txt_evaldesc : '',
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('EvalutionList')->with('success', "Record Updated Successfully");

            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    //this for store login master

    public function store_login(Request $request)
    {
         try {

            $current_time = Carbon::now()->toDateTimeString();

            $user = DB::table('login_masters')
                ->select('Phone_No')
                ->orWhere('Phone_No', '=', $request->txt_phno)
                ->where('Enabled', '=', '0')
                ->get()
                ->count();

            if ($user > 0) {

                return redirect()->back()->withInput()->with('error',  '
                  Phone  Number ' . $request->txt_phno . ' Already Register');
            } else {
                $login = DB::table('login_masters')
                    ->insert(['Password' => $request->txt_password != null ? $request->txt_password : '',
                        'Phone_No' => $request->txt_phno,
                        'User_Name' =>$request->txt_username,
                        'Email' => $request->txt_email != null ? $request->txt_email : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('LoginList');


            }


        }
		catch (Exception $e) {


            return view('excaption');

        }
    }



//this for edit  login master

    public function edit_login(Request $request)
    {

        try {

            $current_time = Carbon::now()->toDateTimeString();

            $user = DB::table('login_masters')
                ->where('UserId', $request->txt_id)
                ->update(['Password' => $request->txt_password != null ? $request->txt_password : '',
                    'Phone_No' => $request->txt_phno,
                    'User_Name' =>$request->txt_username,
                    'Email' => $request->txt_email != null ? $request->txt_email : '',
                    'LastUpdated_By' => session()->get('user_id'),
                    'updated_at' => $current_time]);


            return redirect('LoginList')->with('success', "Record Updated Successfully");


        }
		catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }
    }


//    this for store message


    public function store_message(Request $request)
    {
        try {
            $current_time = Carbon::now()->toDateTimeString();


            $demo2 = DB::table('message_masters')
                ->select('message_masters.message_category')
                ->where('message_masters.message_category', '=', $request->txt_msgcategory)
                ->where('message_masters.message_subcategory', '=', $request->txt_msgsubcategory)
                ->where('message_masters.message_description', '=', $request->txt_msgdescription)
                ->where('message_masters.Enabled', '=', '0')
                ->get()->count();

            if ($demo2 > 0) {

                return redirect()->back()->withInput()->with('error', 'This Message  Already Added in Message Subcategory ' . $request->txt_msgdescription);


            } else {


                $obj = DB::table('message_masters')
                    ->insert(['message_id' => $request->txt_msgid,
                        'message_category' => $request->txt_msgcategory != null ? $request->txt_msgcategory : '',
                        'message_subcategory' => $request->txt_msgsubcategory != null ? $request->txt_msgsubcategory : '',
                        'message_description' => $request->txt_msgdescription != null ? $request->txt_msgdescription : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('MessageList');

            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

//this for store placement drive

    public function store_placement_drive(Request $request)
    {

        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_clgid == -1 || $request->txt_clgid == null) {


            return redirect()->back()->withInput()->with('error', 'College Name Not Selectd');


        } else {
            try {


                $obj = DB::table('placement__drives')
                    ->insert(['College_Id' => $request->txt_clgid,
                        'Drive_Date' => $request->dt_drivedate,
                        'register_student' => $request->txt_register_student != null ? $request->txt_register_student : 0,
                        'test_selects' => $request->txt_test_selects ? $request->txt_test_selects : 0,
                        'demo_selects' => $request->txt_demo_selects ? $request->txt_demo_selects : 0,
                        'domain_interview_select' => $request->txt_domain_interview ? $request->txt_domain_interview : 0,
                        'final_interview_select' => $request->txt_final_interview ? $request->txt_final_interview : 0,
                        'technical' => $request->txt_technical ? $request->txt_technical : 0,
                        'aptitude' => $request->txt_aptitude ? $request->txt_aptitude : 0,
                        'verbal' => $request->txt_verbal ? $request->txt_verbal : 0,
                        'misc' => $request->txt_misc ? $request->txt_misc : 0,
                        'conditional_offers' => $request->txt_conditional_offers ? $request->txt_conditional_offers : 0,
                        'Drive_Status' => $request->txt_drivests != null ? $request->txt_drivests : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('PlaceDriveList');


            } catch (Exception $e) {


                // return $e->getMessage();

                return view('excaption');

            }

        }

    }

//this for show update placement drive

    public function show_placement_drive($id)
    {
        try {

            $user = DB::table('placement__drives')->where('Placement_Drive_Id', $id)
                ->first();

            $collage = DB::table('collage_masters')
                ->select(DB::raw('CONCAT(collage_name, " - ", region , " - ", spoc) as name'),
                    'collage_id as collage_id')
                ->where('collage_masters.Enabled', '=', '0')
				->orderBy('collage_masters.collage_name')
                ->get();

            return view('placement_drive_edit')->with(['plsmntdrive' => $user, 'collage' => $collage]);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }

    //this for edit  placement drive

    public function edit_placement_drive(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        if ($request->txt_clgid == -1 || $request->txt_clgid == null) {


            return redirect()->back()->with('error', 'College Name Not Selectd');


        } else {
            try {

                $obj = DB::table('placement__drives')->where('Placement_Drive_Id', $request->txt_plcmntid)
                    ->update(['College_Id' => $request->txt_clgid,
                        'Drive_Date' => $request->dt_drivedate,
                        'register_student' => $request->txt_register_student != null ? $request->txt_register_student : 0,
                        'test_selects' => $request->txt_test_selects ? $request->txt_test_selects : 0,
                        'demo_selects' => $request->txt_demo_selects ? $request->txt_demo_selects : 0,
                        'domain_interview_select' => $request->txt_domain_interview ? $request->txt_domain_interview : 0,
                        'final_interview_select' => $request->txt_final_interview ? $request->txt_final_interview : 0,
                        'technical' => $request->txt_technical ? $request->txt_technical : 0,
                        'aptitude' => $request->txt_aptitude ? $request->txt_aptitude : 0,
                        'verbal' => $request->txt_verbal ? $request->txt_verbal : 0,
                        'misc' => $request->txt_misc ? $request->txt_misc : 0,
                        'conditional_offers' => $request->txt_conditional_offers ? $request->txt_conditional_offers : 0,
                        'Drive_Status' => $request->txt_drivests != null ? $request->txt_drivests : '',
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('PlaceDriveList')->with('success', "Record Updated Successfully");;

            } catch (Exception $e) {


                //  return $e->getMessage();

                return view('excaption');

            }

        }
    }

    public function AddPlacementDrive()
    {


        try {
            $obj = DB::table('collage_masters')
                ->select(DB::raw('CONCAT(collage_name, " - ", region , " - ", spoc) as name'),
                    'collage_id as collage_id')
                ->where('collage_masters.Enabled', '=', '0')
				->orderBy('collage_masters.collage_name')
                ->get();

            return view('placement_drive_add')->with([
                'plcmntdrivee' => $obj
            ]);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');


        }
    }
    /*start Qualification language  */

    //this for list Qualification language

    public function get_allquali_lang()
    {
        try {
            $qualang = DB::table('quali_lang_masters')
                ->where('Enabled', '=', 0)
                ->get();

            return view('qualification_Lang_list')->with('QuaLang', $qualang);

        } catch (Exception $e) {

            return view('excaption');

        }


    }

    //this for store Qualification language

    public function store_quali_lang(Request $request)
    {

        try {
            $current_time = Carbon::now()->toDateTimeString();
            $qualang = DB::table('quali_lang_masters')
                ->select('Qualification_Dec')
                ->where('Qualification_Dec', '=', $request->txt_QuaDec)
                ->where('Enabled', '=', '0')
                ->get()
                ->count();

            if ($qualang > 0) {

                return redirect()->back()->withInput()->with('success', 'Qulification ' . $request->txt_QuaDec . ' Already Exist');

            } else {
                $obj = DB::table('quali_lang_masters')
                    ->insert(['Qualification_Dec' => $request->txt_QuaDec != null ? $request->txt_QuaDec : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time
                    ]);


                return redirect('QualiLangList');


            }

        } catch (Exception $e) {


            return view('excaption');

        }


    }

    //this for edit Qualification language

    public function edit_quali_lang(Request $request)
    {

        try {
            $current_time = Carbon::now()->toDateTimeString();

            $demo = DB::table('quali_lang_masters')
                ->select('quali_lang_masters.Qualification_Dec')
                ->where('quali_lang_masters.Qualification_Dec', '=', $request->txt_QuaDec)
                ->where('quali_lang_masters.Qualification_Id', '<>', $request->txt_id)
                ->where('quali_lang_masters.Enabled', '=', '0')
                ->get()->count();


            if ($demo > 0) {

                return redirect()->back()->withInput()->with('error', 'Qulification ' . $request->txt_QuaDec . ' Already Exist');


            } else {

                $user = DB::table('quali_lang_masters')
                    ->where('Qualification_Id', $request->txt_id)
                    ->update(['Qualification_Dec' => $request->txt_QuaDec != null ? $request->txt_QuaDec : '',
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('QualiLangList')->with('success', "Record Updated Successfully");

            }
        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

//this for store role master

    public function store_role(Request $request)
    {
        try {
            $current_time = Carbon::now()->toDateTimeString();

            $user = DB::table('role_masters')
                ->select('role_masters.Role_Name')
                ->where('role_masters.Role_Name', '=', $request->txt_rolename)
                ->where('role_masters.Enabled', '=', '0')
                ->get()->count();

            if ($user) {

                return redirect()->back()->withInput()
                    ->with('error', 'Role ' . $request->txt_rolename . ' Already Exist');


            } else {
                $role = DB::table('role_masters')
                    ->insert(['Role_Name' => $request->txt_rolename != null ? $request->txt_rolename : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);

                return redirect('RoleList');
            }


        } catch (Exception $e) {

            return view('excaption');

        }
    }

    //this for edit role master

    public function edit_role(Request $request)
    {
        try {
            $current_time = Carbon::now()->toDateTimeString();

            $user = DB::table('role_masters')
                ->select('role_masters.Role_Name')
                ->where('role_masters.Role_Name', '=', $request->txt_rolename)
                ->where('role_masters.Role_Id', '<>', $request->txt_id)
                ->where('role_masters.Enabled', '=', '0')
                ->get()->count();

            if ($user) {

                return redirect()->back()
                    ->with('error', 'Role ' . $request->txt_rolename . ' Already Exist');


            } else {

                $user = DB::table('role_masters')
                    ->where('Role_Id', $request->txt_id)
                    ->update(['Role_Name' => $request->txt_rolename != null ? $request->txt_rolename : '',
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('RoleList')->with('success', "Record Updated Successfully");

            }
        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }

//    this for store state


    public function store_state(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        if ($request->txt_countryid == -1 || $request->txt_countryid == null) {


            return redirect()->back()->withInput()->with('error', 'Country Not Selectd');


        } else {

            try {

                $user = DB::table('state_masters')
                    ->select('state_masters.state_name')
                    ->where('state_masters.state_name', '=', $request->txt_statename)
                    ->where('state_masters.Enabled', '=', '0')
                    ->get()->count();


                if ($user > 0) {


                    return redirect()->back()->withInput()->with('error', 'State ' . $request->txt_statename . ' Already Exist');

                } else {


                    $obj = DB::table('state_masters')
                        ->insert(['state_name' => $request->txt_statename != null ? $request->txt_statename : '',
                            'country_id' => $request->txt_countryid,
                            'Created_By' => session()->get('user_id'),
                            'created_at' => $current_time
                        ]);


                    return redirect('StateList');

                }


            } catch (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }
        }


    }


    //for show state

    public function show_state($id)
    {

        try {

            $user = DB::table('state_masters')->where('state_id', '=', $id)->first();


            $obj = DB::table('country_masters')
                ->select('country_masters.country_id', 'country_masters.country_name')
                ->where('country_masters.Enabled', '=', '0')
				->orderBy('country_masters.country_name')
                ->get();

            return view('state_edit')->with(['state' => $user, 'country' => $obj]);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    // for edit state

    public function edit_state(Request $request)
    {
        //dd($request->txt_deptid.$request->txt_deptname);

        $current_time = Carbon::now()->toDateTimeString();
        if ($request->txt_countryid == -1 || $request->txt_countryid == null) {

            return redirect('AddState')->with('error', 'Country Not Selectd');


        } else {


            try {

                $state = DB::table('state_masters')
                    ->select('state_masters.state_name')
                    ->where('state_masters.state_name', '=', $request->txt_statename)
                    ->where('state_masters.state_id', '<>', $request->txt_stateid)
                    ->where('state_masters.Enabled', '=', '0')
                    ->get()->count();


                if ($state > 0) {


                    return redirect()->back()->withInput()->with('error', 'State ' . $request->txt_statename . ' Already Exist');

                } else {

                    $user = DB::table('state_masters')
                        ->where('state_id', '=', $request->txt_stateid)
                        ->update(['state_name' => $request->txt_statename != null ? $request->txt_statename : '',
                            'country_id' => $request->txt_countryid,
                            'LastUpdated_By' => session()->get('user_id'),
                            'updated_at' => $current_time]);


                    return redirect('StateList')->with('success', "Record Updated Successfully");

                }
            } catch (Exception $e) {


                // return $e->getMessage();

                return view('excaption');

            }

        }


    }


    public function get_countries()
    {


        try {
            $obj = DB::table('country_masters')
                ->select('country_masters.country_id', 'country_masters.country_name')
                ->where('country_masters.Enabled', '=', '0')
				->orderBy('country_masters.country_name')
                ->get();

            return view('state_add')->with('countries', $obj);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

//    this for store skill


    public function store_skill(Request $request)
    {


        try {

            $current_time = Carbon::now()->toDateTimeString();

            $skill = DB::table('skill_masters')
                ->select('skill_masters.skill_name')
                ->where('skill_masters.skill_name', '=', $request->txt_skillname)
                ->where('skill_masters.Enabled', '=', '0')
                ->get()->count();


            if ($skill > 0) {


                return redirect()->back()->withInput()->with('error', 'Skill ' . $request->txt_skillname . ' Already Exist');

            } else {
                $obj = DB::table('skill_masters')
                    ->insert(['skill_name' => $request->txt_skillname != null ? $request->txt_skillname : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time
                    ]);


                return redirect('SkillList');


            }

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    // for edit skill

    public function edit_skill(Request $request)
    {
        //dd($request->txt_deptid.$request->txt_deptname);

        try {

            $skill = DB::table('skill_masters')
                ->select('skill_masters.skill_name')
                ->where('skill_masters.skill_name', '=', $request->txt_skillname)
                ->where('skill_masters.skill_id', '<>', $request->txt_skillid)
                ->where('skill_masters.Enabled', '=', '0')
                ->get()->count();


            if ($skill > 0) {


                return redirect()->back()->withInput()->with('error', 'Skill ' . $request->txt_skillname . ' Already Exist');

            } else {
                $current_time = Carbon::now()->toDateTimeString();
                $user = DB::table('skill_masters')
                    ->where('skill_id', $request->txt_skillid)
                    ->update(['skill_name' => $request->txt_skillname != null ? $request->txt_skillname : '',
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('SkillList')->with('success', "Record Updated Successfully");

            }
        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

//    this for store topic






//    this for store type


    public function store_type(Request $request)
    {

        try {
            $current_time = Carbon::now()->toDateTimeString();
            $user = DB::table('type_masters')
                ->select('type_masters.type_desc')
                ->where('type_masters.type_desc', '=', $request->txt_typedesc)
                ->where('type_masters.type_id', '<>', $request->txt_typeid)
                ->where('type_masters.Enabled', '=', '0')
                ->get()->count();

            if ($user) {

                return redirect('AddType')->with('error', 'Type ' . $request->txt_typedesc . ' Already Exist Try Another');

            } else {
                $obj = DB::table('type_masters')
                    ->insert(['type_desc' => $request->txt_typedesc != null ? $request->txt_typedesc : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('TypeList');


            }

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    // for edit type

    public function edit_type(Request $request)
    {
        //dd($request->txt_deptid.$request->txt_deptname);


        try {
            $current_time = Carbon::now()->toDateTimeString();

            $desig = DB::table('type_masters')
                ->select('type_masters.type_desc')
                ->where('type_masters.type_desc', '=', $request->txt_typedesc)
                ->where('type_masters.type_id', '<>', $request->txt_typeid)
                ->where('type_masters.Enabled', '=', '0')
                ->get()->count();


            if ($desig > 0) {

                return redirect()->back()
                    ->with('error', 'Type ' . $request->txt_typedesc . ' Already Exist');

            } else {

                $user = DB::table('type_masters')
                    ->where('type_id', $request->txt_typeid)
                    ->update(['type_desc' => $request->txt_typedesc != null ? $request->txt_typedesc : '',
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('TypeList')->with('success', "Record Updated Successfully");

            }
        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }








    /*start departments*/


    //this for document list


    public function get_alldeparments()
    {


        try {

            $obj = DB::table('department_masters')
                ->where('Enabled', '=', '0')
				->orderBy('department_name')
                ->get();

            return view('department_list')->with('deparments', $obj);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    // for delete department
    public function destroy_department(Request $request)
    {


        try {

            $check_emp_primary = DB::table('employee_masters')
                ->where('department_id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('employee_masters.*')
                ->count();


            if ($check_emp_primary > 0) {
                return response()->json(['msg' => 'Employee for this Department is already set. Delete the Employee first before deleting Department', 'status' => 'failed']);

            } else {


                $user = DB::table('department_masters')
                    ->where('department_id', $request->id)
                    ->update(['Enabled' => '1']);


                //$users = User::withTrashed()->where('department_id', 1)->get();
                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
                }
            }


            // return redirect('DeparmentList')->with('success',"Delete Record Successfully");


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    //for show department

    public function show_deparmnt($id)
    {

        try {
            $user = DB::table('department_masters')
                ->where('department_id', '=', $id)
				->orderBy('department_name')
                ->first();


            return view('department_edit')->with(['department' => $user]);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }



    /* end departments*/


    /*start Organizations*/

    //this for organization list


    public function get_allorganizations()
    {

        try {

            $obj = DB::table('organization_masters')
                ->join('country_masters', 'country_masters.country_id',
                    '=', 'organization_masters.organization_country')
                ->join('state_masters', 'state_masters.state_id',
                    '=', 'organization_masters.organization_state')
                ->join('city_masters', 'city_masters.city_id',
                    '=', 'organization_masters.organization_city')
                ->select('organization_masters.*', 'country_masters.country_name',
                    'state_masters.state_name', 'city_masters.city_name')
                ->where('organization_masters.Enabled', '=', '0')
				->orderBy('organization_masters.organization_name')
                ->get();

            return view('organization_list')->with('orgnizatios', $obj);


        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }


    }


    // this for store organization


    public function store_organization(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();


        if ($request->txt_country == -1 || $request->txt_country == null) {


            return redirect()->back()->withInput()->with('error', 'Country Not Selectd');

        } else if ($request->txt_state == -1 || $request->txt_state == null) {

            return redirect()->back()->withInput()->with('error', 'State Not Selected');

        } else if ($request->txt_city == -1 || $request->txt_city == null) {

            return redirect()->back()->withInput()->with('error', 'City Not Selected');

        } else {
            try {

                $org = DB::table('organization_masters')
                    ->select('organization_masters.organization_name')
                    ->where('organization_masters.organization_name', '=', $request->txt_orgname)
                    ->where('organization_masters.Enabled', '=', '0')
                    ->get()->count();


                if ($org > 0) {


                    return redirect()->back()->withInput()->with('error', 'Organizations ' . $request->txt_orgname . ' Already Exist');

                } else {
                    $obj = DB::table('organization_masters')
                        ->insert([
                            'organization_name' => $request->txt_orgname != null ? $request->txt_orgname : '',
                            'organization_address1' => $request->txt_address1 != null ? $request->txt_address1 : '',
                            'organization_address2' => $request->txt_address2 != null ? $request->txt_address2 : '',
                            'organization_city' => $request->txt_city != null ? $request->txt_city : '',
                            'organization_state' => $request->txt_state != null ? $request->txt_state : '',
                            'organization_country' => $request->txt_country != null ? $request->txt_country : '',
                            'Created_By' => session()->get('user_id'),
                            'created_at' => $current_time]);


                    return redirect('OrganizationList');


                }


            } catch (Exception $e) {


                // return $e->getMessage();

                return view('excaption');

            }

        }


    }


    // for delete department
    public function destroy_organization(Request $request)
    {

        try {

            $check_emp_primary = DB::table('employee_masters')
                ->where('organization_id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('employee_masters.*')
                ->count();


            if ($check_emp_primary > 0) {
                return response()
                    ->json(['msg' => 'Employee for this Organization is already set.
                    Delete the Employee first before deleting Organization', 'status' => 'failed']);

            } else {


                $user = DB::table('organization_masters')
                    ->where('organization_id', $request->id)
                    ->update(['Enabled' => '1']);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
                }
            }


            // return redirect('DeparmentList')->with('success',"Delete Record Successfully");


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    //for show department

    public function show_orgnization($id)
    {

        try {

            $user = DB::table('organization_masters')
                ->where('organization_id', '=', $id)
                ->where('Enabled', '=', '0')
				->orderBy('organization_masters.organization_name')
                ->first();


            $obj = DB::table('country_masters')
                ->select('country_masters.country_id', 'country_masters.country_name')
                ->where('country_masters.Enabled', '=', '0')
				->orderBy('country_name')
                ->get();

            $obj1 = DB::table('state_masters')
                ->select('state_masters.state_id', 'state_masters.state_name')
                /*->where('state_masters.country_id', '=', $user->organization_country)*/
                ->where('state_masters.Enabled', '=', '0')
				->orderBy('state_name')
                ->get();


            $obj2 = DB::table('city_masters')
                ->select('city_masters.city_id', 'city_masters.city_name')
                /*->where('city_masters.state_id', '=', $user->organization_state)*/
                ->where('city_masters.Enabled', '=', '0')
				->orderBy('city_name')
                ->get();


            return view('organization_edit')->with(['organizations' => $user,
                'countries' => $obj, 'states' => $obj1, 'cities' => $obj2]);

        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }


    }


    // for edit organization

    public function edit_organization(Request $request)
    {

        $current_time = Carbon::now()->toDateTimeString();


        if ($request->txt_country == -1 || $request->txt_country == null) {


            return redirect()->back()->with('error', 'Country Not Selected');

        } else if ($request->txt_state == -1 || $request->txt_state == null) {

            return redirect()->back()->with('error', 'State Not Selected');

        } else if ($request->txt_city == -1 || $request->txt_city == null) {

            return redirect()->back()->with('error', 'City Not Selected');

        } else {

            try {

                $org = DB::table('organization_masters')
                    ->select('organization_masters.organization_name')
                    ->where('organization_masters.organization_name', '=', $request->txt_orgname)
                    ->where('organization_masters.organization_id', '<>', $request->txt_orgid)
                    ->where('organization_masters.Enabled', '=', '0')
                    ->get()->count();


                if ($org > 0) {


                    return redirect()->back()->withInput()->with('error', 'Organizations ' . $request->txt_orgname . ' Already Exist');

                } else {
                    $user = DB::table('organization_masters')
                        ->where('organization_id', $request->txt_orgid)
                        ->update(['organization_name' => $request->txt_orgname != null ? $request->txt_orgname : '',
                            'organization_address1' => $request->txt_address1 != null ? $request->txt_address1 : '',
                            'organization_address2' => $request->txt_address2 != null ? $request->txt_address2 : '',
                            'organization_city' => $request->txt_city != null ? $request->txt_city : '',
                            'organization_state' => $request->txt_state != null ? $request->txt_state : '',
                            'organization_country' => $request->txt_country != null ? $request->txt_country : '',
                            'LastUpdated_By' => session()->get('user_id'),
                            'updated_at' => $current_time]);


                    return redirect('OrganizationList')->with('success', "Record Updated Successfully");

                }
            } catch (Exception $e) {


                // return $e->getMessage();

                return view('excaption');

            }

        }


    }


    public function AddOrganization()
    {

        try {
            $country = DB::table('country_masters')
                ->select('country_masters.country_id', 'country_masters.country_name')
                ->where('country_masters.Enabled', '=', '0')
				->orderBy('country_name')
                ->get();

            $state = DB::table('state_masters')
                ->select('state_masters.state_id', 'state_masters.state_name')
                ->where('state_masters.Enabled', '=', '0')
				->orderBy('state_name')
                ->get();

            $city = DB::table('city_masters')
                ->select('city_masters.city_id', 'city_masters.city_name')
                ->where('city_masters.Enabled', '=', '0')
				->orderBy('city_name')
                ->get();


            return view('organization_add')->with([
                'countries' => $country,
                'states' => $state,
                'cities' => $city]);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }
    }


    /*end Organizations*/


    /*start designation*/


    //this for designation list


    public function get_alldesignation()
    {

        try {
            $obj = DB::table('designation_masters')
                ->where('Enabled', '=', '0')->get();

            return view('designation_list')->with('designations', $obj);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    // for delete designation

    public function destroy_designation(Request $request)
    {

        try {


            $check_emp_primary = DB::table('employee_masters')
                ->where('designation_id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('employee_masters.*')
                ->count();


            if ($check_emp_primary > 0) {
                return response()->json(['msg' => 'Employee for this Designation is already set. Delete the Employee first before deleting Designation', 'status' => 'failed']);

            } else {


                $user = DB::table('designation_masters')->where('designation_id',
                    $request->id)->update(['Enabled' => '1']);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
                }
                // return redirect('DeparmentList')->with('success',"Delete Record Successfully");

            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    //for show designation

    public function show_designation($id)
    {

        try {

            $user = DB::table('designation_masters')->where('designation_id', '=', $id)->first();


            return view('designation_edit')->with(['designation' => $user]);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }





    /* end designation*/


    /*start skill*/


    //this for skill list


    public function get_allskill()
    {

        try {

            $obj = DB::table('skill_masters')->
            where('Enabled', '=', '0')->get();

            return view('skill_list')->with('skills', $obj);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    // for delete skill

    public function destroy_skill(Request $request)
    {

        try {


            $check_emp_primary = DB::table('employee_masters')
                ->where('primary_skill', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('employee_masters.*')
                ->count();


            $check_emp_second = DB::table('employee_masters')
                ->where('secondary_skill', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('employee_masters.*')
                ->count();


            $check_student = DB::table('student_masters')
                ->where('primary_skill', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('student_masters.*')
                ->count();

            $check_course = DB::table('course_masters')
                ->where('primary_skil','=',$request->id)
                ->where('Enabled','=','0')
                ->select('course_masters.*')
                ->count();

            $check_student_feedback = DB::table('student_feedback')
                ->where('Skill_ID','=',$request->id)
                ->where('Enabled','=','0')
                ->select('student_feedback.*')
                ->count();

            $check_Topic = DB::table('topic_masters')
                ->where('Skill_ID','=',$request->id)
                ->where('Enabled','=','0')
                ->select('topic_masters.*')
                ->count();

            $check_Sub_Topic = DB::table('sub__topic_masters')
                ->where('Skill_ID','=',$request->id)
                ->where('Enabled','=','0')
                ->select('sub__topic_masters.*')
                ->count();

            $check_Topic_Evaluation = DB::table('topic_evaluation_masters')
                ->where('Skill_ID','=',$request->id)
                ->where('Enabled','=','0')
                ->select('topic_evaluation_masters.*')
                ->count();



            if ($check_emp_primary > 0) {
                return response()->json(['msg' => 'Employee for this Primary Skill is already set. Delete the Employee first before deleting Skill', 'status' => 'failed']);

            } else if ($check_emp_second > 0) {
                return response()->json(['msg' => 'Employee for this Secondary Skill is already set. Delete the Employee first before deleting Skill', 'status' => 'failed']);

            } else if ($check_student > 0) {

                return response()->json(['msg' => 'Student for this Primary Skill is already set. Delete the Student first before deleting Skill', 'status' => 'failed']);

            }  else if ($check_course > 0) {

                return response()->json(['msg' => 'Course for this Primary Skill is already set. Delete the Course first before deleting Skill', 'status' => 'failed']);

            }else if ($check_student_feedback > 0) {

                return response()->json(['msg' => 'Student Feedback for this Skill is already set. Delete the Student Feedback first before deleting Skill', 'status' => 'failed']);

            }else if ($check_Topic > 0) {

                return response()->json(['msg' => 'Topic for this Skill is already set. Delete the Topic first before deleting Skill', 'status' => 'failed']);

            }else if ($check_Sub_Topic > 0) {

                return response()->json(['msg' => 'Sub Topic for this Skill is already set. Delete the Sub Topic first before deleting Skill', 'status' => 'failed']);

            }else if ($check_Topic_Evaluation > 0) {

                return response()->json(['msg' => 'Topic Evaluation for this Skill is already set. Delete the Topic Evaluation first before deleting Skill', 'status' => 'failed']);

            } else {

                $user = DB::table('skill_masters')
                    ->where('skill_id', $request->id)
                    ->update(['Enabled' => '1']);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Deleted', 'status' => 'failed']);
                }
                // return redirect('DeparmentList')->with('success',"Delete Record Successfully");

            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    //for show skill

    public function show_skill($id)
    {

        try {
            $user = DB::table('skill_masters')
                ->where('skill_id', '=', $id)
                ->first();


            return view('skill_edit')->with(['skill' => $user]);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }





    /* end skill*/


    /*start type*/


    //this for type list


    public function get_alltype()
    {

        try {
            $obj = DB::table('type_masters')
                ->where('Enabled', '=', '0')
				->orderBy('type_desc')
				->get();

            return view('type_list')->with('types', $obj);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    // for delete type

    public function destroy_type(Request $request)
    {

        try {

            $check_emp_primary = DB::table('employee_masters')
                ->where('type', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('employee_masters.*')
                ->count();


            if ($check_emp_primary > 0) {
                return response()->json(['msg' => 'Employee for this Type is already set. Delete the Employee first before deleting Type', 'status' => 'failed']);

            } else {

                $user = DB::table('type_masters')->where('type_id', $request->id)
                    ->update(['Enabled' => '1']);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Type', 'status' => 'failed']);
                }

            }


            // return redirect('DeparmentList')->with('success',"Delete Record Successfully");


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    //for show type

    public function show_type($id)
    {
        try {

            $user = DB::table('type_masters')->where('type_id', '=', $id)->first();


            return view('type_edit')->with(['types' => $user]);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }





    /* end type*/



    //this for type message


    public function get_allmessage()
    {

        try {
            $obj = DB::table('message_masters')
                ->where('Enabled', '=', '0')
				->orderBy('message_category')
				->get();

            return view('message_list')->with('messges', $obj);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    // for delete message

    public function destroy_message(Request $request)
    {


        try {

            $user = DB::table('message_masters')->where('message_id', $request->id)->update(['Enabled' => '1']);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }
            // return redirect('DeparmentList')->with('success',"Delete Record Successfully");

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    //for show message

    public function show_message($id)
    {

        try {

            $user = DB::table('message_masters')->where('message_id', '=', $id)->first();


            return view('message_edit')->with(['messages' => $user]);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    // for edit message

    public function edit_message(Request $request)
    {
        //dd($request->txt_deptid.$request->txt_deptname);

        try {
            $current_time = Carbon::now()->toDateTimeString();


            $demo2 = DB::table('message_masters')
                ->select('message_masters.message_category')
                ->where('message_masters.message_category', '=', $request->txt_msgcategory)
                ->where('message_masters.message_subcategory', '=', $request->txt_msgsubcategory)
                ->where('message_masters.message_description', '=', $request->txt_msgdescription)
                ->where('message_masters.Enabled', '=', '0')
                ->where('message_masters.message_id', '<>', $request->txt_msgid)
                ->get()->count();

            if ($demo2 > 0) {

                return redirect()->back()->with('error', 'That Message  Already Added in Message Subcategory ' . $request->txt_msgdescription);


            } else {

                $user = DB::table('message_masters')
                    ->where('message_id', $request->txt_msgid)
                    ->update(['message_category' => $request->txt_msgcategory,
                        'message_subcategory' => $request->txt_msgsubcategory,
                        'message_description' => $request->txt_msgdescription,
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('MessageList')->with('success', "Record Updated Successfully");

            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    /* end message*/



    public function get_allevalution()
    {

        try {
            $obj = DB::table('evalution_masters')
                ->where('Enabled', '=', '0')->get();

            return view('evalution_list')->with('evalutions', $obj);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    // for delete evalution

    public function destroy_evalution(Request $request)
    {

        try {


            $check_emp_primary = DB::table('intern__evaluations')
                ->where('Eval_ID', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('intern__evaluations.*')
                ->count();


            if ($check_emp_primary > 0) {
                return response()->json(['msg' => 'Intern Evaluation for this Evaluation is already set. Delete the Intern Evaluation first before deleting Evaluation', 'status' => 'failed']);

            } else {

                $user = DB::table('evalution_masters')->where('eval_id', $request->id)->update(['Enabled' => 1]);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
                }

            }


            // return redirect('DeparmentList')->with('success',"Delete Record Successfully");


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    //for show evalution

    public function show_evalution($id)
    {

        try {

            $user = DB::table('evalution_masters')->where('eval_id', '=', $id)->first();

            return view('evalution_edit')->with(['evalutions' => $user]);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }



    public function get_allstate()
    {

        try {
            $obj = DB::table('state_masters')
                ->join('country_masters', 'country_masters.country_id',
                    '=', 'state_masters.country_id')
                ->select('state_masters.*', 'country_masters.country_name')
                ->where('state_masters.Enabled', '=', '0')
                ->get();


            return view('state_list')->with('states', $obj);


        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }


    }


    // for delete state

    public function destroy_state(Request $request)
    {

        try {


            $check_collage = DB::table('collage_masters')
                ->where('state_id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('collage_masters.*')
                ->count();


            $check_org = DB::table('organization_masters')
                ->where('organization_state', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('organization_masters.*')
                ->count();


            $check_city = DB::table('city_masters')
                ->where('state_id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('city_masters.*')
                ->count();

            $check_emp = DB::table('employee_masters')
                ->where('emp_state', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('employee_masters.*')
                ->count();

            $check_empper = DB::table('employee_masters')
                ->where('permanent_address_state', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('employee_masters.*')
                ->count();


            if ($check_collage > 0) {

                return response()->json(['msg' => 'College for this State is already set. Delete the College first before deleting State', 'status' => 'failed']);

            } else if ($check_org > 0) {

                return response()->json(['msg' => 'Organization for this State is already set. Delete the Organization first before deleting State', 'status' => 'failed']);

            } else if ($check_city > 0) {

                return response()->json(['msg' => 'City for this State is already set. Delete the City first before deleting State', 'status' => 'failed']);

            } else if ($check_emp > 0) {

                return response()->json(['msg' => 'Employee for this State is already set. Delete the Employee first before deleting State', 'status' => 'failed']);

            } else if ($check_empper > 0) {

                return response()->json(['msg' => 'Permenent Employee for this State  is already set. Delete the Employee first before deleting State', 'status' => 'failed']);

            } else {


                $user = DB::table('state_masters')->where('state_id', $request->id)->update(['Enabled' => 1]);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
                }

            }


            // return redirect('DeparmentList')->with('success',"Delete Record Successfully");


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    public function get_allcourse()
    {

        try {

            /*$obj = DB::table('course_masters')
                ->join('collage_masters', 'course_masters.collage_id', '=',
                    'collage_masters.collage_id')
                ->join('skill_masters', 'course_masters.primary_skil', '=',
                    'skill_masters.skill_id')
                ->select('course_masters.*', 'collage_masters.collage_name', 'skill_masters.skill_name')
                ->where('course_masters.Enabled', '=', 0)

                ->get();*/

			$obj = DB::table('course_masters')
                ->join('collage_masters', 'course_masters.collage_id', '=',
                    'collage_masters.collage_id')
                ->join('skill_masters', 'course_masters.primary_skil', '=',
                    'skill_masters.skill_id')
				->join('Program_Master','Program_Master.Program_Id' , '=' ,'course_masters.Program_Id')
                ->select('course_masters.*', 'collage_masters.collage_name', 'skill_masters.skill_name','Program_Master.Company_Program as Cmp_Prog',
							'Program_Master.Program_Name')
                ->where('course_masters.Enabled', '=', 0)

                ->get();
            return view('cource_list')->with('courses', $obj);


        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }


    }

    //this for store cource master

    public function store_cource(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_collageid == -1 || $request->txt_collageid == null) {


            return redirect()->back()->withInput()->with('error', 'College Name Not Selectd');

        } else if ($request->txt_primaryskill == -1 || $request->txt_primaryskill == null) {

            return redirect()->back()->withInput()->with('error', 'Primary Skill Not Selected');

        } else if ($request->txt_program == -1 || $request->txt_program == null) {

            return redirect()->back()->withInput()->with('error', 'Program Type Not Selected');

        } else {


            try {


                if ($request->has('chk_AssessmentReport')) {
                    $assmentreport = true;

                } else {
                    $assmentreport = false;
                }


                if ($request->has('chk_Discussion')) {
                    $discussionwithtpo = true;

                } else {
                    $discussionwithtpo = false;
                }


                if ($request->has('chk_client')) {
                    $client_email = true;

                } else {
                    $client_email = false;
                }


                if ($request->has('chk_trainer')) {

                    $trainer_email = true;

                } else {
                    $trainer_email = false;
                }


                $obj = DB::table('course_masters')
                    ->insert(['collage_id' => $request->txt_collageid,
                        'company_program' =>"",
                        'start_date' => $request->txt_startdate,
                        'end_date'=>$request->txt_enddate,
                        'batches_count' => $request->txt_batchcount,
                        'phases_count' => $request->txt_phasescount,
                        'type_of_program' => $request->txt_program,
                        'primary_skil' => $request->txt_primaryskill,
                        'remark' => $request->txt_remark != null ? $request->txt_remark : '',
                        'quant_count' => $request->txt_quantcount != null ? $request->txt_quantcount : '',
                        'verbal_count' => $request->txt_verbal != null ? $request->txt_verbal : '',
                        'technical_count' => $request->txt_technicalcount != null ? $request->txt_technicalcount : '',
                        'event_manager' => $request->txt_eventmanager != null ? $request->txt_eventmanager : '',
                        'ass_report_sent' => $assmentreport,
                        'discuss_with_tpo' => $discussionwithtpo,
                        'action_item' => $request->txt_actionitem != null ? $request->txt_actionitem : '',
                        'issue_update_remarks' => $request->txt_updateremark != null ? $request->txt_updateremark : '',
                        'solution_remark' => $request->txt_soluationRemark != null ? $request->txt_soluationRemark : '',
                        'email_to_client' => $client_email,
                        'email_to_trainer' => $trainer_email,
                        'program_rate' => $request->txt_programrate != null ? $request->txt_programrate : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time,
						'Program_Id'=>$request->cmbCourse
                    ]);


                return redirect('CourseList');


            } catch (Exception $e) {


                // return $e->getMessage();

                return view('excaption');

            }


        }


    }

    //this for destroy cource

    public function destroy_cource(Request $request)
    {


        try {

            $check_emp_primary = DB::table('course_transactions')
                ->where('Course_ID', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('course_transactions.*')
                ->count();


            $check_emp_second = DB::table('course_session_mappings')
                ->where('Course_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('course_session_mappings.*')
                ->count();


            $check_student = DB::table('attendances')
                ->where('Course_id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('attendances.*')
                ->count();


            if ($check_emp_primary > 0) {
                return response()->json(['msg' => 'Course Trasaction for this Course is already set. Delete the Course Trasaction first before deleting Course', 'status' => 'failed']);

            } else if ($check_emp_second > 0) {
                return response()->json(['msg' => 'Course Session Mapping for this Course is already set. Delete the Course Session Mapping first before deleting Course', 'status' => 'failed']);

            } else if ($check_student > 0) {

                return response()->json(['msg' => 'Attendance for this Course is already set. Delete the Attendance first before deleting Course', 'status' => 'failed']);

            }


            $user = DB::table('course_masters')->where('course_id', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }
            // return redirect('DeparmentList')->with('success',"Delete Record Successfully");


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    //this for show update cource

    public function show_cource($id)
    {

        try {
            $user = DB::table('course_masters')->where('course_id', '=', $id)->first();

            $collages = DB::table('collage_masters')
                ->select(DB::raw('CONCAT(collage_name, " - ", region , " - ", spoc) as name'),
                    'collage_id as collage_id')
                ->where('collage_masters.Enabled', '=', '0')
                ->get();

            $skill = DB::table('skill_masters')
                ->select('skill_masters.skill_id', 'skill_masters.skill_name')
                ->where('skill_masters.Enabled', '=', '0')
                ->get();

			$program = DB::table('Program_Master')
                ->select('Program_Master.Program_Id', 'Program_Master.Program_Name','Company_Program')
                ->where('Program_Master.Enabled', '=', '0')
				->orderBy('Company_Program')
                ->get();

            return view('cource_edit')->with(['course' => $user, 'collages' => $collages, 'primaryskill' => $skill,
						'program' => $program]);

        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }

    }

    //this for edit cource

    public function edit_cource(Request $request)
    {

        /*if ($request->txt_collageid == -1 || $request->txt_collageid == null) {


            return redirect()->back()->withInput()->with('error', 'College Name Not Selectd');

        } else*/ if ($request->txt_primaryskill == -1 || $request->txt_primaryskill == null) {

            return redirect()->back()->withInput()->with('error', 'Primary Skill Not Selected');

        } /*else if ($request->txt_program == -1 || $request->txt_program == null) {

            return redirect()->back()->withInput()->with('error', 'Program Type Not Selected');

        }*/ else {

            try {
                $current_time = Carbon::now()->toDateTimeString();

                if ($request->has('chk_AssessmentReport')) {
                    $assmentreport = true;

                } else {
                    $assmentreport = false;
                }

                if ($request->has('chk_Discussion')) {
                    $discussionwithtpo = true;

                } else {
                    $discussionwithtpo = false;
                }

                if ($request->has('chk_client')) {
                    $client_email = true;

                } else {
                    $client_email = false;
                }

                if ($request->has('chk_trainer')) {

                    $trainer_email = true;

                } else {
                    $trainer_email = false;
                }

                $user = DB::table('course_masters')
                    ->where('course_id', $request->txt_corsid)
                    ->update([//'collage_id' => $request->txt_collageid,
                        //'company_program' => $request->txt_companyprogram,
                        'start_date' => $request->txt_startdate,
                        'end_date'=>$request->txt_enddate,
                        'batches_count' => $request->txt_batchcount,
                        'phases_count' => $request->txt_phasescount,
                        'type_of_program' => $request->txt_program,
                        'primary_skil' => $request->txt_primaryskill,
                        'remark' => $request->txt_remark != null ? $request->txt_remark : '',
                        'quant_count' => $request->txt_quantcount != null ? $request->txt_quantcount : '',
                        'verbal_count' => $request->txt_verbal != null ? $request->txt_verbal : '',
                        'technical_count' => $request->txt_technicalcount != null ? $request->txt_technicalcount : '',
                        'event_manager' => $request->txt_eventmanager != null ? $request->txt_eventmanager : '',
                        'ass_report_sent' => $assmentreport,
                        'discuss_with_tpo' => $discussionwithtpo,
                        'action_item' => $request->txt_actionitem != null ? $request->txt_actionitem : '',
                        'issue_update_remarks' => $request->txt_updateremark != null ? $request->txt_updateremark : '',
                        'solution_remark' => $request->txt_soluationRemark != null ? $request->txt_soluationRemark : '',
                        'email_to_client' => $client_email,
                        'email_to_trainer' => $trainer_email,
                        'program_rate' => $request->txt_programrate != null ? $request->txt_programrate : '',
                        'LastUpdated_By' => session()->get('user_id'),
						//'Program_Id'=>$request->cmbCourse,
                        'updated_at' => $current_time]);

                return redirect('CourseList')->with('success', "Record Updated Successfully");

            } catch (Exception $e) {

                // return $e->getMessage();

                return view('excaption');

            }


        }


    }


    //this for show update cource

    public function add_cource()
    {

        try {
            $user = DB::table('collage_masters')
                ->select(DB::raw('CONCAT(collage_name, " - ", region , " - ", spoc) as name'),
                    'collage_id as collage_id')
                ->where('collage_masters.Enabled', '=', '0')
				->orderBy('collage_masters.collage_name')
                ->get();

            $skill = DB::table('skill_masters')
                ->select('skill_masters.skill_id', 'skill_masters.skill_name')
                ->where('skill_masters.Enabled', '=', '0')
				->orderBy('skill_masters.skill_name')
                ->get();
			$program = DB::table('Program_Master')
                ->select('Program_Master.Program_Id', 'Program_Master.Program_Name','Company_Program')
                ->where('Program_Master.Enabled', '=', '0')
				->orderBy('Company_Program')
                ->get();

            return view('cource_add')->with(['collages' => $user, 'skill' => $skill,
						'program' => $program]);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }

    /*End Cource*/


    /*start College master*/

    //this for list collage master

    public function get_allcollage()
    {
        try {
            $obj = DB::table('collage_masters')
                ->select('collage_masters.*')
                ->where('collage_masters.Enabled', '=', 0)
                ->get();

            return view('collage_list')->with('collages', $obj);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }
    }

    //this for store collage master

    public function store_collage(Request $request)
    {

        if ($request->txt_collagetype == -1 || $request->txt_collagetype == null) {

            return redirect()->back()->withInput()->with('error', 'College Type Not Selected');

        } /*else if ($request->txt_country == -1 || $request->txt_country == null) {

            return redirect()->back()->withInput()->with('error', 'Country Not Selectd');

        } else if ($request->txt_stateid == -1 || $request->txt_stateid == null) {

            return redirect()->back()->withInput()->with('error', 'State Not Selected');

        } else if ($request->txt_cityid == -1 || $request->txt_cityid == null) {

            return redirect()->back()->withInput()->with('error', 'City Not Selected');

        }*/ else  {

            try {
                $current_time = Carbon::now()->toDateTimeString();


                $obj = DB::table('collage_masters')
                    ->insert(['collage_name' => $request->txt_collagename,
                        'collage_type' => $request->txt_collagetype,
                        'address' => $request->txt_address,
                        'region' => $request->txt_region,
                        'spoc' => $request->txt_spoc,
                        'spoc_designation' => $request->txt_spocdesignation != null ? $request->txt_spocdesignation : '',
                        'contact_number' => $request->txt_contactnumber,
                        'email_address' => $request->txt_email != null ? $request->txt_email : '',
                        'calling_status' => $request->txt_callingsts,
                        'interested' => $request->txt_interested,
                        'recruitment_drive_date' => $request->dt_RecruitmentDriveDate,
                        'country_id' => $request->txt_country,
                        'state_id' => $request->txt_stateid,
                        'city_id' => $request->txt_cityid,
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('CollageList');


            } catch (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }

        }


    }

    //this for destroy collage master

    public function destroy_collage(Request $request)
    {
        try {





            $check_emp = DB::table('employee_masters')
                ->where('collage_id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('employee_masters.*')
                ->count();


            $check_course = DB::table('course_masters')
                ->where('collage_id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('course_masters.*')
                ->count();


            $check_clgbfortraingin = DB::table('college__before__trainings')
                ->where('College_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('college__before__trainings.*')
                ->count();

            $check_clgdurig = DB::table('college__during__trainings')
                ->where('College_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('college__during__trainings.*')
                ->count();

            $check_studentfeedback = DB::table('student_feedback')
                ->where('College_ID', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('student_feedback.*')
                ->count();

            $check_student = DB::table('student_masters')
                ->where('collage_id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('student_masters.*')
                ->count();


            $check_placementdrives = DB::table('placement__drives')
                ->where('College_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('placement__drives.*')
                ->count();


            if ($check_emp > 0) {
                return response()->json(['msg' => 'Employee  for this College is already set. Delete the Employee  first before deleting College', 'status' => 'failed']);

            } else if ($check_course > 0) {
                return response()->json(['msg' => 'Course for this College is already set. Delete the Course first before deleting College', 'status' => 'failed']);

            } else if ($check_clgbfortraingin > 0) {

                return response()->json(['msg' => 'College Before Training for this College is already set. Delete the College Before Training first before deleting College', 'status' => 'failed']);

            } else if ($check_clgdurig > 0) {

                return response()->json(['msg' => 'College During Training for this College is already set. Delete the College During Training first before deleting College', 'status' => 'failed']);

            } else if ($check_studentfeedback > 0) {

                return response()->json(['msg' => 'Student Feedback for this College is already set. Delete the Student Feedback first before deleting College', 'status' => 'failed']);

            } else if ($check_student > 0) {

                return response()->json(['msg' => 'Student for this College is already set. Delete the Student first before deleting College', 'status' => 'failed']);

            } else if ($check_placementdrives > 0) {

                return response()->json(['msg' => 'Placement Drive for this College is already set. Delete the IPlacement Drive first before deleting College', 'status' => 'failed']);

            } else {

                $user = DB::table('collage_masters')->where('collage_id', $request->id)->update(['Enabled' => 1]);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
                }
                // return redirect('DeparmentList')->with('success',"Delete Record Successfully");

            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }

    //this for show update collage master

    public function show_collage($id)
    {
        try {

            $user = DB::table('collage_masters')->
            where('collage_id', '=', $id)
                ->first();


            $obj = DB::table('country_masters')
                ->select('country_masters.country_id', 'country_masters.country_name')
                ->where('country_masters.Enabled', '=', '0')
				->orderBy('country_name')
                ->get();

            $obj1 = DB::table('state_masters')
                ->select('state_masters.state_id', 'state_masters.state_name')
                /*->where('state_masters.country_id', '=', $user->country_id)*/
                ->where('state_masters.Enabled', '=', '0')
				->orderBy('state_name')
                ->get();


            $obj2 = DB::table('city_masters')
                ->select('city_masters.city_id', 'city_masters.city_name')
                /*  ->where('city_masters.state_id', '=', $user->state_id)*/
                ->where('city_masters.Enabled', '=', '0')
				->orderBy('city_name')
                ->get();


            //dd(['collages' => $user, 'countries' => $obj, 'states' => $obj1, 'cities' => $obj2]);
            return view('collage_edit')->with(['collages' => $user, 'countries' => $obj, 'states' => $obj1, 'cities' => $obj2]);

        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }
    }

    //this for edit collage master

    public function edit_collage(Request $request)
    {

        if ($request->txt_collagetype == -1 || $request->txt_collagetype == null) {

            return redirect()->back()->withInput()->with('error', 'College Type Not Selected');

        } else if ($request->txt_country == -1 || $request->txt_country == null) {

            return redirect()->back()->withInput()->with('error', 'Country Not Selectd');

        } else if ($request->txt_stateid == -1 || $request->txt_stateid == null) {

            return redirect()->back()->withInput()->with('error', 'State Not Selected');

        } else if ($request->txt_cityid == -1 || $request->txt_cityid == null) {

            return redirect()->back()->withInput()->with('error', 'City Not Selected');

        } else  {
            try {
                $current_time = Carbon::now()->toDateTimeString();


                $obj = DB::table('collage_masters')
                    ->where('collage_id', $request->txt_collageid)
                    ->update(['collage_name' => $request->txt_collagename,
                        'collage_type' => $request->txt_collagetype,
                        'address' => $request->txt_address,
                        'region' => $request->txt_region,
                        'spoc' => $request->txt_spoc,
                        'spoc_designation' => $request->txt_spocdesignation != null ? $request->txt_spocdesignation : '',
                        'contact_number' => $request->txt_contactnumber,
                        'email_address' => $request->txt_email != null ? $request->txt_email : '',
                        'calling_status' => $request->txt_callingsts,
                        'interested' => $request->txt_interested,
                        'recruitment_drive_date' => $request->dt_RecruitmentDriveDate,
                        'country_id' => $request->txt_country,
                        'state_id' => $request->txt_state,
                        'city_id' => $request->txt_city,
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('CollageList')->with('success', "Record Updated Successfully");


            } catch (Exception $e) {


                //  return $e->getMessage();
                return view('excaption');

            }

        }
    }


    public function AddCollage()
    {

        try {
            $Country = DB::table('country_masters')
                ->select('country_masters.country_id', 'country_masters.country_name')
                ->where('country_masters.Enabled', '=', '0')
				->orderBy('country_name')
                ->get();

            $state = DB::table('state_masters')
                ->select('state_masters.state_id', 'state_masters.state_name')
                ->where('state_masters.Enabled', '=', '0')
				->orderBy('state_name')
                ->get();

            $city = DB::table('city_masters')
                ->select('city_masters.city_id', 'city_masters.city_name')
                ->where('city_masters.Enabled', '=', '0')
				->orderBy('city_name')
                ->get();


            return view('collage_add')->with(['countries' => $Country,
                'states' => $state,
                'citys' => $city]);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }
    }


    /*end collage master*/


    /*start student */

    //this for list student master

    public function get_allstudent()
    {
        try {
            $obj = DB::table('student_masters')
                ->join('collage_masters', 'student_masters.collage_id',
                    '=', 'collage_masters.collage_id')
                ->join('skill_masters', 'student_masters.primary_skill',
                    '=', 'skill_masters.skill_id')
                ->select('student_masters.*', 'collage_masters.collage_name', 'skill_masters.skill_name')
                ->where('student_masters.Enabled', '=', '0')
                ->get();


            return view('student_list')->with('students', $obj);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }

    //this for store student master

    public function store_student(Request $request)
    {
        if ($request->txt_collageid == -1 || $request->txt_collageid == null) {

            return redirect()->back()->withInput()->with('error', 'College Name Not Selectd');

        } else {

            try {
                $current_time = Carbon::now()->toDateTimeString();

                $collages = DB::table('student_masters')
                    ->select('student_masters.registration_number')
                    ->where('student_masters.registration_number', '=', $request->txt_regnumber)
                    ->where('student_masters.Enabled', '=', '0')
                    ->get()->count();

                if ($collages > 0) {

                    return redirect()->back()->withInput()->with('error', 'Registration Number ' . $request->txt_regnumber . ' Already Exist');

                } else {

                    $obj = DB::table('student_masters')
                        ->insert(['collage_id' => $request->txt_collageid,
                            'registration_number' => $request->txt_regnumber,
                            'student_name' => $request->txt_studentname,
                            'student_email' => $request->txt_studentemail != null ? $request->txt_studentemail : '',
                            'branch' => $request->txt_branch,
                            'interview_date' => $request->dt_interviewdate,
                            'primary_skill' => $request->txt_primaryskill,
                            'overall_score' => $request->txt_OverallScore != null ? $request->txt_OverallScore : '',
                            'aptitude_score' => $request->txt_AptituteScore != null ? $request->txt_AptituteScore : '',
                            'logical_reason_score' => $request->txt_LogicalReasoningScore != null ? $request->txt_LogicalReasoningScore : '',
                            'quanititv_aptitude_score' => $request->txt_QuantitativeAptituteScore != null ? $request->txt_QuantitativeAptituteScore : '',
                            'verbal_ability_score' => $request->txt_VerbalAbilityScore != null ? $request->txt_VerbalAbilityScore : '',
                            'technical_mcq_score' => $request->txt_TechnicalMCQSScore != null ? $request->txt_TechnicalMCQSScore : '',
                            'programing_score' => $request->txt_ProgrammingScore != null ? $request->txt_ProgrammingScore : '',
                            'demo_topic' => $request->txt_DemoTopic != null ? $request->txt_DemoTopic : '',
                            'confidance_score' => $request->txt_ConfidanceScore != null ? $request->txt_ConfidanceScore : '',
                            'communication_score' => $request->txt_CommunicationScore != null ? $request->txt_CommunicationScore : '',
                            'presentation_score' => $request->txt_PresentationScore != null ? $request->txt_PresentationScore : '',
                            'clarity_score' => $request->txt_ClarityScore != null ? $request->txt_ClarityScore : '',
                            'creativity_score' => $request->txt_CreativityScore != null ? $request->txt_CreativityScore : '',
                            'demo_status' => $request->txt_DemoStatus != null ? $request->txt_DemoStatus : '',
                            'subject_knowledge' => $request->txt_SubjectKnowledge != null ? $request->txt_SubjectKnowledge : '',
                            'clarity' => $request->txt_Clarity != null ? $request->txt_Clarity : '',
                            'domain_remark' => $request->txt_DomainRemarks != null ? $request->txt_DomainRemarks : '',
                            'domain_status' => $request->txt_DomainStatus != null ? $request->txt_DomainStatus : '',
                            'role_clarity' => $request->txt_RoleClarity != null ? $request->txt_RoleClarity : '',
                            'overall_fitment' => $request->txt_OverallFitment != null ? $request->txt_OverallFitment : '',
                            'final_status' => $request->txt_FinalStatus != null ? $request->txt_FinalStatus : '',
                            'confidence' => $request->txt_Confidence != null ? $request->txt_Confidence : '',
                            'language' => $request->txt_Language != null ? $request->txt_Language : '',
                            'jam_status' => $request->txt_JAMStatus != null ? $request->txt_JAMStatus : '',
                            'Student_Offer_Status' => $request->cb_stdoffsts != null ? $request->cb_stdoffsts : '',
                            'Joining_Mail_Date'=>$request->dt_JoinMailDate,
                            'Joining_Confirmation_Mail_status' => $request->cb_JoinConMailSts != null ? $request->cb_JoinConMailSts : '',
                            'Joining_Confirmation_Mail_Date'=>$request->dt_JoinConMailDate,
                            'Student_Mobile'=>$request->txt_StudentMobileNumber,
                            'Password'=>$request->txt_password,
                            'Created_By' => session()->get('user_id'),
                            'created_at' => $current_time]);


                    return redirect('StudentList');
                }


            } catch (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }

        }


    }

    //this for destroy student master

    public function destroy_student(Request $request)
    {
        try {

            $check_emp_primary = DB::table('student_feedback')
                ->where('Student_ID', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('student_feedback.*')
                ->count();


            if ($check_emp_primary > 0) {
                return response()->json(['msg' => 'Student Feed Back for this Student is already set. Delete the Student Feed Back first before deleting Student', 'status' => 'failed']);

            } else {


                $user = DB::table('student_masters')->where('student_id', $request->id)->update(['Enabled' => 1]);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
                }
                // return redirect('DeparmentList')->with('success',"Delete Record Successfully");
            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }
    }

    //this for show update student master

    public function show_student($id)
    {
        $user = DB::table('student_masters')->where('student_id', '=', $id)->first();

        $collages = DB::table('collage_masters')
            ->select(DB::raw('CONCAT(collage_name, " - ", region , " - ", spoc) as name'),
                'collage_id as collage_id')
            ->where('collage_masters.Enabled', '=', '0')
			->orderBy('collage_name')
            ->get();

        $primaryskill = DB::table('skill_masters')
            ->select('skill_masters.skill_id', 'skill_masters.skill_name')
            ->where('skill_masters.Enabled', '=', '0')
			->orderBy('skill_name')
            ->get();


        return view('student_edit')->with(['students' => $user, 'collages' => $collages, 'priskill' => $primaryskill]);
    }

    //this for edit student master

    public function edit_student(Request $request)
    {

        if ($request->txt_collageid == -1 || $request->txt_collageid == null) {

            return redirect()->back()->withInput()->with('error', 'College Name Not Selectd');

        } else {

            $collages = DB::table('student_masters')
                ->select('student_masters.registration_number')
                ->where('student_masters.registration_number', '=', $request->txt_regnumber)
                ->where('student_masters.Enabled', '=', '0')
                ->where('student_masters.student_id', '<>', $request->txt_studentid)
                ->get()->count();

            if ($collages > 0) {

                return redirect()->back()->with('error', 'Registration Number ' . $request->txt_regnumber . ' Already Exist');

            } else {

                try {
                    $current_time = Carbon::now()->toDateTimeString();


                    $obj = DB::table('student_masters')
                        ->where('student_id', $request->txt_studentid)
                        ->update(['collage_id' => $request->txt_collageid,
                            'registration_number' => $request->txt_regnumber,
                            'student_name' => $request->txt_studentname,
                            'student_email' => $request->txt_studentemail != null ? $request->txt_studentemail : '',
                            'branch' => $request->txt_branch,
                            'interview_date' => $request->dt_interviewdate,
                            'primary_skill' => $request->txt_primaryskill,
                            'overall_score' => $request->txt_OverallScore != null ? $request->txt_OverallScore : '',
                            'aptitude_score' => $request->txt_AptituteScore != null ? $request->txt_AptituteScore : '',
                            'logical_reason_score' => $request->txt_LogicalReasoningScore != null ? $request->txt_LogicalReasoningScore : '',
                            'quanititv_aptitude_score' => $request->txt_QuantitativeAptituteScore != null ? $request->txt_QuantitativeAptituteScore : '',
                            'verbal_ability_score' => $request->txt_VerbalAbilityScore != null ? $request->txt_VerbalAbilityScore : '',
                            'technical_mcq_score' => $request->txt_TechnicalMCQSScore != null ? $request->txt_TechnicalMCQSScore : '',
                            'programing_score' => $request->txt_ProgrammingScore != null ? $request->txt_ProgrammingScore : '',
                            'demo_topic' => $request->txt_DemoTopic != null ? $request->txt_DemoTopic : '',
                            'confidance_score' => $request->txt_ConfidanceScore != null ? $request->txt_ConfidanceScore : '',
                            'communication_score' => $request->txt_CommunicationScore != null ? $request->txt_CommunicationScore : '',
                            'presentation_score' => $request->txt_PresentationScore != null ? $request->txt_PresentationScore : '',
                            'clarity_score' => $request->txt_ClarityScore != null ? $request->txt_ClarityScore : '',
                            'creativity_score' => $request->txt_CreativityScore != null ? $request->txt_CreativityScore : '',
                            'demo_status' => $request->txt_DemoStatus != null ? $request->txt_DemoStatus : '',
                            'subject_knowledge' => $request->txt_SubjectKnowledge != null ? $request->txt_SubjectKnowledge : '',
                            'clarity' => $request->txt_Clarity != null ? $request->txt_Clarity : '',
                            'domain_remark' => $request->txt_DomainRemarks != null ? $request->txt_DomainRemarks : '',
                            'domain_status' => $request->txt_DomainStatus != null ? $request->txt_DomainStatus : '',
                            'role_clarity' => $request->txt_RoleClarity != null ? $request->txt_RoleClarity : '',
                            'overall_fitment' => $request->txt_OverallFitment != null ? $request->txt_OverallFitment : '',
                            'final_status' => $request->txt_FinalStatus != null ? $request->txt_FinalStatus : '',
                            'confidence' => $request->txt_Confidence != null ? $request->txt_Confidence : '',
                            'language' => $request->txt_Language != null ? $request->txt_Language : '',
                            'jam_status' => $request->txt_JAMStatus != null ? $request->txt_JAMStatus : '',
                            'Student_Offer_Status' => $request->cb_stdoffsts != null ? $request->cb_stdoffsts : '',
                            'Joining_Mail_Date'=>$request->dt_JoinMailDate,
                            'Joining_Confirmation_Mail_status' => $request->cb_JoinConMailSts != null ? $request->cb_JoinConMailSts : '',
                            'Joining_Confirmation_Mail_Date'=>$request->dt_JoinConMailDate,
                            'Student_Mobile'=>$request->txt_StudentMobileNumber,
                            'Password'=>$request->txt_password,
                            'LastUpdated_By' => session()->get('user_id'),
                            'updated_at' => $current_time]);


                    return redirect('StudentList')->with('success', 'Record Updated Successfully');


                } catch (Exception $e) {


                    //   return $e->getMessage();

                    return view('excaption');

                }
            }


        }


    }


    public function add_student()
    {

        try {
            $user = DB::table('collage_masters')
                ->select(DB::raw('CONCAT(collage_name, " - ", region , " - ", spoc) as name'),
                    'collage_id as collage_id')
                ->where('collage_masters.Enabled', '=', '0')
				->orderBy('collage_name')
                ->get();

            $primaryskill = DB::table('skill_masters')
                ->select('skill_masters.skill_id', 'skill_masters.skill_name')
                ->where('skill_masters.Enabled', '=', '0')
				->orderBy('skill_name')
                ->get();


            return view('student_add')->with(['collages' => $user, 'primaryskill' => $primaryskill]);

        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }

    }


    /*end student master*/


    /*start employee */

    //this for list employee master

    public function get_allemployee()
    {
        try {
            $obj = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.Emp_Code', 'employee_masters.emp_name',
                    'employee_masters.emp_address1', 'employee_masters.emp_address2', 'employee_masters.mobile_number')
                ->where('employee_masters.Enabled', '=', '0')
                ->get();


            return view('employee_list')->with('employees', $obj);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }
    }

    //this for store employee master

    public function store_employee(Request $request)
    {

        $current_time = Carbon::now()->toDateTimeString();


        if ($request->txt_type == -1 || $request->txt_type == null) {

            return redirect()->back()->withInput()->with('error', 'Type Not Selected');

        } else if ($request->txt_primaryskill == -1 || $request->txt_primaryskill == null) {


            return redirect()->back()->withInput()->with('error', 'Primary Skill Not Selected');

        } else if ($request->txt_primaryskill == $request->txt_secondaryskill) {

            return redirect()->back()->withInput()->with('error', 'Primary Skill And Secondary  Skill Should Not Be Same');

        } else {

            try {

                if ($request->has('chk_accmanager')) {

                    $acmanager = true;

                } else {

                    $acmanager = false;
                }

                $code = DB::table('employee_masters')
                    ->select('employee_masters.Emp_Code')
                    ->where('employee_masters.Emp_Code', '=', $request->txt_empcode)
                    ->where('employee_masters.Enabled', '=', '0')
                    ->get()->count();


                $pan = DB::table('employee_masters')
                    ->select('employee_masters.pan_number')
                    ->where('employee_masters.pan_number', '=', $request->txt_pancardnumber)
                    ->where('employee_masters.Enabled', '=', '0')
                    ->get()->count();

                $aadhar = DB::table('employee_masters')
                    ->select('employee_masters.aadhar_number')
                    ->where('employee_masters.aadhar_number', '=', $request->txt_AadhaarNumber)
                    ->where('employee_masters.Enabled', '=', '0')
                    ->get()->count();

                $paasport = DB::table('employee_masters')
                    ->select('employee_masters.passport_number')
                    ->where('employee_masters.passport_number', '=', $request->txt_PassportNumber)
                    ->where('employee_masters.Enabled', '=', '0')
                    ->get()->count();


                if ($code > 0) {

                    return redirect()->back()->withInput()->with('error', 'Employee Code ' . $request->txt_empcode . ' Already Exist');


                } else if ($pan > 0) {

                    return redirect()->back()->withInput()->with('error', 'Pan Card Number ' . $request->txt_pancardnumber . ' Already Exist Please Enter Anothter');


                } else if ($aadhar > 0) {
                    return redirect()->back()->withInput()->with('error', 'Aadhar Number ' . $request->txt_AadhaarNumber . ' Already Exist Please Enter Anothter');


                } else if ($paasport > 0) {
                    return redirect()->back()->withInput()->with('error', 'Passport Number ' . $request->txt_PassportNumber . ' Already Exist Please Enter Anothter');


                } else {
                    $obj = DB::table('employee_masters')
                        ->insert(['Emp_Code' => $request->txt_empcode,
                            'emp_name' => $request->txt_empname,
                            'type' => $request->txt_type,
                            'collage_name' => $request->txt_collagename != null ? $request->txt_collagename : '',
                            'emp_address1' => $request->txt_Eaddress1,
                            'emp_address2' => $request->txt_Eaddress2 != null ? $request->txt_Eaddress2 : '',
                            'emp_address_pin' => $request->txt_EmpPinNo != null ? $request->txt_EmpPinNo : '',
                            'emp_country' => $request->txt_country,
                            'emp_state' => $request->txt_state,
                            'emp_city' => $request->txt_city,
                            'primary_skill' => $request->txt_primaryskill,
                            'secondary_skill' => $request->txt_secondaryskill,
                            'department_id' => $request->txt_deptid,
                            'organization_id' => $request->txt_orgid,
                            'designation_id' => $request->txt_desigid,
                            'off_email_id' => $request->txt_OffEmailID != null ? $request->txt_OffEmailID : '',
                            'personal_email_id' => $request->txt_PersonalEmailID != null ? $request->txt_PersonalEmailID : '',
                            'production' => $request->txt_Production != null ? $request->txt_Production : '',
                            'gender' => $request->gender,
                            'ifsc_code' => $request->txt_ifscCode != null ? $request->txt_ifscCode : '',
                            'account_number' => $request->txt_AccountNumber != null ? $request->txt_AccountNumber : '',
                            'account_name' => $request->txt_AccountName != null ? $request->txt_AccountName : '',
                            'bank_name' => $request->txt_BankName != null ? $request->txt_BankName : '',
                            'bank_branch' => $request->txt_BankBranch != null ? $request->txt_BankBranch : '',
                            'account_manager' => $acmanager,
                            'contact_number' => $request->txt_contactno != null ? $request->txt_contactno : '',
                            'monthly_memuneration' => $request->txt_MonthlyRemuneration != null ? $request->txt_MonthlyRemuneration : '',
                            'date_of_joining' => $request->dt_doj != null ? $request->dt_doj : null,
                            'date_of_resigning' => $request->dt_dor != null ? $request->dt_dor : null,
                            'last_working_date' => $request->dt_lwd != null ? $request->dt_lwd : null,
                            'date_of_birth' => $request->dt_dob != null ? $request->dt_dob : null,
                            'blood_group' => $request->txt_bloodgrp != null ? $request->txt_bloodgrp : '',
                            'hiring_channel' => $request->txt_HiringChannel != null ? $request->txt_HiringChannel : '',
                            'pan_number' => $request->txt_pancardnumber != null ? $request->txt_pancardnumber : '',
                            'aadhar_number' => $request->txt_AadhaarNumber != null ? $request->txt_AadhaarNumber : '',
                            'passport_number' => $request->txt_PassportNumber != null ? $request->txt_PassportNumber : '',
                            'mobile_number' => $request->txt_MobileNumber != null ? $request->txt_MobileNumber : '',
                            'nationality' => $request->txt_Nationality != null ? $request->txt_Nationality : '',
                            'father_name' => $request->txt_FatherName != null ? $request->txt_FatherName : '',
                            'father_occupation' => $request->txt_FatherOccupation != null ? $request->txt_FatherOccupation : '',
                            'mother_name' => $request->txt_MotherName != null ? $request->txt_MotherName : '',
                            'mother_occupation' => $request->txt_MotherOccupation != null ? $request->txt_MotherOccupation : '',
                            'permanent_address_1' => $request->txt_peradd1 != null ? $request->txt_peradd1 : '',
                            'permanent_address_2' => $request->txt_peradd2 != null ? $request->txt_peradd2 : '',
                            'permanent_address_country' => $request->txt_percountry,
                            'permanent_address_state' => $request->txt_perstate,
                            'permanent_address_city' => $request->txt_percity,
                            'permanent_address_pin' => $request->txt_perpinadd != null ? $request->txt_perpinadd : '',
                            'marital_status' => $request->txt_MaritalStatus != null ? $request->txt_MaritalStatus : '',
                            'emp_contact_no' => $request->txt_Econtactno != null ? $request->txt_Econtactno : '',
                            'emergency_contact_no' => $request->txt_emecontactno != null ? $request->txt_emecontactno : '',
                            'emergency_contact_name' => $request->txt_emecontactname != null ? $request->txt_emecontactname : '',
                            'emergency_contact_relation' => $request->txt_emecontactrel != null ? $request->txt_emecontactrel : '',
                            'total_experiance' => $request->txt_totalexpi != null ? $request->txt_totalexpi : '',
                            'intern_average_score' => $request->txt_internavgscore != null ? $request->txt_internavgscore : '',
                            'Created_By' => session()->get('user_id'),
                            'created_at' => $current_time

                        ]);


                    return redirect('EmployeeList');

                }


            } catch (Exception $e) {


                // return $e->getMessage();

                return view('excaption');

            }

        }


    }

    //this for destroy employee master

    public function destroy_employee(Request $request)
    {
        try {


            $check_emp_exp = DB::table('employee_experinces')
                ->where('Emp_id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('employee_experinces.*')
                ->count();


            $check_emp_qual = DB::table('emp__qualifications')
                ->where('Emp_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('emp__qualifications.*')
                ->count();


            $check_attandance = DB::table('attendances')
                ->where('Emp_id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('attendances.*')
                ->count();

            $check_coursetrasaction = DB::table('course_transactions')
                ->where('Emp_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('course_transactions.*')
                ->count();

            $check_studentfeedback = DB::table('student_feedback')
                ->where('Emp_ID', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('student_feedback.*')
                ->count();

            $check_internemployee = DB::table('intern__evaluations')
                ->where('Emp_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('intern__evaluations.*')
                ->count();


            $check_internfculty = DB::table('intern__evaluations')
                ->where('Faculty_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('intern__evaluations.*')
                ->count();

            $check_internplannedeplyoee = DB::table('intern__planned__schedules')
                ->where('Emp_id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('intern__planned__schedules.*')
                ->count();
            $check_internplannedereview = DB::table('intern__planned__schedules')
                ->where('Review_Emp_ID', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('intern__planned__schedules.*')
                ->count();
            $check_dailyperformance = DB::table('daily__performance__cards')
                ->where('Emp_ID', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('daily__performance__cards.*')
                ->count();


            if ($check_emp_exp > 0) {
                return response()->json(['msg' => 'Employee Experience for this Employee is already set. Delete the Employee Experience first before deleting Employee', 'status' => 'failed']);

            } else if ($check_emp_qual > 0) {
                return response()->json(['msg' => 'Employee Qualification for this Employee is already set. Delete the Employee Qualification first before deleting Employee', 'status' => 'failed']);

            } else if ($check_attandance > 0) {

                return response()->json(['msg' => 'Attendance for this Employee is already set. Delete the Attendance first before deleting Employee', 'status' => 'failed']);

            } else if ($check_coursetrasaction > 0) {

                return response()->json(['msg' => 'Course Transaction for this Employee is already set. Delete the Course Transaction first before deleting Employee', 'status' => 'failed']);

            } else if ($check_studentfeedback > 0) {

                return response()->json(['msg' => 'Student Feedback for this Employee is already set. Delete the Student Feedback first before deleting Employee', 'status' => 'failed']);

            } else if ($check_internemployee > 0) {

                return response()->json(['msg' => 'Intern Evaluation Employee for this Employee is already set. Delete the Intern Evaluation Employee first before deleting Employee', 'status' => 'failed']);

            } else if ($check_internfculty > 0) {

                return response()->json(['msg' => 'Intern Evaluation Faculty for this Employee is already set. Delete the Intern Evaluation Faculty first before deleting Employee', 'status' => 'failed']);

            } else if ($check_internplannedeplyoee > 0) {

                return response()->json(['msg' => 'Intern Planned Schedule Employee for this Employee is already set. Delete the Intern Planned Schedule Employee first before deleting Employee', 'status' => 'failed']);

            } else if ($check_internplannedereview > 0) {

                return response()->json(['msg' => 'Intern Planned Schedule Review Employee for this Employee is already set. Delete the Intern Planned Schedule Review Employee first before deleting Employee', 'status' => 'failed']);

            } else if ($check_dailyperformance > 0) {

                return response()->json(['msg' => 'Daily Performance Card for this Employee is already set. Delete the Daily Performance Card first before deleting Employee', 'status' => 'failed']);

            } else {

                $user = DB::table('employee_masters')->where('emp_id', $request->id)->update(['Enabled' => 1]);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
                }

            }


            // return redirect('DeparmentList')->with('success',"Delete Record Successfully");


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }

    //this for show update employee master

    public function show_employee($id)
    {

        $user = DB::table('employee_masters')->where('emp_id', '=', $id)->first();


        $obj = DB::table('country_masters')
            ->select('country_masters.country_id', 'country_masters.country_name')
            ->where('country_masters.Enabled', '=', '0')
			->orderBy('country_name')
            ->get();

        $emp_state = DB::table('state_masters')
            ->select('state_masters.state_id', 'state_masters.state_name')
            ->where('state_masters.country_id', '=', $user->emp_country)
            ->where('state_masters.Enabled', '=', '0')
			->orderBy('state_name')
            ->get();


        $emp_city = DB::table('city_masters')
            ->select('city_masters.city_id', 'city_masters.city_name')
            ->where('city_masters.state_id', '=', $user->emp_state)
            ->where('city_masters.Enabled', '=', '0')
			->orderBy('city_name')
            ->get();


        $per_state = DB::table('state_masters')
            ->select('state_masters.state_id', 'state_masters.state_name')
            ->where('state_masters.country_id', '=', $user->permanent_address_country)
            ->where('state_masters.Enabled', '=', '0')
			->orderBy('state_name')
            ->get();


        $per_city = DB::table('city_masters')
            ->select('city_masters.city_id', 'city_masters.city_name')
            ->where('city_masters.state_id', '=', $user->permanent_address_state)
            ->where('city_masters.Enabled', '=', '0')
			->orderBy('city_name')
            ->get();




        $organization = DB::table('organization_masters')
            ->select('organization_masters.organization_id', 'organization_masters.organization_name')
            ->where('organization_masters.Enabled', '=', '0')
			->orderBy('organization_name')
            ->get();


        $deparments = DB::table('department_masters')
            ->select('department_masters.department_id', 'department_masters.department_name')
            ->where('department_masters.Enabled', '=', '0')
			->orderBy('department_masters.department_name')
            ->get();


        $designations = DB::table('designation_masters')
            ->select('designation_masters.designation_id', 'designation_masters.designation_name')
            ->where('designation_masters.Enabled', '=', '0')
			->orderBy('designation_masters.designation_name')
            ->get();

        $type = DB::table('type_masters')
            ->select('type_masters.type_id', 'type_masters.type_desc')
            ->where('type_masters.Enabled', '=', '0')
			->orderBy('type_masters.type_desc')
            ->get();

        $primaryskill = DB::table('skill_masters')
            ->select('skill_masters.skill_id', 'skill_masters.skill_name')
            ->where('skill_masters.Enabled', '=', '0')
			->orderBy('skill_masters.skill_name')
            ->get();

        $secondaryskill = DB::table('skill_masters')
            ->select('skill_masters.skill_id', 'skill_masters.skill_name')
            ->where('skill_masters.Enabled', '=', '0')
			->orderBy('skill_name')
            ->get();


        return view('employee_edit')->with(['employee' => $user,
            'countries' => $obj,
            'states' => $emp_state,
            'cities' => $emp_city,
            'per_states' => $per_state,
            'per_cities' => $per_city,
            'oraganizations' => $organization,
            'departments' => $deparments,
            'designations' => $designations,
            'type' => $type,
            'priskills' => $primaryskill,
            'secskill' => $secondaryskill
        ]);
    }

    //this for edit employee master

    public function edit_employee(Request $request)
    {

        $current_time = Carbon::now()->toDateTimeString();
        /*

         $today=Carbon::now()->toDateTimeString('m-d-Y');

         $to=Carbon::parse($request->dt_dob);




         if($to >= $today){

             return redirect()->back()->with('error', 'Please Select Valid Birthdate');
         }*/


        if ($request->txt_type == -1 || $request->txt_type == null) {

            return redirect()->back()->with('error', 'Type Not Selectd');

        } else if ($request->txt_primaryskill == -1 || $request->txt_primaryskill == null) {

            return redirect()->back()->with('error', 'Primary Skill Not Selected');

        } else if ($request->txt_primaryskill == $request->txt_secondaryskill) {

            return redirect()->back()->with('error', 'Primary Skill And Secondary  Skill Should Not Be Same');

        } else {

            try {
                if ($request->has('chk_accmanager')) {

                    $acmanager = true;

                } else {

                    $acmanager = false;
                }

                $code = DB::table('employee_masters')
                    ->select('employee_masters.Emp_Code')
                    ->where('employee_masters.Emp_Code', '=', $request->txt_empcode)
                    ->where('employee_masters.emp_id', '<>', $request->txt_empid)
                    ->where('employee_masters.Enabled', '=', '0')
                    ->get()->count();


                $pan = DB::table('employee_masters')
                    ->select('employee_masters.pan_number')
                    ->where('employee_masters.pan_number', '=', $request->txt_pancardnumber)
                    ->where('employee_masters.emp_id', '<>', $request->txt_empid)
                    ->where('employee_masters.Enabled', '=', '0')
                    ->get()->count();

                $aadhar = DB::table('employee_masters')
                    ->select('employee_masters.aadhar_number')
                    ->where('employee_masters.aadhar_number', '=', $request->txt_AadhaarNumber)
                    ->where('employee_masters.emp_id', '<>', $request->txt_empid)
                    ->where('employee_masters.Enabled', '=', '0')
                    ->get()->count();

                $paasport = DB::table('employee_masters')
                    ->select('employee_masters.passport_number')
                    ->where('employee_masters.passport_number', '=', $request->txt_PassportNumber)
                    ->where('employee_masters.emp_id', '<>', $request->txt_empid)
                    ->where('employee_masters.Enabled', '=', '0')
                    ->get()->count();


                if ($code > 0) {

                    return redirect()->back()->with('error', 'Employee Code ' . $request->txt_empcode . ' Assign Another Employee');

                } else if ($pan > 0) {

                    return redirect()->back()->with('error', 'Pan Card Number ' . $request->txt_pancardnumber . ' Already Exist Please Enter Anothter');


                } else if ($aadhar > 0) {
                    return redirect()->back()->with('error', 'Aadhar Number ' . $request->txt_AadhaarNumber . ' Already Exist Please Enter Anothter');


                } else if ($paasport > 0) {
                    return redirect()->back()->with('error', 'Passport Number ' . $request->txt_PassportNumber . ' Already Exist Please Enter Anothter');


                } else {

                    $obj = DB::table('employee_masters')
                        ->where('emp_id', $request->txt_empid)
                        ->update(['Emp_Code' => $request->txt_empcode,
                            'emp_name' => $request->txt_empname,
                            'type' => $request->txt_type,
                            'collage_name' => $request->txt_collagename != null ? $request->txt_collagename : '',
                            'emp_address1' => $request->txt_Eaddress1,
                            'emp_address2' => $request->txt_Eaddress2 != null ? $request->txt_Eaddress2 : '',
                            'emp_address_pin' => $request->txt_EmpPinNo != null ? $request->txt_EmpPinNo : '',
                            'emp_country' => $request->txt_country,
                            'emp_state' => $request->txt_state,
                            'emp_city' => $request->txt_city,
                            'primary_skill' => $request->txt_primaryskill,
                            'secondary_skill' => $request->txt_secondaryskill,
                            'department_id' => $request->txt_deptid,
                            'organization_id' => $request->txt_orgid,
                            'designation_id' => $request->txt_desigid,
                            'off_email_id' => $request->txt_OffEmailID != null ? $request->txt_OffEmailID : '',
                            'personal_email_id' => $request->txt_PersonalEmailID != null ? $request->txt_PersonalEmailID : '',
                            'production' => $request->txt_Production != null ? $request->txt_Production : '',
                            'gender' => $request->gender,
                            'ifsc_code' => $request->txt_ifscCode != null ? $request->txt_ifscCode : '',
                            'account_number' => $request->txt_AccountNumber != null ? $request->txt_AccountNumber : '',
                            'account_name' => $request->txt_AccountName != null ? $request->txt_AccountName : '',
                            'bank_name' => $request->txt_BankName != null ? $request->txt_BankName : '',
                            'bank_branch' => $request->txt_BankBranch != null ? $request->txt_BankBranch : '',
                            'account_manager' => $acmanager,
                            'contact_number' => $request->txt_contactno != null ? $request->txt_contactno : '',
                            'monthly_memuneration' => $request->txt_MonthlyRemuneration != null ? $request->txt_MonthlyRemuneration : '',
                            'date_of_joining' => $request->dt_doj != null ? $request->dt_doj : null,
                            'date_of_resigning' => $request->dt_dor != null ? $request->dt_dor : null,
                            'last_working_date' => $request->dt_lwd != null ? $request->dt_lwd : null,
                            'date_of_birth' => $request->dt_dob != null ? $request->dt_dob : null,
                            'blood_group' => $request->txt_bloodgrp != null ? $request->txt_bloodgrp : '',
                            'hiring_channel' => $request->txt_HiringChannel != null ? $request->txt_HiringChannel : '',
                            'pan_number' => $request->txt_pancardnumber != null ? $request->txt_pancardnumber : '',
                            'aadhar_number' => $request->txt_AadhaarNumber != null ? $request->txt_AadhaarNumber : '',
                            'passport_number' => $request->txt_PassportNumber != null ? $request->txt_PassportNumber : '',
                            'mobile_number' => $request->txt_MobileNumber != null ? $request->txt_MobileNumber : '',
                            'nationality' => $request->txt_Nationality != null ? $request->txt_Nationality : '',
                            'father_name' => $request->txt_FatherName != null ? $request->txt_FatherName : '',
                            'father_occupation' => $request->txt_FatherOccupation != null ? $request->txt_FatherOccupation : '',
                            'mother_name' => $request->txt_MotherName != null ? $request->txt_MotherName : '',
                            'mother_occupation' => $request->txt_MotherOccupation != null ? $request->txt_MotherOccupation : '',
                            'permanent_address_1' => $request->txt_peradd1 != null ? $request->txt_peradd1 : '',
                            'permanent_address_2' => $request->txt_peradd2 != null ? $request->txt_peradd2 : '',
                            'permanent_address_country' => $request->txt_percountry,
                            'permanent_address_state' => $request->txt_perstate,
                            'permanent_address_city' => $request->txt_percity,
                            'permanent_address_pin' => $request->txt_perpinadd != null ? $request->txt_perpinadd : '',
                            'marital_status' => $request->txt_MaritalStatus != null ? $request->txt_MaritalStatus : '',
                            'emp_contact_no' => $request->txt_Econtactno != null ? $request->txt_Econtactno : '',
                            'emergency_contact_no' => $request->txt_emecontactno != null ? $request->txt_emecontactno : '',
                            'emergency_contact_name' => $request->txt_emecontactname != null ? $request->txt_emecontactname : '',
                            'emergency_contact_relation' => $request->txt_emecontactrel != null ? $request->txt_emecontactrel : '',
                            'total_experiance' => $request->txt_totalexpi != null ? $request->txt_totalexpi : '',
                            'intern_average_score' => $request->txt_internavgscore != null ? $request->txt_internavgscore : '',
                            'LastUpdated_By' => session()->get('user_id'),
                            'updated_at' => $current_time]);


                    return redirect('EmployeeList')->with('success', "Record Updated Successfully");


                }


            } catch (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }

        }


    }


    public function add_employee()
    {

        try {


            $country = DB::table('country_masters')
                ->select('country_masters.country_id', 'country_masters.country_name')
                ->where('country_masters.Enabled', '=', '0')
				->orderBy('country_name')
                ->get();

            $state = DB::table('state_masters')
                ->select('state_masters.state_id', 'state_masters.state_name')
                ->where('state_masters.Enabled', '=', '0')
				->orderBy('state_name')
                ->get();

            $city = DB::table('city_masters')
                ->select('city_masters.city_id', 'city_masters.city_name')
                ->where('city_masters.Enabled', '=', '0')
				->orderBy('city_name')
                ->get();


            $organization = DB::table('organization_masters')
                ->select('organization_masters.organization_id', 'organization_masters.organization_name')
                ->where('organization_masters.Enabled', '=', '0')
				->orderBy('organization_name')
                ->get();


            $deparments = DB::table('department_masters')
                ->select('department_masters.department_id', 'department_masters.department_name')
                ->where('department_masters.Enabled', '=', '0')
				->orderBy('department_name')
                ->get();


            $designations = DB::table('designation_masters')
                ->select('designation_masters.designation_id', 'designation_masters.designation_name')
                ->where('designation_masters.Enabled', '=', '0')
				->orderBy('designation_name')
                ->get();

            $type = DB::table('type_masters')
                ->select('type_masters.type_id', 'type_masters.type_desc')
                ->where('type_masters.Enabled', '=', '0')
				->orderBy('type_desc')
                ->get();

            $skill = DB::table('skill_masters')
                ->select('skill_masters.skill_id', 'skill_masters.skill_name')
                ->where('skill_masters.Enabled', '=', '0')
				->orderBy('skill_name')
                ->get();

            $skill1 = DB::table('skill_masters')
                ->select('skill_masters.skill_id', 'skill_masters.skill_name')
                ->where('skill_masters.Enabled', '=', '0')
				->orderBy('skill_name')
                ->get();


            return view('employee_add')->with([
                'countries' => $country,
                'states' => $state,
                'cities' => $city,
                'oraganizations' => $organization,
                'departments' => $deparments,
                'designations' => $designations,
                'type' => $type,
                'primaryskill' => $skill,
                'secondoryskill' => $skill1
            ]);

        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }

    }

    /*end employee master*/


    /*start employee experience*/
    //this for list employee Experience

    public function get_allemployeeExp()
    {

        $empexp = DB::table('employee_experinces')
            ->join('employee_masters', 'employee_masters.emp_id', '=',
                'employee_experinces.Emp_id')
            ->select('employee_experinces.*', 'employee_masters.emp_name')
            ->where('employee_experinces.Enabled', '=', 0)->get();
        return view('employee_experience_list')->with('empexp', $empexp);


    }


    //this for destroy employee experience

    public function destroy_employeeExp(Request $request)
    {


        try {

            $empexp = DB::table('employee_experinces')->where('id', $request->id)->update(['Enabled' => 1]);

            if ($empexp) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);

            }


        } catch (Exception $e) {


            return view('excaption');


        }

    }




    //this for destroy Qualification language

    public function destroy_quali_lang(Request $request)
    {
        try {

            $qualang = DB::table('quali_lang_masters')->
            where('Qualification_Id', '=', $request->id)->update(['Enabled' => 1]);

            if ($qualang) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }


        } catch (Exception $e) {


            return view('excaption');

        }

    }

    //this for show update Qualification language

    public function show_quali_lang($id)
    {
        try {

            $qualang = DB::table('quali_lang_masters')->where('Qualification_Id', '=', $id)->first();


            return view('qualification_Lang_edit')->with(['QuaLangu' => $qualang]);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }



    //this for list role master

    public function get_allrole()
    {
        try {


            $role = DB::table('role_masters')->
            where('Enabled', '=', 0)->get();

            return view('role_list')->with('roles', $role);


        } catch (Exception $e) {


            return view('excaption');

        }
    }


    //this for destroy role master

    public function destroy_role(Request $request)
    {
        try {

            $check_emp_primary = DB::table('user__roles')
                ->where('Role_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('user__roles.*')
                ->count();


            $check_emp_second = DB::table('role__allocations')
                ->where('Role_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('role__allocations.*')
                ->count();


            if ($check_emp_primary > 0) {
                return response()->json(['msg' => 'User Role for this Role is already set. Delete the User Role first before deleting Role', 'status' => 'failed']);

            } else if ($check_emp_second > 0) {
                return response()->json(['msg' => 'Role Allocation for this Role is already set. Delete the Role Allocation first before deleting Role', 'status' => 'failed']);

            } else {

                $user = DB::table('role_masters')->where('Role_Id', $request->id)->update(['Enabled' => 1]);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
                }

            }


        } catch (Exception $e) {

            return view('excaption');

        }
    }

    //this for show update role master

    public function show_role($id)
    {
        try {
            $role = DB::table('role_masters')->where('Role_Id', '=', $id)->first();


            return view('role_edit')->with(['roless' => $role]);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }



    //list all login master

    public function get_alllogin()
    {
        try {

            $user = DB::table('login_masters')->where('Enabled', '=', 0)->get();

            return view('login_list')->with('users', $user);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }


    //this for destroy  login master

    public function destroy_login(Request $request)
    {
        try {
            $check_emp_primary = DB::table('user__roles')
                ->where('User_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('user__roles.*')
                ->count();


            if ($check_emp_primary > 0) {

                return response()->json(['msg' => 'User Role for this User is already set. Delete the User Role first before deleting User', 'status' => 'failed']);

            } else {

                $user = DB::table('login_masters')->where('UserId', $request->id)->update(['Enabled' => 1]);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
                }
            }


        } catch (Exception $e) {

            return view('excaption');

        }

    }

    //this for show update  login master

    public function show_login($id)
    {
        try {
            $user = DB::table('login_masters')->where('UserId', '=', $id)->first();


            return view('login_edit')->with(['userss' => $user]);

        } catch (Exception $e) {


            return view('excaption');

        }
    }


    /*end login master*/

    /*start sub topic master*/

    //this for list sub topic master


    public function get_allsub_topic()
    {
        try {
            $subtopism = DB::table('sub__topic_masters')
                ->join('topic_masters', 'topic_masters.topic_id', '=',
                    'sub__topic_masters.Topic_Id')
                ->join('skill_masters','skill_masters.skill_id','=','sub__topic_masters.Skill_ID')
                ->select('sub__topic_masters.*', 'topic_masters.topic_description as topic_desc','skill_masters.skill_name')
                ->where('sub__topic_masters.Enabled', '=', '0')
                ->get();


            return view('sub_topic_list')->with('subtopic', $subtopism);


        } catch (Exception $e) {


            return view('excaption');

        }

    }




//this for store sub topic master

    public function store_sub_topic(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        if ($request->txt_topicid == -1) {

            return redirect()->back()->withInput()->with('error', 'Topic Name Not Selected');


        }  else if ($request->txt_skillname == -1 || $request->txt_skillname == null) {

            return redirect()->back()->withInput()->with('error', 'Skill Not Selected');

        } else {

            try {

                $obj = DB::table('sub__topic_masters')
                    ->insert(['Skill_ID' => $request->txt_skillname,
                        'Topic_Id' => $request->txt_topicid,
                        'Topic_Description' => $request->txt_topicdec,
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('SubTopicList');


            } catch (Exception $e) {


                return view('excaption');

            }
        }

    }


    public function get_topicid()
    {
        try {

            $obj = DB::table('topic_masters')
                ->select('topic_masters.topic_id', 'topic_masters.topic_description')
                ->where('topic_masters.Enabled', '=', '0')
				->orderBy('topic_description')
                ->get();

            $obj1 = DB::table('skill_masters')
                ->select('skill_masters.skill_id', 'skill_masters.skill_name')
                ->where('skill_masters.Enabled', '=', '0')
				->orderBy('skill_name')
                ->get();

            return view('sub_topic_add')->with(['topicss'=> $obj,'skill'=> $obj1]);

        } catch (Exception $e) {

            return view('excaption');

        }

    }

    //this for destroy  sub topic master

    public function destroy_sub_topic(Request $request)
    {
        try {


            $check_emp_primary = DB::table('topic_evaluation_masters')
                ->where('Sub_Topic_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('topic_evaluation_masters.*')
                ->count();


            $check_emp_second = DB::table('intern__planned__schedules')
                ->where('Sub_Topic_ID', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('intern__planned__schedules.*')
                ->count();


            if ($check_emp_primary > 0) {


                return response()->json(['msg' => 'Topic Evaluation for this Sub Topic is already set. Delete the Topic Evaluation first before deleting Sub Topic', 'status' => 'failed']);

            } else if ($check_emp_second > 0) {

                return response()->json(['msg' => 'Intern Planned Schedule for this Sub Topic  is already set. Delete the Intern Planned Schedule first before deleting Sub Topic', 'status' => 'failed']);

            } else {


                $user = DB::table('sub__topic_masters')->where('Sub_Topic_Id', $request->id)
                    ->update(['Enabled' => 1]);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
                }

            }


            // return redirect('DeparmentList')->with('success',"Delete Record Successfully");


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }
    }

    //this for show update sub topic master

    public function show_sub_topic($id)
    {
        try {

            $user = DB::table('sub__topic_masters')->where('Sub_Topic_Id', '=', $id)->first();


            $topics = DB::table('topic_masters')
                ->select('topic_masters.topic_id', 'topic_masters.topic_description')
                ->where('topic_masters.Enabled', '=', '0')
				->orderBy('topic_description')
                ->get();

            $skill = DB::table('skill_masters')
                ->select('skill_masters.skill_id', 'skill_masters.skill_name')
                ->where('skill_masters.Enabled', '=', '0')
				->orderBy('skill_name')
                ->get();


            return view('sub_topic_edit')->with(['subtopicc' => $user, 'topic' => $topics,'skilll'=>$skill]);

        } catch (Exception $e) {

            //return $e->getMessage();


            return view('excaption');

        }

    }

    //this for edit sub topic master

    public function edit_sub_topic(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        /*if ($request->txt_topicid == -1) {


            return redirect()->back()->withInput()->with('error', 'Topic Name Not Selected');

        }  else if ($request->txt_skillname == -1 || $request->txt_skillname == null) {

            return redirect()->back()->withInput()->with('error', 'Skill Not Selected');

        } else {
*/
            try {
                $user = DB::table('sub__topic_masters')
                    ->where('Sub_Topic_Id', '=', $request->txt_id)
                    ->update([//'Skill_ID' => $request->txt_skillname,
                        //'Topic_Id' => $request->txt_topicid,
                        'Topic_Description' => $request->txt_topicdec,
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('SubTopicList')->with('success', "Record Updated Successfully");

            } catch (Exception $e) {


                // return $e->getMessage();

                return view('excaption');

            }
  //      }
    }
    /*end sub topic master*/


    /*start topic evaluation master*/

    public function get_alltopic_evaluation()
    {
        try {
            $tvm = DB::table('topic_evaluation_masters')
                ->join('topic_masters', 'topic_masters.topic_id',
                    '=', 'topic_evaluation_masters.Topic_Id')
                ->join('sub__topic_masters', 'sub__topic_masters.Sub_Topic_Id',
                    '=', 'topic_evaluation_masters.Sub_Topic_Id')
                ->join('skill_masters','skill_masters.skill_id',
                    '=','topic_evaluation_masters.Skill_ID')
                ->select('topic_evaluation_masters.*', 'topic_masters.topic_description',
                    'sub__topic_masters.Topic_Description','skill_masters.skill_name')
                ->where('topic_evaluation_masters.Enabled', '=', 0)
                ->get();

            return view('topic_evaluation_list')->with('topeval', $tvm);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }

    //this for store topic evaluation master

    public function store_topic_evaluation(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_topicid == -1 || $request->txt_topicid == null) {

            return redirect()->back()->withInput()->with('error', 'Topic Not Selectd');

        } else if ($request->txt_subtopicid == -1 || $request->txt_subtopicid == null) {

            return redirect()->back()->withInput()->with('error', 'Sub Topic Not Selected');

        } else if ($request->txt_skillname == -1 || $request->txt_skillname == null) {

            return redirect()->back()->withInput()->with('error', 'Skill Not Selected');

        }else if ($request->txt_topicid == $request->txt_subtopicid) {

            return redirect()->back()->withInput()->with('error', 'Topic And Sub Topic Sholud Not Be same');

        }else {
            try {


                $obj = DB::table('topic_evaluation_masters')
                    ->insert([
                        'Clearing_percentage'=>$request->txt_clrpercentage,
                        'Skill_ID' => $request->txt_skillname,
                        'Topic_Id' => $request->txt_topicid,
                        'Sub_Topic_Id' => $request->txt_subtopicid,
                        'Evaluation_Description' => $request->txt_evaludec,
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('TopicEvaluList');


            } catch (Exception $e) {


                //  return $e->getMessage();

                return view('excaption');

            }

        }

    }

    public function get_TopicIDForTopicEval()
    {
        try {
            $obj = DB::table('topic_masters')
                ->select('topic_masters.topic_id', 'topic_masters.topic_description')
                ->where('topic_masters.Enabled', '=', '0')
				->orderBy('topic_description')
                ->get();

            $obj1 = DB::table('sub__topic_masters')
                ->select('sub__topic_masters.Sub_Topic_Id', 'sub__topic_masters.Topic_Description')
                ->where('sub__topic_masters.Enabled', '=', '0')
                ->orderBy('topic_description')
				->get();

            $obj2 = DB::table('skill_masters')
                ->select('skill_masters.skill_id', 'skill_masters.skill_name')
                ->where('skill_masters.Enabled', '=', '0')
				->orderBy('skill_name')
                ->get();


            return view('topic_evaluation_add')->with(['topicss' => $obj,
                'subtopiccc' => $obj1,
                'skill'=>$obj2,
            ]);


        } catch (Exception $e) {

            return view('excaption');

        }

    }

    //this for destroy topic evaluation master

    public function destroy_topic_evaluation(Request $request)
    {
        try {

            $check_emp_primary = DB::table('intern__planned__schedules')
                ->where('Topic_Eval_ID', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('intern__planned__schedules.*')
                ->count();


            $check_emp_second = DB::table('daily__performance__cards')
                ->where('Topic_Eval_ID', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('daily__performance__cards.*')
                ->count();

            $topicevaluation_for_Session_Batch_Mapping = DB::table('Session_Batch_Mapping')
                ->where('Topic_Eval_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('Session_Batch_Mapping.*')
                ->count();


            if ($check_emp_primary > 0) {
                return response()->json(['msg' => 'Intern Planned Schedule for this Topic Evaluation is already set. Delete the Intern Planned Schedule first before deleting Topic Evaluation ', 'status' => 'failed']);

            } else if ($check_emp_second > 0) {
                return response()->json(['msg' => 'Daily Performance Card for this Topic Evaluation is already set. Delete the Daily Performance Card first before deleting Topic Evaluation ', 'status' => 'failed']);

            } else if ($topicevaluation_for_Session_Batch_Mapping > 0) {

                return response()->json(['msg' => 'Session Batch Mapping for this Topic Evaluation is already set. Delete the course Batch mappings first before deleting Topic Evaluation', 'status' => 'failed']);

            }else {

                $user = DB::table('topic_evaluation_masters')
                    ->where('Topic_Eval_Id', $request->id)
                    ->update(['Enabled' => 1]);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
                }


            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }
    }

    //this for show update topic evaluation master

    public function show_topic_evaluation($id)
    {
        try {

            $user = DB::table('topic_evaluation_masters')->where('Topic_Eval_Id', '=', $id)->first();

            $obj1 = DB::table('topic_masters')
                ->select('topic_masters.topic_id', 'topic_masters.topic_description')
                ->where('topic_masters.Enabled', '=', '0')
				->orderBy('topic_description')
                ->get();


            $obj2 = DB::table('sub__topic_masters')
                ->select('sub__topic_masters.Sub_Topic_Id', 'sub__topic_masters.Topic_Description')
                ->where('sub__topic_masters.Enabled', '=', '0')
                ->orderBy('topic_description')
				->get();

            $obj3 = DB::table('skill_masters')
                ->select('skill_masters.skill_id', 'skill_masters.skill_name')
                ->where('skill_masters.Enabled', '=', '0')
                ->orderBy('skill_name')
				->get();





            return view('topic_evaluation_edit')->with([
                'TopicEval' => $user,
                'Topic' => $obj1,
                'SubTopic' => $obj2,
                'skill'=>$obj3,
            ]);


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }
    }

    //this for edit topic evaluation master

    public function edit_topic_evaluation(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        /*if ($request->txt_topicid == -1 || $request->txt_topicid == null) {

            return redirect()->back()->with('error', 'Topic Name Not Selected');

        } else if ($request->txt_subtopicid == -1 || $request->txt_subtopicid == null) {

            return redirect()->back()->with('error', 'Sub Topic Name Not Selected');

        }  else if ($request->txt_skillname == -1 || $request->txt_skillname == null) {

            return redirect()->back()->withInput()->with('error', 'Skill Not Selected');

        }else if ($request->txt_topicid == $request->txt_subtopicid) {

            return redirect()->back()->withInput()->with('error',
                'Topic And Sub Topic Sholud Not Be same');

        }else {*/
            try {

                /* $user = DB::table('topic_evaluation_masters')
                     ->select('Topic_Eval_Id')->where('Topic_Eval_Id',
                     '=', $request->txt_evaID)->first();*/


                $obj = DB::table('topic_evaluation_masters')
                    ->where('Topic_Eval_Id', $request->txt_evaID)
                    ->update([
                        'Clearing_percentage'=>$request->txt_clrpercentage,
                        //'Skill_ID' => $request->txt_skillname,
                        //'Topic_Id' => $request->txt_topicid,
                        //'Sub_Topic_Id' => $request->txt_subtopicid,
                        'Evaluation_Description' => $request->txt_evaludec,
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('TopicEvaluList')
                    ->with('success', "Record Successfully Updated");


            } catch (Exception $e) {


                //  return $e->getMessage();

                return view('excaption');

            }

        //}
    }

    /*end topic evaluation master*/

    /*start placement drive*/

    public function get_allplacement_drive()
    {
        try {
            $placemntdrive = DB::table('placement__drives')
                ->join('collage_masters', 'collage_masters.collage_id', '=',
                    'placement__drives.College_Id')
                ->select('placement__drives.*', 'collage_masters.collage_name')
                ->where('placement__drives.Enabled', '=', '0')
                ->get();

            return view('placement_drive_list')->with('plcmntdrive', $placemntdrive);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }


    //this for destroy placement drive

    public function destroy_placement_drive(Request $request)
    {
        try {

            $user = DB::table('placement__drives')->where('Placement_Drive_Id',
                '=', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }






    /*end placement drive*/


    /*start collage before training*/

    public function get_allclg_before_training()
    {
        try {
            $clgb4training = DB::table('college__before__trainings')
                ->join('collage_masters', 'collage_masters.collage_id',
                    '=', 'college__before__trainings.College_Id')
                ->join('course_masters','course_masters.course_id','=',
                    'college__before__trainings.Course_Id')
                ->join('Program_Master','Program_Master.Program_Id' , '=' , 'course_masters.Program_Id')
                ->select('college__before__trainings.*', 'collage_masters.collage_name',
                    //'course_masters.company_program',
                    'Program_Master.Program_Name')
                ->where('college__before__trainings.Enabled', '=', 0)
                ->get();



               /* $clgb4training = DB::table('college__before__trainings')
                ->join('collage_masters', 'college__before__trainings.College_Id',
                    '=', 'collage_masters.collage_id')
                ->join('course_masters','college__before__trainings.Programm_Details','=',
                    'course_masters.course_id')
                ->join('Program_Master','college__before__trainings.Course_Id' , '=' , 'Program_Master.Course_Id')
                ->select('college__before__trainings.Collage_Before_Training_ID', 'collage_masters.collage_name',
                    'course_masters.company_program',
                    'Program_Master.Program_Name')
                ->where('college__before__trainings.Enabled', '=', 0)
                ->get();*/




            return view('collage_before_training_list')->with('clgbfrtrain', $clgb4training);


        } catch (Exception $e) {


             return $e->getMessage();

          //  return view('excaption');

        }

    }

    //this for store collage before training

    public function store_clg_before_training(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_collageid == -1 || $request->txt_collageid == null) {

            return redirect()->back()->withInput()->with('error', 'College Name Not Selected');


        } else {
            try {
                $start_date = trim($request->dt_tsd);
                $end_date = trim($request->dt_ted);


                $chkEmp = DB::table('college__before__trainings')

                    ->where('college__before__trainings.Programm_Details','=' ,'$request->txt_prdetails')
                    ->where('college__before__trainings.College_Id','=','$request->txt_collageid')
                    ->where(function ($query) use ($start_date, $end_date){
                        $query->whereBetween('college__before__trainings.Training_Start_Date', [$start_date, $end_date])
                            ->orWhereBetween('college__before__trainings.Training_End_Date',[$start_date,$end_date])
                            ->orWhere(function ($query) use ($start_date, $end_date) {
                                return $query->where('college__before__trainings.Training_Start_Date', '>=', $start_date)
                                    ->where('college__before__trainings.Training_End_Date', '=<', $end_date);
                            });
                    })
                    ->get()->count();

                if($chkEmp >= 1)
                {
                    return redirect()->back()->with('error', 'Same Program for the same college is already set for given Duration. Kindly recheck the entry.');
                }
                $obj = DB::table('college__before__trainings')
                    ->insert(['College_Id' => $request->txt_collageid,
                        'Course_Id'=>$request->cmb_program,
                        'Programm_Details' => $request->txt_prdetails,
                        'Recruitment_Drive_Date' => $request->dt_rdd,
                        'Training_Start_Date' => $request->dt_tsd,
                        'Training_End_Date' => $request->dt_ted,
                        'Communication_With_College' => $request->txt_commwithclg,
                        'Trainers_Breifing' => $request->txt_trainbrif,
                        'Travel' => $request->txt_Travel,
                        'Accomodation' => $request->txt_Accomodation,
                        'Reimbursement_Advance' => $request->txt_ReimAdv,
                        'Session_Timings' => $request->txt_sestime,
                        'test_timing'=>$request->txt_testime,
                        'Data_From_College' => $request->txt_datafromclg,
                        'Student_Engagement' => $request->txt_StuEnga,
                        'Student_Responded' => $request->txt_StuRes,
                        'FeedbackFromTraineer' => $request->txt_FeedBkFromTrainer,
                        'IssueRaised' => $request->txt_issueraised != null ? $request-> txt_issueraised : '',
                        'FeedbackFromEM' => $request->txt_FeedBkFromEmp != null ? $request-> txt_FeedBkFromEmp : '',
                        'IssueRaised_EM' => $request->txt_issueraisedEm != null ? $request->txt_issueraisedEm : '',
                        'Student_Categorization' => $request->txt_StudentCategorization,
                        'FinalReportToTPO' => $request->txt_FinalReportToTPO,
                        'FeedbackFromTPO' => $request->txt_FeedbackFromTPO,
                        'IssueRaised_TPO' => $request->txt_issueraisedTPO != null ? $request->txt_issueraisedTPO : '',
                        'FinalCallWithTPO' => $request->txt_FinalCallWithTPO,
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('ClgB4TraingList');


            } catch (Exception $e) {


                return $e->getMessage();

                //return view('excaption');

            }


        }

    }

    //this destroy for collage before training

    public function destroy_clg_before_training(Request $request)
    {
        try {


            $check_emp_primary = DB::table('college__during__trainings')
                ->where('Collage_Before_Training_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('college__during__trainings.*')
                ->count();


            if ($check_emp_primary > 0) {
                return response()->json(['msg' => 'College During Training for this Collage Before Training is already set. Delete the Collage Before Training first before College During Training', 'status' => 'failed']);

            } else {

                $user = DB::table('college__before__trainings')->where('Collage_Before_Training_ID', $request->id)
                    ->update(['Enabled' => 1]);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
                }


            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }

    //this for show collage before training

    public function show_clg_before_training($id)
    {
        try {

            $user = DB::table('college__before__trainings')
                ->where('Collage_Before_Training_ID', '=', $id)
                ->first();

            $collage = DB::table('collage_masters')
                ->select(DB::raw('CONCAT(collage_name, " - ", region , " - ", spoc) as name'),
                    'collage_id as collage_id')
                ->where('collage_masters.Enabled', '=', '0')
				->orderBy('collage_name')
                ->get();

            $program = DB::table('course_masters')
                ->select('course_masters.course_id', 'course_masters.company_program')
                ->where('course_masters.Enabled', '=', '0')
				->orderBy('company_program')
                ->get();


                $course = DB::table('Program_Master')
                ->select('Program_Master.Program_Id', 'Program_Master.Program_Name')
                ->where('Program_Master.Enabled', '=', '0')
                ->orderBy('Program_Name')
                ->get();
            /*$program = DB::table('college__before__trainings')

                    ->where('college__before__trainings.Enabled', '=', '0')
                    ->get();
*/

            return view('collage_before_training_edit')
                ->with(['clgbefortrain' => $user,
                    'collage' => $collage,
                    'Programss'=>$program,
                    'coursess'=>$course]);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }
    }

    //this for edit  collage before training

    public function edit_clg_before_training(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        if ($request->txt_collageid == -1 || $request->txt_collageid == null) {

            return redirect()->back()->with('error', 'College Name Not Selected');


        } else if ($request->cmb_program == -1 || $request->cmb_program == null) {

            return redirect()->back()->with('error', 'Program Not Selected');

        } else {
            try {
                $start_date = trim($request->dt_tsd);
                $end_date = trim($request->dt_ted);


                $chkEmp = DB::table('college__before__trainings')
                    ->whereNotBetween('college__before__trainings.Training_Start_Date', [$start_date, $end_date])
                    ->whereNotBetween('college__before__trainings.Training_End_Date',[$start_date,$end_date])
                    ->orWhere(function ($query) use ($start_date, $end_date) {

                        return $query->where('college__before__trainings.Training_Start_Date', '>=', $start_date)
                            ->where('college__before__trainings.Training_End_Date', '=<', $end_date);
                    })
                    ->get()->count();

                $obj = DB::table('college__before__trainings')->where('Collage_Before_Training_ID', $request->txt_cbrID)
                    ->update(['College_Id' => $request->txt_collageid,
                        'Course_Id'=>$request->cmb_program,
                        'Programm_Details' => $request->txt_prdetails,
                        'Recruitment_Drive_Date' => $request->dt_rdd,
                        'Training_Start_Date' => $request->dt_tsd,
                        'Training_End_Date' => $request->dt_ted,
                        'Communication_With_College' => $request->txt_commwithclg,
                        'Trainers_Breifing' => $request->txt_trainbrif,
                        'Travel' => $request->txt_Travel,
                        'Accomodation' => $request->txt_Accomodation,
                        'Reimbursement_Advance' => $request->txt_ReimAdv,
                        'Session_Timings' => $request->txt_sestime,
                        'test_timing'=>$request->txt_testime,
                        'Data_From_College' => $request->txt_datafromclg,
                        'Student_Engagement' => $request->txt_StuEnga,
                        'Student_Responded' => $request->txt_StuRes,
                        'FeedbackFromTraineer' => $request->txt_FeedBkFromTrainer,
                        'IssueRaised' => $request->txt_issueraised != null ? $request-> txt_issueraised : '',
                        'FeedbackFromEM' => $request->txt_FeedBkFromEmp != null ? $request-> txt_FeedBkFromEmp : '',
                        'IssueRaised_EM' => $request->txt_issueraisedEm != null ? $request->txt_issueraisedEm : '',
                        'Student_Categorization' => $request->txt_StudentCategorization,
                        'FinalReportToTPO' => $request->txt_FinalReportToTPO,
                        'FeedbackFromTPO' => $request->txt_FeedbackFromTPO,
                        'IssueRaised_TPO' => $request->txt_issueraisedTPO != null ? $request->txt_issueraisedTPO : '',
                        'FinalCallWithTPO' => $request->txt_FinalCallWithTPO,
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('ClgB4TraingList')->with('success', 'Record Updated Successfully');

            } catch (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }

        }
    }

    //this for add  collage before training

    public function add_clg_before_training()
    {

        try {
            $clg = DB::table('collage_masters')
                ->select(DB::raw('CONCAT(collage_name, " - ", region , " - ", spoc) as name'),
                    'collage_id as collage_id')
                ->where('collage_masters.Enabled', '=', '0')
				->orderBy('collage_name')
                ->get();

            /* $program = DB::table('course_masters')
                 ->select('course_masters.course_id', 'course_masters.company_program')
                 ->where('course_masters.Enabled', '=', '0')
                 ->get();
 */
            $program = DB::table('course_masters')
                ->select('course_masters.course_id', 'course_masters.company_program')
                ->where('course_masters.Enabled', '=', '0')
				->orderBy('company_program')
                ->get();

                $course = DB::table('Program_Master')
                ->select('Program_Master.Program_Id', 'Program_Master.Program_Name')
                ->where('Program_Master.Enabled', '=', '0')
                ->orderBy('Program_Name')
                ->get();



            return view('collage_before_training_add')->with([
                'clgb4train' => $clg,
                'programm' => $program,
                'courses' => $course
            ]);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }


    /*end collage before training*/

    /*start course session mapping*/

    public function get_allcourse_session_mapping()
    {
        try {
            $obj = DB::table('course_session_mappings')
               //->join('course_masters', 'course_masters.course_id', '=','course_session_mappings.Course_Id')
			    ->join('Program_Master','Program_Master.Program_Id' , '=' , 'course_session_mappings.Course_Id')
                //->leftJoin('collage_masters','collage_masters.collage_id','=','course_masters.collage_id')
                //->select('course_session_mappings.*', 'course_masters.company_program','collage_masters.collage_name')
                ->select('course_session_mappings.*', 'Program_Master.Company_Program','Program_Master.Program_Name')
				->where('course_session_mappings.Enabled', '=', 0)
                ->get();

            return view('cource_session_mapping_list')->with('coursesessmap', $obj);


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }
    }
    //this for store course session mapping

    public function store_course_session_mapping(Request $request)
    {

        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_courseid == -1 || $request->txt_courseid == null) {

            return redirect('AddCorSesMapp')->with('error', 'Course Not Selected');

        } else {
            try {
				$s1 = DB::table('course_session_mappings')
					->where('Course_Id','=',$request->txt_courseid)
					->where('Enabled','=','0')
					->count();
				$s2 = DB::table('Program_Master')
					->where('Program_Id','=',$request->txt_courseid)
					->select('Sessions_Count')
					->first();

				if($s1 >= $s2->Sessions_Count)
				{
					return redirect()->back()->withInput()
                        ->with('error', 'Available No. of Session are already created for the selected course.');
				}
                $session = DB::table('course_session_mappings')
                    ->select('course_session_mappings.Session_Id')
                    ->where('course_session_mappings.Session_Id', '=', $request->txt_sessionid)
                    ->where('course_session_mappings.Course_Id','=',$request->txt_courseid)
                    ->where('course_session_mappings.Enabled', '=', '0')
                    ->get()->count();

                if ($session > 0) {

                    return redirect()->back()->withInput()
                        ->with('error', 'Session ' . $request->txt_sessionid . ' for the selected course Already Exist');

                } else {
                    $obj = DB::table('course_session_mappings')
                        ->insert(['Course_Id' => $request->txt_courseid,
                            'Session_Id' => $request->txt_sessionid != null ? $request->txt_sessionid : '',
                            'Session_Description' => $request->txt_sessionDec != null ? $request->txt_sessionDec : '',
                            'Created_By' => session()->get('user_id'),
                            'created_at' => $current_time
                        ]);


                    return redirect('CorSesMappList');


                }


            } catch (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }

        }


    }

    //this destroy for course session mapping

    public function destroy_course_session_mapping(Request $request)
    {
        try {

            $check_emp_primary = DB::table('course_transactions')
                ->where('Session_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('course_transactions.*')
                ->count();


            $session_for_Session_Batch_Mapping = DB::table('Session_Batch_Mapping')
                ->where('Session_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('Session_Batch_Mapping.*')
                ->count();


            if ($check_emp_primary > 0) {

                return response()->json(['msg' => 'Couse Transaction for this Session is already set. Delete the Couse Transaction first before deleting Session', 'status' => 'failed']);

            }   else if ($session_for_Session_Batch_Mapping > 0) {

                return response()->json(['msg' => 'Session Batch Mapping for this Session is already set. Delete the Session Batch Mapping first before deleting Session', 'status' => 'failed']);

            }else {

                $user = DB::table('course_session_mappings')->where('Course_Session_mapping_ID', $request->id)->update(['Enabled' => 1]);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
                }
            }


        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }

    }

    //this for show course session mapping

    public function show_course_session_mapping($id)
    {
        try {

            $user = DB::table('course_session_mappings')->where('Course_Session_mapping_ID', '=', $id)->first();


            /*$course = DB::table('course_masters')
                ->join('collage_masters', 'collage_masters.collage_id', '=', 'course_masters.collage_id')
                ->select(DB::raw('CONCAT(collage_masters.collage_name, " - ", course_masters.company_program) as name'), 'course_masters.course_id')
                ->where('course_masters.Enabled', '=', '0')
                ->get();
*/
			$course = DB::table('Program_Master')
                ->select(DB::raw('CONCAT(Company_Program, " - ", Program_Name) as name'), 'Program_Id as course_id')
                ->where('Enabled', '=', '0')
				->orderBy('Company_Program')
                ->get();

			$sa = DB::table('Program_Master')
				->where('Program_Id','=',$user->Course_Id)
				->select('Sessions_Count')
				->first();

			$sc = DB::table('course_session_mappings')
				->where('Course_Id','=',$user->Course_Id)
				->where('Enabled','=','0')
				->count();
            return view('cource_session_mapping_edit')->with(['corsesionmapp' => $user,
                'coursess' => $course,
				'SA' => $sa->Sessions_Count,
				'SC' => $sc]);


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }


    }

    //this for edit  course session mapping

    public function edit_course_session_mapping(Request $request)
    {

        $current_time = Carbon::now()->toDateTimeString();


        if ($request->txt_courseid == -1 || $request->txt_courseid == null) {

            return redirect('AddCorSesMapp')->with('error', 'Course Not Selected');


        } else {


            $session = DB::table('course_session_mappings')
                ->select('course_session_mappings.Session_Id')
                ->where('course_session_mappings.Session_Id', '=', $request->txt_sessionid)
                ->where('course_session_mappings.Enabled', '=', '0')
                ->where('course_session_mappings.Course_Session_mapping_ID', '<>', $request->txt_csmID)
				->where('course_session_mappings.Course_Id','=',$request->txt_courseid)
                ->get()->count();

            if ($session > 0) {

                return redirect()->back()->withInput()
                    ->with('error', 'Session ' . $request->txt_sessionid . ' Already Exist for selected course');

            } else {

                $user = DB::table('course_session_mappings')
                    ->where('Course_Session_mapping_ID', $request->txt_csmID)
                    ->update(['Course_Id' => $request->txt_courseid,
                        'Session_Id' => $request->txt_sessionid != null ? $request->txt_sessionid : '',
                        'Session_Description' => $request->txt_sessionDec != null ? $request->txt_sessionDec : '',
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('CorSesMappList')->with('success', "Record Updated Successfully");


            }


        }


    }

    //for add course session mapping
    public function AddCourseSessionMapping()
    {

        try {
            /*  $course = DB::table('course_masters')
                  ->select('course_masters.course_id', 'course_masters.company_program')
                  ->where('course_masters.Enabled', '=', '0')
                  ->get();*/


            /*$course = DB::table('course_masters')
                ->join('collage_masters', 'collage_masters.collage_id', '=', 'course_masters.collage_id')
                ->select(DB::raw('CONCAT(collage_masters.collage_name, " - ", course_masters.company_program) as name'), 'course_masters.course_id')
                ->where('course_masters.Enabled', '=', '0')
                ->get();*/

			$course = DB::table('Program_Master')
                ->select(DB::raw('CONCAT(Company_Program, " - ", Program_Name) as name'), 'Program_Id as course_id')
                ->where('Enabled', '=', '0')
                ->get();

            return view('cource_session_mapping_add')->with([
                'course' => $course,
            ]);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }
    }

    /*end course session mapping*/

    /*start cource Transaction*/

    //this for list cource Transaction

    public function get_allcourse_Transaction()
    {
        try {
            $corstrans = DB::table('course_transactions')
                ->join('course_masters', 'course_masters.course_id', '=',
                    'course_transactions.Course_ID')
                ->join('course_session_mappings', 'course_session_mappings.Course_Session_mapping_ID',
                    '=', 'course_transactions.Session_Id')
                ->join('employee_masters', 'employee_masters.emp_id', '=',
                    'course_transactions.Emp_Id')
				->join('Session_Batch_Mapping','Session_Batch_Mapping.Batch_Id','=','course_transactions.Batch_Id')
                ->join('collage_masters','collage_masters.collage_id','=',
                    'course_masters.collage_id')
                ->join('topic_evaluation_masters','topic_evaluation_masters.Topic_Eval_Id',
                    '=','Session_Batch_Mapping.Topic_Eval_Id')
                ->join('Program_Master','Program_Master.Program_Id','=','course_masters.Program_Id')

                ->select('course_transactions.*', 'course_masters.company_program',
                    'course_session_mappings.Session_Id', 'employee_masters.emp_id',
                    'collage_masters.collage_name', 'employee_masters.emp_name','Session_Batch_Mapping.Batch_Id','topic_evaluation_masters.Evaluation_Description',
                    'collage_masters.collage_name','Program_Master.Program_Name')
                ->where('course_transactions.Enabled', '=', '0')
				//->toSql();
                ->get();
//print_r($corstrans);
            return view('course_Transaction_list')->with('CourseTrans', $corstrans);


        } catch (Exception $e) {


            return $e->getMessage();

           //return view('excaption');

        }

    }




    //this for store cource Transaction

    public function store_course_Transaction(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
		$startDate = date('Y-m-d');

        if ($request->txt_courseid == -1 || $request->txt_courseid == null) {


            return redirect()->back()->withInput()->with('error', 'Course Not Selectd');

        } else if ($request->txt_sessionid == -1 || $request->txt_sessionid == null) {

            return redirect()->back()->withInput()->with('error', 'Session Not Selected');

        } else if ($request->txt_empid == -1 || $request->txt_empid == null) {

            return redirect()->back()->withInput()->with('error', 'Employee Not Selected');

        } else {

            try {
				
				$tmp = DB::table('course_masters')
					->whereDate('course_masters.start_date','<=',$request->dt_batchdate)
					->whereDate('course_masters.end_date','>=',$request->dt_batchdate)
					->where('course_masters.course_id','=',$request->txt_courseid)
					->get()->count();
				if($tmp<1)
				{
					return redirect()->back()->withInput()->with('error', 'Batch Date must be between Course Start & End date');
				}
				
				$tmp1 = DB::table('course_transactions')
					->whereDate('course_transactions.Batch_Date','=',$request->dt_batchdate)
					->where('course_transactions.Session_Id','=',$request->txt_sessionid)
					->where('course_transactions.Batch_Id','=',$request->txt_betchid)
					->get()->count();
				if($tmp1>=1)
				{
					return redirect()->back()->withInput()->with('error', 'Same Batch for same Session on same Date are already assigned.');
				}

                $obj = DB::table('course_transactions')
                    ->insert(['Course_ID' => $request->txt_courseid,
                        'Session_Id' => $request->txt_sessionid,
                        'Batch_Id' => $request->txt_betchid,
						//'Batch_Id' => $request->cmbTopicEval,
                        'Batch_Date'=>$request->dt_batchdate,
                        'Start_Date' => $startDate,
                        'End_Date' => $startDate,
                        'Emp_Id' => $request->txt_empid,
                        'Batch_Timing' => $request->txt_Btimeing != null ? $request->txt_Btimeing : '',
                        'Remarks' => $request->txt_remarks != null ? $request->txt_remarks : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('CourseTrancList');

            } catch (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }

        }
    }
    //this destroy for cource Transaction

    public function destroy_course_Transaction(Request $request)
    {
        try {

            $user = DB::table('course_transactions')->where('Course_Transaction_ID', $request->id)->
            update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    //this for show cource Transaction

    public function show_course_Transaction($id)
    {
        try {

            $coursetrans = DB::table('course_transactions')->where('Course_Transaction_ID', '=', $id)->first();


            /* $course = DB::table('course_masters')
                 ->join('course_transactions', 'course_masters.course_id', '=', 'course_transactions.Course_ID')
                 ->where('course_transactions.Course_ID', '=', $coursetrans->Course_ID)
                 ->where('course_masters.Enabled', '=', '0')
                 ->select('course_masters.*')
                 ->get();*/

            //dd($course);


           /* $course = DB::table('course_masters')
                ->join('collage_masters', 'collage_masters.collage_id', '=',
                    'course_masters.collage_id')
                ->select(DB::raw('CONCAT(collage_masters.collage_name, " - ",
                course_masters.company_program) as name'), 'course_masters.course_id')
                ->where('course_masters.Enabled', '=', '0')
                ->get();*/
			$topic_id = DB::table('Session_Batch_Mapping')->select('Topic_Eval_Id')->where('Batch_Id','=',$coursetrans->Batch_Id)->first();
			$Date1 = $coursetrans->Batch_Date;
	$Topic_EID =$topic_id->Topic_Eval_Id;

	// $sql = "select employee_masters.emp_id,employee_masters.Emp_Code,employee_masters.emp_name,type_masters.type_desc from employee_masters ";
	// //$sql .= " left join course_transactions on  employee_masters.emp_id= course_transactions.Emp_Id ";
	// $sql .= " left join intern__planned__schedules on intern__planned__schedules.Emp_ID = employee_masters.emp_id";
	// $sql .= " inner join type_masters on type_masters.type_Id = employee_masters.type ";
	// $sql .= " Where employee_masters.emp_id not in (select Emp_Id from course_transactions where course_transactions.Batch_Date=?)";
	// $sql .= " and intern__planned__schedules.Topic_Eval_ID=?";
	// //$sql .= " and employee_masters.type<>3";
	// $sql .= " UNION";
	// $sql .= " select employee_masters.emp_id,employee_masters.Emp_Code,employee_masters.emp_name,type_masters.type_desc from employee_masters ";
	// $sql .= " left join intern__planned__schedules on intern__planned__schedules.Emp_ID = employee_masters.emp_id";
	// $sql .= " inner join type_masters on type_masters.type_Id = employee_masters.type ";
	// $sql .= " Where  intern__planned__schedules.Topic_Eval_ID=?";
	// $sql .= " and employee_masters.emp_id not in (select distinct Emp_Id from course_transactions)";
	// //$sql .= " and employee_masters.type<>3";
	// $sql .= " and employee_masters.emp_id not in(select course_transactions.Emp_Id from course_transactions)";
	// $sql .= " Union ";
	// $sql .= " select employee_masters.emp_id,employee_masters.Emp_Code,employee_masters.emp_name,type_masters.type_desc from employee_masters ";
	// $sql .= " inner join type_masters on type_masters.type_Id = employee_masters.type ";
	// $sql .= " Where emp_id=" . $coursetrans->Emp_Id;
	// //$sql .= " Order by employee_masters.emp_name";
	
	$i=0;
	$arr = explode(',',$Topic_EID);
	foreach( $arr as $ar)
	{
		if ($sql1=="")
		{
			$sql1 = " Select Emp_ID from intern__planned__schedules Where Topic_Eval_ID=" . $ar;
		}
		else
		{
			$sql1 .= " And Emp_ID in (Select Emp_ID from intern__planned__schedules Where Topic_Eval_ID=" . $ar;
			$i=$i+1;
		}
	}	
	for($j=0;$j<$i;$j++)
	{
		$sql1 .= ")";
	}
	
	
	$sql = "select distinct em.emp_id,em.Emp_Code,em.emp_name,tm.type_desc ";
	$sql .= " from type_masters tm,employee_masters em ";
	$sql .= " left join course_transactions ct on  em.emp_id= ct.Emp_Id ";
	$sql .= " Where em.emp_id in ($sql1) ";
	$sql .= " And tm.type_Id=em.type ";
	$sql .= " and em.emp_id not in (select ct.Emp_Id from course_transactions ct,course_masters cm ";
	$sql .= " where ct.Course_Id<>?";
	$sql .= " And cm.start_date<=?";
	$sql .= " And cm.end_date>=>?";
	$sql .= " And cm.course_id = ct.Course_Id)";
	$employee = DB::select($sql,[$coursetrans->Course_Id,$Date1,$Date1]);
	//$employee = DB::select($sql,[$Date1,$Topic_EID,$Topic_EID]);
	//$employee = DB::select($sql,[$Date1]);

			$course = DB::table('course_masters')
                ->join('collage_masters', 'collage_masters.collage_id', '=',
                    'course_masters.collage_id')
				->join('Program_Master','Program_Master.Program_Id','=','course_masters.Program_Id')
                ->select(DB::raw('CONCAT(collage_masters.collage_name, " - ",
                Program_Master.Program_Name) as name'), 'course_masters.course_id as course_id')
                ->where('course_masters.Enabled', '=', '0')
                ->get();
            $session = DB::table('course_session_mappings')
                ->join('course_transactions', 'course_session_mappings.Course_Session_mapping_ID',
                    '=', 'course_transactions.Session_Id')
                ->where('course_session_mappings.Enabled', '=', '0')
				->where('course_transactions.Course_Transaction_ID','=',$id)
                ->select('course_session_mappings.*')
				//->orderBy('Se')
                ->get();


            /*$employee = DB::table('employee_masters')
                ->leftJoin('course_transactions', 'employee_masters.emp_id', '=', 'course_transactions.Emp_Id')
                ->where('employee_masters.Enabled', '=', '0')
                ->select('employee_masters.*')
                ->distinct()
				->orderBy('emp_name')
                ->get();*/

			$topic_Eval = DB::table('topic_evaluation_masters')
				->join('Session_Batch_Mapping','Session_Batch_Mapping.Topic_Eval_Id','=','topic_evaluation_masters.Topic_Eval_Id')

				->where('topic_evaluation_masters.Enabled','=','0')
				->get();
            return view('course_Transaction_edit')->with(['coursetransaction' => $coursetrans,
                'Course' => $course,
                'Session' => $session,
                'Employee' => $employee,
				'Topic_Eval' => $topic_Eval]);

        } catch (Exception $e) {


              return $e->getMessage();

            //return view('excaption');

        }

    }

    //this for edit  course Transaction

    public function edit_course_Transaction(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        /*if ($request->txt_courseid == -1 || $request->txt_courseid == null) {

            return redirect()->back()->withInput()->with('error', 'Course  Not Selectd');

        } else if ($request->txt_sessionid == -1 || $request->txt_sessionid == null) {

            return redirect()->back()->withInput()->with('error', 'Session  Not Selected');

        } else */if ($request->txt_empid == -1 || $request->txt_empid == null) {

            return redirect()->back()->withInput()->with('error', 'Employee  Not Selected');

        } else {
            $start_date = trim($request->txt_startdate);
            $end_date = trim($request->txt_enddate);

            $chkEmp = DB::table('employee_masters')
                ->leftJoin('course_transactions','employee_masters.emp_id','=', 'course_transactions.Emp_Id')
                ->where('employee_masters.emp_id','=', $request->txt_empId)
                ->where('course_transactions.Course_Transaction_ID','<>',$request->txt_courseid)
                ->whereNotBetween('course_transactions.Start_Date', [$start_date, $end_date])
                ->whereNotBetween('course_transactions.End_Date',[$start_date,$end_date])
                ->orWhere(function ($query) use ($start_date, $end_date) {

                    return $query->where('course_transactions.Start_Date', '<', $start_date)
                        ->where('course_transactions.End_Date', '>', $end_date);
                })
                ->get()->count();
            if($chkEmp>=1)
            {
                return redirect()->back()->withInput()->with('error', 'Employee is already set with other course in given Date duration');
            }
            try {
                $user = DB::table('course_transactions')
                    ->where('Course_Transaction_ID', $request->txt_ctID)
                    ->update([
                        'Emp_Id' => $request->txt_empid,
                        'Batch_Timing' => $request->txt_Btimeing != null ? $request->txt_Btimeing : '',
                        'Remarks' => $request->txt_remarks != null ? $request->txt_remarks : '',
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);

					/*'Course_ID' => $request->txt_courseid,
                        'Session_Id' => $request->txt_sessionid,
                        'Batch_Id' => $request->txt_betchid,
                        'Start_Date' => $request->dt_startdate,
                        'End_Date' => $request->dt_enddate,*/

                return redirect('CourseTrancList')->with('success', "Record Updated Successfully");


            } catch (Exception $e) {


                //  return $e->getMessage();

                return view('excaption');

            }

        }

    }

    //add Course Transaction
    public function AddCourseTransaction()
    {
        try {
            /*   $Course = DB::table('course_masters')
                   ->select('course_masters.course_id', 'course_masters.company_program')
                   ->where('course_masters.Enabled', '=', '0')
                   ->get();*/


            /*$Course = DB::table('course_masters')
                ->join('collage_masters', 'collage_masters.collage_id', '=',
                    'course_masters.collage_id')
                ->select(DB::raw('CONCAT(collage_masters.collage_name, " - ",
                 course_masters.company_program) as name'), 'course_masters.course_id')
                ->where('course_masters.Enabled', '=', '0')
                ->get();*/

			$Course = DB::table('course_masters')
                ->join('collage_masters', 'collage_masters.collage_id', '=',
                    'course_masters.collage_id')
				->join('Program_Master','Program_Master.Program_Id','=','course_masters.Program_Id')
                ->select(DB::raw('CONCAT(collage_masters.collage_name, " - ",Program_Master.Program_Name) as name'), 'course_masters.course_id  as course_id')
                ->where('course_masters.Enabled', '=', '0')
                ->get();

				//->select(DB::raw('CONCAT(collage_masters.collage_name, " - ",Program_Master.Program_Name) as name'), //'course_masters.course_id  as course_id')
                
				
            $Session = DB::table('course_session_mappings')
                ->select('course_session_mappings.Session_Id', 'course_session_mappings.Session_Description')
                ->where('course_session_mappings.Enabled', '=', '0')
                ->get();

            $Employee = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
				->orderBy('emp_name')
                ->get();


            return view('course_Transaction_add')->with([
                'course' => $Course,
                'session' => $Session,
                'employee' => $Employee]);


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }
    }





    /*end cource Transaction*/

    /*start collage during training*/


    public function get_allclg_during_training()
    {
        try {
            $clgdurtraining = DB::table('college__during__trainings')
                ->join('collage_masters', 'collage_masters.collage_id',
                    '=', 'college__during__trainings.College_Id')
                //->join('course_masters', 'course_masters.course_id',						//Keyur:Don't do this type of mistakes
                //    '=', 'college__during__trainings.Collage_Before_Training_Id')
				->join('college__before__trainings', 'college__before__trainings.Collage_Before_Training_ID',
                    '=', 'college__during__trainings.Collage_Before_Training_Id')
                ->select('college__during__trainings.*', 'collage_masters.collage_name',
                    'college__before__trainings.Programm_Details')

                ->where('college__during__trainings.Enabled', '=', 0)
                ->get();


            return view('collage_during_training_list')->with('clgduringtrain', $clgdurtraining);


        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }
    }

    //this for store collage during training

    public function store_clg_during_training(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        if ($request->txt_B4trainId == -1 || $request->txt_B4trainId == null) {

            return redirect()->back()->withInput()->with('error', 'Before Training Not Selectd');

        } else if ($request->txt_collageid == -1 || $request->txt_collageid == null) {

            return redirect()->back()->withInput()->with('error', 'College Name Not Selected');

        } else {
            try {
                $tmp = DB::table('college__before__trainings')
                    ->where('college__before__trainings.Collage_Before_Training_ID','=',$request->txt_B4trainId)
                    ->where('college__before__trainings.Training_Start_Date','>=','$request->dt_entrydate')
                    ->where('college__before__trainings.Training_End_Date','=<','$request->dt_entrydate')
                    ->get()->count();
                if($tmp==0)
                {
                    return redirect()->back()->withInput()->with
                    ('error', 'Verify the date '  .  $request->dt_entrydate  .  ' It should between Course Start & End date. '  );
                }
                $obj = DB::table('college__during__trainings')
                    ->insert([
                        'Collage_Before_Training_Id' => $request->txt_B4trainId,
                        'College_Id' => $request->txt_collageid,
                        'Entry_Date' => $request->dt_entrydate,
                        'Student_Attendance_Percentage' => $request->txt_StuAttPer != null ? $request->txt_StuAttPer : '',
                        'Pulse_Count_Of_Students' => $request->txt_PlsCountStu != null ? $request->txt_PlsCountStu : '',
                        'Pulse_Score' => $request->txt_PulseScore != null ? $request->txt_PulseScore : '',
                        'Feedback_From_EM' => $request->txt_FedBkFrmEmp,
                        'Pratical_Test' => $request->txt_Practest != null ? $request->txt_Practest : '',
                        'Aptitude_Score' => $request->txt_AptiScore != null ? $request->txt_AptiScore : '',
                        'Verbal_Score' => $request->txt_VerbalScore != null ? $request->txt_VerbalScore : '',
                        'Technical_Score' => $request->txt_TechnicalScore != null ? $request->txt_TechnicalScore : '',
                        'Test_Reports' => $request->txt_TestReport,
                        'Update_To_TPO' => $request->txt_UpdtToTPO,
                        'Student_Engagement' => $request->txt_StuEnga != null ? $request->txt_StuEnga : '',
                        'Remarks' => $request->txt_remarks != null ? $request->txt_remarks : '',
                        'Database' => $request->txt_database != null ? $request->txt_database : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time


                    ]);

                return redirect('ClgDurTraList');


            } catch (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }

        }
    }

    //this destroy for collage during training

    public function destroy_clg_during_training(Request $request)
    {
        try {

            $user = DB::table('college__during__trainings')
                ->where('Collage_During_Training_Id', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }
    }

    //this for show collage during training

    public function show_clg_during_training($id)
    {
        try {

            $user = DB::table('college__during__trainings')->where('Collage_During_Training_Id', '=', $id)->first();
//select c.Name + ' - ' + cb.program as Name, cb.id from college-before_Training cb,college_master c where c.id=cb.college_id

            $collage = DB::table('collage_masters')
                ->select(DB::raw('CONCAT(collage_name, " - ", region , " - ", spoc) as name'),
                    'collage_id as collage_id')
                ->where('collage_masters.Enabled', '=', '0')
				->orderBy('collage_name')
                ->get();


            /* $program = DB::table('course_masters')
                 ->select('course_masters.course_id', 'course_masters.company_program')
                 ->where('course_masters.Enabled', '=', '0')
                 ->get();
 */
            $program =  DB::table('college__before__trainings')
                ->select('Collage_Before_Training_ID', 'Programm_Details')
                ->where('Enabled', '=', '0')
				->orderBy('Programm_Details')
                ->get();

            return view('collage_during_training_edit')->with(['clgduringtrain' => $user,
                'collage' => $collage,
                'Programss'=>$program]);

        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }
    }

    //this for edit  collage during training

    public function edit_clg_during_training(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();


        try {

            $tmp = DB::table('college__before__trainings')
                ->where('college__before__trainings.Collage_Before_Training_ID','=',$request->txt_B4trainId)
                ->where('college__before__trainings.Training_Start_Date','<=','$request->dt_entrydate')
                ->where('college__before__trainings.Training_End_Date','>=','$request->dt_entrydate')
                ->get()->count();

            if($tmp==0)
            {
                return redirect()->back()->withInput()->with('error', 'Verify the date. It should between Course Start & End date.');
            }



            $obj = DB::table('college__during__trainings')
                ->where('Collage_During_Training_Id', '=', $request->txt_cdtID)
                ->update(['Collage_Before_Training_Id' => $request->txt_B4trainId,
                    'College_Id' => $request->txt_collageid,
                    'Entry_Date' => $request->dt_entrydate,
                    'Student_Attendance_Percentage' => $request->txt_StuAttPer != null ? $request->txt_StuAttPer : '',
                    'Pulse_Count_Of_Students' => $request->txt_PlsCountStu != null ? $request->txt_PlsCountStu : '',
                    'Pulse_Score' => $request->txt_PulseScore != null ? $request->txt_PulseScore : '',
                    'Feedback_From_EM' => $request->txt_FedBkFrmEmp,
                    'Pratical_Test' => $request->txt_Practest != null ? $request->txt_Practest : '',
                    'Aptitude_Score' => $request->txt_AptiScore != null ? $request->txt_AptiScore : '',
                    'Verbal_Score' => $request->txt_VerbalScore != null ? $request->txt_VerbalScore : '',
                    'Technical_Score' => $request->txt_TechnicalScore != null ? $request->txt_TechnicalScore : '',
                    'Test_Reports' => $request->txt_TestReport,
                    'Update_To_TPO' => $request->txt_UpdtToTPO,
                    'Student_Engagement' => $request->txt_StuEnga != null ? $request->txt_StuEnga : '',
                    'Remarks' => $request->txt_remarks != null ? $request->txt_remarks : '',
                    'Database' => $request->txt_database != null ? $request->txt_database : '',
                    'LastUpdated_By' => session()->get('user_id'),
                    'updated_at' => $current_time]);


            return redirect('ClgDurTraList');


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }


    //this for add collage during training

    public function add_clg_during_training()
    {
        try {

            $collage = DB::table('collage_masters')
                ->select(DB::raw('CONCAT(collage_name, " - ", region , " - ", spoc) as name'),
                    'collage_id as collage_id')
                ->where('collage_masters.Enabled', '=', '0')
				->orderBy('collage_name')
                ->get();

           /* $program = DB::table('course_masters')
                ->select('course_masters.course_id', 'course_masters.company_program')
                ->where('course_masters.Enabled', '=', '0')
                ->get();
			*/
			$program =  DB::table('college__before__trainings')
                ->select('Collage_Before_Training_ID', 'Programm_Details')
                ->where('Enabled', '=', '3')		//Keyur:Make is hidden set =0 if want to show the data
				->orderBy('Programm_Details')
                ->get();

            return view('collage_during_training_add')->with([
                'college' => $collage,
                'programm'=>$program
            ]);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }
    }


    /*end collage during training*/

       /*start attendance*/


    //this for list attendance

    public function get_allattendance()
    {

        try {
            $obj = DB::table('attendances')
                ->join('employee_masters', 'employee_masters.Emp_Id', '=',
                    'attendances.Emp_id')
                ->join('course_masters', 'course_masters.course_id', '=',
                    'attendances.Course_id')
                ->leftJoin('collage_masters','collage_masters.collage_id',
                    '=','course_masters.collage_id')
                ->select('attendances.*', 'employee_masters.emp_name',
                    'course_masters.company_program','collage_masters.collage_name')
                ->where('attendances.Enabled', '=', 0)
                ->get();

            return view('attendance_list')->with('attendance', $obj);


        } catch (Exception $e) {


            //   return $e->getMessage();

            return view('excaption');

        }


    }

    //this for store attendance

    public function store_attendance(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_empid == -1 || $request->txt_empid == null) {


            return redirect('AddAttendance')->with('error', 'Employee Name Not Selectd');

        } else if ($request->txt_courseid == -1 || $request->txt_courseid == null) {

            return redirect('AddAttendance')->with('error', 'Course Not Selected');

        } else {
            try {

                $user = DB::table('attendances')
                    ->select('attendance_id')
                    ->where('Emp_id', '=', $request->txt_empid)
                    ->where('Date', '=', $request->dt_date)
                    ->first();

                if ($user) {

                    return redirect()->back()->withInput()->with('success', 'Employees Attendance Already Fill for ' . $request->dt_date);

                } else {
                    $obj = DB::table('attendances')
                        ->insert(['Emp_id' => $request->txt_empid,
                            'Date' => $request->dt_date,
                            'Activity' => $request->txt_activity != null ? $request->txt_activity : '',
                            'Course_id' => $request->txt_courseid,
                            'Created_By' => session()->get('user_id'),
                            'created_at' => $current_time,
                        ]);

                    return redirect('AttendanceList');
                }
            } catch (Exception $e) {

                //return $e->getMessage();
                return view('excaption');
            }
        }
    }

    //this destroy for attendance

    public function destroy_attendance(Request $request)
    {
        try {

            $user = DB::table('attendances')->where('attendance_id', '=', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }

        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }

    }

    //this for show attendance

    public function show_attendance($id)
    {
        try {

            $user = DB::table('attendances')->where('attendance_id', '=', $id)->first();

            $emp = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
                ->orderBy('emp_name')
                ->get();

            /* $cors = DB::table('course_masters')
                 ->select('course_masters.course_id', 'course_masters.company_program')
                 ->where('course_masters.Enabled', '=', '0')
                 ->get();*/

            $cors = DB::table('course_masters')
                ->join('collage_masters', 'collage_masters.collage_id', '=', 'course_masters.collage_id')
                ->select(DB::raw('CONCAT(collage_masters.collage_name, " - ", course_masters.company_program) as name'), 'course_masters.course_id')
                ->where('course_masters.Enabled', '=', '0')
                ->orderBy('collage_masters.collage_name')
                ->get();

            /*$course = DB::table('course_masters')
                ->join('collage_masters', 'collage_masters.collage_id', '=', 'course_masters.collage_id')
                ->select(DB::raw('CONCAT(collage_masters.collage_name, " - ", course_masters.company_program) as name'), 'course_masters.course_id')
                ->where('course_masters.Enabled','=','0')
                ->get();*/


            return view('attendance_edit')->with(['attendancess' => $user,
                'Employee' => $emp, 'Course' => $cors]);

        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }


    }

    //this for edit  attendance

    public function edit_attendance(Request $request)
    {

        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_empid == -1 || $request->txt_empid == null) {

            return redirect('AddAttendance')->with('error', 'Employee Name Not Selectd');

        } else if ($request->txt_courseid == -1 || $request->txt_courseid == null) {

            return redirect('AddAttendance')->with('error', 'Course Not Selected');

        } else {
            try {
                $user = DB::table('attendances')
                    ->where('attendance_id', $request->txt_attID)
                    ->update(['Emp_id' => $request->txt_empid,
                        'Date' => $request->dt_date,
                        'Activity' => $request->txt_activity != null ? $request->txt_activity : '',
                        'Course_id' => $request->txt_courseid,
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('AttendanceList')->with('success', "Record Updated Successfully");


            } catch (Exception $e) {


                // return $e->getMessage();

                return view('excaption');

            }

        }

    }

    //add attendance
    public function AddAttendance()
    {
        try {
            $emp = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
                ->orderBy('emp_name')
                ->get();

            /*  $cors = DB::table('course_masters')
                  ->select('course_masters.course_id', 'course_masters.company_program')
                  ->where('course_masters.Enabled', '=', '0')
                  ->get();*/


            $cors = DB::table('course_masters')
                ->join('collage_masters', 'collage_masters.collage_id', '=', 'course_masters.collage_id')
                ->select(DB::raw('CONCAT(collage_masters.collage_name, " - ", course_masters.company_program) as name'), 'course_masters.course_id')
                ->where('course_masters.Enabled', '=', '0')
                ->get();


            return view('attendance_add')->with([
                'employee' => $emp,
                'cource' => $cors,
            ]);

        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }
    }

    /*end attendance*/

    /*start intern planned schdule*/

    //this for list intern planned schdule

    public function get_allIntern_Planned_Schedule()
    {
        try {
           /* $obj = DB::table('intern__planned__schedules')
                ->join('employee_masters', 'employee_masters.emp_id', '=',
                    'intern__planned__schedules.Emp_ID')
                ->join('topic_masters', 'topic_masters.topic_id', '=',
                    'intern__planned__schedules.Topic_ID')
                ->join('sub__topic_masters', 'sub__topic_masters.Sub_Topic_Id', '=',
                    'intern__planned__schedules.Sub_Topic_ID')
                ->join('topic_evaluation_masters', 'topic_evaluation_masters.Topic_Eval_Id', '=',
                    'intern__planned__schedules.Topic_Eval_ID')
                // ->join('type_masters','type_masters.type_Id',
                //     '=','intern__planned__schedules.Review_Type')
                ->join('type_masters','type_masters.type_Id','=','employee_masters.type')
                ->select('intern__planned__schedules.*',
                    'employee_masters.emp_name', 'topic_masters.topic_description',
                    'sub__topic_masters.Topic_Description',
                    'topic_evaluation_masters.Evaluation_Description',
                    'type_masters.type_desc')
                ->where('intern__planned__schedules.Enabled', '=', '0')
                ->where('employee_masters.type','=','3')
                ->get();*/


            $obj = DB::table('intern__planned__schedules')
                ->join('employee_masters', 'employee_masters.emp_id', '=',
                    'intern__planned__schedules.Emp_ID')
                ->join('topic_masters', 'topic_masters.topic_id', '=',
                    'intern__planned__schedules.Topic_ID')
                ->join('sub__topic_masters', 'sub__topic_masters.Sub_Topic_Id', '=',
                    'intern__planned__schedules.Sub_Topic_ID')
                ->join('topic_evaluation_masters', 'topic_evaluation_masters.Topic_Eval_Id', '=',
                    'intern__planned__schedules.Topic_Eval_ID')
                // ->join('type_masters','type_masters.type_Id','=','employee_masters.type')
                ->select('intern__planned__schedules.*',
                    'employee_masters.emp_name', 'topic_masters.topic_description',
                    'sub__topic_masters.Topic_Description',
                    'topic_evaluation_masters.Evaluation_Description')
                ->where('intern__planned__schedules.Enabled', '=', '0')
                 ->where('employee_masters.type','=','3')
                ->get();



			//$queries = DB::getQueryLog();

            return view('intern_planned_schedule_list')->with('interplannsch', $obj);


        } catch (Exception $e) {


            return $e->getMessage();

            //return view('excaption');

        }

    }

    //this for store intern planned schdule

    public function store_Intern_Planned_Schedule(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_topicname == -1 || $request->txt_topicname == null) {

            return redirect()->back()->withInput()->with('error', 'Topic  Not Selectd');

        } else if ($request->txt_empId == -1 || $request->txt_empId == null) {

            return redirect()->back()->withInput()->with('error', 'Employee  Not Selected');

        } else if ($request->txt_empId == $request->txt_ReEmpId) {

            return redirect()->back()->withInput()->with('error', 'Employee Name And Review Employee Name Should Not be Same');

        }else if ($request->txt_reviewtype == -1 || $request->txt_reviewtype == null) {

            return redirect()->back()->with('error', 'Review Type  Not Selected');

        } else {
            try {


                $obj = DB::table('intern__planned__schedules')
                    ->insert(['Emp_ID' => $request->txt_empId,
                        'Review_date' => $request->dt_ReDate,
                        'Review_Type'=>$request->txt_reviewtype,
                        'Topic_ID' => $request->txt_topicname,
                        'Sub_Topic_ID' => $request->txt_SubTopicName,
                        'Topic_Eval_ID' => $request->txt_TopicEvalName,
                        'Review_Emp_ID' => $request->txt_ReEmpId,
                        'Start_Time' => $request->txt_StartTime != null ? $request->txt_StartTime : '',
                        'End_time' => $request->txt_EndTime != null ? $request->txt_EndTime : '',
                        'Review_score'=>$request->txt_reviewscore,
                        'Description' => $request->txt_description != null ? $request->txt_description : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('InternPlnSchiList');


            } catch (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }

        }

    }

    //this destroy for intern planned schdule

    public function destroy_Intern_Planned_Schedule(Request $request)
    {

        try {

            $user = DB::table('intern__planned__schedules')
                ->where('Intern_Planned_Schedule_ID', '=', $request->id)
                ->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }
            // return redirect('DeparmentList')->with('success',"Delete Record Successfully");


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }

    }

    //this for show intern planned schdule

    public function show_Intern_Planned_Schedule($id)
    {
        try {

            $intrnplanscs = DB::table('intern__planned__schedules')->where('Intern_Planned_Schedule_ID',
                '=', $id)->first();

            $emp = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
				->where('employee_masters.type','=','3')
				->orderBy('emp_name')
                ->get();

            $reemp = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
				->where('employee_masters.type','<>','3')
				->orderBy('emp_name')
                ->get();


            $topc = DB::table('topic_masters')
                ->select('topic_masters.topic_id', 'topic_masters.topic_description')
                ->where('topic_masters.Enabled', '=', '0')
				->orderBy('topic_description')
                ->get();

            $sbtopc = DB::table('sub__topic_masters')
                ->select('sub__topic_masters.Sub_Topic_Id', 'sub__topic_masters.Topic_Description')
                ->where('sub__topic_masters.Topic_Id', '=', $intrnplanscs->Topic_ID)
                ->where('sub__topic_masters.Enabled', '=', '0')
				->orderBy('topic_description')
                ->get();

            $topceval = DB::table('topic_evaluation_masters')
                ->select('topic_evaluation_masters.Topic_Eval_Id',
                    'topic_evaluation_masters.Evaluation_Description')
                ->where('topic_evaluation_masters.Sub_Topic_Id', '=', $intrnplanscs->Sub_Topic_ID)
                ->where('topic_evaluation_masters.Enabled', '=', '0')
				->orderBy('Evaluation_Description')
                ->get();

            $rtype = DB::table('type_masters')
                ->select('type_masters.type_Id',
                    'type_masters.type_desc')
                ->where('type_masters.Enabled', '=', '0')
				->orderBy('type_desc')
                ->get();


            return view('intern_planned_schedule_edit')->with(['intrnplanscs' => $intrnplanscs,
                'employees' => $emp,
                'topics' => $topc,
                'subtopics' => $sbtopc,
                'topicevaluas' => $topceval,
                'reviewemp' => $reemp,
                'typess'=>$rtype]);

        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }


    }
    //this for edit  intern planned schdule

    public function edit_Intern_Planned_Schedule(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_topicname == -1 || $request->txt_topicname == null) {

            return redirect()->back()->with('error', 'Topic  Not Selectd');

        } else if ($request->txt_empId == -1 || $request->txt_empId == null) {

            return redirect()->back()->with('error', 'Employee  Not Selected');

        } else if ($request->txt_empId == $request->txt_ReEmpId) {

            return redirect()->back()->with('error', 'Employee Name And Review Employee Name Should Not be Same');

        } else if ($request->txt_reviewtype == -1 || $request->txt_reviewtype == null) {

            return redirect()->back()->with('error', 'Review Type  Not Selected');

        } else {
            try {
                $user = DB::table('intern__planned__schedules')
                    ->where('Intern_Planned_Schedule_ID', $request->txt_ipsID)
                    ->update([//'Emp_ID' => $request->txt_empId,
                        'Review_date' => $request->dt_ReDate,
                        'Review_Type'=>$request->txt_reviewtype,
                        //'Topic_ID' => $request->txt_topicname,
                        //'Sub_Topic_ID' => $request->txt_SubTopicName,
                        //'Topic_Eval_ID' => $request->txt_TopicEvalName,
                        'Review_Emp_ID' => $request->txt_ReEmpId,
                        'Start_Time' => $request->txt_StartTime != null ? $request->txt_StartTime : '',
                        'End_time' => $request->txt_EndTime != null ? $request->txt_EndTime : '',
                        'Review_score'=>$request->txt_reviewscore,
                        'Description' => $request->txt_description != null ? $request->txt_description : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('InternPlnSchiList')->with('success', "Record Updated Successfully");


            } catch (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }

        }
    }

    //add intern planned schdule

    public function Add_Intern_Planned_Schedule()
    {
        try {
            $emp = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
				->where('employee_masters.type','<>','3')
				->orderBy('emp_name')
                ->get();

            $reemp = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
				->where('employee_masters.type','<>','3')
				->orderBy('emp_name')
                ->get();

            $topc = DB::table('topic_masters')
                ->select('topic_masters.topic_id', 'topic_masters.topic_description')
                ->where('topic_masters.Enabled', '=', '0')
				->orderBy('topic_description')
                ->get();

            $sbtopc = DB::table('sub__topic_masters')
                ->select('sub__topic_masters.Sub_Topic_Id', 'sub__topic_masters.Topic_Description')
                ->where('sub__topic_masters.Enabled', '=', '0')
				->orderBy('topic_description')
                ->get();

            $topceval = DB::table('topic_evaluation_masters')
                ->select('topic_evaluation_masters.Topic_Eval_Id',
                    'topic_evaluation_masters.Evaluation_Description')
                ->where('topic_evaluation_masters.Enabled', '=', '0')
				->orderBy('Evaluation_Description')
                ->get();

            $type = DB::table('type_masters')
                ->select('type_masters.type_Id',
                    'type_masters.type_desc')
                ->where('type_masters.Enabled', '=', '0')
				->orderBy('type_desc')
                ->get();


            return view('intern_planned_schedule_add')->with([
                'employee' => $emp,
                'topic' => $topc,
                'subtopic' => $sbtopc,
                'topiceval' => $topceval,
                'reviemp' => $reemp,
                'types'=>$type
            ]);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }
    }

    /*end intern planned schdule*/

    /*start intern evaluation*/

    //this for list intern evaluation

    public function get_allIntern_Evaluation()
    {
        try {
            $interneval = DB::table('intern__evaluations')
                ->join('employee_masters', 'employee_masters.emp_id', '=',
                    'intern__evaluations.Emp_Id')
                ->join('evalution_masters', 'evalution_masters.eval_id', '=',
                    'intern__evaluations.Eval_ID')
                ->join('demo_masters', 'demo_masters.demo_id', '=',
                    'intern__evaluations.Demo_ID')
                ->select('intern__evaluations.*', 'employee_masters.emp_name', 'employee_masters.emp_id',
                    'evalution_masters.Eval_ID', 'demo_masters.demo_id')
                ->where('intern__evaluations.Enabled', '=', '0')
				->where('employee_masters.type','<>','3')
                ->get();

            return view('intern_evaluation_list')->with('InternEval', $interneval);


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }
    }

    //this for store intern evaluation

    public function store_Intern_Evaluation(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        if ($request->txt_EmpId == -1 || $request->txt_EmpId == null) {

            return redirect()->back()->withInput()->with('error', 'Employee Name Not Selectd');

        } else if ($request->txt_FacultyId == -1 || $request->txt_FacultyId == null) {

            return redirect()->back()->withInput()->with('error', 'Faculty Name Not Selected');

        } else if ($request->txt_EvalId == -1 || $request->txt_EvalId == null) {

            return redirect()->back()->withInput()->with('error', 'Evaluation Description Not Selected');

        } else if ($request->txt_FacultyId == $request->txt_EmpId) {

            return redirect()->back()->withInput()->with('error', 'Employee And Faculty Sholud Not Be same');

        } else {
            try {


                $obj = DB::table('intern__evaluations')
                    ->insert([
                        'Emp_Id' => $request->txt_EmpId,
                        'Faculty_Id' => $request->txt_FacultyId,
                        'Evaluation_date' => $request->dt_EvaluDate,
                        'Eval_ID' => $request->txt_EvalId,
                        'Demo_ID' => $request->txt_DemoId,
                        'Content_Score' => $request->txt_ContentScore != null ? $request->txt_ContentScore : '',
                        'Presentation_Score' => $request->txt_PresentScore != null ? $request->txt_PresentScore : '',
                        'Application_score' => $request->txt_AppScore != null ? $request->txt_AppScore : '',
                        'Value_Addition' => $request->txt_ValueAddition != null ? $request->txt_ValueAddition : '',
                        'Demo_Status' => $request->txt_DemoStatus != null ? $request->txt_DemoStatus : '',
                        'Positive_comments' => $request->txt_PosComm != null ? $request->txt_PosComm : '',
                        'Constructive_Comments' => $request->txt_ConstruComme != null ? $request->txt_ConstruComme : '',
                        'Average_Score' => $request->txt_AvgScore != null ? $request->txt_AvgScore : '',
                        'TE1_Start_time' => $request->txt_StartTime1 != null ? $request->txt_StartTime1 : '',
                        'TE1_End_Time' => $request->txt_EndTime1 != null ? $request->txt_EndTime1 : '',
                        'TE1_Description' => $request->txt_Description1 != null ? $request->txt_Description1 : '',
                        'TE1_Score' => $request->txt_score1 != null ? $request->txt_score1 : '',
                        'TE2_start_Time' => $request->txt_StartTime2 != null ? $request->txt_StartTime2 : '',
                        'TE2_end_time' => $request->txt_EndTime2 != null ? $request->txt_EndTime2 : '',
                        'TE2_Description' => $request->txt_Description2 != null ? $request->txt_Description2 : '',
                        'TE2_Score' => $request->txt_score2 != null ? $request->txt_score2 : '',
                        'DE1_Score' => $request->txt_demoscore1 != null ? $request->txt_demoscore1 : '',
                        'DE2_Score' => $request->txt_demoscore2 != null ? $request->txt_demoscore2 : '',
                        'Average_Test_score' => $request->txt_AvgTestScore != null ? $request->txt_AvgTestScore : '',
                        'Average_Demo_score' => $request->txt_AvgDemoScore != null ? $request->txt_AvgDemoScore : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time
                    ]);

                return redirect('InternEvaluList');


            } catch (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }

        }
    }

    //this destroy for intern evaluation

    public function destroy_Intern_Evaluation(Request $request)
    {
        try {

            $user = DB::table('intern__evaluations')
                ->where('Intern_Evaluation_Id', '=', $request->id)
                ->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }

    //this for show intern evaluation

    public function show_Intern_Evaluation($id)
    {
        try {

            $user = DB::table('intern__evaluations')->where('Intern_Evaluation_Id', '=', $id)->first();

            $employee = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
				->orderBy('emp_name')
                ->get();

            $faculty = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
				->orderBy('emp_name')
                ->get();

            $eval = DB::table('evalution_masters')
                ->select('evalution_masters.eval_id', 'evalution_masters.eval_desc')
                ->where('evalution_masters.Enabled', '=', '0')
				->orderBy('eval_desc')
                ->get();

            $demo = DB::table('demo_masters')
                ->select('demo_masters.demo_id', 'demo_masters.demo_desc')
                ->where('demo_masters.Enabled', '=', '0')
				->orderBy('demo_desc')
                ->get();


            return view('intern_evaluation_edit')->with(['interneval' => $user,
                'employees' => $employee, 'facultys' => $faculty,
                'Evaluations' => $eval, 'Demos' => $demo]);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }

    //this for edit  intern evaluation

    public function edit_Intern_Evaluation(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        if ($request->txt_EmpId == -1 || $request->txt_EmpId == null) {

            return redirect()->back()->with('error', 'Employee Name Not Selectd');

        } else if ($request->txt_FacultyId == -1 || $request->txt_FacultyId == null) {

            return redirect()->back()->with('error', 'Faculty Name Not Selected');

        } else if ($request->txt_EvalId == -1 || $request->txt_EvalId == null) {

            return redirect()->back()->with('error', 'Evaluation Description Not Selected');

        } else {
            try {

                $obj = DB::table('intern__evaluations')
                    ->where('Intern_Evaluation_Id', $request->txt_ieID)
                    ->update([
                        'Emp_Id' => $request->txt_EmpId,
                        'Faculty_Id' => $request->txt_FacultyId,
                        'Evaluation_date' => $request->dt_EvaluDate,
                        'Eval_ID' => $request->txt_EvalId,
                        'Demo_ID' => $request->txt_DemoId,
                        'Content_Score' => $request->txt_ContentScore != null ? $request->txt_ContentScore : '',
                        'Presentation_Score' => $request->txt_PresentScore != null ? $request->txt_PresentScore : '',
                        'Application_score' => $request->txt_AppScore != null ? $request->txt_AppScore : '',
                        'Value_Addition' => $request->txt_ValueAddition != null ? $request->txt_ValueAddition : '',
                        'Demo_Status' => $request->txt_DemoStatus != null ? $request->txt_DemoStatus : '',
                        'Positive_comments' => $request->txt_PosComm != null ? $request->txt_PosComm : '',
                        'Constructive_Comments' => $request->txt_ConstruComme != null ? $request->txt_ConstruComme : '',
                        'Average_Score' => $request->txt_AvgScore != null ? $request->txt_AvgScore : '',
                        'TE1_Start_time' => $request->txt_StartTime1 != null ? $request->txt_StartTime1 : '',
                        'TE1_End_Time' => $request->txt_EndTime1 != null ? $request->txt_EndTime1 : '',
                        'TE1_Description' => $request->txt_Description1 != null ? $request->txt_Description1 : '',
                        'TE1_Score' => $request->txt_score1 != null ? $request->txt_score1 : '',
                        'TE2_start_Time' => $request->txt_StartTime2 != null ? $request->txt_StartTime2 : '',
                        'TE2_end_time' => $request->txt_EndTime2 != null ? $request->txt_EndTime2 : '',
                        'TE2_Description' => $request->txt_Description2 != null ? $request->txt_Description2 : '',
                        'TE2_Score' => $request->txt_score2 != null ? $request->txt_score2 : '',
                        'DE1_Score' => $request->txt_demoscore1 != null ? $request->txt_demoscore1 : '',
                        'DE2_Score' => $request->txt_demoscore2 != null ? $request->txt_demoscore2 : '',
                        'Average_Test_score' => $request->txt_AvgTestScore != null ? $request->txt_AvgTestScore : '',
                        'Average_Demo_score' => $request->txt_AvgDemoScore != null ? $request->txt_AvgDemoScore : '',
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time
                    ]);

                return redirect('InternEvaluList')->
                with('success', "Record Updated Successfully");


            } catch (Exception $e) {


                // return $e->getMessage();

                return view('excaption');

            }

        }
    }

    //this for add intern evaluation

    public function add_Intern_Evaluation()
    {
        {

            try {
                $employee = DB::table('employee_masters')
                    ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                    ->where('employee_masters.Enabled', '=', '0')
					->orderBy('emp_name')
                    ->get();

                $faculty = DB::table('employee_masters')
                    ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                    ->where('employee_masters.Enabled', '=', '0')
                    ->orderBy('emp_name')
					->get();

                $eval = DB::table('evalution_masters')
                    ->select('evalution_masters.eval_id', 'evalution_masters.eval_desc')
                    ->where('evalution_masters.Enabled', '=', '0')
                    ->orderBy('eval_desc')
					->get();

                $demo = DB::table('demo_masters')
                    ->select('demo_masters.demo_id', 'demo_masters.demo_desc')
                    ->where('demo_masters.Enabled', '=', '0')
                    ->orderBy('demo_desc')
					->get();


                return view('intern_evaluation_add')->with([
                    'employee' => $employee, 'faculty' => $faculty, 'evaluation' => $eval, 'Demo' => $demo
                ]);


            } catch (Exception $e) {


                //  return $e->getMessage();

                return view('excaption');

            }
        }
    }

    /*start employee qualification*/

    //this for list  employee qualification

    public function get_allEmployeeQualification()
    {
        try {
            $obj = DB::table('emp__qualifications')
                ->join('employee_masters', 'employee_masters.emp_id', '=',
                    'emp__qualifications.Emp_Id')
                ->select('emp__qualifications.*', 'employee_masters.emp_name')
                ->where('emp__qualifications.Enabled', '=', 0)
                ->get();

            return view('employee_qualification_list')->with('empqui', $obj);

        } catch (Exception $e) {

            // return $e->getMessage();
            return view('excaption');
        }
    }

    //this for store employee qualification

    public function store_EmployeeQualification(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_empid == -1 || $request->txt_empid == null) {

            return redirect()->back()->withInput()->with('error', 'Employee  Not Selectd');

        }
        if ($request->txt_qulitype == -1 || $request->txt_qulitype == null) {

            return redirect()->back()->withInput()->with('error', 'Qualification Type  Not Selectd');

        }
        if($request->txt_passoutyear > date('Y') )
        {
            return redirect()->back()->withInput()->with('error', 'Passout year cannot be in future');
        }
        else {
            try {


                $obj = DB::table('emp__qualifications')
                    ->insert(['Emp_Id' => $request->txt_empid,
                        'Qualification_dec' => $request->txt_qulidec,
                        'qualification_type' => $request->txt_qulitype,
                        'Institute_Name' => $request->txt_instiname,
                        'Board' => $request->txt_board,
                        'Qualification_Percentage' => $request->txt_qulipercen,
                        'Passout_Year' => $request->txt_passoutyear,
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('EmpQuliList');


            } catch (Exception $e) {

                //return $e->getMessage();
                return view('excaption');
            }
        }
    }

    //this destroy for employee qualification

    public function destroy_EmployeeQqualifivation(Request $request)
    {
        try {

            $user = DB::table('emp__qualifications')->where('Emp_Qualification_ID', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }
            // return redirect('DeparmentList')->with('success',"Delete Record Successfully");


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }

    //this for show employee qualification

    public function show_EmployeeQualification($id)
    {
        try {

            $user = DB::table('emp__qualifications')->where('Emp_Qualification_ID', '=', $id)->first();

            $emp = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
                ->orderBy('emp_name')
				->get();


            return view('employee_qualification_edit')->with(['employeequali' => $user,
                'empp' => $emp]);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }

    //this for edit  employee qualification

    public function edit_EmployeeQualification(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_empid == -1 || $request->txt_empid == null) {

            return redirect('AddEmpQuli')->with('error', 'Employee ID Not Selectd');

        }
        if ($request->txt_qulitype == -1 || $request->txt_qulitype == null) {

            return redirect()->back()->withInput()->with('error', 'Qualification Type  Not Selectd');

        }
        if($request->txt_passoutyear > date('Y') )
        {
            return redirect()->back()->withInput()->with('error', 'Passout year cannot be in future');
        }
        else {
            try {
                $user = DB::table('emp__qualifications')
                    ->where('Emp_Qualification_ID', $request->txt_eqID)
                    ->update(['Emp_Id' => $request->txt_empid,
                        'Qualification_dec' => $request->txt_qulidec,
                        'qualification_type' => $request->txt_qulitype,
                        'Institute_Name' => $request->txt_instiname,
                        'Board' => $request->txt_board,
                        'Qualification_Percentage' => $request->txt_qulipercen,
                        'Passout_Year' => $request->txt_passoutyear,
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('EmpQuliList')->with('success', "Record Updated Successfully");


            } catch (Exception $e) {


                // return $e->getMessage();

                return view('excaption');

            }

        }

    }

    //add employee qualification

    public function AddEmployeeQualification()
    {
        try {
            $emp = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
                ->orderBy('emp_name')
				->get();

            return view('employee_qualification_add')->with([
                'employees' => $emp
            ]);


        } catch (Exception $e) {

            //return $e->getMessage();

            return view('excaption');

        }
    }





    /*end employee qualification*/

    /*start role allocation*/

    //this for list  role allocation

   public function get_allRole_Allocation()
    {
        try {

            $obj = DB::table('role_masters')
                ->where('role_masters.Enabled', '=', 0)
                ->get();
            return view('role_allocation_list')->with('rollallo', $obj);



        } catch (Exception $e) {




            return view('excaption');

        }
    }

    //this for store role allocation

    public function store_Role_Allocation(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_roleid == -1 || $request->txt_roleid == null) {


            return redirect('AddRoleAlloct')->with('error', 'Role Name Not Selectd');

        } else {
            try {

                $role = DB::table('role__allocations')
                    ->select('role__allocations.Role_Id')
                    ->where('role__allocations.Role_Id', '=', $request->txt_roleid)
                    ->where('role__allocations.Enabled', '=', '0')
                    ->get()->count();

                if ($role > 0) {

                    return redirect()->back()->withInput()
                        ->with('error', 'Role Allocation is already set the selected Role');

                }else{
                    $func = DB::table('functionmasters')
                        ->get();
                    foreach($func as $f)
                    {
                        $chk='chk' . $f->id;

                        if($request->has($chk)) {

                            $obj = DB::table('role__allocations')
                                ->insert(['isAllowed' => 1,
                                    'Role_Id' => $request->txt_roleid!= null ? $request->txt_roleid : '',
                                    'Fun_Id' => $f->id,
                                    'Created_By' => session()->get('user_id'),
                                    'created_at' => $current_time

                                ]);


                        }
                        else {
                            $obj = DB::table('role__allocations')
                                ->insert(['isAllowed' => 0,
                                    'Role_Id' => $request->txt_roleid,
                                    'Fun_Id' => $f->id,
                                    'Created_By' => session()->get('user_id'),
                                    'created_at' => $current_time

                                ]);
                        }
                    }


                }



                return redirect('ListRoleAlloct');


            } catch (Exception $e) {



				//return $e->getMessage();
               return view('excaption');

            }

        }
    }

    //this destroy for role allocation

    public function destroy_Role_Allocation(Request $request)
    {
        try {

            //delete from role_allocation were Role_id=$request->txt_roleid;

            $user = DB::table('role_masters')
                ->where('Role_Id', $request->id)
                ->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }
            // return redirect('DeparmentList')->with('success',"Delete Record Successfully");


        } catch (Exception $e) {


            return view('excaption');

        }

    }

    //this for show role allocation

    public function show_Role_Allocation($id)
    {
        try {

            $user = DB::table('role__allocations')
				->where('Role_Id','=', $id)
				->first();

            $Roll = DB::table('role_masters')
                ->select('role_masters.Role_Id', 'role_masters.Role_Name')
                ->where('role_masters.Enabled', '=', '0')
                ->orderBy('Role_Name')
				->get();
			$Fun1 = DB::table('role__allocations') ->where('Role_Id','=',$id) ->where('Fun_Id','=','1') ->select('isAllowed') ->value('isAllowed');
			$Fun2 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','2')->select('isAllowed')->value('isAllowed');
			$Fun3 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','3')->select('isAllowed')->value('isAllowed');
			$Fun4 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','4')->select('isAllowed')->value('isAllowed');
			$Fun5 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','5')->select('isAllowed')->value('isAllowed');
			$Fun6 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','6')->select('isAllowed')->value('isAllowed');
			$Fun7 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','7')->select('isAllowed')->value('isAllowed');
			$Fun8 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','8')->select('isAllowed')->value('isAllowed');
			$Fun9 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','9')->select('isAllowed')->value('isAllowed');
			$Fun10 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','10')->select('isAllowed')->value('isAllowed');
			$Fun11 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','11')->select('isAllowed')->value('isAllowed');
			$Fun12 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','12')->select('isAllowed')->value('isAllowed');
			$Fun13 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','13')->select('isAllowed')->value('isAllowed');
			$Fun14 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','14')->select('isAllowed')->value('isAllowed');
			$Fun15 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','15')->select('isAllowed')->value('isAllowed');
			$Fun16 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','16')->select('isAllowed')->value('isAllowed');
			$Fun17 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','17')->select('isAllowed')->value('isAllowed');
			$Fun18 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','18')->select('isAllowed')->value('isAllowed');
			$Fun19 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','19')->select('isAllowed')->value('isAllowed');
			$Fun20 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','20')->select('isAllowed')->value('isAllowed');
			$Fun21 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','21')->select('isAllowed')->value('isAllowed');
			$Fun22 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','22')->select('isAllowed')->value('isAllowed');
			$Fun23 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','23')->select('isAllowed')->value('isAllowed');
			$Fun24 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','24')->select('isAllowed')->value('isAllowed');
			$Fun25 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','25')->select('isAllowed')->value('isAllowed');
			$Fun26 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','26')->select('isAllowed')->value('isAllowed');
			$Fun27 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','27')->select('isAllowed')->value('isAllowed');
			$Fun28 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','28')->select('isAllowed')->value('isAllowed');
			$Fun29 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','29')->select('isAllowed')->value('isAllowed');
			$Fun30 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','30')->select('isAllowed')->value('isAllowed');
			$Fun31 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','31')->select('isAllowed')->value('isAllowed');
			$Fun32 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','32')->select('isAllowed')->value('isAllowed');
			$Fun33 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','33')->select('isAllowed')->value('isAllowed');
			$Fun34 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','34')->select('isAllowed')->value('isAllowed');
			$Fun35 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','35')->select('isAllowed')->value('isAllowed');
			$Fun36 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','36')->select('isAllowed')->value('isAllowed');
			$Fun37 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','37')->select('isAllowed')->value('isAllowed');
			$Fun38 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','38')->select('isAllowed')->value('isAllowed');
			$Fun39 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','39')->select('isAllowed')->value('isAllowed');
			$Fun40 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','40')->select('isAllowed')->value('isAllowed');
			$Fun41 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','41')->select('isAllowed')->value('isAllowed');
			$Fun42 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','42')->select('isAllowed')->value('isAllowed');
			$Fun43 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','43')->select('isAllowed')->value('isAllowed');
			$Fun44 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','44')->select('isAllowed')->value('isAllowed');
			$Fun45 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','45')->select('isAllowed')->value('isAllowed');
			$Fun46 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','46')->select('isAllowed')->value('isAllowed');
			$Fun47 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','47')->select('isAllowed')->value('isAllowed');
			$Fun48 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','48')->select('isAllowed')->value('isAllowed');
			$Fun49 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','49')->select('isAllowed')->value('isAllowed');
			$Fun50 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','50')->select('isAllowed')->value('isAllowed');
			$Fun51 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','51')->select('isAllowed')->value('isAllowed');
			$Fun52 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','52')->select('isAllowed')->value('isAllowed');
			$Fun53 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','53')->select('isAllowed')->value('isAllowed');
			$Fun54 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','54')->select('isAllowed')->value('isAllowed');
			$Fun55 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','55')->select('isAllowed')->value('isAllowed');
			$Fun56 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','56')->select('isAllowed')->value('isAllowed');
			$Fun57 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','57')->select('isAllowed')->value('isAllowed');
			$Fun58 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','58')->select('isAllowed')->value('isAllowed');
			$Fun59 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','59')->select('isAllowed')->value('isAllowed');
			$Fun60 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','60')->select('isAllowed')->value('isAllowed');
			$Fun61 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','61')->select('isAllowed')->value('isAllowed');
			$Fun62 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','62')->select('isAllowed')->value('isAllowed');
			$Fun63 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','63')->select('isAllowed')->value('isAllowed');
			$Fun64 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','64')->select('isAllowed')->value('isAllowed');
			$Fun65 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','65')->select('isAllowed')->value('isAllowed');
			$Fun66 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','66')->select('isAllowed')->value('isAllowed');
			$Fun67 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','67')->select('isAllowed')->value('isAllowed');
			$Fun68 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','68')->select('isAllowed')->value('isAllowed');
			$Fun69 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','69')->select('isAllowed')->value('isAllowed');
			$Fun70 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','70')->select('isAllowed')->value('isAllowed');
			$Fun71 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','71')->select('isAllowed')->value('isAllowed');
			$Fun72 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','72')->select('isAllowed')->value('isAllowed');
			$Fun73 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','73')->select('isAllowed')->value('isAllowed');
			$Fun74 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','74')->select('isAllowed')->value('isAllowed');
			$Fun75 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','75')->select('isAllowed')->value('isAllowed');
			$Fun76 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','76')->select('isAllowed')->value('isAllowed');
			$Fun77 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','77')->select('isAllowed')->value('isAllowed');
			$Fun78 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','78')->select('isAllowed')->value('isAllowed');
			$Fun79 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','79')->select('isAllowed')->value('isAllowed');
			$Fun80 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','80')->select('isAllowed')->value('isAllowed');
			$Fun81 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','81')->select('isAllowed')->value('isAllowed');
			$Fun82 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','82')->select('isAllowed')->value('isAllowed');
			$Fun83 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','83')->select('isAllowed')->value('isAllowed');
			$Fun84 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','84')->select('isAllowed')->value('isAllowed');
			$Fun85 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','85')->select('isAllowed')->value('isAllowed');
			$Fun86 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','86')->select('isAllowed')->value('isAllowed');
			$Fun87 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','87')->select('isAllowed')->value('isAllowed');
			$Fun88 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','88')->select('isAllowed')->value('isAllowed');
			$Fun89 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','89')->select('isAllowed')->value('isAllowed');
			$Fun90 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','86')->select('isAllowed')->value('isAllowed');
			$Fun91 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','87')->select('isAllowed')->value('isAllowed');
			$Fun92 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','88')->select('isAllowed')->value('isAllowed');
			$Fun93 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','89')->select('isAllowed')->value('isAllowed');
			$Fun94 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','94')->select('isAllowed')->value('isAllowed');
			$Fun95 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','95')->select('isAllowed')->value('isAllowed');
			$Fun96 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','96')->select('isAllowed')->value('isAllowed');
			$Fun97 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','97')->select('isAllowed')->value('isAllowed');
			$Fun98 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','98')->select('isAllowed')->value('isAllowed');
			$Fun99 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','99')->select('isAllowed')->value('isAllowed');
			$Fun100 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','100')->select('isAllowed')->value('isAllowed');
			$Fun101 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','101')->select('isAllowed')->value('isAllowed');
			$Fun102 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','102')->select('isAllowed')->value('isAllowed');
			$Fun103 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','103')->select('isAllowed')->value('isAllowed');
			$Fun104 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','104')->select('isAllowed')->value('isAllowed');
			$Fun105 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','105')->select('isAllowed')->value('isAllowed');
			$Fun106 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','106')->select('isAllowed')->value('isAllowed');
			$Fun107 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','107')->select('isAllowed')->value('isAllowed');
			$Fun108 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','108')->select('isAllowed')->value('isAllowed');
			$Fun109 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','109')->select('isAllowed')->value('isAllowed');
			$Fun110 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','110')->select('isAllowed')->value('isAllowed');
			$Fun111 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','111')->select('isAllowed')->value('isAllowed');
			$Fun112 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','112')->select('isAllowed')->value('isAllowed');
			$Fun113 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','113')->select('isAllowed')->value('isAllowed');
			$Fun114 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','114')->select('isAllowed')->value('isAllowed');
			$Fun115 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','115')->select('isAllowed')->value('isAllowed');
			$Fun116 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','116')->select('isAllowed')->value('isAllowed');
			$Fun117 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','117')->select('isAllowed')->value('isAllowed');
			$Fun118 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','118')->select('isAllowed')->value('isAllowed');
			$Fun119 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','119')->select('isAllowed')->value('isAllowed');
			$Fun120 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','120')->select('isAllowed')->value('isAllowed');
			$Fun121 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','121')->select('isAllowed')->value('isAllowed');
			$Fun122 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','122')->select('isAllowed')->value('isAllowed');
			$Fun123 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','123')->select('isAllowed')->value('isAllowed');
			$Fun124 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','124')->select('isAllowed')->value('isAllowed');
			$Fun125 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','125')->select('isAllowed')->value('isAllowed');
			$Fun126 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','126')->select('isAllowed')->value('isAllowed');
			$Fun127 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','127')->select('isAllowed')->value('isAllowed');
			$Fun128 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','128')->select('isAllowed')->value('isAllowed');
			$Fun129 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','129')->select('isAllowed')->value('isAllowed');
			$Fun130 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','130')->select('isAllowed')->value('isAllowed');
			$Fun131 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','131')->select('isAllowed')->value('isAllowed');
			$Fun132 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','132')->select('isAllowed')->value('isAllowed');
			$Fun133 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','133')->select('isAllowed')->value('isAllowed');
			$Fun134 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','134')->select('isAllowed')->value('isAllowed');
			$Fun135 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','135')->select('isAllowed')->value('isAllowed');
			$Fun136 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','136')->select('isAllowed')->value('isAllowed');
			$Fun137 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','137')->select('isAllowed')->value('isAllowed');
			$Fun138 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','138')->select('isAllowed')->value('isAllowed');
			$Fun139 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','139')->select('isAllowed')->value('isAllowed');
			$Fun140 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','140')->select('isAllowed')->value('isAllowed');
			$Fun141 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','141')->select('isAllowed')->value('isAllowed');
			$Fun142 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','142')->select('isAllowed')->value('isAllowed');
			$Fun143 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','143')->select('isAllowed')->value('isAllowed');
			$Fun144 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','144')->select('isAllowed')->value('isAllowed');
			$Fun145 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','145')->select('isAllowed')->value('isAllowed');
			$Fun146 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','146')->select('isAllowed')->value('isAllowed');
			$Fun147 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','147')->select('isAllowed')->value('isAllowed');
			$Fun148 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','148')->select('isAllowed')->value('isAllowed');
			$Fun149 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','149')->select('isAllowed')->value('isAllowed');
			$Fun150 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','150')->select('isAllowed')->value('isAllowed');
			$Fun151 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','151')->select('isAllowed')->value('isAllowed');
			$Fun152 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','152')->select('isAllowed')->value('isAllowed');
			$Fun153 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','153')->select('isAllowed')->value('isAllowed');
			$Fun154 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','154')->select('isAllowed')->value('isAllowed');
			$Fun155 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','155')->select('isAllowed')->value('isAllowed');
			$Fun156 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','156')->select('isAllowed')->value('isAllowed');
			$Fun157 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','157')->select('isAllowed')->value('isAllowed');
			$Fun158 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','158')->select('isAllowed')->value('isAllowed');
			$Fun159 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','159')->select('isAllowed')->value('isAllowed');
			$Fun160 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','160')->select('isAllowed')->value('isAllowed');
			$Fun161 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','161')->select('isAllowed')->value('isAllowed');
			$Fun162 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','162')->select('isAllowed')->value('isAllowed');
			$Fun163 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','163')->select('isAllowed')->value('isAllowed');
			$Fun164 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','164')->select('isAllowed')->value('isAllowed');
			$Fun165 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','165')->select('isAllowed')->value('isAllowed');
			$Fun166 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','166')->select('isAllowed')->value('isAllowed');
			$Fun167 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','167')->select('isAllowed')->value('isAllowed');
			$Fun168 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','168')->select('isAllowed')->value('isAllowed');
			$Fun169 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','169')->select('isAllowed')->value('isAllowed');
			$Fun170 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','170')->select('isAllowed')->value('isAllowed');
			$Fun171 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','171')->select('isAllowed')->value('isAllowed');
			$Fun172 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','172')->select('isAllowed')->value('isAllowed');
			$Fun173 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','173')->select('isAllowed')->value('isAllowed');
			$Fun174 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','174')->select('isAllowed')->value('isAllowed');
			$Fun175 = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','175')->select('isAllowed')->value('isAllowed');

			//$Fun = DB::table('role__allocations')->where('Role_Id','=',$id)->where('Fun_Id','=','')->select('isAllowed')->value('isAllowed');

            return view('role_allocation_edit')->with(['RollAllo' => $user,
                'roll' => $Roll,'fun1'=>$Fun1,
				'fun2'=>$Fun2,
				'Fun3'=>$Fun3,
				'Fun4'=>$Fun4,
				'Fun5'=>$Fun5,
				'Fun6'=>$Fun6,
				'Fun7'=>$Fun7,
				'Fun8'=>$Fun8,
				'Fun9'=>$Fun9,
				'Fun10'=>$Fun10,
				'Fun11'=>$Fun11,
				'Fun12'=>$Fun12,
				'Fun13'=>$Fun13,
				'Fun14'=>$Fun14,
				'Fun15'=>$Fun15,
				'Fun16'=>$Fun16,
				'Fun17'=>$Fun17,
				'Fun18'=>$Fun18,
				'Fun19'=>$Fun19,
				'Fun20'=>$Fun20,
				'Fun21'=>$Fun21,
				'Fun22'=>$Fun22,
				'Fun23'=>$Fun23,
				'Fun24'=>$Fun24,
				'Fun25'=>$Fun25,
				'Fun26'=>$Fun26,
				'Fun27'=>$Fun27,
				'Fun28'=>$Fun28,
				'Fun29'=>$Fun29,
				'Fun30'=>$Fun30,
				'Fun31'=>$Fun31,
				'Fun32'=>$Fun32,
				'Fun33'=>$Fun33,
				'Fun34'=>$Fun34,
				'Fun35'=>$Fun35,
				'Fun36'=>$Fun36,
				'Fun37'=>$Fun37,
				'Fun38'=>$Fun38,
				'Fun39'=>$Fun39,
				'Fun40'=>$Fun40,
				'Fun41'=>$Fun41,
				'Fun42'=>$Fun42,
				'Fun43'=>$Fun43,
				'Fun44'=>$Fun44,
				'Fun45'=>$Fun45,
				'Fun46'=>$Fun46,
				'Fun47'=>$Fun47,
				'Fun48'=>$Fun48,
				'Fun49'=>$Fun49,
				'Fun50'=>$Fun50,
				'Fun51'=>$Fun51,
				'Fun52'=>$Fun52,
				'Fun53'=>$Fun53,
				'Fun54'=>$Fun54,
				'Fun55'=>$Fun55,
				'Fun56'=>$Fun56,
				'Fun57'=>$Fun57,
				'Fun58'=>$Fun58,
				'Fun59'=>$Fun59,
				'Fun60'=>$Fun60,
				'Fun61'=>$Fun61,
				'Fun62'=>$Fun62,
				'Fun63'=>$Fun63,
				'Fun64'=>$Fun64,
				'Fun65'=>$Fun65,
				'Fun66'=>$Fun66,
				'Fun67'=>$Fun67,
				'Fun68'=>$Fun68,
				'Fun69'=>$Fun69,
				'Fun70'=>$Fun70,
				'Fun71'=>$Fun71,
				'Fun72'=>$Fun72,
				'Fun73'=>$Fun73,
				'Fun74'=>$Fun74,
				'Fun75'=>$Fun75,
				'Fun76'=>$Fun76,
				'Fun77'=>$Fun77,
				'Fun78'=>$Fun78,
				'Fun79'=>$Fun79,
				'Fun80'=>$Fun80,
				'Fun81'=>$Fun81,
				'Fun82'=>$Fun82,
				'Fun83'=>$Fun83,
				'Fun84'=>$Fun84,
				'Fun85'=>$Fun85,
				'Fun86'=>$Fun86,
				'Fun87'=>$Fun87,
				'Fun88'=>$Fun88,
				'Fun89'=>$Fun89,
				'Fun90'=>$Fun90,
				'Fun91'=>$Fun91,
				'Fun92'=>$Fun92,
				'Fun93'=>$Fun93,
				'Fun94'=>$Fun94,
				'Fun95'=>$Fun95,
				'Fun96'=>$Fun96,
				'Fun97'=>$Fun97,
				'Fun98'=>$Fun98,
				'Fun99'=>$Fun99,
				'Fun100'=>$Fun100,
				'Fun101'=>$Fun101,
				'Fun102'=>$Fun102,
				'Fun103'=>$Fun103,
				'Fun104'=>$Fun104,
				'Fun105'=>$Fun105,
				'Fun106'=>$Fun106,
				'Fun107'=>$Fun107,
				'Fun108'=>$Fun108,
				'Fun109'=>$Fun109,
				'Fun110'=>$Fun110,
				'Fun111'=>$Fun111,
				'Fun112'=>$Fun112,
				'Fun113'=>$Fun113,
				'Fun114'=>$Fun114,
				'Fun115'=>$Fun115,
				'Fun116'=>$Fun116,
				'Fun117'=>$Fun117,
				'Fun118'=>$Fun118,
				'Fun119'=>$Fun119,
				'Fun120'=>$Fun120,
				'Fun121'=>$Fun121,
				'Fun122'=>$Fun122,
				'Fun123'=>$Fun123,
				'Fun124'=>$Fun124,
				'Fun125'=>$Fun125,
				'Fun126'=>$Fun126,
				'Fun127'=>$Fun127,
				'Fun128'=>$Fun128,
				'Fun129'=>$Fun129,
				'Fun130'=>$Fun130,
				'Fun131'=>$Fun131,
				'Fun132'=>$Fun132,
				'Fun133'=>$Fun133,
				'Fun134'=>$Fun134,
				'Fun135'=>$Fun135,
				'Fun136'=>$Fun136,
				'Fun137'=>$Fun137,
				'Fun138'=>$Fun138,
				'Fun139'=>$Fun139,
				'Fun140'=>$Fun140,
				'Fun141'=>$Fun141,
				'Fun142'=>$Fun142,
				'Fun143'=>$Fun143,
				'Fun144'=>$Fun144,
				'Fun145'=>$Fun145,
				'Fun146'=>$Fun146,
				'Fun147'=>$Fun147,
				'Fun148'=>$Fun148,
				'Fun149'=>$Fun149,
				'Fun150'=>$Fun150,
				'Fun151'=>$Fun151,
				'Fun152'=>$Fun152,
				'Fun153'=>$Fun153,
				'Fun154'=>$Fun154,
				'Fun155'=>$Fun155,
				'Fun156'=>$Fun156,
				'Fun157'=>$Fun157,
				'Fun158'=>$Fun158,
				'Fun159'=>$Fun159,
				'Fun160'=>$Fun160,
				'Fun161'=>$Fun161,
				'Fun162'=>$Fun162,
				'Fun163'=>$Fun163,
				'Fun164'=>$Fun164,
				'Fun165'=>$Fun165,
				'Fun166'=>$Fun166,
				'Fun167'=>$Fun167,
				'Fun168'=>$Fun168,
				'Fun169'=>$Fun169,
				'Fun170'=>$Fun170,
				'Fun171'=>$Fun171,
				'Fun172'=>$Fun172,
				'Fun173'=>$Fun173,
				'Fun174'=>$Fun174,
				'Fun175'=>$Fun175
            ]);

        } catch (Exception $e) {




            return view('excaption');

        }

    }

    //this for edit  role allocation

    public function edit_Role_Allocation(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_raID == -1 || $request->txt_raID == null) {


            return redirect('AddRoleAlloct')->with('error', 'Role Name Not Selected');

        } else {
            try {

				$sql = DB::table('role__allocations')
					->where('Role_Id','=',$request->txt_raID)
					->delete();

                $func = DB::table('functionmasters')
					->get();
				foreach($func as $f)
				{
					$chk='chk' . $f->id;
					if($request->has($chk)) {

						$obj = DB::table('role__allocations')
							->insert(['isAllowed' => 1,
								'Role_Id' => $request->txt_raID,
								'Fun_Id' => $f->id,
								'Created_By' => session()->get('user_id'),
								'created_at' => $current_time

							]);


					}
					else {
						$obj = DB::table('role__allocations')
							->insert(['isAllowed' => 0,
								'Role_Id' => $request->txt_raID,
								'Fun_Id' => $f->id,
								'Created_By' => session()->get('user_id'),
								'created_at' => $current_time

							]);
					}
				}




                return redirect('ListRoleAlloct');


            } catch (Exception $e) {


				//return $e->getMessage();
                return view('excaption');

            }



        }


    }

    //add Role Allocation

    public function AddRoleAllocation()
    {
        try {
            $roll = DB::table('role_masters')
                ->select('role_masters.Role_Id', 'role_masters.Role_Name')
                ->where('role_masters.Enabled', '=', '0')
				->orderBy('Role_Name')
                ->get();

            return view('role_allocation_add')->with(
                'rolls', $roll);


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }

    }

    /*end role allocation*/

    /*start daily performance card*/

    //this for list Daily performance card

    public function get_all_DailyPerformanceCard()
    {
        try {
            $dailyper = DB::table('daily__performance__cards')
                ->join('employee_masters', 'employee_masters.emp_id', '=',
                    'daily__performance__cards.Emp_ID')
                ->join('topic_evaluation_masters', 'topic_evaluation_masters.Topic_Eval_Id', '=',
                    'daily__performance__cards.Topic_Eval_ID')
                ->select('daily__performance__cards.*', 'employee_masters.emp_name',
                    'topic_evaluation_masters.Evaluation_Description')
                ->where('daily__performance__cards.Enabled', '=', '0')
                ->get();

            return view('daily_performance_card_list')->with('dailyperfom', $dailyper);


        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }


    }

    //this for store Daily performance card

    public function store_DailyPerformanceCard(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_empid == -1 || $request->txt_empid == null) {

            return redirect()->back()->withInput()->with('error', 'Employee Name Not Selectd');

        } else if ($request->txt_topicevlid == -1 || $request->txt_topicevlid == null) {

            return redirect()->back()->withInput()->with('error', 'Topic Evaluation Description Not Selected');


        } else {
            try {


                $obj = DB::table('daily__performance__cards')
                    ->insert(['Date' => $request->dt_date,
                        'Emp_ID' => $request->txt_empid,
                        'Topic_Eval_ID' => $request->txt_topicevlid,
                        'Test_Score' => $request->txt_testscore,
                        'Test_status' => $request->txt_teststatus,
                        'Demo_Score' => $request->txt_demoscore != null ? $request->txt_demoscore : '',
                        'Demo_status' => $request->txt_demostatus != null ? $request->txt_demostatus : '',
                        'Time_spent_on_Topic' => $request->txt_TimeStmpOnTopic != null ? $request->txt_TimeStmpOnTopic : '',
                        'Average_Demo_score' => $request->txt_AvgDemoScore != null ? $request->txt_AvgDemoScore : '',
                        'Average_test_score' => $request->txt_AvgTestScore != null ? $request->txt_AvgTestScore : '',
                        'No_Of_topics_Completed' => $request->txt_NoOfTopicCompleted != null ? $request->txt_NoOfTopicCompleted : '',
                        'No_Of_topics_Certified' => $request->txt_NoOfTopicCertified != null ? $request->txt_NoOfTopicCertified : '',
                        'Trainer_Productivity' => $request->txt_TrainerProductivity != null ? $request->txt_TrainerProductivity : '',
                        'No_Of_assessment_Cleared' => $request->txt_NoOfAssessmentCleared != null ? $request->txt_NoOfAssessmentCleared : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('ListDailyPerCard');


            } catch (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }

        }
    }

    //this destroy for Daily performance card

    public function destroy_DailyPerformanceCard(Request $request)
    {
        try {

            $user = DB::table('daily__performance__cards')->where('Daily_performance_Card_ID',
                '=', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }
            // return redirect('DeparmentList')->with('success',"Delete Record Successfully");


        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }
    }

    //this for show Daily performance card

    public function show_DailyPerformanceCard($id)
    {
        try {

            $user = DB::table('daily__performance__cards')->where('Daily_performance_Card_ID',
                '=', $id)->first();

            $employee = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
				->orderBy('emp_name')
                ->get();

            $topiceval = DB::table('topic_evaluation_masters')
                ->select('topic_evaluation_masters.Topic_Eval_Id', 'topic_evaluation_masters.Evaluation_Description')
                ->where('topic_evaluation_masters.Enabled', '=', '0')
				->orderBy('Evaluation_Description')
                ->get();


            return view('daily_performance_card_edit')->with(['dailypermcard' => $user,
                'employee' => $employee,
                'TopicEvl' => $topiceval]);

        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }

    }

    //this for edit  Daily performance card

    public function edit_DailyPerformanceCard(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_empid == -1 || $request->txt_empid == null) {

            return redirect()->back()->withInput()->with('error', 'Employee Name Not Selectd');

        } else if ($request->txt_topicevlid == -1 || $request->txt_topicevlid == null) {

            return redirect()->back()->withInput()->with('error', 'Topic Evaluation Description Not Selected');


        } else {
            try {

                $obj = DB::table('daily__performance__cards')
                    ->where('Daily_performance_Card_ID', $request->txt_dpid)
                    ->update(['Date' => $request->dt_date,
                        'Emp_ID' => $request->txt_empid,
                        'Topic_Eval_ID' => $request->txt_topicevlid,
                        'Test_Score' => $request->txt_testscore,
                        'Test_status' => $request->txt_teststatus,
                        'Demo_Score' => $request->txt_demoscore != null ? $request->txt_demoscore : '',
                        'Demo_status' => $request->txt_demostatus != null ? $request->txt_demostatus : '',
                        'Time_spent_on_Topic' => $request->txt_TimeStmpOnTopic != null ? $request->txt_TimeStmpOnTopic : '',
                        'Average_Demo_score' => $request->txt_AvgDemoScore != null ? $request->txt_AvgDemoScore : '',
                        'Average_test_score' => $request->txt_AvgTestScore != null ? $request->txt_AvgTestScore : '',
                        'No_Of_topics_Completed' => $request->txt_NoOfTopicCompleted != null ? $request->txt_NoOfTopicCompleted : '',
                        'No_Of_topics_Certified' => $request->txt_NoOfTopicCertified != null ? $request->txt_NoOfTopicCertified : '',
                        'Trainer_Productivity' => $request->txt_TrainerProductivity != null ? $request->txt_TrainerProductivity : '',
                        'No_Of_assessment_Cleared' => $request->txt_NoOfAssessmentCleared != null ? $request->txt_NoOfAssessmentCleared : '',
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('ListDailyPerCard')->with('success', "Record Updated Successfully");


            } catch (Exception $e) {


                // return $e->getMessage();

                return view('excaption');

            }

        }
    }

    public function AddDailyPerformance()
    {

        try {
            $employee = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
				->orderBy('emp_name')
                ->get();

            $TopicEval = DB::table('topic_evaluation_masters')
                ->select('topic_evaluation_masters.Topic_Eval_Id', 'topic_evaluation_masters.Evaluation_Description')
                ->where('topic_evaluation_masters.Enabled', '=', '0')
				->orderBy('Evaluation_Description')
                ->get();


            return view('daily_performance_card_add')->with([
                'employee' => $employee,
                'topiceval' => $TopicEval,
            ]);


        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }
    }

    /*end daily performance card*/


    /*start user role*/

    //this for list user role

    public function getall_user_role()
    {
        try {
            $obj = DB::table('user__roles')
                ->join('login_masters', 'user__roles.User_Id', '=',
                    'login_masters.UserId')
                ->join('role_masters', 'user__roles.Role_Id', '=',
                    'role_masters.Role_Id')
                ->select('user__roles.*', 'login_masters.Email',
                    'role_masters.Role_Name','login_masters.Phone_No')
                ->where('user__roles.Enabled', '=', '0')
                ->get();

            return view('user_role_list')->with(['useroll' => $obj]);


        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }
    }

    //this for store user role

    public function store_user_role(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_userid == -1 || $request->txt_userid == null) {


            return redirect('AddUserRole')->with('error', 'User  Not Selectd');

        } else if ($request->txt_roleid == -1 || $request->txt_roleid == null) {

            return redirect('AddUserRole')->with('error', 'Role  Not Selected');


        } else {
            try {

                $role = DB::table('user__roles')
                    ->select('user__roles.Role_Id')
                    ->where('user__roles.User_Id', '=', $request->txt_userid)
                    ->where('user__roles.Enabled', '=', '0')

                    ->get()->count();


                if ($role > 0) {

                    return redirect()->back()->withInput()
                        ->with('error', 'This user already assign another Role ');

                } else {
                    $obj = DB::table('user__roles')
                        ->insert(['User_Id' => $request->txt_userid,
                            'Role_Id' => $request->txt_roleid != null ? $request->txt_roleid : '',
                            'Created_By' => session()->get('user_id'),
                            'created_at' => $current_time

                        ]);


                    return redirect('ListUserRole');


                }


            } catch (Exception $e) {


                // return $e->getMessage();

                return view('excaption');

            }

        }


    }

    //this for destroy user role

    public function destroy_user_role(Request $request)
    {
        try {

            $user = DB::table('user__roles')->where('ID', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }
            // return redirect('DeparmentList')->with('success',"Delete Record Successfully");


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }
    }

    //this for show user role

    public function show_user_role($id)
    {
        try {

            $user = DB::table('user__roles')->where('ID', '=', $id)->first();

            $users = DB::table('login_masters')
                ->select(DB::raw('CONCAT(login_masters.Email, " - ",
                 login_masters.Phone_No) as name'), 'login_masters.UserId')
                ->where('login_masters.Enabled', '=', '0')
				->orderBy('login_masters.Email')
                ->get();

            $rolls = DB::table('role_masters')
                ->select('role_masters.Role_Id', 'role_masters.Role_Name')
                ->where('role_masters.Enabled', '=', '0')
				->orderBy('Role_Name')
                ->get();

            return view('user_role_edit')->with(['UserRoll' => $user, 'rolls' => $rolls, 'users' => $users]);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }
    }

    //thos for show user roel update

    public function edit_user_role(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_userid == -1 || $request->txt_userid == null) {


            return redirect('AddUserRole')->with('error', 'User  Not Selectd');

        } else if ($request->txt_roleid == -1 || $request->txt_roleid == null) {

            return redirect('AddUserRole')->with('error', 'Role  Not Selected');


        } else {
            try {

                /*$role = DB::table('user__roles')
                    ->select('user__roles.Role_Id')
                    ->where('user__roles.Role_Id', '=', $request->txt_roleid)
                    ->where('user__roles.User_Id','<>',$request->txt_userid)
                    ->where('user__roles.Enabled', '=', '0')
                    ->get()->count();*/



                    $obj = DB::table('user__roles')->where('ID', $request->txt_id)
                        ->update(['User_Id' => $request->txt_userid,
                            'Role_Id' => $request->txt_roleid,
                            'LastUpdated_By' => session()->get('user_id'),
                            'created_at' => $current_time

                        ]);


                    return redirect('ListUserRole');





            } catch (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }

        }


    }


    //add user role

    public function AddUserRole()
    {
        try {
            $user = DB::table('login_masters')
                ->select(DB::raw('CONCAT(login_masters.Email, " - ",
                 login_masters.Phone_No) as name'), 'login_masters.UserId')
                ->where('login_masters.Enabled', '=', '0')
				->orderBy('login_masters.Email')
                ->get();

            $roll = DB::table('role_masters')
                ->select('role_masters.Role_Id', 'role_masters.Role_Name')
                ->where('role_masters.Enabled', '=', '0')
				->orderBy('Role_Name')
                ->get();

            return view('user_role_add')->with([
                'user' => $user,
                'roll' => $roll]);


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }
    }

    /*end user role*/


    /*start student feedback*/

    public function get_allstudent_feedback()
    {
        try {


            $studfedback = DB::table('student_feedback')
                ->join('collage_masters', 'collage_masters.collage_id',
                    '=', 'student_feedback.College_ID')
                ->join('employee_masters', 'employee_masters.emp_id',
                    '=', 'student_feedback.Emp_ID')
                ->join('student_masters', 'student_masters.student_id',
                    '=', 'student_feedback.Student_ID')
                ->join('skill_masters', 'skill_masters.skill_id',
                    '=', 'student_feedback.Skill_ID')
                ->select('student_feedback.*', 'collage_masters.collage_name',
                    'employee_masters.emp_name', 'student_masters.student_name', 'skill_masters.skill_name')
                ->where('student_feedback.Enabled', '=', '0')
                ->get();

            return view('student_feedback_list')->with('studfeedback', $studfedback);


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }


    }

    //this for store student feedback

    public function store_student_feedback(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        if ($request->txt_clgid == -1 || $request->txt_clgid == null) {


            return redirect()->back()->withInput()->with('error', 'College  Not Selectd');

        } else if ($request->txt_empid == -1 || $request->txt_empid == null) {

            return redirect()->back()->withInput()->with('error', 'Employee  Not Selected');

        } else if ($request->txt_studid == -1 || $request->txt_studid == null) {

            return redirect()->back()->withInput()->with('error', 'Student  Not Selected');

        } else {

            try {


                $obj = DB::table('student_feedback')
                    ->insert(['College_ID' => $request->txt_clgid,
                        'Emp_ID' => $request->txt_empid,
                        'Student_ID' => $request->txt_studid,
                        'Feedback_Date' => $request->dt_fedbkdate,
                        'Rating' => $request->txt_rating,
                        'Skill_ID' => $request->txt_skillid,
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time


                    ]);

                return redirect('StudFedbkList');


            } catch (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }

        }

    }

    //this destroy for student feedback

    public function destroy_student_feedback(Request $request)
    {
        try {

            $stdfdback = DB::table('student_feedback')->where('Feedback_ID', $request->id)->update(['Enabled' => 1]);

            if ($stdfdback) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    //this for show student feedback

    public function show_student_feedback($id)
    {
        try {

            $stdfdback = DB::table('student_feedback')->where('Feedback_ID', '=', $id)->first();

            $collage = DB::table('collage_masters')
                ->select(DB::raw('CONCAT(collage_name, " - ", region , " - ", spoc) as name'),
                    'collage_id as collage_id')
                ->where('collage_masters.Enabled', '=', '0')
				->orderBy('collage_name')
                ->get();

            $employee = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
				->orderBy('emp_name')
                ->get();

            $student = DB::table('student_masters')
                ->select('student_masters.student_name', 'student_masters.student_id')
                ->where('student_masters.Enabled', '=', '0')
				->orderBy('student_name')
                ->get();

            $skill = DB::table('skill_masters')
                ->select('skill_masters.skill_id', 'skill_masters.skill_name')
                ->where('skill_masters.Enabled', '=', '0')
				->orderBy('skill_name')
                ->get();


            return view('student_feedback_edit')->with([
                'studfeedbk' => $stdfdback,
                'collage' => $collage,
                'employee' => $employee,
                'student' => $student,
                'skill' => $skill]);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    //this for edit  student feedback

    public function edit_student_feedback(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();
        if ($request->txt_clgid == -1 || $request->txt_clgid == null) {

            return redirect()->back()->with('error', 'College  Not Selectd');

        } else if ($request->txt_empid == -1 || $request->txt_empid == null) {

            return redirect()->back()->with('error', 'Employee  Not Selected');

        } else if ($request->txt_studid == -1 || $request->txt_studid == null) {

            return redirect()->back()->with('error', 'Student  Not Selected');

        } else {

            try {


                $stdfdback = DB::table('student_feedback')->where('Feedback_ID',
                    '=', $request->txt_sfid)
                    ->update(['College_ID' => $request->txt_clgid,
                        'Emp_ID' => $request->txt_empid,
                        'Student_ID' => $request->txt_studid,
                        'Feedback_Date' => $request->dt_fedbkdate,
                        'Rating' => $request->txt_rating,
                        'Skill_ID' => $request->txt_skillid,
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time


                    ]);

                return redirect('StudFedbkList')->with('success', "Record Updated Successfully");

            } catch (Exception $e) {


                //   return $e->getMessage();

                return view('excaption');

            }

        }

    }

    public function AddStudentFeedback()
    {

        try {
            $collage = DB::table('collage_masters')
                ->select(DB::raw('CONCAT(collage_name, " - ", region , " - ", spoc) as name'),
                    'collage_id as collage_id')
                ->where('collage_masters.Enabled', '=', '0')
				->orderBy('collage_name')
                ->get();

            $employee = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
				->orderBy('emp_name')
                ->get();

            $student = DB::table('student_masters')
                ->select('student_masters.student_name', 'student_masters.student_id')
                ->where('student_masters.Enabled', '=', '0')
				->orderBy('student_name')
                ->get();

            $skill = DB::table('skill_masters')
                ->select('skill_masters.skill_id', 'skill_masters.skill_name')
                ->where('skill_masters.Enabled', '=', '0')
				->orderBy('skill_name')
                ->get();


            return view('student_feedback_add')->with([
                'collages' => $collage,
                'employees' => $employee,
                'students' => $student,
                'skills' => $skill]);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }
    }


    /*end student feesdback*/

    public function opencollegeReport()
    {

        $data = null;

        return view('collage_report')->with(['data' => $data, 'start_date' => null, 'end_date' => null]);

    }


    public function getCollegeReport(Request $request)
    {
        try {

            $data = null;
            if ($request->txt_enddate < $request->txt_startdate) {

                return view('collage_report')->with(['data' => $data,
                    'start_date' => $request->txt_startdate, 'end_date' => $request->txt_enddate]);

            } else {

                $data = DB::table('placement__drives')
                    ->leftJoin('collage_masters', 'collage_masters.collage_id', '=', 'placement__drives.College_Id')
                    ->select('collage_masters.collage_id', 'collage_masters.collage_name', 'placement__drives.*')
                    ->whereBetween('placement__drives.Drive_Date', [$request->txt_startdate, $request->txt_enddate])
                    ->get();

                //dd($data);

                return view('collage_report')->with(['data' => $data, 'start_date' => $request->txt_startdate, 'end_date' => $request->txt_enddate]);

            }


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }


    }


    public function getPlacementRatingStudentwise(Request $request)
    {

        $College_Id=$request->txt_collage;
        $data = DB::table('student_masters')
            ->select('student_masters.registration_number',
                'student_masters.collage_id',
                'student_masters.student_name',
                'student_masters.branch',
                'student_masters.primary_skill',
                'student_masters.overall_score',
                'student_masters.aptitude_score',
                'student_masters.verbal_ability_score',
                'student_masters.technical_mcq_score',
                'student_masters.programing_score',
                'student_masters.demo_topic',
                'student_masters.confidance_score',
                'student_masters.communication_score',
                'student_masters.presentation_score',
                'student_masters.clarity_score',
                'student_masters.creativity_score',
                'student_masters.demo_status',
                'student_masters.subject_knowledge',
                'student_masters.clarity',
                'student_masters.domain_remark',
                'student_masters.domain_status',
                'student_masters.role_clarity',
                'student_masters.overall_fitment',
                'student_masters.final_status'
            )
            ->when($College_Id<>0, function ($q)  use ($College_Id) {
                return $q->where('student_masters.collage_id', '=', $College_Id);
            })
            ->get();

        //dd($data);


        $collage = DB::table('collage_masters')
            ->select('collage_masters.collage_id',
                'collage_masters.collage_name'
            )
            ->get();

        //$items = Items::all(['collage_name']);

        return view('placement_ratings_studentwise')->with(['data' => $data,
            'collleges' => $collage, 'collage_i' => $request->txt_collage]);
    }


    public function openPlacementRatingStudentwise()
    {

        try {
            $collage = DB::table('collage_masters')
                ->select('collage_masters.collage_id',
                    'collage_masters.collage_name'
                )
                ->get();

            $data = null;
            $collage_id = null;

            return view('placement_ratings_studentwise')
                ->with(['data' => $data,
                    'collleges' => $collage,
                    'collage_i' => $collage_id
                ]);


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }


    }


    public function openEmployee_Search()
    {

        try {

            $skills = DB::table('skill_masters')
                ->select('skill_masters.skill_id', 'skill_masters.skill_name')
                ->get();


            $data = null;
            $start_date = null;

            $end_date = null;
            $available = false;

            $qualification = null;

            $primaryskill = null;
            return view('employee_search_report')->with(['data' => $data, 'skills' => $skills, 'start_date' => $start_date, 'end_date' => $end_date, 'available' => $available, 'qualification' => $qualification, 'primary_skill' => $primaryskill]);


        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }


    }

    public function getEmployee_Search(Request $request)
    {
        DB::connection()->enableQueryLog();
        try {
            $primaryskill = trim($request->txt_primaryskill);
            $start_date = trim($request->txt_startdate);
            $end_date = trim($request->txt_enddate);
            $available = $request->has('txt_available');
            $qualification = trim($request->txt_qualification);


            $skills = DB::table('skill_masters')
                ->select('skill_masters.skill_id', 'skill_masters.skill_name')
                ->get();


            $d1 = DB::table('employee_masters')
                ->leftJoin('designation_masters', 'employee_masters.designation_id', '=', 'designation_masters.designation_id')
                ->leftjoin('skill_masters as s1', 'employee_masters.primary_skill', '=', 's1.skill_id')
                ->leftjoin('skill_masters as s2', 'employee_masters.secondary_skill', '=', 's2.skill_id')
                ->leftJoin('department_masters', 'employee_masters.department_id', '=', 'department_masters.department_id')
                ->leftJoin('emp__qualifications', 'employee_masters.emp_id', '=', 'emp__qualifications.Emp_Id')
                ->leftJoin('course_transactions', 'employee_masters.emp_id', '=', 'course_transactions.Emp_Id')
                ->when(request('txt_primaryskill', false), function ($q) use ($primaryskill) {
                    return $q->where('employee_masters.primary_skill', $primaryskill);
                })
                ->when(request('txt_available', false), function ($q) use ($start_date, $end_date) {

                    return $q->whereNotBetween('course_transactions.Start_Date', [$start_date, $end_date])
                        ->whereNotBetween('course_transactions.End_Date', [$start_date, $end_date])
                        ->orWhere(function ($query) use ($start_date, $end_date) {

                            return $query->where('course_transactions.Start_Date', '<', $start_date)
                                ->where('course_transactions.End_Date', '>', $end_date);
                        });


                })
                ->when(request('txt_qualification', false), function ($q) use ($qualification) {
                    $searchValues = preg_split('/\s+/', $qualification, -1, PREG_SPLIT_NO_EMPTY);
                    $a = null;
                    foreach ($searchValues as $value) {

                        $a[] = $value;

                    }

                    return $q->orWhereIn('emp__qualifications.Qualification_dec', $a);


                })
                ->select('employee_masters.emp_id',
                    'employee_masters.emp_name',
                    'employee_masters.mobile_number',
                    'employee_masters.off_email_id',
                    's1.skill_name as primary_skill',
                    's2.skill_name as secondary_skill',
                    'designation_masters.designation_name',
                    'department_masters.department_name',


                    DB::raw("GROUP_CONCAT(emp__qualifications.Qualification_dec) as qualification")
                )
                ->groupBy('employee_masters.emp_id', 'employee_masters.emp_name', 'employee_masters.mobile_number', 'employee_masters.off_email_id', 's1.skill_name', 's2.skill_name', 'designation_masters.designation_name', 'department_masters.department_name')
                ->get();

            $d2 = null;

            if ($available) {

                $d2 = DB::table('employee_masters')
                    ->leftJoin('designation_masters', 'employee_masters.designation_id', '=', 'designation_masters.designation_id')
                    ->leftjoin('skill_masters as s1', 'employee_masters.primary_skill', '=', 's1.skill_id')
                    ->leftjoin('skill_masters as s2', 'employee_masters.secondary_skill', '=', 's2.skill_id')
                    ->leftJoin('department_masters', 'employee_masters.department_id', '=', 'department_masters.department_id')
                    ->leftJoin('emp__qualifications', 'employee_masters.emp_id', '=', 'emp__qualifications.Emp_Id')
                    ->when(request('txt_primaryskill', false), function ($q) use ($primaryskill) {
                        return $q->where('employee_masters.primary_skill', $primaryskill);
                    })
                    ->when(request('txt_qualification', false), function ($q) use ($qualification) {
                        $searchValues = preg_split('/\s+/', $qualification, -1, PREG_SPLIT_NO_EMPTY);
                        $a = null;
                        foreach ($searchValues as $value) {

                            $a[] = $value;

                        }

                        return $q->orWhereIn('emp__qualifications.Qualification_dec', $a);


                    })
                    ->select('employee_masters.emp_id',
                        'employee_masters.emp_name',
                        'employee_masters.mobile_number',
                        'employee_masters.off_email_id',
                        's1.skill_name as primary_skill',
                        's2.skill_name as secondary_skill',
                        'designation_masters.designation_name',
                        'department_masters.department_name',


                        DB::raw("GROUP_CONCAT(emp__qualifications.Qualification_dec) as qualification")
                    )
                    ->whereNotIn('employee_masters.emp_id', function ($query) {
                        $query->select('Emp_Id')
                            ->from('course_transactions');
                    })
                    ->groupBy('employee_masters.emp_id', 'employee_masters.emp_name', 'employee_masters.mobile_number', 'employee_masters.off_email_id', 's1.skill_name', 's2.skill_name', 'designation_masters.designation_name', 'department_masters.department_name')
                    ->get();


                $data = $d1->merge($d2);

            } else {

                $data = $d1;
            }


            $queries = DB::getQueryLog();

            // dd(end($queries));


            return view('employee_search_report')->with(['data' => $data, 'skills' => $skills, 'start_date' => $start_date, 'end_date' => $end_date, 'available' => $available, 'qualification' => $qualification, 'primary_skill' => $primaryskill]);


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    /*start attendance report*/

    public function openAttendance_Sheet()
    {

        $data = null;

        return view('rpt_attendace_sheet')
            ->with(['data' => $data,
                'start_date' => null,
                'end_date' => null]);

    }


    public function getAttendanceSheet(Request $request)
    {
        try {

            $data = null;

            if ($request->txt_enddate < $request->txt_startdate) {

                return view('rpt_attendace_sheet')
                    ->with(['data' => $data,
                        'start_date' => $request->txt_startdate,
                        'end_date' => $request->txt_enddate]);

            } else {

                $data = DB::table('employee_masters')
                    ->leftJoin('attendances', 'attendances.Emp_id', '=', 'employee_masters.emp_id')
                    ->select('employee_masters.*', 'attendances.*')
                    ->whereBetween('attendances.Date', [$request->txt_startdate, $request->txt_enddate])
                    ->get();

                // dd($data);

                return view('rpt_attendace_sheet')->
                with(['data' => $data, 'start_date' => $request->txt_startdate, 'end_date' => $request->txt_enddate]);

            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    /*end attendance report*/

    /*start performance report*/


    public function getPerformanceReport(Request $request)
    {
        /* $emp = DB::table('employee_masters')
             ->select('employee_masters.emp_id',
                 'employee_masters.emp_name'
             )
             ->get();

         return view('placement_ratings_studentwise')
             ->with([ '$employeess' => $emp, '$employee_i' => $request->txt_employee,
                 '$from_date' => $request->txt_fromdate,
                 '$to_date' => $request->txt_todate]);*/

        try {

            $data = null;
            $emp = DB::table('employee_masters')
                ->select('employee_masters.emp_id',
                    'employee_masters.emp_name'
                )
                ->get();
            if ($request->txt_todate < $request->txt_fromdate) {

                return view('performance_report')->with(['data' => $data,
                    'employeess' => $emp, 'employee_i' => $request->txt_employee,
                    'from_date' => $request->txt_fromdate, 'to_date' => $request->txt_todate]);

            } else {
                $Emp_Id = $request->txt_employee;
                $data = DB::table('daily__performance__cards')
                    ->leftJoin('employee_masters', 'employee_masters.emp_id', '=', 'daily__performance__cards.Emp_ID')
                    ->select('employee_masters.emp_id', 'employee_masters.emp_name', 'daily__performance__cards.*')
                    ->whereBetween('daily__performance__cards.Date', [$request->txt_fromdate, $request->txt_todate])
                    ->when($Emp_Id<>0, function ($q)  use ($Emp_Id) {
                        return $q->where('employee_masters.emp_id', '=', $Emp_Id);
                    })
                    ->get();

                //  dd($data);

                return view('performance_report')->with(['data' => $data,
                    'employeess' => $emp,
                    'employee_i' => $request->txt_employee,
                    'from_date' => $request->txt_fromdate,
                    'to_date' => $request->txt_todate]);

            }


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }

    }


    public function openPerformance_Report()
    {

        /*try {
            $emp = DB::table('employee_masters')
                ->select('employee_masters.emp_id',
                    'employee_masters.emp_name'
                )
                ->get();

            $data = null;
            $emp_id = null;
            return view('performance_report')
                ->with(['data' => $data,
                    '$employeess' => $emp,
                    '$employee_i' => $emp_id,
                    '$from_date' => null,
                    '$to_date' => null]);


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }*/

        $data = null;
        $emp_id = null;
        $emp = DB::table('employee_masters')
            ->select('employee_masters.emp_id',
                'employee_masters.emp_name'
            )
            ->get();

        return view('performance_report')->with(['data' => $data,
            'employeess' => $emp,
            'employee_i' => $emp_id,
            'from_date' => null, 'to_date' => null]);


    }

    /*end performance report*/


    /*start evaluation report*/

    public function openEvaluation_Report()
    {
        $data = null;
        $emp_id = null;
        $emp = DB::table('employee_masters')
            ->select('employee_masters.emp_id',
                'employee_masters.emp_name'
            )
            ->where('employee_masters.Enabled' ,'=',0)
            ->get();

        return view('evaluation_report')
            ->with(['data' => $data,  'employeess' => $emp,
                'employee_i' => $emp_id,'from_date' => null, 'to_date' => null]);
    }

    public function getEvaluationReport(Request $request)
    {

        try {

            $data = null;

            $emp = DB::table('employee_masters')
                ->select('employee_masters.emp_id',
                    'employee_masters.emp_name'
                )
                ->where('employee_masters.Enabled' ,'=',0)
                ->get();

            if ($request->txt_todate < $request->txt_fromdate) {

                return view('evaluation_report')->with(['data' => $data,
                    'from_date' => $request->txt_fromdate, 'to_date' => $request->txt_todate]);

            } else {

                $tmp_Id = $request->txt_employee;
                $data = DB::table('intern__planned__schedules')
                    ->leftJoin('employee_masters', 'employee_masters.emp_id',
                        '=', 'intern__planned__schedules.Emp_ID')
                    ->select('employee_masters.emp_id', 'employee_masters.emp_name', 'intern__planned__schedules.*')
                    ->whereBetween('intern__planned__schedules.Review_date',
                        [$request->txt_fromdate, $request->txt_todate])
                    ->when($tmp_Id<>0, function ($q)  use ($tmp_Id) {
                        return $q->where('employee_masters.emp_id', '=', $tmp_Id);
                    })
                    ->get();

                //dd($data);
                //$data=User::all();

                return view('evaluation_report')
                    ->with(['data' => $data,'employeess' => $emp,
                        'employee_i' => $request->txt_employee,
                        'from_date' => $request->txt_fromdate, 'to_date' => $request->txt_todate]);

            }


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }



    }

    /*end evaluation report*/

    /*start college summary report*/

    public function getCollegeTrainingSummaryReport(Request $request)
    {
        try {

            $data = null;

            if ($request->txt_todate < $request->txt_fromdate) {

                return view('college_training_summary_report')->with(['data' => $data,
                    'from_date' => $request->txt_fromdate, 'to_date' => $request->txt_todate]);

            } else {

                $data = DB::table('college__during__trainings')
                    ->select('college__during__trainings.Collage_Before_Training_Id',
                        'college__during__trainings.College_Id',
                        'college__during__trainings.Entry_Date',
                        'college__during__trainings.Student_Attendance_Percentage',
                        'college__during__trainings.Pulse_Count_Of_Students',
                        'college__during__trainings.Pulse_Score',
                        'college__during__trainings.Feedback_From_EM',
                        'college__during__trainings.Pratical_Test',
                        'college__during__trainings.Aptitude_Score',
                        'college__during__trainings.Verbal_Score',
                        'college__during__trainings.Technical_Score',
                        'college__during__trainings.Test_Reports',
                        'college__during__trainings.Update_To_TPO',
                        'college__during__trainings.Student_Engagement',
                        'college__during__trainings.Remarks',
                        'college__during__trainings.Database'
                    )->whereBetween('college__during__trainings.Entry_Date',
                        [$request->txt_fromdate, $request->txt_todate])
                    ->get();

                //dd($data);
                //$data=User::all();


                return view('college_training_summary_report')->with(['data'=>$data,
                    'from_date' => $request->txt_fromdate,
                    'to_date' => $request->txt_todate]);

            }


        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }


    }


    public function openCollegeTrainingSummary_Report()
    {

        try {

            $data = null;
            return view('college_training_summary_report')->with(['data' => $data,
                'from_date' => null, 'to_date' => null]);


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }


    }


    /*end college summary report*/

    /*start college training details report*/

    public function getCollegeTrainingDetailsReport(Request $request)
    {
        try {

            $data = null;

            if ($request->txt_todate < $request->txt_fromdate) {

                return view('college_training_details_report')->with(['data' => $data,
                    'from_date' => $request->txt_fromdate, 'to_date' => $request->txt_todate]);

            } else {
                $tmp_Id =  $request->txt_collage;
                $data = DB::table('college__during__trainings')
                    ->select('college__during__trainings.Collage_Before_Training_Id',
                        'college__during__trainings.College_Id',
                        'college__during__trainings.Entry_Date',
                        'college__during__trainings.Student_Attendance_Percentage',
                        'college__during__trainings.Pulse_Count_Of_Students',
                        'college__during__trainings.Pulse_Score',
                        'college__during__trainings.Feedback_From_EM',
                        'college__during__trainings.Pratical_Test',
                        'college__during__trainings.Aptitude_Score',
                        'college__during__trainings.Verbal_Score',
                        'college__during__trainings.Technical_Score',
                        'college__during__trainings.Test_Reports',
                        'college__during__trainings.Update_To_TPO',
                        'college__during__trainings.Student_Engagement',
                        'college__during__trainings.Remarks',
                        'college__during__trainings.Database'
                    )
                    ->whereBetween('college__during__trainings.Entry_Date',
                        [$request->txt_fromdate, $request->txt_todate])
                    ->when($tmp_Id<>0, function ($q)  use ($tmp_Id) {
                        return $q->where('college__during__trainings.College_Id', '=', $tmp_Id);
                    })
                    ->get();

                //dd($data);
                //$data=User::all();

                $collage = DB::table('collage_masters')
                    ->select('collage_masters.collage_id',
                        'collage_masters.collage_name'
                    )
                    ->where('collage_masters.Enabled','=',0)
                    ->get();

                return view('college_training_details_report')->with(['data'=>$data,
                    'collleges' => $collage,
                    'collage_i' => $request->txt_collage,
                    'from_date' => $request->txt_fromdate,
                    'to_date' => $request->txt_todate]);

            }


        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }


    }


    public function openCollegeTrainingDetails_Report()
    {

        try {
            $collage = DB::table('collage_masters')
                ->select('collage_masters.collage_id',
                    'collage_masters.collage_name'
                )
                ->where('collage_masters.Enabled','=',0)
                ->get();

            $data = null;
            $collage_id = null;
            return view('college_training_details_report')->with(['data' => $data,
                'collleges' => $collage,
                'collage_i' => $collage_id,
                'from_date' => null,
                'to_date' => null]);


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }


    }


    /*end college training details report*/

    /*start function master*/

    //store function

    public function store_function(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        $obj = DB::table('functionmasters')
            ->insert(['name' => $request->txt_name,
                'created_at' => $current_time,
                'updated_at' => $current_time
            ]);


        return redirect('FunctionList');

    }
    //list function

    public function get_allfunction()
    {
        try {

            $obj = DB::table('functionmasters')->get();

            return view('function_list')->with('functions', $obj);

        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }
    }

    //delete function

    public function destroy_function(Request $request)
    {

        $user = DB::table('functionmasters')->where('id', $request->id)->delete();

    }

    //update function

    public function show_function($id)
    {
        $user = DB::table('functionmasters')->where('id', '=', $id)->first();


        return view('function_edit')->with(['function' => $user]);
    }

    //edit function

    public function edit_function(Request $request)
    {

        $current_time = Carbon::now()->toDateTimeString();

        $user = DB::table('functionmasters')
            ->where('id', $request->txt_functionid)
            ->update(['name' => $request->txt_name,
                'created_at' => $current_time,
                'updated_at' => $current_time]);


        return redirect('FunctionList')->with('success', "Record Updated Successfully");
    }

    /*end function master*/

    /*start employee search report*/

    public function open_employee_search_Report()
    {
        try {

            $skills = DB::table('skill_masters')
                ->select('skill_masters.skill_id', 'skill_masters.skill_name')
                ->get();

            $data = null;
            $from_date = null;
            $to_date = null;
            $available = false;

            $primaryskill = null;
            return view('report_employee_search')
                ->with(['data' => $data,
                    'skills' => $skills,
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'available' => $available,
                    'primary_skill' => $primaryskill]);


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }

    }

    public function get_employee_search_Report(Request $request)
    {
        DB::connection()->enableQueryLog();
        try {
            $primaryskill = trim($request->txt_primaryskill);
            $from_date = trim($request->txt_fromdate);
            $to_date = trim($request->txt_todate);
            $available = $request->has('txt_available');

            $skills = DB::table('skill_masters')
                ->select('skill_masters.skill_id', 'skill_masters.skill_name')
                ->get();


            $d1 = DB::table('employee_masters')
                ->leftJoin('designation_masters', 'employee_masters.designation_id', '=', 'designation_masters.designation_id')
                ->leftjoin('skill_masters as s1', 'employee_masters.primary_skill', '=', 's1.skill_id')
                ->leftjoin('skill_masters as s2', 'employee_masters.secondary_skill', '=', 's2.skill_id')
                ->leftJoin('department_masters', 'employee_masters.department_id', '=', 'department_masters.department_id')
                ->leftJoin('course_transactions', 'employee_masters.emp_id', '=', 'course_transactions.Emp_Id')
                ->when(request('txt_primaryskill', false), function ($q) use ($primaryskill) {
                    return $q->where('employee_masters.primary_skill', $primaryskill);
                })
                ->when(request('txt_available', false), function ($q) use ($from_date, $to_date) {

                    return $q->whereNotBetween('course_transactions.Start_Date', [$from_date, $to_date])
                        ->whereNotBetween('course_transactions.End_Date', [$from_date, $to_date])
                        ->orWhere(function ($query) use ($from_date, $to_date) {

                            return $query->where('course_transactions.Start_Date', '<', $from_date)
                                ->where('course_transactions.End_Date', '>', $to_date);
                        });


                })
                ->select('employee_masters.emp_id',
                    'employee_masters.emp_name',
                    'employee_masters.mobile_number',
                    'employee_masters.off_email_id',
                    's1.skill_name as primary_skill',
                    's2.skill_name as secondary_skill',
                    'designation_masters.designation_name',
                    'department_masters.department_name'

                )
                ->groupBy('employee_masters.emp_id',
                    'employee_masters.emp_name',
                    'employee_masters.mobile_number',
                    'employee_masters.off_email_id',
                    's1.skill_name', 's2.skill_name',
                    'designation_masters.designation_name',
                    'department_masters.department_name')
                ->get();

            $d2 = null;

            if ($available) {

                $d2 = DB::table('employee_masters')
                    ->leftJoin('designation_masters', 'employee_masters.designation_id',
                        '=', 'designation_masters.designation_id')
                    ->leftjoin('skill_masters as s1', 'employee_masters.primary_skill',
                        '=', 's1.skill_id')
                    ->leftjoin('skill_masters as s2', 'employee_masters.secondary_skill',
                        '=', 's2.skill_id')
                    ->leftJoin('department_masters', 'employee_masters.department_id',
                        '=', 'department_masters.department_id')
                    ->leftJoin('emp__qualifications', 'employee_masters.emp_id',
                        '=', 'emp__qualifications.Emp_Id')
                    ->when(request('txt_primaryskill', false), function ($q) use ($primaryskill) {
                        return $q->where('employee_masters.primary_skill', $primaryskill);
                    })
                    ->select('employee_masters.emp_id',
                        'employee_masters.emp_name',
                        'employee_masters.mobile_number',
                        'employee_masters.off_email_id',
                        's1.skill_name as primary_skill',
                        's2.skill_name as secondary_skill',
                        'designation_masters.designation_name',
                        'department_masters.department_name'

                    )
                    ->whereNotIn('employee_masters.emp_id', function ($query) {
                        $query->select('Emp_Id')
                            ->from('course_transactions');
                    })
                    ->groupBy('employee_masters.emp_id',
                        'employee_masters.emp_name',
                        'employee_masters.mobile_number',
                        'employee_masters.off_email_id',
                        's1.skill_name', 's2.skill_name',
                        'designation_masters.designation_name',
                        'department_masters.department_name')
                    ->get();


                $data = $d1->merge($d2);

            } else {

                $data = $d1;
            }


            $queries = DB::getQueryLog();

            // dd(end($queries));


            return view('report_employee_search')->with(['data' => $data,
                'skills' => $skills,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'available' => $available,
                'primary_skill' => $primaryskill]);


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }
    }

    /*end employee search report*/

    /*start traineer report*/

    public function getTraineeReport()
    {
        $data = null;
        return view('trainer_report')
            ->with(['data' => $data,
                'from_date' => null,
                'to_date' => null]);

    }

    public function openTrainee_Report(Request $request)
    {
        try {

            $data = null;
            if ($request->txt_todate < $request->txt_fromdate) {

                return view('trainer_report')->with(['data' => $data,
                    'from_date' => $request->txt_fromdate,
                    'to_date' => $request->txt_todate]);

            } else {

                $data = DB::table('employee_masters')
                    ->leftJoin('skill_masters', 'skill_masters.skill_id',
                        '=', 'employee_masters.primary_skill')
                    ->leftJoin('department_masters','department_masters.department_id',
                        '=','employee_masters.department_id')
                    ->leftJoin('designation_masters','designation_masters.designation_id',
                        '=','employee_masters.designation_id')
                    ->leftJoin('organization_masters','organization_masters.organization_id',
                        '=','employee_masters.organization_id')
                    ->select('skill_masters.skill_name',
                        'department_masters.department_name',
                        'designation_masters.designation_name',
                        'organization_masters.organization_name',
                        'employee_masters.emp_name'
                        ,'employee_masters.*')
                    ->whereBetween('daily__performance__cards.Date',
                        [$request->txt_fromdate, $request->txt_todate])
                    ->get();

                //dd($data);
                //$data=User::all();


                return view('trainer_report')
                    ->with(['data' => $data,
                        'from_date' => $request->txt_fromdate,
                        'to_date' => $request->txt_todate]);

            }


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }


    }


    /*end traineer report*/



    public function get_alltopic()
    {

        try {
            $obj = DB::table('topic_masters')
                ->leftJoin('skill_masters','skill_masters.skill_id','=',
                    'topic_masters.Skill_ID')
                ->select('topic_masters.*', 'skill_masters.skill_name')
                ->where('topic_masters.Enabled', '=', 0)
                ->get();

            return view('topic_list')->with('topics', $obj);

        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }


    }


    public function get_skillfortopic()
    {
        try {
            $skillss = DB::table('skill_masters')
                ->select('skill_masters.skill_id', 'skill_masters.skill_name')
                ->where('skill_masters.Enabled', '=', '0')
                ->get();

            return view('topic_add')->with([
                'skill' => $skillss
            ]);


        } catch (Exception $e) {

            //return $e->getMessage();

            return view('excaption');

        }
    }




    public function store_topic(Request $request)
    {

        //DB::connection()->enableQueryLog();
        try {

            $current_time = Carbon::now()->toDateTimeString();

            $user = DB::table('topic_masters')
                ->select('topic_description')
                ->where('topic_description', '=', $request->txt_topicdescription)
                ->where('topic_masters.Enabled', '=', '0')
                ->first();


            // $user = DB::getQueryLog();

            if ($user) {

                return redirect()->back()->withInput()->with('error', 'Topic ' . $request->txt_topicdescription . ' Already Exist Try Another');

            } else {
                $obj = DB::table('topic_masters')
                    ->insert(['Skill_ID'=>$request->txt_skillname,
                        'topic_description' => $request->txt_topicdescription != null ? $request->txt_topicdescription : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('TopicList');





            }

        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }


    }




    // for delete topic

    public function destroy_topic(Request $request)
    {

        try {


            $check_emp_primary = DB::table('sub__topic_masters')
                ->where('Topic_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('sub__topic_masters.*')
                ->count();


            $check_emp_second = DB::table('topic_evaluation_masters')
                ->where('Topic_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('topic_evaluation_masters.*')
                ->count();


            $check_student = DB::table('intern__planned__schedules')
                ->where('Topic_ID', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('intern__planned__schedules.*')
                ->count();


            if ($check_emp_primary > 0) {
                return response()->json(['msg' => 'Sub Topics for this Topic is already set. Delete the Sub Topics first before deleting Topic', 'status' => 'failed']);

            } else if ($check_emp_second > 0) {
                return response()->json(['msg' => 'Topic Evaluation for this Topic is already set. Delete the Topic Evaluation first before deleting Topic', 'status' => 'failed']);

            } else if ($check_student > 0) {

                return response()->json(['msg' => 'Intern Planned Schedule for this Topic is already set. Delete the Intern Planned Schedule first before deleting Topic', 'status' => 'failed']);

            } else {

                $user = DB::table('topic_masters')->where('topic_id', $request->id)->update(['Enabled' => 1]);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
                }
                // return redirect('DeparmentList')->with('success',"Delete Record Successfully");

            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }




    //for show topic

    public function show_topic($id)
    {
        try {
            $user = DB::table('topic_masters')->where('topic_id', '=', $id)->first();

            $skill = DB::table('skill_masters')
                ->select('skill_masters.skill_id', 'skill_masters.skill_name')
                ->where('skill_masters.Enabled', '=', '0')
                ->get();


            return view('topic_edit')->with(['topics' => $user,'skill'=>$skill]);

        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }

    // for edit topic

    public function edit_topic(Request $request)
    {
        //dd($request->txt_deptid.$request->txt_deptname);

        try {
            $current_time = Carbon::now()->toDateTimeString();

            $topic = DB::table('topic_masters')
                ->select('topic_description')
                ->where('topic_description', '=', $request->txt_topicdescription)
                ->where('topic_masters.Enabled', '=', '0')
                ->where('topic_id', '<>', $request->txt_topicid)
                ->get()->count();

            if ($topic > 0) {

                return redirect()->back()->with('error', 'Topic ' . $request->txt_topicdescription . ' Already Exist Try Another');


            } else {
                $user = DB::table('topic_masters')
                    ->where('topic_id', $request->txt_topicid)
                    ->update(['Skill_ID'=>$request->txt_skillname,
                        'topic_description' => $request->txt_topicdescription != null ? $request->txt_topicdescription : '',
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('TopicList')->with('success', "Record Updated Successfully");

            }


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }


    }


    /*start program master*/

    //store program

    public function store_program(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();


        try {

			if($request->txt_TypeOfProgram == "one time" && $request->txt_PhasesCount <> 1)
			{
				return redirect()->back()->with('error', 'For Type Of Program ' . $request->txt_TypeOfProgram . ' course, Phase count must be One only');
			}
			if($request->txt_TypeOfProgram == "Phased" && $request->txt_PhasesCount <= 1)
			{
				return redirect()->back()->with('error', 'For Type Of Program ' . $request->txt_TypeOfProgram . ' course, Phase count must be higher than 1');
			}
			$Program_Rate=0;
			$tmp = DB::table('Program_Master')
				->where('Program_Name','=',$request->txt_program)
				->get()->count();
			if($tmp>=1)
			{
					return redirect()->back()->with('error', 'Course with Name:' . $request->txt_program . ' already created');
			}
			if(is_numeric($request->txt_ProgramRate))
				$Program_Rate=$request->txt_ProgramRate;
			// $Remark = $request->txt_Remarks & "";
            $obj = DB::table('Program_Master')
                ->insert(['Company_Program'=>$request->txt_companyprogram != null ? $request->txt_companyprogram : '',
                    'Program_Name'=>$request->txt_program != null ? $request->txt_program : '',
                    'Duration_Days'=>$request->txt_DurationDays != null ? $request->txt_DurationDays : '',
                    'Sessions_Count'=>$request->txt_SessionCount != null ? $request->txt_SessionCount : '',
                    'Batches_Count'=>$request->txt_BatchesCount != null ? $request->txt_BatchesCount : '',
                    'Type_of_Program'=>$request->txt_TypeOfProgram != null ? $request->txt_TypeOfProgram : '',
                    'Phases_Count'=>$request->txt_PhasesCount != null ? $request->txt_PhasesCount : '',
                    'Remarks'=> $request->txt_Remarks != null ? $request->txt_Remarks : '',
                    'Program_Rate'=>$Program_Rate,
                    'created_at' => $current_time

                ]);


            return redirect('ProgramList');

        } catch (Exception $e) {


            return $e->getMessage();

            //return view('excaption');

        }


    }
    //list program

    public function get_allProgram()
    {
        try {

            $obj = DB::table('Program_Master')

                ->get();

            return view('program_list')->with('program', $obj);

        } catch (Exception $e) {


           // return $e->getMessage();

           return view('excaption');

        }
    }

    //delete program

    public function destroy_program(Request $request)
    {
        try {


            $program_for_course = DB::table('course_masters')
                ->where('Program_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('course_masters.*')
                ->count();


            $program_for_Session_Batch_Mapping = DB::table('Session_Batch_Mapping')
                ->where('Course_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('Session_Batch_Mapping.*')
                ->count();


            $program_for_course_session_mappings = DB::table('course_session_mappings')
                ->where('Course_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('course_session_mappings.*')
                ->count();

            $program_for_coursetrasaction = DB::table('course_transactions')
                ->where('Course_ID', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('course_transactions.*')
                ->count();

            $program_for_collage_before_training = DB::table('college__before__trainings')
                ->where('Program_Id', '=', $request->id)
                ->where('Enabled', '=', '0')
                ->select('college__before__trainings.*')
                ->count();




            if ($program_for_course > 0) {
                return response()->json(['msg' => 'Courses  for this Program is already set. Delete the Courses first before deleting Program Name', 'status' => 'failed']);

            } else if ($program_for_Session_Batch_Mapping > 0) {
                return response()->json(['msg' => 'Session Batch Mapping for this Program is already set. Delete the Session Batch Mapping first before deleting Program', 'status' => 'failed']);

            } else if ($program_for_course_session_mappings > 0) {

                return response()->json(['msg' => 'Attendance for this Employee is already set. Delete the Attendance first before deleting Employee', 'status' => 'failed']);

            } else if ($program_for_coursetrasaction > 0) {

                return response()->json(['msg' => 'Course Transaction for this Program is already set. Delete the Course Transaction first before deleting Program', 'status' => 'failed']);

            } else if ($program_for_collage_before_training > 0) {

                return response()->json(['msg' => 'College Before Training for this Employee is Program set. Delete the College Before Training first before deleting Program', 'status' => 'failed']);

            }  else {

                $user = DB::table('Program_Master')
                    ->where('Program_Id', '=', $request->id)
                    ->update(['Enabled' => 1]);

                if ($user) {

                    return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
                } else {

                    return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
                }

            }


            // return redirect('DeparmentList')->with('success',"Delete Record Successfully");


        } catch (Exception $e) {


            //  return $e->getMessage();

            return view('excaption');

        }

    }




    //update function

    public function show_program($id)
    {
        try {


            $user = DB::table('Program_Master')->where('Program_Id', '=', $id)->first();


            return view('program_edit')->with(['programs' => $user]);

        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }

    }

    //edit program

    public function edit_program(Request $request)
    {

        $current_time = Carbon::now()->toDateTimeString();

        try {

			if($request->txt_TypeOfProgram == "one time" && $request->txt_PhasesCount <> 1)
			{
				return redirect()->back()->with('error', 'TypeOfProgram ' . $request->txt_TypeOfProgram . 'For one time course, Phase count must be One only');
			}
			if($request->txt_TypeOfProgram == "Phased" && $request->txt_PhasesCount <= 1)
			{
				return redirect()->back()->with('error', 'TypeOfProgram ' . $request->txt_TypeOfProgram . 'For Phased course, Phase count must be higher than 1');
			}
			$Program_Rate=0;
			if(is_numeric($request->txt_ProgramRate))
				$Program_Rate=$request->txt_ProgramRate;
            $obj = DB::table('Program_Master')
                ->where('Program_Id',$request->txt_programID)
                ->update(['Company_Program'=>$request->txt_companyprogram != null ? $request->txt_companyprogram : '',
                    'Program_Name'=>$request->txt_program != null ? $request->txt_program : '',
                    'Duration_Days'=>$request->txt_DurationDays != null ? $request->txt_DurationDays : '',
                    'Sessions_Count'=>$request->txt_SessionCount != null ? $request->txt_SessionCount : '',
                    'Batches_Count'=>$request->txt_BatchesCount != null ? $request->txt_BatchesCount : '',
                    'Type_of_Program'=>$request->txt_TypeOfProgram != null ? $request->txt_TypeOfProgram : '',
                    'Phases_Count'=>$request->txt_PhasesCount != null ? $request->txt_PhasesCount : '',
                    'Remarks'=> $request->txt_Remarks != null ? $request->txt_Remarks : '',
                    'Program_Rate'=>$Program_Rate,
                    'updated_at' => $current_time

                ]);


            return redirect('ProgramList');

        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }
    }


    /*end program master*/


    /*Start Session Batch Mapping*/

        // list Session_Batch_Mapping

    public function get_Session_Batch_Mapping()
    {

        try {
			$sql = "select sbm.*, ";
            $obj = DB::table('Session_Batch_Mapping')
                ->join('Program_Master','Program_Master.Program_Id','=',
                    'Session_Batch_Mapping.Course_Id')
                ->join('course_session_mappings','course_session_mappings.Course_Session_mapping_ID','=',
                    'Session_Batch_Mapping.Session_Id')
                ->join('topic_evaluation_masters','topic_evaluation_masters.Topic_Eval_Id','=',
                    'Session_Batch_Mapping.Topic_Eval_Id')
                ->select('Session_Batch_Mapping.*',
                    'Program_Master.Program_Name','Program_Master.Company_Program',
                    'course_session_mappings.Session_Description',
                    'topic_evaluation_masters.Evaluation_Description')
                ->get();

            return view('Session_Batch_Mapping_list')->with('sessionmapping', $obj);




        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }
    }

    //store Session_Batch_Mapping

    public function store_Session_Batch_Mapping(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_sessionid == "-1" || $request->txt_sessionid == null) {

            return redirect()->back()->withInput()->with('error', 'Session Not Selected');

        }
		/*else if ($request->txt_topicevalid == -1 || $request->txt_topicevalid == null) {

            return redirect()->back()->with('error', 'Topic Evaluation Not Selected');

        } */
		else {
            try {
				$s1 = DB::table('Session_Batch_Mapping')
					->where('Course_Id','=', $request->txt_courseid)
					->where('Session_Id','=', $request->txt_sessionid)
					->where('Enabled','=','0')
					->count();
				$s2 = DB::table('Program_Master')
					->where('Program_Id','=', $request->txt_courseid)
					->select('Batches_Count')
					->first();

				if($s1 >= $s2->Batches_Count)
				{
					return redirect()->back()->withInput()
                        ->with('error', 'Available No. of Batches are already created for the selected Session in given Course.');
				}
				//$topic_Eval_Ids[]=$request->txt_topicevalid;
				$str=implode(",",$request->txt_topicevalid);
				/*foreach($topic_Eval_Ids as $ti)
				{
					if($str=="")
						$str = $ti;
					else
						$str = $str . "," . $ti;
				}*/
                $obj = DB::table('Session_Batch_Mapping')
                    ->insert([
                        'Course_Id' => $request->txt_courseid,

                        'Topic_Eval_Id' =>$str,	// $request->txt_topicevalid,
                        'Remarks' => $request->txt_remarks,
                        'Session_Id' => $request->txt_sessionid,
						'Batch_Timing' => $request->txt_BatchTiming,
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('SessionBatchMappingList');


            } catch (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }

        }

    }

    //destroy session batc mapping

    public function destroy_Session_Batch_Mapping(Request $request)
    {

        try {

            $user = DB::table('Session_Batch_Mapping')
                ->where('Batch_Id', '=', $request->id)
                ->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }
    }


    //show Session_Batch_Mapping

    public function show_Session_Batch_Mapping($id)
    {

        try {

            $user = DB::table('Session_Batch_Mapping')
                ->where('Batch_Id', '=', $id)->first();



            $program = DB::table('Program_Master')
                ->select('Program_Master.Program_Id', 'Program_Master.Program_Name','Company_Program')
                ->where('Program_Master.Enabled', '=', '0')
				->orderBy('Company_Program')
                ->get();

            $session = DB::table('course_session_mappings')
                ->select('course_session_mappings.Course_Session_mapping_ID',
                    'course_session_mappings.Session_Description','Session_Id')
                ->where('course_session_mappings.Enabled', '=', '0')
				->orderBy('Session_Id')
                ->get();
			$arr = explode(',',$user->Topic_Eval_Id);
            $topicevalution = DB::table('topic_evaluation_masters')
                ->select('topic_evaluation_masters.Topic_Eval_Id',
                    'topic_evaluation_masters.Evaluation_Description')
                ->where('topic_evaluation_masters.Enabled', '=', '0')
				->whereIn('topic_evaluation_masters.Topic_Eval_Id',$arr)
				->orderBy('Evaluation_Description')
                ->get();

			$TotalBatch = DB::table('Program_Master')
               /* ->select('Program_Master.Program_Id',
                    'Program_Master.Program_Name')*/
               ->where('Program_Id','=',$user->Course_Id)
				->where('Program_Id','=','0')
				->select('Batches_Count')
				->first();

			$BatchCount = DB::table('Session_Batch_Mapping')
				->where('Course_Id','=',$user->Course_Id)
				->where('Enabled','=','0')
				->count();

            return view('Session_Batch_Mapping_Edit')->with(['sessionmappingss'=>$user,
                'programs' => $program,
                'sessions' => $session,
                'topicevals' => $topicevalution,
				'SA' => $TotalBatch,
				'SC' => $BatchCount
            ]);


        } catch (Exception $e) {


            return $e->getMessage();

            //return view('excaption');

        }
    }


    //edit Session_Batch_Mapping

    public function edit_Session_Batch_Mapping(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        /*if ($request->txt_courseid == -1 || $request->txt_courseid == null) {

            return redirect()->back()->withInput()->with('error', 'Course Not Selected' . $request->txt_courseid . '.');

        } else if ($request->txt_sessionid == -1 || $request->txt_sessionid == null) {

            return redirect()->back()->withInput()->with('error', 'Session Not Selected');

        }else if ($request->txt_topicevalid == -1 || $request->txt_topicevalid == null) {

            return redirect()->back()->with('error', 'Topic Evaluation Not Selected');

        } else {*/
            try {
                $user = DB::table('Session_Batch_Mapping')
                    ->where('Batch_Id', $request->txt_sbmID)
                    ->update(['Remarks' => $request->txt_remarks,
                        'Batch_Timing' => $request->txt_BatchTiming,
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('SessionBatchMappingList')->with('success', "Record Updated Successfully");


            } catch (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }

       // }
    }


    //add Session_Batch_Mapping

    public function Add_Session_Batch_Mapping()
    {

        try {

            $program = DB::table('Program_Master')
                ->select('Program_Master.Program_Id', 'Program_Master.Program_Name','Company_Program')
                ->where('Program_Master.Enabled', '=', '0')
				->orderBy('Company_Program')
                ->get();

            $session = DB::table('course_session_mappings')
                ->select('course_session_mappings.Course_Session_mapping_ID',
                    'course_session_mappings.Session_Description','course_session_mappings.Session_Id')
                ->where('course_session_mappings.Enabled', '=', '0')
				->orderBy('Session_Id')
                ->get();

            $topicevalution = DB::table('topic_evaluation_masters')
                ->select('topic_evaluation_masters.Topic_Eval_Id',
                    'topic_evaluation_masters.Evaluation_Description')
                ->where('topic_evaluation_masters.Enabled', '=', '0')
				->orderBy('Evaluation_Description')
                ->get();

			$topic = DB::table('topic_masters')
                ->select('topic_masters.topic_id', 'topic_masters.topic_description')
                ->where('topic_masters.Enabled', '=', '0')
				->orderBy('topic_description')
                ->get();


            $sub_topic = DB::table('sub__topic_masters')
                ->select('sub__topic_masters.Sub_Topic_Id', 'sub__topic_masters.Topic_Description')
                ->where('sub__topic_masters.Enabled', '=', '0')
                ->orderBy('topic_description')
				->get();

            $skill = DB::table('skill_masters')
                ->select('skill_masters.skill_id', 'skill_masters.skill_name')
                ->where('skill_masters.Enabled', '=', '0')
                ->orderBy('skill_name')
				->get();


            return view('Session_Batch_Mapping_Add')->with([
                'program' => $program,
                'session' => $session,
                'topiceval' => $topicevalution,
				'topic' => $topic,
				'sub_topic' => $sub_topic,
				'skill' => $skill
            ]);


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }
    }
    /*End Session Batch Mapping*/



    /*start skill intern planned schedule*/

    //this for list skill intern planned schdule

    public function get_skill_allIntern_Planned_Schedule()
    {
        try {
            $obj = DB::table('intern__planned__schedules')
                ->join('employee_masters', 'employee_masters.emp_id', '=',
                    'intern__planned__schedules.Emp_ID')
                ->join('topic_masters', 'topic_masters.topic_id', '=',
                    'intern__planned__schedules.Topic_ID')
                ->join('sub__topic_masters', 'sub__topic_masters.Sub_Topic_Id', '=',
                    'intern__planned__schedules.Sub_Topic_ID')
                ->join('topic_evaluation_masters', 'topic_evaluation_masters.Topic_Eval_Id', '=',
                    'intern__planned__schedules.Topic_Eval_ID')
                // ->join('type_masters','type_masters.type_Id','=','intern__planned__schedules.Review_Type')
                //->join('type_masters','type_masters.type_Id','=','employee_masters.type')
                ->select('intern__planned__schedules.*',
                    'employee_masters.emp_name', 'topic_masters.topic_description',
                    'sub__topic_masters.Topic_Description as SubTopic',
                    'topic_evaluation_masters.Evaluation_Description',
                    'type_masters.type_desc')
                ->where('intern__planned__schedules.Enabled', '=', '0')
                ->where('employee_masters.type','=','3')
                ->get();


            //$queries = DB::getQueryLog();

            return view('skill_intern_planned_schedule_list')->with('interplannsch', $obj);


        } catch (Exception $e) {


            return $e->getMessage();

            //return view('excaption');

        }

    }

    //this for store skill intern planned schdule

    public function store_skill_Intern_Planned_Schedule(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_topicname == -1 || $request->txt_topicname == null) {

            return redirect()->back()->withInput()->with('error', 'Topic  Not Selectd');

        } else if ($request->txt_empId == -1 || $request->txt_empId == null) {

            return redirect()->back()->withInput()->with('error', 'Employee  Not Selected');

        } else if ($request->txt_empId == $request->txt_ReEmpId) {

            return redirect()->back()->withInput()->with('error', 'Employee Name And Review Employee Name Should Not be Same');

        }else if ($request->txt_reviewtype == -1 || $request->txt_reviewtype == null) {

            return redirect()->back()->with('error', 'Review Type  Not Selected');

        } else {
            try {


                $obj = DB::table('intern__planned__schedules')
                    ->insert(['Emp_ID' => $request->txt_empId,
                        'Review_date' => $request->dt_ReDate,
                        'Review_Type'=>$request->txt_reviewtype,
                        'Topic_ID' => $request->txt_topicname,
                        'Sub_Topic_ID' => $request->txt_SubTopicName,
                        'Topic_Eval_ID' => $request->txt_TopicEvalName,
                        'Review_Emp_ID' => $request->txt_ReEmpId,
                        'Start_Time' => $request->txt_StartTime != null ? $request->txt_StartTime : '',
                        'End_time' => $request->txt_EndTime != null ? $request->txt_EndTime : '',
                        'Review_score'=>$request->txt_reviewscore,
                        'Description' => $request->txt_description != null ? $request->txt_description : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('SkillInternPlnSchiList');


            } catch (Exception $e) {


                return $e->getMessage();

               // return view('excaption');

            }

        }

    }

    //this destroy for skill intern planned schdule

    public function destroy_skill_Intern_Planned_Schedule(Request $request)
    {

        try {

            $user = DB::table('intern__planned__schedules')
                ->where('Intern_Planned_Schedule_ID', '=', $request->id)
                ->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }
            // return redirect('DeparmentList')->with('success',"Delete Record Successfully");


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }

    }

    //this for show skill intern planned schdule

    public function show_skill_Intern_Planned_Schedule($id)
    {
        try {

            $intrnplanscs = DB::table('intern__planned__schedules')->where('Intern_Planned_Schedule_ID',
                '=', $id)->first();

            $emp = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
                ->orderBy('emp_name')
                ->get();

            $reemp = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
                ->orderBy('emp_name')
                ->get();


            $topc = DB::table('topic_masters')
                ->select('topic_masters.topic_id', 'topic_masters.topic_description')
                ->where('topic_masters.Enabled', '=', '0')
                ->orderBy('topic_description')
                ->get();

            $sbtopc = DB::table('sub__topic_masters')
                ->select('sub__topic_masters.Sub_Topic_Id', 'sub__topic_masters.Topic_Description')
                ->where('sub__topic_masters.Topic_Id', '=', $intrnplanscs->Topic_ID)
                ->where('sub__topic_masters.Enabled', '=', '0')
                ->orderBy('topic_description')
                ->get();

            $topceval = DB::table('topic_evaluation_masters')
                ->select('topic_evaluation_masters.Topic_Eval_Id',
                    'topic_evaluation_masters.Evaluation_Description')
                ->where('topic_evaluation_masters.Sub_Topic_Id', '=', $intrnplanscs->Sub_Topic_ID)
                ->where('topic_evaluation_masters.Enabled', '=', '0')
                ->orderBy('Evaluation_Description')
                ->get();

            $rtype = DB::table('type_masters')
                ->select('type_masters.type_Id',
                    'type_masters.type_desc')
                ->where('type_masters.Enabled', '=', '0')
                ->orderBy('type_desc')
                ->get();


            return view('skill_intern_planned_schedule_edit')->with(['intrnplanscs' => $intrnplanscs,
                'employees' => $emp,
                'topics' => $topc,
                'subtopics' => $sbtopc,
                'topicevaluas' => $topceval,
                'reviewemp' => $reemp,
                'typess'=>$rtype]);

        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }


    }
    //this for edit skill intern planned schdule

    public function edit_skill_Intern_Planned_Schedule(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_topicname == -1 || $request->txt_topicname == null) {

            return redirect()->back()->with('error', 'Topic  Not Selectd');

        } else if ($request->txt_empId == -1 || $request->txt_empId == null) {

            return redirect()->back()->with('error', 'Employee  Not Selected');

        } else if ($request->txt_empId == $request->txt_ReEmpId) {

            return redirect()->back()->with('error', 'Employee Name And Review Employee Name Should Not be Same');

        } else if ($request->txt_reviewtype == -1 || $request->txt_reviewtype == null) {

            return redirect()->back()->with('error', 'Review Type  Not Selected');

        } else {
            try {
                $user = DB::table('intern__planned__schedules')
                    ->where('Intern_Planned_Schedule_ID', $request->txt_ipsID)
                    ->update(['Emp_ID' => $request->txt_empId,
                        'Review_date' => $request->dt_ReDate,
                        'Review_Type'=>$request->txt_reviewtype,
                        'Topic_ID' => $request->txt_topicname,
                        'Sub_Topic_ID' => $request->txt_SubTopicName,
                        'Topic_Eval_ID' => $request->txt_TopicEvalName,
                        'Review_Emp_ID' => $request->txt_ReEmpId,
                        'Start_Time' => $request->txt_StartTime != null ? $request->txt_StartTime : '',
                        'End_time' => $request->txt_EndTime != null ? $request->txt_EndTime : '',
                        'Review_score'=>$request->txt_reviewscore,
                        'Description' => $request->txt_description != null ? $request->txt_description : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('SkillInternPlnSchiList')->with('success', "Record Updated Successfully");


            } catch (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }

        }
    }

    //add skill intern planned schdule

    public function Add_skill_Intern_Planned_Schedule()
    {
        try {
            $emp = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
                ->orderBy('emp_name')
                ->get();

            $reemp = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
                ->orderBy('emp_name')
                ->get();

            $topc = DB::table('topic_masters')
                ->select('topic_masters.topic_id', 'topic_masters.topic_description')
                ->where('topic_masters.Enabled', '=', '0')
                ->orderBy('topic_description')
                ->get();

            $sbtopc = DB::table('sub__topic_masters')
                ->select('sub__topic_masters.Sub_Topic_Id', 'sub__topic_masters.Topic_Description')
                ->where('sub__topic_masters.Enabled', '=', '0')
                ->orderBy('topic_description')
                ->get();

            $topceval = DB::table('topic_evaluation_masters')
                ->select('topic_evaluation_masters.Topic_Eval_Id',
                    'topic_evaluation_masters.Evaluation_Description')
                ->where('topic_evaluation_masters.Enabled', '=', '0')
                ->orderBy('Evaluation_Description')
                ->get();

            $type = DB::table('type_masters')
                ->select('type_masters.type_Id',
                    'type_masters.type_desc')
                ->where('type_masters.Enabled', '=', '0')
                ->orderBy('type_desc')
                ->get();


            return view('skill_intern_planned_schedule_add')->with([
                'employee' => $emp,
                'topic' => $topc,
                'subtopic' => $sbtopc,
                'topiceval' => $topceval,
                'reviemp' => $reemp,
                'types'=>$type
            ]);


        } catch (Exception $e) {


              return $e->getMessage();

          //  return view('excaption');

        }
    }

    /*end skill intern planned schdule*/


    //this for list skill intern planned schdule

    public function get_employee_skill_allIntern_Planned_Schedule()
    {
        try {
            $obj = DB::table('intern__planned__schedules')
                ->join('employee_masters', 'employee_masters.emp_id', '=',
                    'intern__planned__schedules.Emp_ID')
                ->join('topic_masters', 'topic_masters.topic_id', '=',
                    'intern__planned__schedules.Topic_ID')
                ->join('sub__topic_masters', 'sub__topic_masters.Sub_Topic_Id', '=',
                    'intern__planned__schedules.Sub_Topic_ID')
                ->join('topic_evaluation_masters', 'topic_evaluation_masters.Topic_Eval_Id', '=',
                    'intern__planned__schedules.Topic_Eval_ID')
                // ->join('type_masters','type_masters.type_Id','=','intern__planned__schedules.Review_Type')
                ->join('type_masters','type_masters.type_Id','=','employee_masters.type')
                ->select('intern__planned__schedules.*',
                    'employee_masters.emp_name', 'topic_masters.topic_description',
                    'sub__topic_masters.Topic_Description as SubTopic',
                    'topic_evaluation_masters.Evaluation_Description',
                    'type_masters.type_desc')
                ->where('intern__planned__schedules.Enabled', '=', '0')
                ->where('employee_masters.type','<>','3')
                ->get();


            //$queries = DB::getQueryLog();

            return view('employee_skill_intern_planned_schedule_list')->with('interplannsch', $obj);


        } catch (Exception $e) {


            return $e->getMessage();

            //return view('excaption');

        }

    }

    //this for store skill intern planned schdule

    public function store_employee_skill_Intern_Planned_Schedule(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_topicname == -1 || $request->txt_topicname == null) {

            return redirect()->back()->withInput()->with('error', 'Topic  Not Selectd');

        } else if ($request->txt_empId == -1 || $request->txt_empId == null) {

            return redirect()->back()->withInput()->with('error', 'Employee  Not Selected');

        } else if ($request->txt_empId == $request->txt_ReEmpId) {

            return redirect()->back()->withInput()->with('error', 'Employee Name And Review Employee Name Should Not be Same');

        }else if ($request->txt_reviewtype == -1 || $request->txt_reviewtype == null) {

            return redirect()->back()->with('error', 'Review Type  Not Selected');

        } else {
            try {


                $obj = DB::table('intern__planned__schedules')
                    ->insert(['Emp_ID' => $request->txt_empId,
                        'Review_date' => $request->dt_ReDate,
                        'Review_Type'=>$request->txt_reviewtype,
                        'Topic_ID' => $request->txt_topicname,
                        'Sub_Topic_ID' => $request->txt_SubTopicName,
                        'Topic_Eval_ID' => $request->txt_TopicEvalName,
                        'Review_Emp_ID' => $request->txt_ReEmpId,
                        'Start_Time' => $request->txt_StartTime != null ? $request->txt_StartTime : '',
                        'End_time' => $request->txt_EndTime != null ? $request->txt_EndTime : '',
                        'Review_score'=>$request->txt_reviewscore,
                        'Description' => $request->txt_description != null ? $request->txt_description : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('SkillEmployeeInternPlnSchiList');


            } catch (Exception $e) {


                return $e->getMessage();

                // return view('excaption');

            }

        }

    }

    //this destroy for skill intern planned schdule

    public function destroy_employee_skill_Intern_Planned_Schedule(Request $request)
    {

        try {

            $user = DB::table('intern__planned__schedules')
                ->where('Intern_Planned_Schedule_ID', '=', $request->id)
                ->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }
            // return redirect('DeparmentList')->with('success',"Delete Record Successfully");


        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }

    }

    //this for show skill intern planned schdule

    public function show_employee_skill_Intern_Planned_Schedule($id)
    {
        try {

            $intrnplanscs = DB::table('intern__planned__schedules')->where('Intern_Planned_Schedule_ID',
                '=', $id)->first();

            $emp = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
                ->orderBy('emp_name')
                ->get();

            $reemp = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
                ->orderBy('emp_name')
                ->get();


            $topc = DB::table('topic_masters')
                ->select('topic_masters.topic_id', 'topic_masters.topic_description')
                ->where('topic_masters.Enabled', '=', '0')
                ->orderBy('topic_description')
                ->get();

            $sbtopc = DB::table('sub__topic_masters')
                ->select('sub__topic_masters.Sub_Topic_Id', 'sub__topic_masters.Topic_Description')
                //->where('sub__topic_masters.Topic_Id', '=', $intrnplanscs->Topic_ID)
                ->where('sub__topic_masters.Enabled', '=', '0')
                ->orderBy('topic_description')
                ->get();

            $topceval = DB::table('topic_evaluation_masters')
                ->select('topic_evaluation_masters.Topic_Eval_Id',
                    'topic_evaluation_masters.Evaluation_Description')
                //->where('topic_evaluation_masters.Sub_Topic_Id', '=', $intrnplanscs->Sub_Topic_ID)
                ->where('topic_evaluation_masters.Enabled', '=', '0')
                ->orderBy('Evaluation_Description')
                ->get();

            $rtype = DB::table('type_masters')
                ->select('type_masters.type_Id',
                    'type_masters.type_desc')
                ->where('type_masters.Enabled', '=', '0')
                ->orderBy('type_desc')
                ->get();


            return view('employee_skill_intern_planned_schedule_edit')->with(['intrnplanscs' => $intrnplanscs,
                'employees' => $emp,
                'topics' => $topc,
                'subtopics' => $sbtopc,
                'topicevaluas' => $topceval,
                'reviewemp' => $reemp,
                'typess'=>$rtype]);

        } catch (Exception $e) {


            return $e->getMessage();

            //return view('excaption');

        }


    }
    //this for edit skill intern planned schdule

    public function edit_employee_skill_Intern_Planned_Schedule(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_topicname == -1 || $request->txt_topicname == null) {

            return redirect()->back()->with('error', 'Topic  Not Selectd');

        } else if ($request->txt_empId == -1 || $request->txt_empId == null) {

            return redirect()->back()->with('error', 'Employee  Not Selected');

        } else if ($request->txt_empId == $request->txt_ReEmpId) {

            return redirect()->back()->with('error', 'Employee Name And Review Employee Name Should Not be Same');

        } else if ($request->txt_reviewtype == -1 || $request->txt_reviewtype == null) {

            return redirect()->back()->with('error', 'Review Type  Not Selected');

        } else {
            try {
                $user = DB::table('intern__planned__schedules')
                    ->where('Intern_Planned_Schedule_ID', $request->txt_ipsID)
                    ->update(['Emp_ID' => $request->txt_empId,
                        'Review_date' => $request->dt_ReDate,
                        'Review_Type'=>$request->txt_reviewtype,
                        'Topic_ID' => $request->txt_topicname,
                        'Sub_Topic_ID' => $request->txt_SubTopicName,
                        'Topic_Eval_ID' => $request->txt_TopicEvalName,
                        'Review_Emp_ID' => $request->txt_ReEmpId,
                        'Start_Time' => $request->txt_StartTime != null ? $request->txt_StartTime : '',
                        'End_time' => $request->txt_EndTime != null ? $request->txt_EndTime : '',
                        'Review_score'=>$request->txt_reviewscore,
                        'Description' => $request->txt_description != null ? $request->txt_description : '',
                        'Created_By' => session()->get('user_id'),
                        'created_at' => $current_time]);


                return redirect('SkillEmployeeInternPlnSchiList')->with('success', "Record Updated Successfully");


            } catch (Exception $e) {


                //return $e->getMessage();

                return view('excaption');

            }

        }
    }

    //add skill intern planned schdule

    public function Add_employee_skill_Intern_Planned_Schedule()
    {
        try {
            $emp = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
                ->orderBy('emp_name')
                ->get();

            $reemp = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
                ->orderBy('emp_name')
                ->get();

            $topc = DB::table('topic_masters')
                ->select('topic_masters.topic_id', 'topic_masters.topic_description')
                ->where('topic_masters.Enabled', '=', '0')
                ->orderBy('topic_description')
                ->get();

            $sbtopc = DB::table('sub__topic_masters')
                ->select('sub__topic_masters.Sub_Topic_Id', 'sub__topic_masters.Topic_Description')
                ->where('sub__topic_masters.Enabled', '=', '0')
                ->orderBy('topic_description')
                ->get();

            $topceval = DB::table('topic_evaluation_masters')
                ->select('topic_evaluation_masters.Topic_Eval_Id',
                    'topic_evaluation_masters.Evaluation_Description')
                ->where('topic_evaluation_masters.Enabled', '=', '0')
                ->orderBy('Evaluation_Description')
                ->get();


            $type = DB::table('type_masters')
                ->select('type_masters.type_Id',
                    'type_masters.type_desc')
                ->where('type_masters.Enabled', '=', '0')
                ->orderBy('type_desc')
                ->get();


            return view('employee_skill_intern_planned_schedule_add')->with([
                'employee' => $emp,
                'topic' => $topc,
                'subtopic' => $sbtopc,
                'topiceval' => $topceval,
                'reviemp' => $reemp,
                'types'=>$type
            ]);


        } catch (Exception $e) {


            return $e->getMessage();

            //  return view('excaption');

        }
    }

    /*end skill intern planned schdule*/



    //this for list attendance

    public function get_allInternattendance()
    {

        try {
            $obj = DB::table('attendances')
                ->join('employee_masters', 'employee_masters.Emp_Id', '=',
                    'attendances.Emp_id')
                ->join('course_masters', 'course_masters.course_id', '=',
                    'attendances.Course_id')
                ->leftJoin('collage_masters','collage_masters.collage_id',
                    '=','course_masters.collage_id')
                ->select('attendances.*', 'employee_masters.emp_name',
                    'course_masters.company_program','collage_masters.collage_name')
                ->where('attendances.Enabled', '=', 0)
				->where('employee_masters.type','=',3)
                ->get();

            return view('intern_attendance_list')->with('attendance', $obj);


        } catch (Exception $e) {


            //   return $e->getMessage();

            return view('excaption');

        }


    }

    //this for store attendance

    public function store_Internattendance(Request $request)
    {
        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_empid == -1 || $request->txt_empid == null) {


            return redirect('InternAddAttendance')->with('error', 'Employee Name Not Selectd');

        } else if ($request->txt_courseid == -1 || $request->txt_courseid == null) {

            return redirect('InternAddAttendance')->with('error', 'Course Not Selected');

        } else {
            try {

                $user = DB::table('attendances')
                    ->select('attendance_id')
                    ->where('Emp_id', '=', $request->txt_empid)
                    ->where('Date', '=', $request->dt_date)
                    ->first();

                if ($user) {

                    return redirect()->back()->withInput()->with('success', 'Employees Attendance Already Fill for ' . $request->dt_date);

                } else {
                    $obj = DB::table('attendances')
                        ->insert(['Emp_id' => $request->txt_empid,
                            'Date' => $request->dt_date,
                            'Activity' => $request->txt_activity != null ? $request->txt_activity : '',
                            'Course_id' => $request->txt_courseid,
                            'Created_By' => session()->get('user_id'),
                            'created_at' => $current_time,
                        ]);

                    return redirect('InternAttendanceList');
                }
            } catch (Exception $e) {

                //return $e->getMessage();
                return view('excaption');
            }
        }
    }

    //this destroy for attendance

    public function destroy_Internattendance(Request $request)
    {
        try {

            $user = DB::table('attendances')->where('attendance_id', '=', $request->id)->update(['Enabled' => 1]);

            if ($user) {

                return response()->json((['msg' => 'Record Delete Successfully', 'status' => 'success']));
            } else {

                return response()->json(['msg' => 'Failed deleting the Record', 'status' => 'failed']);
            }

        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }

    }

    //this for show attendance

    public function show_Internattendance($id)
    {
        try {

            $user = DB::table('attendances')->where('attendance_id', '=', $id)->first();

            $emp = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
                ->orderBy('emp_name')
                ->get();

            /* $cors = DB::table('course_masters')
                 ->select('course_masters.course_id', 'course_masters.company_program')
                 ->where('course_masters.Enabled', '=', '0')
                 ->get();*/

            $cors = DB::table('course_masters')
                ->join('collage_masters', 'collage_masters.collage_id', '=', 'course_masters.collage_id')
                ->select(DB::raw('CONCAT(collage_masters.collage_name, " - ", course_masters.company_program) as name'), 'course_masters.course_id')
                ->where('course_masters.Enabled', '=', '0')
                ->orderBy('collage_masters.collage_name')
                ->get();

            /*$course = DB::table('course_masters')
                ->join('collage_masters', 'collage_masters.collage_id', '=', 'course_masters.collage_id')
                ->select(DB::raw('CONCAT(collage_masters.collage_name, " - ", course_masters.company_program) as name'), 'course_masters.course_id')
                ->where('course_masters.Enabled','=','0')
                ->get();*/


            return view('intern_attendance_edit')->with(['attendancess' => $user,
                'Employee' => $emp, 'Course' => $cors]);

        } catch (Exception $e) {


            //return $e->getMessage();

            return view('excaption');

        }


    }

    //this for edit  attendance

    public function edit_Internattendance(Request $request)
    {

        $current_time = Carbon::now()->toDateTimeString();

        if ($request->txt_empid == -1 || $request->txt_empid == null) {

            return redirect('InternAddAttendance')->with('error', 'Employee Name Not Selectd');

        } else if ($request->txt_courseid == -1 || $request->txt_courseid == null) {

            return redirect('InternAddAttendance')->with('error', 'Course Not Selected');

        } else {
            try {
                $user = DB::table('attendances')
                    ->where('attendance_id', $request->txt_attID)
                    ->update([//'Emp_id' => $request->txt_empid,
                        'Date' => $request->dt_date,
                        'Activity' => $request->txt_activity != null ? $request->txt_activity : '',
                        'Course_id' => $request->txt_courseid,
                        'LastUpdated_By' => session()->get('user_id'),
                        'updated_at' => $current_time]);


                return redirect('InternAttendanceList')->with('success', "Record Updated Successfully");


            } catch (Exception $e) {


                // return $e->getMessage();

                return view('excaption');

            }

        }

    }

    //add attendance
    public function AddInternAttendance()
    {
        try {
            $emp = DB::table('employee_masters')
                ->select('employee_masters.emp_id', 'employee_masters.emp_name')
                ->where('employee_masters.Enabled', '=', '0')
				->where('employee_masters.type','=',3)
                ->orderBy('emp_name')
                ->get();

            /*  $cors = DB::table('course_masters')
                  ->select('course_masters.course_id', 'course_masters.company_program')
                  ->where('course_masters.Enabled', '=', '0')
                  ->get();*/


            $cors = DB::table('course_masters')
                ->join('collage_masters', 'collage_masters.collage_id', '=', 'course_masters.collage_id')
                ->select(DB::raw('CONCAT(collage_masters.collage_name, " - ", course_masters.company_program) as name'), 'course_masters.course_id')
                ->where('course_masters.Enabled', '=', '0')
                ->get();


            return view('intern_attendance_add')->with([
                'employee' => $emp,
                'cource' => $cors,
            ]);

        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }
    }

    /*end attendance*/

	// Report : Course Time Table
	public function rpt_Course_Time_Table()
    {
        try {
            $From_Date = date('Y-m-d');
			$To_Date = date('Y-m-d');

            /*  $cors = DB::table('course_masters')
                  ->select('course_masters.course_id', 'course_masters.company_program')
                  ->where('course_masters.Enabled', '=', '0')
                  ->get();*/


            $cors = DB::table('course_masters')
                ->join('collage_masters', 'collage_masters.collage_id', '=', 'course_masters.collage_id')
                ->select(DB::raw('CONCAT(collage_masters.collage_name, " - ", course_masters.company_program) as name'), 'course_masters.course_id')
                ->where('course_masters.Enabled', '=', '0')
                ->get();

			
            return view('rpt_course_time_table')->with([
                'from_date' => $From_Date,
                'to_date' => $To_Date,
				'data' => $cors
            ]);

        } catch (Exception $e) {


            // return $e->getMessage();

            return view('excaption');

        }
    }

}











