

<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">Show : {{$pageTitle }}</h4>
</div>

<div class="modal-body">

        <table id="" class="table table-bordered table-hover table-striped size-13">
            <tr>
                <th class="col-lg-4">Quantity</th>
                <td>{{ $data->quantity }}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Surrounded Status</th>
                <td>@if($data->is_surrounded==1) <span class="glyphicon glyphicon-ok text-success"></span> {{ 'Yes' }} @else <span class="glyphicon glyphicon-remove text-danger"></span> {{ 'No' }} @endif </td>
            </tr>
            <tr>
                <th class="col-lg-4">Other Address</th>
                <td>{{ $data->other_address }}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Date of distribution</th>
                <td>{{ $data->date_of_distribution }}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Note</th>
                <td>{{ $data->note }}</td>
            </tr>



        </table>

</div>
<div class="modal-footer">

    <a href="{{ URL::previous() }}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
</div>




