@extends('layouts.app')

@section('content')
    @php
        $no = 1;
    @endphp

    <div class="container mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">{{ __('dashboard.users_management') }} <span class="badge bg-secondary">{{ $users->total() }}</span></h1>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">{{ __('dashboard.create_new_user') }}</a>
        </div>

        <!-- Adicionando filtro de busca -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.users') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="{{ __('dashboard.search_name_email') }}" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">{{ __('dashboard.search') }}</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.users') }}" class="btn btn-secondary w-100">{{ __('dashboard.clear_filter') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .page-link{
            color:rgba(9, 8, 53, 1);
        }
        .page-item.active .page-link {
    color: #fff;
    background-color: rgba(9, 8, 53, 1);
    border-color: rgba(9, 8, 53, 1);
}
.page-
    </style>

    <div class="table-responsive">
        <table class="table">
         <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('dashboard.name') }}</th>
                <th scope="col">{{ __('dashboard.email') }}</th>
               <th scope="col">{{ __('dashboard.plan_user') }}</th>
               <th scope="col">{{ __('dashboard.start_time') }}</th>
    <th scope="col">{{ __('dashboard.subscription_status') }}</th>
    <th scope="col">{{ __('dashboard.user_status') }}</th>
                <th scope="col">{{ __('dashboard.action') }}</th>
            </tr>
        </thead>
            <tbody>
        @if($users->isEmpty())
        <tr>
            <td colspan="8" class="text-center">{{ __('dashboard.no_users_available') }}</td>
        </tr>
    @else
        @foreach ($users as $user)
        @php

    $subscription = $user->subscriptions()->first();


   $planName = __('dashboard.no_plan_user');

    if ($subscription) {
        switch ($subscription->paypalPlan->name) {
            case 'Basic':
                $planName = __('dashboard.basic_user');
                break;
            case 'Standard':
                $planName = __('dashboard.smart_user');
                break;
            case 'Premium':
                $planName = __('dashboard.gold_user');
                break;
            default:
                $planName = __('dashboard.no_plan_user');
                break;
        }
    }


    $expiryDate = $subscription ? \Carbon\Carbon::parse($subscription->expire_date)->format('d-m-Y') : null;
    $isExpired = $subscription && $subscription->expire_date < now();



     $startTime = $subscription ? \Carbon\Carbon::parse($subscription->start_time)->format('d-m-Y') : null;
@endphp
<tr>
    <th scope="row">{{ $no++ }}</th>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>


    <td>{{ $planName }}</td>

    <td>{{ $startTime ?? '-' }}</td>
   <td>
    @if ($subscription)
        @if ($isExpired)
            <span class="text-danger">{{ __('dashboard.expired') }}</span>
        @else
            {{ __('dashboard.active') }} ({{ __('dashboard.expires_on', ['date' => $expiryDate]) }})
        @endif
    @else
        <span class="text-muted">{{ __('dashboard.no_plan_user') }}</span>
    @endif
</td>
<td>
    @if ($user->status == 'active')
        <span class="badge bg-success">{{ __('dashboard.user_active') }}</span>
    @elseif ($user->status == 'blocked')
        <span class="badge bg-danger">{{ __('dashboard.user_inactive') }}</span>
    @elseif ($user->status == 'pending')
        <span class="badge bg-warning text-dark">{{ __('dashboard.user_pending') }}</span>
    @elseif ($user->status == 'expired')
        <span class="badge bg-secondary">{{ __('dashboard.user_expired') }}</span>
    @else
        <span class="badge bg-secondary">{{ $user->status }}</span>
    @endif
