<?php
/* 
 * Project: ODDS & ENDS
 * File: /classes/viewmodel.php
 * Purpose: class for the optional data object returned by model methods which the controller sends to the view.
 * Author: Robert Dziuba & Inga Schwarze
 * 
 * 
 * Behälter, indem Daten vom Model in die View gegeben werden
 */

class ViewModel {    
    
    //dynamically adds a property or method to the ViewModel instance
    public function set($name,$val) {
        $this->$name = $val;
    }
    
    //returns the requested property value
    public function get($name) {
        if (isset($this->{$name})) {
            return $this->{$name};
        } else {
            return null;
        }
    }
}

?>