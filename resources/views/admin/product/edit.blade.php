@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card p-4">

                <div class="card-body">

                    <div class="row">

                        <div class="col-5">
                                <form action="{{ route('product#update', $product->id)  }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <img src="{{ asset('productImage/' . $product->image) }}" class=" img-thumbnail w-100"
                                        id="output">

                                    <input type="hidden" name="oldImageName" value="{{ $product->image }}">

                                    <input type="file" name="image"
                                        class="form-control px-2 my-2 @error('image') is-invalid @enderror" accept="image/*"
                                        onchange="loadFile(event)" value="{{ old('image') }}">
                                    @error('image')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror


                        </div>


                        <div class="col">
                            <input type="text" name="title"
                                class="form-control px-2 my-2 @error('title') is-invalid @enderror"
                                placeholder="Enter Product Name..." value="{{ old('title', $product->name) }}">
                            @error('title')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror

                            <input type="number" name="price"
                                class="form-control px-2 my-2 @error('price') is-invalid @enderror"
                                placeholder="Enter Product Price..." value="{{ old('price', $product->price) }}">
                            @error('price')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror

                            <textarea name="description" id="" cols="30" rows="6"
                                class="form-control px-2 my-2 @error('description') is-invalid @enderror"
                                placeholder="Enter Product Description...">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror

                            <select name="categoryId" id=""
                                class="form-control px-2 my-2 form-select @error('categoryId') is-invalid @enderror">


                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" @if ($item->id == old('categoryId', $product->category_idf)) selected @endif>

                                        {{ $item->name }}</option>
                                @endforeach
                            </select>

                            <input type="number" name="stock"
                                class="form-control px-2 my-2 @error('stock') is-invalid @enderror"
                                placeholder="Enter Product Stock..." value="{{ old('stock', $product->stock) }}">
                            @error('stock')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror

                            <input type="submit" value="Update Product" class="btn w-100 text-white" style=" background-color: #542344;">

                             </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
