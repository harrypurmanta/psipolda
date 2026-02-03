<?php

namespace App\Controllers;
use App\Models\Soalmodel;
use App\Models\Usersmodel;
class Materi extends BaseController
{
    protected $soalmodel;
	protected $usersmodel;

    public function __construct()
	{
		$this->session = \Config\Services::session();
        $this->soalmodel = new Soalmodel();
		$this->usersmodel = new Usersmodel();

	}


    public function index()
    {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		} else {
            $data = [
                'materi' => $this->soalmodel->getjawAllJMateri()->getResult(),
                'materiSK' => $this->soalmodel->getMateriSK()->getResult(),
            ];
            return view('front/materi',$data);
        }
    }

    public function pilihanMateri() {
         if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $request = \Config\Services::request();
        $data = [
            'materi_id' => $request->uri->getSegment(3),
            'group' => $this->soalmodel->getGroup()->getResult(),
        ];
        

        return view('front/pilihanmateri',$data);
    }

    public function hasiltryout() {
        $request = \Config\Services::request();
        $user_id = $this->session->user_id;
        $materi_id = $request->uri->getSegment(3);
        
        return view('front/hasiltryout',$data);
    }
    
    public function simpanbiodata() {
        $person_nm = $this->request->getPost("person_nm");
        $satuan = $this->request->getPost("satuan");
        $birth_place = $this->request->getPost("birth_place");
        $birth_dttm = $this->request->getPost("birth_dttm");
        $gender_cd = $this->request->getPost("gender_cd");
        $materi_id = $this->request->getPost("materi_id");
        $group_id = $this->request->getPost("group_id");
        $user_group = "siswa";

        $cekuser = $this->usersmodel->cekperson($person_nm,$satuan,$birth_place,$birth_dttm,$materi_id,$group_id);
        if (count($cekuser)>0) {
            $ret = "sudahada";
        } else {
            $data = [
                "person_nm" => $person_nm,
                "satuan" => $satuan,
                "birth_place" => $birth_place,
                "birth_dttm" => $birth_dttm,
                "gender_cd" => $gender_cd,
                'status_cd' => 'normal'
            ];
            $person_id = $this->usersmodel->simpanperson($data);
            $user_nm = strtolower(str_replace(" ","",$person_nm));
            $pwd = md5("qwerty12345");
            if ($person_id) {
                $datas = [
                    "user_nm" => $user_nm,
                    "pwd0" => $pwd,
                    "user_group" => $user_group,
                    "person_id" => $person_id,
                    'status_cd' => 'normal'
                ];
                $user_id = $this->usersmodel->simpanuser($datas);
                if ($user_id) {
                    $res = $this->usersmodel->checklogin($user_nm,$pwd)->getResultArray();
                    if (count($res) > 0) {
                        foreach ($res as $k) {
                            $this->session->set($k);
                        }
                    }
                    $ret = "sukses";
                } else {
                    $ret = "gagal";
                }
                
            } else {
                $ret = "gagal";
            }
        }
        
        echo json_encode($ret);
    }
}
