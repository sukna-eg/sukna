<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">{{ __('Edit Section') }}</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{  __('Edit Section') }} </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.sections.index') }}" >{{  __('Sections') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                <h4 class="heading mb-0"> {{ __('Edit Section') }}</h4>

                            <form method="POST" action="{{ route("admin.sections.update",$section->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $section->id }}">
                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor" class="form-label">Name-En<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_en" value="{{ old('name_en',$section->getTranslation('name','en')) }}">

                                        @error('name_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor1" class="form-label">Name-Ar<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_ar" value="{{ old('name_ar',$section->getTranslation('name','ar')) }}">

                                        @error('name_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor2" class="form-label">Name-Fr</label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_fr" value="{{ old('name_fr',$section->getTranslation('name','fr')) }}">

                                    </div>
                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor3" class="form-label">Name-Es</label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_es" value="{{ old('name_es',$section->getTranslation('name','es')) }}">

                                    </div>
                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor4" class="form-label">Name-Ru</label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_ru" value="{{ old('name_ru',$section->getTranslation('name','ru')) }}">

                                    </div>






                                    <div class="col-xl-8 mb-3">
                                        <input type="submit" class="btn btn-primary me-1" value='Update'>
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
