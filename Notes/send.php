<?php
session_start();

if(filter_input(INPUT_POST, "submit"))
{
    require_once 'database.php';
    $db = new Database();
    $button = filter_input(INPUT_POST, "submit");
    
    switch($button)
    {
        case "Add" : 
            $db->sendNote(); 
        break;
        case "Delete" : 
            $db->deleteNote(); 
        break;
        case "Edit" : 
            $db->editNote(); 
        break;
    }
}