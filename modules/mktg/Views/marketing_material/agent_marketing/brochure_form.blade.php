<div class="row">

    <div class="col-md-12">

        <div class="col-md-6">
            <div class="checkbox">
                <label class="green-yellow"><input name="size" type="checkbox" checked onclick="return false" > Range of sizes </label><br>
                <label class="green-yellow"><input name="fullcolor" type="checkbox" checked onclick="return false" > Full colour print 2 side</label><br>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="checkbox">
                <label class="green-yellow"><input name="delivery" type="checkbox" checked onclick="return false"> Free Delivery</label><br>
                <label class="green-yellow"><input name="ttime" type="checkbox" checked onclick="return false"> 2 days turnaround time</label><br>
            </div>
        </div>
        <div class="col-sm-12" style="height: 30px;"></div>
        <div class="col-md-9">
            <div style="border-left: 2px dashed #909000;">
                <div class="form-group">
                    {!! Form::label('product', 'Product :', ['class'=>'control-label col-sm-4 green-yellow']) !!}
                    <div class="col-sm-8">
                        {!! Form::select('product', array('00'=>'Select','a4_folded_to_dl'=>'A4 folded to DL','a4'=>'A4','a5'=>'A5','a6'=>'A6','dl'=>'DL'),Input::old('product'),['class' => 'form-control deeppink size-15','id'=>'qty', 'onchange'=>'myFunction()','required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('qty', 'Quantity:', ['class'=>'control-label col-sm-4 green-yellow']) !!}
                    <div class="col-sm-8">
                        {!! Form::select('qty', array('00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06'),Input::old('qty'),['class' => 'form-control deeppink size-15','id'=>'', 'onchange'=>'myFunction()','required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('printed_sides', 'Printed sides:', ['class'=>'control-label col-sm-4 green-yellow']) !!}
                    <div class="col-sm-8">
                        {!! Form::select('printed_sides', array('90x55'=>'90 x 55','90x50'=>'90 x 50','86x45'=>'86 x 45'),Input::old('printed_sides'),['class' => 'form-control deeppink size-15','id'=>'', 'onchange'=>'myFunction()','required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('stock', 'Stock:', ['class'=>'control-label col-sm-4 green-yellow']) !!}
                    <div class="col-sm-8">
                        {!! Form::select('stock', array('0'=>'Select','128gsm_gloss'=>'128gsm gloss','150gsm_gloss'=>'150gsm gloss','170gsm'=>'170gsm','250gsm'=>'250gsm'),Input::old('stock'),['class' => 'form-control deeppink size-15','id'=>'', 'onchange'=>'myFunction()','required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('Stock_finish', 'Stock Finish :', ['class'=>'control-label col-sm-4 green-yellow']) !!}
                    <div class="col-sm-8">
                        {!! Form::select('Stock_finish', array('0'=>'Select','silk'=>'Silk','gloss'=>'Gloss'),Input::old('Stock_finish'),['class' => 'form-control deeppink  size-15','id'=>'', 'onchange'=>'myFunction()','required']) !!}
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
                    <div class="col-md-6">
                        <label class="radio-inline green-yellow size-13" >
                            {!! Form::radio('check','check1','',['id'=>'check1']) !!}
                            Use existing file (RE ORDER NO CHANGES)
                        </label><br><br>
                        <label class="radio-inline green-yellow size-13" id="btn_req">
                            {!! Form::radio('check','check3','',['id'=>'check3']) !!}
                            Use existing file (CHANGES REQ UIRED DETAILS ONLY) Please write below the changes, eg Name: John Smith, Phone 0234565...
                            <div id="txt_req">
                                {!! Form::textarea('note', Input::old('note'),['class' => 'form-control text-left','rows'=>'10','placeholder'=>'CHANGES REQ UIRED DETAILS ONLY']) !!}
                            </div>
                        </label><br><br>
                        <label class="radio-inline green-yellow size-13">
                            {!! Form::radio('check','check5','',['id'=>'check5']) !!}
                            Artwork and design required (one of our friendly graphics designers will be in touch with you)
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="radio-inline green-yellow size-13" id="btn_upload">
                            {!! Form::radio('check','check2','',['id'=>'check2']) !!}
                            Upload Artwork (file)
                            <div id="file_upload">
                                {!! Form::file('file','',['class'=>'form-control']) !!}
                            </div>
                        </label><br><br>
                        <label class="radio-inline green-yellow size-13">
                            {!! Form::radio('check', 'check4','',['id'=>'check4']) !!}
                            Use existing file (CHANGES REQ UIRED DETAILS ONLY) Please write below the changes, eg Name: John Smith, Phone 0234565...
                        </label>
                    </div>
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
