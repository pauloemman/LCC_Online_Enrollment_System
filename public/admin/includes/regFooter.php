</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/jquery.js"></script>
<script>
    $(document).ready(function () {

        // create account
        $('.--btn-register').on('click', function (e) {
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

                success: function (response) {
                    if (response.error) {
                        alert(response.error);
                    } else {
                        alert(response.success);

                        $('#createForm')[0].reset();

                        setTimeout(() => {
                            document.getElementById('createModal').close();
                            location.reload();
                        }, 500);
                    }
                },

                error: function (xhr, status, error) {
                    console.log("XHR:", xhr.responseText);
                    console.log("STATUS:", status);
                    console.log("ERROR:", error);

                    alert("Request failed. Check console.");
                }
            });
        });

        // OPEN EDIT MODAL
        $(document).on('click', '.--btn-edit', function () {

            let name = $(this).data('name');
            let email = $(this).data('email');

            $('#editName').val(name);
            $('#editEmail').val(email);
            $('#editPassword').val('');

            editModal.showModal();
        });

        // edit account
        $('.--btn-update').on('click', function (e) {

            e.preventDefault();

            // Grab values
            const name = $('#editName').val().trim();
            const email = $('#editEmail').val().trim();
            const password = $('#editPassword').val().trim();

            // Prepare form data
            let formData = new FormData();

            formData.append('update_profile', true);
            formData.append('name', name);
            formData.append('email', email);
            formData.append('password', password);

            // AJAX REQUEST
            $.ajax({

                url: '../../handlers/edit_registrar.php',
                method: 'POST',
                data: formData,

                processData: false,
                contentType: false,
                dataType: 'json',

                success: function (response) {

                    if (response.success) {

                        alert("Registrar updated successfully!");

                        editModal.close();
                        location.reload();

                    } else {

                        alert(response.error || "Failed to update registrar.");

                    }
                },

                error: function (xhr, status, error) {

                    console.log(xhr.responseText);

                    alert("AJAX error: " + error);

                }

            });

        });

        //delete account
        $(document).on('click', '.--btn-delete', function (e) {

            e.preventDefault();

            let id = $(this).data('id');
            let row = $(this).closest('tr');

            if (!id) {
                alert('Invalid registrar ID.');
                return;
            }

            if (confirm('Are you sure you want to delete this Account?')) {

                $.ajax({
                    url: '../../handlers/delete_registrar.php',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function (response) {

                        if (response.success) {

                            row.remove();
                            alert(response.success);

                        } else if (response.error) {

                            alert(response.error);

                        } else {

                            alert('Something went wrong.');

                        }
                    },

                    error: function (xhr) {

                        console.error(xhr.responseText);
                        alert('An error occurred while processing the request.');

                    }
                });
            }
        });

    });
</script>

</html>