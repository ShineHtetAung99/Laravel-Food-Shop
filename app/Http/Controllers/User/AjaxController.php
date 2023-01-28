<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    // return pizza list
    public function pizzaList(Request $request){
        if($request->status == 'desc'){
            $pizza = Product::OrderBy('created_at','desc')->get();
        }else{
            $pizza = Product::OrderBy('created_at','asc')->get();
        }
        return response()->json($pizza, 200);
    }

    // return pizza list
    public function addToCart(Request $request){
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response = [
            'message' => 'Add To Cart Complete',
            'status' => 'success'
        ];

        return response()->json($response, 200);
    }

    // order
    public function order(Request $request){
        $total = 0;
        foreach ($request->all() as $item) {
            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code'],
            ]);

            $total += $data->total;
        }

        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total+3000
        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'order completed'
        ],200);
    }

    // clear current product
    public function clearCurrentProduct(Request $request){
        Cart::where('user_id',Auth::user()->id)
                ->where('product_id',$request->productId)
                ->where('id',$request->orderId)
                ->delete();
    }

    // clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    // increase view count
    public function increaseViewCount(Request $request){
        $pizza = Product::where('id',$request->productId)->first();
        $viewCount = [ 'view_count' => $pizza->view_count + 1];
        Product::where('id',$request->productId)->update($viewCount);
    }

    // get order data
    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'quantity' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
