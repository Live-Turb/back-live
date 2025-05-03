@extends('layouts.app')

@section('content')
<style>
 .bg-dashboard{
     background:rgba(9, 8, 53, 1);
 }   
    h5{
        color:#FFFFFF;
    }
</style>
<div class="container mt-5">
    <div class="row">
<div class="col-md-6">
    <div class="card text-white bg-dashboard mb-3">
        <div class="card-header">{{ __('dashboard.users_count_header') }}</div>
        <div class="card-body">
            <h5 class="card-title">{{ $usersCount }}</h5>
            <p class="card-text">{{ __('dashboard.users_count_description') }}</p>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card text-white bg-dashboard mb-3">
        <div class="card-header">{{ __('dashboard.video_details_count_header') }}</div>
        <div class="card-body">
            <h5 class="card-title">{{ $videoDetailsCount }}</h5>
            <p class="card-text">{{ __('dashboard.video_details_count_description') }}</p>
        </div>
    </div>
</div>
    </div>
</div>
@endsection
