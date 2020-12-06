<?php
function printArr($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}
function error($msg = "Error in Query", $errorNum = 1)
{
    return '<div class="col-12 alert alert-danger" role="alert">' . $errorNum . ' ' . $msg . '</div>';
}
function warning($msg = "0 Results")
{
    return '<div class="col-12 alert alert-warning" role="alert">' . $msg . '</div>';
}
function success($msg = "Success")
{
    return '<div class="col-12 alert alert-success" role="alert">' . $msg . '</div>';
}
function validateParamID($param = "")
{
    if (isset($_GET[$param]) && filter_var($_GET[$param], FILTER_VALIDATE_INT)) {
        return true;
    }
    return false;
}
function noEmptyField($fields, $msg = "Error(s)! Please Fill up the required field(s)")
{
    $errors = 0;
    foreach ($fields as $field) {
        if ($field == null) {
            $errors++;
        }
    }
    if ($errors > 0) {
        // printArr($fields);
        echo error($msg, $errors);
        return false;
    }
    return true;
}
function sanitizeInput($fields)
{
    global $conn;
    foreach ($fields as $field) {
        $field = htmlentities(htmlspecialchars($conn->real_escape_string($field)));
        $fieldInfo[] = filter_var($field, FILTER_SANITIZE_STRING);
    }
    return $fieldInfo;
}

function sanitizeSingle($sanitize)
{
    global $conn;
    $sanitize = htmlentities(htmlspecialchars($conn->real_escape_string($sanitize)));
    return $sanitize = filter_var($sanitize, FILTER_SANITIZE_STRING);
}
