<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Usersmodel;
use App\Models\Soalmodel;
use App\Models\Hasilmodel;
use App\Models\Satuanmodel;
use TCPDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Hasil extends BaseController
{
    protected $usermodel;
    protected $soalmodel;
    protected $hasilmodel;
    protected $satuanmodel;
    protected $session;
    public function __construct()
	{
		$this->session = \Config\Services::session();
        $this->usermodel = new Usersmodel();
        $this->soalmodel = new Soalmodel();
        $this->hasilmodel = new Hasilmodel();
        $this->satuanmodel = new Satuanmodel();
	}

    public function index()
    {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		} else {
           
            $user_id = $this->request->getUri()->getSegment(3);
            $data = [           
                "group" => $this->soalmodel->getGroup()->getResult(),
                "user" => $this->usermodel->getbyUserId($user_id)->getResult(),
                "user_id" => $user_id
            ];

            return view('admin/hasil',$data);
        }
        
    }

    public function usertiu5() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        
        return view('admin/usertiu5');
    }
    public function userdass() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $start_dttm = $this->request->getUri()->getSegment(4);
        $end_dttm = $this->request->getUri()->getSegment(5);
        $group_id = $this->request->getUri()->getSegment(6);
        $data["users"] = $this->usermodel->getUserHasilDass($start_dttm,$end_dttm,$group_id)->getResult();
        return view('admin/userdass',$data);
    }

    public function userdbi() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $start_dttm = $this->request->getUri()->getSegment(4);
        $end_dttm = $this->request->getUri()->getSegment(5);
        $group_id = $this->request->getUri()->getSegment(6);
        $data["users"] = $this->usermodel->getUserHasilDbi($start_dttm,$end_dttm,$group_id)->getResult();
        return view('admin/dbi/userdbi',$data);
    }

    public function userpapi() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $start_dttm = $this->request->getUri()->getSegment(4);
        $end_dttm = $this->request->getUri()->getSegment(5);
        $group_id = $this->request->getUri()->getSegment(6);
        $data["users"] = $this->usermodel->getUserHasilPapi($start_dttm,$end_dttm,$group_id)->getResult();
        return view('admin/userpapi',$data);
    }

    public function userkreplin() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $start_dttm = $this->request->getUri()->getSegment(4);
        $end_dttm = $this->request->getUri()->getSegment(5);
        $group_id = $this->request->getUri()->getSegment(6);
        $materi_id = $this->request->getUri()->getSegment(7);
        $data["users"] = $this->usermodel->getUserHasilKreplin($start_dttm,$end_dttm,$group_id,0)->getResult();
        $data["satuan"] = $this->satuanmodel->getSatuan()->getResult();
        return view('admin/userkreplin',$data);
    }

    public function userpauli() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $start_dttm = $this->request->getUri()->getSegment(4);
        $end_dttm = $this->request->getUri()->getSegment(5);
        $group_id = $this->request->getUri()->getSegment(6);
        $materi_id = $this->request->getUri()->getSegment(7);
        $data["users"] = $this->usermodel->getUserHasilPauli($start_dttm,$end_dttm,$group_id,0)->getResult();
        $data["satuan"] = $this->satuanmodel->getSatuan()->getResult();
        return view('admin/hasil/pauli/userpauli',$data);
    }

    public function getUserTiu5() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $start_dttm = $this->request->getPost("start_date");
        $end_dttm = $this->request->getPost("end_date");
        $tipesoal = $this->request->getPost("tipesoal");
        $group_id = 5;
        // echo json_encode($start_dttm);exit;
        $data = $this->usermodel->getUserHasilTiu5($start_dttm, $end_dttm, $group_id, $tipesoal)->getResult();
        echo json_encode($data);
    }
    public function getUserDass() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $start_dttm = $this->request->getPost("start_date");
        $end_dttm = $this->request->getPost("end_date");
        $group_id = 4;
        // echo json_encode($start_dttm);exit;
        $data = $this->usermodel->getUserHasilDass($start_dttm,$end_dttm,$group_id)->getResult();
        echo json_encode($data);
    }

    public function getUserDbi() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $start_dttm = $this->request->getPost("start_date");
        $end_dttm = $this->request->getPost("end_date");
        $group_id = 8;
        // echo json_encode($start_dttm);exit;
        $data = $this->usermodel->getUserHasilDbi($start_dttm,$end_dttm,$group_id)->getResult();
        echo json_encode($data);
    }

    public function getUserPapi() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $start_dttm = $this->request->getPost("start_date");
        $end_dttm = $this->request->getPost("end_date");
        $group_id = 6;
        // echo json_encode($start_dttm);exit;
        $data = $this->usermodel->getUserHasilPapi($start_dttm,$end_dttm,$group_id)->getResult();
        echo json_encode($data);
    }

    public function getUserKreplin() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $start_dttm = $this->request->getPost("start_date");
        $end_dttm = $this->request->getPost("end_date");
        $satuan = $this->request->getPost("satuan");
        $group_id = 3;
        
        $data = $this->usermodel->getUserHasilKreplin($start_dttm,$end_dttm,$group_id,$satuan)->getResult();
        echo json_encode($data);
    }

    public function getUserPauli() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $start_dttm = $this->request->getPost("start_date");
        $end_dttm = $this->request->getPost("end_date");
        $satuan = $this->request->getPost("satuan");
        $group_id = 9;
        
        $data = $this->usermodel->getUserHasilPauli($start_dttm,$end_dttm,$group_id,$satuan)->getResult();
        echo json_encode($data);
    }

    public function hasilpapi() {
        return view('admin/hasilpapi');
    }

    public function hasiltiu5() {
        $request = \Config\Services::request();
        $start_dttm = $request->uri->getSegment(4);
        $end_dttm = $request->uri->getSegment(5);
        $user_id = $request->uri->getSegment(6);
        $tipesoal = $request->uri->getSegment(7);
        $benar = 0;
        $salah = 0;
        $user = $this->usermodel->getbyUserId($user_id)->getResult();
        $sekarang = new \DateTime("today");
        $tanggal_lahir = new \DateTime($user[0]->birth_dttm);
            if ($tanggal_lahir > $sekarang) { 
                $thn_lahir = "0";
            }
                $thn_lahir = $sekarang->diff($tanggal_lahir)->y;


        $tanggal_pemeriksaan = $this->hasilmodel->getTanggalTesTiu5($user_id, 5, $tipesoal)->getResult();
        $res = $this->hasilmodel->getHasilTiu5($user_id, 5, $tipesoal)->getResult();
        if (count($res)>0) {
            foreach ($res as $key) {
                if ($key->pilihan_nm == $key->kunci) {
                    $benar = $benar + 1;
                } else {
                    $salah = $salah + 1;
                }
                
            }
        }
        
        $notestpeserta = 0;
        
        $notest = $this->usermodel->getNotest($user_id, 5)->getResult();
        if (count($notest)>0) {
            $notestpeserta = $notest[0]->no_antrian;
        } else {
            $notestpeserta = 0;
        }
        
        
        $data = [
            "user" => $user,
            "tanggal_pemeriksaan" => $tanggal_pemeriksaan,
            "thn_lahir" => $thn_lahir,
            "benar" => $benar,
            "salah" => $salah,
            "notest" => $notestpeserta
        ];
        
        return view('admin/hasiltiu5', $data);
    }

    public function hasilbdi() {
        $request = \Config\Services::request();
        $start_dttm = $request->uri->getSegment(4);
        $end_dttm = $request->uri->getSegment(5);
        $user_id = $request->uri->getSegment(6);
        $user = $this->usermodel->getbyUserId($user_id)->getResult();
        $sekarang = new \DateTime("today");
        $tanggal_lahir = new \DateTime($user[0]->birth_dttm);
            if ($tanggal_lahir > $sekarang) { 
                $thn_lahir = "0";
            }
                $thn_lahir = $sekarang->diff($tanggal_lahir)->y;


        $tanggal_pemeriksaan = $this->usermodel->getTanggalTes($user_id,8)->getResult();
        
        $notestpeserta = 0;
        
        $notest = $this->usermodel->getNotest($user_id, 8)->getResult();
        if (count($notest)>0) {
            $notestpeserta = $notest[0]->no_antrian;
        } else {
            $notestpeserta = 0;
        }

        $total = 0;
        $kategori = "";

        $res = $this->usermodel->getHasilDbiByUserId($user_id, 8)->getResult();
        if (count($res) > 0) {
            $total = $res[0]->jumlah;

            if ($total >= 1 && $total <= 10) {
                $kategori = "Normal";
            } elseif ($total >= 11 && $total <= 16) {
                $kategori = "Moderat";
            } elseif ($total >= 17 && $total <= 20) {
                $kategori = "Garis Batas";
            } elseif ($total >= 21 && $total <= 30) {
                $kategori = "Depresi Sedang";
            } elseif ($total >= 31 && $total <= 40) {
                $kategori = "Depresi Parah";
            } elseif ($total > 40) {
                $kategori = "Depresi Ekstrim";
            } else {
                $kategori = "Tidak Diketahui";
            }
        }

        $data = [
            "user" => $user,
            "tanggal_pemeriksaan" => $tanggal_pemeriksaan,
            "thn_lahir" => $thn_lahir,
            "notest" => $notestpeserta,
            "total" => $total,
            "kategori" => $kategori
        ];
        return view('admin/dbi/hasildbi',$data);
    }

    public function hasildass() {
        $request = \Config\Services::request();
        $start_dttm = $request->uri->getSegment(4);
        $end_dttm = $request->uri->getSegment(5);
        $user_id = $request->uri->getSegment(6);
        $user = $this->usermodel->getbyUserId($user_id)->getResult();
        $sekarang = new \DateTime("today");
        $tanggal_lahir = new \DateTime($user[0]->birth_dttm);
            if ($tanggal_lahir > $sekarang) { 
                $thn_lahir = "0";
            }
                $thn_lahir = $sekarang->diff($tanggal_lahir)->y;


        $tanggal_pemeriksaan = $this->usermodel->getTanggalTes($user_id,4)->getResult();
        $depression = $this->usermodel->getDepression($user_id,4,5)->getResult();
        $anxiety = $this->usermodel->getAnxiety($user_id,4,6)->getResult();
        $stress = $this->usermodel->getStess($user_id,4,7)->getResult();
        
        $notestpeserta = 0;
        
        $notest = $this->usermodel->getNotest($user_id, 4)->getResult();
        if (count($notest)>0) {
            $notestpeserta = $notest[0]->no_antrian;
        } else {
            $notestpeserta = 0;
        }
        
        
        $data = [
            "user" => $user,
            "tanggal_pemeriksaan" => $tanggal_pemeriksaan,
            "depression" => $depression,
            "anxiety" => $anxiety,
            "stress" => $stress,
            "thn_lahir" => $thn_lahir,
            "notest" => $notestpeserta
        ];
        return view('admin/hasildass',$data);
    }

    public function hasilkreplin() {
        $request = \Config\Services::request();
        $start_dttm = $request->uri->getSegment(4);
        $end_dttm = $request->uri->getSegment(5);
        $user_id = $request->uri->getSegment(6);
        // echo json_encode($user_id);exit;
        $kolom1 = array();
        $kolom2 = array();
        $kolom3 = array();
        $kolom4 = array();
        $jml_jawab1 = array();
        $jml_jawab2 = array();
        $jml_jawab3 = array();
        $jml_jawab4 = array();
        $jml_salah = 0;
        $total_jawab1 = 0;
        $total_jawab2 = 0;
        $total_jawab3 = 0;
        $total_jawab4 = 0;
        $rata1 = 0;
        $rata2 = 0;
        $notestpeserta = 0;
        
        $user = $this->usermodel->getbyUserId($user_id)->getResult();
        $notest = $this->usermodel->getNotest($user_id, 3)->getResult();
        if (count($notest)>0) {
            $notestpeserta = $notest[0]->no_antrian;
        } else {
            $notestpeserta = 0;
        }
        
        for ($i=1; $i <= 4; $i++) { 
            $klm = $this->soalmodel->getKolomSoal()->getResult();
            foreach ($klm as $key) {
                if ($i == 1) {
                    $kolom1[] = $key->kolom_id;
                } else if ($i == 2) {
                    $kolom2[] = $key->kolom_id;
                } else if ($i == 3) {
                    $kolom3[] = $key->kolom_id;
                } else if ($i == 4) {
                    $kolom4[] = $key->kolom_id;
                }
                $hasil = $this->usermodel->getHasilKreplinByUser($start_dttm,$end_dttm,$user_id,$key->kolom_id,$i)->getResult();
                foreach ($hasil as $vhasil) {
                    
                    if ($i == 1) {
                        $jml_jawab1[] = $vhasil->jumlah_jawab;
                        $total_jawab1 = $total_jawab1 + $vhasil->jumlah_jawab;
                    } else if ($i == 2) {
                        $jml_jawab2[] = $vhasil->jumlah_jawab;
                        $total_jawab2 = $total_jawab2 + $vhasil->jumlah_jawab;
                    } else if ($i == 3) {
                        $jml_jawab3[] = $vhasil->jumlah_jawab;
                        $total_jawab3 = $total_jawab3 + $vhasil->jumlah_jawab;
                    } else if ($i == 4) {
                        $jml_jawab4[] = $vhasil->jumlah_jawab;
                        $total_jawab4 = $total_jawab4 + $vhasil->jumlah_jawab;
                    }
                    
                }
            }
        }

        $ttl_jwb_g1 = $total_jawab1 + $total_jawab3;
        $ttl_jwb_g2 = $total_jawab2 + $total_jawab4;
        $ttl_jawab = $ttl_jwb_g1 + $ttl_jwb_g2;
        $rata1 = round($ttl_jwb_g1 / 20);
        $rata2 = round($ttl_jwb_g2 / 20);
        $ttl_rata1 = $rata1 * 2;
        $ttl_rata2 = $rata2 * 3;
        $salah = $this->usermodel->getKreplinSalah($start_dttm,$end_dttm,$user_id)->getResult();
        if (count($salah)) {
            $jml_salah = $salah[0]->jumlah_salah;
        } 

        // echo json_encode($jml_jawab);exit;
        $data = [
            "jml_jawab1" => $jml_jawab1,
            "jml_jawab2" => $jml_jawab2,
            "jml_jawab3" => $jml_jawab3,
            "jml_jawab4" => $jml_jawab4,
            "kolom1" => $kolom1,
            "kolom2" => $kolom2,
            "kolom3" => $kolom3,
            "kolom4" => $kolom4,
            "jml_salah" => $jml_salah,
            "rata1" => $rata1,
            "rata2" => $rata2,
            "ttl_rata1" => $ttl_rata1,
            "ttl_rata2" => $ttl_rata2,
            "user" => $user,
            "ttl_jawab" => $ttl_jawab,
            "notest" => $notestpeserta
        ];

        return view('admin/hasilkreplin',$data);
    }

    public function hasilpauli() {
        $request = \Config\Services::request();
        $start_dttm = $request->uri->getSegment(4);
        $end_dttm = $request->uri->getSegment(5);
        $user_id = $request->uri->getSegment(6);

        $hasil = [];

        $user = $this->usermodel->getbyUserId($user_id)->getResult();
        $notest = $this->usermodel->getNotest($user_id, 9)->getResult();
        

        if (count($notest)>0) {
            $notestpeserta = $notest[0]->no_antrian;
        } else {
            $notestpeserta = 0;
        }
        
        $klm = $this->soalmodel->getKolomSoalPauli()->getResult();
        

        for ($i = 1; $i <= 4; $i++) {

            // 🔥 1 sk_group_id → 20 kolom
            $hasil[$i] = $this->usermodel
                ->getHasilPauliByUser(
                    $start_dttm,
                    $end_dttm,
                    $user_id,
                    $i // sk_group_id
                )
                ->getResult();
        }

        $data = [
            "user" => $user,
            "hasil" => $hasil,
            "notest" => $notestpeserta
        ];

        // echo json_encode($hasil); exit;
        
        return view('admin/hasil/pauli/hasilpauli',$data);
    }

    public function cetakhasilpauli() {
        $request = \Config\Services::request();
        $start_dttm = $request->uri->getSegment(4);
        $end_dttm = $request->uri->getSegment(5);
        $user_id = $request->uri->getSegment(6);

        $hasil = [];

        $user = $this->usermodel->getbyUserId($user_id)->getResult();
        $notest = $this->usermodel->getNotest($user_id, 9)->getResult();
        

        if (count($notest)>0) {
            $notestpeserta = $notest[0]->no_antrian;
        } else {
            $notestpeserta = 0;
        }
        
        $klm = $this->soalmodel->getKolomSoalPauli()->getResult();
        

        for ($i = 1; $i <= 4; $i++) {

            // 🔥 1 sk_group_id → 20 kolom
            $hasil[$i] = $this->usermodel
                ->getHasilPauliByUser(
                    $start_dttm,
                    $end_dttm,
                    $user_id,
                    $i // sk_group_id
                )
                ->getResult();
        }

        $data = [
            "user" => $user,
            "hasil" => $hasil,
            "notest" => $notestpeserta
        ];
        return view('admin/hasil/pauli/cetakhasilpauli',$data);
    }

    public function cetakhasilkreplin() {
        $request = \Config\Services::request();
        $start_dttm = $request->uri->getSegment(4);
        $end_dttm = $request->uri->getSegment(5);
        $user_id = $request->uri->getSegment(6);
        // echo json_encode($user_id);exit;
        $kolom1 = array();
        $kolom2 = array();
        $kolom3 = array();
        $kolom4 = array();
        $jml_jawab1 = array();
        $jml_jawab2 = array();
        $jml_jawab3 = array();
        $jml_jawab4 = array();
        $jml_salah = 0;
        $total_jawab1 = 0;
        $total_jawab2 = 0;
        $total_jawab3 = 0;
        $total_jawab4 = 0;
        $rata1 = 0;
        $rata2 = 0;

        $user = $this->usermodel->getbyUserId($user_id)->getResult();

        for ($i=1; $i <= 4; $i++) { 
            $klm = $this->soalmodel->getKolomSoal()->getResult();
            foreach ($klm as $key) {
                if ($i == 1) {
                    $kolom1[] = $key->kolom_id;
                } else if ($i == 2) {
                    $kolom2[] = $key->kolom_id;
                } else if ($i == 3) {
                    $kolom3[] = $key->kolom_id;
                } else if ($i == 4) {
                    $kolom4[] = $key->kolom_id;
                }
                $hasil = $this->usermodel->getHasilKreplinByUser($start_dttm,$end_dttm,$user_id,$key->kolom_id,$i)->getResult();
                foreach ($hasil as $vhasil) {
                    
                    if ($i == 1) {
                        $jml_jawab1[] = $vhasil->jumlah_jawab;
                        $total_jawab1 = $total_jawab1 + $vhasil->jumlah_jawab;
                    } else if ($i == 2) {
                        $jml_jawab2[] = $vhasil->jumlah_jawab;
                        $total_jawab2 = $total_jawab2 + $vhasil->jumlah_jawab;
                    } else if ($i == 3) {
                        $jml_jawab3[] = $vhasil->jumlah_jawab;
                        $total_jawab3 = $total_jawab3 + $vhasil->jumlah_jawab;
                    } else if ($i == 4) {
                        $jml_jawab4[] = $vhasil->jumlah_jawab;
                        $total_jawab4 = $total_jawab4 + $vhasil->jumlah_jawab;
                    }
                    
                }
            }
        }
        $ttl_jwb_g1 = $total_jawab1 + $total_jawab3;
        $ttl_jwb_g2 = $total_jawab2 + $total_jawab4;
        $ttl_jawab = $ttl_jwb_g1 + $ttl_jwb_g2;
        $rata1 = $ttl_jwb_g1 / 20;
        $rata2 = $ttl_jwb_g2 / 20;
        $salah = $this->usermodel->getKreplinSalah($start_dttm,$end_dttm,$user_id)->getResult();
        if (count($salah)) {
            $jml_salah = $salah[0]->jumlah_salah;
        } 

        // echo json_encode($jml_jawab);exit;
        $data = [
            "jml_jawab1" => $jml_jawab1,
            "jml_jawab2" => $jml_jawab2,
            "jml_jawab3" => $jml_jawab3,
            "jml_jawab4" => $jml_jawab4,
            "kolom1" => $kolom1,
            "kolom2" => $kolom2,
            "kolom3" => $kolom3,
            "kolom4" => $kolom4,
            "jml_salah" => $jml_salah,
            "rata1" => round($rata1) * 2,
            "rata2" => round($rata2) * 3,
            "user" => $user,
            "ttl_jawab" => $ttl_jawab
        ];
        return view('admin/cetakhasilkreplin',$data);
    }

    public function hasilkreplinpdf() {
        $request = \Config\Services::request();
        $start_dttm = $request->uri->getSegment(4);
        $end_dttm = $request->uri->getSegment(5);
        $user_id = $request->uri->getSegment(6);
        // echo json_encode($user_id);exit;
        $kolom1 = array();
        $kolom2 = array();
        $kolom3 = array();
        $kolom4 = array();
        $jml_jawab1 = array();
        $jml_jawab2 = array();
        $jml_jawab3 = array();
        $jml_jawab4 = array();
        $jml_salah = 0;
        $total_jawab1 = 0;
        $total_jawab2 = 0;
        $total_jawab3 = 0;
        $total_jawab4 = 0;
        $rata1 = 0;
        $rata2 = 0;

        $user = $this->usermodel->getbyUserId($user_id)->getResult();

        for ($i=1; $i <= 4; $i++) { 
            $klm = $this->soalmodel->getKolomSoal()->getResult();
            foreach ($klm as $key) {
                if ($i == 1) {
                    $kolom1[] = $key->kolom_id;
                } else if ($i == 2) {
                    $kolom2[] = $key->kolom_id;
                } else if ($i == 3) {
                    $kolom3[] = $key->kolom_id;
                } else if ($i == 4) {
                    $kolom4[] = $key->kolom_id;
                }
                $hasil = $this->usermodel->getHasilKreplinByUser($start_dttm,$end_dttm,$user_id,$key->kolom_id,$i)->getResult();
                foreach ($hasil as $vhasil) {
                    
                    if ($i == 1) {
                        $jml_jawab1[] = $vhasil->jumlah_jawab;
                        $total_jawab1 = $total_jawab1 + $vhasil->jumlah_jawab;
                    } else if ($i == 2) {
                        $jml_jawab2[] = $vhasil->jumlah_jawab;
                        $total_jawab2 = $total_jawab2 + $vhasil->jumlah_jawab;
                    } else if ($i == 3) {
                        $jml_jawab3[] = $vhasil->jumlah_jawab;
                        $total_jawab3 = $total_jawab3 + $vhasil->jumlah_jawab;
                    } else if ($i == 4) {
                        $jml_jawab4[] = $vhasil->jumlah_jawab;
                        $total_jawab4 = $total_jawab4 + $vhasil->jumlah_jawab;
                    }
                    
                }
            }
        }
        $ttl_jwb_g1 = $total_jawab1 + $total_jawab3;
        $ttl_jwb_g2 = $total_jawab2 + $total_jawab4;
        $ttl_jawab = $ttl_jwb_g1 + $ttl_jwb_g2;
        $rata1 = $ttl_jwb_g1 / 20;
        $rata2 = $ttl_jwb_g2 / 20;
        $rata1 = round($rata1) * 2;
        $rata2 = round($rata2) * 3;
        $salah = $this->usermodel->getKreplinSalah($start_dttm,$end_dttm,$user_id)->getResult();
        if (count($salah)) {
            $jml_salah = $salah[0]->jumlah_salah;
        } 

            $data = [
                "jml_jawab1" => $jml_jawab1,
                "jml_jawab2" => $jml_jawab2,
                "jml_jawab3" => $jml_jawab3,
                "jml_jawab4" => $jml_jawab4,
                "kolom1" => $kolom1,
                "kolom2" => $kolom2,
                "kolom3" => $kolom3,
                "kolom4" => $kolom4,
                "jml_salah" => $jml_salah,
                "rata1" => round($rata1) * 2,
                "rata2" => round($rata2) * 3,
                "user" => $user,
                "ttl_jawab" => $ttl_jawab
            ];
            // return view('admin/hasilkreplinpdf',$data);

            $html = view('admin/hasilkreplinpdf',$data);

            $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Bagian Psikologi Polda Sumsel');
            $pdf->SetTitle('Hasil Tes');
            $pdf->SetSubject('Hasil Tes');
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->addPage();

            // output the HTML content
            $js = '
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
            let ctx = 
                document.getElementById(\"myLineChart1\").getContext(\"2d\");
            let myLineChart = new Chart(ctx, {
                type: \"line\",
                data: {
                    labels: labels1,
                    datasets: [
                        {
                            label: \"Jumlah Jawab\",
                            data: dataset1Data,
                            borderColor: \"blue\",
                            borderWidth: 2,
                            fill: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: \"Group 1\",
                                font: {
                                    padding: 4,
                                    size: 20,
                                    weight: \"bold\",
                                    family: \"Arial\"
                                },
                                color: \"darkblue\"
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: \"Jumlah Soal\",
                                font: {
                                    size: 12,
                                    weight: \"bold\",
                                    family: \"Arial\"
                                },
                                color: \"darkblue\"
                            },
                            beginAtZero: true,
                            min: 0,
                            max: 60,
                            scaleLabel: {
                                display: true,
                                labelString: \"Values\",
                            },
                        }
                    }
                }
            });';
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->IncludeJS($js);
            //line ini penting
            // $this->response->setContentType('application/pdf');
            //Close and output PDF document
            $pdf->Output('invoice.pdf', 'I');
            exit(0);

    }

    public function hasiltiu5pdf() {
        $request = \Config\Services::request();
        $user_id = $request->uri->getSegment(4);
        $tipesoal = $request->uri->getSegment(5);
        $benar = 0;
        $salah = 0;
        $user = $this->usermodel->getbyUserId($user_id)->getResult();
        $sekarang = new \DateTime("today");
        $tanggal_lahir = new \DateTime($user[0]->birth_dttm);
            if ($tanggal_lahir > $sekarang) { 
                $thn_lahir = "0";
            }
                $thn_lahir = $sekarang->diff($tanggal_lahir)->y;

        $tanggal_pemeriksaan = $this->hasilmodel->getTanggalTesTiu5($user_id, 5, $tipesoal)->getResult();
        $res = $this->hasilmodel->getHasilTiu5($user_id, 5, $tipesoal)->getResult();
        if (count($res)>0) {
            foreach ($res as $key) {
                if ($key->pilihan_nm == $key->kunci) {
                    $benar = $benar + 1;
                } else {
                    $salah = $salah + 1;
                }
                
            }
        }
        
        $ret = "<h2 style=\"text-align:center;\">TIU 5</h2>
                <hr>
                <div>
                <table border=\"0\">
                    <tbody>
                        <tr>
                            <td class=\"text-left text-bold\" width=\"150\">Nama</td>
                            <td class=\"text-center\" width=\"10\">:</td>
                            <td class=\"text-left\">". $user[0]->person_nm ."</td>
                        </tr>
                        <tr>
                            <td class=\"text-left text-bold\" width=\"150\">Pangkat/NRP</td>
                            <td class=\"text-center\" width=\"10\">:</td>
                            <td class=\"text-left\">". $user[0]->pangkat ." / ". $user[0]->nrp ."</td>
                        </tr>
                        <tr>
                            <td class=\"text-left text-bold\" width=\"150\">Kesatuan</td>
                            <td class=\"text-center\" width=\"10\">:</td>
                            <td class=\"text-left\">". $user[0]->satuan_nm ."</td>
                        </tr>
                    </tbody>
                </table>
                        <table border=\"0\">
                            <tbody>
                                <tr>
                                    <td class=\"text-left text-bold\" width=\"150\">Jenis Kelamin/Usia</td>
                                    <td class=\"text-center\" width=\"10\">:</td>
                                    <td class=\"text-left\">". ($user[0]->gender_cd=='m'?'Laki-laki':'Perempuan') ." / ". $thn_lahir ."</td>
                                </tr>
                                <tr>
                                    <td class=\"text-left text-bold\" width=\"150\">Tanggal Pemeriksaan</td>
                                    <td class=\"text-center\" width=\"10\">:</td>
                                    <td class=\"text-center\">". date('d-m-Y',strtotime($tanggal_pemeriksaan[0]->created_dttm)) ."</td>
                                </tr>
                                <tr>
                                    <td class=\"text-left text-bold\" width=\"150\">Pendidikan</td>
                                    <td class=\"text-center\" width=\"10\">:</td>
                                    <td class=\"text-left\">". $user[0]->pendidikan_nm ."</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <hr/>
                <div class=\"table-responsive\">
                        <table border=\"1\">
                        <thead>
                            <tr>
                                <th style=\"text-align:center;\" width=\"40%\"></th>
                                <th style=\"text-align:center;background-color:#28a745;\" width=\"20%\">Benar</th>
                                <th style=\"text-align:center;background-color:#dc3545;\" width=\"20%\">Salah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style=\"padding-left:10px;justify-content:center;align-item:center;vertical-align: middle;background-color:#65aaf4;font-size: 18px;\" width=\"40%\"> Tipe ".$request->uri->getSegment(5)."</td>
                                <td style=\"font-size: 20px;text-align:center;\" width=\"20%\">". $benar ."</td>
                                <td style=\"font-size: 20px;text-align:center;\" width=\"20%\">". $salah ."</td>
                            </tr>
                        </tbody>
                    </table>
                </div>";
            

        
            // $html = view('admin/hasildass',$data);
        $html = view('admin/hasiltiu5pdf',[
			'ret'=> $ret
		]);

        $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Bagian Psikologi Polda Sumsel');
		$pdf->SetTitle('Hasil Tes Tiu5');
		$pdf->SetSubject('Hasil Tes Tiu5');
        $pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
        $pdf->addPage();

        // output the HTML content
        // $pdf->IncludeJS($js);
		$pdf->writeHTML($html, true, false, true, false, '');
		//line ini penting
		$this->response->setContentType('application/pdf');
		//Close and output PDF document
		$pdf->Output('HasilTiu5.pdf', 'I');
    }

    public function hasildasspdf() {
        $request = \Config\Services::request();
        $user_id = $request->uri->getSegment(4);
        $user = $this->usermodel->getbyUserId($user_id)->getResult();
        $sekarang = new \DateTime("today");
        $tanggal_lahir = new \DateTime($user[0]->birth_dttm);
            if ($tanggal_lahir > $sekarang) { 
                $thn_lahir = "0";
            }
                $thn_lahir = $sekarang->diff($tanggal_lahir)->y;



        $tanggal_pemeriksaan = $this->usermodel->getTanggalTes($user_id,4)->getResult();
        $depression = $this->usermodel->getDepression($user_id,4,5)->getResult();
        $anxiety = $this->usermodel->getAnxiety($user_id,4,6)->getResult();
        $stress = $this->usermodel->getStess($user_id,4,7)->getResult();
        
        $ret = "<h2 style=\"text-align:center;\">DASS-42</h2>
                <hr>
                <div>
                <table border=\"0\">
                    <tbody>
                        <tr>
                            <td class=\"text-left text-bold\" width=\"150\">Nama</td>
                            <td class=\"text-center\" width=\"10\">:</td>
                            <td class=\"text-left\">". $user[0]->person_nm ."</td>
                        </tr>
                        <tr>
                            <td class=\"text-left text-bold\" width=\"150\">Pangkat/NRP</td>
                            <td class=\"text-center\" width=\"10\">:</td>
                            <td class=\"text-left\">". $user[0]->pangkat ." / ". $user[0]->nrp ."</td>
                        </tr>
                        <tr>
                            <td class=\"text-left text-bold\" width=\"150\">Kesatuan</td>
                            <td class=\"text-center\" width=\"10\">:</td>
                            <td class=\"text-left\">". $user[0]->satuan_nm ."</td>
                        </tr>
                    </tbody>
                </table>
                        <table border=\"0\">
                            <tbody>
                                <tr>
                                    <td class=\"text-left text-bold\" width=\"150\">Jenis Kelamin/Usia</td>
                                    <td class=\"text-center\" width=\"10\">:</td>
                                    <td class=\"text-left\">". ($user[0]->gender_cd=='m'?'Laki-laki':'Perempuan') ." / ". $thn_lahir ."</td>
                                </tr>
                                <tr>
                                    <td class=\"text-left text-bold\" width=\"150\">Tanggal Pemeriksaan</td>
                                    <td class=\"text-center\" width=\"10\">:</td>
                                    <td class=\"text-center\">". date('d-m-Y',strtotime($tanggal_pemeriksaan[0]->created_dttm)) ."</td>
                                </tr>
                                <tr>
                                    <td class=\"text-left text-bold\" width=\"150\">Pendidikan</td>
                                    <td class=\"text-center\" width=\"10\">:</td>
                                    <td class=\"text-left\">". $user[0]->pendidikan_nm ."</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <hr/>
                <div class=\"table-responsive\">
                        <table border=\"1\">
                        <thead>
                            <tr>
                                <th style=\"text-align:center;\" width=\"40%\"></th>
                                <th style=\"text-align:center;background-color:#65aaf4;\" width=\"20%\">Depression</th>
                                <th style=\"text-align:center;background-color:#65aaf4;\" width=\"20%\">Anxiety</th>
                                <th style=\"text-align:center;background-color:#65aaf4;\" width=\"20%\">Stress</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style=\"padding-left:10px;justify-content:center;align-item:center;vertical-align: middle;background-color:#65aaf4;\" width=\"40%\"> Normal</td>
                                <td style=\"font-size: 20px;text-align:center;\" width=\"20%\">". ($depression[0]->jumlah_d <= 9? $depression[0]->jumlah_d:'') ."</td>
                                <td style=\"font-size: 20px;text-align:center;\" width=\"20%\">". ($anxiety[0]->jumlah_a <= 7? $anxiety[0]->jumlah_a:'') ."</td>
                                <td style=\"font-size: 20px;text-align:center;\" width=\"20%\">". ($stress[0]->jumlah_s <= 14? $stress[0]->jumlah_s:'') ."</td>
                            </tr>
                            <tr>
                                <td style=\"padding-left:10px;background-color:#65aaf4;\"> Mild</td>
                                <td style=\"font-size: 20px;text-align:center;\">". ($depression[0]->jumlah_d >= 10 && $depression[0]->jumlah_d <= 13 ? $depression[0]->jumlah_d:'') ."</td>
                                <td style=\"font-size: 20px;text-align:center;\">". ($anxiety[0]->jumlah_a >= 8 && $anxiety[0]->jumlah_a <= 9? $anxiety[0]->jumlah_a:'') ."</td>
                                <td style=\"font-size: 20px;text-align:center;\">". ($stress[0]->jumlah_s >= 15 && $stress[0]->jumlah_s <= 18? $stress[0]->jumlah_s:'') ."</td>
                            </tr> 
                            <tr>
                                <td style=\"padding-left:10px;background-color:#65aaf4;\"> Moderate</td>
                                <td style=\"font-size: 20px;text-align:center;\">". ($depression[0]->jumlah_d >= 14 && $depression[0]->jumlah_d <= 20 ? $depression[0]->jumlah_d:'') ."</td>
                                <td style=\"font-size: 20px;text-align:center;\">". ($anxiety[0]->jumlah_a >= 10 && $anxiety[0]->jumlah_a <= 14? $anxiety[0]->jumlah_a:'') ."</td>
                                <td style=\"font-size: 20px;text-align:center;\">". ($stress[0]->jumlah_s >= 19 && $stress[0]->jumlah_s <= 25? $stress[0]->jumlah_s:'') ."</td>
                            </tr>
                            <tr>
                                <td style=\"padding-left:10px;background-color:#65aaf4;\"> Severe</td>
                                <td style=\"font-size: 20px;text-align:center;\">". ($depression[0]->jumlah_d >= 21 && $depression[0]->jumlah_d <= 27 ? $depression[0]->jumlah_d:'') ."</td>
                                <td style=\"font-size: 20px;text-align:center;\">". ($anxiety[0]->jumlah_a >= 15 && $anxiety[0]->jumlah_a <= 19? $anxiety[0]->jumlah_a:'') ."</td>
                                <td style=\"font-size: 20px;text-align:center;\">". ($stress[0]->jumlah_s >= 26 && $stress[0]->jumlah_s <= 33? $stress[0]->jumlah_s:'') ."</td>
                            </tr>
                            <tr>
                                <td style=\"padding-left:10px;background-color:#65aaf4;\"> Extremely Severe</td>
                                <td style=\"font-size: 20px;text-align:center;\">". ($depression[0]->jumlah_d >= 28 ? $depression[0]->jumlah_d:'') ."</td>
                                <td style=\"font-size: 20px;text-align:center;\">". ($anxiety[0]->jumlah_a >= 20 ? $anxiety[0]->jumlah_a:'') ."</td>
                                <td style=\"font-size: 20px;text-align:center;\">". ($stress[0]->jumlah_s >= 34 ? $stress[0]->jumlah_s:'') ."</td>
                            </tr>
                        </tbody>
                    </table>
                </div>";
            

        
            // $html = view('admin/hasildass',$data);
        $html = view('admin/hasildasspdf',[
			'ret'=> $ret
		]);

        $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Bagian Psikologi Polda Sumsel');
		$pdf->SetTitle('Hasil Tes');
		$pdf->SetSubject('Hasil Tes');
        $pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
        $pdf->addPage();

        // output the HTML content
        // $pdf->IncludeJS($js);
		$pdf->writeHTML($html, true, false, true, false, '');
		//line ini penting
		$this->response->setContentType('application/pdf');
		//Close and output PDF document
		$pdf->Output('invoice.pdf', 'I');
    }

    public function hasilbdipdf() {
        $request = \Config\Services::request();
        $user_id = $request->uri->getSegment(4);
        $user = $this->usermodel->getbyUserId($user_id)->getResult();
        $sekarang = new \DateTime("today");
        $tanggal_lahir = new \DateTime($user[0]->birth_dttm);
            if ($tanggal_lahir > $sekarang) { 
                $thn_lahir = "0";
            }
                $thn_lahir = $sekarang->diff($tanggal_lahir)->y;



        $tanggal_pemeriksaan = $this->usermodel->getTanggalTes($user_id,8)->getResult();

        $notestpeserta = 0;
        
        $notest = $this->usermodel->getNotest($user_id, 8)->getResult();
        if (count($notest)>0) {
            $notestpeserta = $notest[0]->no_antrian;
        } else {
            $notestpeserta = 0;
        }

        $total = 0;
        $kategori = "";

        $res = $this->usermodel->getHasilDbiByUserId($user_id, 8)->getResult();
        if (count($res) > 0) {
            $total = $res[0]->jumlah;

            if ($total >= 1 && $total <= 10) {
                $kategori = "Normal";
            } elseif ($total >= 11 && $total <= 16) {
                $kategori = "Moderat";
            } elseif ($total >= 17 && $total <= 20) {
                $kategori = "Garis Batas";
            } elseif ($total >= 21 && $total <= 30) {
                $kategori = "Depresi Sedang";
            } elseif ($total >= 31 && $total <= 40) {
                $kategori = "Depresi Parah";
            } elseif ($total > 40) {
                $kategori = "Depresi Ekstrim";
            } else {
                $kategori = "Tidak Diketahui";
            }
        }
        
        $data = [
            "user" => $user,
            "tanggal_pemeriksaan" => $tanggal_pemeriksaan,
            "thn_lahir" => $thn_lahir,
            "notest" => $notestpeserta,
            "total" => $total,
            "kategori" => $kategori
        ];
            

        
            // $html = view('admin/hasildass',$data);
        $html = view('admin/dbi/hasildbipdf', $data);

        $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Bagian Psikologi Polda Sumsel');
		$pdf->SetTitle('Hasil Tes');
		$pdf->SetSubject('Hasil Tes');
        $pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
        $pdf->addPage();

        // output the HTML content
        // $pdf->IncludeJS($js);
		$pdf->writeHTML($html, true, false, true, false, '');
		//line ini penting
		$this->response->setContentType('application/pdf');
		//Close and output PDF document
		$pdf->Output('invoice.pdf', 'I');
    }

    public function hasilexcel() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $sekarang = new \DateTime("today");
        $start_dttm = $this->request->getUri()->getSegment(4);
        $end_dttm = $this->request->getUri()->getSegment(5);
        $group_id = $this->request->getUri()->getSegment(6);
        $materi_id = $this->request->getUri()->getSegment(7);
        $res = $this->soalmodel->getHasil($start_dttm, $end_dttm, $group_id)->getResult();
        $getsoal = $this->soalmodel->getSoalBygrmt($group_id, $materi_id)->getResult();
        $resGroup = $this->soalmodel->getGroupByid($group_id)->getResult();
        $fileName = $start_dttm."_laporan_".$resGroup[0]->group_nm.".xlsx"; 
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->setActiveSheetIndex(0);
        $columnsoal = "F";
        $sheet->getStyle('A:DG')->getAlignment()->setHorizontal('center');
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->setCellValue("A" . "1", "No.");
        $sheet->setCellValue("B" . "1", "No. Test");
        $sheet->setCellValue("C" . "1", "Nama");
        $sheet->setCellValue("D" . "1", "Tahun Lahir");
        $sheet->setCellValue("E" . "1", "Jenis Kelamin");

        
        foreach ($getsoal as $key) {
            $sheet->getColumnDimension($columnsoal)->setAutoSize(true);
            $sheet->setCellValue($columnsoal . "1", $key->no_soal);
            $columnsoal++;
        }
        $sheetData = $spreadsheet->setActiveSheetIndex(0);
        $column = 2;
        $columnpil = 2;
        $no = 1;
        
        foreach ($res as $val) {
            $tanggal_lahir = new \DateTime($val->tanggal_lahir);
            if ($val->gender_cd == "m") {
                $sex = "L";
            } else {
                $sex = "P";
            }
            if ($tanggal_lahir > $sekarang) { 
                $thn = "0";
            }
                $thn = date("Y",strtotime($val->tanggal_lahir));

			$sheetData->setCellValue("A" . $column, $no);
			$sheetData->setCellValue("B" . $column, $val->no_antrian);
			$sheetData->setCellValue("C" . $column, $val->person_nm);
			$sheetData->setCellValue("D" . $column, $thn);
			$sheetData->setCellValue("E" . $column, $sex);
            $column++;
            $res_respon = $this->soalmodel->getResponByUser($start_dttm,$end_dttm,$val->user_id,$group_id,$materi_id)->getResult();
            // echo json_encode($res_respon);exit;
            $columnpilihan = "F";
            foreach ($res_respon as $keys) {
                $sheetData->setCellValue($columnpilihan . $columnpil, $keys->pilihan_nm);
                $columnpilihan++;
            }
            
            $columnpil++;
            $no++;
		}

		$writer = new Xlsx($spreadsheet);
		$filepath = "filehasil/materi_a/".$fileName;
		$writer->save($filepath);
 
		header("Content-Type: application/vnd.ms-excel");
		header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filepath));
		flush();
		readfile($filepath);
		exit;
    }

    public function hasilexcel2() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $sekarang = new \DateTime("today");
        $start_dttm = $this->request->getUri()->getSegment(4);
        $end_dttm = $this->request->getUri()->getSegment(5);
        $group_id = $this->request->getUri()->getSegment(6);
        $res = $this->soalmodel->getHasil($start_dttm,$end_dttm,$group_id)->getResult();
        $getsoal = $this->soalmodel->getSoalBygrmt($group_id,1)->getResult();
        $resGroup = $this->soalmodel->getGroupByid($group_id)->getResult();
        $fileName = $start_dttm."_laporan_".$resGroup[0]->group_nm.".xlsx"; 
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->setActiveSheetIndex(0);
        $columnsoal = "F";
        $sheet->getStyle('A:DG')->getAlignment()->setHorizontal('center');
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->setCellValue("A" . "1", "No.");
        $sheet->setCellValue("B" . "1", "No. Test");
        $sheet->setCellValue("C" . "1", "Nama");
        $sheet->setCellValue("D" . "1", "Umur");
        $sheet->setCellValue("E" . "1", "Jenis Kelamin");

        
        foreach ($getsoal as $key) {
            $sheet->getColumnDimension($columnsoal)->setAutoSize(true);
            $sheet->setCellValue($columnsoal . "1", $key->no_soal);
            $columnsoal++;
        }
        $sheetData = $spreadsheet->setActiveSheetIndex(0);
        $column = 2;
        $columnpil = 2;
        $no = 1;
        
        foreach ($res as $val) {
            $tanggal_lahir = new \DateTime($val->tanggal_lahir);
            if ($val->gender_cd == "m") {
                $sex = "L";
            } else {
                $sex = "P";
            }
            if ($tanggal_lahir > $sekarang) { 
                $thn = "0";
            }
                $thn = $sekarang->diff($tanggal_lahir)->y;

			$sheetData->setCellValue("A" . $column, $no);
			$sheetData->setCellValue("B" . $column, $val->no_antrian);
			$sheetData->setCellValue("C" . $column, $val->person_nm);
			$sheetData->setCellValue("D" . $column, $thn);
			$sheetData->setCellValue("E" . $column, $sex);
            $column++;
            $res_respon = $this->soalmodel->getResponByUser($start_dttm,$end_dttm,$val->user_id,$group_id,1)->getResult();
            // echo json_encode($res_respon);exit;
            $columnpilihan = "F";
            foreach ($res_respon as $keys) {
                $sheetData->setCellValue($columnpilihan . $columnpil, $keys->pilihan_nm);
                $columnpilihan++;
            }
            
            $columnpil++;
            $no++;
		}

		$writer = new Xlsx($spreadsheet);
		$filepath = "filehasil/materi_b/".$fileName;
		$writer->save($filepath);
 
		header("Content-Type: application/vnd.ms-excel");
		header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filepath));
		flush();
		readfile($filepath);
		exit;
    }

    public function hasilexcelpapi() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $sekarang = new \DateTime("today");
        $start_dttm = $this->request->getUri()->getSegment(4);
        $end_dttm = $this->request->getUri()->getSegment(5);
        $group_id = $this->request->getUri()->getSegment(6);
        $res = $this->soalmodel->getHasil($start_dttm,$end_dttm,$group_id)->getResult();
        $getsoal = $this->soalmodel->getSoalBygrmt($group_id,8)->getResult();
        $resGroup = $this->soalmodel->getGroupByid($group_id)->getResult();
        $fileName = $start_dttm."_laporan_".$resGroup[0]->group_nm.".xlsx"; 
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->setActiveSheetIndex(0);
        $columnsoal = "F";
        $sheet->getStyle('A:DG')->getAlignment()->setHorizontal('center');
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->setCellValue("A" . "1", "No.");
        $sheet->setCellValue("B" . "1", "No. Test");
        $sheet->setCellValue("C" . "1", "Nama");
        $sheet->setCellValue("D" . "1", "Tahun Lahir");
        $sheet->setCellValue("E" . "1", "Jenis Kelamin");

        
        foreach ($getsoal as $key) {
            $sheet->getColumnDimension($columnsoal)->setAutoSize(true);
            $sheet->setCellValue($columnsoal . "1", $key->no_soal);
            $columnsoal++;
        }
        $sheetData = $spreadsheet->setActiveSheetIndex(0);
        $column = 2;
        $columnpil = 2;
        $no = 1;
        
        foreach ($res as $val) {
            $tanggal_lahir = new \DateTime($val->tanggal_lahir);
            if ($val->gender_cd == "m") {
                $sex = "L";
            } else {
                $sex = "P";
            }
            if ($tanggal_lahir > $sekarang) { 
                $thn = "0";
            }
                $thn = date("Y",strtotime($val->tanggal_lahir));

			$sheetData->setCellValue("A" . $column, $no);
			$sheetData->setCellValue("B" . $column, $val->no_antrian);
			$sheetData->setCellValue("C" . $column, $val->person_nm);
			$sheetData->setCellValue("D" . $column, $thn);
			$sheetData->setCellValue("E" . $column, $sex);
            $column++;
            $res_respon = $this->soalmodel->getResponByUser($start_dttm,$end_dttm,$val->user_id,$group_id,8)->getResult();
            // echo json_encode($res_respon);exit;
            $columnpilihan = "F";
            foreach ($res_respon as $keys) {
                $sheetData->setCellValue($columnpilihan . $columnpil, $keys->pilihan_nm);
                $columnpilihan++;
            }
            
            $columnpil++;
            $no++;
		}

		$writer = new Xlsx($spreadsheet);
		$filepath = "filehasil/materi_f/".$fileName;
		$writer->save($filepath);
 
		header("Content-Type: application/vnd.ms-excel");
		header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filepath));
		flush();
		readfile($filepath);
		exit;
    }

    public function hasilexcelmaterig() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $sekarang = new \DateTime("today");
        $start_dttm = $this->request->getUri()->getSegment(4);
        $end_dttm = $this->request->getUri()->getSegment(5);
        $group_id = $this->request->getUri()->getSegment(6);
        $materi_id = $this->request->getUri()->getSegment(7);
        $res = $this->soalmodel->getHasil($start_dttm, $end_dttm, $group_id)->getResult();
        $getsoal = $this->soalmodel->getSoalBygrmt($group_id, $materi_id)->getResult();
        $resGroup = $this->soalmodel->getGroupByid($group_id)->getResult();
        $fileName = $start_dttm."_laporan_".$resGroup[0]->group_nm.".xlsx"; 
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->setActiveSheetIndex(0);
        $columnsoal = "G";
        $sheet->getStyle('A:DG')->getAlignment()->setHorizontal('center');
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->setCellValue("A" . "1", "No.");
        $sheet->setCellValue("B" . "1", "No. Test");
        $sheet->setCellValue("C" . "1", "Nama");
        $sheet->setCellValue("D" . "1", "Pangkat");
        $sheet->setCellValue("E" . "1", "NRP");
        $sheet->setCellValue("F" . "1", "Satker");

        
        foreach ($getsoal as $key) {
            $sheet->getColumnDimension($columnsoal)->setAutoSize(true);
            $sheet->setCellValue($columnsoal . "1", $key->no_soal);
            $columnsoal++;
        }
        $sheetData = $spreadsheet->setActiveSheetIndex(0);
        $column = 2;
        $columnpil = 2;
        $no = 1;
        
        foreach ($res as $val) {

			$sheetData->setCellValue("A" . $column, $no);
			$sheetData->setCellValue("B" . $column, $val->no_antrian);
			$sheetData->setCellValue("C" . $column, $val->person_nm);
			$sheetData->setCellValue("D" . $column, $val->pangkat);
			$sheetData->setCellValue("E" . $column, $val->nrp);
			$sheetData->setCellValue("F" . $column, $val->satker);
            $column++;
            $res_respon = $this->soalmodel->getResponByUser($start_dttm,$end_dttm,$val->user_id,$group_id,$materi_id)->getResult();
            // echo json_encode($res_respon);exit;
            $columnpilihan = "G";
            foreach ($res_respon as $keys) {
                $sheetData->setCellValue($columnpilihan . $columnpil, $keys->pilihan_nm);
                $columnpilihan++;
            }
            
            $columnpil++;
            $no++;
		}

		$writer = new Xlsx($spreadsheet);
		$filepath = "filehasil/materi_g/".$fileName;
		$writer->save($filepath);
 
		header("Content-Type: application/vnd.ms-excel");
		header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filepath));
		flush();
		readfile($filepath);
		exit;
    }
}