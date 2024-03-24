<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;
use DB;

class QueryController extends Controller
{
    public function query1() {
        $users = User::select('name','email')->whereHas('purchases',function($q) {
            $q->whereDate('created_at' , '<', now()->subDays(30));
        })->get();
        return $users;
    }

    public function query2() {
        //$pur = Purchase::select('product_id',DB::raw('count(product_id) as count_pro'))->groupBy('product_id')->orderBy('count_pro','desc')->limit(5)->get();
        //return $pur;
        /*$products = Product::select('name')->with('purchases',function($q){
            $q->select('product_id',DB::raw('count(product_id) as count_pro'))->groupBy('product_id')->orderBy('count_pro','desc')->limit(5)->get()->pluck('product_id');
        })->withSum('purchases', 'quantity')->limit(5)->get();
        return $products;*/
        $products = Product::select('name')->withCount('purchases')->withSum('purchases', 'quantity')->withAvg('rates', 'rate')->orderBy('purchases_count','desc')->limit(5)->get();
        return $products;

        $orders = Order::with('items.product.category')->whereHas('items.product.category',function($q){
            $q->where('name','Electronics');
        })->whereDate('created_at' , '<', now()->subDays(30))->orderBy('created_at','desc')->limit(10)->get();
    }
}
