<?php
session_start();

function error()
{
    if (isset($_SESSION['errormessage'])) {
        echo 'test';
        $output = "<div class='alert alert-danger'>";
        $output .= htmlentities($_SESSION['errormessage']);
        $output .= "</div>";
        $_SESSION['errormessage'] = null;
        echo $output;
    } else {
        echo 'no test';
    }
}
function success()
{
    if (isset($_SESSION['successmessage'])) {
        $output = "<div class='alert alert-success'>";
        $output .= htmlentities($_SESSION['successmessage']);
        $output .= "</div>";
        $_SESSION['successmessage'] = null;
        echo $output;
    }
}
function warning()
{
    if (isset($_SESSION['warningmessage'])) {
        $output = "<div class='alert alert-warning'>";
        $output .= htmlentities($_SESSION['warningmessage']);
        $output .= "</div>";
        $_SESSION['warningmessage'] = null;
        echo $output;
    }
}
function info()
{
    if (isset($_SESSION['infomessage'])) {
        $output = "<div class='alert alert-info'>";
        $output .= htmlentities($_SESSION['infomessage']);
        $output .= "</div>";
        $_SESSION['infomessage'] = null;
        echo $output;
    }
}
