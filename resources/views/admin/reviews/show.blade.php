<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">{{$review->first_name}}</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$review->first_name}} </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.reviews.index') }}" >{{  __('Reviews') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                <h4 class="heading mb-5"> {{$review->first_name}}</h4>

                                    <p class="mb-3"><strong>User : </strong> <a href="{{ route('admin.users.show',$review->user->id) }}">{{ $review->user->name }} {{ $review->user->last_name }}</a></p>
                                    <p class="mb-3"><strong>Partner : </strong> <a href="{{ route('admin.partners.show',$review->partner->id) }}">{{ $review->partner->name }}</a></p>
                                    <p class="mb-3"><strong>Status :</strong> {{ $review->status==1?'Acceped':'Rejected' }}</p>
                                    <p class="mb-3"><strong>Points :</strong> {{ $review->points }}</p>
                                    <p class="mb-3"><strong>Content :</strong> {!! $review->content !!}</p>

                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                    <x-admin-layouts.alerts />
                                    <div class="table-responsive active-projects manage-client">
                                        <div class="tbl-caption">
                                            <h4 class="heading mb-0"> {{ __('Subscriptions') }}</h4>
                                        </div>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Start date</th>
                                                    <th>End date</th>
                                                    <th>Plan</th>
                                                    <th>Value</th>

                                                    <th>actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($review->subscriptions as $subscription)
                                                    <tr>

                                                        <td><span>{{ $subscription->start_date }}</span></td>
                                                        <td>
                                                            <span>{{ $subscription->end_date }}</span>
                                                        </td>

                                                        <td>
                                                            <span class="text-secondary"><a href="{{ route("admin.plans.show", $subscription->plan->id) }}">{{ $subscription->plan->name }}</a></span>
                                                        </td>
                                                        <td><span>{{ $subscription->value }}</span></td>

                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button"
                                                                    class="btn btn-success light sharp"
                                                                    data-bs-toggle="dropdown">
                                                                    <svg width="20px" height="20px"
                                                                        viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1"
                                                                            fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0"
                                                                                width="24" height="24" />
                                                                            <circle fill="#000000" cx="5"
                                                                                cy="12" r="2" />
                                                                            <circle fill="#000000" cx="12"
                                                                                cy="12" r="2" />
                                                                            <circle fill="#000000" cx="19"
                                                                                cy="12" r="2" />
                                                                        </g>
                                                                    </svg>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('admin.subscriptions.show', $subscription->id) }}">Show</a>

                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                @empty
                                                    <tr>
                                                        <th colspan="5">
                                                            <h5 class="text-center">There is No data</h5>
                                                        </th>
                                                    </tr>
                                                @endforelse

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                    <div class="table-responsive active-projects manage-client">
                                        <div class="tbl-caption">
                                            <h4 class="heading mb-0"> {{ __('Enterprise Copones') }}</h4>
                                        </div>
                                        <table class="table">
                                            <thead>
                                                <tr>

                                                    <th>Subscription</th>
                                                    <th>Review</th>
                                                    <th>Code</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($review->enterprise_copnes as $copone)
                                                    <tr>

                                                       <td><span>{{ $copone->start_date }}</span></td>
                                                        <td>
                                                            <span>{{ $copone->end_date }}</span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.enterprises.show', $copone->enterprise->id) }}">
                                                            <span>{{ $copone->enterprise->enterprise_name }}</span></a>
                                                        </td>
                                                        <td>
                                                            @if(!empty($copone->user))


                                                            <a href="{{ route("admin.reviews.show", $copone->user->id) }}"><span class="text-secondary">{{ $copone->user->first_name }}</span></a>
                                                            @endif
                                                        </td>
                                                        <td>{{ $copone->code}}</td>
                                                        <td></td>
                                                    </tr>

                                                @empty
                                                    <tr>
                                                        <th colspan="5">
                                                            <h5 class="text-center">There is No data</h5>
                                                        </th>
                                                    </tr>
                                                @endforelse

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                    <div class="table-responsive active-projects manage-client">
                                        <div class="tbl-caption">
                                            <h4 class="heading mb-0"> {{ __('Vouchers') }}</h4>
                                        </div>
                                        <table class="table">
                                            <thead>
                                                <tr>

                                                    <th>Code</th>
                                                    <th>Offer</th>
                                                    <th>Branch</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($review->vouchers as $code)
                                                    <tr>
                                                        <td>{{ $code->code }}</td>
                                                        <td>
                                                            <a href="{{ route("admin.offers.show", $code->offer->id) }}"><span class="text-secondary">{{ $code->offer->name }}</span></a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route("admin.branches.show", $code->branch->id) }}"><span class="text-secondary">{{ $code->branch->name }}</span></a>
                                                        </td>
                                                        <td></td>

                                                    </tr>

                                                @empty
                                                    <tr>
                                                        <th colspan="5">
                                                            <h5 class="text-center">There is No data</h5>
                                                        </th>
                                                    </tr>
                                                @endforelse

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <!--**********************************
        Content body end
    ***********************************-->

</x-admin-layouts.admin-app>
