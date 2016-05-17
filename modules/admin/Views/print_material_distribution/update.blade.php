

<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">Edit : {{ $pageTitle }}</h4>
</div>

<div class="modal-body">
    @section('content_update')
        {!! Form::model($data,['method'=>'PATCH', 'route'=>['print-material-distribution-update', $data->id]]) !!}
            @include('admin::print_material_distribution._form')
        {!! Form::close() !!}
</div>

