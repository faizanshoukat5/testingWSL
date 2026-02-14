<?php
if (!empty($_COOKIE['user_id'])) {
    include_once 'env/main-config.php';
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['user_email'] = $_COOKIE['user_email'];
    $_SESSION['final_pass'] = $_COOKIE['final_pass'];
    $_SESSION['user_name'] = $_COOKIE['user_name'];
    $_SESSION['user_type'] = $_COOKIE['user_type'];
    $_SESSION['uname'] = $_COOKIE['uname'];
    $_SESSION['phone'] = $_COOKIE['phone'];
    $_SESSION['user_designation'] = $_COOKIE['user_designation'];
    $_SESSION['user_image'] = $_COOKIE['user_image'];
    $_SESSION['dbNo'] = $_COOKIE['dbNo'];
    $_SESSION['s_date'] = $_COOKIE['s_date'];
    $_SESSION['e_date'] = $_COOKIE['e_date'];

    if ($_SESSION['user_type'] == 'admin') {
        header('Location: super-admin/dashboard');
    } elseif ($_SESSION['user_type'] == 'sale department') {
        header('Location: sale-department/dashboard');
    } elseif ($_SESSION['user_type'] == 'team leader') {
        header('Location: team-leader/dashboard');
    } elseif ($_SESSION['user_type'] == 'team manager') {
        header('Location: team-manager/dashboard');
    } elseif ($_SESSION['user_type'] == 'accountant') {
        header('Location: accountant/dashboard');
    } elseif ($_SESSION['user_type'] == 'documents collections' || $_SESSION['user_type'] == 'documents collections france') {
        header('Location: documents-collections/dashboard');
    } elseif ($_SESSION['user_type'] == 'documents collections team') {
        header('Location: documents-collections-team/dashboard');
    }

    // Austria portal
    elseif ($_SESSION['user_type'] == 'austria admission head') {
        header('Location: austria-admission-head/dashboard');
    } elseif ($_SESSION['user_type'] == 'austria admission team') {
        header('Location: austria-admission-team/dashboard');
    } elseif ($_SESSION['user_type'] == 'austria visa team') {
        header('Location: austria-visa-team/dashboard');
    } elseif ($_SESSION['user_type'] == 'austria university sop') {
        header('Location: university-sop-team/dashboard');
    }
    // italy portal
    elseif ($_SESSION['user_type'] == 'italy admission head') {
        header('Location: italy-admission-head/admission-dashboard');
    } elseif ($_SESSION['user_type'] == 'italy admission team') {
        header('Location: italy-admission-team/dashboard');
    } elseif ($_SESSION['user_type'] == 'italy visa team') {
        header('Location: italy-visa-team/dashboard');
    } elseif ($_SESSION['user_type'] == 'italy university sop') {
        header('Location: university-sop-team/dashboard');
    }
    // Czech Republic portal
    elseif ($_SESSION['user_type'] == 'czech republic admission head') {
        header('Location: czech-republic-admission-head/admission-dashboard');
    } elseif ($_SESSION['user_type'] == 'czech republic admission team') {
        header('Location: czech-republic-admission-team/dashboard');
    } elseif ($_SESSION['user_type'] == 'czech republic visa team') {
        header('Location: czech-republic-visa-team/dashboard');
    } elseif ($_SESSION['user_type'] == 'czech republic university sop') {
        header('Location: university-sop-team/dashboard');
    }
    // france portal
    elseif ($_SESSION['user_type'] == 'france admission head') {
        header('Location: france-admission-head/admission-dashboard');
    } elseif ($_SESSION['user_type'] == 'france admission team') {
        header('Location: france-admission-team/dashboard');
    } elseif ($_SESSION['user_type'] == 'france visa team') {
        header('Location: france-visa-team/dashboard');
    } elseif ($_SESSION['user_type'] == 'france university sop') {
        header('Location: university-sop-team/dashboard');
    }
     elseif ($_SESSION['user_type'] == 'IELTS Enrollment') {
        header('Location: ielts-enrollment/dashboard');
    }
     elseif ($_SESSION['user_type'] == 'Data Collections') {
        header('Location: data-collection/dashboard');
    }
     elseif ($_SESSION['user_type'] == 'Call Center') {
        header('Location: call-center/dashboard');
    }
    // header('Location: '.$SERVER['HTTP_REFERER']);
}
