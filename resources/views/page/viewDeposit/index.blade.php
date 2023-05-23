<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View Account Deposit
        </h2>
    </x-slot>
    <div class="row mt-4 ml-2 mr-2">
        <div class="col-md-1"></div>
       <div class=" col-md-10 bg-white shadow rounded px-4 py-4">
            <h1>Total Amount : </h1>
            
            <p>PHP {{number_format($amount,0, ' . ' , ' , ')}}.00</p>
           
       </div>
        <div class="col-md-1"></div>
    </div>
    @push('script')
    <script>
       
       
        $(document).ready(function(){
           
        })

    </script>
    @endpush
</x-app-layout>