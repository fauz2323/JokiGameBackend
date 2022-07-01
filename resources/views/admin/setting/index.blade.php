@extends('layouts.app')

@section('content')
    <div class="main-container container-fluid">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">Admin Setting</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">setting</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <!-- ROW-1 -->
        <div class="row d-flex justify-content-around">
            <div class="card col-md-5">
                <div class="card-header pb-0 border-bottom-0">
                    <h3 class="card-title">Password Admin</h3>
                    <div class="card-options">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#password">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <h3 class="d-inline-block mb-2">( ****** )</h3>
                    <div class="progress h-2 mt-2 mb-2">
                        <div class="progress-bar bg-primary" style="width: 100%;" role="progressbar"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- modal password --}}
    <!-- Modal -->
    <div class="modal fade" id="password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chance Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('changePass-setting') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">password</label>
                            <input type="password" class="form-control" name="password">
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
    </div>
@endsection
