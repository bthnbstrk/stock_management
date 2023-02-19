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
                                <h5 class="card-header">Customer Form</h5>
                                <form id="customerForm">
                                    <div class="card-body">
                                        <div class="mb-3 row">
                                            <label for="html5-text-input" class="col-md-2 col-form-label">Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" name="name" type="text" placeholder="Name" id="html5-text-input" />
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="html5-text-input" class="col-md-2 col-form-label">Surname</label>
                                            <div class="col-md-10">
                                                <input class="form-control"  name="surname" type="text" placeholder="Surname" id="html5-text-input" />
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="html5-text-input" class="col-md-2 col-form-label">Delivery Address</label>
                                            <div class="col-md-10">
                                                <input class="form-control" name="delivery_address" type="text" placeholder="Brand" id="html5-text-input" />
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="html5-text-input" class="col-md-2 col-form-label">E-mail</label>
                                            <div class="col-md-10">
                                                <input class="form-control" name="email_address" type="text" placeholder="E-mail" id="html5-text-input" />
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="html5-text-input" class="col-md-2 col-form-label">Phone Number</label>
                                            <div class="col-md-10">
                                                <input class="form-control" name="phone_number" type="text" placeholder="Phone Number" id="html5-text-input" />
                                            </div>
                                        </div>

                                        <button class="btn btn-success d-grid " type="submit">Add</button>
                                    </div>
                                </form>
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
        $("#customerForm").submit(function (event){
            event.preventDefault();
            var formData=$(this).serializeArray();
            $.ajax({
                url:"http://127.0.0.1:8004/api/v1/customer/create",
                type:"POST",
                data:formData,
                headers:{'Authorization':'Bearer '+ localStorage.getItem('user_token')},
                success:function (data){
                    window.open("/customers","_self");
                    //alert(data.message);
                },
                error: function(xhr, textStatus, errorThrown) {
                    alert(xhr.responseJSON.data.error.message);
                }
            });
        });
    });
</script>

</body>
</html>
