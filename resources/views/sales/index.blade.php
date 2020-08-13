
@extends('layouts.app')

@section('content')
    <form method="post" action="{{ action('SaleController@store') }}" accept-charset="UTF-8">

        {{ csrf_field() }}

        <div class="container">
            <div class="form-group col-md-5">
            <label for="subject" class="col-form-label">Subject</label>

                <select name="subject"  class ="form-control">
                    <option value=1>Human</option>
                    <option value=2>Car</option>
                    <option disabled selected value> -- select an option -- </option>

                </select>
            </div>


            <div class="form-group col-md-5">
            <label for="subject" class="col-form-label">Event</label>

                <select  name="filter", class="form-control">
                    <option value=0>Cross The line</option>
                    <option value=1>Event 1</option>
                    <option value=3>Event 2</option>
                    <option disabled selected value> -- select an option -- </option>
                </select>

            </div>

            <div class="form-group col-md-5">
            <label for="start"class="col-form-label" >Start</label>



                <input type="date" name="start" id="start"  class="form-control">

                </div>
                <div class="form-group col-md-5">
                <label for="end" class="col-form-label">End</label>
                <input type="date" name="end"  id="task-name" class="form-control">
            </div>
                <div class="form-group col-md-5">
                <label class="checkbox-inline">
                    <input type="checkbox" name="sale">Sale
                </label>
                </div>

            <div class="form-group">
                <div class="col-sm-offset-9 col-sm-5">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Filter
                    </button>
                </div>
            </div>



                </div>







        </form>
        <div class="container">
        <div class="form-group col-md-5">

              <h3><strong>{{ $tablename }}</strong></h3>


                <div class="panel-body">
                    <table class="table table-striped task-table">

                        <!-- Table Headings -->
                        <thead>
                        <th>Year</th>
                        <th>Month</th>
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


                                <td class="table-text">
                                    <div>{{ $subject-> count }}</div>
                                    <!-- TODO: Delete Button -->
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
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