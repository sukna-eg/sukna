<?php

namespace App\Http\Controllers\Api;

use App\Models\Partner;
use App\Models\City;
use App\Models\User;
use App\Models\Area;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Pimage;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\PartnerRequest;
use App\Http\Resources\PartnerResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
// use App\Http\Resources\PriceResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PartnerDistanceResource;
use File;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Traits\NotificationTrait;

class PartnerController extends ApiController
{
    use NotificationTrait;

    public function __construct()
    {
        $this->resource = PartnerResource::class;
        $this->model = app(Partner::class);
        $this->repositry =  new Repository($this->model);
    }

    public function checkPartners()
    {

        $currentDate = Carbon::now()->toDateString();


        $partners = Partner::where('show', 1)->get();

        foreach ($partners as $partner) {

            $notificationDate = Carbon::parse($partner->end_date)->subDays(2)->toDateString();

            $userId = $partner->user_id;
            $user = User::find($userId);

            if ($partner->end_date === $currentDate) {

            // Update the is_show flag of the partner to 0
            $partner->show = 0;
            $partner->save();


            }


            if ($currentDate === $notificationDate) {


                $token = $user->device_token;

                $this->send(' نود أن نذكرك بأن باقتك سوف تنتهي بعد يومين وشكرا',' مرحبًا '.$user->name.'👋🏼',$token);

                    $note= new Notification();
                    $note->title=' مرحبًا '.$user->name.'👋🏼';
                    $note->content = ' نود أن نذكرك بأن باقتك سوف تنتهي بعد يومين وشكرا';
                    $note->user_id = $user->id;
                    $note->route_id = $partner->id;
                    $note->save();
            }
        }

        return $this->returnSuccessMessage('Partners updated successfully');
    }


    public function save( Request $request ){

      $user=User::find($request->user_id);
        if($request->type != 1 && $user->properties_count == 0){

            return $this->returnError('Sorry! your package has expired');
        }

            $partner = $this->repositry->save($request->except('images'));


            if (isset($request->images)) {
                foreach ($request->images as $image) {

                    $im = new Pimage();
                    $im->image = $image;
                    $im->partner_id = $partner->id;

                    $im->save();
                }
            }

            if ($partner->type != 1) {
                $user->properties_count = $user->properties_count - 1;
                $user->save();

                $last_sub=$user->subscriptions?->last();
                $partner->start_date=$user->start_date;
                $partner->end_date = Carbon::parse($user->start_date)->addMonths(3);
                $partner->plan_id=$last_sub->plan_id;
                $partner->save();
            }

            return $this->returnData('data', new PartnerResource($partner), __('Succesfully'));
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }


    public function view($id)
    {
        $model = $this->repositry->getByID($id);

        $views = (int)$model->views + 1;

        $model->update([
            'views' => $views
        ]);

        if ($model) {
            return $this->returnData('data', new $this->resource($model), __('Get  succesfully'));
        }

        return $this->returnError(__('Sorry! Failed to get !'));
    }

    // public function partners(){


    //     $data=Partner::where('show',1)->paginate(10);
    //     return $this->returnData('data',  PartnerResource::collection( $data ), __('Get  succesfully'));

    //    }

//        public function partners()
// {
//     $seed = floor(time() / 300); // 300 seconds = 5 minutes
//     $data = Partner::where('show', 1)
//         ->orderByRaw("RAND($seed)")
//         ->paginate(10);

//     return $this->returnData('data', PartnerResource::collection($data), __('Get successfully'));
// }

public function partners()
{
    $seed = floor(date('G') / 5); // Current hour divided by 5
    $data = Partner::where('show', 1)
        ->orderByRaw("RAND($seed)")
        ->paginate(10);

    return $this->returnData('data', PartnerResource::collection($data), __('Get successfully'));
}

    // public function premiumPartners(){


    //     $data=Partner::where('show',1)->where('premium', 1)->orderBy('order', 'ASC')->get();

    //     return $this->returnData('data',  PartnerResource::collection( $data ), __('Get  succesfully'));

    //    }

    public function premiumPartners()
    {
        $randomOrder = $this->getRandomOrder();

        $data = Partner::where('show', 1)
            ->where('premium', 1)
            ->orderByRaw("FIELD(`id`, " . implode(',', $randomOrder) . ")")
            ->get();

        return $this->returnData('data', PartnerResource::collection($data), __('Get successfully'));
    }

