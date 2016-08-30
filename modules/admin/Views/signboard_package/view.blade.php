{{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>--}}



<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">{{$pageTitle}}</h4>
</div>


<div class="modal-body">
    <div style="padding: 10px;">
        <table id="" class="table table-bordered table-hover table-striped">
            <h4 class="text-center">Signboard Package</h4>
            <tr>
                <th class="col-lg-2">Title</th>
                <td class="col-lg-4">{{ isset($data[0]['title'])?$data[0]['title']:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-2">Price</th>
                <td class="col-lg-4">{{ isset($data[0]['price'])?$data[0]['price']:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-2">Description</th>
                <td class="col-lg-4">{{ isset($data[0]['description'])?$data[0]['description']:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Image</th>
                <td>
                    <div>
                        <a href="{{ route('signboard-image-show', $data[0]['id']) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#imageView"><img src="{{ URL::to($data[0]['image_thumb']) }}" alt="{{$data[0]['image_path']}}" />
                        </a>
                    </div>
                </td>
            </tr>
        </table>

        @if(count($data[0]['relSignboardPackage'])>0)

            <h4 class="text-center-header">Sizes</h4>

            <div class="table-primary">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                    <thead>
                    <tr>
                        <th>Title:</th>
                        <th>Price:</th>
                        <th>Description:</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(@$data[0]['relSignboardPackage'])
                        @foreach($data[0]['relSignboardPackage'] as $values )
                            <tr class="gradeX">
                                <td>{{$values['title']}}</td>
                                <td>{{$values['price']}}</td>
                                <td>{{$values['description']}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        @endif
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
