@extends('layouts.app')
@section('main')
    <div class="container">
        <div class="text-right">
            <a href="/products/create" class="btn btn-primary mt-2">Add New Product</a>
            <a href="{{ url('/') }}" class="btn btn-success mt-2">Product View</a>
        </div>

        @if(count($products) > 0)
            <table class="table table-hover mt-2">
                <thead>
                    <tr>
                        <th>Sno.</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td><a href="products/{{ $product->id }}/show" class="text-dark">{{  $product->name }}</a></td>
                            <td><img src="/products/{{ $product->image }}" alt="" class="rounded-circle" width="50" height="50"></td>
                            <td>
                                <a href="{{ route('products.restore',['id'=>$product->id]) }}" class="btn btn-primary">Restore</a>
                                <form action="{{ route('products.forceDelete', ['id' => $product->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info mt-2">
                <p class="mb-0">No products available.</p>
            </div>
        @endif
    </div>
@endsection
