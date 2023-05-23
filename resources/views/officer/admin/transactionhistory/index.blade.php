@extends('officer.admin.layouts.dashboard')
@section('content')
    <div class="py-12 mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3>Transaction History</h3>
            </div>
        
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <select name="" id="monthSelect" class="form-select">
                            <option value="" disabled selected="true">Select Month...</option>
                            <option value="1">Jan</option>
                            <option value="2">Feb</option>
                            <option value="3">Mar</option>
                            <option value="4">Apr</option>
                            <option value="5">May</option>
                            <option value="6">Jun</option>
                            <option value="7">Jul</option>
                            <option value="8">Aug</option>
                            <option value="9">Sept</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="" id="yearSelect" class="form-select">
                            <option value="" disabled selected="true">Select Year...</option>
                            @php 
                                $startingYear = 2022;
                                $currentYear = date('Y');
                            @endphp
                            @while($startingYear <= $currentYear)
                                <option value="{{$startingYear}}">{{$startingYear}}</option>
                                @php
                                    $startingYear = $startingYear + 1;
                                    $startingYear = $startingYear;
                                @endphp
                            @endwhile
                        </select>
                    </div>
                    <div class="col-md-3">
                        <form action="/admin/user/transaction/history2" method="POST">
                            @csrf
                            <input type="text" value="" required style="display:none" id="month" name="month">
                            <input type="text" value="" required style="display: none;" id="year" name="year">
                            <button class="btn" style="background: #0f4924; color:white;"><i class="fa fa-filter" aria-hidden="true"></i> Filter Date</button>
                        </form>
                    </div>
                   
                </div>
                
            </div>
            <div class="col-md-3" style="display: none;">
                <div class="input-group">   
                    <div class="form-outline">
                        <input 
                            type="search" 
                            id="search" 
                            class="form-control" 
                            placeholder="Search Transaction"/>
                    </div>
                    <button type="button" class="btn btn-success disabled">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="bg-white mt-3 overflow-hidden shadow rounded px-4 py-4">
        <div class="table-responsive">
            <table class="table align-middle stripe hover table-bordered" id="transaction_history">
                <thead>
                    <th class="border">No</th>
                    <th class="border">Full Name</th>
                    <th class="border">Validated By</th>
                    <th class="border">Status</th>
                    <th class="border">Level</th>
                    <th class="border">Date Of Transaction</th>
                </thead>
                <tbody>
                    @php 
                    $count = 0;
                    @endphp
                    @foreach($history_of_transaction as $transaction_info)
                    <tr>
                        <td><a class="btn disabled" style="background: #808080; color:white; width: 40px; height: 40px; border-radius: 5px;">{{++$count}}</a></td>
                        
                        @foreach($depositor as $depositor_info)
                            @if($transaction_info->depositor_id == $depositor_info->depositor_id)
                            <td>{{$depositor_info->firstname}} {{$depositor_info->middlename}} {{$depositor_info->lastname}}</td>
                            @endif
                        @endforeach
                            <td>{{$transaction_info->officer_id}}</td>

                            @foreach($status_of_transaction as $status_info)
                                @if($status_info->status_of_transaction_id == $transaction_info->status_id)
                                    @if($status_info->status_of_transaction_name == 'Pending')
                                    
                                    <td><span style="background-color: #4c4cff; padding:7px; font-size:12px; color:white; border-radius:5px">Pending</span></td>
                                    @elseif($status_info->status_of_transaction_name == 'Approved')
                                    <td><span style="background-color: #66b266; padding:7px; font-size:12px; border-radius:5px; color:white">Approved</span></td>
                                    @elseif($status_info->status_of_transaction_name == 'Approved')
                                    <td><span style="background-color: #990000; padding:7px; font-size:12px; border-radius:5px; color:white">Invalid</span></td>
                                    @endif
                                @endif
                            @endforeach

                            @foreach($level_of_transaction as $level_info)
                                @if($transaction_info->level_id == $level_info->level_of_transaction_id)
                                    @if($level_info->level_description == 'OIC Personnel')
                                    <td><span style="background-color: #cc8400; padding:7px; font-size:12px; color:white; border-radius:5px">OIC Personnel</span></td>
                                    @elseif($level_info->level_description == 'OIC Finance')
                                    <td><span style="background-color: #cccc00; padding:7px; font-size:12px; color:white; border-radius:5px">OIC Finance</span></td>
                                    @elseif($level_info->level_description == 'OIC Branch')
                                    <td><span style="background-color: #006600; padding:7px; font-size:12px; color:white; border-radius:5px">OIC Branch</span></td>
                                    @endif
                                @endif
                            @endforeach
                            <td>{{$transaction_info->created_at->toDayDateTimeString()}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
    
@endsection
@push('style')
    <style>
        #search{
            box-shadow: none;
        }
    </style>
@endpush
@push('script')

        <script>
           
            $(document).ready( function () {

                //data table
               historytable = $('#transaction_history').DataTable({
                    "language": {
                    "search": "Filter records:"
                    },
                    "className": "text-center nosort text-nowrap",
                   "lengthMenu": [6, 20, 50],
                   "bLengthChange": true,
                   "columnDefs":[
                       {"className": "dt:center", "targets": "_all"}
                   ], 
               
                   "order" :[[0, "asc"]],
                  
                  
                });

                //search function
                $('#search').keyup(function(){
                    historytable.search($(this).val()).draw();
                })



                $('#monthSelect').on('change', function(){
                    $('#month').val(this.value)
                })
                $('#yearSelect').on('change', function(){
                    $('#year').val(this.value)
                })
                
                
                });


        </script>
@endpush

@push('css')
    <style>
        div.dataTables_length {
            margin-top: 10px;
            margin-bottom: 20px;

            }
    </style>
@endpush