    private function getRandomOrder()
    {
        $cacheKey = 'random_order';

        if (!Cache::has($cacheKey)) {
            $partners = Partner::where('show', 1)
                ->where('premium', 1)
                ->pluck('id')
                ->toArray();

            shuffle($partners);
            Cache::put($cacheKey, $partners, now()->addHours(2));
        }

        return Cache::get($cacheKey);
    }



       public function bedrooms()
       {
           $bed = Partner::where('show', 1)->distinct()->orderBy('bedrooms_count', 'asc')->pluck('bedrooms_count');
           return $this->returnData('data', $bed, __('Get successfully'));
       }

       public function bathrooms()
       {
           $bath = Partner::where('show', 1)->distinct()->orderBy('bathrooms_count', 'asc')->pluck('bathrooms_count');
           return $this->returnData('data', $bath, __('Get successfully'));
       }

       public function prices()
       {
           $prices = Partner::where('show', 1)->distinct()->orderBy('price', 'asc')->pluck('price');
           return $this->returnData('data', $prices, __('Get successfully'));
       }


       public function spaces()
       {
           $prices = Partner::where('show', 1)->distinct()->orderBy('space', 'asc')->pluck('space');
           return $this->returnData('data', $prices, __('Get successfully'));
       }

       public function floors()
       {
           $floors = Partner::where('show', 1)->distinct()->orderBy('floor', 'asc')->pluck('floor');
           return $this->returnData('data', $floors, __('Get successfully'));
       }

       public function getPartnersOfSubOrCategortInArea(Request $request)
       {
           $resources = [];
           $partners = Partner::where('show', 1)->get();

           if ($request->is_category == 0) {
               $subcategoryId = $request->id;
               $partners = $partners->filter(function ($partner) use ($subcategoryId) {
                   return $partner->subcategory->id == $subcategoryId;
               });
           } else {
               $categoryId = $request->id;
               $partners = $partners->filter(function ($partner) use ($categoryId) {
                   return $partner->subcategory->category_id == $categoryId;
               });
           }

           if (isset($request->cities)) {
               $cityIds = $request->cities;
               $partners = $partners->filter(function ($partner) use ($cityIds) {
                   return $partner->area->city_id && in_array($partner->area->city_id, $cityIds);
               });
           }

           if (isset($request->areas)) {
               $areaIds = $request->areas;
               $partners = $partners->filter(function ($partner) use ($areaIds) {
                   return in_array($partner->area_id, $areaIds);
               });
           }

           if (!is_null($request->space_min) && !is_null($request->space_max)) {
            $spaceMin = $request->space_min;
            $spaceMax = $request->space_max;

            $partners = $partners->filter(function ($partner) use ($spaceMin, $spaceMax) {
                return is_null($partner->space) || ($partner->space >= $spaceMin && $partner->space <= $spaceMax);
            });
        }

           if (!is_null($request->price_min) && !is_null($request->price_max)) {
               $partners = $partners->filter(function ($partner) use ($request) {
                   return is_null($partner->price) || ($partner->price >= $request->price_min && $partner->price <= $request->price_max);
               });
           }

           if (!is_null($request->type)) {
               $partners = $partners->filter(function ($partner) use ($request) {
                   return is_null($partner->type) || $partner->type == $request->type;
               });
           }

           if (!is_null($request->elevator)) {
               $partners = $partners->filter(function ($partner) use ($request) {
                   return is_null($partner->elevator) || $partner->elevator == $request->elevator;
               });
           }

           if (!is_null($request->furnished)) {
               $partners = $partners->filter(function ($partner) use ($request) {
                   return is_null($partner->furnished) || $partner->furnished == $request->furnished;
               });
           }

           if (!is_null($request->is_smart)) {
            $partners = $partners->filter(function ($partner) use ($request) {
                return is_null($partner->is_smart) || $partner->is_smart == $request->is_smart;
            });
        }

        if (!is_null($request->premium)) {
            $partners = $partners->filter(function ($partner) use ($request) {
                return is_null($partner->premium) || $partner->premium == $request->premium;
            });
        }

        if (!is_null($request->floor)) {
            $partners = $partners->filter(function ($partner) use ($request) {
                return is_null($partner->floor) || $partner->floor == $request->floor;
            });
        }

         if (!is_null($request->bedrooms)) {
            $partners = $partners->filter(function ($partner) use ($request) {
                return is_null($partner->bedrooms_count) || $partner->bedrooms_count == $request->bedrooms;
            });
        }

        if (!is_null($request->bathrooms)) {
            $partners = $partners->filter(function ($partner) use ($request) {
                return is_null($partner->bathrooms_count) || $partner->bathrooms_count == $request->bathrooms;
            });
        }

         if (!is_null($request->cladding)) {
            $partners = $partners->filter(function ($partner) use ($request) {
                return is_null($partner->cladding) || $partner->cladding == $request->cladding;
            });
        }

           foreach ($partners as $partner) {
               $matchingAreaIds = $partner->area_id;
               if (isset($request->areas)) {
                   $areaIds = $request->areas;
                   if (!in_array($matchingAreaIds, $areaIds)) {
                       continue;
                   }
               }

               $resource = new PartnerResource($partner);
               $resources[$partner->id] = $resource;
           }

           $resources = array_values($resources);

//            $perPage = $request->input('per_page', 10);

//            $currentPage = $request->input('page', 1);
// $offset = ($currentPage - 1) * $perPage;
// $paginatedPartners = new LengthAwarePaginator(
//     $partners->slice($offset, $perPage),
//     $partners->count(),
//     $perPage,
//     $currentPage,
//     ['path' => $request->url(), 'query' => $request->query()]
// );

// $resources = [];

// foreach ($paginatedPartners as $partner) {
//     // Your logic for each partner
//     $resource = new PartnerResource($partner);
//     $resources[] = $resource;
// }

           return $this->returnData('data', $resources, __('Get partners successfully'));
       }

