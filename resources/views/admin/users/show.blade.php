<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title">{{ $user->name }}</h5>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z"
                                stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $user->name }} </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.users.index') }}">{{ __('Users') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                    <h4 class="heading mb-5"> {{ $user->name }}</h4>
                                    <p class="mb-3"><strong>Id : </strong> {{  $user->id  }}</p>
                                    <p class="mb-3"><strong>Name: </strong> {{ $user->name }}</p>
                                    <p class="mb-3"><strong>Email : </strong> {{ $user->email }}</p>
                                    <p class="mb-3"><strong>Phone :</strong> {{ $user->phone }}</p>
                                    <p class="mb-3"><strong>Type :</strong> {{ $user->type==1?'Agent':'User' }}</p>
                                    <p class="mb-3"><strong>Lat :</strong> {{ $user?->lat}}</p>
                                    <p class="mb-3"><strong> Long : </strong> {{ $user->long }}</p>
                                    <p class="mb-3"><strong>Status :</strong> {{ $user->active == 1? 'Active' : 'InActive' }}</p>
                                    <p class="mb-3"><strong>Block :</strong> {{ $user->is_block == 1? 'Blocked' : 'NotBlocked' }}</p>
                                    <p class="mb-3"><strong>Reason :</strong> {{ $user->reason }}</p>
                                    <p class="mb-3"><strong>Properties Count :</strong> {{ $user->properties_count }}</p>
                                    <p class="mb-3"><strong>Start Date :</strong> {{ $user->start_date }}</p>
                                    <p class="mb-3"><strong>Created At :</strong> {{ $user->created_at }}</p>
                                    <img class="card-img-bottom img-thumbnail mb-3" style="width: 500px"
                                        src="{{ asset($user->image) }}" alt="{{ $user->name }}">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                    <x-admin-layouts.alerts />
                                    <div class="table-responsive active-projects manage-client">
                                        <div class="tbl-caption">
                                            <h4 class="heading mb-0"> {{ __('Partners') }}</h4>
                                        </div>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="Preview" role="tabpanel"
                                                aria-labelledby="home-tab">
                                                <div class="card-body pt-0">
                                                    <div class="table-responsive">
                                                        <table id="example" class="display table"
                                                            style="min-width: 845px">
                                                            <thead>
                                                                <tr>
                                                                    <th>Id</th>
                                                                    <th>Type</th>
                                                                    <th>Active</th>
                                                                    {{-- <th>Cladding</th> --}}
                                                                    <th>Status</th>
                                                                    <th>Premium</th>
                                                                    <th>Subcategory</th>



                                                                    <th>actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($user->partners as $partner)
                                                                    <tr>

                                                                        <td><span><a
                                                                                    href="{{ route('admin.partners.show', $partner->id) }}">{{ $partner->id }}</a></span>
                                                                        </td>

                                                                        <td>
                                                                            <span>{{ $partner->type == 1? 'Sale' : 'Rent' }}</span>
                                                                        </td>

                                                                        <td>
                                                                                <span>{{ $partner->show == 1? 'Visible' : 'Hidden' }}</span>
                                                                        </td>
                                                                        <td>
                                                                            <span>{{ $partner->status == 1? 'Active' : 'InActive' }}</span>
                                                                        </td>
                                                                        <td>
                                                                            <span>{{ $partner->premium == 1? 'Yes' : 'No' }}</span>
                                                                        </td>
                                                                        <td>
                                                                            <span>{{ $partner->subcategory->name }}</span>
                                                                        </td>


                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <button type="button"
                                                                                    class="btn btn-success light sharp"
                                                                                    data-bs-toggle="dropdown">
                                                                                    <svg width="20px" height="20px"
                                                                                        viewBox="0 0 24 24"
                                                                                        version="1.1">
                                                                                        <g stroke="none"
                                                                                            stroke-width="1"
                                                                                            fill="none"
                                                                                            fill-rule="evenodd">
                                                                                            <rect x="0"
                                                                                                y="0"
                                                                                                width="24"
                                                                                                height="24" />
                                                                                            <circle fill="#000000"
                                                                                                cx="5"
                                                                                                cy="12"
                                                                                                r="2" />
                                                                                            <circle fill="#000000"
                                                                                                cx="12"
                                                                                                cy="12"
                                                                                                r="2" />
                                                                                            <circle fill="#000000"
                                                                                                cx="19"
                                                                                                cy="12"
                                                                                                r="2" />
                                                                                        </g>
                                                                                    </svg>
                                                                                </button>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('admin.partners.edit', $partner->id) }}">Edit</a>
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('admin.partners.show', $partner->id) }}">Show</a>

                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                @empty
                                                                    <tr>
                                                                        <th colspan="5">
                                                                            <h5 class="text-center">There is No data
                                                                            </h5>
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
                                    <div class="table-responsive active-projects manage-client">
                                        <div class="tbl-caption">
                                            <h4 class="heading mb-0"> {{ __('Enterprise Copones') }}</h4>
                                        </div>
                                        <table class="table">
                                            <thead>
                                                <tr>

                                                    <th>Subscription</th>
                                                    <th>User</th>
                                                    <th>Code</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($user->enterprise_copnes as $copone)
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
                                                            @if (!empty($copone->user))


                                                            <a href="{{ route("admin.users.show", $copone->user->id) }}"><span class="text-secondary">{{ $copone->user->first_name }}</span></a>
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
                                                @forelse ($user->vouchers as $code)
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
