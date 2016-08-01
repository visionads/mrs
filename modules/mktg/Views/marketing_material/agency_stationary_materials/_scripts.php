<script>
    //===== For Form Select Options
    /*function myFunction() {
        var x = document.getElementById("qty").value;
        var y = document.getElementById("stock").value;
        var ttl = 0;
        ttl = parseInt(x) + parseInt(y);
        document.getElementById("total").innerHTML = "Total : $" + ttl;
    }*/

    $(document).ready(function(){

        //===== For Main
        $("#place_order").hide();
        /*$("#proceed").click(function(){
         $("#place_order").fadeIn();
         });*/
        $("#no").click(function(){
            $("#place_order").fadeOut();
        });
        $("#yes").click(function(){
            $("#place_order").fadeIn();
        });

        //===== For Secondary ( Text area)
        $("#txt_req").hide();
        $("#btn_req").click(function() {
            $("#txt_req").slideDown();
            $("#file_upload").slideUp();
        });

        //===== For Secondary ( Upload Artwork)
        $("#file_upload").hide();
        $("#btn_upload").click(function(){
            $("#file_upload").slideDown();
            $("#txt_req").slideUp();
        });

        //===== For Secondary ( General )
        $("#check1,#check4,#check5").click(function(){
            $("#file_upload,#txt_req").slideUp();
        });
    });
</script>