       public function sortAndFilter(Request $request)
       {
           $resources = [];
           $partners = Partner::where('show', 1)->get();

           if ($request->is_category == 0) {
               $subcategoryId = $request->id;
               $partners = $partners->filter(function ($partner) use ($subcategoryId) {
                   return $partner->subcategory->id == $subcategoryId;
               });
           } else {
               $categoryId = $request->id;
               $partners = $partners->filter(function ($partner) use ($categoryId) {
                   return $partner->subcategory->category_id == $categoryId;
               });
           }

           if (isset($request->cities)) {
               $cityIds = $request->cities;
               $partners = $partners->filter(function ($partner) use ($cityIds) {
                   return $partner->area->city_id && in_array($partner->area->city_id, $cityIds);
               });
           }

           if (isset($request->areas)) {
               $areaIds = $request->areas;
               $partners = $partners->filter(function ($partner) use ($areaIds) {
                   return in_array($partner->area_id, $areaIds);
               });
           }

           if (!is_null($request->space_min) && !is_null($request->space_max)) {
            $spaceMin = $request->space_min;
            $spaceMax = $request->space_max;

            $partners = $partners->filter(function ($partner) use ($spaceMin, $spaceMax) {
                return is_null($partner->space) || ($partner->space >= $spaceMin && $partner->space <= $spaceMax);
            });
        }

           if (!is_null($request->price_min) && !is_null($request->price_max)) {
               $partners = $partners->filter(function ($partner) use ($request) {
                   return is_null($partner->price) || ($partner->price >= $request->price_min && $partner->price <= $request->price_max);
               });
           }

           if (!is_null($request->type)) {
               $partners = $partners->filter(function ($partner) use ($request) {
                   return is_null($partner->type) || $partner->type == $request->type;
               });
           }

           if (!is_null($request->elevator)) {
               $partners = $partners->filter(function ($partner) use ($request) {
                   return is_null($partner->elevator) || $partner->elevator == $request->elevator;
               });
           }

           if (!is_null($request->furnished)) {
               $partners = $partners->filter(function ($partner) use ($request) {
                   return is_null($partner->furnished) || $partner->furnished == $request->furnished;
               });
           }

           if (!is_null($request->is_smart)) {
            $partners = $partners->filter(function ($partner) use ($request) {
                return is_null($partner->is_smart) || $partner->is_smart == $request->is_smart;
            });
        }

        if (!is_null($request->premium)) {
            $partners = $partners->filter(function ($partner) use ($request) {
                return is_null($partner->premium) || $partner->premium == $request->premium;
            });
        }

        if (!is_null($request->floor)) {
            $partners = $partners->filter(function ($partner) use ($request) {
                return is_null($partner->floor) || $partner->floor == $request->floor;
            });
        }

        if (!is_null($request->bedrooms)) {
            $partners = $partners->filter(function ($partner) use ($request) {
                return is_null($partner->bedrooms_count) || $partner->bedrooms_count == $request->bedrooms;
            });
        }

        if (!is_null($request->bathrooms)) {
            $partners = $partners->filter(function ($partner) use ($request) {
                return is_null($partner->bathrooms_count) || $partner->bathrooms_count == $request->bathrooms;
            });
        }

         if (!is_null($request->cladding)) {
            $partners = $partners->filter(function ($partner) use ($request) {
                return is_null($partner->cladding) || $partner->cladding == $request->cladding;
            });
        }

           if (!is_null($request->the_oldest)) {

            $partners = $partners->sortBy('id');

           }

           if (!is_null($request->the_newest)) {

            $partners = $partners->sortByDesc('id');

           }

           if (!is_null($request->the_cheapest)) {

            $partners = $partners->sortBy('price');

           }

           if (!is_null($request->the_expensive)) {

            $partners = $partners->sortByDesc('price');

           }



           foreach ($partners as $partner) {
               $matchingAreaIds = $partner->area_id;
               if (isset($request->areas)) {
                   $areaIds = $request->areas;
                   if (!in_array($matchingAreaIds, $areaIds)) {
                       continue;
                   }
               }

               $resource = new PartnerResource($partner);
               $resources[$partner->id] = $resource;
           }

           $resources = array_values($resources);

//            $perPage = $request->input('per_page', 10);

//            $currentPage = $request->input('page', 1);
// $offset = ($currentPage - 1) * $perPage;
// $paginatedPartners = new LengthAwarePaginator(
//     $partners->slice($offset, $perPage),
//     $partners->count(),
//     $perPage,
//     $currentPage,
//     ['path' => $request->url(), 'query' => $request->query()]
// );

// $resources = [];

// foreach ($paginatedPartners as $partner) {
//     // Your logic for each partner
//     $resource = new PartnerResource($partner);
//     $resources[] = $resource;
// }

           return $this->returnData('data', $resources, __('Get partners successfully'));
       }

