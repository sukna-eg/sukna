<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">{{ __('Add Introduction') }}</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{  __('Add Introduction') }} </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.introductions.index') }}" >{{  __('Introductions') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                <h4 class="heading mb-0"> {{ __('Add Introduction') }}</h4>

                            <form method="POST" action="{{ route('admin.introductions.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title One(En)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_one_en" value="{{ old('title_one_en') }}">
                                        @error('title_one_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title Two(En)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_two_en" value="{{ old('title_two_en') }}">
                                        @error('title_two_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title One(Ar)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_one_ar" value="{{ old('title_one_ar') }}">
                                        @error('title_one_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title Two(Ar)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_two_ar" value="{{ old('title_two_ar') }}">
                                        @error('title_two_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title One(Fr)</label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_one_fr" value="{{ old('title_one_fr') }}">

                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title Two(Fr)</label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_two_fr" value="{{ old('title_two_fr') }}">

                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title One(Es)</label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_one_es" value="{{ old('title_one_es') }}">

                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title Two(Es)</label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_two_es" value="{{ old('title_two_es') }}">

                                    </div>
                                       <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title One(Ru)</label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_one_ru" value="{{ old('title_one_ru') }}">

                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="exampleFormControlInputfirst" class="form-label">Title Two(Ru)</label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="title_two_ru" value="{{ old('title_two_ru') }}">

                                    </div>


                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Body-En<span class="text-danger">*</span></label>
                                        <textarea class="form-txtarea form-control" rows="8" name="body_en">{{ old('body_en') }}</textarea>
                                        @error('body_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor1" class="form-label">Body-Ar<span class="text-danger">*</span></label>
                                        {{-- <div class="card-body custom-ekeditor"> --}}
                                        <textarea id="ckeditor1" class="form-txtarea form-control" rows="8" name="body_ar">{{ old('body_ar') }}</textarea>
                                        {{-- </div> --}}
                                        @error('body_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor2" class="form-label">Body-Fr</label>
                                    {{-- <div class="card-body custom-ekeditor"> --}}
                                        <textarea id="ckeditor2" class="form-txtarea form-control" rows="8" name="body_fr">{{ old('body_fr') }}</textarea>
                                    {{-- </div> --}}
                                    </div>
                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor3" class="form-label">Body-Es</label>
                                        {{-- <div class="card-body custom-ekeditor"> --}}
                                        <textarea id="ckeditor3" class="form-txtarea form-control" rows="8" name="body_es">{{ old('body_es') }}</textarea>
                                        {{-- </div> --}}
                                    </div>
                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor4" class="form-label">Body-Ru</label>
                                        {{-- <div class="card-body custom-ekeditor"> --}}
                                        <textarea id="ckeditor4" class="form-txtarea form-control" rows="8" name="body_ru">{{ old('body_ru') }}</textarea>
                                        {{-- </div> --}}
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label for="image" class="form-label">Image Number<span class="text-danger">*</span></label>
                                        <input class="form-control" type="number" name="image_number" value="{{ old('image_number') }}" id="image">
                                        @error('image_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
    {{-- @push('javasc')
    <script>

        ClassicEditor
    .create( document.querySelector( '#ckeditor1'),{language: 'en'} )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
    .create( document.querySelector( '#ckeditor2'),{language: 'fr'} )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
    .create( document.querySelector( '#ckeditor3'),{language: 'es'} )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
    .create( document.querySelector( '#ckeditor4'),{language: 'ru'} )
        .catch( error => {
            console.error( error );
        } );
    </script>
    @endpush --}}
</x-admin-layouts.admin-app>
