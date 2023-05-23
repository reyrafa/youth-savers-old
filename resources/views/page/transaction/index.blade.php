<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            MONETARY REQUIREMENTS
        </h2>
    </x-slot>
    <div class="row mt-4 ml-2 mr-2">
        <div class="col-md-3 mb-3">
           <!-- <div class="bg-white pt-2 pb-2 shadow rounded mb-3" style="text-align: center; font-size: 20px"> 
                <h1 style="font-size: 15px;" class="text-success">PHP 100.00 for savings</h1>
                <h1 style="font-size: 15px;" class="text-success">PHP 50.00 for insurance</h1>
                <div class="border-bottom mb-2"></div>
                <h1 class="text-success" style="font-size: 15px;">A total of <b><span style="font-size: 17px;">PHP 150.00</span></b></h1>
              
            </div>-->
            <div class="bg-white p-4 shadow rounded" style="text-align: justify; font-size: 20px"> 
                <p style="text-align: center; font-size:25px; font-weight:bold" class="text-success mb-2 text-uppercase">Steps</p>
                <p class="mb-2"><span class="text-primary">Step 1 </span>: Click add monetory button, located at the top right corner of the table to add transaction.</p>
                <p class="text-justify mb-2"><span class="text-primary">Step 2</span> : Input your Official Reciept number, total amount, located on your receipt and the scanned receipt</p>
                <p class="text-justify mb-2"><span class="text-primary">Step 3 </span>: Your Application is on the evaluation list. We will notify you if your application is a success. Thank you.</p>
                <p class="text-primary">Note : PHP 150.00 - Membership fee</p>
            </div>
        </div>
        <div class="col-md-8 mb-5">
            <div class="bg-white p-5 shadow rounded ">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <h1 style="font-size: 30px;"><b>Transaction</b></h1>
                      <!--  <x-jet-label class="text-success">Please Upload the *jpg, *png, *jpeg of the receipt</x-jet-label>
                        <x-jet-label class="text-success">If already done, disregard the message. Thank You!</x-jet-label>-->
                    </div> 
                    <div class="col md-3"></div>
                    <div class="col-md-3 hidden" data-bs-toggle="modal" data-bs-target="#reuploadFiles">
                        <x-jet-button class="hidden">ReUpload Image File</x-jet-button>
                        <div class="modal fade" id="reuploadFiles" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-labelledby="exampleModalLabel"> 
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header bg-primary">
                                       <h1 style="text-transform: uppercase; color:white; font-style:bold;" class="modal-title" id="exampleModalLabel">Re-Upload Files</h1>
                                       <button class="btn-close" data-bs-dismiss="modal" aria-label="close"> </button>
                                   </div>
                                   <form  action="/add_receipt" method="POST" enctype="multipart/form-data">
                                   @csrf
                                    <div class="modal-body">
                                        
                                    
                                        <x-jet-label><span class="text-danger">*</span> Upload Signature</x-jet-label>
                                        <p><img src="" id="output_signature" width="500" alt=""></p>
                                        <x-jet-input
                                            id="signature"
                                             type="file"
                                             name="signature"
                                             accept=".png, .jpg, .jpeg"
                                             onchange="loadFile_signature(event)"
                                             class="w-full mb-3 mt-2"
                                             required autofocus
                                        />
                                        <span
                                            style="color: red; font-size: 10px"
                                            id="signatureError"
                                            class="ml-2 hidden"
                                            >Opps, this exceed to 4mb
                                        </span> 


                                        <x-jet-label><span class="text-danger">*</span> Upload Birth Certificate</x-jet-label>
                                        <p><img src="" id="output_birth" width="500" alt=""></p>
                                        <x-jet-input
                                            id="birthCertificate"
                                             type="file"
                                             name="birthCertificate"
                                             accept=".png, .jpg, .jpeg"
                                             onchange="loadFile_birthCertificate(event)"
                                             class="w-full mb-3 mt-2"
                                             required autofocus
                                        />
                                        <span
                                            style="color: red; font-size: 10px"
                                            id="birthCertificateError"
                                            class="ml-2 hidden"
                                            >Opps, this exceed to 4mb
                                        </span> 

                                        <x-jet-label><span class="text-danger">*</span> Upload 2 by 2 picture</x-jet-label>
                                        <p><img src="" id="output_twobytwo" width="500" alt=""></p>
                                        <x-jet-input
                                            id="twobytwo"
                                             type="file"
                                             name="twobytwo"
                                             accept=".png, .jpg, .jpeg"
                                             onchange="loadFile_twobytwo(event)"
                                             class="w-full mb-3 mt-2"
                                             required autofocus
                                        />
                                        <span
                                            style="color: red; font-size: 10px"
                                            id="receiptError"
                                            class="ml-2 hidden"
                                            >Opps, this exceed to 4mb
                                        </span> 
                                    </div>
                                    <div class="modal-footer">
                                        <button data-bs-dismiss="modal" class="btn btn-secondary">Close</button>
                                        <x-jet-button type="submit" id="reuploadButton">Upload</x-jet-button>
                                    </div>
                                    
                                    </form>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div class="col-sm-3">
                       
                        <x-jet-button data-bs-toggle="modal" data-bs-target="#uploadReceipt">Add Monetory</x-jet-button>
                        
                       <div class="modal fade" id="uploadReceipt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-labelledby="exampleModalLabel"> 
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header bg-primary">
                                       <h1 style="text-transform: uppercase; color:white; font-style:bold;" class="modal-title" id="exampleModalLabel">Upload Reciept</h1>
                                       <button class="btn-close" data-bs-dismiss="modal" aria-label="close"> </button>
                                   </div>
                                   <form  action="/add_receipt" method="POST" enctype="multipart/form-data">
                                   @csrf
                                    <div class="modal-body">
                                        
                                        <x-jet-label>Official Receipt Number</x-jet-label>
                                            <x-jet-input
                                                 type="number"
                                                 name="or_num"
                                                 placeholder="OR number"
                                                 class="w-full mb-3 mt-2"
                                                 required autofocus
                                            />
                                        <x-jet-label>Total Amount</x-jet-label>
                                        <x-jet-input
                                             type="number"
                                             name="amount"
                                             placeholder="PHP 0.00"
                                             class="w-full mb-3 mt-2"
                                             required autofocus
                                        />
                                        <x-jet-label>Upload Receipt</x-jet-label>
                                        <p><img src="" id="output_receipt" width="500" alt=""></p>
                                        <x-jet-input
                                            id="receipt"
                                             type="file"
                                             name="receipt"
                                             accept=".png, .jpg, .jpeg"
                                             onchange="loadFile_reciept(event)"
                                             class="w-full mb-3 mt-2"
                                             required autofocus
                                        />
                                        <span
                                            style="color: red; font-size: 10px"
                                            id="receiptError"
                                            class="ml-2 hidden"
                                            >Opps, this exceed to 4mb
                                        </span> 
                                    </div>
                                    <div class="modal-footer">
                                        <button data-bs-dismiss="modal" class="btn btn-secondary">Close</button>
                                        <x-jet-button type="submit" id="submit">Add Transaction</x-jet-button>
                                    </div>
                                    
                                    </form>
                               </div>
                           </div>
                       </div>
                    </div>
                   
                </div>
            <div class="table-responsive">
            <table class="table w-full">
                <thead>
                    <th>Amount</th>
                    <th>OR #</th>
                    <th>Date Uploaded</th>
                    <th>Validated On</th>
                    <th>Validated By</th>
                    <th>Reciept</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Remarks</th>
                </thead>
                <tbody>
                 @foreach($transaction as $transaction_info)
    
                 <tr>
                    @if($transaction_info->amount != null)
                        <td>PHP {{$transaction_info->amount}}.00</td>
                    @else
                     <td></td>
                    @endif
                    <td>{{$transaction_info->or_num}}</td>
                    <td>{{$transaction_info->created_at->toDayDateTimeString()}}</td>
                    @if($transaction_info->status_id == 1)            
                     
                        <td></td>
                    @else
                        <td>{{$transaction_info->updated_at->toDayDateTimeString()}}</td>      
                    @endif

                    @foreach($officer as $officer_info)
                        @if($transaction_info->officer_id == $officer_info->officer_id)
                            <td>{{$officer_info->firstname}} {{$officer_info->middlename}}. {{$officer_info->lastname}}</td>
                        @elseif($transaction_info->officer_id == null)
                            <td></td>
                            @break
                        @endif
                    @endforeach
                    @if($transaction_info->level_id == '1' || $transaction_info->level_id == '2')
                        @if($transaction_info->uploaded_receipt == null && $transaction_info->level_id !='3')
                            <td class="text-danger">Please Upload your receipt</td>
                        @else
                            <td>
                                <img src="{{ asset('/uploads/Receipt/' .$transaction_info->uploaded_receipt)}}" width="70px" alt="Image">
                            </td>
                        @endif
                    @else
                    <td></td>
                    @endif

                    @foreach($level_of_transaction as $level_info)
                        @if($transaction_info->level_id == $level_info->level_of_transaction_id)
                            <td class="text-primary">{{$level_info->level_description}}</td>
                        @endif
                    @endforeach

                    @foreach($status_of_transaction as $status_info)
                        @if($transaction_info->status_id == $status_info->status_of_transaction_id)
                            @if($status_info->status_of_transaction_name == 'Approved')
                            <td class="text-primary">Approved</td>
                            @elseif($status_info->status_of_transaction_name == 'Invalid')
                            <td class="text-danger">Invalid</td>
                            @elseif($status_info->status_of_transaction_name == 'Pending')
                            <td class="">Pending</td>
                            @else
                            <td></td>
                            @endif
                        @endif
                    @endforeach

                    <td>{{$transaction_info->remarks}}</td>
                 </tr>
                 @endforeach
                </tbody>    
            </table>
            </div>
        </div>
        
    </div>
    @push('script')
    <script>
        var loadFile_reciept = function(event){
        

          var image_receipt = document.getElementById('receipt')
         // Check if any file is selected.
         if (image_receipt.files.length > 0) {
            
               for (const i = 0; i <= image_receipt.files.length - 1; i++) {
                
                   const fsize = image_receipt.files.item(i).size;
                   const file = Math.round((fsize / 1024));
                   // The size of the file.
                   if (file >= 4096) {
                     $('#signature').val('')
                       $('#receiptError').show()
                       $('#submit').attr('disabled', 'disabled')

                   } 
                    else {
                     $('#receiptError').hide()
                     var image = document.getElementById('output_receipt');
	                image.src = URL.createObjectURL(event.target.files[0]);
                     $('#submit').removeAttr('disabled')
                   }
               }
           }
       }






       //function to show signature
       var loadFile_signature = function(event){
        

        var imageSignature = document.getElementById('signature')
       // Check if any file is selected.
       if (imageSignature.files.length > 0) {
          
             for (const i = 0; i <= imageSignature.files.length - 1; i++) {
              
                 const fsize = imageSignature.files.item(i).size;
                 const file = Math.round((fsize / 1024));
                 // The size of the file.
                 if (file >= 4096) {
                   $('#signature').val('')
                     $('#signatureError').show()
                     $('#reuploadButton').attr('disabled', 'disabled')

                 } 
                  else {
                   $('#signatureError').hide()
                   var image = document.getElementById('output_signature');
                  image.src = URL.createObjectURL(event.target.files[0]);
                   $('#reuploadButton').removeAttr('disabled')
                 }
             }
         }
     }

       
        $(document).ready(function(){
           
        })

    </script>
    @endpush
</x-app-layout>