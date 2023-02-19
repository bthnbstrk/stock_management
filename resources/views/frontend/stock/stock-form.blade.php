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
                        <div class="col-xl-12">
                            <!-- HTML5 Inputs -->
                            <div class="card mb-4">
                                <h5 class="card-header">Stock Form</h5>
                                <div class="card-body">
                                    <div class="mb-3 row">
                                        <label for="html5-text-input" class="col-md-2 col-form-label">Name</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" placeholder="Name" id="html5-text-input" />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="html5-text-input" class="col-md-2 col-form-label">Barcode</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" placeholder="Barcode" id="html5-text-input" />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="html5-text-input" class="col-md-2 col-form-label">Brand</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" placeholder="Brand" id="html5-text-input" />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="html5-text-input" class="col-md-2 col-form-label">Vat</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" placeholder="Vat" id="html5-text-input" />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="html5-text-input" class="col-md-2 col-form-label">Price</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" placeholder="Price" id="html5-text-input" />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="html5-text-input" class="col-md-2 col-form-label">Category</label>
                                        <div class="col-md-10">
                                            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                                                <option selected>Open this select menu</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>

                                    <a href="{{url('/customers/customer-form')}}" type="submit" class="btn btn-outline-success">Add</a>
                                </div>
                            </div>
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
