<script>
    $(function(){
        $('.yesBtn').click(function(){
            $(this).parent().parent().parent().parent().find('.optionalContentDiv').removeClass('optional-content-div');
        });
        $('.noBtn').click(function(){
            $(this).parent().parent().parent().parent().find('.optionalContentDiv').addClass('optional-content-div');
        });
        $('#solutionTypeNextBtn').click(function(){
            $('.alert').remove();
            var parent_fieldset = $(this).parents('fieldset');
            var next_step = true;
            $value=$("input[name='solutions_type_id']:checked").val();
            if ($value!=undefined) {
                $(this).removeClass('input-error');
                parent_fieldset.fadeOut(400, function() {
                    $(this).next().fadeIn();
                });
            }else{
                $('.validationError').append('<div class="alert alert-danger">Please Check any option.</div>');
                $(this).addClass('input-error');
            }
        });
        $('#propertyDetailsNextBtn').click(function(){
            $('.alert').remove();
            var parent_fieldset = $(this).parents('fieldset');
            //console.log(parent_fieldset);
            var next_step = true;

            parent_fieldset.find('input[name="owner_name"],input[name="vendor_email"]').each(function() {
            	if( $(this).val() == "" ) {
            		$('input[name="owner_name"]').addClass('input-error');
            		$(this).addClass('input-error');
            		next_step = false;
            	}
            	else {
            		$(this).removeClass('input-error');
            	}
            });

            if( next_step ) {
                parent_fieldset.fadeOut(400, function() {
                    $(this).next().fadeIn();
                });
            }
        });
        $('#photographyNextBtn').click(function(){
            $('.alert').remove();
            var parent_fieldset = $(this).parents('fieldset');
            var next_step = true;
            var value=$("input[name='pro-photographyChooseBtn']:checked").val();
            if(value==undefined){
                $('.validationError').append('<div class="alert alert-danger">Please Check Yes/No.</div>');
                next_step= false;
            }
            if (value==1){
                var photography_package_id=$("input[name='photography_package_id']:checked").val();

                if(photography_package_id==undefined)
                {
                    $('.validationError').append('<div class="alert alert-danger">Please check any package</div>');
                    next_step= false;
                }
            }else{
                $(this).removeClass('input-error');
            }


            if( next_step ) {
                parent_fieldset.fadeOut(400, function() {
                    $(this).next().fadeIn();
                });
            }
        });
        $('#signboardNextBtn').click(function(){
            $('.alert').remove();
            var parent_fieldset = $(this).parents('fieldset');
            var next_step = true;
            var value=$("input[name='signboardChooseBtn']:checked").val();
//            alert(value);
            if(value==undefined){
                $('.validationError').append('<div class="alert alert-danger">Please Check Yes/No.</div>');
                next_step= false;
            }
            if (value==1){
                var signboard_package_id=$("input[name='signboard_package_id']:checked").val();

                if(signboard_package_id==undefined)
                {
                    $('.validationError').append('<div class="alert alert-danger">Please check any package</div>');
                    next_step= false;
                }
            }else{
                $(this).removeClass('input-error');
            }


            if( next_step ) {
                parent_fieldset.fadeOut(400, function() {
                    $(this).next().fadeIn();
                });
            }
        });
        $('#printMaterialNextBtn').click(function(){
            $('.alert').remove();
            var parent_fieldset = $(this).parents('fieldset');
            var next_step = true;
            var value=$("input[name='printMaterialChooseBtn']:checked").val();
            if(value==undefined){
                $('.validationError').append('<div class="alert alert-danger">Please Check Yes/No.</div>');
                next_step= false;
            }
            if (value==1){
                var print_material_package_id=$("input[name='print_material_id']:checked").val();

                if(print_material_package_id==undefined)
                {
                    $('.validationError').append('<div class="alert alert-danger">Please check any package</div>');
                    next_step= false;
                }
            }else{
                $(this).removeClass('input-error');
            }


            if( next_step ) {
                parent_fieldset.fadeOut(400, function() {
                    $(this).next().fadeIn();
                });
            }
        });
        $('#distributedPrintMaterialNextBtn').click(function(){
            $('.alert').remove();
            var parent_fieldset = $(this).parents('fieldset');
            var next_step = true;
            var value=$("input[name='distributedPrintMaterialChooseBtn']:checked").val();
            if(value==undefined){
                $('.validationError').append('<div class="alert alert-danger">Please Check Yes/No.</div>');
                next_step= false;
            }
            if (value==1){
                var distributed_print_material_package_id=$('#quantity').val();
                if(distributed_print_material_package_id=='select')
                {
                    $('.validationError').append('<div class="alert alert-danger">Please select any quantity</div>');
                    next_step= false;
                }
            }


            if( next_step ) {
                parent_fieldset.fadeOut(400, function() {
                    $(this).next().fadeIn();
                });
            }
        });
        $('#digitalMediaNextBtn').click(function(){
            $('.alert').remove();
            var parent_fieldset = $(this).parents('fieldset');
            var next_step = true;
            var value=$("input[name='digitalMediaChooseBtn']:checked").val();
            if(value==undefined){
                $('.validationError').append('<div class="alert alert-danger">Please Check Yes/No.</div>');
                next_step= false;
            }
            if (value==1){
                var digital_media_id=$("input[name='digital_media_id']:checked").val();
                if(digital_media_id==undefined)
                {
                    $('.validationError').append('<div class="alert alert-danger">Please check any package</div>');
                    next_step= false;
                }
            }


            if( next_step ) {
                parent_fieldset.fadeOut(400, function() {
                    $(this).next().fadeIn();
                });
            }
        });
        $('#localMediaNextBtn').click(function(){
            $('.alert').remove();
            var parent_fieldset = $(this).parents('fieldset');
            var next_step = true;
            var value=$("input[name='localMediaChooseBtn']:checked").val();
            if(value==undefined){
                $('.validationError').append('<div class="alert alert-danger">Please Check Yes/No.</div>');
                next_step= false;
            }
            if (value==1){
                var local_media_id=$("input[name='local_media_id']:checked").val();
                if(local_media_id==undefined)
                {
                    $('.validationError').append('<div class="alert alert-danger">Please check any package</div>');
                    next_step= false;
                }
            }


            if( next_step ) {
                parent_fieldset.fadeOut(400, function() {
                    $(this).next().fadeIn();
                });
            }
        });
        $('.proceedBtnN').click(function(){
            $('.alert').remove();
            var parent_fieldset = $(this).parents('fieldset');
            var next_step = true;
            var value=$("input[name='localMediaChooseBtn']:checked").val();
            if(value==undefined){
                $('.validationError').append('<div class="alert alert-danger">Please Check Yes/No.</div>');
                next_step= false;
            }
            if (value==1){
                var local_media_id=$("input[name='local_media_id']:checked").val();
                if(local_media_id==undefined)
                {
                    $('.validationError').append('<div class="alert alert-danger">Please check any package</div>');
                    next_step= false;
                }
            }


            if( next_step ) {
                parent_fieldset.fadeOut(400, function() {
                    $(this).next().fadeIn();
                });
            }
        });
    });
</script>