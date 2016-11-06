<script>
    //=== For Packages (Yes/No)
    $(document).ready(function(){
        <?php if(!isset($data['quote'])){ ?>
        $(".dflt_packs").hide();
        $(".photography").hide();
        $(".pack-choise").hide();
        <?php } ?>
        $(".choose1").click(function(){
            $(".pack-choise").slideUp();
            $(".dflt_packs").slideDown();
            $(".photography").slideDown();
        });
        $(".choose0").click(function(){
            $(".pack-choise").slideDown();
            $(".dflt_packs").slideUp();
            $(".photography").slideDown();
        });
    });

    $(function(){
        $('.yesBtn').click(function(){
            $(this).parent().parent().parent().parent().find('.optionalContentDiv').removeClass('optional-content-div');
        });
        $('.noBtn').click(function(){
            $(this).parent().parent().parent().parent().find('.optionalContentDiv').addClass('optional-content-div');
        });
        $('.yesBtnP').click(function(){
            $(this).parent().parent().parent().parent().find('.optionalContentDiv').removeClass('optional-content-div');
            $(this).parent().parent().parent().parent().find('#pImage').addClass('optional-content-div');
        });
        $('.noBtnP').click(function(){
            $(this).parent().parent().parent().parent().find('.optionalContentDiv').addClass('optional-content-div');
            $(this).parent().parent().parent().parent().find('#pImage').removeClass('optional-content-div');
        });

        /*$('.local_media_option_id').click(function(){
//                val value=$(this).parent().addclass('xxx');
//            alert(value);
            }

        });*/

        $('.proceedBtn').click(function(){
            $('.alert').remove();

            /*
            * photography package validation start
            * */
            var value=$("input[name='pro-photographyChooseBtn']:checked").val();
            if (value==1){
                var photography_package_id=$(".photography_package_id:checked").val();

//                console.log(photography_package_id);
                if(photography_package_id==undefined)
                {
                    $('.validationErrorPhotographyPackage').append('<div class="alert alert-danger">Please choose any photography package</div>');
                    return false;
                }
            }else{
                $(this).removeClass('input-error');
            }

            /*
             * photography package validation end
             * */


            /*
            * signboard package validation start
            * */
            var value=$("input[name='signboardChooseBtn']:checked").val();
//            alert(value);
            if (value==1){
                var signboard_package_id=$(".signboard_package_id:checked").val();
                if(signboard_package_id==undefined)
                {
                    $('.validationErrorSignboardPackage').append('<div class="alert alert-danger">Please choose any signboard package</div>');
                    return false;
                }
            }else{
                $(this).removeClass('input-error');
            }

            /*
             * signboard package validation end
             * */


            /*
            * print material package validation start
            * */

            var value=$("input[name='printMaterialChooseBtn']:checked").val();
            if (value==1){
                var print_material_package_id=$(".print_material_id:checked").val();

                if(print_material_package_id==undefined)
                {
                    $('.validationErrorPrintMaterial').append('<div class="alert alert-danger">Please choose any print material</div>');
                    return false;
                }
            }else{
                $(this).removeClass('input-error');
            }



            /*
             * print material package validation end
             *
            * distribution print material package validation start
            * */

            var value=$("input[name='distributedPrintMaterialChooseBtn']:checked").val();
            if (value==1){
                var distributed_print_material_package_id=$('.quantity').val();
                if(distributed_print_material_package_id=='select')
                {
                    $('.validationErrorDistributionPrintMaterial').append('<div class="alert alert-danger">Please select any quantity</div>');
                    return false;
                }
            }


            /*
             * print material package validation end
             *
            * distribution print material package validation start
            * */

            var value=$("input[name='distributedPrintMaterialChooseBtn']:checked").val();
            if (value==1){
                var distributed_print_material_package_id=$('.quantity').val();
                if(distributed_print_material_package_id=='select')
                {
                    $('.validationErrorDistributionPrintMaterial').append('<div class="alert alert-danger">Please select any quantity</div>');
                    return false;
                }
            }


            /*
            *
            * distribution print material package validation end
            *
            * digital media validation start
            *
            * */


            var value=$("input[name='digitalMediaChooseBtn']:checked").val();
            if (value==1){
                var digital_media_id=$(".digital_media_id:checked").val();
                if(digital_media_id==undefined)
                {
                    $('.validationErrorDigitalMedia').append('<div class="alert alert-danger">Please choose any digital media</div>');
                    return false;
                }
            }


            /*
            *
            * digital media validation end
            *
            * local media validation start
            *
            * */

/*
            var value=$("input[name='digitalMediaChooseBtn']:checked").val();
            if (value==1){
                var digital_media_id=$(".digital_media_id:checked").val();
                if(digital_media_id==undefined)
                {
                    $('.validationErrorDigitalMedia').append('<div class="alert alert-danger">Please choose any digital media</div>');
                    return false;
                }
            }*/


            var value=$("input[name='localMediaChooseBtn']:checked").val();
            if (value==1){
                var local_media_id=$(".local_media_id:checked").val();
                if(local_media_id==undefined)
                {
                    $('.validationErrorLocalMedia').append('<div class="alert alert-danger">Please choose any local newsprint media</div>');
                    return false;
                }else{
                    var local_media_option_id=$(".local_media_option_id:checked").val();
                    if(local_media_option_id==undefined)
                    {
                        $('.validationErrorLocalMedia').append('<div class="alert alert-danger">Please choose any local newsprint media options</div>');
                        return false;
                    }

                }
            }

        });
        $('#distributionQuantity').change(function () {
            var quantity= $(this).val();
            if(quantity != ''){
                $('.keep_hide').slideDown();
            }
            var minQuantity=7000;
            if(quantity>7000)
            {
                var restQuantity=quantity-7000;
            }else{
                var minQuantity= quantity;
            }
            $('#minQuantity').val(minQuantity);
            $('#restQuantity').val(restQuantity);
            distributionPrice();

        });
        $('#minQuantity').change(function () {
            var quantity= $('#distributionQuantity').val();
            var minQuantity= $(this).val();
            if(parseInt(minQuantity) <= parseInt(quantity))
            {
                $('#restQuantity').val(quantity-minQuantity);
                distributionPrice();
            }else{
                if(parseInt(quantity) > 7000)
                {
                    $('#minQuantity').val(7000);
                    $('#restQuantity').val(quantity-7000);
                }else{
                    $('#minQuantity').val(quantity);
                    $('#restQuantity').val('');
                }
                alert('You can\'t input bigger value then  main quantity.');
            }
        });
        function distributionPrice() {
            $('#disPrice').remove();
            var quantity= $('#minQuantity').val();
            var total= (quantity*65)/1000;
            $('price').append('<b id="disPrice">$ '+total+'</b>');
            $('#distributionPrice').val(total);

            /* ====== For Quote Summary ============ */
            var ttlprice = $('#ttlprice').val();

            var totalCost = parseInt(ttlprice) + parseInt(total);
            var newgst = totalCost * 0.1;
            var newTotal = parseInt(totalCost) + parseInt(newgst);
            //alert(totalCost);
            $('.dist_price_in_summary').empty().append(total.toFixed(2));

            $('.totalToScript').empty().append(totalCost.toFixed(2));
            $('.newgst').empty().append(newgst);
            $('.newtotal').empty().append(newTotal.toFixed(2));
        }

    });
</script>