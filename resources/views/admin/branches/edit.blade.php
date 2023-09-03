<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">{{ __('Edit Branch') }}</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{  __('Edit Branch') }} </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.branches.index') }}" >{{  __('Branches') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                <h4 class="heading mb-0"> {{ __('Edit Branch') }}</h4>

                            <form method="POST" action="{{ route("admin.branches.update",$branch->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                        <input name="id" type="hidden" value="{{ $branch->id }}">
                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor" class="form-label">Name-En<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_en" value="{{ old('name_en',$branch->getTranslation('name','en')) }}">

                                            @error('name_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor1" class="form-label">Name-Ar<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_ar" value="{{ old('name_ar',$branch->getTranslation('name','ar')) }}">

                                            @error('name_ar')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor2" class="form-label">Name-Fr</label>
                                            <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_fr" value="{{ old('name_fr',$branch->getTranslation('name','fr')) }}">

                                        </div>
                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor3" class="form-label">Name-Es</label>
                                            <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_es" value="{{ old('name_es',$branch->getTranslation('name','es')) }}">

                                        </div>
                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor4" class="form-label">Name-Ru</label>
                                            <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_ru" value="{{ old('name_ru',$branch->getTranslation('name','ru')) }}">

                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Partner<span class="text-danger">*</span></label>
                                            <select class="default-select form-control wide mb-3" name="partner_id" tabindex="null">
                                                @foreach ($partners as $partner)
                                                    <option value="{{ $partner->id }}" @selected(old('partner_id',$branch->partner_id)==$partner->id)>{{ $partner->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('partner_id')
                                                <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Area<span class="text-danger">*</span></label>
                                            <select class="default-select form-control wide mb-3" name="area_id" tabindex="null">
                                                @foreach ($areas as $area)
                                                    <option value="{{ $area->id }}" @selected(old('area_id',$branch->area_id)==$area->id)>{{ $area->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('area_id')
                                                <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>
                                        <div class="col-xl-8 mb-3">
                                             <label for="addnote" class="form-label">Location</label><span class="text-danger">*</span></label>
                                             <input type="text" id="address-input" name="location" value="{{  old('location',$branch->location) }}" class="form-control map-input">
                                             <input type="hidden" name="lat" id="address-latitude" value="{{  old('lat',$branch->lat) }}" />
                                             <input type="hidden" name="long" id="address-longitude" value="{{  old('long',$branch->long) }}" />
                                             <div id="address-map-container" style="width:100%;height:400px; ">
                                                 <div style="width: 100%; height: 100%" id="address-map"></div>
                                             </div>
                                             @error('location')
                                             <div class="text-danger">{{ $message }}</div>
                                             @enderror

                                            </div>

                                    <div class="col-xl-8 mb-3">
                                        <input type="submit" class="btn btn-primary me-1" value='Update '>
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
