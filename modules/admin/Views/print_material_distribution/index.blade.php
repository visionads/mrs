@extends('admin::layouts.master');
@section('content')

        <!-- page start-->


        <div class="row">
                <div class="col-sm-12">
                        <div class="panel">
                                <div class="panel-heading gray-bg">
                                        <span class="panel-title">{{ $pageTitle }}</span>

                                        <a class="btn btn-primary btn-sm pull-right pop" data-toggle="modal" href="#addData" data-placement="left" data-content="click to add new Material">
                                           <strong><span class="glyphicon glyphicon-plus"></span> Add New Material</strong>
                                        </a>
                                </div>

                                <div class="panel-body">
                                        <!--Search Form-->
                                        <div class="">
                                            {!! Form::open(['method'=>'GET','route'=>'print-material-distribution-search','class'=>'form-inline']) !!}

                                                {!! Form::text('quantity', @Input::get('quantity')?Input::get('quantity') : null,['title'=>'Type Quantity','class' => 'form-control text-left','placeholder'=>'quantity']) !!}
                                                {!! Form::select('is_surrounded', array(''=>'Select surrounded status','1'=>'Yes','2'=>'No') ,@Input::get('is_surrounded')?Input::get('is_surrounded'):null,['title'=>'Surrounded Status','class' => 'form-control text-left']) !!}
                                                {!! Form::text('date_of_distribution', Input::old('date_of_distribution'),['title'=>'Date Of distribution','class' => 'form-control text-left','placeholder'=>'Date of distribution']) !!}
                                                {!! Form::submit('Search', ['class' => 'btn btn-primary btn-sm','data-placement'=>'top','data-content'=>'click to Search']) !!}

                                            {!! Form::close() !!}
                                        </div>
                                        <!-- Search Form End -->

                                        <!-- Table -->
                                        <div class="table-primary">
                                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered size-13" id="example">
                                                        <thead>
                                                        <tr class="bg-primary">
                                                                <th>Quantity</th>
                                                                <th>Surrounded Status</th>
                                                                <th>Other Address</th>
                                                                <th>Date of Distribution</th>
                                                                <th>Note</th>
                                                                <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        @if(isset($data))
                                                                @foreach($data as $row)
                                                                <tr class="gradeX">
                                                                <td>{{ $row->quantity }}</td>
                                                                <td> @if($row->is_surrounded==1) <span class="glyphicon glyphicon-ok text-success"></span> {{ 'Yes' }} @else <span class="glyphicon glyphicon-remove text-danger"></span> {{ 'No' }} @endif  </td>
                                                                <td>{{ $row->other_address }}</td>
                                                                <td>{{ $row->date_of_distribution }}</td>
                                                                <td>{{ $row->note }}</td>
                                                                <td>
                                                                        <a href="{{ route('print-material-distribution-view', $row->id ) }}" class="btn btn-info btn-sm" data-placement="top" data-toggle="modal" data-target="#etsbModal" data-content="view"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                                        <a href="{{ route('print-material-distribution-edit', $row->id ) }}" class="btn btn-primary btn-sm" data-placement="top" data-toggle="modal" data-target="#etsbModal" data-content="update"><i class="glyphicon glyphicon-edit"></i></a>
                                                                        <a href="{{ route('print-material-distribution-delete', $row->id) }}" class="btn btn-danger btn-sm" data-placement="top" onclick="return confirm('Are you sure to Delete?')" data-content="delete"><i class="glyphicon glyphicon-trash"></i></a>
                                                                </td>

                                                                </tr>
                                                                @endforeach
                                                        @endif

                                                        </tbody>
                                                </table>
                                        </div>
                                        <!-- Table End -->
                                        <span class="pull-left size-13 paginate-right-top-40">{!! str_replace('/?', '?', $data->render()) !!}</span>
                                </div>
                        </div>
                </div>
        </div>
        <!-- page end-->

        <div id="addData" class="modal fade" tabindex="" role="dialog" style="display: none;">
                <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
                                        <h4 class="modal-title" id="myModalLabel">Add : {{ $pageTitle }} </h4>
                                </div>
                                <div class="modal-body">
                                        {!! Form::open(['method'=>'GET', 'route'=>'print-material-distribution-store','class' => '','id' => 'jq-validation-form']) !!}
                                                @include('admin::print_material_distribution._form')
                                        {!! Form::close() !!}

                                </div> <!-- / .modal-body -->
                        </div> <!-- / .modal-content -->
                </div> <!-- / .modal-dialog -->
        </div>
        <!-- modal -->

        <!-- Modal  -->
        <div class="modal fade" id="etsbModal" tabindex="" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                        </div>
                </div>
        </div>
        <!-- modal -->
        <script type="text/javascript" src="{{ URL::asset('assets/js/jquery-1.12.0.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
        @if($errors->any())
                <script type="text/javascript">
                $(function(){
                        alert('sdkjf');
                    $("#addData").modal('show');

                });
                </script>
        @endif


        <script>
                // tooltip for buttons
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
                // tooltip for input field
                $(".form-control").tooltip();
        </script>

@stop