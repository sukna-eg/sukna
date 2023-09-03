<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Offer;
use App\Models\Service;
use App\Models\Voucher;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EnterpriseCopone;
use App\Models\EnterpriseSubscription;
use App\Models\PromoCode;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index($period = null)
    {

        return view('admin.index');
    }

    public function getProfits($service)
    {
        $offers = Offer::latest()->whereBelongsTo($service)->get()->load('vouchers');
        // Get the total discount value of all vouchers for those offers
        $vouchers = Voucher::with('offer')
            ->whereIn('offer_id', $offers->pluck('id')) // Filter by offer ids
            ->get();
        $total = 0;
        foreach ($vouchers as $voucher) {
            $total += $voucher->offer->discount_value;
        }
        return $total * ($service->profit_margin / 100);
    }

    public function getEarningChart()
    {
        $earnings = [];
        foreach (range(1,12) as $month) {
            $earnings[] = $this->getRevenueMonth($month);
        }
        $chartjs = app()->chartjs
            ->name('lineChartTest')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels([
                'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                'September', 'October', 'November', 'December'
            ])
            ->datasets([
                [
                    "label" => "Total Earning (QR)",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $earnings,
                ],
            ])
            ->options([]);
        return $chartjs;
    }

    public function getRevenueMonth($month){
        $services = Service::whereStatus(1)->get();
        foreach ($services as $service) {
            $offers = Offer::latest()->whereBelongsTo($service)->get()->load('vouchers');
            // Get the total discount value of all vouchers for those offers
            $vouchers = Voucher::with('offer')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', $month)
                ->whereIn('offer_id', $offers->pluck('id')) // Filter by offer ids
                ->get();
            $total = 0;
            foreach ($vouchers as $voucher) {
                $total += $voucher->offer->discount_value;
            }
            return ($total * ($service->profit_margin / 100))+Subscription::whereMonth('created_at', $month)->sum('value');

        }
    }
}
