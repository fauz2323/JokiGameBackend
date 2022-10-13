@extends('layouts.app')

@section('content')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit Game</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Game</li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </div>
        </div>

    </div>
    <div class="row d-flex justify-content-center">
        <div class="card  p-0 mb-4 col-5">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit List Game</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('edit-post', $data->id) }}" class="m-4" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Game</label>
                        <input type="text" value="{{ $data->name }}" name="game" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Gambar Game</label>
                        <input class="form-control" type="file" name="image" id="formFile">
                    </div>
                    <button class="btn btn-primary" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
