<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">{{ $partner->id }}</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $partner->id }} </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.partners.index') }}" >{{  __('Services') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                <h4 class="heading mb-5"> {{ $partner->id }}</h4>

                                    <p class="mb-3"><strong>Id : </strong> {{  $partner->id  }}</p>
                                    <p class="mb-3"><strong>Address-En : </strong> {{ $partner->getTranslation('address', 'en') }}</p>
                                    <p class="mb-3"><strong>Address-Ar : </strong> {{ $partner->getTranslation('address', 'ar') }}</p>
                                    <p class="mb-3"><strong>Description-En : </strong> {{ $partner->getTranslation('description', 'en') }}</p>
                                    <p class="mb-3"><strong>Description-Ar : </strong> {{ $partner->getTranslation('description', 'ar') }}</p>
                                    <p class="mb-3"><strong>Type :</strong> {{ $partner->type == 1? 'Sale' : 'Rent' }}</p>
                                    <p class="mb-3"><strong>Show :</strong> {{ $partner->show == 1? 'Visible' : 'Hidden' }}</p>
                                    <p class="mb-3"><strong>Space :</strong> {{ $partner->space }}</p>
                                    <p class="mb-3"><strong>Bedrooms Count :</strong> {{ $partner->bedrooms_count }}</p>
                                    <p class="mb-3"><strong>Bathrooms Count :</strong> {{ $partner->bathrooms_count }}</p>

                                    <p class="mb-3"><strong>Cladding :</strong>
                                        @if($partner->cladding == "normal")
                                            Normal
                                        @elseif($partner->cladding == "delux")
                                            Delux
                                        @else
                                            Good
                                        @endif
                                        </p>
                                        <p class="mb-3"><strong>Floor :</strong> {{ $partner->floor }}</p>
                                        <p class="mb-3"><strong>Furnished :</strong> {{ $partner->furnished == 1? 'Furnished' : 'Unfurnished' }}</p>
                                    <p class="mb-3"><strong>Lat :</strong> {{ $partner?->lat}}</p>
                                    <p class="mb-3"><strong> Long : </strong> {{ $partner->long }}</p>
                                    <p class="mb-3"><strong>Elevator :</strong> {{ $partner->elevator == 1? 'WithElevator' : 'WithoutElevator' }}</p>
                                    <p class="mb-3"><strong>Status :</strong> {{ $partner->status == 1? 'Active' : 'InActive' }}</p>
                                    <p class="mb-3"><strong>Order : </strong> {{ $partner->order }}</p>
                                    <p class="mb-3"><strong>Premium :</strong> {{ $partner->premium == 1? 'Yes' : 'No' }}</p>
                                    <p class="mb-3"><strong>Min : </strong> {{ $partner->min }}</p>
                                    <p class="mb-3"><strong>Max : </strong> {{ $partner->max }}</p>
                                    {{-- <p class="mb-3"><strong>Period : </strong> {{ $partner->period }}</p> --}}
                                    <p class="mb-3"><strong>Period :</strong> {{ $partner->period }}</p>
                                    <p class="mb-3"><strong>Views : </strong> {{ $partner->views }}</p>
                                    <p class="mb-3"><strong>From : </strong> {{ $partner->from }}</p>
                                    <p class="mb-3"><strong>To : </strong> {{ $partner->to }}</p>
                                    <p class="mb-3"><strong>Video Url : </strong> {{ $partner->video_url }}</p>
                                    <p class="mb-3"><strong>Music Url : </strong> {{ $partner->music }}</p>

                                    @if ($partner->music)
                                    <p class="mb-3"><strong>Play:</strong> <a href="{{ route('admin.partners.file',$partner->id) }}">{{ $partner->music }}</a></p>
                                    @endif


    {{-- <audio id="music-player" controls>
        <source src="{{ asset($partner->music) }}" type="audio/mpeg">

     </audio> --}}


                                    <p class="mb-3"><strong>Created At :</strong> {{ $partner?->created_at }}</p>
                                    <p class="mb-3"><strong>Direction : </strong> {{ $partner->direction }}</p>
                                    <p class="mb-3"><strong>Property : </strong> {{ $partner->Property }}</p>

                                    <p class="mb-3"><strong>Purpose :</strong> {{ $partner?->purpose }}</p>
                                    <p class="mb-3"><strong>Price :</strong> {{ $partner?->price }}</p>
                                    <p class="mb-3"><strong>Area :</strong> {!! $partner->area->getTranslation('name', 'ar') !!}</p>
                                    <p class="mb-3"><strong>Agent :</strong> {{ $partner?->user?->name }}</p>
                                    <p class="mb-3"><strong>Subcategory :</strong> {!! $partner->subcategory->getTranslation('name', 'ar') !!}</p>
                                    @if ($partner->file)
                                    <p class="mb-3"><strong>File :</strong> <a href="{{ route('admin.partners.file',$partner->id) }}">{{ $partner->name }}</a></p>
                                    @endif


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
                                    <div class="table-responsive active-projects manage-client">
                                        <div class="tbl-caption">
                                            <h4 class="heading mb-0"> {{ __('Images') }}</h4>
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

                                                                    <th>Image</th>



                                                                    <th>actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($partner->images as $image)
                                                                    <tr>

                                                                        <td><span><img src="{{ asset($image->image) }}"
                                                                                    width="150"
                                                                                    alt=""></span></td>


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
                                                                                        href="{{ route('admin.portraits.edit', $image->id) }}">Edit</a>                                                                                </div>
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
              <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                    <div class="table-responsive active-projects manage-client">
                                        <div class="tbl-caption">
                                            <h4 class="heading mb-0"> {{ __('Appointments') }}</h4>
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
                                                                    <th>From</th>
                                                                    <th>To</th>
                                                                    <th>User Name</th>
                                                                    <th>User Id</th>

                                                                    <th>actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($partner->appointments as $app)
                                                                    <tr>
                                                                        <td>{{ $app->from }}</td>
                                                                        <td>{{ $app->to }}</td>
                                                                        <td>{{ $app->user?->name }}</td>
                                                                        <td>{{ $app->user?->id }}</td>


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
                                                                                        href="{{ route('admin.portraits.edit', $app->id) }}">Edit</a>

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

        </div>
    </div>



    {{-- <script>
        var audioPlayer = document.getElementById('music-player');
        audioPlayer.src = "{{ asset($partner->music) }}";
    </script> --}}



    <!--**********************************
        Content body end
    ***********************************-->

</x-admin-layouts.admin-app>
