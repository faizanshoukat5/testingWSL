<script type="text/javascript">
function sessionHeaderStart() {
    var idSY = $("#headStart").val();
    $.ajax({
        type: "POST",
        url: "../components/sessionYearState.php",
        data: 'intakeYear=' + idSY,
        success: function(data) {
            Swal.fire({
                title: 'Session!',
                text: 'Session Change Successfully.',
                icon: 'success'
            }).then((result) => {
                window.location.reload();
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
            });
        }
    });
}

$(document).ready(function() {
    var tableId = "datatable";
    var storageKey = 'DataTables_' + tableId + '_' + window.location.pathname;
    var currentPath = window.location.pathname;
    // Function to clear the stored state
    function clearStoredState() {
        localStorage.removeItem(storageKey);
    }
    // Check if the current URL matches the stored URL
    var storedPath = localStorage.getItem('lastPath');
    if (storedPath !== currentPath) {
        clearStoredState();
        localStorage.setItem('lastPath', currentPath);
    }
    var table = $("#" + tableId).DataTable({
        stateSave: true,
        stateDuration: -1,
        pageResetOnReload: true,
        order: [
            [0, 'desc']
        ],
        lengthMenu: [
            [25, 10, 50, 100, 200, 500, ],
            [25, 10, 50, 100, 200, 500, ]
        ],
    });
    // Reset search bar and pagination if the path has changed
    if (storedPath !== currentPath) {
        table.page('first').draw('page');
        table.search('').draw();
    } else if (localStorage.getItem(storageKey)) {
        // Only restore state if on the same page
        var state = JSON.parse(localStorage.getItem(storageKey));
        var page = state.start / state.length;
        table.page(page).draw('page');
    }
});

$(document).ready(function() {
    // form-validation init
    $(".parsley-examples").parsley();
    // select2 inti
    $('[data-toggle="select2"]').select2();
});

function del(x, y) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3461ff',
        cancelButtonColor: '#C62E2E',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: "No, cancel!"
    }).then((result) => {
        if (result.isConfirmed) {
            x(y);
        } else {
            Swal.fire('Cancelled', 'Your imaginary record is safe :)', 'error');
        }
    })
}
</script>
<script type="text/javascript">
// View client function
function ViewClients(idclient) {
    var idclient = idclient;
    // alert(idclient);
    $.ajax({
        type: "POST",
        url: "models/trackState.php",
        data: 'viewClients=' + idclient,
        success: function(data) {
            $(".viewModalClient").html(data);
            $("#viewModalClient").modal('show');
        }
    });
};

function downloadZip(id) {
    var clientId = id;
    $.ajax({
        type: "POST",
        url: "getState.php",
        data: {
            clientDocAdmission: clientId
        },
        success: function(response) {
            try {
                var result = JSON.parse(response);
                if (result.zipFile) {
                    const link = document.createElement('a');
                    link.href = result.zipFile;
                    link.download = result.zipFile.split('/').pop();
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                } else if (result.error) {
                    console.error('Error:', result.error);
                }
            } catch (e) {
                console.error('Error parsing JSON:', e);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
        }
    });
}
</script>
<script type="text/javascript">
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>
<?php

$wtUser = "SELECT password from wt_users WHERE close='1' AND wt_id='" . $_SESSION['user_id'] . "' ";
$wtUser_ex = mysqli_query($con, $wtUser);
$row = mysqli_fetch_assoc($wtUser_ex);
$password = $row['password'];
if ($password !== $_COOKIE['final_pass']) {
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Password!',
            text: 'Your password is changed',
            icon: 'success'
            }).then((result) => {
                window.location.href = 'log-out';
            });
        });
    </script>";
}
?>