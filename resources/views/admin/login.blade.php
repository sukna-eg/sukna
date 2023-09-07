
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="robots" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Shababeek">
	<meta property="og:title" content="Shababeek">
	<meta name="format-detection" content="telephone=no">


	<!-- PAGE TITLE HERE -->
	<title>Admin Login</title>

	<!-- FAVICONS ICON -->
    <link href="{{ asset('xhtml/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('xhtml/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
</head>

<body class="vh-100">
	<div class="page-wraper">

		<!-- Content -->
		<div class="browse-job login-style3">
			<!-- Coming Soon -->
				<div class="row gx-0 bg-white">
					<div class="col-xl-4 col-lg-5 col-md-6 col-sm-12 vh-100 position-absolute top-50 start-50 translate-middle ">
						<div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" style="max-height: 653px;" tabindex="0">
							<div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
								<div class="login-form style-2">


									<div class="card-body">
                                        @if (session()->has('error'))
                                        <div class="alert alert-danger alert-dismissible fade show">
                                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                            <strong>Error!</strong> {{ session()->get('error') }}.
                                        </div>
                                        @endif

										<div class="logo-header">
											<a href="index.html" class="logo"><img src="images/logo/logo-full.png" alt="" class="width-230 light-logo"></a>
											<a href="index.html" class="logo"><img src="images/logo/logofull-white.png" alt="" class="width-230 dark-logo"></a>
										</div>

										<nav>
											<div class="nav nav-tabs border-bottom-0" id="nav-tab" role="tablist">

										<div class="tab-content w-100" id="nav-tabContent">
										  <div class="tab-pane fade show active" id="nav-personal" role="tabpanel" aria-labelledby="nav-personal-tab">

											<form action="{{ route('admin.login') }}" method="POST" class=" dz-form pb-3">
                                                @csrf
                                                <h3 class="form-title m-t0">Admin login</h3>
													<div class="dz-separator-outer m-b5">
														<div class="dz-separator bg-primary style-liner"></div>
													</div>
													<p>Enter your e-mail address and your password. </p>
													<div class="form-group mb-3">
														<input type="email" name="email" class="form-control" placeholder="hello@example.com">
                                                        @error('email')
                                                        <div class="text-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>

													<div class="form-group mb-3">
														<input type="password" name="password"  class="form-control">
                                                        @error('password')
                                                        <div class="text-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
													<div class="form-group text-left mb-5 forget-main">
														<button type="submit" class="btn btn-primary">Sign Me In</button>
														<span class="form-check d-inline-block">
															<input type="checkbox" class="form-check-input" name='remember_me' id="check1" name="example1">
															<label class="form-check-label" for="check1">Remember me</label>
														</span>
													</div>

												</form>

										  </div>

										</div>

										</div>
									</nav>
									</div>
										<div class="card-footer">
											<div class=" bottom-footer clearfix m-t10 m-b20 row text-center">
											<div class="col-lg-12 text-center">
												<span> © Copyright by <span class="heart"></span>
												<a href="javascript:void(0);" class="text-primary">Shababeek </a> All rights reserved.</span>
											</div>
										</div>
									</div>

								</div>
							</div>

						</div>
					</div>
				</div>
			<!-- Full Blog Page Contant -->
		</div>
		<!-- Content END-->
	</div>

<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="{{ asset('xhtml/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>

<script src="{{ asset('xhtml/js/deznav-init.js') }}"></script>
 <script src="{{ asset('xhtml/js/custom.js') }}"></script>

</body>
</html>
