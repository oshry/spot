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
                <h2>Edit Status</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('status.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($item, ['method' => 'PATCH','route' => ['status.update', $item->id]]) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                <select name="status">
                    @foreach ($options as $key => $value)
                        <option value="{{ $key }}"
                                @if ($key == old('status', $item->status))
                                selected="selected"
                                @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{--<label>--}}
                    {{--<input type="radio" value="0" name="active" {{ old('active', $item->active) === '1' ? 'checked' : '' }}>--}}
                    {{--About--}}
                {{--</label>--}}
                {{--<strong>Active:</strong>--}}
                {{--{!! Form::checkbox('active') !!}--}}
                {{--{!! Form::checkbox('active', $post->exists ? $post->enable_comments : 1, !$post->exists ? true : $post->enable_comments) !!}--}}

                {{--<input name="active" type="checkbox" value="0">--}}
                @if (1 == old('active', $item->active))
                {!! Form::checkbox('active', null, true) !!}
                @else
                {!! Form::checkbox('active', null, false) !!}
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Requests:</strong>
                {!! Form::number('requests', null, array('placeholder' => '%','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>
    {!! Form::close() !!}

@endsection