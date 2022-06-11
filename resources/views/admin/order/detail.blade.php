@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{-- carousel --}}
                    <div>
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

                            <div class="carousel-inner">
                                @foreach ($order->product->image as $key => $item)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ url('/storage') . '/' . $item->path }}" class="d-block w-100"
                                            alt="...">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    {{-- end carousel --}}
                    <div class="card-body">
                        <h4 class="card-title ">Product Detail</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td width='200px'>Product name</td>
                                    <td>:</td>
                                    <td>{{ $order->product->productName }}</td>
                                </tr>
                                <tr>
                                    <td>Game</td>
                                    <td>:</td>
                                    <td>{{ $order->product->game->name }}</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>:</td>
                                    <td>{{ $order->product->price }}</td>

                                </tr>
                                <tr>
                                    <td>Desc</td>
                                    <td>:</td>
                                    <td>{{ $order->product->desc }}</td>

                                </tr>
                                <tr>
                                    <td>Order Note</td>
                                    <td>:</td>
                                    <td>{{ $order->note }}</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title ">User Detail</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td width='200px'>Username</td>
                                    <td>:</td>
                                    <td>{{ $order->user->username }}</td>
                                </tr>
                                <tr>
                                    <td>email</td>
                                    <td>:</td>
                                    <td>{{ $order->user->email }}</td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>:</td>
                                    <td>{{ $order->user->phone }}</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title ">Order Note</h4>
                        <table class="table">
                            <tbody>
                                <tr>{{ $order->note }}</tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title ">Change Status</h4>
                        <table class="table">
                            <tbody>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
