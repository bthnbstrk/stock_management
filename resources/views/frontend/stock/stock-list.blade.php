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
                            <a href="{{url('/stock/stock-form')}}" type="submit" class="btn btn-outline-success">Add</a>
                        </div>
                        <!-- Total Revenue -->
                        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                            <!-- Hoverable Table rows -->
                            <div class="card">
                                <h5 class="card-header">Products</h5>
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Name</th>
                                            <th>Brand</th>
                                            <th>Barcode</th>
                                            <th>Category</th>
                                            <th>Vat</th>
                                            <th>Price</th>
                                            <th>Unit Price</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>1</strong></td>
                                            <td>Çilekli Jelibon</td>
                                            <td>Çiloğlu</td>
                                            <td>Jelibon</td>
                                            <td>123124113213</td>
                                            <td>0.12</td>
                                            <td>132</td>
                                            <td>135</td>
                                            <td>
                                                <div style="display: flex;gap:5px">
                                                    <a href="{{url('/stock/stock-form')}}" type="submit" class="btn btn-outline-warning">Add</a>
                                                    <button type="button" class="btn btn-outline-danger">Delete</button>
                                                    <button type="button" class="btn btn-outline-dark">Orders</button>
                                                </div>
                                            </td>
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

<!-- Vendors JS -->
<script src="/assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="/assets/js/main.js"></script>

<!-- Page JS -->
<script src="/assets/js/dashboards-analytics.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
