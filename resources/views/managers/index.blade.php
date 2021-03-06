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
        {!! Former::horizontal_open(url('manager'))->id('form-create') !!}
        <fieldset>
        {!! Former::legend('Form phân công') !!}
        <div class="col-sm-offset-3 col-sm-4">
            {!! Former::select('user', 'Tên cán bộ')->options($users)->addClass('input-sm'); !!}
            {!! Former::multiselect('order', 'Danh sách đối tượng')->options($orders)->addClass('input-sm'); !!}
            <div class="form-group">
                <div class="col-lg-offset-4 col-sm-offset-4 col-lg-8 col-sm-8">
                    <button type="submit" class="btn btn-success btn-small"><i class="fa fa-plus">&nbsp</i>Đồng ý</button>
                    <button type="reset" class="btn btn-default btn-small"><i class="fa fa-refresh">&nbsp</i>Làm mới</button>
                </div>
            </div>
        </div>    
        </fieldset>
        {!! Former::close() !!}
    </div>
</div>

<div class="row">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Danh sách phân công</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="sortTable" class="table table-bordered table-striped">
                <thead>
                    <tr class="success">
                        <th class="text-center">STT</th>
                        <th class="text-center">Tên cán bộ</th>
                        <th class="text-center">Đối tượng</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>
                                {{ $user }}
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <th width="10%">Họ tên</th>
                                        <th width="10%">Số đt</th>
                                        <th width="10%">Thời gian y/c</th>

                                    </tr>
                                    
                                    @foreach ($managers as $manager)
                                        @if ($index == $manager->manager)
                                            <tr>
                                                <td>{{ $manager->order_name}}</td>
                                                <td>
                                                    @foreach ($manager->phones as $phone)
                                                        {{ $phone->number }} <br> 
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{ $manager->date_begin->format('d/m/Y') . ' &rarr; ' . $manager->date_end->format('d/m/Y') }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </table>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-xs fa fa-edit" data-url="{{ action('DashBoardController@edit', $index) }}" type="button" title="Sửa"></button>
                                &nbsp
                            <button class="btn btn-danger btn-xs fa fa-trash" data-toggle="modal" data-target="#confirmModal" data-url="{{ action('DashBoardController@destroy', $index) }}" title="Xóa"></button>
                            </td>
                        </tr>
                    @endforeach
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
