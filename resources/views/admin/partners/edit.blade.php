<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">{{ __('Edit Partner') }}</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{  __('Edit Partner') }} </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.partners.index') }}" >{{  __('Partners') }}</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                <h4 class="heading mb-0"> {{ __('Edit Partner') }}</h4>

                            <form method="POST" action="{{ route("admin.partners.update",$partner->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                        <input name="id" type="hidden" value="{{ $partner->id }}">
                                        {{-- <div class="col-xl-8 mb-3">
                                            <label for="ckeditor" class="form-label">Address-En<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="exampleFormControlInputfirst" name="address_en" value="{{ old('address_en',$partner->getTranslation('address','en')) }}">

                                            @error('address_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div> --}}

                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor1" class="form-label">Address<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="exampleFormControlInputfirst" name="address" value="{{ old('address',$partner->address) }}">

                                            @error('address')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        {{-- </div> <div class="col-xl-8 mb-3">
                                            <label class="form-label">Description-En<span class="text-danger">*</span></label>
                                            <textarea class="form-txtarea form-control" rows="8" name="description_en">{{ old('description_en',$partner->getTranslation('description','en')) }}</textarea>
                                            @error('description_en')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div> --}}

                                        <div class="col-xl-8 mb-3">
                                            <label for="ckeditor1" class="form-label">Description<span class="text-danger">*</span></label>
                                            {{-- <div class="card-body custom-ekeditor"> --}}
                                            <textarea id="ckeditor1" class="form-txtarea form-control" rows="8" name="description">{{ old('description',$partner->address) }}</textarea>
                                            {{-- </div> --}}
                                            @error('description')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-xl-8 mb-3" id="fromField">
                                            <label class="form-label">Start Date</label>
                                            <input type="date" class="form-control" name="start_date" value="{{ old('start_date',$partner->start_date) }}">
                                            @error('start_date')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3" id="fromField">
                                            <label class="form-label">End Date</label>
                                            <input type="date" class="form-control" name="end_date" value="{{ old('end_date',$partner->end_date) }}">
                                            @error('end_date')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Type<span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" id="rent" type="radio" name="type" value="0" @checked(old('type',$partner->type)==0)>
                                                <label class="form-check-label" for="rent">
                                                    Rent
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="sale" type="radio" name="type" value="1" @checked(old('type',$partner->type)==1)>
                                                <label class="form-check-label" for="sale">
                                                    Sale
                                                </label>
                                            </div>
                                            @error('type')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3" id="minField">
                                            <label class="form-label">Min</label>
                                            <input type="number" class="form-control" name="min" value="{{ old('min',$partner->min) }}">
                                            @error('min')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3" id="maxField">
                                            <label class="form-label">Max</label>
                                            <input type="number" class="form-control" name="max" value="{{ old('max',$partner->max) }}">
                                            @error('max')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3" id="periodField">
                                            <label class="form-label">Period<span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" id="monthly" type="radio" name="period" value=1 @checked(old('period',$partner->period)==1)>
                                                <label class="form-check-label" for="monthly">
                                                    Monthly
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="daily" type="radio" name="period" value=0 @checked(old('period',$partner->period)==0)>
                                                <label class="form-check-label" for="daily">
                                                    Daily
                                                </label>
                                            </div>

                                            @error('period')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3" id="fromField">
                                            <label class="form-label">From</label>
                                            <input type="date" class="form-control" name="from" value="{{ old('from',$partner->from) }}">
                                            @error('from')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3" id="toField">
                                            <label class="form-label">To</label>
                                            <input type="date" class="form-control" name="to" value="{{ old('to',$partner->to) }}">
                                            @error('to')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- <div class="col-xl-8 mb-3">
                                            <label class="form-label">Type<span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" id="rent" type="radio" name="type" value="0" @checked(old('type',$partner->type)==0)>
                                                <label class="form-check-label" for="rent">
                                                    Rent
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="sale" type="radio" name="type" value="1" @checked(old('type',$partner->type)==1)>
                                                <label class="form-check-label" for="sale">
                                                    Sale
                                                </label>
                                            </div>
                                            @error('type')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Min</label>
                                            <input type="number" class="form-control" name="min" value="{{ old('min',$partner->min) }}">
                                            @error('min')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Max</label>
                                            <input type="number" class="form-control" name="max" value="{{ old('max',$partner->max) }}">
                                            @error('max')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Period<span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" id="monthly" type="radio" name="period" value="0" @checked(old('period',$partner->period)=="0")>
                                                <label class="form-check-label" for="monthly">
                                                    Monthly
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="daily" type="radio" name="period" value="1" @checked(old('period',$partner->period)=="1")>
                                                <label class="form-check-label" for="daily">
                                                    Daily
                                                </label>
                                            </div>

                                            @error('period')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>


                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">From</label>
                                            <input type="date" class="form-control" name="from" value="{{ old('from',$partner->from) }}">
                                            @error('from')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">To</label>
                                            <input type="date" class="form-control" name="to" value="{{ old('to',$partner->to) }}">
                                            @error('to')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div> --}}


                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Show<span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" id="hidden" type="radio" name="show" value="0" @checked(old('show',$partner->show)==0)>
                                                <label class="form-check-label" for="hidden">
                                                    Hidden
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="visible" type="radio" name="show" value="1" @checked(old('show',$partner->show)==1)>
                                                <label class="form-check-label" for="visible">
                                                    Visible
                                                </label>
                                            </div>
                                            @error('show')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Space<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="space" value="{{ old('space',$partner->space) }}">
                                            @error('space')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Bedrooms Count<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="bedrooms_count" value="{{ old('bedrooms_count',$partner->bedrooms_count) }}">
                                            @error('bedrooms_count')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Bathrooms Count<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="bathrooms_count" value="{{ old('bathrooms_count',$partner->bathrooms_count) }}">
                                            @error('bathrooms_count')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Cladding<span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" id="Without" type="radio" name="cladding" value="بدون تشطيب" @checked(old('cladding',$partner->cladding)=="بدون تشطيب")>
                                                <label class="form-check-label" for="Without">
                                                    Without Cladding
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="Half" type="radio" name="cladding" value="نصف تشطيب" @checked(old('cladding',$partner->cladding)=="نصف تشطيب")>
                                                <label class="form-check-label" for="Half">
                                                    Half Cladding
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="Full" type="radio" name="cladding" value="تشطيب كامل" @checked(old('cladding',$partner->cladding)=="تشطيب كامل")>
                                                <label class="form-check-label" for="Full">
                                                    Full Cladding
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="Lux" type="radio" name="cladding" value="تشطيب لوكس" @checked(old('cladding',$partner->cladding)=="تشطيب لوكس")>
                                                <label class="form-check-label" for="Lux">
                                                    Lux Cladding
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="Super" type="radio" name="cladding" value="تشطيب سوبر لوكس" @checked(old('cladding',$partner->cladding)=="تشطيب سوبر لوكس")>
                                                <label class="form-check-label" for="Super">
                                                   Super Lux Cladding
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="delux" type="radio" name="cladding" value="تشطيب ديلوكس" @checked(old('cladding',$partner->cladding)=="تشطيب ديلوكس")>
                                                <label class="form-check-label" for="delux">
                                                    Delux
                                                </label>
                                            </div>
                                            @error('cladding')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Floor</label>
                                            <input type="number" class="form-control" name="floor" value="{{ old('floor',$partner->floor) }}">
                                            @error('floor')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Furnished<span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" id="unfurnished" type="radio" name="furnished" value="0" @checked(old('furnished',$partner->furnished)==0)>
                                                <label class="form-check-label" for="unfurnished">
                                                    Unfurnished
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="furnished" type="radio" name="furnished" value="1" @checked(old('furnished',$partner->furnished)==1)>
                                                <label class="form-check-label" for="furnished">
                                                    Furnished
                                                </label>
                                            </div>
                                            @error('furnished')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>


                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Elevator<span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" id="withoutelevator" type="radio" name="elevator" value="0" @checked(old('elevator',$partner->elevator)==0)>
                                                <label class="form-check-label" for="withoutelevator">
                                                    Without Elevator
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="withelevator" type="radio" name="elevator" value="1" @checked(old('elevator',$partner->elevator)==1)>
                                                <label class="form-check-label" for="withelevator">
                                                    With Elevator
                                                </label>
                                            </div>
                                            @error('elevator')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Lat</label>
                                            <input type="text" class="form-control" name="lat" value="{{ old('lat',$partner->lat) }}">
                                            @error('lat')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Long</label>
                                            <input type="text" class="form-control" name="long" value="{{ old('long',$partner->long) }}">
                                            @error('long')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Status<span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" id="inactive" type="radio" name="status" value="0" @checked(old('status',$partner->status)==0)>
                                                <label class="form-check-label" for="inactive">
                                                    InActive
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="active" type="radio" name="status" value="1" @checked(old('status',$partner->status)==1)>
                                                <label class="form-check-label" for="active">
                                                    Active
                                                </label>
                                            </div>
                                            @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Order<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="order" value="{{ old('order',$partner->order) }}">
                                            @error('order')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Premium<span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" id="notpremium" type="radio" name="premium" value="0" @checked(old('premium',$partner->premium)==0)>
                                                <label class="form-check-label" for="notpremium">
                                                    Not Premium
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" id="premium" type="radio" name="premium" value="1" @checked(old('premium',$partner->premium)==1)>
                                                <label class="form-check-label" for="premium">
                                                    Premium
                                                </label>
                                            </div>
                                            @error('premium')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Is Smart<span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" id="no" type="radio" name="is_smart" value="0" @checked(old('is_smart',$partner->is_smart)==0)>
                                                <label class="form-check-label" for="no">
                                                    No
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" id="yes" type="radio" name="is_smart" value="1" @checked(old('is_smart',$partner->is_smart)==1)>
                                                <label class="form-check-label" for="yes">
                                                    Yes
                                                </label>
                                            </div>
                                            @error('is_smart')
                                            <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                        </div>




                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Video Url</label>
                                            <input type="url" class="form-control" name="video_url" value="{{ old('video_url',$partner->video_url) }}">
                                            @error('video_url')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-xl-8 mb-3">
                                            <label class="form-label">Music</label>
                                            <input type="file" class="form-control" name="music" value="{{ old('music',$partner->music) }}">
                                            @error('music')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    {{-- <div class="col-xl-8 mb-3">
                                        <label class="form-label">Direction</label>
                                        <input type="text" class="form-control" name="direction" value="{{ old('direction',$partner->direction) }}">
                                        @error('direction')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Direction<span class="text-danger">*</span></label>
                                        <div class="form-check">
                                            <input class="form-check-input" id="بحري" type="radio" name="direction" value="بحري" @checked(old('direction',$partner->direction)=="بحري")>
                                            <label class="form-check-label" for="بحري">
                                                بحري
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="قبلي" type="radio" name="direction" value="قبلي" @checked(old('direction',$partner->direction)=="قبلي")>
                                            <label class="form-check-label" for="قبلي">
                                                قبلي
                                            </label>
                                        </div>


                                        @error('direction')
                                        <div class="text-danger">{{ $message }}</div>
                                         @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Property</label>
                                        <input type="text" class="form-control" name="Property" value="{{ old('Property',$partner->Property) }}">
                                        @error('Property')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Purpose<span class="text-danger">*</span></label>
                                        <div class="form-check">
                                            <input class="form-check-input" id="commercial" type="radio" name="purpose" value="تجاري" @checked(old('purpose',$partner->purpose)=="تجاري")>
                                            <label class="form-check-label" for="commercial">
                                                Commercial
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="residential" type="radio" name="purpose" value="سكني" @checked(old('purpose',$partner->purpose)=="سكني")>
                                            <label class="form-check-label" for="residential">
                                                Residential
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="medical" type="radio" name="purpose" value="طبي" @checked(old('purpose',$partner->purpose)=="طبي")>
                                            <label class="form-check-label" for="medical">
                                                Medical
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="managerial" type="radio" name="purpose" value="إداري" @checked(old('purpose',$partner->purpose)=="إداري")>
                                            <label class="form-check-label" for="managerial">
                                                Managerial
                                            </label>
                                        </div>

                                        @error('purpose')
                                        <div class="text-danger">{{ $message }}</div>
                                         @enderror
                                    </div>

                                    {{-- <div class="col-xl-8 mb-3">
                                        <label class="form-label">Purpose</label>
                                        <input type="text" class="form-control" name="purpose" value="{{ old('purpose',$partner->purpose) }}">
                                        @error('purpose')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="text" class="form-control" name="price" value="{{ old('price',$partner->price) }}">
                                        @error('price')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Plan<span class="text-danger">*</span></label>
                                        <select class="default-select form-control wide mb-3" name="plan_id" tabindex="null">
                                            @foreach ($plans as $plan)
                                                <option value="{{ $plan->id }}" @selected(old('plan_id',$partner->plan->id)==$plan->id)>{{ $plan->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('plan_id')
                                            <div class="text-danger">{{ $message }}</div>
                                         @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Area<span class="text-danger">*</span></label>
                                        <select class="default-select form-control wide mb-3" name="area_id" tabindex="null">
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}" @selected(old('area_id',$partner->area->id)==$area->id)>{!! $area->getTranslation('name', 'ar') !!}</option>
                                            @endforeach
                                        </select>
                                        @error('area_id')
                                            <div class="text-danger">{{ $message }}</div>
                                         @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Agent<span class="text-danger">*</span></label>
                                        <select class="default-select form-control wide mb-3" name="user_id" tabindex="null">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" @selected(old('user_id',$partner->user->id)==$user->id)>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <div class="text-danger">{{ $message }}</div>
                                         @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Subcategory<span class="text-danger">*</span></label>
                                        <select class="default-select form-control wide mb-3" name="subcategory_id" tabindex="null">
                                            @foreach ($subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}" @selected(old('_id',$partner->subcategory->id)==$subcategory->id)>{!! $subcategory->getTranslation('name', 'ar') !!}</option>
                                            @endforeach
                                        </select>
                                        @error('subcategory_id')
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


    <script>
        // Get references to the rent and sale radio buttons
        const rentRadio = document.getElementById('rent');
        const saleRadio = document.getElementById('sale');

        // Get references to the fields
        const minField = document.getElementById('minField');
        const maxField = document.getElementById('maxField');
        const periodField = document.getElementById('periodField');
        const fromField = document.getElementById('fromField');
        const toField = document.getElementById('toField');
        const periodRadios = document.getElementsByName('period');

        // Function to show or hide the fields based on the selected radio button
        function toggleFields() {
            if (rentRadio.checked) {
                minField.style.display = 'block';
                maxField.style.display = 'block';
                periodField.style.display = 'block';
                fromField.style.display = 'block';
                toField.style.display = 'block';
                for (let i = 0; i < periodRadios.length; i++) {
                    periodRadios[i].disabled = false;
                }
            } else {
                minField.style.display = 'none';
                maxField.style.display = 'none';
                periodField.style.display = 'none';
                fromField.style.display = 'none';
                toField.style.display = 'none';
                for (let i = 0; i < periodRadios.length; i++) {
                    periodRadios[i].disabled = true;
                }
            }
        }

        // Add event listeners to the radio buttons
        rentRadio.addEventListener('change', toggleFields);
        saleRadio.addEventListener('change', toggleFields);

        // Initially hide/show fields based on the selected radio button on page load
        toggleFields();
    </script>

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
