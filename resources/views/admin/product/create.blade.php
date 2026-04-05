@extends('admin.layout.master')

@section('content')

    <div class="row">
        <div class="col-8 offset-2">
            <div class="card p-4">

                <div class="card-body">
                    <form action="{{ route('product#create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <img src="{{ asset('defaultImage/dImage.webp') }}" class=" img-thumbnail w-25" id="output">
                    <input type="file" name="image" class="form-control px-2 my-2 @error('image') is-invalid @enderror" accept="image/*" onchange="loadFile(event)" value="{{ old('image') }}">
                    @error('image')
                         <small class="invalid-feedback">{{$message}}</small>
                    @enderror

                    <input type="text" name="title" class="form-control px-2 my-2 @error('title') is-invalid @enderror" placeholder="Enter Product Name..." value="{{ old('title') }}">
                    @error('title')
                        <small class="invalid-feedback">{{$message}}</small>
                    @enderror

                    <input type="number" name="price" class="form-control px-2 my-2 @error('price') is-invalid @enderror" placeholder="Enter Product Price..." value="{{ old('price') }}">
                    @error('price')
                        <small class="invalid-feedback">{{$message}}</small>
                    @enderror

                    <textarea name="description" id="" cols="30" rows="6" class="form-control px-2 my-2 @error('description') is-invalid @enderror" placeholder="Enter Product Description...">{{ old('description') }}</textarea>
                    @error('description')
                        <small class="invalid-feedback">{{$message}}</small>
                    @enderror

                    <select name="categoryId" id="" class="form-control px-2 my-2 form-select @error('categoryId') is-invalid @enderror">
                        <option value="" >Choose Category Name...</option>

                        @foreach ($categories as $item)
                        <option value="{{ $item->id }}" @if ($item->id == old('categoryId'))selected @endif>

                        {{$item->name}}</option>
                        @endforeach
                    </select>

                    <input type="number" name="stock" class="form-control px-2 my-2 @error('stock') is-invalid @enderror" placeholder="Enter Product Stock..." value="{{ old('stock') }}">
                    @error('stock')
                        <small class="invalid-feedback">{{$message}}</small>
                    @enderror

                    <input type="submit" value="Create Product" class="btn w-100 text-white" style=" background-color: #542344;">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@if (Session::has('success'))
    @section('script-code')
        <script>

                Swal.fire({
                title: "Product Created Successfully !",
                icon: "success",
                draggable: true,
                timer: 1300,
                timerProgressBar: true
                });
        </script>
    @endsection
@endif
