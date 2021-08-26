<?php
namespace App\Controllers;
use \App\Models\ModelRiwayatKGB;
use \App\Models\ModelGaji;
use CodeIgniter\Exceptions\PageNotFoundException;
use TCPDF;

helper('general');
helper('api_simasneg');
helper(['form', 'url']);

class ControllerKGBAdmin extends BaseController
{

//live query
 public function get_gaji()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules(['gol' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        if($isDataValid){
            $post_gol = $this->request->getPost('gol');
            $post_mkg = $this->request->getPost('mkg');

            $mgaji = new ModelGaji();
            $array = ['gol' => $post_gol, 
                      'mkg' => $post_mkg];
            $dgaji = $mgaji->where ($array)->findAll();

            foreach ($dgaji as $key) {
                $gaji = $key['gaji'];
            }

            //jika gaji=0, cari mkg dikurangi 1 tahun
            if($gaji==0){
               $mgaji->resetQuery(); 
               $post_mkg = $post_mkg-1;
               $array = ['gol' => $post_gol, 
                         'mkg' => $post_mkg];
               $dgaji = $mgaji->where ($array)->findAll();

                foreach ($dgaji as $key) {
                    $gaji = $key['gaji'];
                }
            } 

            header('Content-Type: application/json');
            //echo json_encode($response);
             echo json_encode(array(
              'gaji' => $gaji,
              'csrf' => csrf_hash()
            ));
        }
            /*header('Content-Type: application/json');
            echo json_encode(array(
              'data' => $data,
              'csrf' => csrf_hash()
            ));*/
        
    } 
    //--------------------------------------------------------------------------


  public function list_peg_admin_kgb()
  {
        $opd = session()->get("opd");
        $level = session()->get("level");

        $json=pegawaiPerSKPD($opd, $level);

        $json=json_decode($json,true);

        if (!$json) {
            throw PageNotFoundException::forPageNotFound('Tidak dapat mengambil data pegawai per SKPD dari Simasneg..');
         }

        $list_peg='';
        foreach ($json as $key) {

          $list_peg.='<tr>
                    <td>'.$key['nip'].'</td>
                    <td>'.$key['nama'].'</td>
                    <td>'.$key['golru'].'</td>
                    <td>'.$key['jabatan'].'</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
              <td>
                         <div class="btn-list flex-nowrap">
                              <a href="'.base_url('/admin/riwayatkgb/'.my_crypt($key['nip'],'e').'/lihat').'" class="btn btn-green">
                                Lihat
                              </a>
                            </div>
              </td>
             </tr>';
        }

        $data['list_peg']=$list_peg;

        $data['page_title']='Pengelolaan KGB';
        $data['active']='';
        $data['active2']='admin_kgb';
    return view('ViewListPegawaiKGB', $data);
  }

 

	public function LihatRiwayatKGB($nip)
	{
	$idd=my_crypt($nip,'d');

    //lihat 
    $json=pegawaiBiodata($idd);
    $json=json_decode($json,true);

    if (!$json) {
            throw PageNotFoundException::forPageNotFound('Tidak dapat mengambil biodata pegawai dari Simasneg..');
         }

    $data['biodata']=$json;

    $rwy = new ModelRiwayatKGB();
    $rwy->orderBy('tgl_surat', 'DESC');
    $dr = $rwy->where('nip',$idd)->findAll();

    $list_rwy='';
    foreach ($dr as $key) {
          if(empty($key['usulan_no_surat_sbl']))
            $status='<span class="badge bg-warning me-1"></span> Belum diajukan';  
          elseif($key['usulan_no_surat_sbl'] && $key['usulan_approved']==0)
            $status='<span class="badge bg-success me-1"></span> Sudah diajukan';
          elseif($key['usulan_no_surat_sbl'] && $key['usulan_approved']==1)
            $status='<span class="badge bg-info me-1"></span> Approved';
          else
            $status='<span class="badge bg-danger me-1"></span> ?';
     
        	$list_rwy.='<tr>
                    <td>'.$key['no_surat'].' '.tgl_format_indo($key['tgl_surat']).'</td>
                    <td>'.$key['gapok_lama'].'</td>
                    <td>'.$key['gapok_baru'].'</td>
                    <td>'.$key['mk_tahun_baru'].' Tahun '.$key['mk_bulan_baru'].' Bulan</td>
                    <td>'.tgl_format_indo($key['tmt_baru']).'</td>
                    <td>'.tgl_format_indo($key['kgb_berikut']).'</td>
                    <td>'.$status.'</td>
        	          <td>
        	    	         <div class="btn-list flex-nowrap">';
                             
        if(session()->get("level")!='pegawai'){                     
             $list_rwy.='<a href="'.base_url('/admin/riwayatkgb/'.my_crypt($key['id'],'e').'/edit').'" class="btn btn-blue"> <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg> Edit</a>

                            <a href="#" class="btn btn-red" data-href="'.base_url('/admin/riwayatkgb/'.my_crypt($key['id'],'e').'/hapus').'" onclick="confirm_del(this)"><!-- Download SVG icon from http://tabler-icons.io/i/trash -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>';

            if($key['usulan_no_surat_sbl']){
                $list_rwy.='<a href="#" class="btn btn-info" data-href="'.base_url('/admin/riwayatkgb/'.my_crypt($key['id'],'e').'/approve').'" onclick="confirm_approve(this)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 11v8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3" /></svg> Approve</a>';   
            }else{
                $list_rwy.='<a href="#" class="btn btn-ghost-info disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 11v8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3" /></svg> Approve</a>';   
            }         

                            
            if($key['usulan_approved']==1){ 
                $list_rwy.='<a target="_blank" href="'.base_url('/admin/riwayatkgb/'.my_crypt($key['id'],'e').'/cetak').'" class="btn btn-green"> 
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><rect x="7" y="13" width="10" height="8" rx="2" /></svg> Cetak</a>';
            }else{
                $list_rwy.='<a href="#" class="btn btn-ghost-green disabled"> 
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><rect x="7" y="13" width="10" height="8" rx="2" /></svg> Cetak</a>';
            }
        }else{

            if(empty($key['usulan_no_surat_sbl']))
            $list_rwy.='<a href="'.base_url('/layanan/riwayatkgb/'.my_crypt($key['id'],'e').'/usulan').'" class="btn btn-primary d-none d-sm-inline-block">
                   <!-- Download SVG icon from http://tabler-icons.io/i/message-plus -->
  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" /><line x1="10" y1="11" x2="14" y2="11" /><line x1="12" y1="9" x2="12" y2="13" /></svg>
                    Ajukan Usulan
                  </a>';

        }
          $list_rwy.='               </div>
        	          </td>
        	        </tr>';
    }//foreach
        

        
        $data['list_rwy']=$list_rwy;

        $rwy_golru=pegawaiRiwayatGolru($idd);
        $rwy_golru=json_decode($rwy_golru,true);

         if (!$rwy_golru) {
            throw PageNotFoundException::forPageNotFound('Tidak dapat mengambil data riwayat Golru dari Simasneg..');
         }

        $golru='';    
        foreach ($rwy_golru as $key) {
            $golru.='<option value="'.$key['golru_nama'].'">'.$key['golru_nama'].'</option>';
        }
        $data['golru']=$golru;
        $data['golru_baru']=$golru;


        $json_rwy = pegawaiRiwayatJbt($idd,date('Y'));
        $json_rwy = json_decode($json_rwy,true);
        if (!$json_rwy) {
            throw PageNotFoundException::forPageNotFound('Tidak dapat mengambil data riwayat jabatan dari Simasneg..');
         }
        $rjabatan='';    
        foreach ($json_rwy as $r) {
             $rjabatan.='<option value="'.$r['jabatan_kode'].'">'.$r['jabatan_nama'].'</option>';
        }

         
        $data['rjabatan']=$rjabatan;
       
        $data['page_title']='Pengelolaan KGB';
        $data['page_title2']='Riwayat KGB';
        $data['active']='';

        if(session()->get('level')!='pegawai')
            $data['active2']='admin_kgb';
        else
            $data['active2']='pegawai_kgb';

        $data['ide']=$nip;
      
		return view('ViewRiwayatKGB', $data);
	}
    //--------------------------------------------------------------------------

     public function TambahRiwayatKGB($nip)
    {
        $idd=my_crypt($nip,'d');
    //proses
        $validation =  \Config\Services::validation();
        $validation->setRules(['tgl_surat' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        if($isDataValid){
           $model = new ModelRiwayatKGB();
           $kolom=[ 'tgl_surat'=> $this->request->getPost('tgl_surat'),
                    'no_surat'=> $this->request->getPost('no_surat'),
                    'nip'=> $idd,
                    'nama'=> $this->request->getPost('nama'),
                    'golru'=> $this->request->getPost('golru'),
                    'jabatan'=> $this->request->getPost('jabatan'),
                    'gapok_lama'=> $this->request->getPost('gapok_lama'),
                    'no_spangkat'=> $this->request->getPost('no_spangkat'),
                    'tgl_spangkat'=> $this->request->getPost('tgl_spangkat'),
                    'tmt_spangkat'=> $this->request->getPost('tmt_spangkat'),
                    'mk_spangkat_tahun'=> $this->request->getPost('mk_spangkat_tahun'),
                    'mk_spangkat_bulan'=> $this->request->getPost('mk_spangkat_bulan'),
                    'gapok_baru'=> $this->request->getPost('gapok_baru'),
                    'mk_tahun_baru'=> $this->request->getPost('mk_tahun_baru'),
                    'mk_bulan_baru'=> $this->request->getPost('mk_bulan_baru'),
                    'golru_baru'=> $this->request->getPost('golru_baru'),
                    'tmt_baru'=> $this->request->getPost('tmt_baru'),
                    'kgb_berikut'=> $this->request->getPost('kgb_berikut'),
                    'nip_kepala'=> $this->request->getPost('nip_kepala'),
                    'instansi'=> $this->request->getPost('instansi')
                  ];

         if($model->insert($kolom)){
                session()->setFlashdata('message', 'Sukses tambah data');
                session()->setFlashdata('alert-class', 'alert-success');
           }else{
                session()->setFlashdata('message', 'Gagal tambah data!');
                session()->setFlashdata('alert-class', 'alert-danger');
           }
           return redirect()->to('/admin/riwayatkgb/'.$nip.'/lihat');     
        }



        //show
        $data['page_title']='Pengelolaan KGB';
        $data['page_title2']='Riwayat KGB';
        $data['active']='';
        $data['active2']='admin_kgb';

        $data['aksi']='Tambah';

        $json=pegawaiBiodata($idd);
        $json=json_decode($json,true);
        if (!$json) {
            throw PageNotFoundException::forPageNotFound('Tidak dapat mengambil biodata pegawai dari Simasneg..');
         }

        $data['nama']=$json[0]['nama'];
        $data['nip']=$json[0]['nip'];
        $data['jabatan']=$json[0]['jabatan'];
        $data['instansi']=$json[0]['instansi_kode'];

         //nip_kepala
        $kaopd = profilOPD();
        $kaopd = json_decode($kaopd,true);
        if (!$kaopd) {
            throw PageNotFoundException::forPageNotFound('Tidak dapat mengambil data profil SKPD dari SuratKU..');
         }

        if($kaopd['success']){
            foreach ($kaopd['data'] as $key) {
                if($key['id_instansi_simasneg']==$json[0]['instansi_kode']){ 
                    $nip_kepala=$key['pimpinan_nip'];
                    break;
                }    
            }

        }
        $data['nip_kepala']=$nip_kepala;

        $rwy_golru=pegawaiRiwayatGolru($idd);
        $rwy_golru=json_decode($rwy_golru,true);
        if (!$rwy_golru) {
            throw PageNotFoundException::forPageNotFound('Tidak dapat mengambil data riwayat Golru dari Simasneg..');
         }

        $golru='';    
        foreach ($rwy_golru as $key) {
            $golru.='<option value="'.$key['golru_nama'].'">'.$key['golru_nama'].'</option>';
        }
        $data['golru']=$golru;
        $data['golru_baru']=$golru;

        $json_rwy = pegawaiRiwayatJbt($idd,date('Y'));
        $json_rwy = json_decode($json_rwy,true);
        if (!$json_rwy) {
            throw PageNotFoundException::forPageNotFound('Tidak dapat mengambil data riwayat jabatan dari Simasneg..');
         }
        $rjabatan='';    
        foreach ($json_rwy as $r) {
             $rjabatan.='<option value="'.$r['jabatan_kode'].'">'.$r['jabatan_nama'].'</option>';
        }

         
        $data['rjabatan']=$rjabatan;
        

        
        return view('ViewFormRiwayatKGB', $data);
        
        
    }  
    //--------------------------------------------------------------------------

    public function EditRiwayatKGB($id)
    {
        $idd=my_crypt($id,'d');
    //proses
        $validation =  \Config\Services::validation();
        $validation->setRules(['tgl_surat' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        if($isDataValid){
           $nip=$this->request->getPost('nip'); 
           $model = new ModelRiwayatKGB();
           $kolom=[ 'tgl_surat'=>$this->request->getPost('tgl_surat'),
                    'no_surat'=> $this->request->getPost('no_surat'),
                    
                    'golru'=> $this->request->getPost('golru'),
                    'jabatan'=> $this->request->getPost('jabatan'),
                    'gapok_lama'=> $this->request->getPost('gapok_lama'),
                    'no_spangkat'=> $this->request->getPost('no_spangkat'),
                    'tgl_spangkat'=> $this->request->getPost('tgl_spangkat'),
                    'tmt_spangkat'=> $this->request->getPost('tmt_spangkat'),
                    'mk_spangkat_tahun'=> $this->request->getPost('mk_spangkat_tahun'),
                    'mk_spangkat_bulan'=> $this->request->getPost('mk_spangkat_bulan'),
                    'gapok_baru'=> $this->request->getPost('gapok_baru'),
                    'mk_tahun_baru'=> $this->request->getPost('mk_tahun_baru'),
                    'mk_bulan_baru'=> $this->request->getPost('mk_bulan_baru'),
                    'golru_baru'=> $this->request->getPost('golru_baru'),
                    'tmt_baru'=> $this->request->getPost('tmt_baru'),
                    'kgb_berikut'=> $this->request->getPost('kgb_berikut'),
                    'nip_kepala'=> $this->request->getPost('nip_kepala')
                    
                  ];

         if($model->update($idd, $kolom)){
                session()->setFlashdata('message', 'Sukses tambah data');
                session()->setFlashdata('alert-class', 'alert-success');
           }else{
                session()->setFlashdata('message', 'Gagal tambah data!');
                session()->setFlashdata('alert-class', 'alert-danger');
           }

           return redirect()->to('/admin/riwayatkgb/'.my_crypt($nip,'e').'/lihat'); 
        }

        //show
        $rwy = new ModelRiwayatKGB();
        $rwy->orderBy('tgl_surat', 'DESC');
        $dr = $rwy->where('id',$idd)->first();

        
            $data['nama']=$dr['nama'];
            $data['nip']=$dr['nip'];
            $data['no_surat']=$dr['no_surat'];
            $data['tgl_surat']=$dr['tgl_surat'];
            $data['no_spangkat']=$dr['no_spangkat'];
            $data['tgl_spangkat']=$dr['tgl_spangkat'];
            $data['tmt_spangkat']=$dr['tmt_spangkat'];
            $data['mk_spangkat_tahun']=$dr['mk_spangkat_tahun'];
            $data['mk_spangkat_bulan']=$dr['mk_spangkat_bulan'];
            $data['gapok_lama']=$dr['gapok_lama'];
            $data['mk_tahun_baru']=$dr['mk_tahun_baru'];
            $data['mk_bulan_baru']=$dr['mk_bulan_baru'];
            $data['tmt_baru']=$dr['tmt_baru']; 
            $data['kgb_berikut']=$dr['kgb_berikut'];
            $data['gapok_baru']=$dr['gapok_baru'];
            

            $json=pegawaiBiodata($dr['nip']);
            $json=json_decode($json,true);
            if (!$json) {
            throw PageNotFoundException::forPageNotFound('Tidak dapat mengambil biodatadata pegawai dari Simasneg..');
         }
            $data['instansi']=$json[0]['instansi_kode'];

             //nip_kepala
            $kaopd = profilOPD();
            $kaopd = json_decode($kaopd,true);
            if (!$kaopd) {
            throw PageNotFoundException::forPageNotFound('Tidak dapat mengambil data profil SKPD dari SuratKU..');
         }

            if($kaopd['success']){
                foreach ($kaopd['data'] as $key) {
                    if($key['id_instansi_simasneg']==$json[0]['instansi_kode']){ 
                        $nip_kepala=$key['pimpinan_nip'];
                        break;
                    }    
                }

            }
            $data['nip_kepala']=$nip_kepala;


            //golru
            $rwy_golru=pegawaiRiwayatGolru($dr['nip']);
            $rwy_golru=json_decode($rwy_golru,true);
            if (!$rwy_golru) {
            throw PageNotFoundException::forPageNotFound('Tidak dapat mengambil data riwayat Golru dari Simasneg..');
         }

            $golru='';    
            $golru_baru=''; 
            foreach ($rwy_golru as $key2) {
                if($dr['golru']==$key2['golru_nama']) $sel='selected'; else $sel='';
                $golru.='<option value="'.$key2['golru_nama'].'" '.$sel.'>'.$key2['golru_nama'].'</option>';

                if($dr['golru_baru']==$key2['golru_nama']) $sel='selected'; else $sel='';
                $golru_baru.='<option value="'.$key2['golru_nama'].'" '.$sel.'>'.$key2['golru_nama'].'</option>';
            }
            $data['golru']=$golru;
            $data['golru_baru']=$golru_baru;

            //rwy jabatan
            $json_rwy = pegawaiRiwayatJbt($dr['nip'],date('Y'));
            $json_rwy = json_decode($json_rwy,true);
            if (!$json_rwy) {
            throw PageNotFoundException::forPageNotFound('Tidak dapat mengambil data riwayat jabatan dari Simasneg..');
         }
            $rjabatan='';    
            foreach ($json_rwy as $r) {
                 if($dr['jabatan']==$r['jabatan_kode']) $sel='selected'; else $sel='';
                 $rjabatan.='<option value="'.$r['jabatan_kode'].'" '.$sel.'>'.$r['jabatan_nama'].'</option>';
            }
            $data['rjabatan']=$rjabatan;

        

        $data['page_title']='Pengelolaan KGB';
        $data['active']='';
        $data['active2']='admin_kgb';
        $data['aksi']='Edit';
        $data['ide']=$id;
        
        return view('ViewFormRiwayatKGB', $data);
    }  
    //--------------------------------------------------------------------------

    public function HapusRiwayatKGB($id){
        $idd=my_crypt($id,'d');
        $model = new ModelRiwayatKGB();
        $d=$model->where('id',$idd)->first();
        $nip=$d['nip'];

        if($model->delete($idd)){
            session()->setFlashdata('message', 'Sukses hapus data');
            session()->setFlashdata('alert-class', 'alert-success');  
        }else{
            session()->setFlashdata('message', 'Gagal hapus data!');
            session()->setFlashdata('alert-class', 'alert-danger');
        }
        
        return redirect()->to('/admin/riwayatkgb/'.my_crypt($nip,'e').'/lihat');  
    }
    //--------------------------------------------------------------------------


    public function ApproveUsulanKGB($id){
        $idd=my_crypt($id,'d');
        $model = new ModelRiwayatKGB();
        $d=$model->where('id',$idd)->first();
        $nip=$d['nip'];

        $kolom=['usulan_approved'=>'1'];

        if($model->update($idd,$kolom)){
            session()->setFlashdata('message', 'Sukses approve');
            session()->setFlashdata('alert-class', 'alert-success');  
        }else{
            session()->setFlashdata('message', 'Gagal approve!');
            session()->setFlashdata('alert-class', 'alert-danger');
        }
        
        return redirect()->to('/admin/riwayatkgb/'.my_crypt($nip,'e').'/lihat');  
    }
    //--------------------------------------------------------------------------



    public function Cetak($id)
    {
         $idd=my_crypt($id,'d');
         $rwy = new ModelRiwayatKGB();
         $d = $rwy->where('id', $idd)->first();
         $instansi=$d['instansi'];

         if (!$d) {
            throw PageNotFoundException::forPageNotFound('Tidak ada data');
         }

         $data['surat']=$d;
         $html = view('ViewSuratKGBCetak',$data);

        // echo $html; exit();

         //request cetak surat ke suratku
         $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://suratku.kulonprogokab.go.id/panas/front/buat_surat',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array('id_instansi' => '001'.$instansi,'content' => $html),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $this->response->setContentType('application/pdf');
            echo $response;      
    }

 //--------------------------------------------------------------------------  

public function PengajuanUsulanKGB($id)
    {
        $idd=my_crypt($id,'d');

        $model = new ModelRiwayatKGB();
        $d=$model->where('id',$idd)->first();
        $nip=$d['nip'];
        $usulan_kgb_berikut=$d['kgb_berikut'];

    //proses
        $validation =  \Config\Services::validation();
        $validation->setRules(['usulan_no_surat_sbl' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        if($isDataValid){
           $model->resetQuery();  
           $kolom=[ 'usulan_tgl_surat_sbl'=> $this->request->getPost('usulan_tgl_surat_sbl'),
                    'usulan_no_surat_sbl'=> $this->request->getPost('usulan_no_surat_sbl')
                  ];

         if($model->update($idd,$kolom)){
                session()->setFlashdata('message', 'Sukses ajukan usulan');
                session()->setFlashdata('alert-class', 'alert-success');
           }else{
                session()->setFlashdata('message', 'Proses gagal!');
                session()->setFlashdata('alert-class', 'alert-danger');
           }
           return redirect()->to('/layanan/riwayatkgb/'.my_crypt($nip,'e').'/lihat');     
        }



        //show
        $data['page_title']='Pengelolaan KGB';
        $data['page_title2']='Riwayat KGB';
        $data['active']='';
        $data['active2']='pegawai_kgb';

        $data['aksi']='Form Pengajuan Usulan KGB';

        $data['usulan_kgb_berikut']=$usulan_kgb_berikut;
        
        return view('ViewFormPengajuanUsulanKGB', $data);
    }  
    //--------------------------------------------------------------------------


}
