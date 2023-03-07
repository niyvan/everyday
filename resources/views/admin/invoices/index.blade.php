<x-layout>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Invoice All</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{ route('invoice.create') }}"
                                class="btn btn-light btn-sm waves-effect waves-light" style="float:right;"><i
                                    class="fas fa-plus-circle"> Add invoice </i></a> <br> <br>

                            <h4 class="card-title">Invoice All Data </h4>

                            <table id="datatable-buttons"
                                class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Customer</th>
                                        <th>Invoice No </th>
                                        <th>Date </th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                </thead>


                                <tbody>

                                    @foreach ($allData as $key => $item)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item['payment']['customer']['name'] }} </td>
                                            <td> #{{ $item->invoice_no }} </td>
                                            <td> {{ date('d-m-Y', strtotime($item->date)) }} </td>


                                            <td> {{ $item->description }} </td>

                                            <td> {{ $item['payment']['total_amount'] }}fbu</td>
                                            <td>
                                                @if ($item->status == '0')
                                                    <span class="badge bg-warning rounded-pill ">Pending</span>
                                                @elseif($item->status == '1')
                                                    <span class="badge bg-success rounded-pill ">Completed</span>
                                                @elseif($item->status == '2')
                                                    <span class="badge bg-danger rounded-pill ">Cancelled</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('print.invoice', $item->id) }}"
                                                    class="btn btn-info btn-sm sm" title="Print Invoice"> <i
                                                        class="fa fa-print"></i> </a>

                                                <a href="{{ route('invoice.cancel', $item->id) }}"
                                                    class="btn btn-danger btn-sm sm" title="Cancel Invoice"> <i
                                                    class="fa fa-minus-circle"></i> </a>
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
