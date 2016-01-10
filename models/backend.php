<?php
/*
 * Project: ODDS & ENDS
 * File: /models/categoy.php
 * Purpose: model for the client controller.
 * Author: Robert Dziuba & Inga Schwarze
 */

class BackendModel extends BaseModel
{
    //data passed to the home index view
    /**
     * BackendModel constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if(!isset($_SESSION['HTTP_USER_AGENT']) || $_SESSION['HTTP_USER_AGENT'] != sha1($_SERVER['HTTP_USER_AGENT'])) {
            $this->viewModel->set(
                "mainMenu",
                array(
                    "backend" => "/backend",
                    "kategorien" => "/category",
                    "artikel" => "/article",
                    "departments" => "/department",
                    "räume" => "/room",
                    "login" => "/backend/login"
                )
            );
        }
    }

    public function index()
    {
        $this->viewModel->set("pageTitle", "Backend - ODDS&amp;ENDS");

        return $this->viewModel;
    }

    //data passed to the home index view
    public function login($errors = null)
    {

        if($errors != null) {
            $this->setError("validationErrors", $errors);
        }

        $this->viewModel->set("pageTitle", "LOGIN - ODDS&amp;ENDS");

        return $this->viewModel;
    }

    public function makeLogin($data){
        try
        {
            $sql = 'SELECT * FROM client WHERE email = :email AND password = MD5(:password) LIMIT 0,1';
            $s = $this->database->prepare($sql);
            $s->bindValue(':email', $data->email);
            $s->bindValue(':password', $data->password);
            $s->execute();
            $result = $s->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($result)){
                return $result;
            }else {
                $this->setError('DatabaseError','Der Kunde mit der EMail: '.$data->email.' oder diesem Password wurde nicht gefunden!');
            }
        }
        catch (PDOException $e)
        {
            $this->setError('DatabaseError','Error getting Client: '.$e->getMessage());
        }
    }

    public function LoginOk($data){
        $this->viewModel->set("client",$data);
        return $this->viewModel;
    }
}