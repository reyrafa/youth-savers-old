@extends('officer.admin.layouts.dashboard')
@section('content')
    <div class="mt-4 row pt-4">
        <div class="col-md-12">
            <h1 style="text-transform: uppercase; font-size:20px"><b> User management</b></h1>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-3 mb-3">
        
        </div>
        <div class="col-md-3 mb-3">
            
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-3 mb-3" style="display: none;">
            <form 
                action="/" 
                method="GET"
                >
                <div class="input-group">   
                    <div class="form-outline">
                      <input 
                          type="search" 
                          id="search" 
                          name="query"
                          class="form-control" 
                          placeholder="Search Officer"/>

                    </div>
                    <button type="button" class="btn btn-success disabled">
                        <i class="fa fa-search"></i>
                    </button>
                </div>  
            </form>
        </div> 
        <div class="col-md-2">
            <a href="/admin/user/management/add/user" class="btn btn-primary"><i class="fa fa-address-book"></i> Add User</a>
        </div>
    </div>
    <div class="bg-white mt-3 overflow-hidden shadow rounded px-4 py-4">
    <div class="table-responsive">

            <table class="table stripe hover table-bordered" id="user_table"> 
                <thead>
                    <th class="border">No</th>
                    <th class="border">Company ID</th>
                    <th class="border">Full Name</th>
               
                    <th class="border">Branch</th>
                    <th class="border">Created On</th>
                    <th class="border">Last Update</th>
                    <th class="border">Position</th>
                    <th class="border">Account Status</th>
                    <th class="border">Action</th>
                </thead>
                <tbody >
                    @php 
                        $count = 0;
                    @endphp
                @foreach($users as $users_info)
                    @foreach($userPos as $position_info)
                        @if($users_info->relation_id == $position_info->relation_id)
                            @if($position_info->position_id != '1')
                <tr>
                   
                    <td><a class="btn disabled" style="background: #808080; color:white; width: 40px; height: 40px; border-radius: 5px;">{{++$count}}</a></td>
                    
                    <td>{{$users_info->officer_id}}</td>
                    <td>{{$users_info->firstname}} {{$users_info->lastname}}</td>

                        @foreach($branch_under as $branch_under_info)
                            @if($users_info->branch_under_id != null)
                                @if($users_info->branch_under_id == $branch_under_info->id)
                                    <td>{{$branch_under_info->branch_name}}</td>
                                @endif
                            @elseif($users_info->branch_under_id == null)
                            <td class="">Head Office</td>
                            @break
                            @endif
                        @endforeach
                    @if($users_info->created_at != null)
                        <td class="" style="font-size: 12px;">{{$users_info->created_at->toDayDateTimeString()}}</td>
                    @else
                        <td></td>
                    @endif

                    @if($users_info->updated_at != null)
                        @if($users_info->updated_at != $users_info->created_at)
                            <td class="text-primary" style="font-size: 12px;">{{$users_info->updated_at->diffForHumans(['parts' => 2])}}</td>
                        @else
                            <td></td>
                        @endif
                    @else
                        <td></td>
                    @endif

                    @foreach($userPos as $position_info)
                        @if($users_info->relation_id == $position_info->relation_id)
                            @foreach($position_description as $position_descript)
                                @if($position_info->position_id == $position_descript->id)
                                    @if($position_descript->position == 'admin')
                                        <td><span style="background-color: #013220; color:white; font-size:12px; padding:7px; border-radius:5px">Admin</span></td>
                                    @elseif($position_descript->position == 'personnel')
                                        <td><span style="background-color: #00bfff; color:white; padding:7px; font-size:12px; border-radius:5px">Personnel</span></td>
                                    @elseif($position_descript->position == 'finance')
                                        <td><span style="background-color: #ffff00; padding:7px; font-size:12px; border-radius:5px">Finance</span></td>
                                    @elseif($position_descript->position == 'branch')
                                        <td><span style="background-color: #f4a460; color:white; padding:7px; font-size:12px; border-radius:5px">Branch</span></td>
                                    @endif
                                @endif
                            @endforeach

                       <!-- @foreach($permission as $permission_info)
                            @if($permission_info->id == $position_info->permission_id)
                            <td>{{$permission_info->permission_description}}</td>
                            @endif
                        @endforeach-->
                        @endif
                    @endforeach
                    
                    @foreach($user_status as $status_info)
                        @if($users_info->relation_id == $status_info->id)
                        @if($status_info->scope == 'oic_officer')
                            @if($status_info->user_status_id == '1')
                                <td class="text-success"><label style=" width: 10px;
                                            height: 10px;
                                            background: #4bc475;
                                            border-radius:50%;"
                                            > </label> Enabled</td> 
                            @else
                                <td class="text-danger"> <label style=" width: 10px;
                                            height: 10px;
                                            background: red;
                                            border-radius:50%"> </label> Disabled</td>          
                            @endif
                        @else
                            <td></td>
                        @endif
                        @endif
                    @endforeach
                    @foreach($userPos as $position_descript)
                        @if($users_info->relation_id == $position_descript->relation_id)
                            @if($position_descript->position_id != '1')
                            <td>
                                <a type="button" 
                                    href={{"/admin/user/management/update/officer/".$users_info->relation_id}} 
                                    class="btn btn-primary update mb-1"
                                    >
                                    <i 
                                    class="fa fa-refresh" 
                                    aria-hidden="true"></i>
                                </a>
                              <!--  <a href="#"
                                    class="btn btn-success"
                                    style="font-size: 0.8em; display:none"
                                    ><i class="fa fa-eye" 
                                    aria-hidden="true"></i>-->
                                    
                               
                            </td>     
                           
                            @endif
                        @endif
                    @endforeach
                </tr>
                @endif
                @endif
                @endforeach
                @endforeach


                
                
              
                </tbody>    
            </table>
  
            </div>
    </div>
@endsection
@push('style')
    <style>
        #search, #branch, #listsearch, #branch_under, #offId, #firstname, #lastname, #middlename, #branch, #branch_under, #account_status{
            box-shadow: none;
        }
    </style>

    
@endpush
@push('script')

        <script>
           
            $(document).ready( function () {

                //data table
               dtable = $('#user_table').DataTable({
                    "language": {
                    "search": "Filter records:"
                    },
                    /*"className": "text-center nosort text-nowrap",*/
                   "lengthMenu": [5, 10, 20, 50],
                   "bLengthChange": true,
                   /*"columnDefs":[
                       {"className": "dt:center", "targets": "_all"}
                   ],*/ 
               
                   "order" :[[0, "asc"]],
                   
                   
                  
                });

                //search function
               /* $('#search').keyup(function(){
                    dtable.search($(this).val()).draw();
                })*/
                
                } );


        </script>
@endpush

@push('css')
    <style>
         div.dataTables_length {
            margin-top: 10px;
            margin-bottom: 20px;

            }
         /*th.dt-center, td.dt-center { text-align: center; }*/
    </style>
@endpush