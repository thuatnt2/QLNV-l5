	{!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
    {!! Former::horizontal_open(action('UnitController@update', $unit->id))->id('form-edit') !!}
    {{ method_field('PUT') }}
    <fieldset>
    {!! Former::legend('Form sửa đơn vị') !!}
    <div class="col-sm-offset-3 col-sm-4">
        {!! Former::text('description', 'Tên đơn vị')->required()->addClass('input-sm')->value($unit->description); !!}
        {!! Former::text('symbol', 'Ký hiệu')->required()->addClass('input-sm')->value($unit->symbol); !!}
         <div class="form-group">
            <label for="block" class="control-label col-lg-4 col-sm-4">Thuộc khối</label>
            <div class="col-lg-8 col-sm-8">
                <label for="block" class="radio-inline">
                    <input value="AN" {{ $unit->block == "AN" ? "checked":"" }} id="block" type="radio" name="block">An ninh
                </label>
                    <label for="block2" class="radio-inline">
                    <input value="CS" {{ $unit->block == "CS" ? "checked":"" }} id="block2" type="radio" name="block">Cảnh sát
                </label>
                </label>
                    <label for="block3" class="radio-inline">
                    <input value="ĐP" {{ $unit->block == "ĐP" ? "checked":"" }} id="block2" type="radio" name="block">Địa Phương
                </label>
            </div>
         </div>
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
