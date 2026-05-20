<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/jquery.js"></script>

<!-- Tom Select -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<style>
/* scrollbar inside dropdown */
.ts-dropdown-content {
    max-height: 120px !important;
    overflow-y: auto !important;
    scrollbar-width: thin;
}

/* chrome scrollbar */
.ts-dropdown-content::-webkit-scrollbar {
    width: 6px;
}

.ts-dropdown-content::-webkit-scrollbar-thumb {
    background: #94a3b8;
    border-radius: 10px;
}
</style>

<script>
$(document).ready(function() {

    // 1. OPEN EDIT MODAL & POPULATE FIELDS DYNAMICALLY
    $(document).on('click', '.--btn-edit', function() {
        const id = $(this).data('id');
        const subjectId = $(this).data('cid');
        const prerequisiteId = $(this).data('pid');

        // Populate fields inside editModal
        $('#id').val(id);
        $('#editSubjectId').val(subjectId);
        $('#editPrerequisiteSubjectId').val(prerequisiteId);

        // Reset alert errors
        $('#editFormAlert').addClass('hidden').text('');

        // Trigger DaisyUI modal open process
        document.getElementById('editModal').showModal();
    });

    // 2. CREATE EVENT TRIGGER (--btn-register)
    $(document).on('click', '.--btn-register', function() {
        const targetSubject = $('#subjectId').val();
        const prereqSubject = $('#prerequisiteSubjectId').val();

        if (!targetSubject || !prereqSubject) {
            $('#formAlert').removeClass('hidden').text('Please fill in all mandatory fields.');
            return;
        }

        if (targetSubject === prereqSubject) {
            $('#formAlert').removeClass('hidden').text(
                'A course cannot be its own prerequisite requirements.');
            return;
        }

        // Logic placeholder for your AJAX / Submission script:
        console.log("Applying constraint mapping setup...", {
            targetSubject,
            prereqSubject
        });
        // After success processing, run: createModal.close();
    });

    // 3. UPDATE EVENT TRIGGER (--btn-update)
    $(document).on('click', '.--btn-update', function() {
        const rowId = $('#id').val();
        const targetSubject = $('#editSubjectId').val();
        const prereqSubject = $('#editPrerequisiteSubjectId').val();

        if (!targetSubject || !prereqSubject) {
            $('#editFormAlert').removeClass('hidden').text('Please select both dependency parameters.');
            return;
        }

        if (targetSubject === prereqSubject) {
            $('#editFormAlert').removeClass('hidden').text('Circular dependencies are not permitted.');
            return;
        }

        // Logic placeholder for your AJAX / Submission updates:
        console.log("Modifying existing requirement layout configuration...", {
            rowId,
            targetSubject,
            prereqSubject
        });
        // After success processing, run: editModal.close();
    });

    // 4. DELETE EVENT TRIGGER (--btn-delete)
    $(document).on('click', '.--btn-delete', function() {
        const targetId = $(this).data('id');

        if (confirm("Are you sure you want to drop this validation requirement constraint rule?")) {
            console.log("Dropping curriculum validation restriction rule with ID:", targetId);
            // execute your elimination routines or deletion window actions here.
        }
    });

});

