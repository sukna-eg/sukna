<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">{{ __('Edit Faq') }}</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{  __('Edit Faq') }} </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.faqs.index') }}" >{{  __('Faqs') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                <h4 class="heading mb-0"> {{ __('Edit Faq') }}</h4>

                            <form method="POST" action="{{ route("admin.faqs.update",$faq->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                        <input name="id" type="hidden" value="{{ $faq->id }}">
                                        <div class="col-xl-8 mb-3">
                                            <label for="exampleFormControlInputfirst" class="form-label">Question-En<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="exampleFormControlInputfirst" name="question_en" value="{{ old('question_en',$faq->getTranslation('question', 'en')) }}">
                                            @error('question_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label for="exampleFormControlInputsecond" class="form-label">Question-Ar<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="exampleFormControlInputsecond" name="question_ar" value="{{ old('question_ar',$faq->getTranslation('question', 'ar')) }}">
                                            @error('question_ar')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label for="exampleFormControlInputsecond" class="form-label">Question-Fr</label>
                                            <input type="text" class="form-control" id="exampleFormControlInputsecond" name="question_fr" value="{{ old('question_fr',$faq->getTranslation('question', 'fr')) }}">

                                        </div>
                                        <div class="col-xl-8 mb-3">
                                            <label for="exampleFormControlInputsecond" class="form-label">Question-Es</label>
                                            <input type="text" class="form-control" id="exampleFormControlInputsecond" name="question_es" value="{{ old('question_es',$faq->getTranslation('question', 'es')) }}">

                                        </div>
                                        <div class="col-xl-8 mb-3">
                                            <label for="exampleFormControlInputsecond" class="form-label">Question-Ru</label>
                                            <input type="text" class="form-control" id="exampleFormControlInputsecond" name="question_ru" value="{{ old('question_ru',$faq->getTranslation('question', 'ru')) }}">

                                        </div>

                                        <div class="col-xl-8 mb-3">
                                        <label class="form-label">Answer-En<span class="text-danger">*</span></label>
                                            <textarea class="form-txtarea form-control" rows="8" name="answer_en">{{ old('answer_en',$faq->getTranslation('answer', 'en')) }}</textarea>
                                            @error('answer_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                        <label for="ckeditor1" class="form-label">Answer-Ar<span class="text-danger">*</span></label>
                                        {{-- <div class="card-body custom-ekeditor"> --}}

                                        <textarea id="ckeditor1" class="form-txtarea form-control" rows="8" name="answer_ar">{{ old('answer_ar',$faq->getTranslation('answer', 'ar')) }}</textarea>
                                        {{-- </div> --}}
                                        @error('answer_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor2" class="form-label">Answer-Fr</label>
                                            {{-- <div class="card-body custom-ekeditor"> --}}

                                            <textarea id="ckeditor2" class="form-txtarea form-control" rows="8" name="answer_fr">{{ old('answer_ar',$faq->getTranslation('answer', 'fr')) }}</textarea>
                                            {{-- </div> --}}

                                            </div>


                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor3" class="form-label">Answer-Es</label>
                                            {{-- <div class="card-body custom-ekeditor"> --}}

                                            <textarea id="ckeditor3" class="form-txtarea form-control" rows="8" name="answer_es">{{ old('answer_ar',$faq->getTranslation('answer', 'es')) }}</textarea>
                                            {{-- </div> --}}

                                            </div>

                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor4" class="form-label">Answer-Ru</label>
                                            {{-- <div class="card-body custom-ekeditor"> --}}

                                            <textarea id="ckeditor4" class="form-txtarea form-control" rows="8" name="answer_ru">{{ old('answer_ar',$faq->getTranslation('answer', 'ru')) }}</textarea>
                                            {{-- </div> --}}

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
