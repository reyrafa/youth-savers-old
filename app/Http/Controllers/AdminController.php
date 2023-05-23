<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Branch_under;
use App\Models\Depositor;
use App\Models\guardian;
use App\Models\history_of_transaction;
use App\Models\LvlOfTransac;
use App\Models\officer;
use App\Models\OfficialMember;
use App\Models\permission;
use App\Models\position;
use App\Models\positionDescrip;
use App\Models\StatusOfTransaction;
use App\Models\TotalDepositModel;
use App\Models\Transaction;
use App\Models\uploaded_document;
use App\Models\User;
use App\Models\user_status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //redirect to admin homepage
    public function index(){
        $transaction = Transaction::all();
        $depositor = Depositor::all();
        $offical_member = OfficialMember::all();
        $position = position::all()->where('relation_id', Auth::id());

        //counting members per branch
        $cdo = 0;
        $misor= 0;
        $buk =0;
        $car =0;
        $bohol=0;

        foreach($offical_member as $official_info){
            if($official_info->isAlumni == '1'){
                
                foreach($depositor as $depositor_info){
                    if($depositor_info->depositor_id == $official_info->depositor_id){
                        if($depositor_info->branch_id == '1'){
                            $cdo++;
                        }
                        else if($depositor_info->branch_id == '2'){
                            $misor++;
                        }
                        else if($depositor_info->branch_id == '3'){
                            $buk++;
                        }
                        else if($depositor_info->branch_id == '4'){
                            $car++;
                        }
                        else if($depositor_info->branch_id == '5'){
                            $bohol++;
                        }
                    }
                }
            }
        }
        return view('officer.admin.home.index', compact('cdo', 'misor', 'buk', 'car', 'bohol', 'position'));
    }




    //get the data of the officer and displayed on the table
    public function usermanagement(){
        $users = officer::all();
        $position = position::all()->where('relation_id', Auth::user()->id);
        $position_description = positionDescrip::all();
        $userPos = position::all();
        $permission = permission::all();
        $user_status = User::all();
        $branch = Branch::all();
        $status = user_status::all();
        $branch_under = Branch_under::all();
        return view('officer.admin.usermanagement.index', compact('users', 'position','userPos', 'position_description', 'permission', 'user_status', 'status', 'branch', 'branch_under'));
    }

    //redirect to transaction history page
    public function transactionhistory(){
        $history_of_transaction = history_of_transaction::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
        $depositor = Depositor::all();
        $status_of_transaction = StatusOfTransaction::all();
        $level_of_transaction = LvlOfTransac::all();
        $position = position::all()->where('relation_id', Auth::user()->id);
        return view('officer.admin.transactionhistory.index', compact('history_of_transaction', 'position','depositor', 'status_of_transaction', 'level_of_transaction'));
    }
    
    public function add_officer(){

        $position = position::all()->where('relation_id', Auth::user()->id);
        return view('officer.admin.usermanagement.adduser', compact('position'));
    }

    //add an oic officer
    public function add_oic_officer(Request $request){
       // return $request->input();
       $officer = new officer();
       $officer->officer_id = $request->officer_id;
       $officer->branch_id = $request->branch_id;
       $officer->branch_under_id = $request->branch_under_id;
       $officer->firstname = $request->firstname;
       $officer->lastname = $request->lastname;
       $officer->middlename = $request->middlename;
       $officer->relation_id = $request->user_id;

       $officer->save();

       $user = new User();
       $user->email = $request->email;
       $user->password = Hash::make($request->password);
       $user->scope = 'oic_officer';
       $user->user_status_id = '1';
    
        $user->save();

        $position = new position();
        $position->officer_id = $request->officer_id;
        $position->org_id = '1';
        $position->position_id = $request->position_id;
        $position->permission_id = '3';
        $position->relation_id = $request->user_id;
        $position->save();
        return redirect('/admin/user/management');
    }

    
    public function add_officer_id(Request $request){
        $officer_id = officer::select('officer_id')->where('officer_id' , $request->id)->take(100)->get();
        return response()->json($officer_id);
    }

    //function for search query
    public function search_user(Request $request){
        if(isset($_GET['query'])){
           $searchText = $_GET['query'];
           $id_num = DB::table('officers')->where('firstname', 'LIKE', '%' .$searchText.'%')->paginate(2);
           return redirect('/admin/user/management', ['firstname' =>$id_num]);
        }
        else{
        return redirect('/admin/user/management');
        }
    }

    //redirect admin to update officer page  with his current data
    public function update_officer($relation_id){
    
       $officer = officer::all()->where('relation_id', $relation_id);
       $branch = Branch::all();
       $user_login = User::all()->where('id', $relation_id);


       $position = position::all()->where('relation_id', $relation_id);
       $position_descript = positionDescrip::all();
        return view('officer.admin.usermanagement.update_officer', compact('officer', 'branch', 'user_login', 'position', 'position_descript'));
    }

    //update the oic officer data
    public function update_oic_officer(Request $request){
        $data = officer::find($request->id);
        $data->officer_id = $request->officer_id;
        $data->branch_id = $request->branch_id;
        $data->branch_under_id = $request->branch_under_id;
        $data->firstname = $request->firstname;
        $data->lastname = $request->lastname;
        $data->middlename = $request->middlename;
        $data->updated_at = now();
        $data->save();

        $position = position::all()->where('relation_id', $request->relation_id);

        foreach($position as $pos_info){
            $id = $pos_info->id;
        }

        $positionsample = position::find($id);
        $positionsample->position_id = $request->position_id;
        $positionsample->save();

        $data_login = User::find($request->relation_id);
        $data_login->user_status_id = $request->account_status;
        $data_login->save();
        return redirect('/admin/user/management');
    }

    //redirect to ysc page
    public function ysc_member(){
        $official_member = OfficialMember::all()->where('isAlumni', 2);
        $user = User::all();
        $depositor = Depositor::all();
        $branch = Branch::all();
        $branch_under = Branch_under::all();
        $position = position::all()->where('relation_id', Auth::user()->id);
        return view('officer.admin.yscmember.index', compact('official_member', 'position', 'depositor', 'user', 'branch', 'branch_under'));
    }




    //redirect to the transaction history selecting year and month
    public function history(Request $req){
        $year = $req->year;
        $month = $req->month;
        $history_of_transaction = history_of_transaction::whereMonth('created_at', $month)->whereYear('created_at', $year)->get();
        $depositor = Depositor::all();
        $status_of_transaction = StatusOfTransaction::all();
        $level_of_transaction = LvlOfTransac::all();
        $position = position::all()->where('relation_id', Auth::user()->id);
        return view('officer.admin.transactionhistory.index', compact('history_of_transaction', 'position','depositor', 'status_of_transaction', 'level_of_transaction'));

    }


    public function YSCMmberPrint(Request $req){
        $officer = officer::all()->where('relation_id', Auth::user()->id);
        $data = Depositor::all()->where('depositor_id', $req->depositor_id);
        $guardians = guardian::all()->where('depositor_id', $req->depositor_id);
        $branch = Branch::all();
        $branch_under = Branch_under::all();
        $userCredentials = User::all()->where('id', $req->depositor_id);
        $profile_pic = uploaded_document::all()->where('depositor_id', $req->depositor_id);
        $position = position::all()->where('relation_id', Auth::user()->id);


        $amount = 0;
        $totalDeposit = TotalDepositModel::all()->where('relationID', $req->depositor_id);
        foreach($totalDeposit as $depositInfo){
           $value = $depositInfo->amount;
           $amount = $value + $amount;
           $amount = $amount;
          
        }

        return view('officer.admin.report.indvMmbr', compact('position', 'userCredentials', 'amount',
         'officer', 'data', 'guardians', 'branch', 'branch_under', 'profile_pic'));
    }
}
