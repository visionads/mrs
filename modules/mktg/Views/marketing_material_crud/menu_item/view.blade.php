<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>



<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">{{$pageTitle}}</h4>
</div>


<div class="modal-body">
    <div style="padding: 10px;">
        <table id="" class="table table-hover table-striped">
            <h4 class="text-center">Marketing Menu Item</h4>

            <tr>
                <td class="col-lg-7">
                    <table class="table  table-hover table-striped" >
                        <tr>
                            <th class="col-lg-2">Title</th>
                            <td class="col-lg-2 text-center">:</td>
                            <td class="col-lg-8">{{ isset($data->title) ? $data->title:'' }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>:</td>
                            <td>{{ isset($data->slug) ? $data->slug:'' }}</td>
                        </tr>

                        <tr>
                            <th>Description</th>
                            <td>:</td>
                            <td>{{ isset($data->description) ? $data->description:'' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td>{{ isset($data->status) ? $data->status:'' }}</td>
                        </tr>
                    </table>
                </td>

                <td class="col-lg-5">
                    <table class="table table-bordered table-hover table-striped" >
                        <tr>
                            {{--<th class="col-lg-6">Image : </th>--}}
                            <td class="col-lg-6" colspan="3" style="background: #fff !important;">
                                <div>
                                    {{--<a href="{{ route('print-image-show', $data[0]['id']) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#imageView"><img src="{{ URL::to($data[0]['image_thumb']) }}" alt="{{$data[0]['image_path']}}" /></a>--}}
                                    @if(isset($data->relMktgMenuItemImage[0]['image']))
                                        <img src="{{ URL::to($data->relMktgMenuItemImage[0]['image']) }}" class="img-rounded" style="width: auto; max-width: 100%">
                                    @else
                                        <h1>No Image Available</h1>
                                    @endif
                                </div>

                                @if(isset($data->relMktgMenuItemImage))
                                    <div class="row" style="margin-top: 10px;">
                                        @foreach($data->relMktgMenuItemImage as $imgdata)
                                            <div class="col-sm-4">
                                                <img src="{{ URL::to($imgdata->image) }}" class="img-rounded" style="width: auto; max-width:100%;">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>




        </table>

        @if(count($data->relMktgItemOption)>0)

            <h4 class="text-left-header">Marketing Menu Options</h4>

            <div class="table-primary">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Slug</th>
                        <th width="100">Image</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(@$data->relMktgItemOption)
                        @foreach($data->relMktgItemOption as $values )
                            <tr class="gradeX">
                                <td>{{$values->title }}</td>
                                <td>{{$values->type }}</td>
                                <td>{{$values->slug }}</td>
                                <td>
                                    @if(isset($values->image))
                                        <img src="{{ URL::to($values->image) }}" width="80" height="60">
                                    @else
                                        <h5>No Image</h5>
                                    @endif
                                </td>
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
