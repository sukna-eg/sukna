<x-admin-layouts.admin-app>
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title">{{ __('Call Counter') }}</h5>
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __('Call Counter') }} </a></li>
            </ol>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                    <x-admin-layouts.alerts />
                                    <div class="table-responsive active-projects manage-client">
                                        <div class="tbl-caption">
                                            <h4 class="heading mb-0"> {{ __('Call Counter') }}</h4>
                                        </div>
                                        <div class="tab-content" id="myTabContent">
											<div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
											 <div class="card-body pt-0">
												<div class="table-responsive">
													<table id="example" class="display table" style="min-width: 845px">
                                                        <thead>
                                                <tr>
                                                    <th>Partner</th>
                                                    <th>Date</th>
                                                    <th>Month</th>
                                                    <th>Year</th>
                                                    <th>Count</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($data as $count)
                                                    <tr>

                                                        <td><span><a href="{{ route('admin.partners.show',$count->partner->id) }}">{{ $count->partner->name }}</a></span></td>
                                                       
                                                        <td>
                                                            <span>{{ $count->date }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $count->month }}</span>
                                                        </td>
                                                        
                                                        <td>
                                                            <span>{{ $count->year }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $count->count }}</span>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-admin-layouts.admin-app>
