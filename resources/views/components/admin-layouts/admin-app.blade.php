
<x-admin-layouts.header />
<body @class([
    'vh-100'=>isset($is405Page)&&$is405Page
]) data-typography="poppins" data-theme-version="light" data-layout="vertical" data-nav-headerbg="black" data-headerbg="color_1">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{ route('admin.dashboard') }}" class="brand-logo">
                {{-- <img src="{{ asset('assets/images/logo.png')}}" alt="" width="150"> --}}
            </a>

        </div>
        <!--**********************************
            Nav header end
        ***********************************-->


		<x-admin-layouts.header-nav />
		<x-admin-layouts.sidebar />


            {{ $slot }}
		<x-admin-layouts.footer />

