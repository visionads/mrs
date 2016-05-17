

<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">Show : {{$data->title }}</h4>
</div>

<div class="modal-body">

        <table id="" class="table table-bordered table-hover table-striped size-13">
            <tr>
                <th class="col-lg-4">Title</th>
                <td>{{ $data->title }}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Description</th>
                <td>{{ $data->description }}</td>
            </tr>

        </table>

</div>
<div class="modal-footer">
    <a href="{{route('solution-type')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
</div>




