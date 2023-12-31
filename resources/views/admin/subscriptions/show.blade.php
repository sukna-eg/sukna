<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">Subscription Information</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Subscription Information </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.subscriptions.index') }}" >{{  __('Subscriptions') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                <h4 class="heading mb-5"> Subscription Information</h4>

                                    <p class="mb-3"><strong>Start Date: </strong> {{ $subscription->end_date }}</p>
                                    <p class="mb-3"><strong>End Date: </strong> {{ $subscription->start_date }}</p>
                                    <p class="mb-3"><strong>User : </strong> <a href="{{ route('admin.users.show', $subscription->user->id) }}"> {{ $subscription->user->name }}</a></p>
                                    <p class="mb-3"><strong>Plan :</strong> <a href="{{ route("admin.plans.show", $subscription->plan->id) }}">{{ $subscription->plan->name }}</a></p>
                                    <p class="mb-3"><strong>First Month :</strong> {{ $subscription->first_month == 1? 'Paid' : 'Not Paid' }}</p>
                                    <p class="mb-3"><strong>Second Month :</strong> {{ $subscription->second_month == 1? 'Paid' : 'Not Paid' }}</p>
                                    <p class="mb-3"><strong>Third Month :</strong> {{ $subscription->third_month == 1? 'Paid' : 'Not Paid' }}</p>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Content body end
    ***********************************-->

</x-admin-layouts.admin-app>
