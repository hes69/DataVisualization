<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Sale;
use App\Subject;
use App\SubjectClasses;
use App\Item;
use App\EventClasses;
use Charts;
use DateTime;
use DatePeriod;
use DateIntercal;


class MainController extends Controller
{
    /**
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /// return view('sales.index');
        ///$sums = Sale::take(100)
        // ->get();

        $subjectclass = SubjectClasses::pluck('type', 'id');
        $eventclass = EventClasses::pluck('type', 'id');
        $events=array();
        $subjects2=array();
        $events2=array();
        $itemsales=array();
        $method = $request->method();
        $items = Item::pluck('name', 'id');

        if ($request->isMethod('get')) {

        }
        $value=3;

        //->select(DB::raw(' MONTH(FROM_UNIXTIME(Timesstamp)),
        ///YEAR(FROM_UNIXTIME(Timesstamp)),
        //COUNT(*)'))

        //    ->groupby(DB::raw(' MONTH(FROM_UNIXTIME(Timesstamp)),
        //YEAR(FROM_UNIXTIME(Timesstamp))'))
        //    ->get();
        // $affected = DB::update('update users set votes = 100 where name = ?', ['John']);
        $subjects = DB::select('SELECT 
  MONTH(FROM_UNIXTIME(Timesstamp))as month, 
  YEAR(FROM_UNIXTIME(Timesstamp)) as year, 
  COUNT(*)as count
  FROM subjects
  WHERE SubjectClass_id = ?
GROUP BY 
YEAR(FROM_UNIXTIME(Timesstamp)),
  MONTH (FROM_UNIXTIME(Timesstamp))
     

  ',[$value]);

        $sales=array();
        $tablename='Subjects';
        $subject='Subjects';
       return view('main.index', ['itemsales'=>$itemsales,'events2'=>$events2,'subjects' => $subjects,'items'=>$items,'subjects2'=>$subjects2,'events'=>$events,'eventclass'=>$eventclass,'subjectclass'=>$subjectclass,'sales'=>$sales,'tablename'=>$tablename,'subject' => $subject]);








///        return view('sales.index', ['subjects' => $subjects]);

        ///return view('sales.index');
///print r($subjects);
        /// return redirect()->back();



        $results = DB::select('SELECT 
  DAY (FROM_UNIXTIME(Timesstamp))as day, 
  MONTH(FROM_UNIXTIME(Timesstamp))as month, 
  YEAR(FROM_UNIXTIME(Timesstamp)) as year, 
  COUNT(*)as count
FROM sales
GROUP BY 
YEAR(FROM_UNIXTIME(Timesstamp)),
  MONTH(FROM_UNIXTIME(Timesstamp)),
     DAY (FROM_UNIXTIME(Timesstamp))

  ');
///print r($results);
        ///print_r ($results);
        //echo $results;

        ///$results = DB::select('select * from users where id = :id', ['id' => 1]);

        /// where('Timesstamp', '>', 1498097722)
        ///->where ('Timesstamp', '<', 1498097722)

        //   echo  $request;

        //->sum('Turnover');

//echo $sum->Turnover;
        //  $date = new DateTime();
        // foreach  ($sums as $sum)

        //{       ///echo PHP_EOL ;

        //  $date->setTimestamp($sum->Timesstamp);
        //echo PHP_EOL ;
        // echo $date->format('Y-m-d ');
        //   echo PHP_EOL ;
        //echo 'hello';
        //echo gmdate("Y-m-d\TH:i:s\Z", $sum->Timesstamp). "\n";

        //echo PHP_EOL ;
        ///}




        //$english_format_number = number_format($sum);
        // echo $english_format_number;
        //$sales = Sale::all();
        //foreach ($sales as $sale) {
        //  echo $sale->Turnover;
        // }
        //    ->take(10)
        //  ->get();

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

////return view('sales.index', ['subjects' => $subjects]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //human 1
        //human 2

        $st=$request->start;
        $ed=$request->end;
        $startts=0000000000;
        $endts=9999999999;
        $start=$request->start;
        $sales=array();
        $subjectclass = SubjectClasses::pluck('type', 'id');
        $eventclass = EventClasses::pluck('type', 'id');
        $items = Item::pluck('name', 'id');

        $events=array();
        $subjects=array();
        $subjects2=array();
        $events2=array();
        $itemsales=array();
        $tablename2='';

        if ($request->start)
        {
            $startts = strtotime($request->start);
        }
        if ( $request->end)
        {
            $endts = strtotime($request->end);

        }
        $tablename='subject';

        $value=0;
        if ($request->subject)
        {
            $value=$request->subject;
            $name = SubjectClasses::find($value);
            $tablename= $name->Type;
        }



        $subject=$request->subject;
        //->select(DB::raw(' MONTH(FROM_UNIXTIME(Timesstamp)),
        ///YEAR(FROM_UNIXTIME(Timesstamp)),
        //COUNT(*)'))

        //    ->groupby(DB::raw(' MONTH(FROM_UNIXTIME(Timesstamp)),
        //YEAR(FROM_UNIXTIME(Timesstamp))'))
        //    ->get();
        // $affected = DB::update('update users set votes = 100 where name = ?', ['John']);
        if ($request->criteria1==1)
        {
            if($request->timeperiod==1)
            {
            $subjects = DB::select('SELECT 
  MONTH(FROM_UNIXTIME(Timesstamp))as month, 
  YEAR(FROM_UNIXTIME(Timesstamp)) as year, 
COUNT(*)as count
    FROM subjects
  WHERE SubjectClass_id = ?
  and Timesstamp > ?
  and Timesstamp < ?
GROUP BY 
YEAR(FROM_UNIXTIME(Timesstamp)),
  MONTH (FROM_UNIXTIME(Timesstamp))
  ',[$request->subject,$startts,$endts]);
        }
            if($request->timeperiod==2)
            {
                $subjects = DB::select('SELECT 
  DAY(FROM_UNIXTIME(Timesstamp))as day , 
  MONTH(FROM_UNIXTIME(Timesstamp))as month, 
  YEAR(FROM_UNIXTIME(Timesstamp)) as year, 
  COUNT(*)as count
  FROM subjects
  WHERE SubjectClass_id = ?
  and Timesstamp > ?
  and Timesstamp < ?
GROUP BY 
YEAR(FROM_UNIXTIME(Timesstamp)),
  MONTH (FROM_UNIXTIME(Timesstamp)),
  DAY (FROM_UNIXTIME(Timesstamp))


  ',[$request->subject,$startts,$endts]);
            }

            if($request->timeperiod==3)
            {
                $subjects = DB::select('SELECT 
  MINUTE(FROM_UNIXTIME(Timesstamp))as minute, 
  HOUR(FROM_UNIXTIME(Timesstamp))as hour, 
  DAY(FROM_UNIXTIME(Timesstamp))as day, 
  MONTH(FROM_UNIXTIME(Timesstamp))as month, 
  YEAR(FROM_UNIXTIME(Timesstamp)) as year, 
  COUNT(*)as count
  FROM subjects
  WHERE SubjectClass_id = ?
  and Timesstamp > ?
  and Timesstamp < ?
GROUP BY 
YEAR(FROM_UNIXTIME(Timesstamp)),
  MONTH (FROM_UNIXTIME(Timesstamp)),
       DAY (FROM_UNIXTIME(Timesstamp)),
  HOUR (FROM_UNIXTIME(Timesstamp)),
    MINUTE (FROM_UNIXTIME(Timesstamp))

  ',[$request->subject,$startts,$endts]);
            }

            $value=$request->subject;
            $name = SubjectClasses::find($value);
            $tablename= $name->Type;

        }


        if ($request->criteria1==2)

        {
            if($request->timeperiod==1)
            {
                $events = DB::select('SELECT 
  MONTH(FROM_UNIXTIME(Timesstamp))as month, 
  YEAR(FROM_UNIXTIME(Timesstamp)) as year, 
COUNT(*)as count
    FROM events
  WHERE EventClass_id = ?
  and Timesstamp > ?
  and Timesstamp < ?
GROUP BY 
YEAR(FROM_UNIXTIME(Timesstamp)),
  MONTH (FROM_UNIXTIME(Timesstamp))
  ',[$request->event,$startts,$endts]);
            }
            if($request->timeperiod==2)
            {
                $events = DB::select('SELECT 
  DAY(FROM_UNIXTIME(Timesstamp))as day , 
  MONTH(FROM_UNIXTIME(Timesstamp))as month, 
  YEAR(FROM_UNIXTIME(Timesstamp)) as year, 
  COUNT(*)as count
  FROM events
  WHERE EventClass_id = ?
  and Timesstamp > ?
  and Timesstamp < ?
GROUP BY 
YEAR(FROM_UNIXTIME(Timesstamp)),
  MONTH (FROM_UNIXTIME(Timesstamp)),
  DAY (FROM_UNIXTIME(Timesstamp))


  ',[$request->event,$startts,$endts]);
            }

            if($request->timeperiod==3)
            {
                $events = DB::select('SELECT 
  MINUTE(FROM_UNIXTIME(Timesstamp))as minute, 
  HOUR(FROM_UNIXTIME(Timesstamp))as hour, 
  DAY(FROM_UNIXTIME(Timesstamp))as day, 
  MONTH(FROM_UNIXTIME(Timesstamp))as month, 
  YEAR(FROM_UNIXTIME(Timesstamp)) as year, 
  COUNT(*)as count
  FROM events
  WHERE EventClass_id = ?
  and Timesstamp > ?
  and Timesstamp < ?
GROUP BY 
YEAR(FROM_UNIXTIME(Timesstamp)),
  MONTH (FROM_UNIXTIME(Timesstamp)),
       DAY (FROM_UNIXTIME(Timesstamp)),
  HOUR (FROM_UNIXTIME(Timesstamp)),
    MINUTE (FROM_UNIXTIME(Timesstamp))

  ',[$request->event,$startts,$endts]);
            }

            $value=$request->event;
            $name = EventClasses::find($value);
            $tablename= $name->Type;

        }




        if ($request->criteria1==3) {

            if($request->timeperiod==1)
            {

            $itemsales = DB::select('SELECT  SUM(itemreceipts.totalprice) as total, receipts.timestamp as time,sum(itemreceipts.quantity) as quantity,
     MONTH(FROM_UNIXTIME(receipts.timestamp)) as month , 
     YEAR(FROM_UNIXTIME(receipts.timestamp)) as year, 
COUNT(*)as count
    FROM itemreceipts
  left JOIN receipts ON itemreceipts.receipt_id=receipts.id
WHERE itemreceipts.item_id= ?
            and timestamp > ?
            and timestamp < ?
GROUP BY 
YEAR(FROM_UNIXTIME(timestamp)),
  MONTH (FROM_UNIXTIME(timestamp))

  ',[$request->sale,$startts,$endts]);



        }



            if($request->timeperiod==2)
            {
                $itemsales = DB::select('SELECT  SUM(itemreceipts.totalprice) as total, receipts.timestamp as time,sum(itemreceipts.quantity) as quantity,
DAYNAME (FROM_UNIXTIME(receipts.timestamp))as dayname, 
MONTHNAME(FROM_UNIXTIME(receipts.timestamp))as monthname,
       DAY(FROM_UNIXTIME(receipts.timestamp))as day, 
     MONTH(FROM_UNIXTIME(receipts.timestamp)) as month , 
     YEAR(FROM_UNIXTIME(receipts.timestamp)) as year, 
COUNT(*)as count
    FROM itemreceipts
  left JOIN receipts ON itemreceipts.receipt_id=receipts.id
WHERE itemreceipts.item_id= ?
            and timestamp > ?
            and timestamp < ?
GROUP BY 
YEAR(FROM_UNIXTIME(timestamp)),
  MONTH (FROM_UNIXTIME(timestamp)),
       DAY (FROM_UNIXTIME(timestamp))

  ',[$request->sale,$startts,$endts]);


            }

            if($request->timeperiod==3)
            {
                $itemsales = DB::select('SELECT  SUM(itemreceipts.totalprice) as total, receipts.timestamp as time,sum(itemreceipts.quantity) as quantity,
DAYNAME (FROM_UNIXTIME(receipts.timestamp))as dayname, 
MONTHNAME(FROM_UNIXTIME(receipts.timestamp))as monthname,
MINUTE(FROM_UNIXTIME(receipts.timestamp))as minute,
HOUR(FROM_UNIXTIME(receipts.timestamp))as hour, 
       DAY(FROM_UNIXTIME(receipts.timestamp))as day, 
     MONTH(FROM_UNIXTIME(receipts.timestamp)) as month , 
     YEAR(FROM_UNIXTIME(receipts.timestamp)) as year, 
COUNT(*)as count
    FROM itemreceipts
  left JOIN receipts ON itemreceipts.receipt_id=receipts.id
WHERE itemreceipts.item_id= ?
            and timestamp > ?
            and timestamp < ?
GROUP BY 
YEAR(FROM_UNIXTIME(timestamp)),
  MONTH (FROM_UNIXTIME(timestamp)),
       DAY (FROM_UNIXTIME(timestamp)),
 HOUR (FROM_UNIXTIME(timestamp )),
    MINUTE (FROM_UNIXTIME(timestamp))


  ',[$request->sale,$startts,$endts]);


            }

            $value=$request->sale;
            $name = Item::find($value);
            $tablename= $name->name;

        }
















        if ($request->criteria2==1)
        {
            if($request->timeperiod==1)
            {
                $subjects2 = DB::select('SELECT 
  MONTH(FROM_UNIXTIME(Timesstamp))as month, 
  YEAR(FROM_UNIXTIME(Timesstamp)) as year, 
COUNT(*)as count
    FROM subjects
  WHERE SubjectClass_id = ?
  and Timesstamp > ?
  and Timesstamp < ?
GROUP BY 
YEAR(FROM_UNIXTIME(Timesstamp)),
  MONTH (FROM_UNIXTIME(Timesstamp))
  ',[$request->subject2,$startts,$endts]);
            }
            if($request->timeperiod==2)
            {
                $subjects2 = DB::select('SELECT 
  DAY(FROM_UNIXTIME(Timesstamp))as day , 
  MONTH(FROM_UNIXTIME(Timesstamp))as month, 
  YEAR(FROM_UNIXTIME(Timesstamp)) as year, 
  COUNT(*)as count
  FROM subjects
  WHERE SubjectClass_id = ?
  and Timesstamp > ?
  and Timesstamp < ?
GROUP BY 
YEAR(FROM_UNIXTIME(Timesstamp)),
  MONTH (FROM_UNIXTIME(Timesstamp)),
  DAY (FROM_UNIXTIME(Timesstamp))


  ',[$request->subject2,$startts,$endts]);
            }

            if($request->timeperiod==3)
            {
                $subjects2 = DB::select('SELECT 
  MINUTE(FROM_UNIXTIME(Timesstamp))as minute, 
  HOUR(FROM_UNIXTIME(Timesstamp))as hour, 
  DAY(FROM_UNIXTIME(Timesstamp))as day, 
  MONTH(FROM_UNIXTIME(Timesstamp))as month, 
  YEAR(FROM_UNIXTIME(Timesstamp)) as year, 
  COUNT(*)as count
  FROM subjects
  WHERE SubjectClass_id = ?
  and Timesstamp > ?
  and Timesstamp < ?
GROUP BY 
YEAR(FROM_UNIXTIME(Timesstamp)),
  MONTH (FROM_UNIXTIME(Timesstamp)),
       DAY (FROM_UNIXTIME(Timesstamp)),
  HOUR (FROM_UNIXTIME(Timesstamp)),
    MINUTE (FROM_UNIXTIME(Timesstamp))

  ',[$request->subject2,$startts,$endts]);
            }

            $value=$request->subject2;
            $name = SubjectClasses::find($value);
            $tablename2= $name->Type;


        }




        if ($request->criteria2==2)
        {
            if($request->timeperiod==1)
            {
                $events2 = DB::select('SELECT 
  MONTH(FROM_UNIXTIME(Timesstamp))as month, 
  YEAR(FROM_UNIXTIME(Timesstamp)) as year, 
COUNT(*)as count
    FROM events
  WHERE EventClass_id = ?
  and Timesstamp > ?
  and Timesstamp < ?
GROUP BY 
YEAR(FROM_UNIXTIME(Timesstamp)),
  MONTH (FROM_UNIXTIME(Timesstamp))
  ',[$request->event2,$startts,$endts]);
            }
            if($request->timeperiod==2)
            {
                $events2 = DB::select('SELECT 
  DAY(FROM_UNIXTIME(Timesstamp))as day , 
  MONTH(FROM_UNIXTIME(Timesstamp))as month, 
  YEAR(FROM_UNIXTIME(Timesstamp)) as year, 
  COUNT(*)as count
  FROM events
  WHERE EventClass_id = ?
  and Timesstamp > ?
  and Timesstamp < ?
GROUP BY 
YEAR(FROM_UNIXTIME(Timesstamp)),
  MONTH (FROM_UNIXTIME(Timesstamp)),
  DAY (FROM_UNIXTIME(Timesstamp))


  ',[$request->event2,$startts,$endts]);
            }

            if($request->timeperiod==3)
            {
                $events2 = DB::select('SELECT 
  MINUTE(FROM_UNIXTIME(Timesstamp))as minute, 
  HOUR(FROM_UNIXTIME(Timesstamp))as hour, 
  DAY(FROM_UNIXTIME(Timesstamp))as day, 
  MONTH(FROM_UNIXTIME(Timesstamp))as month, 
  YEAR(FROM_UNIXTIME(Timesstamp)) as year, 
  COUNT(*)as count
  FROM events
  WHERE EventClass_id = ?
  and Timesstamp > ?
  and Timesstamp < ?
GROUP BY 
YEAR(FROM_UNIXTIME(Timesstamp)),
  MONTH (FROM_UNIXTIME(Timesstamp)),
       DAY (FROM_UNIXTIME(Timesstamp)),
  HOUR (FROM_UNIXTIME(Timesstamp)),
    MINUTE (FROM_UNIXTIME(Timesstamp))

  ',[$request->event2,$startts,$endts]);
            }

            $value=$request->event2;
            $name = EventClasses::find($value);
            $tablename2= $name->Type;

        }











        if( $request->sale) {
            $sales = DB::select('SELECT 
  MONTH(FROM_UNIXTIME(Timesstamp))as month, 
  YEAR(FROM_UNIXTIME(Timesstamp)) as year, 
  SUM(Turnover)as Turnover

  FROM sales
  
  WHERE  Timesstamp > ?
  and Timesstamp < ?
GROUP BY 
YEAR(FROM_UNIXTIME(Timesstamp)),
  MONTH (FROM_UNIXTIME(Timesstamp))
     

  ', [$startts, $endts]);
        }

        ///print_r($itemsales);

//echo  print_r($subjects);
        ///$plucked = $collection->pluck('name');
        return view('main.index', ['itemsales'=>$itemsales,'subjects' => $subjects,'items'=>$items,'tablename2'=>$tablename2,'events2'=>$events2,'subjects2'=>$subjects2,'events'=>$events,'eventclass'=>$eventclass,'subjectclass'=>$subjectclass,'st'=>$st,'ed'=>$ed,'sales'=>$sales,'tablename'=>$tablename,'subject' => $subject]);








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
