<div class="row">

    <div class="col-md-12">

        <div class="col-md-6">
            <div class="checkbox">
                <label class="green-yellow"><input type="checkbox"> aSize A4 (210mm x 297mm)</label><br>
                <label class="green-yellow"><input type="checkbox"> Full colour print 1side</label><br>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="checkbox">
                <label class="green-yellow"><input type="checkbox"> Free Delivery</label><br>
                <label class="green-yellow"><input type="checkbox"> 2 days turnaround time</label><br>
            </div>
        </div>
        <div class="col-sm-12" style="height: 30px;"></div>
        <div class="col-sm-6">
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
        <div class="col-sm-12" style="height: 30px;"></div>
        <div class="col-md-12">
            {!! Form::submit('GET PRICE',['id'=>'','class'=>'btn btn-primary btn-green']) !!}
            <h3 class="green-yellow" id="total">Total : $00</h3>
        </div>
    </div>
</div>

<script>
    function myFunction() {
        var x = document.getElementById("qty").value;
        var y = document.getElementById("stock").value;
        var ttl = 0;
        ttl = parseInt(x) + parseInt(y);
        document.getElementById("total").innerHTML = "Total : $" + ttl;
    }
</script>
