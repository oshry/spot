<?php
/**
 * Created by PhpStorm.
 * User: oshry
 * Date: 27/08/2016
 * Time: 5:34 PM
 */
?>
@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Requests CRUD</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('request.create') }}"> Create New Item</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>

            <th>Code</th>
            <th>Status ID</th>
            <th>Percent</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($items as $key => $item)
            <tr>
                <td>{{ $item->code }}</td>
                <td>{{ $item->status_id }}</td>
                <td>{{ $item->percent }}%</td>
                <td>
                    <a class="btn btn-info" href="{{ route('request.show',$item->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('request.edit',$item->id) }}">Edit</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['request.destroy', $item->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
    {{--{!! $items->render() !!}--}}
@endsection