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
                                <h5 class="card-header">Order Form</h5>
                                <form id="orderForm">
                                    <div class="card-body">
                                        <div class="mb-3 row">
                                            <label for="html5-text-input" class="col-md-2 col-form-label">Name</label>
                                            <div class="col-md-10">
                                                <input name="name" class="form-control" type="text" placeholder="Name" id="name" />
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="html5-text-input" class="col-md-2 col-form-label">Customer</label>
                                            <div class="col-md-10">
                                                <select name="customer_id" class="form-select" id="customerOptions" aria-label="Default select example">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="html5-text-input" class="col-md-2 col-form-label">Product</label>
                                            <div class="col-md-10">
                                                <select name="product_id"  class="form-select" id="productOptions" aria-label="Default select example">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="html5-text-input" class="col-md-2 col-form-label">Amount</label>
                                            <div class="col-md-10">
                                                <input name="amount" class="form-control" type="number" placeholder="Amount" id="amount" />
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="html5-text-input" class="col-md-2 col-form-label">Delivery Date</label>
                                            <div class="col-md-10">
                                                <input name="delivery_date" class="form-control" type="date" placeholder="Brand" id="delivery_date" />
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
    $(document).ready(function () {
        $.ajax({
            url:"http://127.0.0.1:8004/api/v1/customer/all",
            type:"GET",
            headers:{'Authorization':'Bearer '+ localStorage.getItem('user_token')},
            success:function (data){
                console.log(data)
                $.each(data.data, function(index, value) {
                    $("#customerOptions").append(
                        $('<option></option>').val(value.id).html(value.name + value.surname)
                    );
                });
            },
            error: function(xhr, textStatus, errorThrown) {
                alert(xhr.responseJSON.data.error.message);
            }
        });
        $.ajax({
            url:"http://127.0.0.1:8004/api/v1/product/all",
            type:"GET",
            headers:{'Authorization':'Bearer '+ localStorage.getItem('user_token')},
            success:function (data){
                console.log(data)
                $.each(data.data, function(index, value) {
                    $("#productOptions").append(
                        $('<option></option>').val(value.id).html(value.name)
                    );
                });
            },
            error: function(xhr, textStatus, errorThrown) {
                alert(xhr.responseJSON.data.error.message);
            }
        });

        $("#orderForm").submit(function (event){
            event.preventDefault();

            var name = $("#name").val();
            var customer_id = $("#customerOptions").val();
            var product_id = $("#productOptions").val();
            var amount = $("#amount").val();
            var delivery_date = $("#delivery_date").val();

            var products = [{
                "id": parseInt(product_id),
                "amount":amount,
            }];

            $.ajax({
                url:"http://127.0.0.1:8004/api/v1/order/create",
                type:"POST",
                data:{name:name,customer_id:customer_id,products:products,delivery_date:delivery_date},
                headers:{'Authorization':'Bearer '+ localStorage.getItem('user_token')},
                success:function (data){
                    window.open("/orders","_self");
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
