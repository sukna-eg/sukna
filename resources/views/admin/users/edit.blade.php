<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">{{ __('Edit User') }}</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{  __('Edit User') }} </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.users.index') }}" >{{  __('Users') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                <h4 class="heading mb-0"> {{ __('Edit User') }}</h4>

                            <form method="POST" action="{{ route("admin.users.update",$user->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <input name="id" type="hidden" value="{{ $user->id }}">

                                    <div class="row">
                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" placeholder="fname" value="{{ old('name',$user->name) }}">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>




                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Phone<span class="text-danger">*</span></label>
                                            <input type="phone" class="form-control" name="phone" value="{{ old('phone',$user->phone) }}">
                                            @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label for="exampleFormControlInputthird" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="exampleFormControlInputthird" name="password" value="{{ old('password') }}">
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Type<span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" id="user" type="radio" name="type" value="0" @checked(old('type',$user->type)==0)>
                                                <label class="form-check-label" for="user">
                                                    User
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="agent" type="radio" name="type" value="1" @checked(old('type',$user->type)==1)>
                                                <label class="form-check-label" for="agent">
                                                    Agent
                                                </label>
                                            </div>
                                            @error('type')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Lat</label>
                                            <input type="text" class="form-control" name="lat" value="{{ old('lat',$user->lat) }}">
                                            @error('lat')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Long</label>
                                            <input type="text" class="form-control" name="long" value="{{ old('long',$user->long) }}">
                                            @error('long')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Status<span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" id="inactive" type="radio" name="active" value="0" @checked(old('active',$user->active)==0)>
                                                <label class="form-check-label" for="inactive">
                                                    InActive
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="active" type="radio" name="active" value="1" @checked(old('active',$user->active)==1)>
                                                <label class="form-check-label" for="active">
                                                    Active
                                                </label>
                                            </div>
                                            @error('active')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Block<span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" id="notblocked" type="radio" name="is_block" value="0" @checked(old('is_block',$user->is_block)==0)>
                                                <label class="form-check-label" for="notblocked">
                                                    NotBlocked
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="blocked" type="radio" name="is_block" value="1" @checked(old('is_block',$user->is_block)==1)>
                                                <label class="form-check-label" for="blocked">
                                                    Blocked
                                                </label>
                                            </div>
                                            @error('is_block')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Reason</label>
                                            <input type="text" class="form-control" name="reason" value="{{ old('reason',$user->reason) }}">
                                            @error('reason')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Properties Count</label>
                                            <input type="integer" class="form-control" name="properties_count" value="{{ old('properties_count',$user->properties_count) }}">
                                            @error('properties_count')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            <input class="form-control" type="file" name="image" id="image">
                                            @error('image')
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
