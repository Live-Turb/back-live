@extends('layouts.app')

@section('content')
    <div class="mx-5">
        {{-- @dump(count($plans)) --}}
        @if (count($plans) < 3)
            <div class="row d-flex justify-content-end" style="margin-right: 0.05rem;">
                <a href="{{ route('admin.plan.create') }}" class="d-flex justify-content-center mb-2 mr-2"
                    style="width:3rem;    background-color: rgba(78, 228, 138, 1) !important;
    padding: 0.5rem;
    border-radius: 8px;color:black">Add</a>
            </div>
        @endif
        @php
            $no = 1;
        @endphp
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                  <th scope="col">{{ __('dashboard.name') }}</th>
<th scope="col">{{ __('dashboard.key') }}</th>
<th scope="col">{{ __('dashboard.stripe_plan_key') }}</th>
<th scope="col">{{ __('dashboard.price') }}</th>
<th scope="col">{{ __('dashboard.duration') }}</th>
<th scope="col">{{ __('dashboard.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plans as $plan)
                    <tr>
                        <th scope="row">{{ $no++ }}</th>
                        <td>{{ $plan->name }}</td>
                        <td>{{ $plan->plan_key }}</td>
                        <td>{{ $plan->stripe_plan_key }}</td>
                        <td>{{ $plan->price }}</td>
                        <td>{{ $plan->duration }}</td>
                        <td>
                            <div class="d-flex gap-3">
                                <a class="" href="{{ route('admin.plan.edit', $plan->uuid) }}"><svg
                                        style="width: 1rem" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path fill="#1b4ca1"
                                            d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                    </svg></a>
                                <form class="delete-form" action="{{ route('admin.plan.delete', $plan->uuid) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="button" class="thisDelete" style="border:none; background: none; padding: 0; cursor: pointer;">
                                        <svg style="width: 1rem" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path fill="#ed071e"
                                                d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('.thisDelete').on('click', function() {
                    Swal.fire({
                         title: '{{ __('dashboard.are_you_sure') }}',
                        text: "",
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '{{ __('dashboard.confirm_delete') }}',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var parentElement = $(this).parent('form');
                            parentElement.submit();
                        }
                    });
                });
            })
        </script>
    </div>
@endsection
