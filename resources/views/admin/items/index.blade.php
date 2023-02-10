<x-layout>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Product All</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{ route('item.create') }}" class="btn-light btn-sm waves-effect waves-light"
                                style="float:right;"><i class="fas fa-plus-circle"> Add Product </i></a> <br> <br>

                            <h4 class="card-title">Product All Data </h4>


                            <table id="datatable-buttons"
                                class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Wholesale Price</th>
                                        <th>Retail Price</th>
                                        <th>Quantity</th>
                                        <th>Action</th>

                                </thead>


                                <tbody>

                                    @foreach ($product as $key => $item)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item->name }} </td>
                                            <td> {{ $item['category']['name'] }} </td>
                                            <td> {{ $item->wholesale_price }} </td>
                                            <td> {{ $item->retail_price }} </td>
                                            <td> {{ $item->quantity }} </td>
                                            <td>
                                                <a href="{{ route('item.edit', $item->id) }}"
                                                    class="btn btn-info btn-sm sm" title="Edit Data"> <i
                                                        class="fas fa-edit"></i> </a>

                                                <a href="{{ route('item.destroy', $item->id) }}"
                                                    class="btn btn-danger btn-sm sm" title="Delete Data" id="delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>

                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
</x-layout>
