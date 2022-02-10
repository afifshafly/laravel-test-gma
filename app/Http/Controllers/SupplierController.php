<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use DB;

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

    //Produk

    public function indexProduk()
    {
        return view('supplier.produk.index');
    }

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

    public function getProduk(Request $request)
    {
        $produk = Produk::where('supplier_id',Auth::user()->id)->latest()->get();

        return $request->ajax() ? response()->json(['data' => $produk], Response::HTTP_OK) : abort(404);

        // return response()->json(['data'=>$produk]);
    }

    public function editProduk($id)
    {
        $produk = Produk::find($id);

        return response()->json(['data' => $produk]);
    }

    public function destroyProduk($id)
    {
        $produk = Produk::find($id);

        $produk->delete();

        return response()->json([
          'message' => 'Data deleted successfully!'
        ]);
    }

    //Order

    public function indexOrder()
    {
        return view('supplier.order.index');
    }

    public function getOrder(Request $request){
        $order = DB::table('order')
        ->join('users','order.toko_id','=','users.id')
        ->join('order_detail','order.id','=','order_detail.order_id')
        ->join('produk','order_detail.produk_id','=','produk.id')
        ->where('produk.supplier_id',Auth::user()->id)
        ->where('order_detail.status','!=','approve')
        ->select('order.id as id',
        'order.order_no as order_no',
        'users.name as name',
        'produk.nama_produk as nama_produk',
        'order_detail.id as order_detail_id','order_detail.qty as qty')
        ->get();

        // $order = Order::with('toko','orderDetail')->get();

        return $request->ajax() ? response()->json(['data' => $order], Response::HTTP_OK) : abort(404);
        // return response()->json($order);
    }

    public function approve($id){

        // $id = $request->id;

        $orderDetail = OrderDetail::where('id',$id)->first();
        $produk = Produk::where('id', $orderDetail->produk_id)->first();
        $produk->stock = $produk->stock-$orderDetail->qty;
        $produk->update();

        $orderDetail->status = 'approve';
        $orderDetail->update();

        return $produk;


    }

    // public function getOrderDetail(Request $request,$order_id){
    //     $order = DB::table('order')
    //     ->join('order_detail','order.id','=','order_detail.order_id')
    //     ->join('produk','order_detail.produk_id','=','produk.id')
    //     ->join('users','produk.supplier_id','=','users.id')
    //     ->where('users.id',Auth::user()->id)
    //     ->where('order.toko_id',$order_id)
    //     ->select('produk.id as id','produk.nama_produk as nama_produk','order_detail.qty as qty',)
    //     ->get();

    //     // $order = Order::with('toko','orderDetail')->get();

    //     // return $request->ajax() ? response()->json(['data' => $order], Response::HTTP_OK) : abort(404);
    //     return response()->json(['data'=>$order]);
    // }

}
