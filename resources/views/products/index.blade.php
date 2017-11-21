@extends('templates.template')
@section('content')

<h1 class="title-pg">Products Listing</h1>

<a href="{{route('products.create')}}" class="btn btn-primary btn-add">
    <span class="glyphicon glyphicon-plus"></span>
    Create
</a>

<table class="table table-striped">
    <tr>
        <th>Image</th>
        <th>Title</th>
        <th>Category</th>
        <th>Price</th>
        <th width="100px">Actions</th>

    </tr>

    @foreach($products as $product)
        <tr>
            <td><img src="{{ $product->image}}"></td>
            <td>{{$product->name}}</td>
            <td>{{$product->category}}</td>
            <td>{{$product->price}}</td>
            <td>
                <div class="row">
                    <div class="col-md-5">
                        {!! Form::open(['route'=> ['products.edit', $product->id], 'method'=>'get']) !!}
                            {!! Form::button('<i class="glyphicon glyphicon-pencil"></i>', ['type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </div>

                    <div class="col-md-5">
                        {!! Form::open(['route'=> ['products.destroy', $product->id], 'method'=>'delete']) !!}
                            {!! Form::button('<i class="glyphicon glyphicon-remove"></i>', ['type'=>'submit', 'class'=>'sideButton']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </td>

        </tr>

    @endforeach
</table>

@endsection