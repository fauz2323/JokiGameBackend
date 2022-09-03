@extends('layouts.app')

@section('content')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">About Us</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About</li>
                </ol>
            </div>
        </div>

    </div>
    <div class="card shadow mb-4">

        <div class="card-body">
            <button type="button" class="btn btn-primary mb-3 mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Edit Data About
            </button>
            <div class="row">
                <p>{{ $about->about }}</p>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit About</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('storAbout-setting') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">About Us</label>
                            <textarea class="form-control" name="about" id="exampleFormControlTextarea1" rows="5">{{ $about->about }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
