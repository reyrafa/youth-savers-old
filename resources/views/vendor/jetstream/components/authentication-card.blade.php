<div class="min-h-screen flex flex-col sm:justify-center items-center overflow-hidden pt-6 sm:pt-0 bg-gray-100" style="background: url(/img/sample.png); background-size:cover"><!--linear-gradient(to bottom right, #fe783b, yellow);-->
    <div class="row pt-5">
    <div style="font-weight: bolder; color: white;" class="col-md-4 md:pt-2">
        {{ $logo }}
       
        <div style=" border-bottom: 10px solid yellow; width: 50%;" class="mb-3"></div>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-4 px-6 py-4 shadow sm:rounded-lg bg-white" style=" opacity: 0.8; " >  <!--background-image:linear-gradient(180deg,#b36200 , #fe783b);-->
        
        {{ $slot }}
    </div>
    </div>
   
    <div style="text-align:center; font-style:italic; color:white;" class="mt-5 pt-4">
   {{-- Developed By : ICT Department - Rey (Junior Software Developer) --}} 
 
   <!-- © <label for="" id="date"></label> Oro Integrated Cooperative. All Rights Reserved.-->
    </div>
         <!--jquery--> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function(){
           // $('#date').text((new Date).getFullYear())
        })
    </script>
</div>
