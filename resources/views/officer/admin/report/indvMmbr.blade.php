@extends('officer.admin.layouts.dashboard')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 style="font-size: 25px; display:none">Youth Saver Profile</h1>
        </div>
        <div class="col-md-3">
                <div class="bg-white mt-3 overflow-hidden shadow rounded px-3 py-4">
                    @foreach($profile_pic as $profile_pic_info)
                        <center>
                        <img style="width: 150px; height: 100px; border-radius: 50%;" src="{{ asset('/uploads/Identification/'.$profile_pic_info->Identification) }}" alt="Image">
                        </center>                         
                    @endforeach
                    @foreach($data as $depositor)
                        <p class="text-success mt-2 fw-bold text-uppercase">{{$depositor->firstname}} {{$depositor->middlename }} {{$depositor->lastname}}</p>
                    @endforeach
                
                </div>

            </div>
            
            <div class="col-md-8">
                <div class="bg-white mt-3 overflow-hidden shadow rounded px-4 py-4">
                   
                    <div class="table-responsive">
                        <table class="table w-full">
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="fw-bold text-primary" style="font-size: 25px;">Basic Information</p>
                                    </td>
                                    <td></td>
                                </tr>
                                @foreach($data as $depositor)
                                <tr>
                                    <td>Fullname</td>
                                    <td>{{$depositor->firstname}} {{$depositor->middlename}} {{$depositor->lastname}}</td>
                                </tr>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td>{{date('F d, Y', strtotime($depositor->date_of_birth))}}</td>
                                </tr>
                                <tr>
                                    <td>Age</td>
                                    <td>{{\Carbon\Carbon::parse($depositor->date_of_birth)->age}} years old</td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>{{$depositor->gender}}</td>
                                </tr>
                                <tr>
                                    <td>Home Address</td>
                                    <td>{{$depositor->home_address}}</td>
                                </tr>
                                <tr>
                                    <td>Contact No</td>
                                    <td>{{$depositor->contact_no}}</td>
                                </tr>
                                @endforeach

                               
                                <tr>
                                    <td>
                                        <p class="fw-bold text-primary" style="font-size: 25px;">Guardian Information</p>
                                    </td>
                                    <td></td>
                                </tr>
                                @foreach($guardians as $guardians_info)
                                <tr>   
                                    <td>Full Name</td>
                                    <td>{{$guardians_info->guardian_firstname}} {{$guardians_info->guardian_middlename}} {{$guardians_info->guardian_lastname}} {{$guardians_info->guardian_suffix}}</td>
                                </tr>
                                <tr>   
                                    <td>Birth Date</td>
                                    <td>{{date('F d, Y', strtotime($guardians_info->guardian_date_of_birth))}} </td>
                                </tr>
                                <tr>   
                                    <td>Gender</td>
                                    <td>{{$guardians_info->guardian_gender}} </td>
                                </tr>
                                <tr>   
                                    <td>Relationship</td>
                                    <td>{{$guardians_info->guardian_relationship_to_depositor}} </td>
                                </tr>
                                <tr>   
                                    <td>Civil Status</td>
                                    <td>{{$guardians_info->guardian_civil_status}} </td>
                                </tr>
                                <tr>   
                                    <td>OIC Regular Member?</td>
                                    <td>{{$guardians_info->guardian_oic_member}} </td>
                                </tr>
                                <tr>   
                                    <td>Home Address</td>
                                    <td>{{$guardians_info->guardian_home_address}} </td>
                                </tr>
                                <tr>   
                                    <td>Present Address</td>
                                    <td>{{$guardians_info->guardian_present_address}} </td>
                                </tr>
                                <tr>   
                                    <td>Contact Number</td>
                                    <td>{{$guardians_info->guardian_contact_no}} </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>
                                        <span class="fw-bold text-primary" style="font-size: 25px;">BRANCH</span>
                                    </td>
                                    <td>
                                    </td>
                                </tr>

                                @foreach($data as $depositor_info)
                                <tr>   
                                    <td>Branch</td>
                                    @foreach($branch as $branch_info)
                                        @if($depositor_info->branch_id==$branch_info->branch_id)
                                    <td>{{$branch_info->branch_name}} </td>
                                        @endif
                                    @endforeach
                                </tr>
                                <tr>   
                                    <td>Branch Under</td>
                                @foreach($branch_under as $branch_under_info)
                                        @if($depositor_info->branch_under_id == $branch_under_info->id)
                                    <td>{{$branch_under_info->branch_name}} </td>
                                        @endif
                                @endforeach
                                </tr>
                    
                                @endforeach
                                <tr>
                                    <td>
                                        <p class="fw-bold text-primary" style="font-size: 25px;">USER CREDENTIALS</p>
                                    </td>
                                    <td></td>
                                </tr>
                                @foreach($userCredentials as $creInfo)
                                    <tr>
                                        <td>Email Address</td>
                                        <td>{{$creInfo->email}}</td>
                                    </tr>
                                    <tr style="display: none;">
                                        <td>Password</td>
                                        @php 
                                            $text = $creInfo->email;
                                            $len = strlen($creInfo->email);
                                        @endphp
                                        <td>
                                        @for($i = 0; $i < $len; $i++)
                                            @if($i <=3)
                                                {{$text[$i]}}
                                            @elseif($i>3 && $i<=10)
                                            {{"*"}}
                                            @else
                                                {{$text[$i]}}
                                            @endif
                                        @endfor
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>
                                        <p class="fw-bold text-primary" style="font-size: 25px;">DEPOSIT</p>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Amount</td>
                                    <td>PHP {{number_format($amount,0, ' . ' , ' , ')}}.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                        
                   
                </div>
            </div>
        
       
    </div>
  
        

</div>
@endsection
@push('script')

        <script>
           
            $(document).ready( function () {
            })

             

        </script>
@endpush

@push('css')
    <style>
       
    </style>
@endpush
