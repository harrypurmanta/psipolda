<?php

namespace App\Controllers;
use App\Models\Soalmodel;
use App\Models\Latihanmodel;


class Kreplin extends BaseController
{

	protected $soalmodel;
	protected $latihanmodel;
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
        $request = \Config\Services::request();
        $proc = $this->request->getPost("proc");
        $soal_id = $this->request->getPost("soal_id");
        $jawaban_id = $this->request->getPost("jawaban_id");
        $group_id = $this->request->getPost("group_id");
        $no_soal = $this->request->getPost("no_soal");
        $pilihan_nm = $this->request->getPost("pilihan_nm");
        $kolom_id = $this->request->getPost("kolom_id");
        $materi = $this->request->getPost("materi");
        $sk_group_id = $this->request->getPost("sk_group_id");
        $date = date("Y-m-d H:i:s");
        $this->session->set("used",1);
        // if ($proc == "start") {
        //     $getUsed = $this->soalmodel->getResponByMateriId($this->session->user_id,$sk_group_id)->getResult();
        //     if (count($getUsed)>0) {
        //         $used = $getUsed[0]->used + 1;
        //         $this->session->set("used",$used);
        //       } else {
        //         $used = 1;
        //         $this->session->set("used",$used);
        //       }
        // }

        // if ($proc == "start") {
        //     $notes = $this->soalmodel->getLastNoTes($group_id)->getResult();
            
        //     if (count($notes)>0) {
        //         $no_antrian = $notes[0]->no_antrian + 1;
        //     } else {
        //         $no_antrian = 1;
        //     }
            
        //     $checkExam = $this->soalmodel->checkExamByUser($this->session->user_id,$group_id)->getResult();
        //     if (count($checkExam)>0) {
                
        //     } else {
        //         $dataexam = [
        //             "group_id" => $group_id,
        //             "materi_id" => $materi,
        //             "user_id" => $this->session->user_id,
        //             "no_antrian" => $no_antrian,
        //         ];
        //         $insertexam = $this->soalmodel->insertexam($dataexam);
        //     }
            
        // }
        
        if ($jawaban_id != "") {
            $getResponKreplin = $this->soalmodel->getResponKreplin($soal_id,$group_id,$materi,$this->session->user_id,$sk_group_id)->getResult();
            if (count($getResponKreplin)>0) {
                $data = [
                    "jawaban_id" => $jawaban_id,
                    "pilihan_nm" => $pilihan_nm,
                    "soal_id" => $soal_id,
                    "no_soal" => $no_soal,
                    "group_id" => $group_id,
                    "materi" => $materi,
                    "used" => $this->session->used,
                    "kolom_id" => $kolom_id,
                    "created_user_id" => $this->session->user_id,
                    "created_dttm" => $date,
                    "session" => $this->session->session
                ];
                $updaterespon = $this->soalmodel->updateResponKreplin($soal_id,$group_id,$materi,$this->session->user_id,$sk_group_id,$data);
            } else {
                $data = [
                    "jawaban_id" => $jawaban_id,
                    "pilihan_nm" => $pilihan_nm,
                    "soal_id" => $soal_id,
                    "no_soal" => $no_soal,
                    "group_id" => $group_id,
                    "materi" => $materi,
                    "used" => $this->session->used,
                    "kolom_id" => $kolom_id,
                    "created_user_id" => $this->session->user_id,
                    "created_dttm" => $date,
                    "session" => $this->session->session
                ];
                $respon_id = $this->soalmodel->simpanResponSK($data);
            }
        }
        $no_soal = $no_soal + 1;

        if ($proc == "persiapan") {
            echo json_encode(array("ret"=>"persiapan", "kolom"=>$kolom_id, "sk_group_id"=>$sk_group_id));
        } else if ($no_soal == 61 && $group_id == 3 && $kolom_id <= 10 && $sk_group_id <= 4) {
            echo json_encode(array("ret"=>"persiapan", "kolom"=>$kolom_id, "sk_group_id"=>$sk_group_id));
        // } else if ($group_id == 3 && $kolom_id == 1 && $sk_group_id == 5) {
        } else if ($proc == "selesai") {
            echo json_encode(array("ret"=>"selesai"));
        } else {
            $res = $this->soalmodel->getSoalSK($no_soal,$group_id,$materi,$kolom_id,$sk_group_id)->getResult();
            if (count($res)>0) {
                $ret = "
                <div class='col-md-12' style='width:100%;margin-top:30px;'>
                    <label style='font-size:20px;' for='Pertanyaan'>Pertanyaan ".$no_soal."</label>
                    <div class='row col-md-12 text-center'>";
                        foreach ($res as $keySoal) {
                            $soal_nm = str_split(str_replace(" ","",$keySoal->soal_nm),1);
                            foreach ($soal_nm as $jwb_nm) {
                                $ret .= "<div style='display:inline-block;background-color:grey;min-width:60px;min-height:50px;font-size:65px;font-weight:bold;text-align:center;margin:5px;'>
                        ".$jwb_nm."</div>";
                            }
                        }
                        
                $ret .= "</div>
                    <div class='row col-md-12'><div style='text-align: center;'>";
                    $getjawaban = $this->soalmodel->getjawaban($res[0]->soal_id)->getResult();
                    foreach ($getjawaban as $k) {
                        $jawaban_id = $k->jawaban_id;
                        $pilihan_nm = $k->pilihan_nm;
                        $ret .= "<button onclick='startujian(\"next\",\"$pilihan_nm\",".$jawaban_id.",".$res[0]->soal_id.",$group_id,$no_soal,$kolom_id,$materi,$sk_group_id)' style='display:inline-block;width: 27%;margin:5px;font-weight:bold;font-size: 30px;'
                        class='btn btn-block btn-primary tombol_kreplin'>".$k->pilihan_nm."</button>";
                    }
                        
                $ret .= "</div></div>
                </div>";
                echo json_encode(array("ret"=>$ret, "kolom"=>$kolom_id,"group_id"=>$group_id,"no_soal"=>$no_soal,"sk_group_id"=>$sk_group_id));
            } else {
                $ret = "soal_tidak_ada";
                echo json_encode(array("ret"=>$ret));
            }
        }
    }

    public function hasiltryout() {
        $request = \Config\Services::request();
        $user_id = $this->session->user_id;
        $materi_id = $request->uri->getSegment(3);
        $group_id = $request->uri->getSegment(4);
        
        return view('front/kreplin/hasiltryout');
    }
    
}
