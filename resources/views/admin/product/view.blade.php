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
                                                @foreach ($product->image as $key => $item)
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
                                                    @foreach ($product->image as $item)
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
                                <h3 class="mb-3 fw-semibold mb-5">{{ $product->productName }}</h3>


                                <h4 class="mt-4"><b> Description</b></h4>
                                <p>{{ $product->desc }}</p>
                                <h3 class="mb-4"><span class="me-2 fw-bold fs-25">{{ $product->price }}</span></h3>




                                <hr>
                                <div class="btn-list mt-4">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Add portofolio
                                    </button>

                                </div>
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
                                    <h4 class="mb-5 mt-3 fw-bold">Description :</h4>

                                    <p class="mb-3 fs-15">{{ $product->desc }}
                                    </p>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Reviews</div>
                </div>
                <div class="card-body">
                    <div class="media mb-5">

                        <div class="media-body">
                            <h5 class="mt-0 mb-0">Gavin Murray</h5>
                            <div class="text-warning mb-0">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <p class="font-13 text-muted">Good Looking.........</p>

                        </div>
                    </div>


                </div>
            </div>
        </div>


        <h3 class="p-3 mb-5">Portofolio</h3>
        <div class="col-12">
            <div class="row">
                @foreach ($porto as $item)
                    <div class="col-4">
                        <div class="card">
                            <div class="product-grid6">
                                <div class="product-image6 p-5">
                                    <img class="img-fluid br-7 w-100" src="{{ url('/storage') . '/' . $item->path }}"
                                        alt="img">
                                </div>
                                <div class="card-body pt-0">
                                    <div class="product-content text-center">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{ route('delete-portofolio', $item->id) }}"><button type="button"
                                        class="btn btn-danger mb-1">Delete</button></a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    {{-- modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add portofolio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('add-portofolio', $product->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="form-group increment">
                                <label for="">file berkas</label>
                                <div class="input-group">
                                    <input type="file" name="image[]" class="form-control">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-primary btn-add"><i
                                                class="fas fa-plus-square"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="clone invisible">
                                <div class="input-group mt-2">
                                    <input type="file" name="image[]" class="form-control">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-danger btn-remove"><i
                                                class="fas fa-minus-square"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
