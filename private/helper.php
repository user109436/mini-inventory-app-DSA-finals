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
