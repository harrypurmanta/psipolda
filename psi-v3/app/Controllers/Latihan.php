<?php

namespace App\Controllers;
use App\Models\Soalmodel;
use App\Models\Latihanmodel;
class Latihan extends BaseController
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
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		} else {
            $data = [
                'jenis_soal' => $this->latihanmodel->getJenisSoal()->getResult(),
                'materiSK' => $this->soalmodel->getMateriSK()->getResult(),
            ];
            return view('front/latihan',$data);
        }
        
    }

    public function petunjuksoal() {
		$jenis_id = $this->request->getPost('jenis_id');
        $resjenis = $this->latihanmodel->getJenisByid($jenis_id)->getResult();
        if (count($resjenis)>0) {
            $ret = "<div class='col-lg-12' style='text-align:center;min-height: 400px;color:#000000;'>
                        <h1 style='margin:20px;'>Petunjuk ".$resjenis[0]->jenis_nm."</h1>
                        <p style='text-align:center;font-size:20px;'>".$resjenis[0]->petunjuk."</p>
                        <button style='font-size: 30px;' class='btn btn-primary' onclick='startlatihan(\"start\",11,1,$jenis_id,\"null\",\"null\")'>Mulai</button>
                    </div>";
        } else {
            $ret = "<div class='col-lg-12' style='text-align:center;min-height: 400px;color:#000000;'>
                        <h1 style='margin:20px;'>Jenis Soal tidak ada</h1>
                    </div>";
        }
        
        echo json_encode($ret);
    }

    public function startlatihan() {
		$soal_id        = $this->request->getPost('soal_id');
		$class_soal     = $this->request->getPost('class_soal');
		$materi         = $this->request->getPost('materi');
		$no_soal        = $this->request->getPost('no_soal');
		$jenis_id       = $this->request->getPost('jenis_id');
		$jawaban_id     = $this->request->getPost('jawaban_id');
		$pilihan_nm     = $this->request->getPost('pilihan_nm');
		$used           = $this->request->getPost('used');
        
        $date = date("Y-m-d H:i:s");

        if (!isset($jawaban_id)) {
            echo json_encode("jawabankosong");
        } else {

            if ($jawaban_id !== "null" && isset($soal_id)) {
                $data = [
                    "jawaban_id" => $jawaban_id,
                    "pilihan_nm" => $pilihan_nm,
                    "soal_id" => $soal_id,
                    "no_soal" => $no_soal - 1,
                    "materi" => $materi,
                    "jenis_id" => $jenis_id,
                    "used" => 0,
                    "created_user_id" => $this->session->user_id,
                    "created_dttm" => $date,
                    "session" => $this->session->session
                ];
    
                $respon_id = $this->latihanmodel->simpanRespon($data);
            }

            $max_no_soal = $this->latihanmodel->getMaxNoSoal($jenis_id,$materi)->getResult();
            $max_no_soal = $max_no_soal[0]->max_nosoal + 1;
            
            if ($no_soal <= $max_no_soal) {
                $boxnomorsoal = "";
                $res = $this->latihanmodel->getSoal($no_soal,$jenis_id)->getResult();
                if (count($res)>0) {
                    $res_ttlsoal = $this->latihanmodel->getTotalSoal($jenis_id)->getResult();
                    foreach ($res_ttlsoal as $boxsoal) {
                        $getResponBox = $this->latihanmodel->getResponBox($boxsoal->no_soal,$jenis_id,$this->session->user_id)->getResult();
    
                        if (count($getResponBox)>0) {
                            $style = "style='border:2px solid #79db79;width:50px;heigth:50px;margin:5px;'";
                        } else {
                            $style = "style='border:2px solid red;width:50px;heigth:50px;margin:5px;'";
                        }
    
                        $boxnomorsoal .= "<label $style>".$boxsoal->no_soal."</label>";
                    }
                        $ret = "<div class='row'>
                        <div class='col-lg-4'>
                        <div style='border:1px solid black;text-align:center;'>";
                            $ret .= $boxnomorsoal; 
                            if ($res[0]->soal_img == "") {
                                $img_soal = "";
                            } else {
                                $img_soal = "<img style='max-width:300px;heigth:100%;' src='".base_url()."/images/soal_latihan/jenis/$jenis_id/".$res[0]->soal_img.".jpg'>";
                            }
                              
                        $ret .= "</div></div>
                                <div class='col-lg-7' style='margin-left:20px;padding-left:20px;'>
                                <div style='width:100%;text-align:center;'>
                                <h1 style='margin:10px;text-decoration:underline;'>".$res[0]->jenis_nm."</h1>
                                </div>
                                <div>
                                <input type='hidden' name='soal_id' id='soal_id' value='".$res[0]->soal_id."' />
                                    <label style='font-size:20px;'>Soal ".$res[0]->no_soal."</label>
                                    <p style='font-size:25px;'>".$res[0]->soal_nm." $img_soal</p>
                                    
                                </div>
                                <div>
                                    <label style='font-size:20px;'>Jawaban</label>";
                                    $getjawaban = $this->latihanmodel->getjawaban($res[0]->soal_id)->getResult();
                                    foreach ($getjawaban as $key) {
                                        if ($key->jawaban_img == "") {
                                            $img_jwb = "";
                                        } else {
                                            $img_jwb = "<img style='max-width:150px;heigth:100%;' src='".base_url()."/images/jawaban_latihan/jenis/$jenis_id/".$key->jawaban_img.".jpg'>";
                                        }
                                        
                                        $jawaban_idbox = $key->jawaban_id;
                                        $ret .= "<div class='col-md-12 row' style='margin-bottom:10px;'><div class='col-md-1' style='text-align: center;'><input  type='radio' name='jawaban' id='jawaban_${jawaban_idbox}' value='".$key->jawaban_id."' data-pilihan='".$key->pilihan_nm."'/> </div><div class='col-md-11' style='padding:0px;'><label style='font-size:20px;' for='jawaban_${jawaban_idbox}'>".$key->pilihan_nm.". ".$key->jawaban_nm."</label> $img_jwb</div></div>";
                                    }
                                    $ret .= "<div><div style='text-align:right;'><button style='font-size:25px;' onclick='startlatihan(\"nextsoal\",$materi,$no_soal,$jenis_id,\"radio\")' class='btn btn-primary'>Next</button></div></div>";
                            $ret .= "</div>
                            </div>";
                } else {
                    $ret = "belumadasoal";
                }
                
                
            } else {
                $ret = "finish";
            }

            echo json_encode(array("html"=>$ret,"jenis_id"=>$jenis_id,"no_soal"=>$no_soal,"class_soal"=>$class_soal),JSON_UNESCAPED_SLASHES);
        }

        
    }

    public function showresult() {
        $jenis_id = $this->request->getPost('jenis_id');
        $benar  = 0;
        $salah  = 0;
        $res = $this->latihanmodel->getResponJenis($jenis_id,$this->session->user_id)->getResult();
        if (count($res)>0) {
            foreach ($res as $k) {
                if ($k->kunci_soal == $k->pilihan_respon) {
                    $benar = $benar + 1;
                } else {
                    $salah = $salah + 1;
                }
            }
        } else {
            # code...
        }
        
            $ret = "<div class='col-lg-12'>
                        <div style='width:100%;text-align:center;color:#000000;'>
                            <h1 style='margin:10px;'>SELAMAT !</h1>
                            <h1 style='margin:10px;'><span>SKOR ANDA</span> </h1>
                            <h1 style='margin:10px;'><span>Benar : $benar</span></h1>
                            <h1 style='margin:10px;'><span>Salah : $salah</span></h1>
                        </div>
                    </div>";

        echo json_encode(array("html"=>$ret));
    }

    public function showsk_grp() {
        $res = $this->latihanmodel->getSKgroup()->getResult();
        
        if (count($res)>0) {
            $db = db_connect();
            $user_id = $this->session->user_id;
            $ret = "<div class='row'>
                <div class='col-lg-12' style='text-align:center;'>
                <h1 style='margin:5px;text-decoration:underline;font-weight:bold;color:#ffffff;'> LATIHAN </h1>
                </div>";
            foreach ($res as $key) {
                $sk_group_id = $key->sk_group_id;
                $query = $db->query("SELECT * FROM respon a JOIN soal b ON b.soal_id=a.soal_id WHERE a.materi = 5 AND a.created_user_id = $user_id AND b.sk_group_id = $sk_group_id")->getResultArray();

                if (count($query)>0) {
                $used = $query[0]['used'] + 1;
                } else {
                $used = 1;
                }
                $ret .= "<div class='col-lg-2' style='cursor:pointer;margin-top:20px;text-align:center;'>
                            <div onclick='petunjuksoalsk(\"petunjuk\",0,$used,$sk_group_id)' id='sk_group_".$key->sk_group_id."'><img style='heigth:200px;width:150px;' src='images/bg/materi.png'></div>
                            <label style='color:#ffffff;font-size:20px;'>".$key->sk_group_nm."</label>
                        </div>";
            }
            $ret .= "</div>";
        } else {
            $ret = "Belum ada soal";
        }
        
        echo json_encode($ret);
    }

    public function latihanmateri() {

        $materi = $this->soalmodel->getjawAllJMateri()->getResult();
        if (count($materi)>0) {
            $ret = "";
            foreach ($materi as $key) {
                $resused = $this->latihanmodel->getUsedresponlatihan($key->materi_id,$this->session->user_id)->getResult();
                if (count($resused)>0) {
                    $used = $resused[0]->usedlatihan + 1;
                  } else {
                    $used = $resused + 1;
                  }

                $ret .= "<div style='cursor:pointer;display:inline-block;margin-left:10px;margin-right:10px;margin-top:30px;text-align:center;'>
                            <div onclick='petunjuksoalmateri(\"petunjukkecerdasan\",".$key->materi_id.",$used)' id='materi_".$key->materi_id."'><img style='heigth:200px;width:150px;' src='images/bg/materi.png'></div>
                            <label style='color:#ffffff;font-size:20px;'>".$key->materi_nm."</label>
                        </div>";
            }
              
        } else  {
          $ret = "BELUM ADA MATERI";
        }
        return $ret;
    }

    public function latihansubmateri() {
        $jenis_soal = $this->latihanmodel->getJenisSoal()->getResult();
        $jenis_idx = 1;
        if (count($jenis_soal)>0) {
            $ret = "";
            foreach ($jenis_soal as $js) {
                $used = 0;
                $jenis_id = $js->jenis_id;
                $user_id = $this->session->user_id;
                $db = db_connect();
                $querys = $db->query("SELECT * FROM respon_latihan WHERE jenis_id = $jenis_id AND created_user_id = $user_id ")->getResultArray();
      
                  if (count($querys)>0) {
                    $click = "onclick=\"showresult(".$js->jenis_id.")\"";
                    $stylebox = "width: 100%;text-align: center;border: 2px solid #198800;line-height: 100px;margin: 5px;border-radius: 5px;background-color: #aaff9d;cursor:pointer;font-size: 20px;font-weight: bold;";
                                
                                if ($jenis_idx == $js->jenis_id) {
                                  $jenis_idx = $jenis_idx + 1;
                                }
                                
                  } else  {
                                if ($js->jenis_id == $jenis_idx) {
                                  $stylebox = "text-align:center;border:2px solid #000000;line-height: 100px;margin:10px;border-radius:5px;cursor:pointer;font-size: 20px;font-weight: bold;color:#000000;";
                                  $click = "onclick=\"petunjuksoal($js->jenis_id)\"";
                                } else {
                                  $stylebox = "width:100%;text-align:center;border:2px solid #8888;line-height: 100px;margin:10px;border-radius:5px;font-size: 20px;font-weight: bold;color:#8888;";
                                  $click = "onclick=\"petunjuksoal($js->jenis_id)\"";
                                }
                  }
      
                              
                          $ret .= "<div class='col-lg-3' style='cursor:pointer;margin-top:30px;text-align:center;'>
                          <div $click id='materi_".$js->jenis_id."'><img style='heigth:200px;width:150px;' src='images/bg/materi.png'></div>
                          <label style='color:#ffffff;font-size:20px;'>".$js->jenis_nm."</label>
                        </div>";
              }
        } else {
            $ret = "BELUM ADA JENIS SOAL";
        }
        

        return $ret;
    }

    public function latihanpetunjuk() { 
        $ret = "<div class='col-lg-12' style='text-align:center;min-height: 400px;color:#000000;'>
                        <h1 style='margin:20px;'>Petunjuk Soal Kecerdasan</h1>
                    <p style='text-align:center;font-size:20px;'>Jawablah Setiap Pertanyaan dengan jujur, sesuai dengan kenyataan yang ada pada diri anda sendiri.</p>
                </div>";
        

                echo json_encode($ret);
    }

    public function petunjuksoalmateri() {
		$class_soal = $this->request->getPost('class_soal');
		$materi = $this->request->getPost('materi');
		$used = $this->request->getPost('used');
        // $res = $this->soalmodel->getSoalbyMateri($materi)->getResult();
        if ($materi == 2) {
            $class_soal = "petunjukkecerdasan";
        } 
        
        if ($class_soal == "petunjukpasshand") {
            $ret = "<div class='col-lg-12' style='text-align:center;min-height: 400px;color:#000000;'>
                        <h1 style='margin:20px;'>Petunjuk Soal Passhand</h1>
                    <p style='text-align:center;font-size:20px;'>Jawablah Setiap Pertanyaan dengan jujur, sesuai dengan kenyataan yang ada pada diri anda sendiri.</p>
                    <button style='font-size: 30px;' class='btn btn-primary' onclick='startujianlatihanmateri(\"$class_soal\",$materi,1,1,\"null\",\"null\",\"0\",$used)'>Mulai</button>
                </div>";
        } else if ($class_soal == "petunjukkecerdasan") {
            $ret = "<div class='col-lg-12' style='text-align:center;min-height: 400px;color:#000000;'>
                    <h1 style='margin:20px;'>Petunjuk Soal Kecerdasan</h1>
                    <p style='text-align:center;font-size:20px;margin:20px;'>Jawablah pertanyaan di bawah ini dengan memilih pilihan jawaban yang paling  tepat!</p>
                    <button style='font-size: 30px;' class='btn btn-primary' onclick='startujianlatihanmateri(\"$class_soal\",$materi,1,2,\"null\",\"null\",0,$used)'>Mulai</button>
                </div>";
        } else if ($class_soal == "petunjukkepribadian") {
            $ret = "<div class='col-lg-12' style='text-align:center;min-height: 400px;color:#000000;'>
                    <h1 style='margin:20px;'>Petunjuk Soal Kepribadian</h1>
                    <p style='text-align:center;font-size:20px;margin:20px;'>Tugas anda adalah memilih salah satu jawaban yang menurut anda paling sesuai dengan diri anda dari 4 kemungkinan jawaban.</p>
                    <button style='font-size: 30px;' class='btn btn-primary' onclick='startujianlatihanmateri(\"$class_soal\",$materi,1,3,\"null\",\"null\",0,$used)'>Mulai</button>
                </div>";
        } else if ($class_soal == "petunjuksikapkerja") {
            $ret = "<div class='col-lg-12' style='text-align:center;min-height: 400px;color:#000000;'>
                    <h1 style='margin:20px;'>Petunjuk Soal Sikap Kerja</h1>
                    <p style='text-align:center;font-size:20px;margin:20px;'></p>
                    <button style='font-size: 30px;' class='btn btn-primary' onclick='startujianlatihanmateri(\"$class_soal\",$materi,1,4,\"null\",\"null\",1,$used)'>Mulai</button>
                </div>";
        }
        
        echo json_encode($ret);
    }

    public function startujianlatihanmateri() {
		$soal_id        = $this->request->getPost('soal_id');
		$kolom_id       = $this->request->getPost('kolom_id');
		$class_soal     = $this->request->getPost('class_soal');
		$materi         = $this->request->getPost('materi');
		$no_soal        = $this->request->getPost('no_soal');
		$group_id       = $this->request->getPost('group_id');
		$jawaban_id     = $this->request->getPost('jawaban_id');
		$pilihan_nm     = $this->request->getPost('pilihan_nm');
		$used           = $this->request->getPost('used');
        $kolom_nm = "";
        $soal_terjawab_chart = "";
        $jawaban_benar_chart = "";
        
        if (isset($kolom_id)) {
            $kolom_id  = $kolom_id;
        } else {
            $kolom_id = 0;
        }
        
        $date = date("Y-m-d H:i:s");

        if (!isset($jawaban_id)) {
            echo json_encode("jawabankosong");
        } else {
            if ($jawaban_id == "null" || $class_soal == "prevsoal") {
            } else {
                $getResponByid = $this->latihanmodel->getResponByPrev($soal_id,$group_id,$materi,$this->session->user_id,$this->session->session,$used)->getResult();
    
                if (count($getResponByid)>0) {
                    $data = [
                        "jawaban_id" => $jawaban_id,
                        "pilihan_nm" => $pilihan_nm,
                        "soal_id" => $soal_id,
                        "no_soal" => $no_soal - 1,
                        "group_id" => $group_id,
                        "materi" => $materi,
                        "created_user_id" => $this->session->user_id,
                        "created_dttm" => $date,
                        "used" => $used,
                        "kolom_id" => $kolom_id,
                        "session" => $this->session->session
                    ];
        
                    $updaterespon = $this->latihanmodel->updateResponPrev($soal_id,$jawaban_id,$group_id,$materi,$this->session->user_id,$this->session->session,$data,$used);
                } else {
                    if ($jawaban_id !== "null" && isset($soal_id)) {
                        $data = [
                            "jawaban_id" => $jawaban_id,
                            "pilihan_nm" => $pilihan_nm,
                            "soal_id" => $soal_id,
                            "no_soal" => $no_soal - 1,
                            "group_id" => $group_id,
                            "materi" => $materi,
                            "used" => $used,
                            "kolom_id" => $kolom_id,
                            "created_user_id" => $this->session->user_id,
                            "created_dttm" => $date,
                            "session" => $this->session->session
                        ];
            
                        $respon_id = $this->latihanmodel->simpanRespon($data);
                    }
                }
            }

            $max_no_soal = $this->latihanmodel->getMaxNoSoallm($group_id,$materi)->getResult();
            $max_no_soal = $max_no_soal[0]->max_nosoal + 1;




            if ($no_soal == $max_no_soal && $group_id == 1) {
                $ret = "<div class='col-lg-12' style='text-align:center;min-height: 400px;color:#000000;'>
                    <h1 style='margin:20px;'>Petunjuk Soal Kecerdasan</h1>
                    <p style='text-align:center;font-size:20px;margin:20px;'>Jawablah pertanyaan di bawah ini dengan memilih pilihan jawaban yang paling  tepat!</p>
                    <button style='font-size: 30px;' class='btn btn-primary' onclick='startujianlatihanmateri(\"petunjukkecerdasan\",$materi,1,2,\"null\",\"null\",0,$used)'>Mulai</button>
                </div>";
                $class_soal = "petunjuksoal";
            } else if ($no_soal == $max_no_soal && $group_id == 2) {
                $ret = "<div class='col-lg-12' style='text-align:center;min-height: 400px;color:#000000;'>
                    <h1 style='margin:20px;'>Petunjuk Soal Kepribadian</h1>
                    <p style='text-align:center;font-size:20px;margin:20px;'>Tugas anda adalah memilih salah satu jawaban yang menurut anda paling sesuai dengan diri anda dari 4 kemungkinan jawaban.</p>
                    <button style='font-size: 30px;' class='btn btn-primary' onclick='startujianlatihanmateri(\"petunjukkepribadian\",$materi,1,3,\"null\",\"null\",0,$used)'>Mulai</button>
                </div>";
                $class_soal = "petunjuksoal";
            } else {
                if ($no_soal == 51 && $group_id == 4) {
                    $class_soal = "rehatsk";
                } else {
                    $res = $this->latihanmodel->getSoallatihanmateri($no_soal,$group_id,$materi,$kolom_id)->getResult();
                    if (count($res)>0) {
                        $res_ttlsoal = $this->latihanmodel->getTotalSoallatihanmateri($group_id,$materi)->getResult();
                    } else {
                        $materix = $materi;
                        $class_soal = "finish";
                    }
                }

                // log_message("debug",$res_ttlsoal);

                if ($class_soal == "Sikap Kerja" || $class_soal == "petunjuksikapkerja") {
                    
                    $ret = "<div class='col-lg-12' style='color:#000000;'> 
                                <div style='width:100%;text-align:center;'>
                                <h1 style='margin:10px;float:left;'>Tantangan $no_soal</h1>
                                <h1 style='margin:10px;'>".$res[0]->group_nm."</h1>
                                </div>
                                <div class='row'>
                                    <div class='col-lg-12'>
                                        <div style='text-align:center;'>
                                            <table border='1' style='width: 45%;margin: 0 auto;'>
                                            <thead>
                                            <th colspan='5' style='font-size:40px;'>
                                                Kolom ".$kolom_id."
                                            </th>
                                            </thead>
                                            <tbody>
                                            <tr style='font-size:50px;text-align:center;font-weight:bold;'>";
                                            $getjawaban = $this->latihanmodel->getjawabanlatihanmateri($res[0]->soal_id)->getResult();
                                            foreach ($getjawaban as $key) {
                                                $jawaban_nm = str_split($key->jawaban_nm,1);
                                                foreach ($jawaban_nm as $jwb_nm) {
                                                    $ret .= "<td>".$jwb_nm."</td>";
                                                }
                                            }
                                        $ret .= "</tr>
                                            <tr style='font-size:50px;text-align:center;font-weight:bold;color:red;'> <td>A</td>
                                            <td>B</td>
                                            <td>C</td>
                                            <td>D</td>
                                            <td>E</td>";
                                        $ret .= "</tr>
                                            </tbody>
                                            </table>
                                        </div>
        
                                        <div style='text-align:center;margin-top:30px;'>
                                            <table border='1' style='width: 35%;margin: 0 auto;'>
                                            <tbody>
                                            <tr style='font-size:50px;text-align:center;font-weight:bold;letter-spacing: 20px;'>
                                            <input type='hidden' name='soal_id' id='soal_id' value='".$res[0]->soal_id."' />
                                            <td colspan='5'>".$res[0]->soal_nm."</td>";
                                              
                                        $ret .= "</tr>
                                            <tr style='font-size:50px;text-align:center;font-weight:bold;background-color: #ececec;'>";
                                            foreach ($getjawaban as $k) {
                                                $jawaban_id = $k->jawaban_id;
                                                $ret .= "<td><label style='cursor:pointer;width:100%;height:100%;' onclick='startujianlatihanmateri(\"nextsoal\",$materi,$no_soal,$group_id,$jawaban_id,\"A\",$kolom_id,$used)'>A</label></td>
                                                <td><label style='cursor:pointer;width:100%;height:100%;' onclick='startujianlatihanmateri(\"nextsoal\",$materi,$no_soal,$group_id,$jawaban_id,\"B\",$kolom_id,$used)'>B</label></td>
                                                <td><label style='cursor:pointer;width:100%;height:100%;' onclick='startujianlatihanmateri(\"nextsoal\",$materi,$no_soal,$group_id,$jawaban_id,\"C\",$kolom_id,$used)'>C</label></td>
                                                <td><label style='cursor:pointer;width:100%;height:100%;' onclick='startujianlatihanmateri(\"nextsoal\",$materi,$no_soal,$group_id,$jawaban_id,\"D\",$kolom_id,$used)'>D</label></td>
                                                <td><label style='cursor:pointer;width:100%;height:100%;' onclick='startujianlatihanmateri(\"nextsoal\",$materi,$no_soal,$group_id,$jawaban_id,\"E\",$kolom_id,$used)'>E</label></td>";
                                            }
                                            
                                        $ret .= "</tr>
                                            </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>";
                    // echo json_encode(array("html"=>$ret,"materi"=>$materi));
                } else if ($class_soal == "finish") {
                    $benar_passhand = 0;
                    $salah_passhand = 0;
                    $benar_kec = 0;
                    $salah_kec = 0;
                    $benar_keb = 0;
                    $salah_keb = 0;
                    $benar_sk  = 0;
                    $salah_sk  = 0;
                    $total_skor  = 0;
                    $persen_kec  = 0;
                    $persen_kep  = 0;
                    $persen_sk = 0;
                    $passhandjwb = "";
                   

                    $kecerdasanskor = $this->latihanmodel->getKecerdasanSkor($this->session->user_id,$this->session->session,$materi,$used)->getResult();
                    foreach ($kecerdasanskor as $kec) {
                        if ($kec->kunci == $kec->pilihan_nm) {
                            $benar_kec = $benar_kec + 1;
                        } else {
                            $salah_kec = $salah_kec + 1;
                        }
                    }

                    $persen_kec = ($benar_kec * 0.0025) * 100;
        
                    $kepskor = $this->latihanmodel->getKepribadianSkor($this->session->user_id,$this->session->session,$materi,$used)->getResult();
                    foreach ($kepskor as $kep) {
                        if ($kep->kunci == $kep->pilihan_nm) {
                            $benar_keb = $benar_keb + 1;
                        } else {
                            $salah_keb = $salah_keb + 1;
                        }
                    }

                    $persen_kep = ($benar_keb * 0.005) * 100;
        
                    
        
                    $total_skor = $persen_kep + $persen_kec;
                    // if ($materi == 8) {
                    //     $persen_kec = (rand(21,23));
                    //     $persen_kep = (rand(21,23));
                    //     $persen_sk = (rand(21,23));
                    //     $total_skor = $persen_sk + $persen_kep + $persen_kec;

                    //     $data = [
                    //         "session_soal_nm" => "materi4",
                    //         "skor_kec" => $persen_kec,
                    //         "skor_kep" => $persen_kep,
                    //         "skor_sk" => $persen_sk,
                    //     ];

                    //     $this->latihanmodel->insertsessionskor($data);
                    // }

                    if ($total_skor >= 61) {
                        $styletotalskor = "color:green;";
                        $syarat = "(Memenuhi Syarat - MS)";
                    } else {
                        $styletotalskor = "color:red;";
                        $syarat = "(Tidak Memenuhi Syarat - TMS)";
                    }
                    $ret = "<div class='col-lg-12'>
                        <div style='width:100%;text-align:center;color:#000000;'>
                            <h1 style='margin:10px;color:#ffffff;'>SELAMAT !</h1>
                            <h1 style='margin:10px;color:#ffffff;'><span>SKOR ANDA</span> <span style='$styletotalskor'>$total_skor</span></h1>
                            <h1 style='margin:10px;$styletotalskor'>$syarat</h1>
                        </div>
                        <div style='margin:20px;'>
                        <table border='0' style='table-layout:fixed;width: 100%;'>
                        <tbody>
                        
                        <tr style='font-size:25px;border-bottom:1px solid black;height: 100px;'><td>Kecerdasan</td><td width='50' style='text-align:center;'>:</td><td width='80' style='text-align:center;'><label>".ceil($persen_kec)."</label></td></tr>
                        <tr style='font-size:25px;border-bottom:1px solid black;height: 100px;'><td>Kepribadian</td><td style='text-align:center;'>:</td><td style='text-align:center;'><label>".ceil($persen_kep)."</label></td></tr>
                        
                        </tbody>
                        </table>
                        </div>";
           
                $ret .= "</div>";
        
                    // echo json_encode(array("html"=>$ret,"materi"=>$materi));
                } else if ($class_soal == "rehatsk") {
                    
                    $ret = "<div class='col-lg-12' style='text-align:center;min-height: 400px;s'>
                        <h1 style='margin:10px;'>Persiapan . . .</h1>
                        <p style='text-align:justify;font-size:20px;'></p>
                    </div>";
                } else {
                    
                    // $ttlsoal = count($res_ttlsoal);
                    $boxnomorsoal = "";
                    foreach ($res_ttlsoal as $boxsoal) {
                        $getResponBox = $this->latihanmodel->getResponBoxlatihanmateri($boxsoal->no_soal,$group_id,$materi,$this->session->user_id,$this->session->session,$used)->getResult();
                        
                        if ($group_id == 2) {
                            $boxclick = "onclick='startujianlatihanmateri(\"prevsoal\",$materi,$boxsoal->no_soal,$group_id,\"radio\",\"null\",0,$used)'";
                            $boxcursor = "cursor:pointer;";
                        } else {
                            $boxclick = "";
                            $boxcursor = "";
                        }
    
                        if (count($getResponBox)>0) {
                            $style = "style='border:2px solid #79db79;width:50px;height:50px;margin:5px;$boxcursor'";
                        } else {
                            $style = "style='border:2px solid red;width:50px;height:50px;margin:5px;$boxcursor'";
                        }
    
                        if ($group_id == 2 && $boxsoal->no_soal == $no_soal) {
                            $style = "style='border:2px solid blue;width:50px;height:50px;margin:5px;$boxcursor'";
                        }
                        
                        $boxnomorsoal .= "<label $boxclick $style>".$boxsoal->no_soal."</label>";
                    }
    $ret = "<div class='row'>
    <div class='col-lg-4'>
    <div style='border:1px solid black;text-align:center;'>";
        $ret .= $boxnomorsoal; 
        if ($res[0]->soal_img == "") {
            $img_soal = "";
        } else {
            $img_soal = "<div class='col-sm-10'>
            <a href='".base_url()."/images/soal/materi/".$res[0]->materi."/besar/".$res[0]->soal_img."' data-toggle='lightbox' data-max-width='600' data-max-height='600'>
            <img src='".base_url()."/images/soal/materi/".$res[0]->materi."/".$res[0]->soal_img."' class='img-fluid'>
            </a>
        </div>";
            

        }
                              
    $ret .= "</div></div>
    <div class='col-lg-7' style='margin-left:20px;padding-left:20px;'>
                                <div style='width:100%;text-align:center;'>
                                <h1 style='margin:10px;text-decoration:underline;'>".$res[0]->group_nm."</h1>
                                </div>
                                <div>
                                <input type='hidden' name='soal_id' id='soal_id' value='".$res[0]->soal_id."' />
                                    <label style='font-size:20px;'>Soal ".$res[0]->no_soal."</label>
                                    <p style='font-size:25px;'>".$res[0]->soal_nm."</p>
                                    $img_soal
                                    
                                    
                                </div>
                                <div>
                                    <label style='font-size:20px;'>Jawaban</label>
                                    <div class='col-md-12 row'>";
                                    $getjawaban = $this->soalmodel->getjawaban($res[0]->soal_id)->getResult();
                                    foreach ($getjawaban as $key) {
                                        
                                        
                                        $getResponByJawabanId = $this->latihanmodel->getResponByJawabanIdlatihanmateri($key->jawaban_id,$group_id,$materi,$this->session->user_id,$this->session->session,$used)->getResult();
                                        if (count($getResponByJawabanId)>0) {
                                            $checked = "checked";
                                        } else {
                                            $checked = "";
                                        }
                                        $jawaban_idbox = $key->jawaban_id;
                                        if ($key->jawaban_img == "") {
                                            $img_jwb = "";
                                            $ret .= "<div class='col-md-12 row' style='margin-bottom:10px;'>
                                                        <div class='col-md-1' style='text-align:center;'>
                                                            <input $checked type='radio' name='jawaban' id='jawaban_${jawaban_idbox}' value='".$key->jawaban_id."' data-pilihan='".$key->pilihan_nm."'/> 
                                                        </div>
                                                        <div class='col-md-1'>
                                                        <label style='font-size:20px;' for='jawaban_${jawaban_idbox}'>".$key->pilihan_nm.". </label>
                                                        </div>
                                                        <div class='col-md-10' style='padding:0px;font-size:20px;'><label for='jawaban_${jawaban_idbox}'>".$key->jawaban_nm."</label></div>
                                                    </div>";
                                            
                                        } else {
                                            $img_jwb = "<img style='max-width:350px;height:100%;' src='".base_url()."/images/jawaban/materi/".$res[0]->materi."/".$key->jawaban_img.".jpg'>";

                            $ret .= "<div class='col-md-5 row' style='margin:10px;'>
                                        <div class='col-md-1'>
                                            <input $checked type='radio' name='jawaban' id='jawaban_${jawaban_idbox}' value='".$key->jawaban_id."' data-pilihan='".$key->pilihan_nm."'/> 
                                        </div>
                                        <div class='col-md-2'>
                                        <label style='font-size:20px;' for='jawaban_${jawaban_idbox}'>".$key->pilihan_nm.". ".$key->jawaban_nm."</label>
                                        </div>
                                        <div class='col-md-5' style='padding:0px;text-align: center;'><label for='jawaban_${jawaban_idbox}'>$img_jwb</label></div>
                                    </div>";

                                        }
                                    }
                            $ret .= "</div>";
                            if ($group_id == 2) {
                                if ($no_soal == 1) {
                                    $ret .= "<div><div style='text-align:right;'><button style='font-size:25px;' onclick='startujianlatihanmateri(\"nextsoal\",$materi,$no_soal,$group_id,\"radio\",\"null\",0,$used)' class='btn btn-primary'>Next</button></div></div>";
                                } else if ($no_soal == $max_no_soal - 1) {
                                    $no_prev = $no_soal - 1;
                                    $cekrespon = $this->latihanmodel->cekResponlatihanmateri($group_id,$materi,$this->session->user_id,$this->session->session)->getResult();
                                    if ($cekrespon[0]->jml_respon < $max_no_soal - 2) {
                                        $ret .= "<div><div style='text-align:right;'><button style='font-size:25px;' onclick='startujianlatihanmateri(\"prevsoal\",$materi,$no_prev,$group_id,\"radio\",\"null\",0,$used)' class='btn btn-primary'>Previous</button></div></div>";
                                    } else {
                                        $ret .= "<div><div style='text-align:right;'><button style='font-size:25px;' onclick='startujianlatihanmateri(\"prevsoal\",$materi,$no_prev,$group_id,\"radio\",\"null\",0,$used)' class='btn btn-primary'>Previous</button> <button style='font-size:25px;' onclick='startujianlatihanmateri(\"nextsoal\",$materi,$no_soal,$group_id,\"radio\",\"null\",0,$used)' class='btn btn-primary'>Next</button></div></div>";
                                    }
                                } else {
                                    $no_prev = $no_soal - 1;
                                    $ret .= "<div><div style='text-align:right;'><button style='font-size:25px;' onclick='startujianlatihanmateri(\"prevsoal\",$materi,$no_prev,$group_id,\"radio\",\"null\",0,$used)' class='btn btn-primary'>Previous</button> <button style='font-size:25px;' onclick='startujianlatihanmateri(\"nextsoal\",$materi,$no_soal,$group_id,\"radio\",\"null\",0,$used)' class='btn btn-primary'>Next</button></div></div>";
                                }
        
                                
                            } else {
                                $ret .= "<div><div style='text-align:right;'><button style='font-size:25px;' onclick='startujianlatihanmateri(\"nextsoal\",$materi,$no_soal,$group_id,\"radio\",\"null\",0,$used)' class='btn btn-primary'>Next</button></div></div>";
                            }

                // PEMBAHASAN

                $ret .= "<div>
                        <button onclick='if(document.getElementById(\"spoiler\") .style.display==\"none\") {document.getElementById(\"spoiler\") .style.display=\"\"}else{document.getElementById(\"spoiler\") .style.display=\"none\"}' style='margin-bottom:10px;' type='button' class='btn bg-gradient-secondary'>pembahasan</button>
                        <div id='spoiler' style='display:none;border: 1px solid black;background-color: #8fbc8f;border-radius:5px;'>";
                        if ($group_id == 2) {
                            $ret .= "<img style='padding:10px' src='".base_url()."/images/pembahasan/".$res[0]->materi."/".$res[0]->pembahasan_img."'>";
                        } else if ($group_id == 3) {
                            log_message("info",$res[0]->kunci);
                            log_message("info",$res[0]->soal_id);
                            $resjawaban_nm = $this->latihanmodel->getJawabannm($res[0]->kunci,$res[0]->soal_id)->getResult();
                            $ret .= "<span>".$resjawaban_nm[0]->pilihan_nm.". ".$resjawaban_nm[0]->jawaban_nm."</span>";
                        }
                        
                $ret .= "</div>
                     </div>";




                            $ret .= "</div>
                            </div>";
                }
            }
    
            echo json_encode(array("html"=>$ret,"materi"=>$materi,"group_id"=>$group_id,"no_soal"=>$no_soal,"class_soal"=>$class_soal,"kolom_nm"=>$kolom_nm,"soal_terjawab_chart"=>$soal_terjawab_chart,"jawaban_benar_chart"=>$jawaban_benar_chart),JSON_UNESCAPED_SLASHES);
        }
    }
}
