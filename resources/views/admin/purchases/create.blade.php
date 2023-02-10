<x-layout>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Purchase </h4><br><br>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Date</label>
                                        <input class="form-control example-date-input" name="date" type="date"
                                            id="date">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Purchase No</label>
                                        <input class="form-control example-date-input" name="purchase_no" type="text"
                                            id="purchase_no">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Category Name </label>
                                        <select name="category_id" id="category_id" class="form-select select2"
                                            aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                            @foreach ($category as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Item Name </label>
                                        <select name="product_id" id="product_id" class="form-select select2"
                                            aria-label="Default select example">
                                            <option selected="">Open this select menu</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label" style="margin-top:43px;">
                                        </label>


                                        <i
                                            class="btn btn-secondary btn-sm waves-effect waves-light fas fa-plus-circle addeventmore">
                                            Add More</i>
                                    </div>
                                </div>





                            </div> <!-- // end row  -->

                        </div> <!-- End card-body -->
                        <!--  ---------------------------------- -->

                        <div class="card-body">
                            <form method="post" action="{{ route('purchase.store') }}">
                                @csrf
                                <table class="table-sm table-bordered" width="100%" style="border-color: #ddd;">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Product Name </th>
                                            <th>Quantity</th>
                                            <th>Description</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>

                                    <tbody id="addRow" class="addRow">

                                    </tbody>
                                </table><br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info" id="storeButton"> Purchase
                                        Store</button>

                                </div>

                            </form>



                        </div> <!-- End card-body -->







                    </div>
                </div> <!-- end col -->
            </div>



        </div>
    </div>




    <script id="document-template" type="text/x-handlebars-template">

    <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="date[]" value="@{{date}}">
            <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
            <td>
                <input type="hidden" name="category_id[]" value="@{{category_id}}">
                @{{ category_name }}
            </td>

            <td>
                <input type="hidden" name="product_id[]" value="@{{product_id}}">
                @{{ product_name }}
            </td>

            <td>
                <input type="number" min="1" class="form-control buying_qty text-right" name="buying_qty[]" value="">
            </td>

            <td>
                <input type="text" class="form-control" name="description[]">
            </td>


            <td>
                <i class="btn btn-danger btn-sm fas fa-window-close removeeventmore"></i>
            </td>

        </tr>

</script>


    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on("click", ".addeventmore", function() {
                var date = $('#date').val();
                var purchase_no = $('#purchase_no').val();
                var category_id = $('#category_id').val();
                var category_name = $('#category_id').find('option:selected').text();
                var product_id = $('#product_id').val();
                var product_name = $('#product_id').find('option:selected').text();


                if (date == '') {
                    $.notify("Date is Required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                if (purchase_no == '') {
                    $.notify("Purchase No is Required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }

                if (category_id == '') {
                    $.notify("Category is Required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                if (product_id == '') {
                    $.notify("Product Field is Required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }


                var source = $("#document-template").html();
                var tamplate = Handlebars.compile(source);
                var data = {
                    date: date,
                    purchase_no: purchase_no,
                    category_id: category_id,
                    category_name: category_name,
                    product_id: product_id,
                    product_name: product_name

                };
                var html = tamplate(data);
                $("#addRow").append(html);
            });

            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest(".delete_add_more_item").remove();
                totalAmountPrice();
            });

            $(document).on('keyup click', '.unit_price,.buying_qty', function() {
                var qty = $(this).closest("tr").find("input.buying_qty").val();

            });

            // Calculate sum of amout in invoice



        });
    </script>

    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#category_id', function() {
                var category_id = $(this).val();
                $.ajax({
                    url: "{{ route('get-product') }}",
                    type: "GET",
                    data: {
                        category_id: category_id
                    },
                    success: function(data) {
                        var html = '<option value="">Select an Item</option>';
                        $.each(data, function(key, v) {
                            html += '<option value=" ' + v.id + ' "> ' + v.name +
                                '</option>';
                        });
                        $('#product_id').html(html);
                    }
                })
            });
        });
    </script>
</x-layout>
