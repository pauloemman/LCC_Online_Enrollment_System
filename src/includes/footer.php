</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/jquery.js"></script>
<script>
$(document).ready(function() {

    // Signup
    $('.--btn-register').on('click', function(e) {
        e.preventDefault();

        let name = $('#name').val();
        let email = $('#email').val();
        let password = $('#password').val();

        $.ajax({
            url: '../handlers/register.php',
            method: "post",
            data: {
                'register': true, //
                'name': name,
                'email': email,
                'password': password,
            },

            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    alert(response.error);
                } else {
                    alert(response.success);
                }
            },
            error: function(xhr, response) {
                console.log(xhr + response);
            }
        });
    });

    // Login
    $('.--btn-login').on('click', function(e) {
        e.preventDefault();

        let login_email = $('#login_email').val();
        let login_password = $('#login_password').val();

        $.ajax({
            url: '../handlers/login.php',
            method: "post",
            data: {
                'login': true,
                'login_email': login_email,
                'login_password': login_password
            },
            dataType: 'json',
            success: function(response) {
                if (response.redirect) {
                    window.location.href = response.redirect;
                } else {
                    alert(response.error);
                }
            },
            error: function(xhr, response) {
                console.log(xhr + response);
            }
        });
    });

});
</script>

</html>