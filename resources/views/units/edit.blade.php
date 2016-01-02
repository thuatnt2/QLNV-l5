	{!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
    {!! Former::horizontal_open(action('UnitController@update', $unit->id)) !!}
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset>
    {!! Former::legend('Form sửa đơn vị') !!}
    <div class="col-sm-offset-3 col-sm-4">
        {!! Former::text('description', 'Tên đơn vị')->required()->addClass('input-sm')->value($unit->description); !!}
        {!! Former::text('symbol', 'Ký hiệu')->required()->addClass('input-sm')->value($unit->symbol); !!}
        {!! Former::radios('block', 'Thuộc khối')
        ->radios([
            'An ninh' => ['value' => 'AN', 'checked' => true],
            'Cảnh sát' => ['value' => 'CS']
        ])
        ->inline()
         !!}
        <div class="form-group">
            <div class="col-lg-offset-4 col-sm-offset-4 col-lg-8 col-sm-8">
                 <button type="submit" class="btn btn-success btn-small"><i class="fa fa-edit">&nbsp</i>Sửa</button>
                 <button type="reset" class="btn btn-default btn-small"><i class="fa fa-refresh">&nbsp</i>Làm mới</button>
            </div>
        </div>
    </div>    
    </fieldset>
    {!! Former::close() !!}
