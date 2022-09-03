@extends('layouts.app')

@section('content')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">Product Editor</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product</li>
                </ol>
            </div>
        </div>

    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- <h6 class="m-0 font-weight-bold text-primary">Index Product</h6> --}}
        </div>
        <div class="card-body">
            <form action="{{ route('edit-post-product', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Game</label>
                        <select name="game_id" class="form-select" aria-label="Default select example">
                            <option disabled>Select Game</option>
                            @foreach ($game as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $data->game_id ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Product</label>
                        <input type="text" name="name" value="{{ $data->productName }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3">{{ $data->desc }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Harga</label>
                        <input type="text" name="price" value="{{ $data->price }}" class="form-control">
                    </div>
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

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
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
