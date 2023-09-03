<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title">{{ $partner->name }} Workdays</h5>
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $partner->name }} Workdays</a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.workdays.index') }}">{{ __('Workdays') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                    <div class="table-responsive active-projects manage-client">
                                        <div class="tbl-caption">
                                            <h4 class="heading mb-0">{{ $partner->name }} Workdays</h4>
                                        </div>

                                        <table id="example" class="table">
                                            <thead>
                                                <tr>
                                                    <th>day</th>
                                                    <th>From</th>
                                                    <th>To</th>


                                                    <th>actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($partner->workdays as $day)
                                                    <tr>

                                                        <td><span>{{ $day->day }}</span></td>
                                                        <td><span>{{ $day->from }}</span></td>
                                                        <td><span>{{ $day->to }}</span></td>

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
                                                                        href="{{ route('admin.workdays.edit', $day->id) }}">Edit</a>
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

        <!--**********************************
        Content body end
    ***********************************-->

</x-admin-layouts.admin-app>
