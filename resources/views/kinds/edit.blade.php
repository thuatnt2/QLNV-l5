	{!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
    {!! Former::horizontal_open(action('KindController@update', $kind->id))->id('form-edit') !!}
    {{ method_field('PUT') }}
    <fieldset>
    {!! Former::legend('Form sửa tính chất đối tượng') !!}
    <div class="col-sm-offset-3 col-sm-6">
        {!! Former::text('description', 'Tính chất đối tượng')->required()->addClass('input-sm')->value($kind->description); !!}
        {!! Former::text('symbol', 'Ký hiệu')->required()->addClass('input-sm')->value($kind->symbol); !!}
        <div class="form-group">
            <div class="col-lg-offset-4 col-sm-offset-4 col-lg-8 col-sm-8">
                 <button type="submit" class="btn btn-success btn-small"><i class="fa fa-edit">&nbsp</i>Sửa</button>
                 <button type="reset" class="btn btn-default btn-small"><i class="fa fa-refresh">&nbsp</i>Làm mới</button>
                 <button type="button" class="btn btn-danger btn-small" onclick="hideForm()" ><i class="fa fa-reply">&nbsp</i>Hủy</button>
            </div>
        </div>
    </div>    
    </fieldset>
    {!! Former::close() !!}
    <script>
        function hideForm() {
            $('#form-create').show();
            $('#form-edit').remove();
        }
    </script>
