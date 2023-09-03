<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\ApiController;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\TrendingResource;
use App\Http\Resources\PartnerResource;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryController extends ApiController
{
    public function __construct()
    {
        $this->resource = CategoryResource::class;
        $this->model = app(Category::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

    // public function getPartnersByCategory($id)
    // {

    //     $category = Category::find($id);

    //     $partners = array(); // the best way right now for each cuze our time i will do it
    //     foreach (Partner::all() as $partner) {
    //         if ( $partner?->subcategory?->category?->id == $id ) {
    //             // dd($service?->subcategory?->parent?->name);
    //             array_push($partners, $partner);
    //         }
    //     }


    //     $perPage = 10;
    //     $currentPage = request()->input('page', 1);
    //     $offset = ($currentPage - 1) * $perPage;
    //     $paginatedPartners = new LengthAwarePaginator(
    //         $partners->slice($offset, $perPage),
    //         $partners->count(),
    //         $perPage,
    //         $currentPage,
    //         ['path' => request()->url(), 'query' => request()->query()]
    //     );

    //     return $this->returnData('data', PartnerResource::collection($paginatedPartners), __('Get  succesfully'));



    // }

    public function getPartnersByCategory($id)
{
    $category = Category::find($id);

    $partners = Partner::where('show', 1)->whereHas('subcategory.category', function ($query) use ($id) {
        $query->where('id', $id);
    })->paginate(10);

    return $this->returnData('data', PartnerResource::collection($partners), __('Get successfully'));
}

    public function getTrendingServices()
    {
        // Retrieve all categories with their trending services
        $categories = Category::with(['services' => function ($query) {
            // Filter services to include only trending ones
            $query->where('premium', 1);
        }])->paginate(10);


        return $this->returnData('data', TrendingResource::collection($categories), __('Get  succesfully'));


    }

}
