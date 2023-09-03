<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">{{ $introduction->title }}</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $introduction->title_one }} </a></li>
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
                                <h4 class="heading mb-5"> {{ $introduction->title_one }}</h4>

                                    <p class="mb-3"><strong>Title One(En) : </strong> {{ $introduction->getTranslation('title_one','en') }}</p>
                                    <p class="mb-3"><strong>Title One(Ar) : </strong> {{ $introduction->getTranslation('title_one','ar') }}</p>
                                    <p class="mb-3"><strong>Title One(Fr) : </strong> {{ $introduction->getTranslation('title_one','fr') }}</p>
                                    <p class="mb-3"><strong>Title One(Es) : </strong> {{ $introduction->getTranslation('title_one','es') }}</p>
                                    <p class="mb-3"><strong>Title One(Ru) : </strong> {{ $introduction->getTranslation('title_one','ru') }}</p>
                                    <p class="mb-3"><strong>Title Two(En) : </strong> {{ $introduction->getTranslation('title_two','en') }}</p>
                                    <p class="mb-3"><strong>Title Two(Ar) : </strong> {{ $introduction->getTranslation('title_two','ar') }}</p>
                                    <p class="mb-3"><strong>Title Two(Fr) : </strong> {{ $introduction->getTranslation('title_two','fr') }}</p>
                                    <p class="mb-3"><strong>Title Two(Es) : </strong> {{ $introduction->getTranslation('title_two','es') }}</p>
                                    <p class="mb-3"><strong>Title Two(Ru) : </strong> {{ $introduction->getTranslation('title_two','ru') }}</p>
                                    <p class="mb-3"><strong>Body-En : </strong> {{ $introduction->getTranslation('body', 'en') }}</p>
                                    <p class="mb-3"><strong>Body-Ar : </strong> {{ $introduction->getTranslation('body', 'ar') }}</p>
                                    <p class="mb-3"><strong>Body-Fr : </strong> {{ $introduction->getTranslation('body', 'fr') }}</p>
                                    <p class="mb-3"><strong>Body-Es : </strong> {{ $introduction->getTranslation('body', 'es') }}</p>
                                    <p class="mb-3"><strong>Body-Ru : </strong> {{ $introduction->getTranslation('body', 'ru') }}</p>

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
