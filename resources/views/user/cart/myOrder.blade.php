@extends('user.layout.master')

@section('content')

    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table" id="productTable">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Order Code</th>
                            <th scope="col">Status</th>

                        </tr>
                    </thead>
                    <tbody>



                        @if (count($orderLists) != 0)
                            @foreach ($orderLists as $item)
                                <tr>
                                    <td scope="col">{{ $item->created_at->format('d-F-Y') }}</td>
                                    <td scope="col">{{ $item->order_code }}</td>
                                     <td scope="col">
                                   @if ($item->status == 'preparing')
                                     <span class="text-warning">  Pending <i class="fa-solid fa-circle-clock"></i></span>
                                   @elseif ($item->status == 'rejected')
                                       <span class="text-danger"> Rejected <i class="fa-solid fa-circle-xmark"></i></span>
                                   @elseif ($item->status == 'success')
                                      <span class="text-success"> Accepted <i class="fa-solid fa-circle-check"></i></span>
                                   @endif
                                        </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">There is no items!</td>
                            </tr>
                        @endif


                    </tbody>
                </table>
            </div>


        </div>
    </div>

@endsection
