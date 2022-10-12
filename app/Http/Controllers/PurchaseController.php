<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Purchase;


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('purchase.index',[
            'purchases' => Purchase::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchase.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $purchase = Purchase::create([
            'total'     => $request->total
        ]);

        for ($i=0; $i < count($request->productName) ; $i++) {
            PurchaseRow::create([
                'purchase_id'       => $purchase->id,
                'product_id'        => $request->product_id[i],
                'product_price'     => $request->product_price[i],
                'product_quantity'  => $request->productQuantity[i],
                'total'             => $requestproductTotalPrice[i]
            ]);
        }

        return redirect()->route('purchase.index')->with('message','Purchase has been edited successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('purchase.show',[
            'purchase'      => Purchase::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('purchase.edit',[
            'purchase'      => Purchase::findOrFail($id)
        ]);
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
        dd($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Purchase::findOrFail($id)->delete();
    }
}
