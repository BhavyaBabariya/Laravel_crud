@extends('layouts.app')
@section('main')
    <div class="container">
      <form action="" method="get" class="col-5 mt-2 ">
        <div class="form-group">
          <input type="search" name="search" class="form-control d-inline" placeholder="Search by product name" value="{{ $query }}"> 
        </div>
        <button type="submit" class="btn btn-primary"style="margin-top: -100px;margin-left: 470px;">Search</button>
        <a href="{{url('/')}}">
        <button type="button" class="btn btn-info"style="margin-top: -147px;margin-left: 550px;">Reset</button></a>
      </form>
        <div class="text-right">
          
            <a href="/products/create" class="btn btn-primary mt-2">Add New Product</a>
            <a href="{{ route('products.trash') }}" class="btn btn-danger mt-2">Go To Trash</a>
        </div>

        <table class="table table-hover mt-2">
            <thead>
                <tr>
                    <th>Sno.</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td><a href="products/{{ $product->id }}/show" class="text-dark">{{  $product->name }}</a></td>
                        <td><a href="products/{{ $product->id }}/show" class="text-dark">{{  $product->description }}</a></td>
                        <td><img src="products/{{ $product->image }}" alt="" class="rounded-circle" width="50" height="50"></td>
                        <td>
                            <a href="/products/{{ $product->id }}/edit" class="btn btn-primary">Edit</a>
                            <form action="/products/{{ $product->id }}/trash" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Trash</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center alert alert-info">No products available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
