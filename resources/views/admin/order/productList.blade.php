@extends('admin.layouts.master')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-responsive table-responsive-data2 mt-4">
                        <h5><a href="{{ route('admin#orderList') }}" class="text-decoration-none text-dark"><i class="fa-solid fa-arrow-left-long"></i> Back</a></h5>

                        <div class="card mt-4 col-5">
                            <div class="card-body">
                                <h3><i class="fa-solid fa-clipboard me-3"></i>Order Info</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-4"><i class="fa-solid fa-user me-2"></i> Name</div>
                                    <div class="col">{{ strtoupper($orderList[0]->user_name) }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4"><i class="fa-solid fa-barcode me-2"></i> Order Code</div>
                                    <div class="col">{{ $orderList[0]->order_code }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4"><i class="fa-regular fa-clock me-2"></i> Order Date</div>
                                    <div class="col">{{ $orderList[0]->created_at->format('j-F-Y') }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4"><i class="fa-solid fa-money-bill-1-wave me-2"></i> Total</div>
                                    <div class="col ">{{ $order->total_price }} MMK <span class="ms-2 text-warning fs-5">(Include Delivery 3000 Charges)</span></div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-data2 text-center mt-3">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderList as $o)
                                    <tr class="tr-shadow">
                                        <td class="align-middle">{{ $o->id }}</td>
                                        <td><img src="{{ asset('storage/'.$o->product_image) }}" style="height:150px" class="img-thumbnail shadow-sm"></td>
                                        <td>{{ $o->product_name }}</td>
                                        <td>{{ $o->created_at->format('j-F-Y') }}</td>
                                        <td>{{ $o->qty }}</td>
                                        <td>{{ $o->total }} MMK</td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="">
                            {{-- {{ $categories->appends(request()->query())->links() }} --}}
                            {{ $orderList->links() }}
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection


