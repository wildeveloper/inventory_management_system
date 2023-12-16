@extends('layout')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <button id="add_order" type="button" class="mb-2 btn btn-primary" data-toggle="modal"
                data-target="#orderModal">
                Add New Order
            </button>
            <div class="card">
                <div class="card-body">
                    <table id="orders_table" class="display" width="100%">
                        <thead>
                            <tr>
                                <th class="text-left">Customer Name</th>
                                <th class="text-left">Product Name</th>
                                <th class="text-left">Qty</th>
                                <th class="text-left">Rate</th>
                                <th class="text-left">Gross</th>
                                <th class="text-left">Charge Amount</th>
                                <th class="text-left">VAT Charge</th>
                                <th class="text-left">Net</th>
                                <th class="text-left">Status</th>
                                <th class="text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-left">Customer Name</th>
                                <th class="text-left">Product Name</th>
                                <th class="text-left">Qty</th>
                                <th class="text-left">Rate</th>
                                <th class="text-left">Gross</th>
                                <th class="text-left">Charge Amount</th>
                                <th class="text-left">VAT Charge</th>
                                <th class="text-left">Net</th>
                                <th class="text-left">Status</th>
                                <th class="text-left">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="orderModal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><span id="modalTitle">Add New Order</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="orderForm" autocomplete="off">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="order">Order</label>
                            <input type="hidden" name="id" id="id">
                            <input name="name" id="name" type="text" class="form-control"
                                aria-describedby="orderHelp" placeholder="Enter order" required>
                        </div>

                        <div class="form-group">
                            <label for="sku">SKU</label>
                            <input name="sku" id="sku" type="text" class="form-control"
                                aria-describedby="skuHelp" placeholder="Enter sku" required>
                        </div>

                        <div class="form-group">
                            <label for="desc">Description</label>
                            <input name="desc" id="desc" type="text" class="form-control"
                                aria-describedby="descHelp" placeholder="Enter desc" required>
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input name="price" id="price" type="text" class="form-control"
                                aria-describedby="priceHelp" placeholder="Enter price" required>
                        </div>

                        <div class="form-group">
                            <label for="qty">QTY</label>
                            <input name="qty" id="qty" type="text" class="form-control"
                                aria-describedby="qtyHelp" placeholder="Enter qty" required>
                        </div>

                        <div class="form-group">
                            <label for="brand_id">Brand</label>
                            <select name="brand_id" id="brand_id" class="form-control" aria-label="Default select example"
                                placeholder="Select status" required>
                                <option value="">Please Select</option>
                                @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-control" aria-label="Default select example"
                                placeholder="Select status" required>
                                <option value="">Please Select</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="store_id">Store</label>
                            <select name="store_id" id="store_id" class="form-control" aria-label="Default select example"
                                placeholder="Select status" required>
                                <option value="">Please Select</option>
                                @foreach ($stores as $store)
                                    <option value="{{$store->id}}">{{$store->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="is_active" id="is_active" class="form-control" aria-label="Default select example"
                                placeholder="Select status" required>
                                <option value="">Please Select</option>
                                <option value="1">ACTIVE</option>
                                <option value="0">INACTIVE</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="module">
        var editing = false;
        var datatable = $('#orders_table').DataTable({
            processing: true,
            serverside: true,
            ajax: {
                url: '/api/orders',
                method: 'GET',
                dataSrc: ""
            },
            columns: [{
                    data: 'customer_name',
                },
                {
                    data: 'product_id',
                },
                {
                    data: 'qty',
                },
                {
                    data: 'rate',
                },
                {
                    data: 'qty',
                },
                {
                    data: 'amount',
                },
                {
                    data: 'charge_amount',
                },
                {
                    data: 'vat_charge',
                },
                {
                    data: 'net_amount',
                },
                
                {
                    render: function(data, type, row, meta) {

                        const id = row["id"]
                        const status = row["is_paid"];
                        let show_status = '';
                        if (status === 1) {
                            show_status = `<button class="btn  btn-success">ACTIVE</button>`;
                            return show_status;
                        } else {
                            show_status = `<button class="btn  btn-danger">INACTIVE</button>`;
                            return show_status;
                        }

                    }
                },
                {
                    render: function(data, type, row, meta) {
                        const id = row["id"];
                        const actions = `<button value="${id}" class="btn btn-warning edit_order">EDIT</button>
                                <button value="${id}" class="btn  btn-danger delete_order"> DELETE</button>`;
                        return actions;
                    }


                },
            ],

        });

        $('#add_order').click(function(e) {
            e.preventDefault();
            $('#orderModal').modal('show');
            $('#modalTitle').text('Add New Order');
            editing = false;
        });

        $(document).on('click', '.edit_order', function(e) {
            //console.log(e.currentTarget.value);
            $('#orderModal').modal('show');
            $('#modalTitle').text('Edit Order');
            editing = true;

            $.ajax({
                url: '/api/orders/' + e.currentTarget.value,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#sku').val(data.sku);
                    $('#desc').val(data.desc);
                    $('#price').val(data.price);
                    $('#qty').val(data.qty);
                    $('#brand_id').val(data.brand_id);
                    $('#category_id').val(data.category_id);
                    $('#store_id').val(data.store_id);
                    $('#is_active').val(data.is_active)
                }
            });

        });

        $(document).on('click', '.delete_order', function(e) {
            const delete_id = e.currentTarget.value;
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(e.currentTarget.value);
                    $.ajax({
                        url: '/api/orders/' + delete_id,
                        type: "DELETE",
                        success: function(data) {
                            Swal.fire({
                                title: "Saved!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                            datatable.ajax.reload();
                        }
                    });


                }
            });


        });


        $('#orderForm').on('submit', function(e) {
            e.preventDefault();

            if (editing == false) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, save it!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        let form = $("#orderForm").serializeArray();
                        let formdata = {}
                        formdata = form
                        $.ajax({
                            url: "/api/orders",
                            method: "POST",
                            data: formdata,
                            // dataType: "json",
                            success: function(data) {
                                Swal.fire({
                                    title: "Saved!",
                                    text: "Your file has been saved.",
                                    icon: "success"
                                });
                                $('#orderModal').modal('hide');
                                datatable.ajax.reload();
                                $('#id').val('');
                                $('#name').val('');
                                $('#is_active').val('')
                            }
                        });


                    }
                });
            } else {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, update it!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        let form = $("#orderForm").serializeArray();
                        let formdata = {}
                        formdata = form
                        $.ajax({
                            url: "/api/orders",
                            method: "PUT",
                            data: formdata,
                            // dataType: "json",
                            success: function(data) {
                                Swal.fire({
                                    title: "Saved!",
                                    text: "Your file has been updated.",
                                    icon: "success"
                                });
                                $('#orderModal').modal('hide');
                                datatable.ajax.reload();
                                $('#id').val('');
                                $('#name').val('');
                                $('#is_active').val('')
                            }
                        });


                    }
                });
            }









        })
    </script>
@endsection
