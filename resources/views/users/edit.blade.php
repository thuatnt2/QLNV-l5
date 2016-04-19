@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
@stop
@section('content')
@include('partials.flash')
@include('partials.confirm')
<div class="row">
    <div class="box row-form">
        {!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
        {!! Former::horizontal_open(action('UnitController@update', $user->id))->id('form-changepassword') !!}
        {{ method_field('PUT') }}
        <fieldset>
        {!! Former::legend('Form đổi mật khẩu') !!}
        <div class="col-sm-offset-3 col-sm-4">
            {!! Former::password('oldpassword', 'Mật khẩu cũ')->required()->addClass('input-sm'); !!}
            {!! Former::password('newpassword', 'Mật khẩu mới')->required()->addClass('input-sm'); !!}
            {!! Former::password('confirmpassword', 'Xác nhận')->required()->addClass('input-sm'); !!}
            <div class="form-group">
                <div class="col-lg-offset-4 col-sm-offset-4 col-lg-8 col-sm-8">
                     <button type="submit" class="btn btn-success btn-small"><i class="fa fa-check">&nbsp</i>Đồng ý</button>
                     <button type="reset" class="btn btn-default btn-small"><i class="fa fa-refresh">&nbsp</i>Làm mới</button>
                </div>
            </div>
        </div>    
        </fieldset>
        {!! Former::close() !!}
    </div>
</div>
@stop
@section('javascript')
{{-- app.js --}}
<script src="{{ URL::asset('js/app.js') }}"></script>
@stop
