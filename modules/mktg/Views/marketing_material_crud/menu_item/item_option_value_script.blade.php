<style>
    table tr td{
        padding-right: 0;
        padding-left: 0;
        padding: -3px;
    }
    table tr td input, table tr td select{
        width: 100%;
        padding: 2px;
    }
    .form-group{
        margin-bottom: 0px;
    }
    .form-group input, .form-group select, .form-group textarea{
        width: 100%;
        padding: 2px;
    }
    .ui-autocomplete {
        position: relative;
        left: 117px !important;
        top: -250px !important;
    }
</style>



<script>


    $(document).on("focus",'#table tr:last-child td:last-child',function(e) {

        e.preventDefault();
        var coa_name = $('#table tr:last-child td:first-child input').val();
        if(coa_name != "")
        {
            //append the new row here.
            var table = $("#table");
            var element = '<tr>\
                <td>\
                    {!! Form::text('title[]', null, ['title'=>'enter title', 'class' => 'form-control']) !!}\
                </td>\
                <td>\
                    {!! Form::text('price[]', null, ['title'=>'enter Price', 'class' => 'form-control']) !!}\
                </td>\
                <td>\
                    <div>{!! Form::select('status[]',array('open'=>'Open','close'=>'Close'), Input::old('status'), ['title'=>'Enter Status', 'class' => 'form-control']) !!}</div>\
                </td>\
            </tr>';
            table.append(element);
        }
    });

    $(document).on("focus",'#table_edit tr:last-child td:last-child',function(e) {

        e.preventDefault();
        var coa_name = $('#table_edit tr:last-child td:first-child input').val();
        if(coa_name != "")
        {
            //append the new row here.
            var table = $("#table_edit");
            var element = '<tr>\
                <td>\
                    {!! Form::text('title[]', Input::old('title'), ['title'=>'enter title', 'class' => 'form-control']) !!}\
                </td>\
                <td>\
                    {!! Form::text('price[]', Input::old('price'), ['title'=>'enter Price', 'class' => 'form-control']) !!}\
                </td>\
                <td>\
                    <div>{!! Form::select('status[]',array(''=>'Select','open'=>'Open','close'=>'Close'), Input::old('status'), ['title'=>'Enter Status', 'class' => 'form-control']) !!}</div>\
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