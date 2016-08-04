<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>



<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">{{$pageTitle}}</h4>
</div>


<div class="modal-body">
    <div style="padding: 10px;">
        <table id="" class="table table-bordered table-hover table-striped">
            <h4 class="text-center">Package</h4>
            <tr>
                <th class="col-lg-2">Title</th>
                <td class="col-lg-4">{{ isset($data[0]['title'])?$data[0]['title']:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-2">Slug</th>
                <td class="col-lg-4">{{ isset($data[0]['slug'])?$data[0]['slug']:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-2">Price</th>
                <td class="col-lg-4">{{ isset($data[0]['price'])?number_format($data[0]['price'],2):''}}</td>
            </tr>
            <tr>
                <th class="col-lg-2">Status</th>
                <td class="col-lg-4">{{ isset($data[0]['status'])?$data[0]['status']:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Image</th>
                <td>
                    <div>
                        <a href="{{ route('package-image-show', $data[0]['id']) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#imageView">
                            <img src="{{ URL::to($data[0]['image_thumb']) }}" alt="{{$data[0]['image_path']}}" class="img-responsive" >
                        </a>
                    </div>
                </td>
            </tr>
        </table>

        @if(count($data[0]['relPackageOption'])>0)

            <h4 class="text-left-header">{{ $pageTitleOptions }}</h4>

            <div class="table-primary">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                    <thead>
                    <tr>
                        <th>Title:</th>
                        <th>Price:</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(@$data[0]['relPackageOption'])
                        @foreach($data[0]['relPackageOption'] as $values )
                            <tr class="gradeX">
                                <td>{{$values['title']}}</td>
                                <td>{{number_format($values['price'],2)}}</td>
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
