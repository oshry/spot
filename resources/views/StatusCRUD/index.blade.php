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
                <h2>Status CRUD</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('status.create') }}"> Create New Item</a>
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
            <th>Status</th>
            <th>Active</th>
            <th>Requests</th>
            <th>Action</th>
        </tr>
        @foreach ($items as $key => $item)
            <tr>
                <td>{{ $item->status_name }}</td>
                <td>{{ $item->active }}</td>
                <td>{{ $item->requests }}</td>
                <td>
                    <a class="btn btn-info" href="request/{{$item->status}}/showitems/">Show Requests</a>
                    <a class="btn btn-primary" href="{{ route('status.edit',$item->id) }}">Edit</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['status.destroy', $item->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
    {{--{!! $items->render() !!}--}}
@endsection