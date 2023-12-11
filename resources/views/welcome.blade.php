@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h4>Selamat Datang {{ auth()->user()->nama }}</h4>
            </div>
        </div>
    </div>
@endsection
