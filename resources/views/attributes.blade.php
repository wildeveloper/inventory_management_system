@extends('layout')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Attributes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Attributes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <button id="add_attribute" type="button" class="mb-2 btn btn-primary" data-toggle="modal"
                data-target="#attributeModal">
                Add New Attribute
            </button>
            <div class="card">
                <div class="card-body">
                    <table id="attributes_table" class="display" width="100%">
                        <thead>
                            <tr>
                                <th class="text-left">Attribute Name</th>
                                <th class="text-left">Total Value</th>
                                <th class="text-left">Status</th>
                                <th class="text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-left">Attribute Name</th>
                                <th class="text-left">Total Value</th>
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
    <div class="modal fade" id="attributeModal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><span id="modalTitle">Add New Attribute</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="attributeForm" autocomplete="off">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="attribute">Attribute</label>
                            <input type="hidden" name="id" id="id">
                            <input name="name" id="name" type="text" class="form-control"
                                aria-describedby="attributeHelp" placeholder="Enter attribute" required>
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
        var datatable = $('#attributes_table').DataTable({
            processing: true,
            serverside: true,
            ajax: {
                url: '/api/attributes',
                method: 'GET',
                dataSrc: ""
            },
            columns: [{
                    data: 'name',
                },
                {
                    render: function(data, type, row, meta) {
                        const attributes = row["attribute_values"] || [];
                        const countAttributes = Array.isArray(attributes) ? attributes.length : 1; 
                        return countAttributes;
                    }
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
                        const actions = `<a href="/attribute-values/${id}" class="btn btn-primary">ADD NEW VALUE</a>
                                <button value="${id}" class="btn btn-warning edit_attribute">EDIT</button>
                                <button value="${id}" class="btn  btn-danger delete_attribute"> DELETE</button>`;
                        return actions;
                    }


                },
            ],

        });

        $('#add_attribute').click(function(e) {
            e.preventDefault();
            $('#attributeModal').modal('show');
            $('#modalTitle').text('Add New Attribute');
            editing = false;
        });

        $(document).on('click', '.edit_attribute', function(e) {
            //console.log(e.currentTarget.value);
            $('#attributeModal').modal('show');
            $('#modalTitle').text('Edit Attribute');
            editing = true;

            $.ajax({
                url: '/api/attributes/' + e.currentTarget.value,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#is_active').val(data.is_active);
                }
            });

        });

        $(document).on('click', '.delete_attribute', function(e) {
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
                        url: '/api/attributes/' + delete_id,
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


        $('#attributeForm').on('submit', function(e) {
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

                        let form = $("#attributeForm").serializeArray();
                        let formdata = {}
                        formdata = form
                        $.ajax({
                            url: "/api/attributes",
                            method: "POST",
                            data: formdata,
                            // dataType: "json",
                            success: function(data) {
                                Swal.fire({
                                    title: "Saved!",
                                    text: "Your file has been saved.",
                                    icon: "success"
                                });
                                $('#attributeModal').modal('hide');
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

                        let form = $("#attributeForm").serializeArray();
                        let formdata = {}
                        formdata = form
                        $.ajax({
                            url: "/api/attributes",
                            method: "PUT",
                            data: formdata,
                            // dataType: "json",
                            success: function(data) {
                                Swal.fire({
                                    title: "Saved!",
                                    text: "Your file has been updated.",
                                    icon: "success"
                                });
                                $('#attributeModal').modal('hide');
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
