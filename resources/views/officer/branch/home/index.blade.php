@extends('officer.branch.layouts.index')
@section('content')
    <div class="mt-5 p-5 bg-white shadow rounded">
        @foreach($officer as $info)
            @foreach($branch as $branchInfo)
                @if($info->branch_under_id == $branchInfo->id)
                <h1 style="text-align: center;">Welcome {{$branchInfo->branch_name}} Branch</h1>
                @endif
            @endforeach
        @endforeach
    </div>
@endsection