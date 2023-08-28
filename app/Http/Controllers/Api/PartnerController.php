<?php

namespace App\Http\Controllers\Api;

use App\Models\Partner;
use App\Models\City;
use App\Models\Area;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\PartnerRequest;
use App\Http\Resources\PartnerResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
// use App\Http\Resources\PriceResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class PartnerController extends ApiController
{
    public function __construct()
    {
        $this->resource = PartnerResource::class;
        $this->model = app(Partner::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
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

    public function partners(){


        $data=Partner::where('show',1)->paginate(10);
        return $this->returnData('data',  PartnerResource::collection( $data ), __('Get  succesfully'));

       }

    public function premiumPartners(){


        $data=Partner::where('show',1)->where('premium', 1)->orderBy('order', 'ASC')->get();
        return $this->returnData('data',  PartnerResource::collection( $data ), __('Get  succesfully'));

       }

       public function bedrooms()
       {
           $bed = Partner::where('show', 1)->distinct()->pluck('bedrooms_count');
           return $this->returnData('data', $bed, __('Get successfully'));
       }

       public function bathrooms()
       {
           $bath = Partner::where('show', 1)->distinct()->pluck('bathrooms_count');
           return $this->returnData('data', $bath, __('Get successfully'));
       }

       public function prices()
       {
           $prices = Partner::where('show', 1)->distinct()->pluck('price');
           return $this->returnData('data', $prices, __('Get successfully'));
       }


       public function spaces()
       {
           $prices = Partner::where('show', 1)->distinct()->pluck('space');
           return $this->returnData('data', $prices, __('Get successfully'));
       }

       public function floors()
       {
           $floors = Partner::where('show', 1)->distinct()->pluck('floor');
           return $this->returnData('data', $floors, __('Get successfully'));
       }

       public function getPartnersOfSubOrCategortInArea(Request $request)
       {
           $resources = [];
           $partners = Partner::where('show', 1)->get();

           if ($request->is_category == 0) {
               $subcategoryId = $request->subcategory_id;
               $partners = $partners->filter(function ($partner) use ($subcategoryId) {
                   return $partner->subcategory->id == $subcategoryId;
               });
           } else {
               $categoryId = $request->category_id;
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

       public function sortAndFilter(Request $request)
       {
           $resources = [];
           $partners = Partner::where('show', 1)->get();

           if ($request->is_category == 0) {
               $subcategoryId = $request->subcategory_id;
               $partners = $partners->filter(function ($partner) use ($subcategoryId) {
                   return $partner->subcategory->id == $subcategoryId;
               });
           } else {
               $categoryId = $request->category_id;
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

}
