<?php

namespace App\Http\Controllers\API\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mockery\Exception;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            try{
                $orders = Order::with('orders', 'customer', 'fleet')->paginate(20);
                return response()
                    ->json([
                        'success'   =>true,
                        'message'   =>'You have successfully retrieved list of orders',
                        'data'      =>$orders
                    ], 200);
            } catch (Exception $exception) {
                return response()
                    ->json(['message'=>$exception->getMessage()], $exception->getCode());
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $validator=Validator::make($request->all(),[
                'order_number'   => 'required',
                'customer_id'   => 'required',
                'description'   => 'required',
            ]);
            if ($validator->fails()) {
                return response()
                    ->json([
                        'success' => false,
                        'message' =>$validator->errors()->first()
                    ]);
            }
            $order=Order::create([
                'order_number'   =>$request->input('order_number'),
                'customer_id'  =>$request->input('customer_id'),
                'description'  =>$request->input('description'),
                'status'  => 'Pending'
            ]);
            return response()
                ->json([
                    'success'   =>true,
                    'message'   =>'You have successfully added a new order',
                    'data'      =>$order
                ], 200);
        } catch (Exception $exception) {
            return response()
                ->json(['message'=>$exception->getMessage()], $exception->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $order = Order::where('id',$id)
                ->first();
            return response()
                ->json([
                    'success'   =>true,
                    'message'   =>'You have successfully retrieved order details',
                    'data'      =>$order
                ], 200);
        } catch (Exception $exception) {
            return response()
                ->json(['message'=>$exception->getMessage()], $exception->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            Order::where('id',$id)
                 ->update(array_filter($request->except('updated_at','created_at')));
             return response()
                 ->json([
                     'success'   =>true,
                     'message'   =>'You have successfully updated the order',
                 ], 200);
         } catch (Exception $exception) {
             return response()
                 ->json(['message'=>$exception->getMessage()], $exception->getCode());
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Order::where('id',$id)
                ->delete();
            return response()
                ->json([
                    'success'   =>true,
                    'message'   =>'You have successfully removed an order',
                ], 200);
        } catch (Exception $exception) {
            return response()
                ->json(['message'=>$exception->getMessage()], $exception->getCode());
        }
    }
}
