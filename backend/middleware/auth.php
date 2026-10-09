<?php
session_start();
function requireLogin():void {
	if(!isset($_SESSION['id_user'])){
		header("location: /frontend/login.php");
		exit;
	}	
}
function requireRole(string $role){
	requireLogin();
	if($role == "ADMIN"){
		return 1;
	}
	if($role == "STUDENT"){
                return 3;
        }
        if($role == "TEACHER"){
                return 2;
        }

}
function requireAdmin():bool
{
	if(requireRole("ADMIN")==1){
		return true;
	}
	else{
		return false;
	}
}
function requireTeacher():bool
{
        if(requireRole("TEACHER")==2){
                return true;
        }
        else{
                return false;
        }

}

function requireStudent():bool
{
        if(requireRole("STUDENT")==3){
                return true;
        }
        else{
                return false;
        }

}


