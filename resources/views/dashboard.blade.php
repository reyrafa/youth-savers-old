<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('DASHBOARD') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg pb-2" style="text-align: center;">
               
                    <div class="" style="width:auto; height:500px; display:block">
                        <div class="owl-carousel owl-theme" >
                            <div class="item" style="height:60vh; display:block">
                                <img src="/img/image3.jpg" alt="" style="" class="center">
                               
                            </div>
                            <div class="item" style="height:60vh; display:block">
                                <img src="/img/image4.jpg" alt="" style="" class="center">
                               
                            </div>
                            <div class="item" style="height:60vh; display:block" class="center">
                                <img src="/img/image1.jpg" alt="">
                               
                            </div>
                            <div class="item" style="height:60vh; display:block"><img src="/img/image2.jpg" alt=""></div>
                        </div>
                    </div>
                  
           
                    <h1 style="font-size: 25px; color:#fe783b" class="mb-3"><b>Welcome to Youth Savers Club Laboratory Cooperative</b></h1>
               
                <p class="mb-3">A Successful man is one who can lay a firm foundation with the bricks others have thrown at him.</p>
                <span class="mb-3">- David Brinkley -</span>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="pt-2 pb-2 bg-white shadow rounded mb-3">
                    <h1 class="text-center text-success" style="font-size: 25px; font-weight:bold">HISTORY</h1>
                       
                    </div>
                </div>
                <div class="col-md-6" >
                    <div class="pt-2 pb-2 bg-white shadow rounded mb-3 px-4 pt-4 pb-4">
                        <h1 class="text-center text-success mb-2" style="font-size: 25px; font-weight:bold">MISSION</h1>
                        <p class="text-justify" style="text-align: justify;">
                        "An armrest of OIC which supports marketing, educating of coop values and principles, social needs and an avenue of youth leadership and enterprising development."
                        </p>
                       
                    </div>
                    <div class="pt-2 pb-2 bg-white shadow rounded mb-3 px-4 py-3 pt-4 pb-4">
                        <h1 class="text-center text-success mb-2" style="font-size: 25px; font-weight:bold">VISION</h1>
                        <p class="text-justify" style="text-align: justify;">
                        “An established and productive organization conveying authentic and holistic development for the young as catalysts for youth transformation.”
                        </p>
                        
                    </div>
                    
                </div>
            </div>
        </div>
       
    </div>
    

    <script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:5,
            nav:false,
            autoplay:true,
            autoplayTimeout: 5000,
            autoHeight: true,
           // stagePadding:50,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
                
            }
        })
    })
  </script>
</x-app-layout>
