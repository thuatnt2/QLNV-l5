	{!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
        {!! Former::open_for_files(action('ShipController@update', $ship->id))->id('form-edit') !!}
        {{ method_field('PUT') }}
        <!-- <fieldset> -->
        <div class="col-sm-4">
            {!! Former::text('created_at', 'Ngày giao')
                ->required()
                ->addClass('input-sm daterange')
                ->value($ship->date_submit->format('d/m/Y'))
            !!}
            <div class="form-group <?php if($errors->has('phone')) echo 'has-error'?>">
                <label for="phone" class="control-label col-lg-4 col-sm-4">Số Cv - Thuê bao<sup>*</sup></label>
                <div class="col-lg-8 col-sm-8">
                    <select class="form-control input-sm" id="phone" name="phone" placeholder="Chọn thuê bao đã đăng ký">
                        <optgroup label="{{$ship->phone->order->number_cv . '/' . $ship->phone->order->unit->symbol}}">
                            <option value="{{ $ship->phone_id }}">
                                {{ $ship->phone->number }}
                            </option>
                        </optgroup>
                        @foreach($orders as $order)
                        <optgroup label="{{$order->number_cv . '/' . $order->unit->symbol}}">
                            
                            @foreach ($order->phones as $index => $phone)
                                    <option value="{{$phone->id}}">
                                        {{ $phone->number }}
                                    </option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                    <span class="help-block">
                        <?php echo $errors->first('phone') ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            {!! Former::text('page_list', 'Số trang list')->required()->value($ship->page_list)->addClass('input-sm'); !!}
            <div class="form-group required <?php if($errors->has('file')) echo 'has-error'?>">
                <label for="file" class="control-label col-lg-4 col-sm-4">File đính kèm<sup>*</sup></label>
                <div class="col-lg-8 col-sm-8" id="uploadFile">
                    <input type="text" class="form-control input-sm" name="file_name" value="{{ $ship->file_name }}">
                    <input accept="application/msword|application/vnd.openxmlformats-officedocument.wordprocessingml.document|application/vnd.ms-excel|application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|application/pdf" id="file" type="file" name="file" style="width: 0px; height: 0px; display: none;">
                    <span class="help-block">
                        <?php echo $errors->first('file') ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            {!! Former::text('receive_name', 'Người nhận')->value($ship->receive_name)->addClass('input-sm'); !!}
            {!! Former::select('user_name')->label('Người giao')->options($users, $ship->user_id)->addClass('input-sm') !!}
        </div>
        <div class="form-group">
            <div class="col-lg-offset-5 col-sm-offset-5 col-lg-8 col-sm-8">
                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-edit">&nbsp</i>Sửa</button>
                 <button type="reset" class="btn btn-default btn-sm"><i class="fa fa-refresh">&nbsp</i>Làm mới</button>
                 <button type="button" class="btn btn-danger btn-sm" onclick="hideForm()" ><i class="fa fa-reply">&nbsp</i>Hủy</button>
           </div>
        </div>     
        <!-- </fieldset> -->
        {!! Former::close() !!}
         <script>
        function hideForm() {
            $('#form-create').show();
            $('#form-edit').remove();
        }
      </script>