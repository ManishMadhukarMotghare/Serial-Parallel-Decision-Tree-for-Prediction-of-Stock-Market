<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Aone
{
    private function __construct() {
        
    }
    
}

function BlogContentformat($Content) {
    $Content = str_replace('\r\n', " ", $Content);
    $Content = str_replace("\r\n", " ", $Content);
    $Content = str_replace("\r", " ", $Content);
    $Content = str_replace('\n', " ", $Content);

    return $Content;
}

function StrReplace($Content)
{
    $Content = str_replace('|', ",", trim($Content));
    return $Content;
}

function FetchHubBranches($HUB)
{
    
}