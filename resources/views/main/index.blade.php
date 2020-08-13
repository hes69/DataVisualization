@extends('layouts.app')
@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link type="stylesheet" css="{{ asset('css/style.css') }}" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


    {!! Form::open([
        'route' => 'main.store',
          'files' => true
    ]) !!}
    <div class="container">
    <div class="form-group col-md-5 "style="display:block">
        <div class="form-group  " >
            {!! Form::label('criteria1', 'Criteria 1:', ['class' => 'control-label']) !!}
            {!! Form::select('criteria1', [1 => 'Subject', 2 => 'Event', 3 => 'Sale'  ] ,3 ,['class' => 'form-control']) !!}
        </div>
    </div>

    <div id ="sub" class="form-group col-md-5 active" >
        <div class="form-group  " >
            {!! Form::label('subject', 'Subject:', ['class' => 'control-label']) !!}
            {!! Form::select('subject',$subjectclass ,2 ,['class' => 'form-control']) !!}
        </div>
    </div>
    <div id ="ev" class="form-group col-md-5 deactive ">
        <div class="form-group">
            {!! Form::label('event', 'Event:', ['class' => 'control-label']) !!}
            {!! Form::select('event',$eventclass , 2 ,['class' => 'form-control']) !!}
        </div>
    </div>

    <div id ="sa" class="form-group col-md-5 deactive ">
        <div class="form-group">
            {!! Form::label('sale', 'Sale :', ['class' => 'control-label']) !!}
            {!! Form::select('sale',$items ,'s' ,['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group col-md-5 "style="display:block">
        <div class="form-group  " >
            {!! Form::label('criteria2', 'Criteria 2:', ['class' => 'control-label']) !!}
            {!! Form::select('criteria2',[1 => 'Subject', 2 => 'Event', 3 => 'Sale'  ]  ,'s' ,['class' => 'form-control']) !!}
        </div>
    </div>


    <div id ="sub2" class="form-group col-md-5 active" >
        <div class="form-group  " >
            {!! Form::label('subject2', 'Subject:', ['class' => 'control-label']) !!}
            {!! Form::select('subject2',$subjectclass ,'s' ,['class' => 'form-control']) !!}
        </div>
    </div>
    <div id ="ev2" class="form-group col-md-5 deactive ">
        <div class="form-group">
            {!! Form::label('event2', 'Event:', ['class' => 'control-label']) !!}
            {!! Form::select('event2',$eventclass ,'s' ,['class' => 'form-control']) !!}
        </div>
    </div>

    <div id ="sa2" class="form-group col-md-5 deactive ">
        <div class="form-group">
            {!! Form::label('sale2', 'Sale :', ['class' => 'control-label']) !!}
            {!! Form::select('sale2',$items ,'s' ,['class' => 'form-control']) !!}
        </div>
    </div>


    <div class="form-group col-md-5">
        <div class="form-group">
            {!! Form::label('start', 'Start Date:', ['class' => 'control-label']) !!}
            {!! Form::date('start', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group col-md-5">
        <div class="form-group">
            {!! Form::label('end', 'End :', ['class' => 'control-label']) !!}
            {!! Form::date('end', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group col-md-5 ">
        <div class="form-group  " >
            {!! Form::label('timeperiod', 'Time Period:', ['class' => 'control-label']) !!}
            {!! Form::select('timeperiod', [1 => 'Monthly', 2 => 'Daily', 3 => 'Hourly'  ] ,'s' ,['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-9 col-sm-5">

            {!! Form::submit('filter', ['class' => 'btn btn-primary']) !!}

        </div>
    </div>
    </div>
    <script>
        $(function() {



            $("#criteria1").change(function () {
                if($(this).val() == 1) {
                    $("#ev").addClass("deactive");
                    $("#sa").addClass("deactive");
                    $("#sub").removeClass("deactive");
                }
                if($(this).val() == 2) {
                    $("#sub").addClass("deactive");
                    $("#sa").addClass("deactive");
                    $("#ev").removeClass("deactive");
                }
                if($(this).val() == 3) {
                    $("#sub").addClass("deactive");
                    $("#ev").addClass("deactive");
                    $("#sa").removeClass("deactive");
                }

            });
            $("#criteria2").change(function () {
                if($(this).val() == 1) {
                    $("#ev2").addClass("deactive");
                    $("#sa2").addClass("deactive");
                    $("#sub2").removeClass("deactive");
                }
                if($(this).val() == 2) {
                    $("#sub2").addClass("deactive");
                    $("#sa2").addClass("deactive");
                    $("#ev2").removeClass("deactive");
                }
                if($(this).val() == 3) {
                    $("#sub2").addClass("deactive");
                    $("#ev2").addClass("deactive");
                    $("#sa2").removeClass("deactive");
                }

            });


            $("#criteria1").trigger('change');
            $("#criteria2").trigger('change');



        });
    </script>
    {!! Form::close() !!}


    <div class="container">
        @if (count($subjects) > 0)
            <div class="form-group col-md-5">
            <h3><strong>{{ $tablename }}</strong></h3>
                <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>Year</th>
                    <th>Month</th>
                    @foreach ($subjects as $subject)
                        @if ($loop->first)
                            @isset($subject->day)
                                <th>Day</th>
                            @endisset
                        @endif
                    @endforeach

                    @foreach ($subjects as $subject)
                        @if ($loop->first)
                            @isset($subject->hour)
                                <th>Hour</th>
                            @endisset
                        @endif
                    @endforeach
                    @foreach ($subjects as $subject)
                        @if ($loop->first)
                            @isset($subject->minute)
                                <th>Minute</th>
                            @endisset
                        @endif
                    @endforeach


                    <th>Number of Visit</th>
                    </thead>

                    <!-- Table Body -->

                    <tbody>
                    @foreach ($subjects as $subject)
                        <tr>
                            <!-- Task Name -->

                            <td class="table-text">
                                <div>{{ $subject->year }}</div>
                            </td>

                            <td class="table-text">
                                <div>{{ $subject->month }}</div>
                            </td>
                            @isset($subject->day)
                            <td class="table-text">

                                <div>{{ $subject->day }}</div>

                            </td>
                            @endisset

                            @isset($subject->hour)
                                <td class="table-text">

                                    <div>{{ $subject->hour }}</div>

                                </td>
                            @endisset

                            @isset($subject->minute)
                                <td class="table-text">

                                    <div>{{ $subject->minute }}</div>

                                </td>
                            @endisset


                            <td class="table-text">

                                <div>{{ $subject-> count }}</div>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

            @if (count($events) > 0)
                <div class="form-group col-md-5">

                    <h3><strong>{{ $tablename }}</strong></h3>


                    <div class="panel-body">
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                            <th>Year</th>
                            <th>Month</th>
                            @foreach ($events as $event)
                                @if ($loop->first)
                                    @isset($event->day)
                                        <th>Day</th>
                                    @endisset
                                @endif
                            @endforeach

                            @foreach ($events as $event)
                                @if ($loop->first)
                                    @isset($event->hour)
                                        <th>Hour</th>
                                    @endisset
                                @endif
                            @endforeach
                            @foreach ($events as $event)
                                @if ($loop->first)
                                    @isset($event->minute)
                                        <th>Minute</th>
                                    @endisset
                                @endif
                            @endforeach

                            <th>Number of Occurrences</th>
                            </thead>

                            <tbody>
                            @foreach ($events as $event)
                                <tr>

                                    <td class="table-text">
                                        <div>{{ $event->year }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $event->month }}</div>
                                    </td>
                                    @isset($event->day)
                                        <td class="table-text">
                                            <div>{{$event->day}}</div>
                                        </td>
                                    @endisset
                                    @isset($event->hour)
                                        <td class="table-text">
                                            <div>{{ $event->hour }}</div>
                                        </td>
                                    @endisset
                                    @isset($event->minute)
                                        <td class="table-text">
                                            <div>{{ $event->minute }}</div>
                                        </td>
                                    @endisset
                                    <td class="table-text">
                                        <div>{{ $event->count }}</div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif


            @if (count($itemsales) > 0)
                <div class="form-group col-md-5">
                    <h3><strong>{{ $tablename }}</strong></h3>
                    <div class="panel-body">
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                            <th>Year</th>
                            <th>Month</th>
                            @foreach ($itemsales as $item)
                                @if ($loop->first)
                                    @isset($item->day)
                                        <th>Day</th>
                                    @endisset
                                @endif
                            @endforeach

                            @foreach ($itemsales as $item)
                                @if ($loop->first)
                                    @isset($item->hour)
                                        <th>Hour</th>
                                    @endisset
                                @endif
                            @endforeach
                            @foreach ($itemsales as $item)
                                @if ($loop->first)
                                    @isset($item->minute)
                                        <th>Minute</th>
                                    @endisset
                                @endif
                            @endforeach

                            <th>Quantity</th>
                            <th>Toatal Sale</th>
                            </thead>

                            <!-- Table Body -->

                            <tbody>
                            @foreach ($itemsales as $item)
                                <tr>
                                    <!-- Task Name -->

                                    <td class="table-text">
                                        <div>{{ $item->year }}</div>
                                    </td>

                                    <td class="table-text">
                                        <div>{{ $item->month }}</div>
                                    </td>
                                    @isset($item->day)
                                        <td class="table-text">

                                            <div>{{ $item->day }}</div>

                                        </td>
                                    @endisset

                                    @isset($item->hour)
                                        <td class="table-text">

                                            <div>{{ $item->hour }}</div>

                                        </td>
                                    @endisset

                                    @isset($item->minute)
                                        <td class="table-text">

                                            <div>{{ $item->minute }}</div>

                                        </td>
                                    @endisset


                                    <td class="table-text">

                                        <div>{{$item->quantity }}</div>

                                    </td>
                                    <td class="table-text">

                                        <div>{{ $item->total }}</div>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif







        @if (count($subjects2) > 0)
            <div class="form-group col-md-5">


                    <h3><strong>{{ $tablename2 }}</strong></h3>
                    <div class="panel-body">
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                            <th>Year</th>
                            <th>Month</th>
                            @foreach ($subjects2 as $subject)
                                @if ($loop->first)
                                    @isset($subject->day)
                                        <th>Day</th>
                                    @endisset
                                @endif
                            @endforeach

                            @foreach ($subjects2 as $subject)
                                @if ($loop->first)
                                    @isset($subject->hour)
                                        <th>Hour</th>
                                    @endisset
                                @endif
                            @endforeach
                            @foreach ($subjects2 as $subject)
                                @if ($loop->first)
                                    @isset($subject->minute)
                                        <th>Minute</th>
                                    @endisset
                                @endif
                            @endforeach


                            <th>Number of Visit</th>
                            </thead>

                            <!-- Table Body -->

                            <tbody>
                            @foreach ($subjects2 as $subject)
                                <tr>
                                    <!-- Task Name -->

                                    <td class="table-text">
                                        <div>{{ $subject->year }}</div>
                                    </td>

                                    <td class="table-text">
                                        <div>{{ $subject->month }}</div>
                                    </td>
                                    @isset($subject->day)
                                        <td class="table-text">

                                            <div>{{ $subject->day }}</div>

                                        </td>
                                    @endisset
                                    @isset($subject->hour)
                                        <td class="table-text">
                                            <div>{{ $subject->hour }}</div>
                                        </td>
                                    @endisset
                                    @isset($subject->minute)
                                        <td class="table-text">
                                            <div>{{ $subject->minute }}</div>
                                        </td>
                                    @endisset
                                    <td class="table-text">
                                        <div>{{ $subject->count}}</div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif



            @if (count($events2) > 0)
                <div class="form-group col-md-5">


                    <h3><strong>{{ $tablename2 }}</strong></h3>
                    <div class="panel-body">
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                            <th>Year</th>
                            <th>Month</th>
                            @foreach ($events2 as $event)
                                @if ($loop->first)
                                    @isset($event->day)
                                        <th>Day</th>
                                    @endisset
                                @endif
                            @endforeach

                            @foreach ($events2 as $event)
                                @if ($loop->first)
                                    @isset($event->hour)
                                        <th>Hour</th>
                                    @endisset
                                @endif
                            @endforeach
                            @foreach ($events2 as $event)
                                @if ($loop->first)
                                    @isset($event->minute)
                                        <th>Minute</th>
                                    @endisset
                                @endif
                            @endforeach


                            <th>Number of Occurrences</th>
                            </thead>

                            <!-- Table Body -->

                            <tbody>
                            @foreach ($events2 as $event)
                                <tr>
                                    <!-- Task Name -->

                                    <td class="table-text">
                                        <div>{{ $event->year }}</div>
                                    </td>

                                    <td class="table-text">
                                        <div>{{ $event->month }}</div>
                                    </td>
                                    @isset($event->day)
                                        <td class="table-text">

                                            <div>{{ $event->day }}</div>

                                        </td>
                                    @endisset
                                    @isset($event->hour)
                                        <td class="table-text">
                                            <div>{{ $event->hour }}</div>
                                        </td>
                                    @endisset
                                    @isset($event->minute)
                                        <td class="table-text">
                                            <div>{{ $event->minute }}</div>
                                        </td>
                                    @endisset
                                    <td class="table-text">
                                        <div>{{ $event->count}}</div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif










            <div class="form-group col-md-5">
            <div>
                <h3><strong>Sales</strong> </h3>

            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>Year</th>
                    <th>Month</th>
                    <th>Turoover</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <!-- Task Name -->

                            <td class="table-text">
                                <div>{{ $sale->year }}</div>
                            </td>

                            <td class="table-text">
                                <div>{{ $sale->month }} </div>
                            </td>


                            <td class="table-text">
                                <div>{{ number_format($sale->Turnover) }} Euro</div>
                                <!-- TODO: Delete Button -->
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection