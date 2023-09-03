<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">{{ __('Add Workday') }}</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{  __('Add Workday') }} </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.workdays.index') }}" >{{  __('Workdays') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                <h4 class="heading mb-0"> {{ __('Add Workday') }}</h4>

                            <form method="POST" action="{{ route('admin.workdays.store') }}" enctype="multipart/form-data">
                                @csrf
                                @foreach ($days as $i => $day)
                                <div class="row">
                                    <div class="col-xl-4 mb-3">
                                        <input type="checkbox" id="day{{ $i }}" class="form-check-input" name="{{ $day['en'] }}" value="{{ $i+1 }}" @if(collect(old($day['en']))->contains($i+1)) checked @endif>
                                        <label class="form-label" for="day{{ $i }}">{{ $day['en'] }}</label>


                                    </div>
                                    <div class="col-xl-4 mb-3">
                                        <label class="form-label">From</label>
                                        <input type="time" class="form-control" name="{{ $day['en'] }}-from" value="{{ old($day['en'].'-from') }}" >
                                    </div>
                                    <div class="col-xl-4 mb-3">
                                        <label class="form-label">To</label>
                                        <input type="time" class="form-control" name="{{ $day['en'] }}-to" value="{{ old($day['en'].'-to') }}" >
                                    </div>
                                </div>
                                @endforeach
                                <div class="row">
                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Partner<span class="text-danger">*</span></label>
                                        <select class="default-select form-control wide mb-3" name="partner_id" tabindex="null">
                                            <option selected disabled>Select Partner</option>
                                            @foreach ($partners as $partner)
                                                <option value="{{ $partner->id }}" @selected(old('partner_id')==$partner->id)>{{ $partner->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-8 mb-3">
                                        <input type="submit" class="btn btn-primary me-1" value='Save'>
                                    </div>


                                </div>

                            </form>

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
