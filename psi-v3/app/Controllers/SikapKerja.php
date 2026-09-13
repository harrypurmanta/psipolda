<?php

namespace App\Controllers;
use App\Models\Soalmodel;
use App\Models\Latihanmodel;


class Sikapkerja extends BaseController
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
        return view('front/sikapkerja/index',$data);
    }

    public function ujian() {
        $request = \Config\Services::request();
        $materi_id = $request->uri->getSegment(3);
        $group_id = $request->uri->getSegment(4);
        return view('front/sikapkerja/ujian');
    }

    public function petunjuksikapkerja() {
        $request = \Config\Services::request();
        $data = [
            'materi_id' => $request->uri->getSegment(3),            
            'group_id' => $request->uri->getSegment(4)
        ];

        return view('front/sikapkerja/petunjuksikapkerja',$data);
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

    public function sikapkerjaujian() {
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
        $sk_group_id = $materi;
        $date = date("Y-m-d H:i:s");
      
        if ($jawaban_id == "null") {

        } else if ($proc == "next" && $jawaban_id == "") {
            echo json_encode("jawaban_kosong");
        } else {

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
                $getResponByid = $this->soalmodel->getResponSikapKerja($soal_id,$group_id,$materi,$this->session->user_id)->getResult();
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
        
                    $updaterespon = $this->soalmodel->updateResponSikapKerja($soal_id,$jawaban_id,$group_id,$materi,$this->session->user_id,$data);
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

            $no_soal = $no_soal + 1;
            if ($proc == "persiapan") {
                echo json_encode(array("ret"=>"persiapan", "kolom"=>$kolom_id));
            } else if ($no_soal == 51 && $group_id == 13 && $kolom_id <= 10) {
                echo json_encode(array("ret"=>"persiapan", "kolom"=>$kolom_id));
            } else if ($group_id == 13 && $kolom_id == 11) {
                echo json_encode(array("ret"=>"selesai"));
            } else {
                $res = $this->soalmodel->getSoalSikapKerja($no_soal, $group_id, $materi, $kolom_id)->getResult();
                if (count($res)>0) {
                    $ret = "<div class='col-md-12'>
                        <table border='0' style='margin: 0 auto;'>
                            <tbody>
                                <tr style='font-size: 75px; font-weight: bold; text-align: center;'>";
                                if ($res[0]->typesoal == "gambar") {
                                    $getjawaban = $this->soalmodel->getjawaban($res[0]->soal_id)->getResult();
                                    foreach ($getjawaban as $key) {
                                        $jawaban_nm = explode('|', $key->jawaban_nm);
                                        foreach ($jawaban_nm as $jwb_nm) {
                                            $src = base_url("images/soalskgambar/kolom/$kolom_id/sk_group/10/$jwb_nm");
                                            $ret .= "<td width='70'><img src='$src' style='height: 100px; width: 100px; margin: 5px;'></td>";
                                        }
                                    }
                                } else {
                                    $getjawaban = $this->soalmodel->getjawaban($res[0]->soal_id)->getResult();
                                    foreach ($getjawaban as $key) {
                                        $jawaban_nm = str_split($key->jawaban_nm,1);
                                        foreach ($jawaban_nm as $jwb_nm) {
                                            $ret .= "<td width='70'>$jwb_nm</td>";
                                        }
                                    }
                                }
                                
                            $ret .= "</tr>
                                <tr style='font-size:35px; font-weight:normal;text-align:center;'>
                                    <td>A</td>
                                    <td>B</td>
                                    <td>C</td>
                                    <td>D</td>
                                    <td>E</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class='col-md-12' style='width:100%; margin-top: 10px;'>
                        <label style='font-size:20px;' for='Pertanyaan'>Pertanyaan ".$no_soal."</label>
                        <div class='col-md-12 row' style='display:flex; justify-content:center; flex-wrap:wrap;'>";
                        if ($res[0]->typesoal == "gambar") {
                            foreach ($res as $keySoal) {
                                $soal_nm = explode('|', $keySoal->soal_nm);
                                foreach ($soal_nm as $jwb_nm) {
                                    $src = base_url("images/soalskgambar/kolom/$kolom_id/sk_group/10/$jwb_nm");
                                    $ret .= "<img src='$src' style='height: 100px; width: 100px; margin: 5px;'>";
                                }
                            }
                        } else {
                            foreach ($res as $keySoal) {
                                $soal_nm = str_split($keySoal->soal_nm,1);
                                foreach ($soal_nm as $jwb_nm) {
                                    $ret .= "<div class='col-md-2' style='background-color:grey; min-height:40px; font-size:55px; font-weight:bold; text-align:center; margin:5px; display: inline-block;'>
                            ".$jwb_nm."</div>";
                                }
                            }
                        }
                            
                            
                    $ret .= "</div>
                        <div class='col-md-12' style='display:flex;'>";
                        foreach ($getjawaban as $k) {
                            $jawaban_id = $k->jawaban_id;
                            $ret .= "<button onclick='startujian(\"next\",\"A\",".$jawaban_id.",".$res[0]->soal_id.",$group_id,$no_soal,$kolom_id,$materi)' style='margin:5px;font-weight:bold;font-size: 20px;'
                            class='btn btn-block btn-outline-success'>A</button>
                                    <button onclick='startujian(\"next\",\"B\",".$jawaban_id.",".$res[0]->soal_id.",$group_id,$no_soal,$kolom_id,$materi)' style='margin:5px;font-weight:bold;font-size: 20px;'
                                        class='btn btn-block btn-outline-success'>B</button>
                                    <button onclick='startujian(\"next\",\"C\",".$jawaban_id.",".$res[0]->soal_id.",$group_id,$no_soal,$kolom_id,$materi)' style='margin:5px;font-weight:bold;font-size: 20px;'
                                        class='btn btn-block btn-outline-success'>C</button>
                                    <button onclick='startujian(\"next\",\"D\",".$jawaban_id.",".$res[0]->soal_id.",$group_id,$no_soal,$kolom_id,$materi)' style='margin:5px;font-weight:bold;font-size: 20px;'
                                        class='btn btn-block btn-outline-success'>D</button>
                                    <button onclick='startujian(\"next\",\"E\",".$jawaban_id.",".$res[0]->soal_id.",$group_id,$no_soal,$kolom_id,$materi)' style='margin:5px; margin-right: 10px; font-weight:bold;font-size: 20px;'
                                        class='btn btn-block btn-outline-success'>E</button>";
                        }
                            
                    $ret .= "</div>
                    </div>";
                    echo json_encode(array("ret"=>$ret, "kolom"=>$kolom_id,"group_id"=>$group_id,"no_soal"=>$no_soal));
                } else {
                    $ret = "soal_tidak_ada";
                    echo json_encode(array("ret"=>$ret));
                }
            }
        }
        
    }

    public function hasiltryout() {
        if ($this->session->get("user_nm") == "") {
            return redirect('/');
        }

        $request = \Config\Services::request();
        $user_id = $this->session->get("user_id") ?? $this->session->user_id;
        $materi_id = $request->uri->getSegment(3);
        $group_id = $request->uri->getSegment(4);

        $materi_res = $this->soalmodel->getMateriById($materi_id)->getResult();
        $materi_nm = count($materi_res) > 0 ? $materi_res[0]->materi_nm : "Sikap Kerja";

        $db = \Config\Database::connect();

        // Ambil daftar kolom yang ada pada soal untuk materi ini
        $kolom_list = $db->table('soal a')
            ->select('a.kolom_id, COALESCE(b.kolom_nm, CONCAT("Kolom ", a.kolom_id)) as kolom_nm')
            ->join('kolom_soal b', 'b.kolom_id = a.kolom_id', 'left')
            ->where('a.materi', $materi_id)
            ->where('a.status_cd', 'normal')
            ->groupBy('a.kolom_id')
            ->orderBy('a.kolom_id', 'ASC')
            ->get()
            ->getResult();

        if (empty($kolom_list)) {
            // Coba ambil dari respon user
            $kolom_list = $db->table('respon a')
                ->select('a.kolom_id, COALESCE(b.kolom_nm, CONCAT("Kolom ", a.kolom_id)) as kolom_nm')
                ->join('kolom_soal b', 'b.kolom_id = a.kolom_id', 'left')
                ->where('a.materi', $materi_id)
                ->where('a.created_user_id', $user_id)
                ->groupBy('a.kolom_id')
                ->orderBy('a.kolom_id', 'ASC')
                ->get()
                ->getResult();
        }

        if (empty($kolom_list)) {
            $kolom_list = $db->table('kolom_soal')
                ->select('kolom_id, kolom_nm')
                ->orderBy('kolom_id', 'ASC')
                ->get()
                ->getResult();
        }

        if (empty($kolom_list)) {
            $kolom_list = [];
            for ($i = 1; $i <= 10; $i++) {
                $kolom_list[] = (object)[
                    'kolom_id' => $i,
                    'kolom_nm' => "Kolom " . $i
                ];
            }
        }

        $hasil_kolom = [];
        $total_terjawab = 0;
        $total_benar = 0;
        $total_salah = 0;
        $chart_labels = [];
        $chart_terjawab = [];
        $chart_benar = [];
        $chart_salah = [];

        foreach ($kolom_list as $klm) {
            $kolom_id = $klm->kolom_id;
            $kolom_nm = !empty($klm->kolom_nm) ? $klm->kolom_nm : "Kolom " . $kolom_id;

            $respon = $db->table('respon a')
                ->select('a.pilihan_nm, c.kunci')
                ->join('soal c', 'c.soal_id = a.soal_id', 'left')
                ->where('a.created_user_id', $user_id)
                ->where('a.materi', $materi_id)
                ->where('a.kolom_id', $kolom_id)
                ->get()
                ->getResult();

            $terjawab = 0;
            $benar = 0;
            $salah = 0;

            if (count($respon) > 0) {
                foreach ($respon as $r) {
                    if (!empty($r->pilihan_nm) && $r->pilihan_nm !== 'null') {
                        $terjawab++;
                        if (!empty($r->kunci) && trim(strtoupper($r->pilihan_nm)) === trim(strtoupper($r->kunci))) {
                            $benar++;
                        } else {
                            $salah++;
                        }
                    }
                }
            }

            $total_terjawab += $terjawab;
            $total_benar += $benar;
            $total_salah += $salah;

            $chart_labels[] = $kolom_nm;
            $chart_terjawab[] = $terjawab;
            $chart_benar[] = $benar;
            $chart_salah[] = $salah;

            $hasil_kolom[] = (object)[
                'kolom_id' => $kolom_id,
                'kolom_nm' => $kolom_nm,
                'terjawab' => $terjawab,
                'benar' => $benar,
                'salah' => $salah
            ];
        }

        $data = [
            'materi_id' => $materi_id,
            'group_id' => $group_id,
            'materi_nm' => $materi_nm,
            'hasil_kolom' => $hasil_kolom,
            'total_terjawab' => $total_terjawab,
            'total_benar' => $total_benar,
            'total_salah' => $total_salah,
            'chart_labels' => $chart_labels,
            'chart_terjawab' => $chart_terjawab,
            'chart_benar' => $chart_benar,
            'chart_salah' => $chart_salah,
        ];

        return view('front/sikapkerja/hasiltryout', $data);
    }
}
