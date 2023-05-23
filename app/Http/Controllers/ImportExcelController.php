<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Branch_under;
use App\Models\Depositor;
use App\Models\guardian;
use App\Models\officer;
use App\Models\OfficialMember;
use App\Models\OnlineOrUploadedModel;
use App\Models\TotalDepositModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ImportExcelController extends Controller
{
   public function index(Request $request){
    $filename = $request->excel_file;
    $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
    $allowed_ext = ['xls', 'csv', 'xlsx'];
    $inputFileName = $request->excel_file;
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

    //getting current data on user table
    $lastID = DB::table('users')->latest()->first();
   $lastID->id;
   
   //getting data on spreadsheet
   $data = $spreadsheet->getActiveSheet()->toArray();

   //counter
   $count = 0;


        foreach($data as $row){
         if($count >= 1){
            $cid = $row['0'];
            $lastname = $row['1'];
           $firstname = $row['2'];
           $middlename = $row['3'];
           $contact_no = $row['4'];
           $gender = $row['5'];
           $date_of_birth = $row['6'];
           $registrationDate = $row['7'];
           $newDate = date("Y-m-d", strtotime($date_of_birth));
           $guardian_name = $row['8'];
           $guardian_contact_no = $row['9'];
           $totalDeposit = $row['10'];
           $created_at = now();
           $updated_at = now();
           $officer = officer::all()->where('relation_id', Auth::user()->id);
           
           $branch = Branch_under::all();
           foreach($branch as $info){
            foreach($officer as $officerInfo){
            if($info->id == $officerInfo->branch_under_id){
               $branch_under = $info->branch_name;
               $branch_under_ID = $info->branch_under_id;
               $branch_ID = $info->id;
              
            };
         }
           }

          
           //register to user table
           $email  = $cid . $branch_under . "@gmail.com";
           $password = Hash::make($email);
           $scope = "depositor";
           $user = new User();
           $user->email = $email;
           $user->password = $password;
           $user->scope = $scope;
           $user->user_status_id = "1";
           $user->save();

           //register to official member table
            $official_member = new OfficialMember();
            $official_member->depositor_id = $user->id;
            $official_member->isAlumni = "1";
            $official_member->save();


           //register to depositor table
           $depositor = new Depositor();
           $depositor->depositor_id = $user->id;
           $depositor->firstname = $firstname;
           $depositor->lastname = $lastname;
           $depositor->middlename = $middlename;
           $depositor->date_of_birth = $newDate;
           $depositor->gender = $gender;
           $depositor->home_address = null;
           $depositor->contact_no = $contact_no;
           $depositor->branch_id =$branch_under_ID;
           $depositor->branch_under_id = $branch_ID;
           $depositor->created_at = $registrationDate;
           $depositor->updated_at = now();
           $depositor->save();
           
           //register to guardian table
           $guardian = new guardian();
           $guardian->depositor_id = $user->id;
           $guardian->guardian_firstname = $guardian_name;
           $guardian->guardian_contact_no = $guardian_contact_no;
           $depositor->created_at = now();
           $depositor->updated_at = now();
           $guardian->save();
          

           //add to total deposit table
           $DepositNum = new TotalDepositModel();
           $DepositNum->relationID = $user->id;
           $DepositNum->amount = $totalDeposit;
           $DepositNum->validatedBy = "0001000".$branch_under;
           $DepositNum->save();


           $onlineOrUpload = new OnlineOrUploadedModel();
            $onlineOrUpload->depositor_id = $user->id;
            $onlineOrUpload->method = '2';
            $onlineOrUpload->save();
         }
         else{
            $count++;
         }


           }

           return redirect('/branch/user/importingMember');

   }
}
