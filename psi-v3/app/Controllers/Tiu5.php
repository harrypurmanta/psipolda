<?php

namespace App\Controllers;
use App\Models\Soalmodel;
use App\Models\Latihanmodel;


class Tiu5 extends BaseController
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
        $group_id = $request->uri->getSegment(4);
        $data['materi'] = $this->soalmodel->getMateriByGroupId($group_id)->getResult();
        return view('front/tiu5/index',$data);
    }

    public function ujian() {
        $request = \Config\Services::request();
        $materi_id = $request->uri->getSegment(3);
        $group_id = $request->uri->getSegment(4);
        return view('front/tiu5/ujian');
    }

    public function petunjuktiu5() {
        $request = \Config\Services::request();
        $data = [
            'materi_id' => $request->uri->getSegment(3),            
            'group_id' => $request->uri->getSegment(4)
        ];

        return view('front/tiu5/petunjuktiu5',$data);
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

    public function tiu5ujian() {
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
        // $waktu = $this->request->getPost("waktu");
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
            // $sl_rt = $this->soalmodel->selectRemainingTime($this->session->user_id,$materi,"tryout")->getResult();
            // if (count($sl_rt)>0) {
            //     if ($sl_rt[0]->isFinish == "proses" && $proc == "start") {
            //         $cnvrt = str_replace(":","",$sl_rt[0]->remaining_time);
            //         $sisawaktu = $cnvrt / 60;
            //     } else {
            //         $data = [
            //             "remaining_time" => $waktu,
            //             "date" => $date,
            //             "status_cd" => "normal"
            //         ];
            //         $this->soalmodel->updateRemainingTime($this->session->user_id,$materi,$data,"tryout");
            //     }
                
            // } else {
            //     $data = [
            //         "remaining_time" => $waktu,
            //         "date" => $date,
            //         "status_cd" => "normal",
            //         "user_id" => $this->session->user_id,
            //         "materi_id" => $materi,
            //         "type" => "tryout",
            //         "isFinish" => "proses"
            //     ];
            //     $this->soalmodel->insertRemainingTime($data);
            // }

            if ($proc == "start") {
                $notes = $this->soalmodel->getLastNoTes($group_id)->getResult();
                
                if (count($notes)>0) {
                    $no_antrian = $notes[0]->no_antrian + 1;
                } else {
                    $no_antrian = 1;
                }
                
                $checkExam = $this->soalmodel->checkExamByUser($this->session->user_id,$group_id,$materi)->getResult();
                if (count($checkExam)>0) {
                    
                } else {
                    $dataexam = [
                        "group_id" => $group_id,
                        "materi_id" => $materi,
                        "user_id" => $this->session->user_id,
                        "no_antrian" => $no_antrian,
                    ];
                    $insertexam = $this->soalmodel->insertexam($dataexam);
                }
                
            }
            
            if ($proc == "prev" || $proc == "prevsoal" || $proc == "start") {

            } else {
                $getResponByid = $this->soalmodel->getResponTiu5($soal_id,$group_id,$materi,$this->session->user_id)->getResult();
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
        
                    $updaterespon = $this->soalmodel->updateResponTiu5($soal_id,$jawaban_id,$group_id,$materi,$this->session->user_id,$data);
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
                    $res = $this->soalmodel->getSoalTiu5($no_soal,$group_id,$materi,$kolom_id)->getResult();
                    $group_nm = "";
                    $jawaban_idx = "";
                    $pilihan_nms = "";
                    $clue_img = "";
                    $soal_img = "";
                    if (count($res)>0) {
                        $soal_nm = $res[0]->soal_nm;
                        $soal_id = $res[0]->soal_id;
                        $group_id = $res[0]->group_id;   
                        $group_nm = $res[0]->group_nm;   
                        $kolom_id = $res[0]->kolom_id;

                        $getclue = $this->soalmodel->getClueBySoalId($res[0]->soal_id)->getResult();
                        if (count($getclue) > 0) {
                            $clue_img .= "
                                            <div class='col-md-12' style='margin: 5px;'>
                                                <table border='1' class='text-center'>
                                                    <tr style='font-size: 20px;'><th colspan='2'>CLUE</th></tr>
                                                    <tr style='font-size: 30px; background-color: #96D4D4;'>";
                                                    foreach ($getclue as $k_nm) {
                                                        $clue_img .= "<th>".$k_nm->clue_nm."</th>";
                                                    }
                                        $clue_img .= "</tr>
                                                    <tr>";
                                                    foreach ($getclue as $k_img) {
                                                        $clue_img .= "<td><img src='".base_url()."/images/clue/group/5/materi/$materi/".$k_img->clue_img."'  style='width: 80px; height: 90%; padding: 5px;'</td>";
                                                    }
                                                       
                                        $clue_img .= "</tr>
                                                </table>
                                            </div>";
                          
                        }
                        $soal_img = "<div class='col-md-12' style='margin: 5px;'>
                                        <table border='1' class='text-center'>
                                            <tr style='font-size: 20px;'><th colspan='2'>SOAL</th></tr>
                                            <tr style='font-size: 30px; background-color: #3c8dbc;'>
                                                <th>C</th>
                                            </tr>
                                            <tr><td><img src='".base_url()."/images/soal/group/5/materi/$materi/".$res[0]->soal_img."'  style='width: 80px; height: 100%;'></td></tr>
                                        </table>
                                    </div>";

                        $getjawaban = $this->soalmodel->getjawaban($res[0]->soal_id)->getResult();
                        $jawaban .= "<div class='col-md-8' style='display:flex;justify-content: center; flex-wrap: wrap;'>";
                        $index = 0;
                        foreach ($getjawaban as $key) {
                            $jawaban .= "<div class='text-center col-md-2' style='margin: 5px; padding: 0px; cursor: pointer;'>
                                            <div onclick='startujian(\"next\",".$key->jawaban_id.",\"".$key->pilihan_nm."\",$index)' class='col-md-12' style='border: 1px solid black; font-size: 20px; padding-left: 10px; padding-right: 10px;'>
                                                <b>".$key->pilihan_nm."</b>
                                            </div>
                                         
                                         <div onclick='startujian(\"next\",".$key->jawaban_id.",\"".$key->pilihan_nm."\",$index)' class='col-md-12' style='border:1px solid black;'>
                                            <img src='".base_url()."/images/jawaban/group/5/materi/$materi/".$key->jawaban_img."'  style='width: 70px; height: 100%; padding-top: 5px; padding-bottom: 5px;'>
                                         </div>
                            </div>";

                            
                            $index++;
                        }
                        $jawaban .= "</div>";

                    } else {
                        $proc = "selesai";
                    }

                    $button = "";
                        echo json_encode(array("soal_id"=>$soal_id, "soal_nm" => $soal_nm,"no_soal"=>$no_soal, "group_id"=>$group_id, "group_nm"=>$group_nm,"kolom_id"=>$kolom_id, "jawaban_nm" => $jawaban, "boxnomorsoal" => $boxnomorsoal, "button" => $button, "proc" => $proc,"jawaban_idx"=>$jawaban_idx,"pilihan_nms"=>$pilihan_nms, "clue_img" => $clue_img, "soal_img" => $soal_img));
                   
                }
        }
        
    }

    public function hasiltryout() {
        $request = \Config\Services::request();
        $user_id = $this->session->user_id;
        $materi_id = $request->uri->getSegment(3);
        $klm = $this->soalmodel->getKolomSoal()->getResult();
        $kolom = array();
        foreach ($klm as $key) {
            $kolom[] = $key->kolom_nm;
        }
        $data = [
            "kolom" => $kolom
        ];
        return view('front/dass/hasiltryout',$data);
    }
}
