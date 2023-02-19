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
                                <h5 class="card-header">Product Form</h5>
                                <form id="productForm">


                                    <div class="card-body">
                                        <div class="mb-3 row">
                                            <label for="html5-text-input" class="col-md-2 col-form-label">Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" name="name" type="text" placeholder="Name"
                                                       id="html5-text-input"/>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="html5-text-input"
                                                   class="col-md-2 col-form-label">Barcode</label>
                                            <div class="col-md-10">
                                                <input class="form-control" name="barcode" type="text"
                                                       placeholder="Barcode"
                                                       id="html5-text-input"/>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="html5-text-input" class="col-md-2 col-form-label">Brand</label>
                                            <div class="col-md-10">
                                                <input class="form-control" name="brand" type="text" placeholder="Brand"
                                                       id="html5-text-input"/>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="html5-text-input" class="col-md-2 col-form-label">Vat</label>
                                            <div class="col-md-10">
                                                <input class="form-control" name="vat" type="number" step="0.01" placeholder="Vat"
                                                       id="html5-text-input"/>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="html5-text-input" class="col-md-2 col-form-label">Price</label>
                                            <div class="col-md-10">
                                                <input class="form-control" name="price" type="number" step="0.01" placeholder="Price"
                                                       id="html5-text-input"/>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="html5-text-input"
                                                   class="col-md-2 col-form-label">Category</label>
                                            <div class="col-md-10">
                                                <select name="category_id" class="form-select"
                                                        id="categoryOptions"
                                                        aria-label="Default select example">
                                                </select>
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

<!-- Main JS -->
<script src="/assets/js/main.js"></script>


<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script>
    $(document).ready(function () {

        $.ajax({
            url:"http://127.0.0.1:8004/api/v1/product/categories",
            type:"GET",
            headers:{'Authorization':'Bearer '+ localStorage.getItem('user_token')},
            success:function (data){
                $.each(data.data, function(index, value) {
                    $("#categoryOptions").append(
                        $('<option></option>').val(value.id).html(value.name)
                    );
                });
            },
            error: function(xhr, textStatus, errorThrown) {
                alert(xhr);
            }
        });


        $("#productForm").submit(function (event) {
            event.preventDefault();
            var formData = $(this).serializeArray();

            $.ajax({
                url: "http://127.0.0.1:8004/api/v1/product/create",
                type: "POST",
                data: formData,
                headers: {'Authorization': 'Bearer ' + localStorage.getItem('user_token')},
                success: function (data) {
                    //alert(data.message);
                    window.open("/products","_self");
                },
                error: function (xhr, textStatus, errorThrown) {
                    alert(xhr.responseJSON.data.error.message);
                }
            });
        });
    });
</script>
</body>
</html>
