<?php

namespace App\Controllers;
use App\Models\Soalmodel;
use App\Models\Latihanmodel;


class Pauli extends BaseController
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
        return view('front/pauli/pauli',$data);
    }

    public function pilihansk() {
        $request = \Config\Services::request();
        $data['sk_group_id'] = $request->uri->getSegment(3);
        return view('front/pauli/petunjuksoal',$data);
    }

    public function ujian() {
        $request = \Config\Services::request();
        $data["materi_id"]  = $request->uri->getSegment(3);
        $data["group_id"]   = $request->uri->getSegment(4);
        $kolom_id = 0;
        
        return view('front/pauli/ujian',$data);
    }

    public function petunjukpauli() {
        $request = \Config\Services::request();
        $data = [
            'materi_id' => $request->uri->getSegment(3),            
            'group_id' => $request->uri->getSegment(4)
        ];

        return view('front/pauli/petunjuksoal',$data);
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

    public function pauliujian() {
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
            
            $exists = $this->soalmodel->getResponPauli($soal_id, $group_id, $materi, $user_id, $sk_group_id)->getResult();
            
            if (count($exists) > 0) {
                $updaterespon = $this->soalmodel->updateResponPauli($soal_id,$group_id,$materi,$user_id,$sk_group_id,$data);
            } else {
                $this->soalmodel->simpanResponSK($data);
            }
        }
        
        $no_soal++;

        if ($proc === "persiapan" || $no_soal == 51 && $group_id == 9 && $kolom_id <= 20 && $sk_group_id <= 4) {
            return $this->response->setJSON([
                "ret" => "persiapan",
                "kolom_id" => $kolom_id,
                "sk_group_id" => $sk_group_id
            ]);
        }

        if ($proc === "selesai") {
            return $this->response->setJSON(["ret" => "selesai"]);
        }
        
        $soal = $this->soalmodel->getSoalPauliFast($no_soal, $group_id, $materi, $kolom_id, $sk_group_id);

        if (!$soal) {
            return $this->response->setJSON(["ret" => "soal_tidak_ada"]);
        }

        $jawaban = $this->soalmodel->getjawabanPauli($soal->soal_id)->getResult();

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

        // if ($proc == "persiapan") {
        //     echo json_encode(array("ret"=>"persiapan", "kolom"=>$kolom_id, "sk_group_id"=>$sk_group_id));
        // } else if ($no_soal == 51 && $group_id == 9 && $kolom_id <= 20 && $sk_group_id <= 4) {
        //     echo json_encode(array("ret"=>"persiapan", "kolom"=>$kolom_id, "sk_group_id"=>$sk_group_id));
        // // } else if ($group_id == 3 && $kolom_id == 1 && $sk_group_id == 5) {
        // } else if ($proc == "selesai") {
        //     echo json_encode(array("ret"=>"selesai"));
        // } else {
        //     $res = $this->soalmodel->getSoalSK($no_soal,$group_id,$materi,$kolom_id,$sk_group_id)->getResult();
        //     if (count($res)>0) {
        //         $ret = "
        //         <div class='col-md-12' style='width: 100%;'>
        //             <label style='font-size:20px;' for='Pertanyaan'>Pertanyaan ".$no_soal."</label>
        //             <div class='row col-md-12'>
        //                 <div style='
        //                     display:flex;
        //                     justify-content:center;
        //                     align-items:center;
        //                     min-height:180px;
        //                 '>
        //             ";
        //                 foreach ($res as $keySoal) {

        //                     [$atas, $bawah] = explode('+', $keySoal->soal_nm);

        //                     $ret .= "
        //                             <div style='
        //                                 position:relative;
        //                                 background-color:grey;
        //                                 width:65px;
        //                                 height:125px;
        //                                 margin:5px;
        //                             '>
        //                                 <div style='
        //                                     position:absolute;
        //                                     top:50%;
        //                                     left:50%;
        //                                     transform:translate(-50%, -50%);
        //                                     text-align:center;
        //                                 '>
        //                                     <div style='
        //                                         font-size:60px;
        //                                         font-weight:bold;
        //                                         line-height:1;
        //                                     '>$atas</div>

        //                                     <div style='
        //                                         font-size:60px;
        //                                         font-weight:bold;
        //                                         line-height:1;
        //                                     '>$bawah</div>
        //                                 </div>
        //                             </div>";


        //                 }


                        
        //         $ret .= "</div>
        //             <div class='row col-md-12'><div style='text-align: center;'>";
        //             $getjawaban = $this->soalmodel->getjawabanPauli($res[0]->soal_id)->getResult();
        //             foreach ($getjawaban as $k) {
        //                 $jawaban_id = $k->jawaban_id;
        //                 $pilihan_nm = $k->pilihan_nm;
        //                 $ret .= "<button onclick='startujian(\"next\",\"$pilihan_nm\",".$jawaban_id.",".$res[0]->soal_id.",$group_id,$no_soal,$kolom_id,$materi,$sk_group_id)' style='display:inline-block;width: 27%;margin:5px;font-weight:bold;font-size: 30px;'
        //                 class='btn btn-block btn-primary tombol_pauli' data-jawaban-id='".$jawaban_id."' data-pilihan='".$pilihan_nm."'>".$k->pilihan_nm."</button>";
        //             }
                        
        //         $ret .= "</div></div>
        //         </div></div>";
        //         echo json_encode(array("ret"=>$ret, "kolom"=>$kolom_id,"group_id"=>$group_id,"no_soal"=>$no_soal,"sk_group_id"=>$sk_group_id));
        //     } else {
        //         $ret = "soal_tidak_ada";
        //         echo json_encode(array("ret"=>$ret));
        //     }
        // }
    }

    public function hasiltryout() {
        $request = \Config\Services::request();
        $user_id = $this->session->user_id;
        $materi_id = $request->uri->getSegment(3);
        $group_id = $request->uri->getSegment(4);
        
        return view('front/pauli/hasiltryout');
    }
    
}
