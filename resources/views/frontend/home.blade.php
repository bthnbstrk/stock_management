<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title>{{ env('APP_NAME') }}</title>
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
                        <div class="col-lg-12 mb-4 order-0">
                            <div class="card">
                                <div class="d-flex align-items-end row">
                                    <div class="col-sm-7">
                                        <div class="card-body">
                                            <h5 id="userName" class="card-title text-primary"></h5>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 text-center text-sm-left">
                                        <div class="card-body pb-0 px-0 px-md-4">
                                            <img
                                                src="/assets/img/illustrations/man-with-laptop-light.png"
                                                height="140"
                                                alt="View Badge User"
                                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                                data-app-light-img="illustrations/man-with-laptop-light.png"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Revenue -->

                        <!--/ Total Revenue -->
                        <div class="col-12 col-md-12 col-lg-12 order-3 order-md-2">
                            <div class="row">
                                <div class="col-3 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img src="/assets/img/icons/unicons/paypal.png"
                                                         alt="Credit Card" class="rounded"/>
                                                </div>
                                            </div>
                                            <span class="d-block mb-1">Product Count</span>
                                            <h3 id="productCount" class="card-title text-nowrap mb-2"></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img src="/assets/img/icons/unicons/cc-primary.png"
                                                         alt="Credit Card" class="rounded"/>
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Orders</span>
                                            <h3 id="orderCount" class="card-title mb-2"></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img
                                                        src="/assets/img/icons/unicons/chart-success.png"
                                                        alt="chart success"
                                                        class="rounded"
                                                    />
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Stock</span>
                                            <h3 id="stockCount" class="card-title mb-2"></h3>
                                        </div>
                                    </div>
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

<script>
    $(document).ready(function (){
        $.ajax({
            url:"http://127.0.0.1:8004/api/v1/statistic/count",
            type:"GET",
            headers:{'Authorization':'Bearer '+ localStorage.getItem('user_token')},
            success:function (data){
                $('#stockCount').html(data.data.orderCount);
                $('#productCount').html(data.data.productCount);
                $('#orderCount').html(data.data.orderCount);
                $('#userName').html("Welcome "+data.data.userName + " 🎉");
            },
            error: function(xhr, textStatus, errorThrown) {
                alert(xhr.responseJSON.data.error.message);
            }
        });
    });
</script>

</body>
</html>
