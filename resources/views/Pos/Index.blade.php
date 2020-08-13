@extends('layouts.app')
@section('content')
    <form method="post" action="{{ action('PosController@store') }}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="container">
            <div class="form-group col-md-5">
                <label for="start"class="col-form-label" >Start</label>
                <input type="date" name="start" id="start"  class="form-control">
            </div>
            <div class="form-group col-md-5">
                <label for="end" class="col-form-label">End</label>
                <input type="date" name="end"  id="start" class="form-control">
            </div>
            <div class="form-group col-md-5">
                <label for="number" class="col-form-label">Amouth</label>
                <input type="text" name="number"  id="number" class="form-control">
            </div>

            <div class="form-group">
                <div class="col-sm-offset-9 col-sm-5">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
<div class="container">
    @if (count($creceipt) > 0)
    @foreach ($creceipt as $receipt)
<ul>
        <h3>Receipt ID : {{ $receipt->id }}</h3>
    <h4>
        Time:
    <?php
    echo gmdate("Y-m-d H:i:s", $receipt->timestamp);
    ?>
    </h4>
@foreach($receipt->itemreceipt as $itemr)
        <li>Name: {{ $itemr->item->name }}</li>
        <li>Quantity :{{ $itemr->quantity }}</li>
        <li>uint price: {{ $itemr->item->unitprice }}</li>
        <li>Total price :{{ $itemr->totalprice }}</li>
        @endforeach
        <h3>total : {{ $receipt->total }}</h3>
</ul>
</br>
        @endforeach
@endif
</div>
@endsection