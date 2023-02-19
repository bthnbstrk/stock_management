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
    <link rel="stylesheet" href="/assets/vendor/css/pages/page-auth.css" />
</head>

<body style="background-color: #C32721">

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="https://www.ciloglu.de/tr/" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                   <img src="https://docs.tuyap.online/KBF/Resim2990/129682.jpg" alt="ciloglu.com" width="100">
                  </span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <form id="loginForm" class="mb-3">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="text"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="Enter your email or username"
                                autofocus
                            />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password"
                                />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-danger d-grid w-100" type="submit">Sign in</button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
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
        $("#loginForm").submit(function (event){
            event.preventDefault();
            $.ajax({
                url:"http://127.0.0.1:8004/api/v1/login",
                type:"POST",
                data:$(this).serializeArray(),
                success:function (data){
                    if(data.status==="success"){
                        localStorage.setItem("user_token",data.data.access_token);
                        window.open("/home","_self");
                    }
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
