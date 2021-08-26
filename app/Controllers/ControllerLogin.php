<?php namespace App\Controllers;
//https://ilmucoding.com/middleware-filters-codeigniter-4/ 
use App\Models\Auth_model;

//https://ilmucoding.com/codeigniter-4-auth-jwt/
use \Firebase\JWT\JWT;

use CodeIgniter\Exceptions\PageNotFoundException;

helper('api_simasneg');

class ControllerLogin extends BaseController
{
 
    public function __construct() {
        $this->auth = new Auth_model;
    }
 
    public function index()
    {
       // return view('v_login');
       return redirect()->to('http://simasneg.kulonprogokab.go.id/simasneg/index.php');
    }


    public function prosesToken($token)
    {

      /* $secret_key='sdvwhgef64gr782rwdb7*Juidh$3jjj';
        if(!empty($token)){
            try {
                $decoded = JWT::decode($token, $secret_key, array('HS256'));
                if($decoded){   
                    $nip = $decoded->nip;
                    
                    session()->set("opd", $decoded->opd);
                    session()->set("namaopd", $decoded->namaopd);
                    session()->set("level", $decoded->level);

                    $json = pegawaiBiodata($nip);
                    $json=json_decode($json,true);

                    if(isset($json[0]['nip'])){
                       
                        session()->set("nama",$json[0]['nama']); 
                        session()->set("jabatan",$json[0]['jabatan']); 
                        return redirect()->to('/homeadmin');
                    }else{
                        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data tidak ada');
                    }


                    

                    return redirect()->to('/homeadmin');
                }
            } catch (\Exception $e){
                  throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data tidak ada');
            }
        }*/

        
        session()->set("id", $token);
        /*session()->set("src_ybs", "1");
        session()->set("src_tahun", date("Y"));*/

        $json = pegawaiBiodata(session()->get("id"));
        $json=json_decode($json,true);
        if (!$json) {
            throw PageNotFoundException::forPageNotFound('Tidak dapat mengambil biodata pegawai dari Simasneg..');
         }

        if(isset($json[0]['nip'])){
            session()->set("nip",$json[0]['nip']);
            session()->set("nama",$json[0]['nama']); 
            session()->set("jabatan",$json[0]['jabatan']); 

                if($json[0]['pegawai_admin']==2){
                 session()->set("level", "adminskpd");
                 session()->set("opd", $json[0]['instansi_kode']);

                }elseif($json[0]['pegawai_admin']==4){
                 session()->set("level", "adminuker");
                 session()->set("opd", $json[0]['unit_kerja_kode']);

                }elseif($json[0]['pegawai_admin']==5){
                 session()->set("level", "adminsatker");
                 session()->set("opd", $json[0]['satuan_kerja_kode']);

                }else{
                 session()->set("level", "pegawai");
                 session()->set("opd", $json[0]['instansi_nama']);
                } 
                   
            return redirect()->to('/home');
        }/*else{
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data tidak ada atau tidak dapat tersambung ke server Simasneg');
        }*/
    }
     
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function logoutToken()
    {
        session()->destroy();
        return redirect()->to('http://simasneg.kulonprogokab.go.id/simasneg/index.php');
    }
 
}