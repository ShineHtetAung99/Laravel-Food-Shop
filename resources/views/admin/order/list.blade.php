@extends('admin.layouts.master')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2 ">
                            <h4>Total - [ {{ $order->total() }} ]</h4>
                        </div>

                        <form class="col-4 offset-2" action="{{ route('admin#changeStatus') }}" method="get">
                            @csrf
                            <div class="input-group">
                                <select name="orderStatus" id="orderStatus" class="custom-select col-6">
                                    <option value="">All</option>
                                    <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending</option>
                                    <option value="1" @if (request('orderStatus') == '1') selected @endif>Accept</option>
                                    <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="submit">Search</button>
                                </div>
                            </div>
                        </form>

                        <div class="col-3 offset-1 ">
                            <form action="{{ route('admin#orderList') }}" method="get" class="d-flex">
                                <input type="text" name="key" class="form-control" placeholder="Search for Data..."
                                    value="{{ request('key') }}">
                                <button type="submit" class="btn btn-dark">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <hr>

                    @if (count($order) != 0)
                    <div class="table-responsive table-responsive-data2 mt-4">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <input type="hidden" class="orderId" value="{{ $o->id }}">
                                        <td>{{ $o->user_id }}</td>
                                        <td>{{ $o->user_name }}</td>
                                        <td>{{ $o->created_at->format('j-F-Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin#listInfo',$o->order_code) }}">{{ $o->order_code }}</a>
                                        </td>
                                        <td>{{ $o->total_price }} MMK</td>
                                        <td>
                                            <select name="status" class="form-control statusChange">
                                                <option value="0" @if ($o->status == 0) selected @endif>Pending</option>
                                                <option value="1" @if ($o->status == 1) selected @endif>Accept</option>
                                                <option value="2" @if ($o->status == 2) selected @endif>Reject</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="">
                            {{-- {{ $categories->appends(request()->query())->links() }} --}}
                            {{ $order->links() }}
                        </div>
                    </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no Order Here!</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            // $('#orderStatus').change(function() {
            //     $status = $('#orderStatus').val();
            //     $.ajax({
            //         type: 'get',
            //         url: '/order/ajax/status',
            //         data: {'status': $status},
            //         dataType: 'json',
            //         success: function(response) {
            //             $list = '';
            //             for ($i = 0; $i < response.length; $i++) {
            //                 $months = ['January', 'February', 'March', 'April', 'May', 'June','July', 'August', 'September', 'October', 'November','December'];
            //                 $dbDate = new Date(response[$i].created_at);
            //                 $finalDate = $dbDate.getDate() + "-" + $months[$dbDate.getMonth()] + "-" + $dbDate.getFullYear();
            //                 if (response[$i].status == 0) {
            //                     $statusMessage = `
            //                         <select name="status" class="form-control statusChange">
            //                             <option value="0" selected>Pending</option>
            //                             <option value="1">Accept</option>
            //                             <option value="2">Reject</option>
            //                         </select>`;
            //                 } else if (response[$i].status == 1) {
            //                     $statusMessage = `
            //                         <select name="status" class="form-control statusChange">
            //                             <option value="0">Pending</option>
            //                             <option value="1" selected>Accept</option>
            //                             <option value="2">Reject</option>
            //                         </select>`;
            //                 } else if (response[$i].status == 2) {
            //                     $statusMessage = `
            //                         <select name="status" class="form-control statusChange">
            //                             <option value="0">Pending</option>
            //                             <option value="1">Accept</option>
            //                             <option value="2" selected>Reject</option>
            //                         </select>`;
            //                 }
            //                 $list += `
            //                     <tr class="tr-shadow">
            //                         <input type="hidden" class="orderId" value="${response[$i].id}">
            //                         <td>${response[$i].user_id}</td>
            //                         <td>${response[$i].user_name}</td>
            //                         <td>${$finalDate}</td>
            //                         <td>${response[$i].order_code}</td>
            //                         <td>${response[$i].total_price} MMK</td>
            //                         <td>${$statusMessage}</td>
            //                     </tr>
            //                     <tr class="spacer"></tr>
            //                 `;
            //             }
            //             $('#dataList').html($list);
            //         }
            //     })
            // })

            // change status
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find('.orderId').val();
                $data = {
                    'status': $currentStatus,
                    'orderId': $orderId
                };
                $.ajax({
                    type: 'get',
                    url: '/order/ajax/change/status',
                    data: $data,
                    dataType: 'json',
                })
                // location.reload();
                // window.location.href = "http://127.0.0.1:8000/order/list";
            })
   
        })
    </script>
@endsection
