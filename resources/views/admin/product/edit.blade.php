@extends('layouts.app')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="card  p-0 mb-4 col-5">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit List Game</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('edit-post-product', $data->id) }}" class="m-4" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Game</label>
                        <select name="game_id" class="form-select" aria-label="Default select example">
                            <option selected disabled>Select Game</option>
                            @foreach ($game as $item)
                                @if ($item->id == $data->game_id)
                                    <option selected value="{{ $item->id }}">
                                        {{ $item->name }}</option>
                                @else
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Product</label>
                        <input type="text" value="{{ $data->productName }}" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3">{{ $data->desc }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Harga</label>
                        <input type="text" value="{{ $data->price }}" name="price" class="form-control">
                    </div>
                    <button class="btn btn-primary" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