</td>
              <td>
                        <div class="d-flex gap-3 align-items-center">
                            <a href="{{ route('admin.users.edit', $user->uuid) }}" class="btn btn-sm btn-primary" title="{{ __('dashboard.edit_user') }}">
                                <svg style="width: 1rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="#ffffff"
                                        d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                </svg>
                            </a>

                            <!-- Botão de alternância de status -->
                            <form id="toggle-status-form-{{ $user->uuid }}" method="POST"
                                action="{{ route('admin.users.toggle.status', $user->uuid) }}">
                                @csrf
                                @method('PUT')
                                <button type="button" class="btn btn-sm {{ $user->status == 'active' ? 'btn-success' : 'btn-warning' }} toggle-status"
                                        data-id="{{ $user->uuid }}"
                                        data-status="{{ $user->status }}"
                                        data-toggle="tooltip"
                                        title="{{ $user->status == 'active' ? __('dashboard.block_user') : __('dashboard.unblock_user') }}">
                                    <i class="fas {{ $user->status == 'active' ? 'fa-lock-open' : 'fa-lock' }}"></i>
                                </button>
                            </form>

                            <form id="delete-user-form-{{ $user->uuid }}" method="POST"
                                action="{{ route('admin.users.delete', $user->uuid) }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger delete-user-button" data-uuid="{{ $user->uuid }}" title="{{ __('dashboard.delete_user') }}">
                                    <svg fill="#ffffff" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_6_"> <g id="XMLID_11_"> <path d="M240,121.076H30V275c0,8.284,6.716,15,15,15h60h37.596c19.246,24.348,49.031,40,82.404,40c57.897,0,105-47.103,105-105 C330,172.195,290.816,128.377,240,121.076z M225,300c-41.355,0-75-33.645-75-75s33.645-75,75-75s75,33.645,75,75 S266.355,300,225,300z"></path> </g> <g id="XMLID_18_"> <path d="M240,90h15c8.284,0,15-6.716,15-15s-6.716-15-15-15h-30h-15V15c0-8.284-6.716-15-15-15H75c-8.284,0-15,6.716-15,15v45H45 H15C6.716,60,0,66.716,0,75s6.716,15,15,15h15H240z M90,30h90v30h-15h-60H90V30z"></path> </g> <g id="XMLID_23_"> <path d="M256.819,193.181c-5.857-5.858-15.355-5.858-21.213,0L225,203.787l-10.606-10.606c-5.857-5.858-15.355-5.858-21.213,0 c-5.858,5.858-5.858,15.355,0,21.213L203.787,225l-10.606,10.606c-5.858,5.858-5.858,15.355,0,21.213 c2.929,2.929,6.768,4.394,10.606,4.394c3.839,0,7.678-1.465,10.607-4.394L225,246.213l10.606,10.606 c2.929,2.929,6.768,4.394,10.607,4.394c3.839,0,7.678-1.465,10.606-4.394c5.858-5.858,5.858-15.355,0-21.213L246.213,225 l10.606-10.606C262.678,208.535,262.678,199.039,256.819,193.181z"></path> </g> </g> </g></svg>
                                </button>
                            </form>
                        </div>
                    </td>
</tr>
        @endforeach
    @endif

        </tbody>
    </table>
    </div>

   <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
            {{ __('dashboard.showing') }} {{ $users->firstItem() ?? 0 }} {{ __('dashboard.to') }} {{ $users->lastItem() ?? 0 }} {{ __('dashboard.of') }} {{ $users->total() }} {{ __('dashboard.entries') }}
        </div>
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>




    <script>
        document.querySelectorAll('.delete-user-button').forEach(button => {
            button.addEventListener('click', function() {
                const uuid = this.getAttribute('data-uuid');
                Swal.fire({

                    title: '{{ __('dashboard.are_you_sure') }}',
                    text: "",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '{{ __('dashboard.confirm_delete') }}',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-user-form-' + uuid).submit();
                    }
                });
            });
        });

        // Script para alternar o status do usuário
        document.querySelectorAll('.toggle-status').forEach(button => {
            button.addEventListener('click', function() {
                const uuid = this.getAttribute('data-id');
                Swal.fire({
                    title: "{{ __('dashboard.confirm_status_change') }}",
                    text: "{{ __('dashboard.inactive_warning') }}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "{{ __('dashboard.yes_change') }}",
                    cancelButtonText: "{{ __('dashboard.no_keep') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('toggle-status-form-' + uuid).submit();
                    }
                });
            });
        });

        // Script para exibir mensagem de sucesso após alterar o status do usuário
        @if(session('success'))
            toastr.success("{{ __('dashboard.user_status_updated') }}");
        @endif
    </script>
@endsection
