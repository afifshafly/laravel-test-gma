<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;
use App\Models\Order;
use App\Models\OrderDetail;
use Auth;
use DB;

class TokoController extends Controller
{

    public function getSupplier(){

        $user = User::where('role','supplier')->get();

        return response()->json($user);

    }

    public function getSupplierProduk($supplier_id){

        $produk = Produk::where('supplier_id',$supplier_id)->get();

        return response()->json($produk);

    }

    public function orderProduk(Request $request,$produk_id){

        $no_urut = Order::max('id');
        $produk = Produk::where('id',$produk_id)->first();
        $cek_supplier = Order::where('toko_id',Auth::user()->id)->first();

        if(empty($cek_order))
        {
            $order = Order::create([
                'order_no' => date('dmy').sprintf("%03s", abs($no_urut + 1)),
                'toko_id' => Auth::user()->id,
            ]);
        }

        $new_order = Order::where('toko_id',Auth::user()->id)->where('status',0)->first();

        $order_detail = OrderDetail::create([
            'produk_id' => $produk_id,
            'order_id'  => $new_order->id,
            'qty' => $request->qty,
            'status' => 'waiting'
        ]);

        return response()->json(["msg" => 'Pesanan Berhasil']);


    }

    public function getApproveProduk(){

        $order = DB::table('order')
        ->join('users','order.toko_id','=','users.id')
        ->join('order_detail','order.id','=','order_detail.order_id')
        ->join('produk','order_detail.produk_id','=','produk.id')
        ->where('order.toko_id',Auth::user()->id)
        ->where('order_detail.status','approve')
        ->select('order.id as id',
        'order.order_no as order_no',
        'users.name as name',
        'produk.nama_produk as nama_produk',
        'order_detail.id as order_detail_id','order_detail.qty as qty','order_detail.status as status')
        ->get();

        // $approveOrder = OrderDetail::with('toko')->get();

        return response()->json($order);

    }

}
