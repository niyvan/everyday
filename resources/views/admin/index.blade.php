<x-layout>
    <div class="page-content">
        <div class="container-fluid">
            @php
                $category = App\Models\Category::all();
                $product = App\Models\Product::where('quantity', '<', '5')->get();
                $total_invoice = App\Models\Invoice::where('status', '=', '1')
                    ->get()
                    ->count();
                $total_payment = App\Models\Payment::where('paid_status', '=', 'full_paid')
                    ->get()
                    ->sum('paid_amount');
                
            @endphp
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">EverydayPhone</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Total Sales</p>
                                        <h4 class="mb-2">{{ $total_invoice }}</h4>

                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-shopping-cart-2-line font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Total Amount Sales</p>
                                        <h4 class="mb-2">{{ number_format($total_payment) }} fbu</h4>

                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-success rounded-3">
                                            <i class="mdi mdi-currency-usd font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div>


            <div class="row">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>

                                </div>

                                <h4 class="card-title mb-4">Out of Stock Items</h4>

                                <div class="table-responsive">
                                    <table id="datatable-buttons"
                                        class="table table-striped table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sl</th>
                                                <th>Item Name</th>
                                                <th>Category</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead><!-- end thead -->
                                        <tbody>
                                            @foreach ($product as $key => $pro)
                                                <tr>
                                                    <td>
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td>
                                                        {{ $pro->name }}
                                                    </td>
                                                    <td>{{ $pro->category->name }}</td>
                                                    <td>
                                                        {{ $pro->quantity }}
                                                    </td>

                                                </tr>
                                            @endforeach

                                            <!-- end -->
                                        </tbody><!-- end tbody -->
                                    </table> <!-- end table -->
                                </div>
                            </div><!-- end card -->
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->



                </div>
                <!-- end row -->
            </div>
            @php
                $allSales = DB::table('invoices')
                    ->join('payments', function ($join) {
                        $join->on('invoices.id', '=', 'payments.invoice_id');
                    })
                    ->select(DB::raw('month(date) as month'), DB::raw('sum(paid_amount) as price'))
                    ->where('paid_status', 'full_paid')
                    ->groupBy('month')
                    ->get();
            @endphp
            <div class="row">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body pb-0">
                                <div class="float-end d-none d-md-inline-block">
                                    <div class="dropdown">
                                        <a class="text-reset" href="#" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted">Years<i
                                                    class="mdi mdi-chevron-down ms-1"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">2022</a>
                                            <a class="dropdown-item" href="#">2023</a>

                                        </div>
                                    </div>
                                </div>
                                <h4 class="card-title mb-4">Sales per Month</h4>

                            </div>
                            <div class="card-body py-0 px-2">
                                <div id="column_line_chart" class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
            </div>

        </div>
        @foreach ($allSales as $key => $sale)
        @endforeach
        <script>
            var options = {
                series: [

                    {
                        name: "2019",
                        type: "line",
                        data: [23, 32, 27, 38, 27, 32, 27, 38, 22, 31, 21, 16],
                    },
                ],
                chart: {
                    height: 350,
                    type: "line",
                    toolbar: {
                        show: !1
                    }
                },
                stroke: {
                    width: [0, 2.3],
                    curve: "straight"
                },
                plotOptions: {
                    bar: {
                        horizontal: !1,
                        columnWidth: "34%"
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                legend: {
                    show: !1
                },
                yaxis: {
                    labels: {
                        formatter: function(e) {
                            return e + "k";
                        },
                    },
                    tickAmount: 5,
                    min: 0,
                    max: 50,
                },
                colors: ["#0f9cf3", "#6fd088"],
                labels: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
            };
            (chart = new ApexCharts(
                document.querySelector("#column_line_chart"),
                options
            )).render();
        </script>
</x-layout>