       public function sortPartnersInCatOrSub(Request $request)
       {
           $id = $request->id;

           if ($request->is_category == 0) {
               $sub = Subcategory::find($id);
               $partners = $sub->partners;
           } elseif ($request->is_category == 1) {
               $category = Category::find($id);
               $partners = Partner::whereHas('subcategory.category', function ($query) use ($id) {
                   $query->where('id', $id);
               })->get();
           } else {
               return $this->returnError(__('Invalid request'));
           }

           if (!is_null($request->the_oldest)) {

            $partners = $partners->sortBy('id');

           }

           if (!is_null($request->the_newest)) {

            $partners = $partners->sortByDesc('id');

           }

           if (!is_null($request->the_cheapest)) {

            $partners = $partners->sortBy('price');

           }

           if (!is_null($request->the_expensive)) {

            $partners = $partners->sortByDesc('price');

           }

        //    $perPage = 10;
        //    $currentPage = $request->input('page', 1);
        //    $offset = ($currentPage - 1) * $perPage;
        //    $paginatedPartners = new LengthAwarePaginator(
        //        $partners->slice($offset, $perPage),
        //        $partners->count(),
        //        $perPage,
        //        $currentPage,
        //        ['path' => $request->url(), 'query' => $request->query()]
        //    );

        //    return $this->returnData('data', PartnerResource::collection($paginatedPartners), __('Get successfully'));

        return $this->returnData('data', PartnerResource::collection($partners), __('Get successfully'));

       }


