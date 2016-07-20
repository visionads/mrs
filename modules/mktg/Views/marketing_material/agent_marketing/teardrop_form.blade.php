<div class="row">

    <div class="col-md-12">

        <div class="col-md-4">
            <div class="image-wrapper">
                <img src="{{ URL::to('/assets/img/tear-drop-sm.jpg') }}" class="img-responsive image-center">
            </div>
            <a role="tab" class="btn btn-green">
                <label class="radio-inline black size-13" >
                    {!! Form::radio('option','small','true',['id'=>'']) !!}
                    SMALL (830mm x 2175mm)
                </label>
            </a>
        </div>
        <div class="col-md-4">
            <div class="image-wrapper">
                <img src="{{ URL::to('/assets/img/tear-drop-mid.jpg') }}" class="img-responsive image-center">
            </div>
            <a role="tab" class="btn btn-green">
                <label class="radio-inline black size-13" >
                    {!! Form::radio('option','medium','',['id'=>'']) !!}
                    MEDIUM (885mm x 3500mm)
                </label>
            </a>
        </div>
        <div class="col-md-4">
            <div class="image-wrapper">
                <img src="{{ URL::to('/assets/img/tear-drop.jpg') }}" class="img-responsive image-center">
            </div>
            <a role="tab" class="btn btn-green">
                <label class="radio-inline black size-13" >
                    {!! Form::radio('option','large','',['id'=>'']) !!}
                    LARGE (1245mm x 4560mm)
                </label>
            </a>

        </div>

        <div class="col-sm-12" style="height: 30px;"></div>

        <div class="col-md-6">
            <div style="border-left: 2px dashed #909000;">
                <div class="form-group">
                    {!! Form::label('qty', 'Quantity:', ['class'=>'control-label col-sm-4 green-yellow']) !!}
                    <div class="col-sm-8">
                        {!! Form::select('qty', array('00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06'),Input::old('qty'),['class' => 'form-control deeppink size-15','id'=>'', 'onchange'=>'myFunction()','required']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12" style="height: 30px;"></div>

        <div class="col-md-12">
            Do you need Artwork ?
            {{--<a href=" #place" class="btn btn-green " id="proceed">Yes <span class="glyphicon glyphicon-chevron-down"></span></a> &nbsp; &nbsp;--}}
            <label class="radio-inline green-yellow" >
                {!! Form::radio('art','no','true',['id'=>'no']) !!}
                No
            </label>
            <label class="radio-inline green-yellow" >
                {!! Form::radio('art','yes','',['id'=>'yes']) !!}
                Yes
            </label>

        </div>

        <div class="col-sm-12" style="height: 30px;"></div>

        {{--Artwork Form Start--}}
        <a name="place">&nbsp;</a>
        <div class="col-md-12" id="place_order">
            <div class="row">
                <div class="green-yellow">
                    <hr>
                    <h2>Artwork</h2>
                    Please select one of the options:
                </div>
                <div>
                    @if(isset($artwork))
                        @foreach($artwork as $artitem)
                            <div class="col-md-6">
                                <?php
                                $type_id = '';
                                if($artitem->field_type == 'description'){ $type_id = "btn_req";}
                                if($artitem->field_type == 'file'){ $type_id = "btn_upload";}
                                ?>
                                <label class="radio-inline green-yellow size-13" id="{{ $type_id }}" >
                                    {!! Form::radio('check',$artitem->price,'',['id'=>$artitem->slug]) !!}
                                    {{ $artitem->title }}
                                    @if($artitem->field_type == 'description')
                                        <div id="txt_req">
                                            {!! Form::textarea('note', Input::old('note'),['class' => 'form-control text-left','rows'=>'10','placeholder'=>'CHANGES REQ UIRED DETAILS ONLY']) !!}
                                        </div>
                                    @elseif($artitem->field_type == 'file')
                                        <div id="file_upload">
                                            {!! Form::file('file','',['class'=>'form-control']) !!}
                                        </div>
                                    @endif
                                </label><br><br>
                            </div>
                        @endforeach
                    @endif
                    <div class="col-md-12">
                        {{--{!! Form::submit('Order',['class'=>'btn btn-green pull-right']) !!}--}}
                        {{--<button class="btn btn-green pull-right" type="button" id="order">Order <span class="glyphicon glyphicon-chevron-right"></span></button>--}}
                    </div>
                </div>
            </div>
        </div>
        {{--Artwork Form End--}}

        <div class="col-sm-12" style="height: 30px;"></div>

        <div class="col-md-12">
            {!! Form::submit('GET PRICE',['id'=>'','class'=>'btn btn-primary btn-green']) !!}
            <h3 class="green-yellow" id="total">Total : $00</h3>
        </div>
    </div>
</div>
