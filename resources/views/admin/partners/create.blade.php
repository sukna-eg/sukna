<x-admin-layouts.admin-app>
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li><h5 class="bc-title">{{ __('Add Partner') }}</h5></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{  __('Add Partner') }} </a></li>
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
                                <h4 class="heading mb-0"> {{ __('Add Partner') }}</h4>

                            <form method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor" class="form-label">Address-En<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="address_en" value="{{ old('address_en') }}">

                                        @error('address_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label for="ckeditor" class="form-label">Address-Ar<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInputfirst" name="address_ar" value="{{ old('address_ar') }}">

                                        @error('address_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
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
                                        <label class="form-label">Type<span class="text-danger">*</span></label>
                                        <div class="form-check">
                                            <input class="form-check-input" id="rent" type="radio" name="type" value="0" @checked(old('type')==0)>
                                            <label class="form-check-label" for="rent">
                                                Rent
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="sale" type="radio" name="type" value="1" @checked(old('type')==1)>
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
                                        <input type="number" class="form-control" name="min" value="{{ old('min') }}">
                                        @error('min')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3" id="maxField">
                                        <label class="form-label">Max</label>
                                        <input type="number" class="form-control" name="max" value="{{ old('max') }}">
                                        @error('max')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3" id="periodField">
                                        <label class="form-label">Period<span class="text-danger">*</span></label>
                                        <div class="form-check">
                                            <input class="form-check-input" id="monthly" type="radio" name="period" value="monthly" @checked(old('period')=="monthly")>
                                            <label class="form-check-label" for="monthly">
                                                Monthly
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="daily" type="radio" name="period" value="daily" @checked(old('period')=="daily")>
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
                                        <input type="date" class="form-control" name="from" value="{{ old('from') }}">
                                        @error('from')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3" id="toField">
                                        <label class="form-label">To</label>
                                        <input type="date" class="form-control" name="to" value="{{ old('to') }}">
                                        @error('to')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                     {{-- <div class="col-xl-8 mb-3">
                                        <label class="form-label">Type<span class="text-danger">*</span></label>
                                        <div class="form-check">
                                            <input class="form-check-input" id="rent" type="radio" name="type" value="0" @checked(old('type')==0)>
                                            <label class="form-check-label" for="rent">
                                              Rent
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="sale" type="radio" name="type" value="1" @checked(old('type')==1)>
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
                                        <input type="number" class="form-control" name="min" value="{{ old('min') }}">
                                        @error('min')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Max</label>
                                        <input type="number" class="form-control" name="max" value="{{ old('max') }}">
                                        @error('max')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>



                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Period<span class="text-danger">*</span></label>
                                        <div class="form-check">
                                            <input class="form-check-input" id="monthly" type="radio" name="period" value="monthly" @checked(old('period')=="monthly")>
                                            <label class="form-check-label" for="monthly">
                                                Monthly
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="daily" type="radio" name="period" value="daily" @checked(old('period')=="daily")>
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
                                        <input type="date" class="form-control" name="from" value="{{ old('from') }}">
                                        @error('from')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">To</label>
                                        <input type="date" class="form-control" name="to" value="{{ old('to') }}">
                                        @error('to')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div> --}}


                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Show<span class="text-danger">*</span></label>
                                        <div class="form-check">
                                            <input class="form-check-input" id="hidden" type="radio" name="show" value="0" @checked(old('show')==0)>
                                            <label class="form-check-label" for="hidden">
                                              Hidden
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="visible" type="radio" name="show" value="1" @checked(old('show')==1)>
                                            <label class="form-check-label" for="visible">
                                                Visible
                                            </label>
                                        </div>
                                        @error('show')
                                        <div class="text-danger">{{ $message }}</div>
                                         @enderror
                                    </div>



                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Space</label>
                                        <input type="number" class="form-control" name="space" value="{{ old('space') }}">
                                        @error('space')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Bedrooms Count</label>
                                        <input type="number" class="form-control" name="bedrooms_count" value="{{ old('bedrooms_count') }}">
                                        @error('bedrooms_count')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Bathrooms Count</label>
                                        <input type="number" class="form-control" name="bathrooms_count" value="{{ old('bathrooms_count') }}">
                                        @error('bathrooms_count')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Cladding<span class="text-danger">*</span></label>
                                        <div class="form-check">
                                            <input class="form-check-input" id="normal" type="radio" name="cladding" value="normal" @checked(old('cladding')=="normal")>
                                            <label class="form-check-label" for="normal">
                                                Normal
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="good" type="radio" name="cladding" value="good" @checked(old('cladding')=="good")>
                                            <label class="form-check-label" for="suggested">
                                                Good
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="delux" type="radio" name="cladding" value="delux" @checked(old('cladding')=="delux")>
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
                                        <input type="number" class="form-control" name="floor" value="{{ old('floor') }}">
                                        @error('floor')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Furnished<span class="text-danger">*</span></label>
                                        <div class="form-check">
                                            <input class="form-check-input" id="unfurnished" type="radio" name="furnished" value="0" @checked(old('furnished')==0)>
                                            <label class="form-check-label" for="unfurnished">
                                                Unfurnished
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="furnished" type="radio" name="furnished" value="1" @checked(old('furnished')==1)>
                                            <label class="form-check-label" for="furnished">
                                                Furnished
                                            </label>
                                        </div>
                                        @error('furnished')
                                        <div class="text-danger">{{ $message }}</div>
                                         @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Lat</label>
                                        <input type="text" class="form-control" name="lat" value="{{ old('lat') }}">
                                        @error('lat')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Long</label>
                                        <input type="text" class="form-control" name="long" value="{{ old('long') }}">
                                        @error('long')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Elevator<span class="text-danger">*</span></label>
                                        <div class="form-check">
                                            <input class="form-check-input" id="withoutelevator" type="radio" name="elevator" value="0" @checked(old('elevator')==0)>
                                            <label class="form-check-label" for="withoutelevator">
                                                Without Elevator
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="withelevator" type="radio" name="elevator" value="1" @checked(old('elevator')==1)>
                                            <label class="form-check-label" for="withelevator">
                                                With Elevator
                                            </label>
                                        </div>
                                        @error('elevator')
                                        <div class="text-danger">{{ $message }}</div>
                                         @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Status<span class="text-danger">*</span></label>
                                        <div class="form-check">
                                            <input class="form-check-input" id="notsuggested" type="radio" name="status" value="0" @checked(old('status')==0)>
                                            <label class="form-check-label" for="notsuggested">
                                                InActive
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="suggested" type="radio" name="status" value="1" @checked(old('status')==1)>
                                            <label class="form-check-label" for="suggested">
                                                Active
                                            </label>
                                        </div>
                                        @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                         @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Order</label>
                                        <input type="number" class="form-control" name="order" value="{{ old('order') }}">
                                        @error('order')
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
                                        <label class="form-label">Is Smart<span class="text-danger">*</span></label>
                                        <div class="form-check">
                                            <input class="form-check-input" id="no" type="radio" name="is_smart" value="0" @checked(old('is_smart')==0)>
                                            <label class="form-check-label" for="no">
                                                No
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" id="yes" type="radio" name="is_smart" value="1" @checked(old('is_smart')==1)>
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
                                        <input type="url" class="form-control" name="video_url" value="{{ old('video_url') }}">
                                        @error('video_url')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- <div class="col-xl-8 mb-3">
                                        <label class="form-label">Music Url</label>
                                        <input type="url" class="form-control" name="music_url" value="{{ old('music_url') }}">
                                        @error('music_url')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

                                    <div class="col-xl-8 mb-3">
    <label class="form-label">Music</label>
    <input type="file" accept="audio/*" class="form-control" name="music">
    @error('music')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Direction</label>
                                        <input type="text" class="form-control" name="direction" value="{{ old('direction') }}">
                                        @error('direction')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Property</label>
                                        <input type="text" class="form-control" name="Property" value="{{ old('Property') }}">
                                        @error('Property')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Purpose<span class="text-danger">*</span></label>
                                        <div class="form-check">
                                            <input class="form-check-input" id="commercial" type="radio" name="purpose" value="commercial" @checked(old('purpose')=="commercial")>
                                            <label class="form-check-label" for="commercial">
                                                Commercial
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="residential" type="radio" name="purpose" value="residential" @checked(old('purpose')=="residential")>
                                            <label class="form-check-label" for="residential">
                                                Residential
                                            </label>
                                        </div>

                                        @error('purpose')
                                        <div class="text-danger">{{ $message }}</div>
                                         @enderror
                                    </div>

                                    {{-- <div class="col-xl-8 mb-3">
                                        <label class="form-label">Purpose</label>
                                        <input type="text" class="form-control" name="purpose" value="{{ old('purpose') }}">
                                        @error('purpose')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                                        @error('price')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Area<span class="text-danger">*</span></label>
                                        <select class="default-select form-control wide mb-3" name="area_id" tabindex="null">
                                            <option selected disabled>Select Area</option>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}" @selected(old('area_id')==$area->id)>{{ $area->name }}</option>
                                            @endforeach
										</select>
                                        @error('area_id')
                                            <div class="text-danger">{{ $message }}</div>
                                         @enderror
                                    </div>



                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Agent<span class="text-danger">*</span></label>
                                        <select class="default-select form-control wide mb-3" name="user_id" tabindex="null">
                                            <option selected disabled>Select Agent</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" @selected(old('user_id')==$user->id)>{{ $user->name }}</option>
                                            @endforeach
										</select>
                                        @error('user_id')
                                            <div class="text-danger">{{ $message }}</div>
                                         @enderror
                                    </div>

                                    <div class="col-xl-8 mb-3">
                                        <label class="form-label">Subcategory<span class="text-danger">*</span></label>
                                        <select class="default-select form-control wide mb-3" name="subcategory_id" tabindex="null">
                                            <option selected disabled>Select Subcategory</option>
                                            @foreach ($subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}" @selected(old('subcategory_id')==$subcategory->id)>{{ $subcategory->name }}</option>
                                            @endforeach
										</select>
                                        @error('subcategory_id')
                                            <div class="text-danger">{{ $message }}</div>
                                         @enderror
                                    </div>


                                    <div class="col-xl-8 mb-3">
                                        <label for="images" class="form-label">Images<span class="text-danger">*</span></label>
                                        <input class="form-control" type="file" name="images[]" id="image" multiple>
                                        @error('images')
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

        // Add event listeners to theradio buttons to toggle the fields
        rentRadio.addEventListener('change', toggleFields);
        saleRadio.addEventListener('change', toggleFields);

        // Call toggleFields() initially to set the initial state
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
