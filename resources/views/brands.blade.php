@extends('layout')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Brands</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Brands</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <button id="add_brand" type="button" class="mb-2 btn btn-primary" data-toggle="modal"
                data-target="#brandModal">
                Add New Brand
            </button>
            <div class="card">
                <div class="card-body">
                    <table id="brands_table" class="display" width="100%">
                        <thead>
                            <tr>
                                <th class="text-left">Brand Name</th>
                                <th class="text-left">Status</th>
                                <th class="text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-left">Brand Name</th>
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
    <div class="modal fade" id="brandModal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><span id="modalTitle">Add New Brand</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="brandForm" autocomplete="off">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="brand">Brand</label>
                            <input type="hidden" name="id" id="id">
                            <input name="name" id="name" type="text" class="form-control"
                                aria-describedby="brandHelp" placeholder="Enter brand" required>
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
        var datatable = $('#brands_table').DataTable({
            processing: true,
            serverside: true,
            ajax: {
                url: '/api/brands',
                method: 'GET',
                dataSrc: ""
            },
            columns: [{
                    data: 'name',
                },
                {
                    render: function(data, type, row, meta) {

                        const id = row["id"]
                        const status = row["is_active"];
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
                        const actions = `<button value="${id}" class="btn btn-warning edit_brand">EDIT</button>
                                <button value="${id}" class="btn  btn-danger delete_brand"> DELETE</button>`;
                        return actions;
                    }


                },
            ],

        });

        $('#add_brand').click(function(e) {
            e.preventDefault();
            $('#brandModal').modal('show');
            $('#modalTitle').text('Add New Brand');
            editing = false;
        });

        $(document).on('click', '.edit_brand', function(e) {
            //console.log(e.currentTarget.value);
            $('#brandModal').modal('show');
            $('#modalTitle').text('Edit Brand');
            editing = true;

            $.ajax({
                url: '/api/brands/' + e.currentTarget.value,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#is_active').val(data.is_active)
                }
            });

        });

        $(document).on('click', '.delete_brand', function(e) {
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
                        url: '/api/brands/' + delete_id,
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


        $('#brandForm').on('submit', function(e) {
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

                        let form = $("#brandForm").serializeArray();
                        let formdata = {}
                        formdata = form
                        $.ajax({
                            url: "/api/brands",
                            method: "POST",
                            data: formdata,
                            // dataType: "json",
                            success: function(data) {
                                Swal.fire({
                                    title: "Saved!",
                                    text: "Your file has been saved.",
                                    icon: "success"
                                });
                                $('#brandModal').modal('hide');
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

                        let form = $("#brandForm").serializeArray();
                        let formdata = {}
                        formdata = form
                        $.ajax({
                            url: "/api/brands",
                            method: "PUT",
                            data: formdata,
                            // dataType: "json",
                            success: function(data) {
                                Swal.fire({
                                    title: "Saved!",
                                    text: "Your file has been updated.",
                                    icon: "success"
                                });
                                $('#brandModal').modal('hide');
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
