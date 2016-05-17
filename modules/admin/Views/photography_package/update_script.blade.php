<script>


    $(document).on("focus",'#update-table tr:last-child td:last-child',function(e) {

        e.preventDefault();
        var coa_name = $('#update-table tr:last-child td:first-child input').val();
        if(coa_name != "")
        {
            //append the new row here.
            var table = $("#update-table");
            var element = '<tr>\
            <td>\
            <div>{!! Form::text('items[]', Input::old('items'), ['title'=>'enter items', 'class' => 'form-control']) !!}</div>\
            </td>\
            <td>\
            <div>{!! Form::text('description[]', Input::old('description'), ['title'=>'enter description', 'class' => 'form-control']) !!}</div>\
            </td>\
            </tr>';
            table.append(element);
        }
    });




    $(".btn").popover({ trigger: "manual" , html: true, animation:false})
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


    $(".form-control").tooltip();
    $('input:disabled, button:disabled').after(function (e) {
        d = $("<div>");
        i = $(this);
        d.css({
            height: i.outerHeight(),
            width: i.outerWidth(),
            position: "absolute",
        })
        d.css(i.offset());
        d.attr("title", i.attr("title"));
        d.tooltip();
        return d;
    });

</script>