       public function getMinAndMaxOfPrice(Request $request)
{
    $partners = Partner::where('show', 1)->get();

    $min = $partners->min('price');
    $max = $partners->max('price');

    return $this->returnData('data', ['min' => $min, 'max' => $max], 'Get min and max of partners successfully');
}

public function getMinAndMaxOfSpace(Request $request)
{
    $partners = Partner::where('show', 1)->get();

    $min = $partners->min('space');
    $max = $partners->max('space');

    return $this->returnData('data', ['min' => $min, 'max' => $max], 'Get min and max of partners successfully');
}

public function myPartners()
{
    $partners = Auth::user()->partners()->orderBy('id', 'desc')->paginate(10);
    return $this->returnData('data', PartnerResource::collection($partners), __('Get successfully'));
}


function distance($lat1, $lon1, $lat2, $lon2)
{
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;

    return $miles * 1.609344;
}





public function nearest(Request $request)
{


$partners = Partner::where('show',1)->get();

$resources = [];

foreach ($partners as $partner) {
    // if ($branch->partner->status == 1) {
    $distance = $this->distance($request->lat_user, $request->long_user, $partner->lat, $partner->long);

    if ($distance <= 1) { // Check if the distance is within 5 kilometers
        $resource = new PartnerDistanceResource($partner, $distance);

        $resources[] = $resource;
    }
// }
}

// Sort the resources by their distance from the user's location
usort($resources, function($a, $b) {
    return $a->distance <=> $b->distance;
});

return $this->returnData('data', $resources, __('Get nearby branches successfully'));
}

//get partners in category or sub and with filter and sort or without
public function allPartners(Request $request)
{

    //get partners from cat or sub without filter... and sort maybe yes or no
    if ($request->is_filter == 0)
    {

        //sortPartnersInCatOrSub Api
        if ($request->is_sort == 1)
        {

             $id = $request->id;

           if ($request->is_category == 0) {
               $sub = Subcategory::find($id);
               $partners = $sub->partners;
           } elseif ($request->is_category == 1) {
               $category = Category::find($id);
               $partners = Partner::whereHas('subcategory.category', function ($query) use ($id) {
                   $query->where('id', $id);
               })->get();
           } else {
               return $this->returnError(__('Invalid request'));
           }

           if (!is_null($request->the_oldest)) {

            $partners = $partners->sortBy('id');

           }

           if (!is_null($request->the_newest)) {

            $partners = $partners->sortByDesc('id');

           }

           if (!is_null($request->the_cheapest)) {

            $partners = $partners->sortBy('price');

           }

           if (!is_null($request->the_expensive)) {

            $partners = $partners->sortByDesc('price');

           }

           $perPage = 10;
           $currentPage = $request->input('page', 1);
           $offset = ($currentPage - 1) * $perPage;
           $paginatedPartners = new LengthAwarePaginator(
               $partners->slice($offset, $perPage),
               $partners->count(),
               $perPage,
               $currentPage,
               ['path' => $request->url(), 'query' => $request->query()]
           );

           return $this->returnData('data', PartnerResource::collection($paginatedPartners), __('Get successfully'));


        }

        //get partners from cat or sub
        if ($request->is_sort == 0)
        {

            if ($request->is_category == 0)
            {
                $sub = Subcategory::find($request->id);
                $id=$request->id;

                $partners = Partner::where('show', 1)->whereHas('subcategory', function ($query) use ($id) {
                    $query->where('id', $id);
                })->orderBy('id', 'asc')->paginate(10);

                return $this->returnData('data', PartnerResource::collection($partners), __('Get successfully'));

            }

            if ($request->is_category == 1)
            {



                $category = Category::find($request->id);
                $id=$request->id;

    $partners = Partner::where('show', 1)->whereHas('subcategory.category', function ($query) use ($id) {
        $query->where('id', $id);
    })->orderBy('id', 'asc')->paginate(10);

    return $this->returnData('data', PartnerResource::collection($partners), __('Get successfully'));

            }


        }

    }

    //filter partners from cat or sub with sort or without
    //sort and filter api
    if ($request->is_filter == 1)
    {

        $resources = [];
        $partners = Partner::where('show', 1)->get();

        if ($request->is_category == 0) {
            $subcategoryId = $request->id;
            $partners = $partners->filter(function ($partner) use ($subcategoryId) {
                return $partner->subcategory->id == $subcategoryId;
            });
        } else {
            $categoryId = $request->id;
            $partners = $partners->filter(function ($partner) use ($categoryId) {
                return $partner->subcategory->category_id == $categoryId;
            });
        }

        if (isset($request->cities)) {
            $cityIds = $request->cities;
            $partners = $partners->filter(function ($partner) use ($cityIds) {
                return $partner->area->city_id && in_array($partner->area->city_id, $cityIds);
            });
        }

        if (isset($request->areas)) {
            $areaIds = $request->areas;
            $partners = $partners->filter(function ($partner) use ($areaIds) {
                return in_array($partner->area_id, $areaIds);
            });
        }

        if (!is_null($request->space_min) && !is_null($request->space_max)) {
         $spaceMin = $request->space_min;
         $spaceMax = $request->space_max;

         $partners = $partners->filter(function ($partner) use ($spaceMin, $spaceMax) {
             return is_null($partner->space) || ($partner->space >= $spaceMin && $partner->space <= $spaceMax);
         });
     }

        if (!is_null($request->price_min) && !is_null($request->price_max)) {
            $partners = $partners->filter(function ($partner) use ($request) {
                return is_null($partner->price) || ($partner->price >= $request->price_min && $partner->price <= $request->price_max);
            });
        }

        if (!is_null($request->type)) {
            $partners = $partners->filter(function ($partner) use ($request) {
                return is_null($partner->type) || $partner->type == $request->type;
            });
        }

        if (!is_null($request->elevator)) {
            $partners = $partners->filter(function ($partner) use ($request) {
                return is_null($partner->elevator) || $partner->elevator == $request->elevator;
            });
        }

        if (!is_null($request->furnished)) {
            $partners = $partners->filter(function ($partner) use ($request) {
                return is_null($partner->furnished) || $partner->furnished == $request->furnished;
            });
        }

        if (!is_null($request->is_smart)) {
         $partners = $partners->filter(function ($partner) use ($request) {
             return is_null($partner->is_smart) || $partner->is_smart == $request->is_smart;
         });
     }

     if (!is_null($request->premium)) {
         $partners = $partners->filter(function ($partner) use ($request) {
             return is_null($partner->premium) || $partner->premium == $request->premium;
         });
     }

     if (!is_null($request->floor)) {
         $partners = $partners->filter(function ($partner) use ($request) {
             return is_null($partner->floor) || $partner->floor == $request->floor;
         });
     }

     if (!is_null($request->bedrooms)) {
         $partners = $partners->filter(function ($partner) use ($request) {
             return is_null($partner->bedrooms_count) || $partner->bedrooms_count == $request->bedrooms;
         });
     }

     if (!is_null($request->bathrooms)) {
         $partners = $partners->filter(function ($partner) use ($request) {
             return is_null($partner->bathrooms_count) || $partner->bathrooms_count == $request->bathrooms;
         });
     }

      if (!is_null($request->cladding)) {
         $partners = $partners->filter(function ($partner) use ($request) {
             return is_null($partner->cladding) || $partner->cladding == $request->cladding;
         });
     }

        if (!is_null($request->the_oldest)) {

         $partners = $partners->sortBy('id');

        }

        if (!is_null($request->the_newest)) {

         $partners = $partners->sortByDesc('id');

        }

        if (!is_null($request->the_cheapest)) {

         $partners = $partners->sortBy('price');

        }

        if (!is_null($request->the_expensive)) {

         $partners = $partners->sortByDesc('price');

        }



        foreach ($partners as $partner) {
            $matchingAreaIds = $partner->area_id;
            if (isset($request->areas)) {
                $areaIds = $request->areas;
                if (!in_array($matchingAreaIds, $areaIds)) {
                    continue;
                }
            }

            $resource = new PartnerResource($partner);
            $resources[$partner->id] = $resource;
        }

        $resources = array_values($resources);

           $perPage = $request->input('per_page', 10);

           $currentPage = $request->input('page', 1);
$offset = ($currentPage - 1) * $perPage;
$paginatedPartners = new LengthAwarePaginator(
    $partners->slice($offset, $perPage),
    $partners->count(),
    $perPage,
    $currentPage,
    ['path' => $request->url(), 'query' => $request->query()]
);

$resources = [];

foreach ($paginatedPartners as $partner) {
    // Your logic for each partner
    $resource = new PartnerResource($partner);
    $resources[] = $resource;
}

        return $this->returnData('data', $resources, __('Get partners successfully'));

    }

}

public function delete($id)
{
    $model = $this->repositry->getByID($id);

    if (!$model) {
        return $this->returnError(__('Sorry! Failed to get !'));
    }

        if ($model->images){
            foreach ($model->images as $image) {

                if (File::exists(public_path($image->image))) {
                File::delete(public_path($image->image));
                }

            }


        }
           $this->repositry->deleteByID($id);

    return $this->returnSuccessMessage(__('Delete succesfully!++'));
}


}
