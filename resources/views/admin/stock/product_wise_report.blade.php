<x-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Item Wise Report </h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="show_product">
                                <form method="GET" action="{{ route('product.wise.pdf') }}" id="myForm"
                                    target="_blank">

                                    <div class="row">


                                        <div class="col-md-4">
                                            <div class="md-3 form-group">
                                                <label for="example-text-input" class="form-label">Start Date</label>
                                                <input class="form-control example-date-input" name="start_date"
                                                    type="date" id="start_date" placeholder="YY-MM-DD" required>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="md-3 form-group">
                                                <label for="example-text-input" class="form-label">End Date</label>
                                                <input class="form-control example-date-input" name="end_date"
                                                    type="date" id="end_date" placeholder="YY-MM-DD" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="md-3">
                                                <label for="example-text-input" class="form-label">Category Name
                                                </label>
                                                <select name="category_id" id="category_id" class="form-select select2"
                                                    aria-label="Default select example">
                                                    <option value="All"selected="">All</option>
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
                                                    <option value="All" selected="">All</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4" style="padding-top: 28px;">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>

                                    </div>

                                </form>

                            </div>
                            <!--  /// End Product Wise  -->






                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>

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
                        var html = '<option value="">Select Products</option>';
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    product_id: {
                        required: true,
                    },

                },
                messages: {
                    product_id: {
                        required: 'Please Select Product ',
                    },

                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
</x-layout>
