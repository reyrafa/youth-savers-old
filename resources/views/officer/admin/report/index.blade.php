@extends('officer.admin.layouts.dashboard')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 style="font-size: 25px;">MEMBERS STATISTICS REPORT</h1>
        </div>
      
        
       
    </div>
  
        <div class="row">
            <div class="col-md-2 mt-3 mb-3 overflow-hidden shadow rounded px-3 py-4" style="margin-right: 45px; margin-left:10px; background:#b37400">
                <label style="font-size: 15px; color:white"><i class="fa fa-user-circle"></i> REGISTERED ACCOUNT</label> <br>
                <label style=" width: 10px; height: 10px; background: #00ffa5; border-radius:50%; margin-top:20px;"> </label> <span style="color: #00ffa5;">Verified {{$verifiedCounter}} </span><i style="color: #00ffa5;" class="fa fa-check-circle" aria-hidden="true"></i><br>
                <label style=" width: 10px; height: 10px; background: #ffc04d; border-radius:50%; margin-top:20px;"> </label><span style="color: #ffc04d;"> Unverified {{$notVerifiedCounter}} </span><i style="color: #ffc04d;" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 overflow-hidden shadow rounded px-3 py-4" style="margin-right: 40px; background:#b37400;">
                <label style="font-size: 15px; color:white"><i class="fa fa-users" aria-hidden="true"></i> TOTAL MEMBER</label> <br>
                <label style=" width: 10px; height: 10px; background: #ffa500; border-radius:50%; margin-top:20px;"> </label> <span style="color: #ffa500;">Male {{$male}} </span><i style="color: #ffa500;" class="fa fa-male" aria-hidden="true"></i><br>
                <label style=" width: 10px; height: 10px; background: #00daff; border-radius:50%; margin-top:20px;"> </label><span style="color: #00daff;"> Female {{$female}} </span><i style="color: #00daff;" class="fa fa-female" aria-hidden="true"></i>
            </div>
            
            <div class="col-md-2 mr-3 mt-3 mb-3 overflow-hidden shadow rounded px-3 py-4" style="margin-right: 40px; background: #b37400">
                <label style="font-size: 15px; color:white"><i class="fa fa-graduation-cap" aria-hidden="true"></i> TOTAL GRADUATES</label> <br>
                <label style="margin-top:15px; color: #ffc04d;">{{$graduate}} </label> <span style="color: #ffc04d;"> </span><i style="color: #ffc04d;" class="fa fa-user" aria-hidden="true"></i><br>
                
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 overflow-hidden shadow rounded px-3 py-4" style="margin-right: 40px; background:#b37400">
                <label style="font-size: 15px; color: white"><i class="fa fa-money" aria-hidden="true"></i> TOTAL SAVINGS</label> <br>
                <label style="color: #ffc04d; margin-top: 15px;">PHP {{number_format($totalDepositCounter, 2, ' . ' , ', ')}}</label><br>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow rounded px-3 py-4" style="margin-right: 40px; display:none;">
                <label style="font-size: 15px;"><i class="fa fa-users" aria-hidden="true"></i> TOTAL MEMBER</label>

            </div>
          
        </div>
        <div class="row mt-4 mb-4">
            <div class="col-md-2">
                <a href="{{route('exportToPDF')}}" target="_blank" class="btn form-control mb-2" style="background: #521515; color:#ffb2b2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generate Pdf</a><!--onclick="toPdf()"-->
            </div>
            <div class="col-md-2">
                <a href="/generateExcelDataYSC" class="btn form-control mb-2" style="background:#003300; color: #cce5cc" ><i class="fa fa-file-excel-o" aria-hidden="true"></i> Generate Excel</a> <!--onclick="fnExportToExcel('xlsx', 'MembersReport')"-->
            </div>
            
        </div>
           
            
        </div>
        
        
        <div class="bg-white overflow-hidden shadow rounded px-3 py-4">
        <div class="table-responsive">
                <table class="table hover table-bordered align:middle stripe" id="dl_report_Table1" style="font-size:0.9em;">
                    <thead>
                        <th class="border">No</th>
                        <th class="border">Fullname</th>
                        <th class="border">Branch</th>
                        
                        <th class="border">Age</th>
                        <th class="border">Contact</th>
                        
                        <th class="border">Status</th>
                        <th class="border">Method</th>
                        <th class="border">Date Officially Member</th>                   
                        <th class="border">Action</th>
                    </thead>
                    <tbody>
                        @php 
                            $count = 0;
                        @endphp
                        @foreach($official_member as $official_info)
                            @if($official_info->isAlumni == "1")
                            <tr>
                                @foreach($depositor as $depositor_info)
                                    @if($official_info->depositor_id == $depositor_info->depositor_id)
                                        <td><a class="btn disabled" style="background: #808080; color:white; width: 35px; height: 35px; border-radius: 5px;">{{++$count}}</a></td>
                                        <td>{{$depositor_info->firstname}} {{$depositor_info->lastname}}</td>

                                        @foreach($branch_under as $branch_under_info)
                                            @if($branch_under_info->id == $depositor_info->branch_under_id)
                                                <td>{{$branch_under_info->branch_name}}</td>
                                            @endif
                                        @endforeach
                                    
                                       
                                        
                                        @if(\Carbon\Carbon::parse($depositor_info->date_of_birth)->age > 18)
                                          
                                            <td class="text-danger">{{\Carbon\Carbon::parse($depositor_info->date_of_birth)->age}}</td>
                                            @else
                                            <td>{{\Carbon\Carbon::parse($depositor_info->date_of_birth)->age}}</td>
                                        @endif

                                            <td>{{$depositor_info->contact_no}}</td>
                                            @foreach($verifiedAccount as $verifiedInfo)
                                                @if($depositor_info->depositor_id == $verifiedInfo->id)
                                                    @if($verifiedInfo->email_verified_at != null)
                                                        <td><span style="background-color: #004000; padding:7px; font-size:12px; color:white; border-radius:5px">Verified</span></td>
                                                    @else
                                                        <td><span style="background-color: #7f0000; padding:7px; font-size:12px; color:white; border-radius:5px">Unverified</span></td>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @foreach($onlineOrUploaded as $onlineInfo)
                                                @if($onlineInfo->depositor_id == $depositor_info->depositor_id)
                                                    @if($onlineInfo->method == '1')
                                                        <td><span style="background-color: #004000; padding:7px; font-size:12px; color:white; border-radius:5px">Online</span></td>
                                                    @elseif($onlineInfo->method == '2')
                                                        <td><span style="background-color: #00007f; padding:7px; font-size:12px; color:white; border-radius:5px">Uploaded</span></td>
                                                    @endif
                                                @endif
                                            @endforeach


                                            <td>{{date("d F Y",strtotime($depositor_info->created_at))}}</td>
                                        
                                            <td>
                                                @if(\Carbon\Carbon::parse($depositor_info->date_of_birth)->age > 18)

                                                <button
                                                    type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#alumnus"
                                                    class="btn btn-success approved"
                                                    data-id="{{$official_info->id}}">
                                                    <i class="fa fa-graduation-cap">

                                                    </i>
                                                </button>
                                                @else
                                              

                                                @endif
                                                <a href={{"/show/depositor/info/print/".$official_info->depositor_id}}
                                                    class="btn btn-primary"
                                            
                                                    ><i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <a href="#" style="display: none;"
                                                    class="btn btn-info"
                    
                                                    ><i class="fa fa-wrench" aria-hidden="true"></i>
                                                </a>
                                                
                                            </td>
                                           
                                        @endif

                                
                               
                                @endforeach
                                </tr>
                            @endif

                        @endforeach 
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>

    <div class="modal fade" id="alumnus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-labelledby="exampleModalLabel"> 
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h3 style="text-transform: uppercase; color:white; font-style:bold;" class="modal-title" id="exampleModalLabel">Graduate Youth Saver Member</h3>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="close"> </button>
                </div>
                <form action="/alumni/admit" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="modal-body">
                    <input type="hidden" id="id" name="id">
            
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
@push('script')

        <script>
           
            $(document).ready( function () {


                 //get the id of the transaction after approved button clicked
                 $(document).on('click', '.approved', function(){
                    var id = $(this).data('id');
                    $('#id').val(id)
                })




                //data table
               member = $('#dl_report_Table1').DataTable({
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
                    member.search($(this).val()).draw();
                })
                
                });


              /*  function toPdf(){
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
                    doc.text(200, y = y + 30, "Members REPORT");
                    doc.autoTable({
                        html: '#dl_report_Table1',
                        startY: 70,
                        theme: 'grid',
                        
                        styles: {
                            minCellHeight: 40
                        }
                    })
                    doc.save('MembersReport.pdf');
                };*/
                
                function fnExportToExcel(fileExtension, filename){
                    var elt = document.getElementById('dl_report_Table1');
                    var wb = XLSX.utils.table_to_book(elt, {sheet: "sheet1"})
                    return XLSX.writeFile(wb, filename + "." + fileExtension || ('MembersReport.' + (fileExtension || 'xlsx')));
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
