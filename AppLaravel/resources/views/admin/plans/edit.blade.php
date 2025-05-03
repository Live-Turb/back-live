@extends('layouts.app')

@section('content')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <div class="mx-lg-5 mx-sm-0">
        <div class="header">
            <h3>Create Plan</h3>
        </div>
        <form action="{{ route('admin.plan.update', $plan->uuid) }}" method="POST">
            @csrf
            <div class="row">
                {{-- <div class="col-lg-6 col-12 mb-2">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $plan->name }}">
                    @error('name')
                        <span class="bg-danger text-white">{{ $message }}</span>
                    @enderror
                </div> --}}
              <div class="col-lg-6 col-12 mb-2">
    <label for="key">{{ __('dashboard.key') }}</label>
    <input type="text" id="key" name="key" class="form-control"  value="{{ $plan->plan_key }}">
    @error('key')
        <span class="bg-danger text-white">{{ $message }}</span>
    @enderror
</div>

<div class="col-lg-6 col-12 mb-2">
    <label for="stripe_key">{{ __('dashboard.stripe_key') }}</label>
                    <input type="text" id="key" name="stripe_key"  class="form-control" value="{{ $plan->stripe_plan_key }}">
                    @error('stripe_key')
                        <span class="bg-danger text-white">{{ $message }}</span>
                    @enderror
                </div>
                {{-- <div class="col-lg-6 col-12 mb-2">
            <label for="type">Type</label>
            <select name="type" class="form-control">
                <option value="">Select</option>
                <option value="Basic">Basic</option>
                <option value="Standard">Standard</option>
                <option value="Premium">Premium</option>
            </select>
        </div> --}}
                <div class="col-lg-6 col-12 mb-2">
                    <label for="price">{{ __('dashboard.price') }}</label>
                    <input id="price" name="price" type="number" min="0" max="10000" class="form-control"
                        value="{{ $plan->price }}">
                    @error('price')
                        <span class="bg-danger text-white">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6 col-12 mb-2">
                   <label for="duration">{{ __('dashboard.duration') }} <span>({{ __('dashboard.in_months') }})</span></label>
     <input id="duration" name="duration" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                        type="number" class="form-control" value="{{ $plan->duration }}">
                    @error('duration')
                        <span class="bg-danger text-white">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mt-2 row d-flex justify-content-end" style="margin-right: 0.05rem;">
                <button type="submit" class="d-flex justify-content-center mb-2 mr-2"
                    style="width:4rem;    background-color: rgba(78, 228, 138, 1) !important;
padding: 0.5rem;
border-radius: 8px;color:black">{{ __('dashboard.update') }}</button>
            </div>
        </form>
    </div>
@endsection
