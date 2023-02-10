<x-layout>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Category All</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{ route('category.add') }}" class="btn btn-light btn-sm waves-effect waves-light"
                                style="float:right;"><i class="fas fa-plus-circle"> Add Category </i></a> <br> <br>

                            <h4 class="card-title">Category All Data </h4>


                            <table class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="5%">Sl</th>
                                        <th>Name</th>
                                        <th width="20%">Action</th>

                                </thead>


                                <tbody>

                                    @foreach ($categoris as $key => $item)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item->name }} </td>
                                            <td>
                                                <a href="{{ route('category.edit', $item->id) }}"
                                                    class="btn btn-info btn-sm sm" title="Edit Data"> <i
                                                        class="fas fa-edit"></i> </a>

                                                <a href="{{ route('category.delete', $item->id) }}"
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
