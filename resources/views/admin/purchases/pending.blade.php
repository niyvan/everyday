<x-layout>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Purchase All</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{ route('purchase.add') }}" class="btn btn-light btn-sm waves-effect waves-light"
                                style="float:right;"><i class="fas fa-plus-circle"> Purchase Pending </i></a> <br> <br>

                            <h4 class="card-title">Purchase All Pending Data </h4>


                            <table id="datatable-buttons"
                                class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Purhase No</th>
                                        <th>Date </th>
                                        <th>Category</th>
                                        <th>Qty</th>
                                        <th>Item Name</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                </thead>


                                <tbody>

                                    @foreach ($allData as $key => $item)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item->purchase_no }} </td>
                                            <td> {{ date('d-m-Y', strtotime($item->date)) }} </td>
                                            <td> {{ $item['category']['name'] }} </td>
                                            <td> {{ $item->buying_qty }} </td>
                                            <td> {{ $item['product']['name'] }} </td>

                                            <td>
                                                @if ($item->status == '0')
                                                    <span class="badge bg-warning rounded-pill ">Pending</span>
                                                @elseif($item->status == '1')
                                                    <span class="badge bg-success rounded-pill ">Approved</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($item->status == '0')
                                                    <a href="{{ route('purchase.approve', $item->id) }} "
                                                        class="btn btn-danger sm" title="Approved" id="ApproveBtn"> <i
                                                            class="fas fa-check-circle"></i> </a>
                                                    <a href="{{ route('purchase.edit', $item->id) }}"
                                                        class="btn btn-info sm" title="Edit Data"> <i
                                                            class="fas fa-edit"></i></a>
                                                    <a href="{{ route('purchase.delete', $item->id) }}"
                                                        class="btn btn-danger sm" title="Delete Data" id="delete"> <i
                                                            class="fas fa-trash-alt"></i> </a>
                                                @endif
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
