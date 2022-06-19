@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-xl-5 col-lg-12 col-md-12">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="product-carousel">
                                        <div id="Slider" class="carousel slide border" data-bs-ride="false">
                                            <div class="carousel-inner">
                                                @foreach ($order->product->image as $key => $item)
                                                    <div class="carousel-item  {{ $key == 0 ? 'active' : '' }}"><img
                                                            src="{{ url('/storage') . '/' . $item->path }}" alt="img"
                                                            class="img-fluid mx-auto d-block">
                                                        <div class="text-center mt-5 mb-5 btn-list">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix carousel-slider">
                                        <div id="thumbcarousel" class="carousel slide" data-bs-interval="t">
                                            <div class="carousel-inner">
                                                <ul class="carousel-item active">
                                                    @php
                                                        $number = 0;
                                                    @endphp
                                                    @foreach ($order->product->image as $item)
                                                        <li data-bs-target="#Slider" data-bs-slide-to="{{ $number }}"
                                                            class="thumb active m-2"><img
                                                                src="{{ url('/storage') . '/' . $item->path }}"
                                                                alt="img"></li>
                                                        @php
                                                            $number++;
                                                        @endphp
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
                            <div class="mt-2 mb-4">
                                <h3 class="mb-3 fw-semibold mb-5">{{ $order->product->productName }}</h3>


                                <h4 class="mt-4"><b> Description</b></h4>
                                <p>{{ $order->product->desc }}</p>
                                <h3 class="mb-4"><span class="me-2 fw-bold fs-25">{{ $order->product->price }}</span>
                                </h3>
                                <hr>
                                <h4 class="mt-4"><b> Status Order</b></h4>
                                <form action="{{ route('changeStatus', $order->id) }}" method="post">
                                    @csrf
                                    <select class="form-select" name="status" aria-label="Default select example">
                                        <option selected disabled>Open this select menu</option>
                                        <option value="diproses">diproses</option>
                                        <option value="dibatalkan">dibatalkan</option>
                                        <option value="selesai">selesai</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary mt-2">Change</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-md-12">
            <div class="card productdesc">
                <div class="card-body">
                    <div class="panel panel-primary">
                        <div class=" tab-menu-heading">
                            <div class="tabs-menu1">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs">
                                    <li><a href="#tab5" class="active" data-bs-toggle="tab">Specifications</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab5">
                                    <h4 class="mb-5 mt-3 fw-bold">Note :</h4>

                                    <p class="mb-3 fs-15">{{ $order->note }}
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td width='300px' class="fw-bold">Game Name</td>
                                                <td> {{ $order->product->game->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Product Name</td>
                                                <td>{{ $order->product->productName }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Product Price</td>
                                                <td>{{ $order->product->price }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Username</td>
                                                <td> {{ $order->user->username }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">User email</td>
                                                <td> {{ $order->user->email }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">User Phone</td>
                                                <td> {{ $order->user->phone }}</td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
@endsection
