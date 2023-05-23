@extends('officer.branch.layouts.index')

@section('content')
    <div class="mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3>Transaction List</h3>
            </div>
            <div class="col-md-9"></div>
            <div class="col-md-3">
                <div class="input-group" style="display: none;">   
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
        <div class="bg-white mt-3 overflow-hidden shadow rounded px-3 py-4">
        <div class="table-responsive">
            <table class="table stripe hover align-middle table-bordered" id="transaction_table">
                <thead>
                    <th class="border">No</th>
                    <th class="border">Fullname</th>
                    <th class="border">Branch</th>
                    <th class="border">Validate</th>
                </thead>
                <tbody>
                    @php 
                        $count = 0;
                    @endphp
                    @foreach($transaction as $transaction_info)
                        @if($transaction_info->level_id == '3' && $transaction_info->status_id == '1')
                    
                            @foreach($depositor as $depositor_info)
                            @foreach($officer as $officerInfo)
                                @if($depositor_info->depositor_id == $transaction_info->depositor_id && $depositor_info->branch_under_id == $officerInfo->branch_under_id)
                                <tr>
                                <td><a class="btn disabled" style="background: #808080; color:white; width: 40px; height: 40px; border-radius: 5px;">{{++$count}}</a></td>
                                <td>{{$depositor_info->firstname}} {{$depositor_info->lastname}}</td>
                                    @foreach($branch_under as $branch_under_info)
                                        @if($depositor_info->branch_under_id == $branch_under_info->id)
                                        <td>{{$branch_under_info->branch_name}}</td>
                                        @endif
                                    @endforeach
                                    <td><a href="#" 
                                    class="btn btn-primary approved" 
                                    data-bs-toggle="modal" 
                                    data-id="{{$transaction_info->id}}" 
                                    data-bs-target="#approve_transaction"
                                    ><i class="fa fa-thumbs-up" aria-hidden="true"></i></a> 
                            </td>
                            </tr>
                           
                                @endif
                                @endforeach
                            @endforeach
                           
                       
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
    <div class="modal fade" id="approve_transaction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-labelledby="exampleModalLabel"> 
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h3 style="text-transform: uppercase; color:white; font-style:bold;" class="modal-title" id="exampleModalLabel">Approve Transaction</h3>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="close"> </button>
                </div>
                <form  action="/branch/user/approve/application" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    @foreach($officer as $officer_info)
                        <input type="hidden" name="officer_id" value="{{$officer_info->officer_id}}">
                    @endforeach
                    @foreach($transaction as $transaction_info)
                        <input type="hidden" name="depositor_id" value="{{$transaction_info->depositor_id}}">
                    @endforeach
                    <div class="form-group green-border-focus">
                        <label for="exampleFormControlTextarea4">Remarks <span>(note: This is optional)</span></label>
                        <textarea class="form-control" name="remarks" id="exampleFormControlTextarea4" rows="3"></textarea>
                    </div>
                 </div>
                 <div class="modal-footer">
                     <button data-bs-dismiss="modal" type="button" class="btn btn-secondary">Close</button>
                     <button type="submit" class="btn btn-primary" id="submit"><i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
                 </div>

                 </form>
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
                transaction_table = $('#transaction_table').DataTable({
                   "language": {
                   "search": "Filter records:",
                   "emptyTable": "There is no application for this day"
                   },
                   "className": "text-center nosort text-nowrap",
                  "lengthMenu": [4, 10, 20, 50],
                  "bLengthChange": true,
                  "columnDefs":[
                      {"className": "dt:center", "targets": "_all"}
                  ],
                  "order" :[[0, "asc"]],
                  "bLengthChange":true,
              
                });
    
                //search function
                $('#search').keyup(function(){
                   transaction_table.search($(this).val()).draw();
                })

                //get the id of the transaction after approved button clicked
                $(document).on('click', '.approved', function(){
                    var id = $(this).data('id');
                    $('#id').val(id)
                })

                
         })
    </script>
@endpush

@push('style')
    <style>
         div.dataTables_length {
            margin-top: 10px;
            margin-bottom: 20px;

            }
         /*th.dt-center, td.dt-center { text-align: center; }*/
    </style>
@endpush