<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class SupplierController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(['auth','verified']);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard()
    {
        return view('supplier.dashboard');
    }


    public function indexProduk()
    {
        return view('supplier.produk.index');
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
    public function storeProduk(Request $request)
    {

        Produk::updateOrCreate(
            [
              'id' => $request->id
            ],
            [
                'supplier_id' => Auth::user()->id,
                'nama_produk' => $request->nama_produk,
                'stock' => $request->stock
            ]
          );

          return response()->json(
            [
              'success' => true,
              'message' => 'Data inserted successfully'
            ]
          );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProduk(Request $request)
    {
        $produk = Produk::where('supplier_id',Auth::user()->id)->latest()->get();

        return $request->ajax() ? response()->json($produk,Response::HTTP_OK) : abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProduk($id)
    {
        $produk = Produk::find($id);

        return response()->json(['data' => $produk]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyProduk($id)
    {
        $produk = Produk::find($id);

        $produk->delete();
    
        return response()->json([
          'message' => 'Data deleted successfully!'
        ]);
    }
}
