<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">{{ __('Add Answer') }}</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{  __('Add Answer') }} </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.answers.index') }}" >{{  __('Answers') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                <h4 class="heading mb-0"> {{ __('Add Answer') }}</h4>

                            <form method="POST" action="{{ route('admin.answers.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor" class="form-label">Answer-En<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="answer_en" value="{{ old('answer_en') }}">

                                        @error('answer_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor1" class="form-label">Answer-Ar<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="answer_ar" value="{{ old('answer_ar') }}">

                                        @error('answer_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">User<span class="text-danger">*</span></label>
                                        <select class="default-select form-control wide mb-3" name="user_id" tabindex="null">
											<option selected disabled>Select User</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" @selected(old('user_id')==$user->id)>{{ $user->name }}</option>
                                            @endforeach
										</select>
                                        @error('user_id')
                                            <div class="text-danger">{{ $message }}</div>
                                         @enderror
                                    </div>


                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Question<span class="text-danger">*</span></label>
                                        <select class="default-select form-control wide mb-3" name="question_id" tabindex="null">
											<option selected disabled>Select Question</option>
                                            @foreach ($questions as $question)
                                                <option value="{{ $question->id }}" @selected(old('question_id')==$question->id)>{!! $question->getTranslation('question', 'ar') !!}</option>
                                            @endforeach
										</select>
                                        @error('question_id')
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
