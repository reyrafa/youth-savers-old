@extends('officer.admin.layouts.dashboard')

@section('content')
<div class="py-12 mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3>Alumni</h3>
            </div>
            <div class="col-md-2">
                <button class="btn btn-info" style="display: none;"  onclick="toPdf()" >Export to Pdf</button>
            </div>

            <div class="col-md-2">
                <button class="btn btn-info" style="display: none;" onclick="fnExportToExcel('xlsx', 'AlumniReport')">Export to Excel</button>
            </div>
            <div class="col-md-5"></div>
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
            <table class="table align-middle stripe hover table-bordered" id="alumni_table">
                <thead>
                    <th class="border">No</th>
                    <th class="border">Fullname</th>
                    <th class="border">Age</th>
                    <th class="border">Branch</th>
                    <th class="border">Date Enrolled</th>
                    <th class="border">Graduation Date</th>
                    <th class="border">Email</th>
                    <th class="border">Phone Number</th>
                </thead>
                <tbody>
                    @php 
                        $count = 0;
                    @endphp
                    @foreach($official_member as $official_info)
                     
                            <tr>
                                @foreach($depositor as $depositor_info)
                                    @if($depositor_info->depositor_id == $official_info->depositor_id)
                                        <td><a class="btn disabled" style="background: #808080; color:white; width: 40px; height: 40px; border-radius: 5px;">{{++$count}}</a></td>
                                        <td>{{$depositor_info->firstname}} {{$depositor_info->lastname}}</td>
                                   
                                        <td>{{\Carbon\Carbon::parse($depositor_info->date_of_birth)->age}} years old</td>


                                        @foreach($branch_under as $branch_under_info)
                                            @if($branch_under_info->id == $depositor_info->branch_under_id)
                                                <td>{{$branch_under_info->branch_name}}</td>
                                            @endif
                                        @endforeach

                                    @endif
                                @endforeach
                                <td>{{date("d F Y",strtotime($official_info->created_at))}}</td>
                                <td>{{date("d F Y",strtotime($official_info->updated_at))}}</td>
                                @foreach($user as $user_info)
                                    @if($user_info->id ==  $official_info->depositor_id)
                                        <td>{{$user_info->email}}</td>
                                    @endif
                                @endforeach


                              
                                @foreach($depositor as $depositor_info)
                                    @if($depositor_info->depositor_id == $official_info->depositor_id)
                                        <td>{{$depositor_info->contact_no}}</td>
                                    @endif
                                @endforeach
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
               historytable = $('#alumni_table').DataTable({
                    "language": {
                    "search": "Filter records:"
                    },
                    "className": "text-center nosort text-nowrap",
                   "lengthMenu": [4, 10, 20, 50],
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
                
                });


                function toPdf(){
                    var doc = new jsPDF('p', 'pt', 'letter');
                    var htmlstring = '';
                    var tempVarToCheckPageHeight = 0;
                    var pageHeight = 0;
                    pageHeight = doc.internal.pageSize.height;
                    specialElementHandlers = {
                        // element with id of "bypass" - jQuery style selector  
                        '#bypassme': function (element, renderer) {
                            // true = "handled elsewhere, bypass text extraction"  
                            return true
                        }
                    };
                    margins = {
                        top: 150,
                        bottom: 60,
                        left: 40,
                        right: 40,
                        width: 600
                    };
                    var y = 20;
                    doc.setLineWidth(2);
                    doc.text(200, y = y + 30, "ALUMNI REPORT");
                    doc.autoTable({
                        html: '#alumni_table',
                        startY: 70,
                        theme: 'grid',
                        
                        styles: {
                            minCellHeight: 40
                        }
                    })
                    doc.save('AlumniReport.pdf');
                };
                
                function fnExportToExcel(fileExtension, filename){
                    var elt = document.getElementById('alumni_table');
                    var wb = XLSX.utils.table_to_book(elt, {sheet: "sheet1"})
                    return XLSX.writeFile(wb, filename + "." + fileExtension || ('AlumniReport.' + (fileExtension || 'xlsx')));
                }


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