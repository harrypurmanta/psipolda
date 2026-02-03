<?php

namespace App\Controllers;
use App\Models\Soalmodel;
use App\Models\Latihanmodel;


class Kreplin extends BaseController
{

	protected $soalmodel;
	protected $latihanmodel;
	protected $session;
	public function __construct()
	{
		$this->session = \Config\Services::session();
        $this->session->start();
        $this->soalmodel = new Soalmodel();
        $this->latihanmodel = new Latihanmodel();
	}

    public function index()
    {
        $request = \Config\Services::request();
        $materi_id = $request->uri->getSegment(2);
        $data['group'] = $this->latihanmodel->getSKgroup()->getResult();
        return view('front/kreplin/kreplin',$data);
    }

    public function pilihansk() {
        $request = \Config\Services::request();
        $data['sk_group_id'] = $request->uri->getSegment(3);
        return view('front/kreplin/petunjuksoal',$data);
    }

    public function ujian() {
        $request = \Config\Services::request();
        $data["materi_id"]  = $request->uri->getSegment(3);
        $data["group_id"]   = $request->uri->getSegment(4);
        $kolom_id = 0;
        
        return view('front/kreplin/ujian',$data);
    }

    public function petunjukkreplin() {
        $request = \Config\Services::request();
        $data = [
            'materi_id' => $request->uri->getSegment(3),            
            'group_id' => $request->uri->getSegment(4)
        ];

        return view('front/petunjuk3',$data);
    }

    public function updateFinishRespon() {
        $materi_id = $this->request->getPost("materi_id");
        $group_id = $this->request->getPost("group_id");
        $user_id = $this->session->user_id;
        $data = [
            "status_cd" => "finish"
        ];
        $reset = $this->soalmodel->updateFinishRespon($materi_id,$group_id,$user_id,$data);

        echo json_encode($reset);exit;
    }

    public function kreplinujian() {
        
        $req = $this->request;

        $proc        = $req->getPost("proc");
        $soal_id     = $req->getPost("soal_id");
        $jawaban_id  = $req->getPost("jawaban_id");
        $group_id    = $req->getPost("group_id");
        $no_soal     = (int)$req->getPost("no_soal");
        $pilihan_nm  = $req->getPost("pilihan_nm");
        $kolom_id    = (int)$req->getPost("kolom_id");
        $materi      = $req->getPost("materi");
        $sk_group_id = (int)$req->getPost("sk_group_id");

        // if ($proc == "start") {
        //     $no_soal = 1;
        // }

        $user_id = $this->session->user_id;
        
        $date = date("Y-m-d H:i:s");

        if (!$this->session->has('used')) {
            $this->session->set('used', 1);
        }
        
        if ($jawaban_id != "") {
            $data = [
                "jawaban_id"      => $jawaban_id,
                "pilihan_nm"      => $pilihan_nm,
                "soal_id"         => $soal_id,
                "no_soal"         => $no_soal,
                "group_id"        => $group_id,
                "materi"          => $materi,
                "used"            => $this->session->used,
                "kolom_id"        => $kolom_id,
                "created_user_id" => $user_id,
                "created_dttm"    => $date,
                "session"         => $this->session->session
            ];
            
            $exists = $this->soalmodel->getResponKreplin($soal_id, $group_id, $materi, $user_id, $sk_group_id)->getResult();
            
            if (count($exists) > 0) {
                
                $updaterespon = $this->soalmodel->updateResponKreplin($soal_id,$group_id,$materi,$user_id,$sk_group_id,$data);
                // $this->soalmodel->updateResponKreplinFast($data, $exists->respon_id);
            } else {
                $this->soalmodel->simpanResponSK($data);
            }
        }

        $no_soal++;
        // echo json_encode($proc);exit;
        if ($proc === "persiapan" || $no_soal == 61 && $group_id == 3 && $kolom_id <= 10 && $sk_group_id <= 4) {
            return $this->response->setJSON([
                "ret" => "persiapan",
                "kolom_id" => $kolom_id,
                "sk_group_id" => $sk_group_id
            ]);
        }

        if ($proc === "selesai") {
            return $this->response->setJSON(["ret" => "selesai"]);
        }
        
        $soal = $this->soalmodel->getSoalKreplinFast($no_soal, $group_id, $materi, $kolom_id, $sk_group_id);

        if (!$soal) {
            return $this->response->setJSON(["ret" => "soal_tidak_ada"]);
        }

        $jawaban = $this->soalmodel->getjawaban($soal->soal_id)->getResult();

        return $this->response->setJSON([
            "ret" => "ok",
            "no_soal" => $no_soal,
            "kolom_id" => $kolom_id,
            "group_id" => $group_id,
            "sk_group_id" => $sk_group_id,
            "data_soal" => [
                "soal_id" => $soal->soal_id,
                "soal_nm" => $soal->soal_nm,
                "jawaban" => $jawaban
            ]
        ]);

    }

    


    public function hasiltryout() {
        $request = \Config\Services::request();
        $user_id = $this->session->user_id;
        $materi_id = $request->uri->getSegment(3);
        $group_id = $request->uri->getSegment(4);
        
        return view('front/kreplin/hasiltryout');
    }
    
}
