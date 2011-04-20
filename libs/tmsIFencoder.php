<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace tmsFormManager;

interface IFencoder{
    public function ReloadConfigfile(){}    // load configuration into array
    public function setConfigfile(){}       // set path to configuration file
}
?>
