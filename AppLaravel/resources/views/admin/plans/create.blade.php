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
        <form action="{{ route('admin.plan.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-12 mb-2">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                    @error('name')
                        <span class="bg-danger text-white">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6 col-12 mb-2">
                    <label for="key">Key</label>
                    <input type="text" id="key" name="key" class="form-control" value="{{ old('key') }}">
                    @error('key')
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
                    <label for="price">Price</label>
                    <input id="price" name="price" type="number" min="0" max="10000" class="form-control"
                        value="{{ old('price') }}">
                    @error('price')
                        <span class="bg-danger text-white">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6 col-12 mb-2">
                    <label for="duration">Duration <span>(in month) </span></label>
                    <input id="duration" name="duration" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                        type="number" class="form-control" value="{{ old('duration') }}">
                    @error('duration')
                        <span class="bg-danger text-white">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="mt-2 row d-flex justify-content-end" style="margin-right: 0.05rem;">
                <button type="submit" class="d-flex justify-content-center mb-2 mr-2"
                    style="width:3rem;    background-color: rgba(78, 228, 138, 1) !important;
    padding: 0.5rem;
    border-radius: 8px;color:black">Store</button>
            </div>
        </form>
    </div>
@endsection
