<x-layout>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Product Wise Stock Report</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);"> </a></li>
                                <li class="breadcrumb-item active">Product Wise Stock Report</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <div class="invoice-title">

                                        <h3>
                                            <img src="{{ asset('backend/assets/images/EverydayPhone_black_small.png') }}"
                                                alt="logo" height="24" /> Everydayphone
                                        </h3>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-6 mt-4">
                                            <address>
                                                <strong>Everydayphone:</strong><br>
                                                Nihezagire Yvan<br>
                                                nihezagireyvan@gmail.com
                                            </address>
                                        </div>
                                        <div class="col-6 mt-4 text-end">
                                            <address>

                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="p-2">

                                        </div>

                                    </div>

                                </div>
                            </div> <!-- end row -->





                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="p-2">

                                        </div>
                                        <div class="">
                                            <div class="table-responsive">
                                                <table id="datatable-buttons"
                                                    class="table table-striped table-bordered dt-responsive nowrap"
                                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <td class="text-center"><strong>sl</strong></td>
                                                            <td class="text-center"><strong>Date</strong></td>
                                                            <td class="text-center"><strong>Item Name</strong>
                                                            </td>
                                                            <td class="text-center">
                                                                <strong>Category</strong>
                                                            </td>
                                                            <td class="text-center"><strong>Qty Sold</strong>
                                                            </td>
                                                            <td class="text-center"><strong>Unit Price</strong>
                                                            </td>


                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $total_selling_qty = '0';

                                                        @endphp
                                                        @foreach ($product as $key => $pro)
                                                            <tr>
                                                                <td class="text-center"> {{ $key + 1 }} </td>
                                                                <td class="text-center">
                                                                    {{ date('d-m-Y', strtotime($pro->date)) }} </td>

                                                                <td class="text-center"> {{ $pro['product']['name'] }}
                                                                </td>
                                                                <td class="text-center"> {{ $pro['category']['name'] }}
                                                                </td>
                                                                <td class="text-center"> {{ $pro->selling_qty }} </td>
                                                                <td class="text-center"> {{ $pro->unit_price }} </td>
                                                            </tr>

                                                            @php
                                                                $total_selling_qty += $pro->selling_qty;
                                                            @endphp
                                                        @endforeach

                                                        <tr>
                                                            <td class="thick-line"></td>
                                                            <td class="thick-line"></td>
                                                            <td class="thick-line"></td>
                                                            <td class="thick-line"></td>
                                                            <td class="thick-line text-center">
                                                                <strong>Total Sales Qty</strong>
                                                            </td>
                                                            <td class="thick-line text-center">{{ $total_selling_qty }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>


                                            @php
                                                $date = new DateTime('now', new DateTimeZone('Africa/Bujumbura'));
                                            @endphp
                                            <i>Printing Time : {{ $date->format('F j, Y, g:i a') }}</i>

                                            <div class="d-print-none">
                                                <div class="float-end">
                                                    <a href="javascript:window.print()"
                                                        class="btn btn-success waves-effect waves-light"><i
                                                            class="fa fa-print"></i></a>
                                                    <a href="#"
                                                        class="btn btn-primary waves-effect waves-light ms-2">Download</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> <!-- end row -->






                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
</x-layout>
