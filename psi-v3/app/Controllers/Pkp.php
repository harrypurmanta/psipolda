<?php

namespace App\Controllers;
use App\Models\Soalmodel;
use App\Models\Latihanmodel;


class Pkp extends BaseController
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
        return view('front/pkp/pkp',$data);
    }

    public function ujian() {
        $request = \Config\Services::request();
        return view('front/pkp/ujian');
    }

    public function petunjukpkp() {
        $request = \Config\Services::request();
        $data = [
            'materi_id' => $request->uri->getSegment(3),            
            'group_id' => $request->uri->getSegment(4)
        ];

        return view('front/pkp/petunjukpkp',$data);
    }

    public function updateFinishRespon() {
        $materi_id = $this->request->getPost("materi_id");
        $group_id = $this->request->getPost("group_id");
        $user_id = $this->session->user_id;

        $data = [
            "status_cd" => "finish"
        ];
        $reset = $this->soalmodel->updateFinishRespon($materi_id,$group_id,$user_id,$data);

        echo json_encode($reset);
    }

    public function pkpujian() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $request = \Config\Services::request();
        $soal_id = $this->request->getPost("soal_id");
        $jawaban_id = $this->request->getPost("jawaban_id");
        $group_id = $this->request->getPost("group_id");
        $no_soal = $this->request->getPost("no_soal");
        $pilihan_nm = $this->request->getPost("pilihan_nm");
        $kolom_id = $this->request->getPost("kolom_id");
        $materi = $this->request->getPost("materi");
        $proc = $this->request->getPost("proc");
        $waktu = $this->request->getPost("waktu");
        $sk_group_id = $this->request->getPost("sk_group_id");
        $date = date("Y-m-d H:i:s");
        $soal_nm = "";
        $jawaban = "";
        $boxnomorsoal = "";
        $res_ttlsoal = "";
        $sisawaktu = "";
        if ($jawaban_id == "null") {

        } else if ($proc == "next" && $jawaban_id == "") {
            echo json_encode("jawaban_kosong");
        } else {
            if ($proc == "prev" || $proc == "prevsoal" || $proc == "start") {

            } else {
                $getResponByid = $this->soalmodel->getResponByPrevPkp($soal_id,$group_id,$materi,$this->session->user_id)->getResult();
                if (count($getResponByid)>0) {
                    $data = [
                        "jawaban_id" => $jawaban_id,
                        "pilihan_nm" => $pilihan_nm,
                        "soal_id" => $soal_id,
                        "no_soal" => $no_soal,
                        "group_id" => $group_id,
                        "materi" => $materi,
                        "created_user_id" => $this->session->user_id,
                        "created_dttm" => $date,
                        "used" => 0,
                        "kolom_id" => $kolom_id,
                        // "session" => $this->session->session
                    ];
        
                    $updaterespon = $this->soalmodel->updateResponPrev($soal_id, $group_id,$materi,$this->session->user_id,$data);
                } else {
                    if ($jawaban_id !== "null" && isset($soal_id)) {
                        $data = [
                            "jawaban_id" => $jawaban_id,
                            "pilihan_nm" => $pilihan_nm,
                            "soal_id" => $soal_id,
                            "no_soal" => $no_soal,
                            "group_id" => $group_id,
                            "materi" => $materi,
                            "used" => 0,
                            "kolom_id" => $kolom_id,
                            "created_user_id" => $this->session->user_id,
                            "created_dttm" => $date,
                            // "session" => $this->session->session
                        ];
            
                        $respon_id = $this->soalmodel->simpanRespon($data);
                    }
                }
            }
                if ($proc == "selesai") {
                    echo json_encode(array("proc" => $proc));
                } else {
                    if ($proc == "prevsoal") {
                        $no_soal = $no_soal - 1;
                    } else if ($proc == "next") {
                        $no_soal = $no_soal + 1;
                    }
                    
                    $res = $this->soalmodel->getSoalPkp($no_soal,$group_id,$materi,$kolom_id, $sk_group_id)->getResult();
                    $group_nm = "";
                    $jawaban_idx = "";
                    $pilihan_nms = "";
                    if (count($res)>0) {
                        $soal_nm = $res[0]->soal_nm;
                        $soal_id = $res[0]->soal_id;
                        $group_id = $res[0]->group_id;   
                        $group_nm = $res[0]->group_nm;   
                        $kolom_id = $res[0]->kolom_id;
                        // $res_ttlsoal = $this->soalmodel->getTotalSoal($group_id,$materi)->getResult();

                        $getjawaban = $this->soalmodel->getjawaban($res[0]->soal_id)->getResult();
                        
                        foreach ($getjawaban as $key) {
                            
                            $jawaban .= " <button id='dv_jawaban_".$key->jawaban_id."' onclick='startujian(\"next\",".$key->jawaban_id.",\"".$key->pilihan_nm."\")' class='btn btn-block btn-outline-primary' style='text-align:left;font-size:18px;margin-top:20px;padding-top:10px;padding-bottom:10px;border: 2px solid black;white-space: normal;'>
                                            <b>".$key->pilihan_nm.".</b> ".$key->jawaban_nm."
                                            </button>";
                        }
                       

                    } else {
                        $proc = "selesai";
                    }

                    $button = "";
                        echo json_encode(array("soal_id"=>$soal_id, "soal_nm" => $soal_nm,"no_soal"=>$no_soal, "group_id"=>$group_id, "group_nm"=>$group_nm,"kolom_id"=>$kolom_id, "jawaban_nm" => $jawaban, "boxnomorsoal" => $boxnomorsoal, "button" => $button, "proc" => $proc,"jawaban_idx"=>$jawaban_idx,"pilihan_nms"=>$pilihan_nms, "sk_group_id" => $sk_group_id));
                    
                }
        }
        
    }

    public function pkpujian_backup() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $request = \Config\Services::request();
        $soal_id = $this->request->getPost("soal_id");
        $jawaban_id = $this->request->getPost("jawaban_id");
        $group_id = $this->request->getPost("group_id");
        $no_soal = $this->request->getPost("no_soal");
        $pilihan_nm = $this->request->getPost("pilihan_nm");
        $kolom_id = $this->request->getPost("kolom_id");
        $materi = $this->request->getPost("materi");
        $proc = $this->request->getPost("proc");
        $waktu = $this->request->getPost("waktu");
        $date = date("Y-m-d H:i:s");
        $soal_nm = "";
        $jawaban = "";
        $boxnomorsoal = "";
        $res_ttlsoal = "";
        $sisawaktu = "";
        if ($jawaban_id == "null") {

        } else if ($proc == "next" && $jawaban_id == "") {
            echo json_encode("jawaban_kosong");
        } else {
            
            if ($proc == "prev" || $proc == "prevsoal" || $proc == "start") {

            } else {
                $getResponByid = $this->soalmodel->getResponPkp($soal_id,$group_id,$materi,$this->session->user_id)->getResult();
                if (count($getResponByid)>0) {
                    $data = [
                        "jawaban_id" => $jawaban_id,
                        "pilihan_nm" => $pilihan_nm,
                        "soal_id" => $soal_id,
                        "no_soal" => $no_soal,
                        "group_id" => $group_id,
                        "materi" => $materi,
                        "created_user_id" => $this->session->user_id,
                        "created_dttm" => $date,
                        "used" => 0,
                        "kolom_id" => $kolom_id,
                        // "session" => $this->session->session
                    ];
        
                    $updaterespon = $this->soalmodel->updateResponPkp($soal_id,$jawaban_id,$group_id,$materi,$this->session->user_id,$data);
                } else {
                    if ($jawaban_id !== "null" && isset($soal_id)) {
                        $data = [
                            "jawaban_id" => $jawaban_id,
                            "pilihan_nm" => $pilihan_nm,
                            "soal_id" => $soal_id,
                            "no_soal" => $no_soal,
                            "group_id" => $group_id,
                            "materi" => $materi,
                            "used" => 0,
                            "kolom_id" => $kolom_id,
                            "created_user_id" => $this->session->user_id,
                            "created_dttm" => $date,
                            // "session" => $this->session->session
                        ];
            
                        $respon_id = $this->soalmodel->simpanRespon($data);
                    }
                }
            }
                if ($proc == "selesai") {
                    // $data = [
                    //     "remaining_time" => $waktu,
                    //     "date" => $date,
                    //     "status_cd" => "normal",
                    //     "isFinish" => "finish"
                    // ];
                    // $this->soalmodel->updateRemainingTime($this->session->user_id,$materi,$data,"tryout");
                    echo json_encode(array("proc" => $proc));
                } else {
                    if ($proc == "prevsoal") {
                        $no_soal = $no_soal - 1;
                    } else if ($proc == "next") {
                        $no_soal = $no_soal + 1;
                    }
                    // echo json_encode($kolom_id);exit;
                    $res = $this->soalmodel->getSoalPkp($no_soal,$group_id,$materi,$kolom_id)->getResult();
                    $group_nm = "";
                    $jawaban_idx = "";
                    $pilihan_nms = "";
                    if (count($res)>0) {
                        $soal_nm = $res[0]->soal_nm;
                        $soal_id = $res[0]->soal_id;
                        $group_id = $res[0]->group_id;   
                        $group_nm = $res[0]->group_nm;   
                        $kolom_id = $res[0]->kolom_id;
                        // $res_ttlsoal = $this->soalmodel->getTotalSoal($group_id,$materi)->getResult();

                        $getjawaban = $this->soalmodel->getjawaban($res[0]->soal_id)->getResult();
                        $jawaban .= "<div class='col-md-12' style='display:flex;justify-content: center;'>";
                        foreach ($getjawaban as $key) {

                            $jawaban .= "<div class='text-center' style='margin:5px;'>
                                        <button onclick='startujian(\"next\",".$key->jawaban_id.",\"".$key->pilihan_nm."\")' type='button' class='btn btn-primary' style='font-size: 20px; ".($key->pilihan_nm == 'A' ? 'padding: 20px 33px; margin-right: 40px;' : 'padding: 20px;')."'>".$key->jawaban_nm."</button>
                                        </div>";
                        }
                        $jawaban .= "</div>";

                    } else {
                        $proc = "selesai";
                    }

                    $button = "";
                        echo json_encode(array("soal_id"=>$soal_id, "soal_nm" => $soal_nm,"no_soal"=>$no_soal, "group_id"=>$group_id, "group_nm"=>$group_nm,"kolom_id"=>$kolom_id, "jawaban_nm" => $jawaban, "boxnomorsoal" => $boxnomorsoal, "button" => $button, "proc" => $proc,"jawaban_idx"=>$jawaban_idx,"pilihan_nms"=>$pilihan_nms));
                }
        }
        
    }

    public function hasiltryout() {
        $request = \Config\Services::request();
        $user_id = $this->session->user_id;
        $materi_id = $request->uri->getSegment(3);
        
        return view('front/pkp/hasiltryout');
    }
}
