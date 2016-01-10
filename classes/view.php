<?php
/* 
 * Project: ODDS & ENDS
 * File: /classes/view.php
 * Purpose: class for the view object.
 * Author: Robert Dziuba & Inga Schwarze
 * 
 * LÄD die HTML Dateien ODER gibt Antwort als JSON weiter. JSON: Server kann PHP, JS kann Javascript -> Kommunikation: JSON
 */

class View {    
    
    protected $viewFile;
    
    //establish view location on object creation
    public function __construct($controllerClass, $action) {
        $controllerName = str_replace("Controller", "", $controllerClass);
        $this->viewFile = "views/" . $controllerName . "/" . $action . ".php";
    }

    //output the view
    public function output($viewModel, $template = "maintemplate") {
        
        $templateFile = "views/".$template.".php";

        if (file_exists($this->viewFile)) {
            if ($template) {
                //include the full template
                if (file_exists($templateFile)) {
                    require($templateFile);
                } else {
                    require(__DIR__."/../views/Error/badtemplate.php");
                }
            } else {
                //we're not using a template view so just output the method's view directly
                require($this->viewFile);
            }
        } else {
            require(__DIR__."/../views/Error/badview.php");
        }
    }

    public function ajaxRespon($viewModel) {
        // Entfernung von unnötigen Informationen
        unset($viewModel->mainMenu);
        unset($viewModel->javascripts);
        unset($viewModel->pageTitle);
        unset($viewModel->header);
        unset($viewModel->footer);

        echo json_encode($viewModel);
        exit();
    }
}

?>