<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Satuanmodel;
class Reset extends BaseController
{
    protected $satuanmodel;
    public function __construct()
	{
		$this->session = \Config\Services::session();
        $this->satuanmodel = new Satuanmodel();
	}


    public function index()
    {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		} else {
            $data = [           
                "satuan" => $this->satuanmodel->getSatuan()->getResult()
            ];
            return view('admin/reset/index', $data);
        }
        
    }

    public function resetResponBySatuan() {
        $satuan_id = $this->request->getPost('satuan_id');


        $reset = $this->satuanmodel->resetResponBySatuan($satuan_id);
        if ($reset) {
            # code...
        } else {
            # code...
        }
        
        return $reset;
    }
}