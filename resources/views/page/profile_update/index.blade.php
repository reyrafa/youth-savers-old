<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           PERSONAL INFORMATION
        </h2>
    </x-slot>
    <div class="row mt-4 ml-2 mr-2">
        <div class="col-md-3">
            <div class="bg-white shadow rounded p-3 mb-3 ">
                @foreach($profile_pic as $profile_pic_info)
                <center>
                <img style="width: 150px; height: 100px; border-radius: 50%;" src="{{ asset('/uploads/Identification/'.$profile_pic_info->Identification) }}" alt="Image">  
                @foreach($depositor as $depositor_info)
                        <p class="text-success mt-2 fw-bold text-uppercase">{{$depositor_info->firstname}} {{$depositor_info->middlename }} {{$depositor_info->lastname}}</p>
                @endforeach
                </center>
                    
                @endforeach
                @if($profile_pic->isEmpty())
                
                @endif
            </div>
            <div class="bg-white p-5 mb-3 rounded shadow" style="text-align: center; font-size: 20px"> 
            @php
                $counter_for_process = 0;
            @endphp

            @foreach($transaction as $transaction_info)
               @if($transaction_info->level_id == '3' && $transaction_info->status_id == '2')
                    <h1 class="text-success">Youth Savers Member</h1>
                    <style>
                        #process_id{
                            display: none;
                        }
                    </style>
                @break

                @else
                    <h1 style="display: none;">{{$counter_for_process++}}</h1> 
                    @if($counter_for_process == 1)
                        
                        <p class="" id="process_id" style="font-size: 25px; font-weight:bold"><i class="fa fa-hourglass-end text-success" aria-hidden="true"></i> Still Processing</p>
        
                    @endif

                
               @endif
            @endforeach 
            @if($transaction->isEmpty())
                    <p>Officially Member</p>
                @endif
            </div>
            <div class="bg-white rounded shadow hidden p-3">
                
            <p class="text-danger text-justify" style="text-align: justify;"><span class="text-danger">*</span> Please check your Data, Information will be count as final after validated by branch and cannot be edited.</p>
            </div>
        </div>
        <div class="col-md-8 mb-5">
            <div class="bg-white p-5 shadow rounded ">
                <div class="row mb-3">
                    <div class="col-sm-9">
                        <h1 style="font-size: 30px;"><b>Depositor's Personal Information </b></h1>
                    </div>
                    
                </div>
            <div class="table-responsive">
            <table class="table w-full">
                <tbody>
                    <tr>
                        <td class="pl-0">
                          <span class="fw-bold text-primary" style="font-size: 25px;">BASIC INFORMATION <i class="fa fa-info-circle" aria-hidden="true"></i></span>
                        </td>
                        <td>
                  
                        </td>
                    </tr>         
                @foreach($depositor as $depositor_info)
                  <tr style="display: none;">   
                    <td>Depositor ID</td>
                    <td>{{$depositor_info->depositor_id}}</td>
                  </tr>
                  <tr>   
                    <td>Full Name</td>
                    <td>{{$depositor_info->firstname}} {{$depositor_info->middlename}} {{$depositor_info->lastname}} {{$depositor_info->suffix}}</td>
                  </tr>
                  <tr>   
                    <td>Date Of Birth</td>
                    <td>{{date('F d, Y', strtotime($depositor_info->date_of_birth))}}</td>
                  </tr>
                  <tr>   
                    <td>Gender</td>
                    <td>{{$depositor_info->gender}} </td>
                  </tr>
                  <tr>   
                    <td>Home Address</td>
                    <td>{{$depositor_info->home_address}} </td>
                  </tr>
                  <tr>   
                    <td>Contact Number</td>
                    <td>{{$depositor_info->contact_no}} </td>
                  </tr>
                 
                @endforeach
            
                    <tr>
                        <td>
                          <span class="fw-bold text-primary" style="font-size: 25px;">GUARDIAN</span>
                        </td>
                        <td>
                        </td>
                    </tr>
                @foreach($guardians as $guardians_info)
                    <tr>   
                        <td>Full Name</td>
                        <td>{{$guardians_info->guardian_firstname}} {{$guardians_info->guardian_middlename}} {{$guardians_info->guardian_lastname}} {{$guardians_info->guardian_suffix}}</td>
                    </tr>
                    <tr>   
                        <td>Birth Date</td>
                        <td>{{$guardians_info->guardian_date_of_birth}} </td>
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
                @foreach($depositor as $depositor_info)
                    <tr>   
                        <td>Location</td>
                        @foreach($branch as $branch_info)
                            @if($depositor_info->branch_id==$branch_info->branch_id)
                        <td>{{$branch_info->branch_name}} </td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>   
                        <td>Branch</td>
                       @foreach($branch_under as $branch_under_info)
                            @if($depositor_info->branch_under_id == $branch_under_info->id)
                        <td>{{$branch_under_info->branch_name}} </td>
                            @endif
                       @endforeach
                    </tr>
                    
                @endforeach
                        
                </tbody>    
            </table>
                @foreach($transaction as $transaction_info)
                        @if($transaction_info->level_id == '3' && $transaction_info->status_id == '2')
                            <style>
                                #success{
                                    display: none;
                                }
                            </style>
                        @endif
                    @endforeach
                    <div id="success" style="text-align:right">
                        <form action="/update_personal_info" method="GET">
                            @csrf
                            <x-jet-button class="btn btn-primary" type="submit">Update Information</x-jet-button>
                        </form>
                        
                    </div>
            </div>
        </div>
        
        
    </div>
    
    @push('script')
    <script>
    $(document).ready(function(){
    var id = $('#branch_id').val()
    var input = " "
    var div = $(this).parent().parent()
    $.ajax({
        type: 'get',
        url: '{!!URL::to("Branch")!!}',
        data : {'id':id},
        success:function(data){
                    console.log(data)
                
                   $('#branch_name').val(obj.branch)
                    },
        error :function(error){
                    console.log("fails")
                    console.log(JSON.stringify(error))
            }
    })
        
    })   
    </script>
    @endpush
    
</x-app-layout>
