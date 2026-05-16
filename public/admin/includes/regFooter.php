</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/jquery.js"></script>
<script>
$(document).ready(function() {

    $('.--btn-register').on('click', function(e) {
        e.preventDefault();

        let name = $('#name').val();
        let email = $('#email').val();
        let password = $('#password').val();

        $.ajax({
            url: '../../handlers/create_registrar.php',
            method: "post",
            data: {
                'register': true,
                'name': name,
                'email': email,
                'password': password
            },
            dataType: 'json',

            success: function(response) {
                if (response.error) {
                    alert(response.error); // simple like your reference
                } else {
                    alert(response.success);

                    $('#createForm')[0].reset();

                    setTimeout(() => {
                        document.getElementById('createModal').close();
                        location.reload();
                    }, 500);
                }
            },

            error: function(xhr, status, error) {
                console.log("XHR:", xhr.responseText);
                console.log("STATUS:", status);
                console.log("ERROR:", error);

                alert("Request failed. Check console.");
            }
        });
    });

});
</script>

</html>