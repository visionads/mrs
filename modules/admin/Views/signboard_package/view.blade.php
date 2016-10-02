{{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>--}}



<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">{{$pageTitle}}</h4>
</div>


<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <table id="" class="table table-bordered table-hover table-striped">
                <h4 class="text-center">Signboard Package</h4>
                <tr>
                    <th class="col-lg-2">Title</th>
                    <td class="col-lg-4">{{ isset($data->title)?$data->title:''}}</td>
                </tr>
                <tr>
                    <th class="col-lg-2">Price</th>
                    <td class="col-lg-4">{{ isset($data->price)?$data->price:''}}</td>
                </tr>
                <tr>
                    <th class="col-lg-2">Description</th>
                    <td class="col-lg-4">{{ isset($data->description)?$data->description:''}}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <a href="{{ route('signboard-image-show', $data->id) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#imageView"><img src="{{ URL::to($data->image_thumb) }}" alt="{{$data->image_path}}" /></a>
        </div>
    </div>
</div>




<div class="modal-footer">
    <a href="{{ URL::previous()}}" class="btn btn-default" type="button" data-placement="top" data-content="click close button for close this entry form" onclick="close_modal();"> Close </a>
</div>



<script>
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

    function close_modal(){
        document.getElementById('etsbModal').style.visibility="hidden";
        document.getElementById('load').style.visibility="visible";
    }

</script>
