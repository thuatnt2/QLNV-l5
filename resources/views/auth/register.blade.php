@extends('layouts.master')
@section('css')

{{-- DateRangepicker --}}
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
@stop
@section('content')
<div class="row">
    <div class="box row-form">
        <div class="row">
            <div class="col-sm-11">
                <span style="padding-left: 8px;font-size: 18px;">Đăng ký người dùng</span>
           </div>
        </div>
        <hr>
        {!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
        {!! Former::open_for_files(url('register'))->id('form-create') !!}
        <div class="col-sm-4 col-sm-offset-3">
            {!! Former::text('name', 'Tên đăng nhập')->required()->addClass('input-sm'); !!}
            {!! Former::text('full_name', 'Họ và tên')->required()->addClass('input-sm'); !!}
            {!! Former::text('email', 'Email')->required()->addClass('input-sm'); !!}
            {!! Former::text('password', 'Mật khẩu')->required()->addClass('input-sm'); !!}
            {!! Former::text('confirm-password', 'Xác nhận mật khẩu')->required()->addClass('input-sm'); !!}
            {!! Former::text('role', 'Quyền')->addClass('input-sm'); !!}
        </div> 
        <div class="form-group">
            <div class="col-lg-offset-5 col-sm-offset-5 col-lg-8 col-sm-8">
               <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus">&nbsp</i>Thêm</button>
               <button type="reset" class="btn btn-default btn-sm"><i class="fa fa-refresh">&nbsp</i>Làm mới</button>
           </div>
            </div>
        {!! Former::close() !!}
    </div>
</div>
<div class="row">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Danh sách người dùng</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Họ và tên</th>
                        <th class="text-center">Quyền</th>
                        <th class="text-center">Ngày tạo</th>
                        <th class="text-center">Ngày sửa</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
@stop
@section('javascript')
{{-- app.js --}}
<script src="{{ URL::asset('js/app.js') }}"></script>
@stop
