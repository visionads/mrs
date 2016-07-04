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
        <h3 class="green-yellow" id="total">Total : $00</h3>
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
