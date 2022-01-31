<?php

$DocumentRoot = $_SERVER['DOCUMENT_ROOT'];
$Filename = explode('/', $_SERVER['SCRIPT_NAME']);
$Level = count($Filename) - 1;
$includePath = "";
//echo $Level;
$flag = FALSE;


if ($Level == 0) {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/RGVPConfig.php')) {
        $includePath = $_SERVER['DOCUMENT_ROOT'] . '/RGVPConfig.php';
        $flag = TRUE;
    }
} else if ($Level == 1) {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/RGVPConfig.php')) {
        $includePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/RGVPConfig.php';
        $flag = TRUE;
    }
} else if ($Level == 2) {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/RGVPConfig.php')) {
        $includePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/RGVPConfig.php';
        $flag = TRUE;
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/RGVPConfig.php')) {
        $includePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/RGVPConfig.php';
        $flag = TRUE;
    }
} else if ($Level == 3) {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/RGVPConfig.php')) {
        $includePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/RGVPConfig.php';
        $flag = TRUE;
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/RGVPConfig.php')) {
        $includePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/RGVPConfig.php';
        $flag = TRUE;
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/RGVPConfig.php')) {
        $includePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/RGVPConfig.php';
        $flag = TRUE;
    }
} else if ($Level == 4) {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/RGVPConfig.php')) {
        $includePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/RGVPConfig.php';
        $flag = TRUE;
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/RGVPConfig.php')) {
        $includePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/RGVPConfig.php';
        $flag = TRUE;
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/RGVPConfig.php')) {
        $includePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/RGVPConfig.php';
        $flag = TRUE;
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3] . '/RGVPConfig.php')) {
        $includePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3] . '/RGVPConfig.php';
        $flag = TRUE;
    }
} else if ($Level == 5) {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/RGVPConfig.php')) {
        $includePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/RGVPConfig.php';
        $flag = TRUE;
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/RGVPConfig.php')) {
        $includePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/RGVPConfig.php';
        $flag = TRUE;
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/RGVPConfig.php')) {
        $includePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/RGVPConfig.php';
        $flag = TRUE;
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3] . '/RGVPConfig.php')) {
        $includePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3] . '/RGVPConfig.php';
        $flag = TRUE;
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3] . '/' . $Filename[4] . '/RGVPConfig.php')) {
        $includePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3] . '/' . $Filename[4] . '/RGVPConfig.php';
        $flag = TRUE;
    }
}
include $includePath;
