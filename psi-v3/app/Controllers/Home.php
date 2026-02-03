<?php

namespace App\Controllers;
use App\Models\Soalmodel;
class Home extends BaseController
{
    protected $soalmodel;
    public function __construct()
	{
		$this->session = \Config\Services::session();
        $this->soalmodel = new Soalmodel();
	}


    public function index()
    {
        $data = [
            'materi' => $this->soalmodel->getjawAllJMateri()->getResult(),
            'materiSK' => $this->soalmodel->getMateriSK()->getResult(),
        ];
        return view('front/home',$data);
        
    }
    
    public function lvb()
    { 
        return view('front/lvb');
    }
    
    public function butcher()
    { 
        return view('front/butcher');
    }
    
}