$(document).ready(function() {

    ///////////////////////////// ADD /////////////////////////////
    // SUBJECT SELECT
    const subjectSelect = new TomSelect("#subjectId", {
        create: false,
        maxOptions: 3,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

    // PREREQUISITE SELECT
    const prerequisiteSelect = new TomSelect("#prerequisiteSubjectId", {
        create: false,
        maxOptions: 3,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

    // prevent selecting same subject
    subjectSelect.on("change", function(value) {

        // enable all options first
        prerequisiteSelect.enable();

        // remove disabled state
        Object.values(prerequisiteSelect.options).forEach(option => {
            option.disabled = false;
        });

        // disable selected subject in prerequisite
        if (value) {
            prerequisiteSelect.options[value].disabled = true;

            // clear if same value already selected
            if (prerequisiteSelect.getValue() == value) {
                prerequisiteSelect.clear();
            }
        }

        prerequisiteSelect.refreshOptions(false);
    });

    ///////////////////////////// EDIT /////////////////////////////
    // SUBJECT SELECT
    const editSubjectSelect = new TomSelect("#editSubjectId", {
        create: false,
        maxOptions: 3,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

    // PREREQUISITE SELECT
    const editPrerequisiteSelect = new TomSelect("#editPrerequisiteSubjectId", {
        create: false,
        maxOptions: 3,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

    // prevent selecting same subject
    editSubjectSelect.on("change", function(value) {

        // enable all options first
        editPrerequisiteSelect.enable();

        // remove disabled state
        Object.values(editPrerequisiteSelect.options).forEach(option => {
            option.disabled = false;
        });

        // disable selected subject in prerequisite
        if (value) {
            editPrerequisiteSelect.options[value].disabled = true;

            // clear if same value already selected
            if (editPrerequisiteSelect.getValue() == value) {
                editPrerequisiteSelect.clear();
            }
        }

        editPrerequisiteSelect.refreshOptions(false);
    });

    /////////////////////////////  /////////////////////////////

    //create prerequisite
    $('.--btn-register').on('click', function(e) {

        e.preventDefault();

        let subjectId = $('#subjectId').val();
        let prerequisiteSubjectId = $('#prerequisiteSubjectId').val();

        $.ajax({
            url: '../../handlers/create_prerequisite.php',
            method: "POST",

            data: {
                register: true,
                subjectId: subjectId,
                prerequisiteSubjectId: prerequisiteSubjectId
            },

            dataType: 'json',

            success: function(response) {

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

            error: function(xhr, status, error) {

                console.log(xhr.responseText);
                console.log(status);
                console.log(error);

                alert("Request failed. Check console.");
            }
        });
    });

    //edit
    $(document).on('click', '.--btn-edit', function() {

        let id = $(this).data('id');
        let editSubjectId = $(this).data('editSubjectId');
        let editPrerequisiteSubjectId = $(this).data('editPrerequisiteSubjectId');

        $('#id').val(id);
        $('#editSubjectId').val(editSubjectId);
        $('#editPrerequisiteSubjectId').val(editPrerequisiteSubjectId);

        editModal.showModal();
    });

    //edit prerequisiste
    $('.--btn-update').on('click', function(e) {
        e.preventDefault();

        // Grab the values
        const id = $('#id').val().trim();
        const editSubjectId = $('#editSubjectId').val().trim();
        const editPrerequisiteSubjectId = $('#editPrerequisiteSubjectId').val().trim();

        // Prepare form data
        let formData = new FormData();
        formData.append('update_profile', true);
        formData.append('id', id);
        formData.append('editSubjectId', editSubjectId);
        formData.append('editPrerequisiteSubjectId', editPrerequisiteSubjectId);

        // AJAX request
        $.ajax({
            url: '../../handlers/edit_prerequisite.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {

                    alert("Prerequisite updated successfully!");

                    editModal.close();
                    location.reload();

                } else {
                    alert(response.error || "Failed to update prerequisite.");
                }
            },
            error: function(xhr, status, error) {
                alert("AJAX error: " + error);
            }
        });
    });

    //delete course
    $('.--btn-delete').on('click', function(e) {
        e.preventDefault();

        let id = $(this).data('id');
        let row = $(this).closest('tr');

        if (!id) {
            alert('Invalid prerequisite ID.');
            return;
        }

        if (confirm(
                'Are you sure you want to delete this prerequisite?'
            )) {
            $.ajax({
                url: '../../handlers/delete_prerequisite.php',
                method: 'POST',
                data: {
                    'id': id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        row.remove();
                        alert(response.success);
                    } else if (response.error) {
                        alert(response.error);
                    } else {
                        alert('Something went wrong.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr.responseText);
                    alert('An error occurred while processing the request.');
                }
            });
        }
    });

});
</script>

</body>

</html>