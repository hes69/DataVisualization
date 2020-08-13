<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Sale;
use App\Subject;
use App\SubjectClasses;
use Charts;
use DateTime;
use DatePeriod;
use DateIntercal;
class SaleController extends Controller
{
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


        $method = $request->method();

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
        return view('sales.index', ['subjects' => $subjects,'sales'=>$sales,'tablename'=>$tablename,'subject' => $subject]);








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
     

  ',[$value,$startts,$endts]);



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



//echo  print_r($subjects);
        ///$plucked = $collection->pluck('name');

        return view('sales.index', ['subjects' => $subjects,'subjectclass'=>$subjectclass,'st'=>$st,'ed'=>$ed,'sales'=>$sales,'tablename'=>$tablename,'subject' => $subject]);



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
