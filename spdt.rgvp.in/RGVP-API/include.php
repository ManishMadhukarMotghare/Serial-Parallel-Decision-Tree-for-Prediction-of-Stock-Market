<?php
/**
 * Author: RG-VP Web Solutions
 * Author URL: http://websiteinnagpur.com
 * License: Binded to use for personal use But Not to modify and Redistribute for commercial use.
 * Description: This File is used to Include Core File, Should be present at each Project Working Folder.
 * Version: RGVP-Core 1.0
 */

$DocumentRoot = $_SERVER['DOCUMENT_ROOT'] ;
$IncludeFileName = "RGVPConfig.php";
$Filename = explode('/', $_SERVER['SCRIPT_NAME']);
$Level = count($Filename) - 1;
$includePath = "";
$flag = FALSE;
if ($Level == 0) {
    if (file_exists($DocumentRoot . $IncludeFileName)) {
        $includePath = $DocumentRoot . $IncludeFileName;
        $flag = TRUE;
    }
} else if ($Level == 1) {
    if (file_exists($DocumentRoot .  $Filename[0]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0]. '/' . $IncludeFileName;
        $flag = TRUE;
    }
} else if ($Level == 2) {
    if (file_exists($DocumentRoot .  $Filename[0] . '/' . $Filename[1]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0] . '/' . $Filename[1]. '/' . $IncludeFileName;
        $flag = TRUE;
    } else if (file_exists($DocumentRoot .  $Filename[0]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0]. '/' . $IncludeFileName;
        $flag = TRUE;
    }
} else if ($Level == 3) {
    if (file_exists($DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3]. '/' . $IncludeFileName;
        $flag = TRUE;
    } else if (file_exists($DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2]. '/' . $IncludeFileName;
        $flag = TRUE;
    } else if (file_exists($DocumentRoot .  $Filename[0] . '/' . $Filename[1]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0] . '/' . $Filename[1]. '/' . $IncludeFileName;
        $flag = TRUE;
    } else if (file_exists($DocumentRoot .  $Filename[0]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0]. '/' . $IncludeFileName;
        $flag = TRUE;
    }
} else if ($Level == 4) {
    if (file_exists($DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3]. '/' . $IncludeFileName;
        $flag = TRUE;
    } else if (file_exists($DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2]. '/' . $IncludeFileName;
        $flag = TRUE;
    } else if (file_exists($DocumentRoot .  $Filename[0] . '/' . $Filename[1]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0] . '/' . $Filename[1]. '/' . $IncludeFileName;
        $flag = TRUE;
    } else if (file_exists($DocumentRoot .  $Filename[0]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0]. '/' . $IncludeFileName;
        $flag = TRUE;
    }
} else if ($Level == 5) {
    if (file_exists($DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3] . '/' . $Filename[4]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3] . '/' . $Filename[4]. '/' . $IncludeFileName;
        $flag = TRUE;
    } else if (file_exists($DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3]. '/' . $IncludeFileName;
        $flag = TRUE;
    } else if (file_exists($DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2]. '/' . $IncludeFileName;
        $flag = TRUE;
    } else if (file_exists($DocumentRoot .  $Filename[0] . '/' . $Filename[1]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0] . '/' . $Filename[1]. '/' . $IncludeFileName;
        $flag = TRUE;
    } else if (file_exists($DocumentRoot .  $Filename[0]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0]. '/' . $IncludeFileName;
        $flag = TRUE;
    }
} else if ($Level == 6) {
    if (file_exists($DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3] . '/' . $Filename[4] .  '/' . $Filename[5]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3] . '/' . $Filename[4]. '/' . $Filename[5]  . $IncludeFileName;
        $flag = TRUE;
    }else if (file_exists($DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3] . '/' . $Filename[4]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3] . '/' . $Filename[4]. '/' . $IncludeFileName;
        $flag = TRUE;
    } else if (file_exists($DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2] . '/' . $Filename[3]. '/' . $IncludeFileName;
        $flag = TRUE;
    } else if (file_exists($DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0] . '/' . $Filename[1] . '/' . $Filename[2]. '/' . $IncludeFileName;
        $flag = TRUE;
    } else if (file_exists($DocumentRoot .  $Filename[0] . '/' . $Filename[1]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0] . '/' . $Filename[1]. '/' . $IncludeFileName;
        $flag = TRUE;
    } else if (file_exists($DocumentRoot .  $Filename[0]. '/' . $IncludeFileName)) {
        $includePath = $DocumentRoot .  $Filename[0]. '/' . $IncludeFileName;
        $flag = TRUE;
    }
}
//echo $includePath;
include $includePath;
