@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-10 offset-1 ">

            <table class="table table-hover shadow-sm ">
                <thead class="text-white" style=" background-color: #542344;">
                    <tr>
                        <th>ID</th>
                        <th class="col-4">Image</th>
                        <th>Name </th>
                        <th>Stock</th>
                        <th>Created Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($product as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <img class="img-thumbnail w-50" src="{{ asset('productImage/' . $item->image) }}">
                            </td>
                            <td>{{ $item->name }} </td>
                            <td>

                                <button type="button" class="btn btn-sm bg-dark text-white btn-primary position-relative">
                                    {{ $item->stock }}

                                    @if ($item->stock == 0)
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            out of stock
                                        </span>
                                    @elseif ($item->stock <= 5)
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                                            low amt
                                        </span>
                                    @endif


                                </button>



                            </td>
                            <td>{{ $item->created_at->format('d-F-Y') }}</td>
                            <td><a href="{{ route('product#edit',$item->id) }}" class="btn btn-sm btn-outline-secondary"> <i
                                        class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button type="button" onclick="deleteFunction({{ $item->id }})" class="btn btn-sm btn-outline-danger"> <i
                                        class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach



                </tbody>
            </table>

            <span>{{$product->links()}}</span>
        </div>
    </div>
@endsection

@section('script-code')
        <script>

             function deleteFunction(id){
                    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success",
            timer: 1300,
            timerProgressBar: true
            });

          setInterval(() => {
              location.href="/admin/product/delete/"+id;     //delete process
          }, 1300);
        }
        });
                    }

        </script>
    @endsection
