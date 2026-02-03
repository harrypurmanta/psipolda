<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Riwayathidupmodel;
use TCPDF;
class Rh extends BaseController
{
    protected $riwayathidupmodel;
    protected $session;
    public function __construct()
	{
		$this->session = \Config\Services::session();
        $this->riwayathidupmodel = new Riwayathidupmodel();
	}


    public function index()
    {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		} else {
            
            
            return view('admin/rh/index');
        }
        
    }

    public function getDataPersonRh() {
        $tanggal = $this->request->getPost('tanggal');
        $res =  $this->riwayathidupmodel->getRiwayatHidup($tanggal)->getResult();
        echo json_encode($res);
    }

    public function hasilpdfrh() {
        helper('tanggal');
        $person_id = $this->request->getUri()->getSegment(4);
        $user_id = $this->request->getUri()->getSegment(5);
        $date = $this->request->getUri()->getSegment(6);
        $data = [
            'NoTest' => $this->riwayathidupmodel->getNotestHasilRH($user_id)->getResult(),
            // 'identitas' => $this->riwayathidupmodel->getRiwayatHidupByUserIdHasil($user_id, $date)->getResult(),
            'identitas' => $this->riwayathidupmodel->getIdentitasByUserIdHasil($user_id)->getResult(),
            'keluarga' => $this->riwayathidupmodel->getDataKeluargaByPersonId($person_id)->getResult(),
            'formal' => $this->riwayathidupmodel->getDataPendidikanFormalByPersonId($person_id)->getResult(),
            'pendidikan_polri' => $this->riwayathidupmodel->getDataPendidikanPolriByPersonId($person_id)->getResult(),
            'pendidikan_spesialis' => $this->riwayathidupmodel->getDataPendidikanSpesialisByPersonId($person_id)->getResult(),
            'riwayat_pekerjaan' => $this->riwayathidupmodel->getDataRiwayatPekerjaanByPersonId($person_id)->getResult(),
            'no_soal' => $this->riwayathidupmodel->getPertanyaanInventori()->getResult(),
            'person_id' => $person_id
        ];

        // return view('admin/rh/hasilpdf', $data);

        $htmlheader = view('admin/rh/hasilpdf_header', $data);
        // $htmlidentitas = view('admin/rh/hasilpdf_identitas', $data);
        // $htmlkeluarga = view('admin/rh/hasilpdf_keluarga', $data);
        // return view('admin/rh/hasilpdf_riwayat_pendidikan', $data);
        $htmlriwayat_pendidikan = view('admin/rh/hasilpdf_riwayat_pendidikan', $data);
        $htmlinventori = view('admin/rh/hasilpdf_inventori', $data);

        $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('SDM Polda');
		$pdf->SetTitle('Riwayat Hidup');
		$pdf->SetSubject('Riwayat Hidup');
        $pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        $pdf->AddPage();
		$pdf->writeHTML($htmlheader, true, false, true, false, '');

        $pdf->AddPage();
		$pdf->writeHTML($htmlriwayat_pendidikan, true, false, true, false, '');

        $pdf->AddPage();
		$pdf->writeHTML($htmlinventori, true, false, true, false, '');

		$this->response->setContentType('application/pdf');
		//Close and output PDF document
		$pdf->Output('riwayat_hidup.pdf', 'I');
    }
}