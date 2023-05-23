@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium " style="color: red; letter-spacing: 3px">{{ __('Whoops! Something went wrong.') }}</div>
    <!--text-red-600-->
        <ul class="mt-3 list-disc list-inside text-sm" style="color: red; letter-spacing:3px">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
