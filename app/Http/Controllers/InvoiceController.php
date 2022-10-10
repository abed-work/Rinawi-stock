<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Invoice,InvoiceRow,Customer};
use DB;
use Dompdf\Dompdf; 

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('invoice.index',[
            'invoices'      => Invoice::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoice.create',[
            'customers'     => Customer::all()  
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       // dd($request);

        $request->validate([
            'customerId'                   => 'required',
            'productName'                  => 'required',
            'productPrice'                 => 'required',
            'productQuantity'              => 'required'
        ]);


        $invoice = Invoice::create([
            'customer_name'     => 'a',
            'isPaid'            => 1,
            'total'             => $request->total,
            'customer_id'       => $request->customerId,
        ]);

        for ($i=0; $i < count($request->productName) ; $i++) {

            InvoiceRow::create([
                'invoice_id'        =>  $invoice->id ,
                'product_id'        =>  $request->product_id[$i],
                'product_price'     =>  $request->productPrice[$i] ,
                'product_quantity'  =>  $request->productQuantity[$i],
                'total'             =>  $request->productTotalPrice[$i]
            ]);

        }

        return redirect()->route('invoice.index')->with('message','Invoice has been added successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('invoice.show',[
            'invoice'   => Invoice::findOrFail($id)
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
        
        return view('invoice.edit',[
            'invoice'       => Invoice::findOrFail($id),
            'customers'     => Customer::all()  

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

        $request->validate([
            'customerId'                 => 'required',
            'productName'                  => 'required',
            'productPrice'                 => 'required',
            'productQuantity'              => 'required'
        ]);
        

        $invoice = Invoice::findOrFail($id);

        $invoice->customer_id    = $request->customerId ;
        $invoice->total          = $request->total;
        $invoice->save();

        DB::table('invoice_rows')->where('invoice_id', $id)->delete();

        for ($i=0; $i < count($request->productName) ; $i++) {

            InvoiceRow::create([
                'invoice_id'        =>  $invoice->id ,
                'product_id'        =>  $request->product_id[$i],
                'product_price'     =>  $request->productPrice[$i] ,
                'product_quantity'  =>  $request->productQuantity[$i],
                'total'             =>  $request->productTotalPrice[$i]
            ]);

        }

        return redirect()->route('invoice.index')->with('message','Invoice has been edited successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Invoice::findOrFail($id)->delete();

        return redirect()->back()->with('message','Invoice has been deleted successfully!');

    }


    public function convert(Request $request) 
    { 
        //dd($request);

        $dompdf = new Dompdf(); 
         
        // Load HTML content  
        $dompdf->loadHtml(
            $request->invoiceHTML
        );  
          
        // (Optional) Setup the paper size and orientation  
        $dompdf->setPaper('A4', 'landscape');  
          
        // Render the HTML as PDF  
        $dompdf->render(); 
         
        // Output the generated PDF (1 = download and 0 = preview) 
        $dompdf->stream(str_replace(' ', '_', $request->customerName).'#'.$request->invoice_id.".pdf", array(   "Attachment"    =>  0)); 
        
        exit();
    }
}
