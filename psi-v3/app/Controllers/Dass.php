<?php

namespace App\Controllers;
use App\Models\Soalmodel;
use App\Models\Latihanmodel;


class Dass extends BaseController
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
        return view('front/dass/dass',$data);
    }

    public function ujian() {
        $request = \Config\Services::request();
        return view('front/dass/ujian');
    }

    public function petunjukdass() {
        $request = \Config\Services::request();
        $data = [
            'materi_id' => $request->uri->getSegment(3),            
            'group_id' => $request->uri->getSegment(4)
        ];

        return view('front/dass/petunjukdass',$data);
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

    public function dassujian() {
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
            
            if ($proc == "prev" || $proc == "prevsoal" || $proc == "start") {

            } else {
                $getResponByid = $this->soalmodel->getResponDass($soal_id,$group_id,$materi,$this->session->user_id)->getResult();
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
        
                    $updaterespon = $this->soalmodel->updateResponDass($soal_id,$jawaban_id,$group_id,$materi,$this->session->user_id,$data);
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
                    $res = $this->soalmodel->getSoalDass($no_soal,$group_id,$materi,$kolom_id)->getResult();
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
                        $index = 0;
                        foreach ($getjawaban as $key) {
                            $jawaban .= "<div class='text-center' style='margin:5px;'>
                                         <div onclick='startujian(\"next\",".$key->jawaban_id.",\"".$key->pilihan_nm."\",$index)' class='col-md-12' style='border:1px solid black;font-size:55px;padding-left:25px;padding-right:25px;'><b>".$key->pilihan_nm."</b></div>
                                         <div onclick='startujian(\"next\",".$key->jawaban_id.",\"".$key->pilihan_nm."\",$index)' class='col-md-12' style='border:1px solid black;'><input name='inp_chk_jawaban_id' id='inp_chk_jawaban_id_$index' type='checkbox' value='".$key->jawaban_id."' style='width: 100%;height: 50px;'></div>
                            </div>";
                            $index++;
                            // $jawaban .= "<div class='col-md-4 text-center'><button id='dv_jawaban_".$key->jawaban_id."' onclick='startujian(\"next\",".$key->jawaban_id.",\"".$key->pilihan_nm."\")' class='btn' style='font-size:24px;margin-top:20px;padding-top:10px;padding-bottom:10px;border: 2px solid black;white-space: normal;text-align:center;'>
                            //                 <b>".$key->pilihan_nm."</b>
                            //                 </button></div>";

                            // $jawaban .= "<div class='col-md-12 jawaban_dv' id='dv_jawaban_".$key->jawaban_id."' onclick='startujian(\"next\",".$key->jawaban_id.",\"".$key->pilihan_nm."\")' style='margin-top:10px;margin-bottom:10px;padding-top:5px;padding-bottom:5px;background-color:#aeaebb;border-radius:5px;text-align: justify;'> <label for='pilihan_nm'>".$key->pilihan_nm.". </label> <span>".$key->jawaban_nm."</span>
                            //     </div>";
                        }
                        $jawaban .= "</div>";

                    } else {
                        $proc = "selesai";
                    }

                    $button = "";
                        echo json_encode(array("soal_id"=>$soal_id, "soal_nm" => $soal_nm,"no_soal"=>$no_soal, "group_id"=>$group_id, "group_nm"=>$group_nm,"kolom_id"=>$kolom_id, "jawaban_nm" => $jawaban, "boxnomorsoal" => $boxnomorsoal, "button" => $button, "proc" => $proc,"jawaban_idx"=>$jawaban_idx,"pilihan_nms"=>$pilihan_nms));
                    // else {
                    //     $res_ttlsoal = $this->soalmodel->getTotalSoal($group_id,$materi)->getResult();
                    // }
                    // $no_soal_belum = array();
                    
    
                    
                    
                    // if ($group_id == 2) {
                    //     $button .= "<button onclick='startujian(\"prevsoal\")' style='font-size:16px;padding-left:25px;padding-right:25px;margin-bottom:10px;' class='btn btn-success'>Previous</button> &nbsp;";
                    // }
                    
                    // if ($jumlahjawab == count($res_ttlsoal) - 1) {
                    //     $button = "<button onclick='startujian(\"selesai\")' style='font-size:16px;padding-left:25px;padding-right:25px;' class='btn btn-success'>Selesai</button>";
                    // } else {
                    //     if (count($res_ttlsoal) != $no_soal) {
                    //         $button .= "<button onclick='startujian(\"next\")' style='font-size:16px;padding-left:25px;padding-right:25px;margin-bottom:10px;' class='btn btn-success'>Next</button>";
                    //     }
                    // }

                    // if (count($res_ttlsoal) == $no_soal) {
                    //     $group_id = $group_id + 1;
                    //     $button = "<button onclick='startujian(\"selesai\")' style='font-size:16px;padding-left:25px;padding-right:25px;' class='btn btn-success'>Selesai</button>";
                    // } else {
                        
                    // }
                    
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
