<x-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit Product Page </h4><br><br>



                            <form method="post" action="{{ route('item.update') }}" id="myForm">
                                @csrf

                                <input type="hidden" name="id" value="{{ $product->id }}">

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Product Name
                                    </label>
                                    <div class="form-group col-sm-10">
                                        <input name="name" value="{{ $product->name }}" class="form-control"
                                            type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Category Name </label>
                                    <div class="col-sm-10">
                                        <select name="category_id" class="form-select"
                                            aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                            @foreach ($category as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $cat->id == $product->category_id ? 'selected' : '' }}>
                                                    {{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Wholesale Price
                                    </label>
                                    <div class="form-group col-sm-10">
                                        <input name="wholesale_price"
                                            value="{{ $product->wholesale_price }} "class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Retail Price
                                    </label>
                                    <div class="form-group col-sm-10">
                                        <input name="retail_price" value="{{ $product->retail_price }}"
                                            class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Description </label>
                                    <div class="form-group col-sm-10">
                                        <input name="description" value="{{ $product->description }}"
                                            class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Minimum
                                        Quantity</label>
                                    <div class="form-group col-sm-10">
                                        <input name="minimum_qty"
                                            value="{{ $product->minimum_qty }} "class="form-control" type="text">
                                    </div>
                                </div>


                                <input type="submit" class="btn btn-info waves-effect waves-light"
                                    value="Update Product">
                            </form>



                        </div>
                    </div>
                </div> <!-- end col -->
            </div>



        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please Enter Your Product Name',
                    },
                    category_id: {
                        required: 'Please Select One Category',
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