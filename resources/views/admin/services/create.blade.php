<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">{{ __('Add Service') }}</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{  __('Add Service') }} </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.services.index') }}" >{{  __('services') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                <h4 class="heading mb-0"> {{ __('Add Service') }}</h4>

                            <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor" class="form-label">Name-En<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_en" value="{{ old('name_en') }}">

                                        @error('name_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor1" class="form-label">Name-Ar<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="name_ar" value="{{ old('name_ar') }}">

                                        @error('name_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>




                                   <div class="col-xl-8 mb-3">
                                        <label for="ckeditor" class="form-label">Address<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="address" value="{{ old('address') }}">

                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- <div class="col-xl-8 mb-3">
                                        <label for="ckeditor" class="form-label">Address-Ar<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="address_ar" value="{{ old('address_ar') }}">

                                        @error('address_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Description-En<span class="text-danger">*</span></label>
                                        <textarea class="form-txtarea form-control" rows="8" name="description_en">{{ old('description_en') }}</textarea>
                                        @error('description_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor1" class="form-label">Description-Ar<span class="text-danger">*</span></label>
                                        {{-- <div class="card-body custom-ekeditor"> --}}
                                        <textarea id="ckeditor1" class="form-txtarea form-control" rows="8" name="description_ar">{{ old('description_ar') }}</textarea>
                                        {{-- </div> --}}
                                        @error('description_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-xl-8 mb-3">
                                        <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                        <input class="form-control" type="file" name="image" id="image">
                                        @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label for="logo" class="form-label">Logo<span class="text-danger">*</span></label>
                                        <input class="form-control" type="file" name="logo" id="logo">
                                        @error('logo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Whatsapp</label>
                                        <input type="text" class="form-control" name="whatsapp" value="{{ old('whatsapp') }}">
                                        @error('whatsapp')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Facebook</label>
                                        <input type="url" class="form-control" name="facebook" value="{{ old('facebook') }}">
                                        @error('facebook')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Premium<span class="text-danger">*</span></label>
                                        <div class="form-check">
                                            <input class="form-check-input" id="notpremium" type="radio" name="premium" value="0" @checked(old('premium')==0)>
                                            <label class="form-check-label" for="notpremium">
                                                Not Premium
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" id="premium" type="radio" name="premium" value="1" @checked(old('premium')==1)>
                                            <label class="form-check-label" for="premium">
                                                Premium
                                            </label>
                                        </div>
                                        @error('premium')
                                        <div class="text-danger">{{ $message }}</div>
                                         @enderror
                                    </div>


                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Category<span class="text-danger">*</span></label>
                                        <select class="default-select form-control wide mb-3" name="category_id" tabindex="null">
											<option selected disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('category_id')==$category->id)>{!! $category->getTranslation('name', 'ar') !!}</option>
                                            @endforeach
										</select>
                                        @error('category_id')
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
