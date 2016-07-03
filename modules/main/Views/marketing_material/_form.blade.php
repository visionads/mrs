{{--<div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
    <div class="row">
        <div class="col-sm-12">
            {!! Form::label('quantity', 'Quantity :', ['class' => 'control-label']) !!}
            <small class="required">(Required)</small>
            --}}{{--{!! Form::text('username',Input::old('username'),['class' => 'form-control','placeholder'=>'User Name','required','autofocus', 'title'=>'Enter User Name']) !!}--}}{{--
            {!!  Form::select('quantity', ['1', '2', '3','4','5'],['class' => 'form-control','placeholder'=>'User Name','required']) !!}
            <br>
            {!! Form::label('stock', 'Stock :', ['class' => 'control-label']) !!}
            <small class="required">(Required)</small>
            {!!  Form::select('stock', ['1', '2', '3','4','5'],['class' => 'form-control','placeholder'=>'User Name','required']) !!}
        </div>
    </div>
</div>
<div class="form-margin-btn">
    {!! Form::submit('Save changes', ['id'=>'btn-disabled','class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
    <a href="{{route('user-list')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
</div>--}}
<div class="row">
    <div class="col-md-6">
        <label class="green-yellow">Quantity : </label>
        <select class="deeppink select-inpt size-15" id="qty" onchange="myFunction()">
            <option>0</option>
            <option>01</option>
            <option>02</option>
            <option>03</option>
            <option>04</option>
            <option>05</option>
            <option>06</option>
            <option>07</option>
        </select>

        <label class="green-yellow">Stock : </label>
        <select class="deeppink select-inpt size-15" id="stock" onchange="myFunction()" >
            <option>0</option>
            <option>01</option>
            <option>02</option>
            <option>03</option>
            <option>04</option>
            <option>05</option>
            <option>06</option>
            <option>07</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h3 class="green-yellow" id="total">Total : $100</h3>
    </div>
</div>
<script>
    function myFunction() {
        var x = document.getElementById("qty").value;
        var y = document.getElementById("stock").value;
        var ttl = 0;
        ttl = parseInt(x+y);
        document.getElementById("total").innerHTML = "Total : $" + ttl;
    }
</script>
