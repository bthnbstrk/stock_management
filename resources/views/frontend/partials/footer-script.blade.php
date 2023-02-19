<script src="/assets/vendor/libs/jquery/jquery.js"></script>
<script src="/assets/vendor/libs/popper/popper.js"></script>
<script src="/assets/vendor/js/bootstrap.js"></script>
<script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/assets/vendor/js/menu.js"></script>

<script>
    $(document).ready(function (){
        $("#logOut").click(function (){
            $.ajax({
                url:"http://127.0.0.1:8004/api/v1/auth/logout",
                type:"GET",
                headers:{'Authorization':'Bearer '+ localStorage.getItem('user_token')},
                success:function (data){
                    localStorage.removeItem('user_token');
                    window.open("/","_self");
                },
                error: function(xhr) {
                    console.log("Logout failed")
                    console.log(xhr.responseJSON.data.error.message)
                }
            });
        });
    });

</script>
