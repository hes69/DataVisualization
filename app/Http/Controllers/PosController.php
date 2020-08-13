<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use App\Itemreceipt;
use App\Receipt;






class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        ///$items =Item::all();
        $creceipt=array();
///        $receipt = new Receipt();
      ///  $receipt->save();


        //for( $i = 0; $i<5; $i++ ) {

        //$itemreceipt =new Itemreceipt();

        ///$q=rand(1,10);

        //$itemreceipt->quantity=$q;

        //$x=rand(113,212);
        //$item =Item::find($x);
        ///$itemreceipt->item_id=$item->id;
        //$itemreceipt->receipt_id=$receipt->id;
        //$itemreceipt->totalprice=$q*($item->unitprice);
          ///  $itemreceipt->save();

   //     }
        /// $item =Item::all()->random(1);
            ///$item =$items->random(1);
        ///
        ///

 ///       $it = json_decode($item);


    ///    echo $it;
       //// $itemreceipt->Item_id=$item->id;
        //$itemreceipt->totalprice=$item->unitprice;
           //  $itemreceipt->receipt_id =$receipt->id;


//        $receipt->save();

        return view('Pos.index',['creceipt'=>$creceipt]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Pos.index');
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

        $start_date=0000000000;
        $end_date=9999999999;
        $nreceipt=0;
        if ($request->start)
        {
            $start_date = strtotime($request->start);
        }
        if ( $request->end)
        {
            $end_date = strtotime($request->end);

        }
        if ( $request->number)
        {
            $nreceipt = $request->number;
        }

        $receipt_id=array();
        for( $i = 0; $i<$nreceipt; $i++ ) {


            $total=0;
            $receipt = new Receipt();
            $receipt->timestamp=rand($start_date,$end_date);
            $receipt->save();

            $nItemReceipt = rand(1, 15);
            for ($j = 0; $j < $nItemReceipt; $j++) {

                $itemreceipt = new Itemreceipt();

                $quantity = rand(1, 10);

                $itemreceipt->quantity = $quantity;

                $ritem = rand(113, 212);
                $item = Item::find($ritem);
                $itemreceipt->item_id = $item->id;
                $itemreceipt->receipt_id = $receipt->id;
                $itemreceipt->totalprice = $quantity * ($item->unitprice);
                $itemreceipt->save();
                $total +=$itemreceipt->totalprice;
            }
            array_push($receipt_id,$receipt->id);
            $receipt->total=$total;
            $receipt->save();
        }
        $creceipt = Receipt::find($receipt_id);

        return view('Pos.index',['creceipt'=> $creceipt]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
