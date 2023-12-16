@extends('layout')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Company</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Company</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <form id="companyForm" autocomplete="off">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Company</label>
                            <input type="hidden" name="id" value="{{ $company->id }}" id="id">
                            <input name="name" id="name" value="{{ $company->name }}" type="text"
                                class="form-control" aria-describedby="companyHelp" placeholder="Enter company" required>
                        </div>

                        <div class="form-group">
                            <label for="charge_amount">Charge Amount (%)</label>
                            <input name="charge_amount" id="charge_amount" value="{{ $company->charge_amount }}"
                                type="text" class="form-control" aria-describedby="charge_amountHelp"
                                placeholder="Enter charge_amount" required>
                        </div>

                        <div class="form-group">
                            <label for="vat_charge">VAT Charge (%)</label>
                            <input name="vat_charge" id="vat_charge" value="{{ $company->vat_charge }}" type="text"
                                class="form-control" aria-describedby="vat_chargeHelp" placeholder="Enter vat_charge"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input name="address" id="address" value="{{ $company->address }}" type="text"
                                class="form-control" aria-describedby="addressHelp" placeholder="Enter address" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input name="phone" id="phone" value="{{ $company->phone }}" type="text"
                                class="form-control" aria-describedby="phoneHelp" placeholder="Enter phone" required>
                        </div>

                        <div class="form-group">
                            <label for="country">Country</label>
                            <input name="country" id="country" value="{{ $company->country }}" type="text"
                                class="form-control" aria-describedby="countryHelp" placeholder="Enter country" required>
                        </div>



                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>


    <script type="module">
        $('#companyForm').on('submit', function(e) {
            e.preventDefault();

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

                    let form = $("#companyForm").serializeArray();
                    let formdata = {}
                    formdata = form
                    $.ajax({
                        url: "/api/company",
                        method: "PUT",
                        data: formdata,
                        // dataType: "json",
                        success: function(data) {
                            Swal.fire({
                                title: "Saved!",
                                text: "Your file has been updated.",
                                icon: "success"
                            });

                        }
                    });


                }
            });









        })
    </script>
@endsection
