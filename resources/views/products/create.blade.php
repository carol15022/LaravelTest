@extends('templates.template')
@section('content')

    <h1 class="title-pg">
        Products Management
    </h1>

    @if(isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>

    @endif

    @if(isset($product))
        {!! Form::model($product, ['route' => ['products.update', $product->id], 'class' => 'form', 'method' => 'put']) !!}
    @else
        {!! Form::open(['route' => 'products.store', 'class' => 'form'])!!}
    @endif


        <div class="form-group">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
        </div>

        <div class="form-group">
            {!! Form::text('category', null, ['class' => 'form-control', 'placeholder' => 'Category']) !!}
        </div>

        <div class="form-group">
            {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Price']) !!}
        </div>

        <div class="form-group">
            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
        </div>

         <form action="{{'ProductController@uploadPost'}}" enctype="multipart/form-data" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <input type="file" name="image" />
                </div>

                <div>
                    <a href="{{route('products.index')}}" class="btn btn-primary">Back</a>
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            </div>
    </form>

@endsection