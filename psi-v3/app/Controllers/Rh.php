<?php
namespace App\Controllers;
use App\Models\Riwayathidupmodel;
use App\Models\Soalmodel;
class Rh extends BaseController
{
    protected $riwayathidupmodel;
    protected $soalmodel;
    protected $session;
    public function __construct()
	{
		$this->session = \Config\Services::session();
        $this->riwayathidupmodel = new Riwayathidupmodel();
        $this->soalmodel = new Soalmodel();
	}


    public function index()
    {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        
        $data = [
            'pengajuan' => $this->riwayathidupmodel->getJenisPengajuan()->getResult(),
            'NoTest' => $this->riwayathidupmodel->getNotest($this->session->user_id)->getResult(),
            'agama' => $this->riwayathidupmodel->getAgama()->getResult(),
            'merried' => $this->riwayathidupmodel->getStatusPernikahan()->getResult(),
            'jenjang' => $this->riwayathidupmodel->getJenjangPendidikan()->getResult(),
            'riwayathidup' => $this->riwayathidupmodel->getRiwayatHidupByUserId($this->session->user_id)->getResult(),
            'no_soal' => $this->riwayathidupmodel->getPertanyaanInventori()->getResult()
        ];
        
        return view('front/rh/index',$data);
        
    }

    public function simpanjawaban() {
        $jawaban = $this->request->getPost('jawaban');
        foreach ($jawaban as $pertanyaan_id => $isi) {
            

            $res = $this->riwayathidupmodel->getJawabanInventori($pertanyaan_id, $this->session->person_id)->getResult();
            if (count($res)>0) {
                $data = [
                    'jawaban' => $isi
                ];
                $simpan = $this->riwayathidupmodel->updatejawaban($pertanyaan_id, $this->session->person_id, $data);
            } else {
                $data = [
                    'inventori_pertanyaan_id' => $pertanyaan_id,
                    'jawaban' => $isi,
                    'person_id' => $this->session->person_id
                ];
                $simpan = $this->riwayathidupmodel->simpanjawaban($data);
            }
        }
        if ($simpan) {
            echo json_encode('success');
        } else {
            echo json_encode('gagal');
        }
    }

    public function simpantandatangan()
    {
        $riwayat_hidup_id = $this->request->getPost('riwayat_hidup_id');
        $person_id = $this->request->getPost('person_id');
        $tempat_ttd = $this->request->getPost('tempat_ttd');
        // $tanggal_ttd = $this->request->getPost('tanggal_ttd');
        $dataURL = $this->request->getPost('foto');
        $hari 			= $this->request->getPost("hari_tanda_tangan");
        $bulan 			= $this->request->getPost("bulan_tanda_tangan");
        $tahun 			= $this->request->getPost("tahun_tanda_tangan");
        $tanggal_ttd		= $tahun."-".$bulan."-".$hari;

        $person = $this->riwayathidupmodel->getByPersonId($person_id)->getResult();
        
        $parts = explode(',', $dataURL);
        $base64 = end($parts);
        $binary = base64_decode($base64);
        
        // Simpan ke file (opsional)
        $namaFile = 'ttd_' . $person_id. '_' . $person[0]->person_nm . '_' . date('Ymd') . '.png';
        $folderPath = FCPATH . 'images/ttd/';
        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        $filePath = $folderPath . $namaFile;
        file_put_contents($filePath, $binary);

        $data = [
            'person_id' => $person_id,
            'nama_file' => $namaFile,
            'lokasi_file'    => $filePath,
            'tempat_ttd' => $tempat_ttd,
            'tanggal_ttd' => $tanggal_ttd
        ];
        
        $simpan = $this->riwayathidupmodel->updateriwayathidup($riwayat_hidup_id, $data);
        if ($simpan) {
            echo json_encode("sukses");
        } else {
            echo json_encode("gagal");
        }
    }

