@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @php
                        $path = $topup->path;
                    @endphp
                    <img class="card-img-top img-fluid" src="{{ url('/storage') . "/${path}" }}" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title ">TopUp Detail</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td>{{ $topup->user->username }}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>:</td>
                                    <td>{{ $topup->total }}</td>
                                </tr>
                                <tr>
                                    <td>Code Uniq</td>
                                    <td>:</td>
                                    <td>{{ $topup->codeUniq }}</td>
                                </tr>
                                <tr>
                                    <td>status</td>
                                    <td>:</td>
                                    <td>{{ $topup->status }}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>:</td>
                                    <td>{{ $topup->ket }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('topup-confirm', $topup->id) }}"
                            class="btn btn-primary waves-effect waves-light">Confirm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
