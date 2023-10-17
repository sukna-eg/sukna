<?php

namespace App\Http\Controllers\Api;

use App\Models\Subscription;
use App\Models\EnterpriseCopone;
use App\Models\User;
use App\Models\Plan;
use App\Models\PromoCode;
use App\Models\UserCode;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Http\Resources\MySubscriptionResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Auth;

class SubscriptionController extends ApiController
{
    public function __construct()
    {
        $this->resource = SubscriptionResource::class;
        $this->model = app(Subscription::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){

        //يوجد كوبون خصم
        if ($request->copon == 1) {

            $today = today()->format('Y-m-d');
            $code=PromoCode::where('code',$request->code)->first();
            if($code){
                if($today <= $code->end_date && $today >= $code->start_date && $code->status == 1)
                {

                    $user_code=UserCode::where('promo_code_id',$code->id)->count();
                    if($user_code < $code->num_of_users)
                    {
                        if($code->type == "fixed"){


                            $plan=Plan::find($request->plan_id);
                            $price= $plan->price - $code->value;

                            $sub=new Subscription();
                            $sub->start_date = $request->start_date;
                            $sub->end_date = $request->end_date;
                            $sub->user_id = $request->user_id;
                            $sub->plan_id = $request->plan_id;
                            $sub->value = $price ;
                            $sub->subable_type =get_class(app(PromoCode::class));
                            $sub->subable_id= $code->id;
                            $sub->save();

                            $us_code=new UserCode();
                            $us_code->promo_code_id = $code->id;
                            $us_code->subscription_id = $sub->id;
                            $us_code->save();




                            // return $this->returnSuccessMessage($price);
                            return $this->returnData( 'data' , new $this->resource( $sub ), __('Succesfully'));


                        }

                        if($code->type == "percentage"){



                            $plan=Plan::find($request->plan_id);
                            // $price= $plan->price - $code->value;

                            $discount = $plan->price * ($code->value / 100);
                            $price = $plan->price - $discount;

                            $sub=new Subscription();
                            $sub->start_date = $request->start_date;
                            $sub->end_date = $request->end_date;
                            $sub->user_id = $request->user_id;
                            $sub->plan_id = $request->plan_id;
                            $sub->value = $price ;
                            $sub->subable_type =get_class(app(PromoCode::class));
                            $sub->subable_id= $code->id;
                            $sub->save();

                            $us_code=new UserCode();
                            $us_code->promo_code_id = $code->id;
                            $us_code->subscription_id = $sub->id;
                            $us_code->save();


                            // return $this->returnSuccessMessage($price);
                            return $this->returnData( 'data' , new $this->resource( $sub ), __('Succesfully'));

                        }

                    }

                    $code->update([
                        'status' => 0,
                    ]);
            return $this->returnError('Soory ! The number of times this coupon has been used has expired!');
                }

                $code->update([
                    'status' => 0,
                ]);
            return $this->returnError('Soory ! Coupon date has expired or not start yet!');

            }
       return $this->returnError('Soory ! code not correct!');
        }

         //بدون كوبون
        if ($request->copon == 0 && $request->code == 0){


            $plan=Plan::find($request->plan_id);


                           $sub=new Subscription();
                            $sub->start_date = $request->start_date;
                            $sub->end_date = $request->end_date;
                            $sub->user_id = $request->user_id;
                            $sub->plan_id = $request->plan_id;
                            $sub->value = $plan->price ;
                            $sub->subable_type =get_class(app(PromoCode::class));
                            $sub->subable_id= 0;
                            $sub->save();

                            // return $this->returnSuccessMessage('success');
                            return $this->returnData( 'data' , new $this->resource( $sub ), __('Succesfully'));
        }
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

    public function mySubscription($user_id){


       // $user_id = Auth::user()->id;
        // $user=User::find($user_id)->first();
        $subscriptions = Subscription::where('user_id',$user_id)->paginate(10) ;
        return $this->returnData('data',  MySubscriptionResource::collection( $subscriptions ), __('Get  succesfully'));

    }


    public function viewSubs($order_number)
    {
        $model = Subscription::where('order_number',$order_number)->first();

        if ($model) {
            return $this->returnData('data', new $this->resource( $model ), __('Get  succesfully'));
        }

        return $this->returnError(__('Sorry! Failed to get !'));
    }


    public function getFreeSub(Request $request){

    $today = today()->format('Y-m-d');
    $copon= EnterpriseCopone::where('code',$request->code)->first();

    if($copon){

    if($copon->user_id == null)
    {

        if($today <= $copon->enterpriseSubscription?->end_date && $today >= $copon->enterpriseSubscription?->start_date)
        {

        $copon->update([
            'user_id' => Auth::user()->id,
        ]);

        $sub=new Subscription();
        $sub->start_date = $copon->enterpriseSubscription->start_date;
        $sub->end_date = $copon->enterpriseSubscription->end_date;
        $sub->user_id = Auth::user()->id;
        $sub->plan_id = 4 ;
        $sub->value = 0 ;
        $sub->subable_type =get_class(app(EnterpriseCopone::class));
        $sub->subable_id= $copon->id;
        $sub->save();

        // return $this->returnSuccessMessage('success');
        return $this->returnData( 'data' , new $this->resource( $sub ), __('Succesfully'));
    }
    return $this->returnError('Soory ! Coupon date has expired!');

    }

    return $this->returnError('Soory ! this code is used!');
    }
    return $this->returnError('Soory ! code not correct!');
}


}