    public function InsertNoTest() {
        $notest = $this->request->getPost('notest');
        $group_id = $this->request->getPost('group_id');

        $dataexam = [
            "group_id" => $group_id,
            "materi_id" => 1,
            "user_id" => $this->session->user_id,
            "no_antrian" => $notest,
        ];

        $res_user_exam = $this->riwayathidupmodel->getUserExam($this->session->user_id, $group_id)->getResult();

        if (count($res_user_exam)>0) {
            $insertexam = $this->riwayathidupmodel->updateexam($res_user_exam[0]->user_exam, $dataexam);
        } else {
            $insertexam = $this->riwayathidupmodel->insertexam($dataexam);
        }
        
        if ($insertexam) {
            $ret = "sukses"; 
        } else {
            $ret = "gagal";
        }
        echo json_encode($ret);
    }
    
    public function loadExistingIdentitas() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        
        $riwayathidup = $this->riwayathidupmodel->getRiwayatHidupByUserId($this->session->user_id)->getResult();
        echo json_encode($riwayathidup);
    }

    public function getDataKeluarga() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $person_id = $this->request->getPost('person_id');
        $keluarga = $this->riwayathidupmodel->getDataKeluargaByPersonId($person_id)->getResult();
        echo json_encode($keluarga);
    }

    public function getDataPendidikanFormal() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $person_id = $this->request->getPost('person_id');
        $formal = $this->riwayathidupmodel->getDataPendidikanFormalByPersonId($person_id)->getResult();
        echo json_encode($formal);
    }

    public function getDataPendidikanFormalById() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $riwayat_pendidikan_formal_id = $this->request->getPost('riwayat_pendidikan_formal_id');
        $keluarga = $this->riwayathidupmodel->getDataPendidikanFormalById($riwayat_pendidikan_formal_id)->getResult();
        echo json_encode($keluarga);
    }

    public function getDataPendidikanPolri() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $person_id = $this->request->getPost('person_id');
        $res = $this->riwayathidupmodel->getDataPendidikanPolriByPersonId($person_id)->getResult();
        echo json_encode($res);
    }

    public function getDataPendidikanPolriById() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $riwayat_pendidikan_polri_id = $this->request->getPost('riwayat_pendidikan_polri_id');
        $res = $this->riwayathidupmodel->getDataPendidikanPolriById($riwayat_pendidikan_polri_id)->getResult();
        echo json_encode($res);
    }

    public function getDataPendidikanSpesialis() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $person_id = $this->request->getPost('person_id');
        $res = $this->riwayathidupmodel->getDataPendidikanSpesialisByPersonId($person_id)->getResult();
        echo json_encode($res);
    }

    public function getDataPendidikanSpesialisById() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $riwayat_pendidikan_spesialis_id = $this->request->getPost('riwayat_pendidikan_spesialis_id');
        $res = $this->riwayathidupmodel->getDataPendidikanSpesialisById($riwayat_pendidikan_spesialis_id)->getResult();
        echo json_encode($res);
    }

    public function getDataRiwayatPekerjaan() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $person_id = $this->request->getPost('person_id');
        $res = $this->riwayathidupmodel->getDataRiwayatPekerjaanByPersonId($person_id)->getResult();
        echo json_encode($res);
    }

    public function getDataRiwayatPekerjaanById() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $riwayat_pekerjaan_id = $this->request->getPost('riwayat_pekerjaan_id');
        $res = $this->riwayathidupmodel->getDataRiwayatPekerjaanById($riwayat_pekerjaan_id)->getResult();
        echo json_encode($res);
    }

    function simpanidentitas() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        
        $riwayat_hidup_id = $this->request->getPost('riwayat_hidup_id');
        $jenis_pengajuan_id = $this->request->getPost('jenis_pengajuan_id');
        $person_id = $this->request->getPost('person_id');
        $person_nm = $this->request->getPost('person_nm');
        $birth_place = $this->request->getPost('birth_place');
        // $birth_dttm = $this->request->getPost('birth_dttm');
        $gender_cd = $this->request->getPost('gender_cd');
        $addr_txt = $this->request->getPost('addr_txt');
        $religion = $this->request->getPost('religion');
        $status_pernikahan = $this->request->getPost('status_pernikahan');
        $jabatan_id = $this->request->getPost('jabatan_id');
        $pangkat = $this->request->getPost('pangkat');
        $nrp = $this->request->getPost('nrp');
        $addr_txt_office = $this->request->getPost('addr_txt_office');
        $nama_atasan = $this->request->getPost('nama_atasan');
        $jabatan_atasan = $this->request->getPost('jabatan_atasan');
        $cellphone = $this->request->getPost('cellphone');
        $email = $this->request->getPost('email');
        $hari 			= $this->request->getPost("hari_lahir");
        $bulan 			= $this->request->getPost("bulan_lahir");
        $tahun 			= $this->request->getPost("tahun_lahir");
        $birth_dttm		= $tahun."-".$bulan."-".$hari;

        $data = [
            'person_nm' => $person_nm,
            'birth_place' => $birth_place,
            'birth_dttm' => $birth_dttm,
            'gender_cd' => $gender_cd,
            'addr_txt' => $addr_txt,
            'religion' => $religion,
            'status_pernikahan' => $status_pernikahan,
            'jabatan' => $jabatan_id,
            'pangkat' => $pangkat,
            'nrp' => $nrp,
            'addr_txt_office' => $addr_txt_office,
            'nama_atasan' => $nama_atasan,
            'jabatan_atasan' => $jabatan_atasan,
            'cellphone' => $cellphone,
            'email' => $email
        ];
        
        $update = $this->riwayathidupmodel->updateidentitas($person_id, $data);

        $data_riwayat_hidup = [
            'jenis_pengajuan_id' => $jenis_pengajuan_id,
            'person_id' => $person_id,
        ];

        if (empty($riwayat_hidup_id)) {
            $riwayat_hidup = $this->riwayathidupmodel->simpanriwayathidup($data_riwayat_hidup);
        } else {
            $riwayat_hidup = $this->riwayathidupmodel->updateriwayathidup($riwayat_hidup_id, $data_riwayat_hidup);
        }
        
        if ($riwayat_hidup) {
            echo json_encode("berhasil");
        } else {
            echo json_encode("gagal");
        }
    }

    function simpankeluarga() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $person_id = $this->request->getPost('person_id');
        $keluarga_id = $this->request->getPost('keluarga_id');
        $person_nm_keluarga = $this->request->getPost('person_nm_keluarga');
        $hubungan = $this->request->getPost('hubungan');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $tempat_lahir = $this->request->getPost('tempat_lahir');
        // $tanggal_lahir = $this->request->getPost('tanggal_lahir');
        $hari 			= $this->request->getPost("hari_lahir_keluarga");
        $bulan 			= $this->request->getPost("bulan_lahir_keluarga");
        $tahun 			= $this->request->getPost("tahun_lahir_keluarga");
        $tanggal_lahir		= $tahun."-".$bulan."-".$hari;
        $pendidikan_keluarga = $this->request->getPost('pendidikan_keluarga');
        $pekerjaan = $this->request->getPost('pekerjaan');

        $data = [
            'person_id' => $person_id,
            'keluarga_nm' => $person_nm_keluarga,
            'hubungan' => $hubungan,
            'jenis_kelamin' => $jenis_kelamin,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'pendidikan' => $pendidikan_keluarga,
            'pekerjaan' => $pekerjaan
        ];

        if (empty($keluarga_id)) {
            $res = $this->riwayathidupmodel->simpankeluarga($data);
        } else {
            $res = $this->riwayathidupmodel->updatekeluarga($keluarga_id, $data);
        }
         
        if ($res) {
            echo json_encode("berhasil");
        } else {
            echo json_encode("gagal");
        }
    }

    public function simpanpendidikanformal() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}

        $riwayat_pendidikan_formal_id = $this->request->getPost('riwayat_pendidikan_formal_id');
        $person_id = $this->request->getPost('person_id');
        $nama_sekolah = $this->request->getPost('nama_sekolah');
        $jenjang_pendidikan_id = $this->request->getPost('jenjang_pendidikan_id');
        $jurusan = $this->request->getPost('jurusan');
        $tempat = $this->request->getPost('tempat');
        $tahun_mulai = $this->request->getPost('tahun_mulai');
        $tahun_selesai = $this->request->getPost('tahun_selesai');
        $keterangan = $this->request->getPost('keterangan');

        $data = [
            'person_id' => $person_id,
            'nama_sekolah' => $nama_sekolah,
            'jenjang_pendidikan_id' => $jenjang_pendidikan_id,
            'jurusan' => $jurusan,
            'tempat' => $tempat,
            'tahun_mulai' => $tahun_mulai,
            'tahun_selesai' => $tahun_selesai,
            'keterangan' => $keterangan
        ];

        if (empty($riwayat_pendidikan_formal_id)) {
            $res = $this->riwayathidupmodel->simpanpendidikanformal($data);
        } else {
            $res = $this->riwayathidupmodel->updatependidikanformal($riwayat_pendidikan_formal_id, $data);
        }
         
        if ($res) {
            echo json_encode("berhasil");
        } else {
            echo json_encode("gagal");
        }
    }

    public function simpanpendidikanpolri() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}

        $riwayat_pendidikan_polri_id = $this->request->getPost('riwayat_pendidikan_polri_id');
        $person_id = $this->request->getPost('person_id');
        $jenis_pendidikan_polri = $this->request->getPost('jenis_pendidikan_polri');
        $tempat_pendidikan_polri = $this->request->getPost('tempat_pendidikan_polri');
        $tahun_pendidikan_polri = $this->request->getPost('tahun_pendidikan_polri');
        $keterangan_pendidikan_polri = $this->request->getPost('keterangan_pendidikan_polri');
        $tipe_pendidikan_polri = $this->request->getPost('tipe_pendidikan_polri');

        $data = [
            'person_id' => $person_id,
            'jenis' => $jenis_pendidikan_polri,
            'tempat' => $tempat_pendidikan_polri,
            'tahun' => $tahun_pendidikan_polri,
            'keterangan' => $keterangan_pendidikan_polri,
            'tipe   ' => 1,
        ];

        if (empty($riwayat_pendidikan_polri_id)) {
            $res = $this->riwayathidupmodel->simpanpendidikanpolri($data);
        } else {
            $res = $this->riwayathidupmodel->updatependidikanpolri($riwayat_pendidikan_polri_id, $data);
        }
         
        if ($res) {
            echo json_encode("berhasil");
        } else {
            echo json_encode("gagal");
        }
    }

    public function simpanpendidikanspesialis() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}

        $riwayat_pendidikan_spesialis_id = $this->request->getPost('riwayat_pendidikan_spesialis_id');
        $person_id = $this->request->getPost('person_id');
        $jenis_pendidikan_spesialis = $this->request->getPost('jenis_pendidikan_spesialis');
        $tempat_pendidikan_spesialis = $this->request->getPost('tempat_pendidikan_spesialis');
        $tahun_pendidikan_spesialis = $this->request->getPost('tahun_pendidikan_spesialis');
        $keterangan_pendidikan_spesialis = $this->request->getPost('keterangan_pendidikan_spesialis');
        $tipe_pendidikan_spesialis = $this->request->getPost('tipe_pendidikan_spesialis');

        $data = [
            'person_id' => $person_id,
            'jenis' => $jenis_pendidikan_spesialis,
            'tempat' => $tempat_pendidikan_spesialis,
            'tahun' => $tahun_pendidikan_spesialis,
            'keterangan' => $keterangan_pendidikan_spesialis,
            'tipe   ' => 2,
        ];

        if (empty($riwayat_pendidikan_spesialis_id)) {
            $res = $this->riwayathidupmodel->simpanpendidikanspesialis($data);
        } else {
            $res = $this->riwayathidupmodel->updatependidikanspesialis($riwayat_pendidikan_spesialis_id, $data);
        }
         
        if ($res) {
            echo json_encode("berhasil");
        } else {
            echo json_encode("gagal");
        }
    }

    public function simpanriwayatpekerjaan() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}

        $riwayat_pekerjaan_id = $this->request->getPost('riwayat_pekerjaan_id');
        $person_id = $this->request->getPost('person_id');
        $riwayat_jabatan = $this->request->getPost('riwayat_jabatan');
        // $riwayat_mulai = $this->request->getPost('riwayat_mulai');
        // $riwayat_selesai = $this->request->getPost('riwayat_selesai');
        $riwayat_bagian = $this->request->getPost('riwayat_bagian');
        $riwayat_satker = $this->request->getPost('riwayat_satker');
        
        $hari			        = '01';
        $bulan_mulai 			= $this->request->getPost("bulan_mulai_pekerjaan");
        $tahun_mulai 			= $this->request->getPost("tahun_mulai_pekerjaan");
        $riwayat_mulai		    = $tahun_mulai."-".$bulan_mulai."-".$hari;

        $bulan_selesai			= $this->request->getPost("bulan_selesai_pekerjaan");
        $tahun_selesai 			= $this->request->getPost("tahun_selesai_pekerjaan");
        $riwayat_selesai	    = $tahun_selesai."-".$bulan_selesai."-".$hari;

        $data = [
            'riwayat_pekerjaan_id' => $riwayat_pekerjaan_id,
            'person_id' => $person_id,
            'jabatan' => $riwayat_jabatan,
            'mulai' => $riwayat_mulai,
            'selesai' => $riwayat_selesai,
            'bagian' => $riwayat_bagian,
            'satker' => $riwayat_satker
        ];

        if (empty($riwayat_pekerjaan_id)) {
            $res = $this->riwayathidupmodel->simpanriwayatpekerjaan($data);
        } else {
            $res = $this->riwayathidupmodel->updateriwayatpekerjaan($riwayat_pekerjaan_id, $data);
        }
         
        if ($res) {
            echo json_encode("berhasil");
        } else {
            echo json_encode("gagal");
        }
    }

    public function getKeluargaById() {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $keluarga_id = $this->request->getPost('keluarga_id');
        $keluarga = $this->riwayathidupmodel->getDataKeluargaById($keluarga_id)->getResult();
        echo json_encode($keluarga);
    }

    public function hapuskeluarga() {
        $keluarga_id = $this->request->getPost('keluarga_id');
        $data = [
            'status_cd' => 'nullified'
        ];
        $res = $this->riwayathidupmodel->updatekeluarga($keluarga_id, $data);
        if ($res) {
            echo json_encode("berhasil");
        } else {
            echo json_encode("gagal");
        }
    }

    public function hapuspendidikanformal() {
        $riwayat_pendidikan_formal_id = $this->request->getPost('riwayat_pendidikan_formal_id');
        $data = [
            'status_cd' => 'nullified'
        ];
        $res = $this->riwayathidupmodel->updatependidikanformal($riwayat_pendidikan_formal_id, $data);
        if ($res) {
            echo json_encode("berhasil");
        } else {
            echo json_encode("gagal");
        }
    }

    public function hapuspendidikanpolri() {
        $riwayat_pendidikan_polri_id = $this->request->getPost('riwayat_pendidikan_polri_id');
        $data = [
            'status_cd' => 'nullified'
        ];
        $res = $this->riwayathidupmodel->updatependidikanpolri($riwayat_pendidikan_polri_id, $data);
        if ($res) {
            echo json_encode("berhasil");
        } else {
            echo json_encode("gagal");
        }
    }

    public function hapuspendidikanspesialis() {
        $riwayat_pendidikan_spesialis_id = $this->request->getPost('riwayat_pendidikan_spesialis_id');
        $data = [
            'status_cd' => 'nullified'
        ];
        $res = $this->riwayathidupmodel->updatependidikanspesialis($riwayat_pendidikan_spesialis_id, $data);
        if ($res) {
            echo json_encode("berhasil");
        } else {
            echo json_encode("gagal");
        }
    }

    public function hapusriwayatpekerjaan() {
        $riwayat_pekerjaan_id = $this->request->getPost('riwayat_pekerjaan_id');
        $data = [
            'status_cd' => 'nullified'
        ];
        $res = $this->riwayathidupmodel->updateriwayatpekerjaan($riwayat_pekerjaan_id, $data);
        if ($res) {
            echo json_encode("berhasil");
        } else {
            echo json_encode("gagal");
        }
    }
    
    
}