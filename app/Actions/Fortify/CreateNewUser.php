<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Depositor;
use App\Models\DocumentHistory;
use App\Models\DocumentsModel;
use App\Models\guardian;
use App\Models\history_of_transaction;
use App\Models\OnlineOrUploadedModel;
use App\Models\ReferralModel;
use App\Models\Transaction;
use App\Models\TransactionModel;
use App\Models\uploaded_document;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {


       
       Validator::make($input, [
           
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'scope' => ['required' , 'string'],
            'user_status_id' => ['required' ,'integer'],

            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'middlename' => ['required', 'string', 'max:255'],
            //'suffix' => ['integer', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            //'gender'=> ['required', 'string'],
            'home_address' => ['required' , 'string', 'max:255'],
            'contact_no' => ['required' , 'numeric', 'min:8'],
            'branch_id' => ['required', 'integer'],
            'branch_under_id'=>['required', 'integer'],
            

            'guardian_firstname' => ['required', 'string', 'max:255'],
            'guardian_lastname' => ['required', 'string', 'max:255'],
            'guardian_middlename' => ['required', 'string', 'max:255'],
            //'guardian_suffix' => ['string', 'max:255'],
            'guardian_date_of_birth' => ['required', 'date'],
            //'guardian_gender'=> ['required', 'integer'],
            'guardian_relationship_to_depositor'=> ['required', 'string'],
            'guardian_civil_status'=> ['required', 'string'],
            'guardian_oic_member'=> ['required', 'string'],
            'guardian_home_address' => ['required' , 'string', 'max:255'],
            'guardian_present_address' => ['required' , 'string', 'max:255'],
            'guardian_contact_no' => ['required' , 'numeric','min:8'],
            
            //transaction
            'status_id' => ['required' , 'integer'],
            'level_id' => ['required', 'integer'], 

            //documents uploaded
            'signature' => ['required', 'image', 'mimes:jpg,png,jpeg'],
            'Identification' => ['required', 'image', 'mimes:jpg,png,jpeg'],
            'birth_certificate' => ['required', 'image', 'mimes:jpg,png,jpeg'],           
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        
        $user = new User();
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->scope = $input['scope']; 
        $user->user_status_id = $input['user_status_id'];
        $user->save();
       // $user = User::create([
        //    'email' => $input['email'],
         //   'password' => Hash::make($input['password']),
         //   'scope' => $input['scope'],
        //    'user_status_id' => $input['user_status_id']
       // ]);

        $referral = new ReferralModel();
        $referral->firstname = $input['referral_fname'];
        $referral->lastname = $input['referral_lname'];
        $referral->middlename = $input['referral_mname'];
        $referral->branch_id = $input['branch_idR'] ?? null;
        $referral->branch_under_id = $input['branch_under_idR'];
        $referral->depositor_id = $user->id;
        $referral->save();
       /* $referral = ReferralModel::create([
            'firstname' => $input['referral_fname'],
            'lastname' =>$input['referral_lname'],
            'middlename' =>$input['referral_mname'],
            'branch_id' =>$input['branch_idR'],
            'branch_under_id' =>$input['branch_under_idR'],
            'depositor_id' => $input['user_id'],
        ]);*/

    
       $depositor = Depositor::create([
            'depositor_id' => $user->id,
            'firstname' => $input['firstname'], 
            'lastname' =>$input['lastname'],
            'middlename' =>$input['middlename'],
            'suffix' =>$input['suffix'],
            'date_of_birth' =>$input['date_of_birth'],
            'gender' =>$input['gender'],
            'home_address' =>$input['home_address'],
            'contact_no' =>$input['contact_no'],
            'branch_id' =>$input['branch_id'],
            'branch_under_id' =>$input['branch_under_id'],
            'referral_id' => $referral->id,

        ]);

        guardian::create([
            'depositor_id' => $user->id,
            'guardian_firstname' => $input['guardian_firstname'],
            'guardian_lastname' =>$input['guardian_lastname'],
            'guardian_middlename' =>$input['guardian_middlename'],
            'guardian_suffix' =>$input['guardian_suffix'],
            'guardian_date_of_birth' =>$input['guardian_date_of_birth'],
            'guardian_gender' =>$input['guardian_gender'],
            'guardian_relationship_to_depositor' =>$input['guardian_relationship_to_depositor'],
            'guardian_civil_status' =>$input['guardian_civil_status'],
            'guardian_oic_member' =>$input['guardian_oic_member'],
            'guardian_home_address' =>$input['guardian_home_address'],
            'guardian_present_address' =>$input['guardian_present_address'],
            'guardian_contact_no' =>$input['guardian_contact_no'],
            'guardian_email_add' =>$input['guardian_email_add']
        ]);
        Transaction ::create([
            'depositor_id' =>$user->id,
            'status_id' => $input['status_id'],
            'level_id' => $input['level_id'],
        ]);
        
        $onlineOrUpload = new OnlineOrUploadedModel();
        $onlineOrUpload->depositor_id = $user->id;
        $onlineOrUpload->method = '1';
        $onlineOrUpload->save();
  
        $document = new uploaded_document();
        $document->depositor_id = $user->id;
        if(request()->hasFile('signature')){
            $file =request()->file('signature');
            $signature = $file->getClientOriginalName();
            $filename = time() . '.'.$signature;
            $file->move('uploads/Signature' , $filename);
            $document->Signature = $filename;
           
        }
        if(request()->hasFile('Identification')){
            $file_id =request()->file('Identification');
            $Id = $file_id->getClientOriginalName();
            $filename = time() . '.'.$Id;
            $file_id->move('uploads/Identification' , $filename);
            $document->Identification = $filename;
           
        }
        if(request()->hasFile('birth_certificate')){
            $file_birthcert =request()->file('birth_certificate');
            $birthcert = $file_birthcert->getClientOriginalName();
            $filename = time() . '.'.$birthcert;
            $file_birthcert->move('uploads/BirthCert' , $filename);
            $document->birth_certificate = $filename;
           
        }
        $document->save();
      
       
        history_of_transaction::create([
            'depositor_id' => $user->id,
            'status_id' => $input['status_id'],
            'level_id' => $input['level_id']
        ]);

      
        return $user;
    }
   
}
