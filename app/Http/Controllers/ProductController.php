<?php

namespace App\Http\Controllers;

use App\Models\{Brand,Category,Image,Product};
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $products= Product::where([
        //     ['productName', '!=', NULL],
        //     [function ($query) use ($request){
        //         if(($term = $request-> term)){
        //             $query->orWhere('productName','LIKE', '%'. $term . '%')->get();
        //         }
        //     }]

        // ])-> orderBy('id', 'asc')
        //    -> paginate(12);

        $products = Product::orderBy('productName', 'asc')->paginate(12);

        //$products = Product::latest()->paginate(5);

       // return view('products.index',compact('products'))
          //  ->with('i', (request()->input('page', 1) - 1) * 5);

        //$products=Product::all();
        $brands=Brand::all();
        $categories=Category::all();

        return view('products.index', [
            'products'  =>$products,
            'brands'    =>$brands,
            'categories' =>$categories
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('products.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //
        $request->validate([
            'productName'   => 'required',
            'modelNumber'   => 'required',
            'category'      => 'required',
            'brand'         => 'required',
            /*'cost'          => 'required',*/
            /*'whole'         => 'required',*/
            /*'retail'        => 'required',*/
            'online'        => 'required',
            'description'   => 'required',
        ]);


        $product= Product::create($request->all());

        if ($request->hasFile('product_images')){
            foreach($request->file('product_images') as $image){
                $filename = $image->getClientOriginalName();

                $imageBaseName = pathinfo($filename,PATHINFO_FILENAME);
                $imageExtension = pathinfo($filename,PATHINFO_EXTENSION);

                $filenameToStore = $imageBaseName . '-' . time() . '.' . $imageExtension;

                $path = $image->storeAs('public/assets/images/products' , $filenameToStore);

                $imageTable= Image::create([
                    'src'           => $filenameToStore,
                    'product_id'    => $product->id
                ]);
            }
        }
        
        return redirect()->route('products.index')
            ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        return view('products.show',compact('product'));

    }
    public function addprices(Product $product)
    {
        //
        return view('products.addprices',compact('product'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        return view('products.edit',compact('product'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product){
        //
        $request->validate([
            'productName'   => 'required',
            'modelNumber'   => 'required',
            'category'      => 'required',
            'brand'         => 'required',
            /*'cost'          => 'required',
            'whole'         => 'required',
            'online'        => 'required',
            'retail'        => 'required',*/
            'description'   => 'required',
            'quantity'      =>  'integer'

        ]);

        $product->update($request->all());


        if ($request->hasFile('product_images')){
            foreach($request->file('product_images') as $image){

                $filename = $image->getClientOriginalName();
                $imageBaseName = pathinfo($filename,PATHINFO_FILENAME);
                $imageExtension = pathinfo($filename,PATHINFO_EXTENSION);
                $filenameToStore = $imageBaseName . '-' . time() . '.' . $imageExtension;
                $path = $image->storeAs('public/assets/images/products' , $filenameToStore);

                $imageTable= Image::create([
                    'src'           => $filenameToStore,
                    'product_id'    => $product->id
                ]);
            }
        }

        // Delete images

        if ($request->removed_images) {
            foreach ($request->removed_images as $key => $value) {
                Image::findOrFail($value)->delete();
            }
        }

        return redirect()->route('products.show', $product->id)
            ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();

        return redirect()->route('products.index')
            ->with('success','Product deleted successfully');
    }

    /*public function Search(Request $request)
    {
        $serial_number= $request->input('search');
        $results =DB::table('products')->where(function ($query) use ($serial_number) {
            $query->where('modelNumber','LIKE',"%$serial_number%");
        })->latest()->get();

        return view('search',compact('results'));
    }*/

    public function search(Request $request){

        //dd($request->search);

        $products = DB::table('products')
                ->where('productName', 'like', '%'.$request->search.'%')
                ->orWhere('brand', 'like', '%'.$request->search.'%')
                ->orWhere('category', 'like', '%'.$request->search.'%')
                ->orWhere('modelNumber', 'like', '%'.$request->search.'%')
                ->get();

        return view('products.search',[
            'products'  => $products
        ]);
    }


    public function postSearch(Request $request){

       $products = Product::all();

       if($request->keyword != ''){
            $products = Product::where('productName','LIKE','%'.$request->keyword.'%')->get();
       }

       return response()->json([
          'products' => $products
       ]);

    }

}
