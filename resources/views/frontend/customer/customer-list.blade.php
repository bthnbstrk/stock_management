<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title>{{ env('APP_NAME') }} </title>
    <meta name="description" content=""/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    @include('frontend.partials.header-script')
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        @include('frontend.partials.sidebar')
        <!-- / Menu -->
        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            @include('frontend.partials.navbar')
            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                            <a href="{{url('/customers/customer-form')}}" type="submit" class="btn btn-outline-success">Add</a>
                        </div>
                        <!-- Total Revenue -->
                        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                            <!-- Hoverable Table rows -->
                            <div class="card">
                                <h5 class="card-header">Customers</h5>
                                <div class="table-responsive text-nowrap">
                                    <table id="customersList" class="table table-bordered yajra-datatable">
                                        <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Name</th>
                                            <th>Surname</th>
                                            <th>E-Mail Address</th>
                                            <th>Phone Number</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--/ Hoverable Table rows -->
                        </div>

                    </div>

                </div>
                <!-- / Content -->
                <!-- Footer -->
                @include('frontend.partials.footer')
                <!-- / Footer -->
                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
@include('frontend.partials.footer-script')
<!-- endbuild -->

<!-- Main JS -->
<script src="/assets/js/main.js"></script>


<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function () {
        var table = $('#customersList').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "http://127.0.0.1:8004/api/v1/customer/ajax-table",
                headers: {'Authorization': 'Bearer ' + localStorage.getItem('user_token')}
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'surname', name: 'surname'},
                {data: 'email_address', name: 'email_address'},
                {data: 'phone_number', name: 'phone_number'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
    });
</script>
</body>
</html>
