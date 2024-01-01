@extends('layouts.app')
@section('main')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card p-4 mt-5">
                <p>Name : <b>{{ $product->name }}</b></p>
                <p>Description : <b>{{ $product->description }}</b></p>
                <img src="/products/{{ $product->image }}" alt="" class="rounded" width="50%">
            </div>
        </div>
    </div>
</div>

@endsection