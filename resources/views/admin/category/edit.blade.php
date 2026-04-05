@extends("admin.layout.master")

@section("content")

            <div class="row">

                            <div class="col-4 offset-4">

                                <div class="ms-5 mb-2">
                                    <a href="{{ route('category#list') }}">
                                        <button type="button" class="btn btn-outline-secondary btn-sm">Back</button>
                                    </a>
                                </div>

                                <div class="card">
                                    <div class="card-body shadow">
                                        <form action="{{ route('category#update', $category->id) }}" method="post" class="p-3 rounded">
                                            @csrf
                                            <input type="text" name="categoryName" value="{{ old('categoryName', $category->name) }}" class=" form-control @error('categoryName') is-invalid @enderror"
                                                placeholder="Category Name...">
                                            @error('categoryName')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror

                                            <input type="submit" value="Update" class="btn mt-3 text-white" style=" background-color: #542344;">
                                        </form>
                                    </div>
                                </div>
                            </div>
            </div>
@endsection

@if (Session::has('updateSuccess'))
    @section('script-code')
        <script>

                Swal.fire({
                title: "Updated Successfully !",
                icon: "success",
                draggable: true,
                timer: 1300,
                timerProgressBar: true
                });
                location.href="/admin/category/list"
        </script>
    @endsection
@endif
