</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/jquery.js"></script>
<script>
    $(document).ready(function () {

        //VERIFY ACCOUNT
        $(document).on('click', '.--btn-verify', function (e) {

            e.preventDefault();

            let id = $(this).data('id');
            let row = $(this).closest('tr');

            if (!id) {
                alert('Invalid account ID.');
                return;
            }

            if (confirm('Do you want to verify this account?')) {

                $.ajax({

                    url: '../../handlers/verify_registrar.php',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function (response) {

                        if (response.success) {

                            // CHANGE STATUS TEXT
                            row.find('td:eq(2)').html('active');

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

        //delete account
        $(document).on('click', '.--btn-delete', function (e) {

            e.preventDefault();

            let id = $(this).data('id');
            let row = $(this).closest('tr');

            if (!id) {
                alert('Invalid account ID.');
                return;
            }

            if (confirm('Are you sure you want to delete this Account?')) {

                $.ajax({
                    url: '../../handlers/delete_verAccount.php',
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