<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">Edit : {{ $pageTitle }}</h4>
</div>


<div class="modal-body">
    @section('content_update')
        {!! Form::model($data,['method'=>'POST', 'route'=>['settings-update', $data->id]]) !!}
            @include('admin::settings._form')
        {!! Form::close() !!}
</div>