@extends('admin::layouts.master')

@section('content')



    <div class="container-fluid">
        <div class="no-border">
            <table cellspacing="0" cellpadding="0" border="0" class="table size-13 quote-list">
                <thead class="head-top">
                <tr>
                    <td colspan="6">
                        <h1>
                            <span class="glyphicon glyphicon-list">&nbsp;</span> {{ $pageTitle }}
                        </h1>
                    </td>
                </tr>
                </thead>
                <thead>
                <tr>
                    <th>Quote No.</th>
                    @if($role_name == 'admin' || $role_name == 'super-admin')
                    <th>Agent Name</th>
                    @endif
                    <th>Property Owner Name</th>
                    <th>Date</th>
                    <th>Business Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($data as $quote)
                    <tr>
                        <td class="text-center"><a href="{{ route('payment-procedure', ['quote_id'=>$quote->id, 'quote_no'=>$quote->quote_number])  }}" class="underline"> <strong>{{ $quote->quote_number }}</strong> </a></td>
                        @if($role_name == 'admin' || $role_name == 'super-admin')
                        <td style="font-weight:normal;">{{ $quote->relUser['username'] }}</td>
                        @endif
                        <td style="font-weight:normal;">{{ $quote->relPropertyDetail['owner_name'] }}</td>
                        <td class="text-center">{{ date('d M Y',strtotime($quote->created_at)) }}</td>
                        <td style="font-weight:normal;">{{ $quote->relBusiness['title'] }}</td>
                        <td style="font-weight:normal;">{{ $quote->status }}</td>
                        <td>
                            <a href="{{ route('payment-procedure', ['quote_id'=>$quote->id, 'quote_no'=>$quote->quote_number])  }}" class="btn btn-primary" data-placement="left" data-content="Payment"><span class="fa fa-credit-card"></span></a>
                            <a href="{{ route('view-payment-detail',$quote->relTransaction->id)  }}" class="btn btn-info" data-placement="left" data-content="Invoice"><span class="fa fa-eye"></span></a>
                        </td>


                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

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