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
                                @foreach ($product->image as $key => $item)
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
                                    <td>Product name</td>
                                    <td>:</td>
                                    <td>{{ $product->productName }}</td>
                                </tr>
                                <tr>
                                    <td>Game</td>
                                    <td>:</td>
                                    <td>{{ $product->game->name }}</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>:</td>
                                    <td>{{ $product->price }}</td>

                                </tr>
                                <tr>
                                    <td>Desc</td>
                                    <td>:</td>
                                    <td>{{ $product->desc }}</td>

                                </tr>
                                <tr>
                                    <td>Create at</td>
                                    <td>:</td>
                                    <td>{{ $product->created_at }}</td>

                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add portofolio
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h2 class="mb-3">Portofolio</h2>
        <div class="row">
            @foreach ($porto as $item)
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ url('/storage') . '/' . $item->path }}" height="200px" class="card-img-top"
                            alt="picture">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>

                            <a href="{{ route('delete-portofolio', $item->id) }}" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach
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
                <form action="{{ route('add-portofolio', $product->id) }}" method="post" enctype="multipart/form-data">
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
    @endsection

    @push('script')
        <script>
            jQuery(document).ready(function() {
                jQuery(".btn-add").click(function() {
                    let markup = jQuery(".invisible").html();
                    jQuery(".increment").append(markup);
                });
                jQuery("body").on("click", ".btn-remove", function() {
                    jQuery(this).parents(".input-group").remove();
                })
            })
        </script>
    @endpush
