<?php
namespace App\Controllers;


class ControllerHome extends BaseController
{ 
	public function index()
  {
    $data['page_title']='Beranda';
    $data['active']='home';
    $data['active2']='';
    return view('ViewHome', $data);
  }
}
