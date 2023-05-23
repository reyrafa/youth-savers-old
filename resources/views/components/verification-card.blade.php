<div>
<div class="min-h-screen flex flex-col sm:justify-center items-center overflow-hidden pt-6 sm:pt-0 bg-gray-800"><!--linear-gradient(to bottom right, #fe783b, yellow);-->
   
    <div style="font-weight: bolder; color: white;" class="col-md-4 md:pt-2">
        {{ $logo }}
      
    </div>
    <div class="col-md-4 px-6 py-4 shadow sm:rounded-lg bg-white" style=" opacity: 0.8; " >  <!--background-image:linear-gradient(180deg,#b36200 , #fe783b);-->
        
        {{ $slot }}
    </div>
   
   
    <div style="text-align:center; font-style:italic; color:white;" class="mt-5 pt-4">
    Developed By : ICT Department - Rey Rafael (Junior Software Developer)
 
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

</div>