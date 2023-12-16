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
                    <h5 class="modal-title" id="staticBackdropLabel"><span id="modalTitle">Add New Product</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="orderForm" autocomplete="off">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="customer_name">Customer Name</label>
                            <input type="hidden" name="id" id="id">
                            <input name="customer_name" id="customer_name" type="text" class="form-control"
                                aria-describedby="customer_nameHelp" placeholder="Enter customer_name" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input name="address" id="address" type="text" class="form-control"
                                aria-describedby="addressHelp" placeholder="Enter address" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input name="phone" id="phone" type="text" class="form-control"
                                aria-describedby="phoneHelp" placeholder="Enter phone" required>
                        </div>

                        <div class="form-group">
                            <label for="product_id">Product</label>
                            <select name="product_id" id="product_id" class="form-control" aria-label="Default select example"
                                placeholder="Select product" required>
                                <option value="">Please Select</option>
                                @foreach ($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="qty">Qty</label>
                            <input name="qty" id="qty" value="1" type="text" class="form-control"
                                aria-describedby="qtyHelp" placeholder="Enter qty" required>
                        </div>

                        <div class="form-group">
                            <label for="rate">Rate</label>
                            <input name="rate" id="rate" value="0" type="text" class="form-control"
                                aria-describedby="rateHelp" placeholder="Enter rate" required>
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input name="amount" id="amount" type="text" class="form-control"
                                aria-describedby="amountHelp" placeholder="Enter amount" required>
                        </div>

                        <div class="form-group">
                            <label for="charge_amount">Charge Amount</label>
                            <input name="charge_amount" id="charge_amount" type="text" class="form-control"
                                aria-describedby="charge_amountHelp" placeholder="Enter charge_amount" required>
                        </div>

                        <div class="form-group">
                            <label for="vat_charge">VAT Charge</label>
                            <input name="vat_charge" id="vat_charge" type="text" class="form-control"
                                aria-describedby="vat_chargeHelp" placeholder="Enter vat_charge" required>
                        </div>

                        <div class="form-group">
                            <label for="net_amount">Net Amount</label>
                            <input name="net_amount" id="net_amount" type="text" class="form-control"
                                aria-describedby="net_amountHelp" placeholder="Enter net_amount" required>
                        </div>
                       

                        <div class="form-group">
                            <label for="is_paid">Paid Status</label>
                            <select name="is_paid" id="is_paid" class="form-control" aria-label="Default select example"
                                placeholder="Select status" required>
                                <option value="">Please Select</option>
                                <option value="1">PAID</option>
                                <option value="0">UNPAID</option>
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

        $('#product_id').on('change', function (){
            $.ajax({
                url: '/api/products/' + $('#product_id').val(),
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#rate').val(data.price);
                    
                    var amount = $('#qty').val() * $('#rate').val();
                    $('#amount').val(amount);

                    var charge = $('#amount').val() * ("{{$company->charge_amount}}" /100);
                    $('#charge_amount').val(charge);

                    var vat = $('#amount').val() * ("{{$company->vat_charge}}" /100);
                    $('#vat_charge').val(vat);

                    var net = amount + charge + vat;
                    $('#net_amount').val(net);
                }
            });
        });

        $('#qty').on('change', function (){
            var amount = $('#qty').val() * $('#rate').val();
            $('#amount').val(amount);

            var charge = $('#amount').val() * ("{{$company->charge_amount}}" /100);
            $('#charge_amount').val(charge);

            var vat = $('#amount').val() * ("{{$company->vat_charge}}" /100);
            $('#vat_charge').val(vat);

            var net = amount + charge + vat;
            $('#net_amount').val(net);
        });
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
                    data: 'product.name',
                },
                {
                    data: 'qty',
                },
                {
                    data: 'rate',
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
                            show_status = `<button class="btn  btn-success">PAID</button>`;
                            return show_status;
                        } else {
                            show_status = `<button class="btn  btn-danger">UNPAID</button>`;
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
                    $('#customer_name').val(data.customer_name);
                    $('#address').val(data.address);
                    $('#phone').val(data.phone);
                    $('#product_id').val(data.product_id);
                    $('#qty').val(data.qty);
                    $('#rate').val(data.rate);
                    $('#amount').val(data.amount);
                    $('#charge_amount').val(data.charge_amount);
                    $('#vat_charge').val(data.vat_charge);
                    $('#net_amount').val(data.net_amount);
                    $('#is_paid').val(data.is_paid);
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
