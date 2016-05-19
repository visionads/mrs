
<script type="text/javascript">
    // For Form Stepping
    $(document).ready(function(){
        //$(".steptow").fadeOut();
        $("#next_step").click(function(){
            $(".step-two").fadeIn();
            $(".step-one").fadeOut();
            $(".step-three").fadeOut();
            $(".step-no-submit").fadeOut();
            //$(".test-form-one").fadeIn();
        });
        $("#back_to_first").click(function(){
            $(".step-one").fadeIn();
            $(".step-two").fadeOut();
            $(".step-three").fadeOut();
            $(".step-no-submit").fadeOut();
        });
        $("#last_step").click(function(){
            $(".step-three").fadeIn();
            $(".step-two").fadeOut();
            //$(".step-one").fadeIn();
            $(".step-no-submit").fadeIn();
        });
        $("#step-no").click(function(){
            $(".step-three").fadeOut();
            $(".step-two").fadeOut();
            $(".step-one").fadeIn();
            //$("#next_step").fadeOut();
            $(".step-no-submit").fadeIn();
        });


        $(".agreement").hide();
        $(".proceed-to-confirm").click(function(){
           $(".agreement").fadeIn();
        });

    });

    // tooltip for buttons
    $(".btn").popover({ trigger: "manual" , html: true, animation:true})
        .on("mouseenter", function () {
            var _this = this;
            $(this).popover("show");
            $(".popover").on("mouseleave", function () {
                $(_this).popover('hide');
            });
        }).on("mouseleave", function () {
        var _this = this;
        setTimeout(function () {
            if (!$(".popover:hover").length) {
                $(_this).popover("hide");
            }
        }, 300);
    });
    // tooltip for input field
    $(".form-control").tooltip();


</script>