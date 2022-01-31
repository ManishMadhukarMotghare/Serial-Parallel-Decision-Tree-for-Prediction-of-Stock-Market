<?php

/**
 * Author: RG-VP Web Solutions
 * Author URL: http://websiteinnagpur.com
 * License: Binded to use for personal use But Not to modify and Redistribute for commercial use.
 * Description: This File contains Necessary Working Classes and Objects to be used to run the Website.
 * Version: RGVP-Core 1.0
 */

class RGVPFiles
{
   static function ListFiles($SourceFolder,$RootPath)
{
// Create recursive directory iterator
/** @var SplFileInfo[] $files */
try{
       $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($_SERVER['DOCUMENT_ROOT'].$RootPath.$SourceFolder),RecursiveIteratorIterator::LEAVES_ONLY);
$ReturnTable = '<table class="table table-bordered table-hover table-responsive"><tr><th>SN</th><th>FileName</th><th>Copy FilePath</th><th style="width:20%;">FileSize</th><th style="width:20%;">Download</th></tr>';
$file_count=1;
foreach ($files as $name => $file)
{
	if (!$file->isDir()){
	//$filePath = '/kunden/'.$file->getRealPath();
        $filePath = $file->getRealPath();
        //$relativePath = split($RootPath, $filePath)[0];
	$relativePath = substr($filePath, strlen($_SERVER['DOCUMENT_ROOT'].$RootPath));
	$filename = substr($filePath,strlen($_SERVER['DOCUMENT_ROOT'].$RootPath.$SourceFolder));
        $ReturnTable.= '<tr><td>'.$file_count++.'</td><td>'.$filename.'</td><td>'.''.$relativePath.'</td><td  style="text-align:center">'.number_format($file->getSize()/1024,2).' KB</td><td style="text-align:center"><a href='.$RootPath. $relativePath.' target="_blank">Download</a></td></tr>';
    }
	// Skip directories (they would be added automatically)
    
//    {
//        // Get real and relative path for current file
//        $filePath = $file->getRealPath();
//        $relativePath = substr($filePath, strlen($RootPath.$SourceFolder) + 1);
//        // Add current file to archive
//        $zip->addFile($filePath, $relativePath);
//    }
}
$ReturnTable.= '</table>';
// close and save archive
return $ReturnTable;
//$zip->close(); 
}
 catch (Exception $ex)
 {
    return 'Requested Folder Path: '.$_SERVER['DOCUMENT_ROOT'].$RootPath.$SourceFolder.' Message: ' .$ex->getMessage(); 
 }
}

    
}
