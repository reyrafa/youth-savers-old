@extends('officer.branch.layouts.index')

@section('content')
    <div class="mt-5">
        <div class="row">
        <div class="col-md-12 mb-3">
            <h1 style="font-size: 25px;">IMPORTING EXCEL FILE</h1>
        </div>
            <div class="col-md-12 bg-white shadow rounded px-3 py-3">
                
                        <form action="/import_excel" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div style="display:flex; align-items:center">
                                    <input type="file" class="form-control w-25" style="margin-right: 10px;" name="excel_file" accept=".xlsx, .xls">
                                    <button type="submit" class="btn form-control w-25 " style="background: #7f5200; color:white;" ><i class="fa fa-cloud-upload" aria-hidden="true"></i> Import Excel</button>
                                </div>
                        </form>
                            <div style="display: none; align-items:center" class="mt-3">
                                <button class="btn btn-info form-control w-25" style="margin-right: 10px;"  onclick="toPdf()" >Export to Pdf</button>
                                <button class="btn btn-info form-control w-25" onclick="fnExportToExcel('xlsx', 'MembersReport')">Export to Excel</button>
                            </div>
                        
                 
            </div>
            


            <div class="mt-5 bg-white col-md-12 overflow-hidden shadow rounded px-3 py-4">
                <div class="table-responsive">
                    <table class="table hover align:middle stripe table-bordered" id="dl_report_Table" style="font-size:0.9em;">
                        <thead>
                            <th class="border">No</th>
                            <th class="border">Fullname</th>
                            <th class="border">Branch</th>
                            <th class="border">Date Enrolled</th>
                            <th class="border">Age</th>
                            <th class="border">Contact No</th>
                           <!-- <th style="display: none;">Action</th>-->
                        </thead>
                        <tbody>
                        @php 
                            $count = 0;
                        @endphp
                            @foreach($officialMember as $info)
                                @foreach($depositor as $depositorInfo)
                                    @if($info->depositor_id == $depositorInfo->depositor_id)
                                        @foreach($officer as $officerInfo)
                                            @if($depositorInfo->branch_under_id == $officerInfo->branch_under_id)
                                                <tr>
                                                    <td><a class="btn disabled" style="background: #808080; color:white; width: 40px; height: 40px; border-radius: 5px;">{{++$count}}</a></td>
                                                    <td>{{$depositorInfo->firstname}} {{$depositorInfo->lastname}}</td>
                                                    @foreach($branch as $branchInfo)
                                                        @if($branchInfo->id == $depositorInfo->branch_under_id)
                                                        <td>{{$branchInfo->branch_name}}</td>
                                                    
                                                        @endif
                                                    @endforeach
                                                    <td>{{date("D F Y",strtotime($depositorInfo->created_at))}}</td>
                                                    <td>{{\Carbon\Carbon::parse($depositorInfo->date_of_birth)->age}}</td>
                                                    <td>{{$depositorInfo->contact_no}}</td>
                                               <!--     <td style="display: none;"><a href="#" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>-->
                                                   
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @foreach($depositor as $depositorInfo)
                @foreach($branch as $branchInfo)
                    @if($branchInfo->id == $depositorInfo->branch_under_id)
                                                     
                        <input type="hidden" value="{{$branchInfo->branch_name}}" id="BranchName">
                    @endif
             @endforeach
             @endforeach
         
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
                transaction_table = $('#dl_report_Table').DataTable({
                   "language": {
                   "search": "Filter records:",
                   "emptyTable": "There is no application for this day"
                   },
                   "className": "text-center nosort text-nowrap",
                  "lengthMenu": [4, 10, 20, 50],
                  "bLengthChange": true,
                 
                  "order" :[[0, "asc"]],
                  "bLengthChange":true,
              
                });
         })





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
                    var branchName = $('#BranchName').val()
                    doc.text(300, y = y + 30, branchName + " YOUTH SAVERS CLUB MEMBER REPORT", {align: 'center'});
                    doc.autoTable({
                        html: '#dl_report_Table',
                        startY: 70,
                        theme: 'grid',
                        
                        styles: {
                            minCellHeight: 40
                        }
                    })
                    doc.save('MembersReport.pdf');
                };
                
                function fnExportToExcel(fileExtension, filename){
                    var branchName = $('#BranchName').val()
                    var elt = document.getElementById('dl_report_Table');
                    var wb = XLSX.utils.table_to_book(elt, {sheet: branchName})
                    return XLSX.writeFile(wb, branchName + "YSCRawData." + fileExtension || (branchName + '.' + (fileExtension || 'xlsx')));
                }
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