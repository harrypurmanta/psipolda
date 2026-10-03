<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Soalmodel;
use App\Models\Jawabanmodel;
class Soal extends BaseController
{
    protected $soalmodel;
    protected $jawabanmodel;
    protected $session;
    public function __construct()
	{
		$this->session = \Config\Services::session();
        $this->soalmodel = new Soalmodel();
        $this->jawabanmodel = new Jawabanmodel();
	}


    public function index()
    {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		} else {
            $data = [
                'materi' => $this->soalmodel->getjawAllJMateri()->getResult(),
                'group' => $this->soalmodel->getGroup()->getResult(),
                'kolom' => $this->soalmodel->getkolom()->getResult(),
                'soal' => $this->showsoal()
            ];
            return view('admin/soal',$data);
        }
        
    }

    public function showsoal() {
        $group_id   = $this->request->getPost('group_id');
        $materi     = $this->request->getPost('materi');
        $filter     = $this->request->getPost('filter');
        $this->session->set("group_filter",$group_id);
        $this->session->set("materi_filter",$materi);
        if ($filter == "all") {
            $res = $this->soalmodel->getAllSoalSK()->getResult();
        } else if (isset($materi) && !isset($group_id)) {
            $res = $this->soalmodel->getSoalBymateri($materi)->getResult();
        } else if ($materi == 5 && $group_id == 4) {
            $res = $this->soalmodel->getSoalBymateri(5)->getResult();
        } else {
            $res = $this->soalmodel->getSoalBygrmt($group_id,$materi)->getResult();
        }
        
        $no = 1;
        
        $ret = "<table id='example2' class='table table-bordered table-hover'>
                    <thead>
                    <tr>
                    <th style='text-align:center;width:50px;'>No.</th>
                    <th style='text-align:center;width:100px;'>No. Soal</th>
                    <th style='text-align:center;'>Soal</th>
                    <th style='text-align:center;width:50px;'>Kunci</th>
                    <th style='text-align:center;width:50px;'>Kolom</th>
                    <th style='text-align:center;'>Gambar</th>
                    <th style='text-align:center;'>Action</th>
                    </tr>
                    </thead>
                    <tbody>";
                    
                foreach ($res as $key) {
                    $soal_id = $key->soal_id;
                    $kolom_id = $key->kolom_id;
                    $ret .= "<tr>
                            <td style='text-align:center;'>". $no++."</td>
                            <td style='text-align:center;'>".$key->no_soal."</td>
                            <td style='text-align:center;'>".$key->soal_nm."</td>
                            <td style='text-align:center;'>".$key->kunci."</td>
                            <td style='text-align:center;'>$kolom_id</td>";
                            // <td style='width:200px;'>
                            // <div style='display:inline-block;'>
                            //     <a onclick='showjawaban(".$key->soal_id.")' class='btn btn-app btn-secondary' style='height: 44px;padding: 5px 5px;min-width: 40px;'>
                            //     <i style='font-size: 15px;' class='fas fa-edit'></i> Edit
                            //     </a>
                            // </div>
                            // <div style='display:inline-block;'>
                            // <ul style='list-style-type: none;text-align:left;padding:0;margin-left:10px;'>";
                                // $db = db_connect();
                                // $jawaban_nm = "";
                                // $status_jwb = "";
                                // $query = $db->query("SELECT * FROM jawaban WHERE soal_id = $soal_id AND status_cd IN ('normal','disable')");
                                // foreach ($query->getResult() as $jwb) {
                                // $jawaban_nm = $jwb->jawaban_nm;
                                // $status_jwb = $jwb->status_cd;
                                // $ret .= "<li>".$jwb->pilihan_nm .". ". $jwb->jawaban_nm."</li>";
                                // }
                            
                    // $ret .= "</ul>
                    //         </div>
                            
                    //         </td>

                                $db = db_connect();
                                $jawaban_nm = "";
                                $status_jwb = "";
                                $query = $db->query("SELECT * FROM jawaban WHERE soal_id = $soal_id AND status_cd IN ('normal','disable')");
                                foreach ($query->getResult() as $jwb) {
                                $jawaban_nm = $jwb->jawaban_nm;
                                $status_jwb = $jwb->status_cd;
                                }

                        $ret .= "<td style='text-align:center;'>";
                            if ($key->soal_img == "") {
                                $ret .= "";
                            } else {
                                $ret .= "<img style='max-width:300px;heigth:100%;' src='".base_url()."/images/soal/materi/".$key->materi."/".$key->soal_img."'>";
                            }
                    $ret .= "</td>
                            <td style='text-align:center;'><button onclick='editsoal(".$key->soal_id.")' style='font-size:16px;' class='btn btn-secondary' data-toggle='modal' data-target='#modal-lg'>Edit</button> <button onclick='hapussoal(".$key->soal_id.")' style='font-size:16px;' class='btn btn-danger'>Hapus</button> <div class='form-group'>
                            <div class='custom-control custom-switch'>
                              <input onclick='checkboxenable(\"$jawaban_nm\",$kolom_id,$soal_id)' type='checkbox' class='custom-control-input' id='customSwitch1_${kolom_id}_${soal_id}' ".($status_jwb=='normal'?'checked':'')."/>
                              <label class='custom-control-label' for='customSwitch1_${kolom_id}_${soal_id}'>enable/disable</label>
                            </div>
                          </div></td>
                            </tr>
                                <tr class='tr_parentdata' style='background-color:#ececec54;' id='tr_data_${soal_id}'>
                                </tr>";
                        }
                    
                $ret .= "</tbody>
                </table>";

        return $ret;
    }

    public function tambahsoal() {
        $ret = "<div class='card'>
                <div class='card-body'>
                <div class='row'>
                <div class='col-sm-12'>
                <div class='form-group'>
                    <div class='card-body'>
                    <div class='form-group row'>
                        <div class='col-lg-12'><label for='no_soal'>Group : </label>  ";
                        $resgroup = $this->soalmodel->getGroup()->getResult();
                        foreach ($resgroup as $g) {
                            $group_id = $g->group_soal_id;
                            $ret .= "<label style='margin:0px 10px;' for='group_nm_${group_id}'><input value='".$g->group_soal_id."' type='radio' id='group_nm_${group_id}' name='group_nm' ".($group_id==$this->session->group_id?'checked':'')."/> ".$g->group_nm."</label> ";
                        }
                        
                    $ret .= "</div>
                        
                    </div>
                    <div class='form-group row'>
                        <div class='col-lg-12'><label for='no_soal'>Materi : </label>";
                        $resmateri =  $this->soalmodel->getjawAllJMateri()->getResult();
                        foreach ($resmateri as $mtr) {
                            $materi_id = $mtr->materi_id;
                            $ret .= "<label style='margin:0px 10px;' for='materi_${materi_id}'><input value='$materi_id' type='radio' id='materi_${materi_id}' name='materi' ".($materi_id==$this->session->materi?'checked':'')."/> ".$mtr->materi_nm."</label>";
                        }
                    $ret .= "</div>
                        
                    </div>
                    <div class='form-group row'>
                        <label for='no_soal' class='col-sm-2 col-form-label'>No Soal</label>
                        <div class='col-2'>
                        <input type='text' class='form-control' id='no_soal' name='no_soal'>
                        </div>
                        <label for='no_soal' class='col-sm-2 col-form-label'>Kunci</label>
                        <div class='col-2'>
                        <input type='text' class='form-control' id='kunci' name='kunci'>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <label for='soal_nm' class='col-sm-2 col-form-label'>Soal</label>
                        <div class='col-sm-10'>
                        <textarea class='form-control' id='soal_nm' name='soal_nm'></textarea>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <label for='soal_img' class='col-sm-2 col-form-label'>Gambar</label>
                        <div class='col-sm-10'>
                        <input type='file' class='form-control' id='soal_img' name='soal_img'/>
                        </div>
                    </div>
                    </div>
                    <div class='card-footer'>
                    <button onclick='simpansoal()' type='button' class='btn btn-info'>Simpan</button>
                    <button type='button' class='btn btn-default float-right' data-dismiss='modal' aria-label='Close'>Cancel</button>
                    </div>";
                    
        $ret .= "</div>
                </div>
                </div>
                </div>
                </div>";

        return $ret;
    }

    public function editsoal() {
        $soal_id = $this->request->getPost('soal_id');
        $ressoal = $this->soalmodel->getSoalByid($soal_id)->getResult();
        foreach ($ressoal as $key) {
            $ret = "<div class='card'>
                <div class='card-body'>
                <div class='row'>
                <div class='col-sm-12'>
                <div class='form-group'>
                    <div class='card-body'>
                    <div class='form-group row'>
                        <div class='col-lg-12'><label for='no_soal'>Group : </label>  ";
                        $resgroup = $this->soalmodel->getGroup()->getResult();
                        foreach ($resgroup as $g) {
                            $group_id = $g->group_soal_id;
                            $ret .= "<label style='margin:0px 10px;' for='group_nm_${group_id}'><input value='".$g->group_soal_id."' type='radio' id='group_nm_${group_id}' name='group_nm' ".($group_id==$key->group_id?'checked':'')."/> ".$g->group_nm."</label> ";
                        }
                        
                    $ret .= "</div>
                        
                    </div>
                    <div class='form-group row'>
                        <div class='col-lg-12'><label for='no_soal'>Materi : </label>
                        <label style='margin:0px 10px;' for='materi_1'><input value='1' type='radio' id='materi_1' name='materi' ".(1==$key->materi?'checked':'')."/> Materi 1</label> 
                        <label style='margin:0px 10px;' for='materi_2'><input value='2' type='radio' id='materi_2' name='materi' ".(2==$key->materi?'checked':'')."/> Materi 2</label>
                        <label style='margin:0px 10px;' for='materi_3'><input value='3' type='radio' id='materi_3' name='materi' ".(3==$key->materi?'checked':'')."/> Materi 3</label>
                        <label style='margin:0px 10px;' for='materi_4'><input value='4' type='radio' id='materi_4' name='materi' ".(4==$key->materi?'checked':'')."/> Materi 4</label>";
                        
                        
                    $ret .= "</div>
                        
                    </div>
                    <div class='form-group row'>
                        <label for='no_soal' class='col-sm-2 col-form-label'>No Soal</label>
                        <div class='col-2'>
                        <input type='text' class='form-control' id='no_soal' name='no_soal' value='".$key->no_soal."'>
                        </div>
                        <label for='no_soal' class='col-sm-2 col-form-label'>Kunci</label>
                        <div class='col-2'>
                        <input type='text' class='form-control' id='kunci' name='kunci' value='".$key->kunci."'>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <label for='soal_nm' class='col-sm-2 col-form-label'>Soal</label>
                        <div class='col-sm-10'>
                        <textarea class='form-control' id='soal_nm' name='soal_nm'>".$key->soal_nm."</textarea>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <label for='soal_img' class='col-sm-2 col-form-label'>Gambar</label>
                        <div class='col-sm-10'>
                        <input type='file' class='form-control' id='soal_img' name='soal_img'/>
                        <input type='hidden' class='form-control' id='soal_img_lama' name='soal_img_lama' value='".$key->soal_img."'/>
                        <img src='".base_url()."/images/soal/materi/".$key->materi."/".$key->soal_img."' style='width: 150px;height: 150px;'>
                        </div>
                    </div>
                    </div>
                    <div class='card-footer'>
                    <button onclick='updatesoal(".$key->soal_id.")' type='button' class='btn btn-info'>Simpan</button>
                    <button type='button' class='btn btn-default float-right' data-dismiss='modal' aria-label='Close'>Cancel</button>
                    </div>";
                    
            $ret .= "</div>
                    </div>
                    </div>
                    </div>
                    </div>";
        }
        

        echo json_encode($ret);
    }

    public function simpansoal() {
        $soal_nm = $this->request->getPost('soal_nm');
        $materi = $this->request->getPost('materi');
        $kunci = $this->request->getPost('kunci');
        $group_id = $this->request->getPost('group_id');
        $no_soal = $this->request->getPost('no_soal');
        $this->session->set("group_id",$group_id);
        $this->session->set("materi",$materi);
        $group = $this->soalmodel->getGroupByid($group_id)->getResult();
        $newName = "";
        if($imagefile = $this->request->getFiles()){
            foreach($imagefile['soal_img'] as $img){
               if ($img->isValid() && ! $img->hasMoved()){
                    $newName = $img->getClientName();
                    $img->move("../public/images/soal/materi/$materi", $newName);
                    

                   }
             }
        }

        $data = [
            'soal_nm' => $soal_nm,
            'group_id' => $group_id,
            'no_soal' => $no_soal,
            'kunci' => $kunci,
            'materi' => $materi,
            'status_cd' => 'normal',
            'soal_img' => $newName,
        ];
        $soal_id = $this->soalmodel->simpansoal($data);
        echo "sukses";
        // echo json_encode($group[0]->group_nm);
    }

    public function updatesoal() {
        $soal_id = $this->request->getPost('soal_id');
        $soal_nm = $this->request->getPost('soal_nm');
        $materi = $this->request->getPost('materi');
        $kunci = $this->request->getPost('kunci');
        $group_id = $this->request->getPost('group_id');
        $no_soal = $this->request->getPost('no_soal');
        $soal_img_lama = $this->request->getPost('soal_img_lama');
        $this->session->set("group_id",$group_id);
        $this->session->set("materi",$materi);

        $newName = "";
        if($imagefile = $this->request->getFiles()){
            foreach($imagefile['soal_img'] as $img){
               if ($img->isValid() && ! $img->hasMoved()){
                    $newName = $img->getClientName();
                    $img->move("../public/images/soal/materi/$materi", $newName);
                        $data = [
                            'soal_nm' => $soal_nm,
                            'group_id' => $group_id,
                            'no_soal' => $no_soal,
                            'kunci' => $kunci,
                            'materi' => $materi,
                            'status_cd' => 'normal',
                            'soal_img' => $newName,
                        ];
                        $this->soalmodel->updatesoal($soal_id,$data);

                   }
             }
        } else {
            $data = [
                'soal_nm' => $soal_nm,
                'group_id' => $group_id,
                'no_soal' => $no_soal,
                'kunci' => $kunci,
                'materi' => $materi,
                'status_cd' => 'normal'
            ];
            $this->soalmodel->updatesoal($soal_id,$data);
        }

        
        // echo json_encode(array("soal_id"=>$soal_id,"group_nm"=>$group[0]->group_nm));
        echo "sukses";
    }

    public function hapussoal() {
        $soal_id = $this->request->getPost('soal_id');
        $data = [
            'status_cd' => 'nullified'
        ];
        $this->soalmodel->hapussoal($soal_id,$data);
        // echo json_encode(array("soal_id"=>$soal_id,"group_nm"=>$group[0]->group_nm));
        echo json_encode("sukses");
    }

    public function showjawaban() {
        $soal_id = $this->request->getPost('soal_id');
        $res = $this->soalmodel->getJawabanBysoalId($soal_id)->getResult();
        $cntform = 1;
        if (count($res)>0) {
            $ret = "<td class='td_form' colspan='2'></td>
                        <td colspan='4' class='td_form'>
                        <table id='tb_jawaban${soal_id}' class='table table-bordered table-hover'>
                        <tbody>";
                        foreach ($res as $key) {
                            $jawaban_id = $key->jawaban_id;
                            $ret .= "<tr id='tr_form_${soal_id}_${jawaban_id}'>
                                      <td style='text-align:center;width:50px;'><button onclick='timesbtn($soal_id,$jawaban_id)' type='button' class='btn btn-outline-danger'><i class='fa fa-times'></i></button></td>
                                      <td style='text-align:center;width:50px;'><input style='width:50px;text-align:center;' type='text' value='".$key->pilihan_nm."' id='pilihan_nm_${jawaban_id}' name='pilihan_nm[]' data-id='$jawaban_id'/> </td>
                                      <td><input style='padding-left:10px;width:100%;' type='text' value='".$key->jawaban_nm."' id='jawaban_nm_${jawaban_id}' name='jawaban_nm[]'/> </td>
                                      <td style='text-align:center;width:50px;'>
                                      <button onclick='deletebtn($soal_id,$jawaban_id)' type='button' class='btn btn-outline-danger'><i class='fa fa-trash'></i></button>
                                      </td>
                                      <td style='text-align:center;'>";
                                $ret .= "<div><input type='file' id='jawaban_img_${jawaban_id}' name='jawaban_img[]' data-jawaban_id='$jawaban_id' style='max-width: 200px;'/> <button onclick='hapusgambarjawaban($jawaban_id)' type='button' class='btn btn-outline-danger'><i class='fa fa-trash'></i></button> <button onclick='simpangambarjawaban($soal_id,$jawaban_id)' type='button' class='btn btn-outline-success'><i class='fa  fa-save'></i></button></div>";
                                    if ($key->jawaban_img == "") {
                                        $ret .= "";
                                    } else {
                                        $ret .= "<div><img style='max-width:150px;heigth:100%;' src='".base_url()."/images/jawaban/materi/".$this->session->materi_filter."/".$key->jawaban_img.".jpg'></div>";
                                    }
                                $ret .= "</td>
                                     </tr>";
                        }
            $ret .= "</tbody>
                    </table>
                    </td>
                    <td class='td_form' colspan='4' style='line-height: 10;'>
                    <button onclick='plusbtn($soal_id)' type='button' class='btn btn-outline-primary'><i class='fa fa-plus'></i></button>
                   
                    <button onclick='checkbtn($soal_id)' type='button' class='btn btn-outline-success'><i class='fa fa-check'></i></button>
                    </td>";
                    
        } else {
            $ret = "<td class='td_form' colspan='2'></td>
                        <td class='td_form'>
                        <table id='tb_jawaban${soal_id}' class='table table-bordered table-hover'>
                        <tbody>";
                $ret .= "<tr class='tr_form' id='tr_form_${soal_id}_${cntform}'>
                            <td style='text-align:center;width:50px;'><button onclick='timesbtn($soal_id,$cntform)' type='button' class='btn btn-outline-danger'><i class='fa fa-times'></i></button></td>
                            <td style='text-align:center;width:50px;'><input style='width:50px;text-align:center;' type='text' value='' name='pilihan_nm[]' data-id='new'/> </td>
                            <td><input style='padding-left:10px;width:100%;' type='text' value='' name='jawaban_nm[]'/> </td>
                        </tr>";
            $ret .= "</tbody>
                    </table>
                    </td>
                    <td class='td_form' colspan='4' style='line-height: 10;'>
                    <button onclick='plusbtn($soal_id)' type='button' class='btn btn-outline-primary'><i class='fa fa-plus'></i></button>
                   
                    <button onclick='checkbtn($soal_id)' type='button' class='btn btn-outline-success'><i class='fa fa-check'></i></button>
                    </td>";
        }
        echo json_encode($ret);
    }

    public function simpanjawaban() {
        $soal_id    = $this->request->getPost('soal_id');
        $pilihan_nm = $this->request->getPost('pilihan_nm');
        $jawaban_nm = $this->request->getPost('jawaban_nm');
        $jawaban_id = $this->request->getPost('jawaban_id');
        $i = 0;
        foreach ($pilihan_nm as $k => $v) {
            $imagefile = $this->request->getFiles();
        
            if ($v['id'] == "new") {
                if ($imagefile["jawaban_img"][$i]->isValid() && ! $imagefile["jawaban_img"][$i]->hasMoved()){
                    $newName = $soal_id.$pilihan_nm[$i];
                    $imagefile["jawaban_img"][$i]->move("../public/images/materi/".$this->session->materi_filter."/", $newName);
                }

                $data = [
                    "soal_id" => $soal_id,
                    "pilihan_nm" => $v['value'],
                    "jawaban_nm" => $jawaban_nm[$i],
                    "jawaban_img" => $newName,
                    "status_cd" => "normal"
                ];
                $simpanjawaban = $this->soalmodel->simpanjawaban($data);
            } else {
                $data = [
                    "soal_id" => $soal_id,
                    "pilihan_nm" => $v['value'],
                    "jawaban_nm" => $jawaban_nm[$i],
                    "jawaban_img" => $newName,
                    "status_cd" => "normal"
                ];
                $simpanjawaban = $this->soalmodel->updatejawaban($jawaban_id[$i],$data);
            }
            $i++;
        }

        if ($simpanjawaban) {
            echo json_encode("sukses");
        }
    }

    public function deletejawaban() {
        $jawaban_id = $this->request->getPost('jawaban_id');
        $deletejawaban = $this->soalmodel->deletejawaban($jawaban_id);
        if ($deletejawaban) {
            echo json_encode("sukses");
        } else {
            echo json_encode("gagal");
        }
    }

    public function simpansoallatihan() {
        $materi_id = $this->request->getPost('materi_id');
        $group_id = $this->request->getPost('group_id');
        $kolom1 = $this->request->getPost('kolom1');
        $kolom2 = $this->request->getPost('kolom2');
        $kolom3 = $this->request->getPost('kolom3');
        $kolom4 = $this->request->getPost('kolom4');
        $kolom5 = $this->request->getPost('kolom5');
        $kolom6 = $this->request->getPost('kolom6');
        $kolom7 = $this->request->getPost('kolom7');
        $kolom8 = $this->request->getPost('kolom8');
        $kolom9 = $this->request->getPost('kolom9');
        $kolom10 = $this->request->getPost('kolom10');
        
        if ($materi_id == 15) {
            $sk_group_id = 8;
        } else if ($materi_id == 16) {
            $sk_group_id = 9;
        } else if ($materi_id == 18) {
            $sk_group_id = 10;
        } else {
            $sk_group_id = 0;
        }
        


        $res = $this->randomchar($kolom1,1,$materi_id,$sk_group_id,$group_id);
        // log_message("info",$res);
        if ($res == "finish") {
            $res = $this->randomchar($kolom2,2,$materi_id,$sk_group_id,$group_id);
            if ($res == "finish") {
                $res = $this->randomchar($kolom3,3,$materi_id,$sk_group_id,$group_id);
                if ($res == "finish") {
                    $res = $this->randomchar($kolom4,4,$materi_id,$sk_group_id,$group_id);
                    if ($res == "finish") {
                        $res = $this->randomchar($kolom5,5,$materi_id,$sk_group_id,$group_id);
                        if ($res == "finish") {
                            $res = $this->randomchar($kolom6,6,$materi_id,$sk_group_id,$group_id);
                            if ($res == "finish") {
                                $res = $this->randomchar($kolom7,7,$materi_id,$sk_group_id,$group_id);
                                if ($res == "finish") {
                                    $res = $this->randomchar($kolom8,8,$materi_id,$sk_group_id,$group_id);
                                    if ($res == "finish") {
                                        $res = $this->randomchar($kolom9,9,$materi_id,$sk_group_id,$group_id);
                                        if ($res == "finish") {
                                            $res = $this->randomchar($kolom10,10,$materi_id,$sk_group_id,$group_id);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } 
        
        echo json_encode("sukses");
    }

    public function randsoal($characters,$randSoal) {
        $randomString = $randSoal;
        for ($s = 0; $s < 5; $s++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        
        $randSoal = count_chars($randomString,3);
        if (strlen($randSoal) == 5) {
            $soal_nm = str_shuffle($randSoal);
        } else {
            $soal_nm = $this->randsoal($characters,$randSoal);
        }

        return $soal_nm;
    }

    public function randomchar($char,$kolom,$materi_id,$sk_group_id,$group_id = 4) {
        $characters = $char; 
        $pilihan = "ABCDE";
        $kunci = "";
        $no = 1;
        $typesoal = 'text';

        if ($materi_id == 18) {
            $typesoal = 'gambar';
        }
        for ($i = 0; $i < 50; $i++) {
            $indexs = rand(0, strlen($pilihan) - 1);
            $kunci = $pilihan[$indexs];
            if ($kunci == "A") {
                $hilang = $characters[0];
            } else if ($kunci == "B") {
                $hilang = $characters[1];
            } else if ($kunci == "C") {
                $hilang = $characters[2];
            } else if ($kunci == "D") {
                $hilang = $characters[3];
            } else if ($kunci == "E") {
                $hilang = $characters[4];
            }
            
            $soal_txt = $this->randsoal($characters,"");
           
            if (strlen($soal_txt) === 5) {
                $soal_nm = str_replace($hilang,"",$soal_txt);
            } else {
                $soal_nm = $soal_txt;
            }

            $data = [
                'soal_nm' => $soal_nm,
                'group_id' => $group_id,
                'no_soal' => $no,
                'kunci' => $kunci,
                'materi' => $materi_id,
                'status_cd' => 'normal',
                'kolom_id' => $kolom,
                'clue' => $characters,
                'sk_group_id' => $sk_group_id,
                'typesoal' => $typesoal
            ];

            $soal_id = $this->soalmodel->insertsoalSKlatihan($data);

            $datax = [
                "soal_id" => $soal_id,
                "pilihan_nm" => $pilihan,
                "jawaban_nm" => $characters,
                "jawaban_img" => "",
                "status_cd" => "normal"
            ];
    
            

            $this->soalmodel->insertjawabanSKlatihan($datax);
            $no++;
        }
        return "finish";
    }

    public function updatestatus() {
        $jawaban_nm = $this->request->getPost('jawaban_nm');
        $kolom_id = $this->request->getPost('kolom_id');
        $status_cd = $this->request->getPost('status_cd');
        $old_status = $this->request->getPost('old_status');

        $update = $this->soalmodel->updatestatus($jawaban_nm,$kolom_id,$status_cd,$old_status);
        log_message("debug",$status_cd);
    }

    public function simpansoalgambar() {
        if ($this->session->get("user_nm") == "") {
			return view('login');
		} 

        $files = $this->request->getFiles();

        if (!isset($files['gambar'])) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'File tidak ditemukan'
            ]);
        }

        $kolom_id = $this->request->getPost('kolom');
        $kolom_lama = $this->request->getPost('kolom_lama');
        $sk_group_id = 10;
        $user_group = $this->request->getPost('user_group');
        $group_id = $this->request->getPost('group_id');

        $soal_nm = [];  
        $allowedMime = ['image/png', 'image/jpg', 'image/jpeg'];

        $path = FCPATH . "images/soalskgambar/kolom/$kolom_id/sk_group/$sk_group_id";

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $uploadedFiles = [];
        $i = 1;
        foreach ($files['gambar'] as $file) {
            // validasi mime
            if (!in_array($file->getMimeType(), $allowedMime)) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Hanya gambar diperbolehkan (gambarsk' . $i . ')'
                ]);
            }

            if ($i == 1) {
                $pilihan = 'A';
            } else if ($i == 2) {
                $pilihan = 'B';
            } else if ($i == 3) {
                $pilihan = 'C';
            } else if ($i == 4) {
                $pilihan = 'D';
            } else if ($i == 5) {
                $pilihan = 'E';
            }

            $newName = $i . $pilihan  . '_' . $kolom_id . '_' . $sk_group_id . '.' . $file->getExtension();
            $fullPath = $path . '/' . $newName;

            // replace file lama
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }

            if ($file->move($path, $newName)) {
                $uploadedFiles[] = $newName;
                $soal_nm[] = $newName;
            } else {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => $file->getErrorString()
                ]);
            }

            
            $i++;
        }

        $soal_nm = implode('|', $soal_nm);
        $res = $this->randomcharGambar($soal_nm, $kolom_id, 18, $sk_group_id);
        return $res;

    }

    public function randomcharGambar($char, $kolom, $materi_id, $sk_group_id)
    {
        $characters = explode('|', $char);
        $pilihan = "ABCDE";
        $kunci = "";
        $no = 1;

        for ($i = 0; $i < 50; $i++) {

            $indexs = rand(0, strlen($pilihan) - 1);
            $kunci = $pilihan[$indexs];
            
            $index = ord($kunci) - 65;
            $hilang = $characters[$index] ?? '';
             
            $soal_txt = $this->randsoalGambar($characters);
            $soal_arr = explode('|', $soal_txt);
            $soal_arr = array_values(array_diff($soal_arr, [$hilang]));
            $soal_nm = implode('|', $soal_arr); 

            $data = [
                'soal_nm' => $soal_nm,
                'group_id' => 13,
                'no_soal' => $no,
                'kunci' => $kunci,
                'materi' => $materi_id,
                'status_cd' => 'normal',
                'kolom_id' => $kolom,
                'clue' => $char, // simpan string aslinya
                'sk_group_id' => $sk_group_id,
                'typesoal' => "gambar"
            ];

            $soal_id = $this->soalmodel->insertsoalSKlatihan($data);

            $datax = [
                "soal_id" => $soal_id,
                "pilihan_nm" => $pilihan,
                "jawaban_nm" => $char,
                "jawaban_img" => "",
                "status_cd" => "normal"
            ];

            $this->soalmodel->insertjawabanSKlatihan($datax);
            $no++;
        }

        echo json_encode("sukses");
    }

    public function randsoalGambar(array $characters): string
    {
        // acak urutan
        shuffle($characters);

        // ambil 5 (aman kalau isinya memang 5)
        $selected = array_slice($characters, 0, 5);

        // gabungkan jadi string
        return implode('|', $selected);
    }

    public function getMateriByGroup()
    {
        $group_id = $this->request->getVar('group_id');
        if (!$group_id) {
            return $this->response->setJSON([]);
        }

        $res = $this->soalmodel->getMateriByGroupId($group_id)->getResult();
        if (empty($res)) {
            $db = db_connect();
            $res = $db->table('materi')
                ->where('group_id', $group_id)
                ->get()
                ->getResult();
        }

        return $this->response->setJSON($res);
    }

    public function downloadTemplate()
    {
        if ($this->session->get("user_nm") == "") {
            return redirect('/');
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Header
        $sheet->setCellValue('A1', 'No Soal');
        $sheet->setCellValue('B1', 'Soal');
        $sheet->setCellValue('C1', 'soal_img');
        $sheet->setCellValue('D1', 'Pilihan A');
        $sheet->setCellValue('E1', 'jawaban_img A');
        $sheet->setCellValue('F1', 'Pilihan B');
        $sheet->setCellValue('G1', 'jawaban_img B');
        $sheet->setCellValue('H1', 'Pilihan C');
        $sheet->setCellValue('I1', 'jawaban_img C');
        $sheet->setCellValue('J1', 'Pilihan D');
        $sheet->setCellValue('K1', 'jawaban_img D');
        $sheet->setCellValue('L1', 'Pilihan E');
        $sheet->setCellValue('M1', 'jawaban_img E');
        $sheet->setCellValue('N1', 'Kunci');
        $sheet->setCellValue('O1', 'Pembahasan');
        $sheet->setCellValue('P1', 'pembahasan_img');
        $sheet->setCellValue('Q1', 'kolom_id');
        $sheet->setCellValue('R1', 'clue');
        $sheet->setCellValue('S1', 'typesoal');

        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2E7D32'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ];
        $sheet->getStyle('A1:S1')->applyFromArray($headerStyle);

        // Auto size
        foreach (range('A', 'S') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Example row
        $sheet->setCellValue('A2', '1');
        $sheet->setCellValue('B2', 'Pertanyaan atau soal di sini.');
        $sheet->setCellValue('C2', 'soal_1.jpg');
        $sheet->setCellValue('D2', 'Jawaban Pilihan A');
        $sheet->setCellValue('E2', 'jawaban_a_1.jpg');
        $sheet->setCellValue('F2', 'Jawaban Pilihan B');
        $sheet->setCellValue('G2', 'jawaban_b_1.jpg');
        $sheet->setCellValue('H2', 'Jawaban Pilihan C');
        $sheet->setCellValue('I2', 'jawaban_c_1.jpg');
        $sheet->setCellValue('J2', 'Jawaban Pilihan D');
        $sheet->setCellValue('K2', 'jawaban_d_1.jpg');
        $sheet->setCellValue('L2', 'Jawaban Pilihan E (boleh kosong)');
        $sheet->setCellValue('M2', 'jawaban_e_1.jpg');
        $sheet->setCellValue('N2', 'A');
        $sheet->setCellValue('O2', 'Penjelasan atau pembahasan soal di sini.');
        $sheet->setCellValue('P2', 'pembahasan_1.jpg');
        $sheet->setCellValue('Q2', '1');
        $sheet->setCellValue('R2', 'A B C D E');
        $sheet->setCellValue('S2', 'text');

        $filename = 'Template_Import_Soal.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function importExcel()
    {
        if ($this->session->get("user_nm") == "") {
            return json_encode(['status' => 'error', 'message' => 'Sesi Anda telah habis. Silakan login kembali.']);
        }

        $materi_id = $this->request->getPost('materi_id');
        $group_id = $this->request->getPost('group_id');
        $file = $this->request->getFile('file_excel');

        if (!$materi_id || !$group_id) {
            return json_encode(['status' => 'error', 'message' => 'Materi dan Group Soal harus dipilih.']);
        }

        if (!$file || !$file->isValid()) {
            return json_encode(['status' => 'error', 'message' => 'File Excel tidak ditemukan atau tidak valid.']);
        }

        $ext = $file->getClientExtension();
        if (!in_array($ext, ['xls', 'xlsx'])) {
            return json_encode(['status' => 'error', 'message' => 'Format file harus berupa .xls atau .xlsx.']);
        }

        try {
            $reader = null;
            if ($ext === 'xls') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($file->getTempName());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();
            
            if (count($rows) <= 1) {
                return json_encode(['status' => 'error', 'message' => 'File Excel kosong atau hanya berisi header.']);
            }

            if (count($rows[0]) < 16) {
                return json_encode(['status' => 'error', 'message' => 'Format kolom Excel tidak sesuai. Harus ada minimal 16 kolom. Download template excel yang baru.']);
            }

            $colIndexMap = [
                'no_soal' => 0,
                'soal_nm' => 1,
                'soal_img' => 2,
                'pilihan_a' => 3,
                'jawaban_img_a' => 4,
                'pilihan_b' => 5,
                'jawaban_img_b' => 6,
                'pilihan_c' => 7,
                'jawaban_img_c' => 8,
                'pilihan_d' => 9,
                'jawaban_img_d' => 10,
                'pilihan_e' => 11,
                'jawaban_img_e' => 12,
                'kunci' => 13,
                'pembahasan' => 14,
                'pembahasan_img' => 15,
                'kolom_id' => 16,
                'clue' => 17,
                'typesoal' => 18,
            ];

            // Auto-detect column indexes from header if available
            foreach ($rows[0] as $idx => $headerText) {
                $clean = strtolower(trim(preg_replace('/[^a-zA-Z0-9]/', '', (string)$headerText)));
                if ($clean === 'nosoal' || $clean === 'no') $colIndexMap['no_soal'] = $idx;
                if ($clean === 'soal' || $clean === 'pertanyaan') $colIndexMap['soal_nm'] = $idx;
                if ($clean === 'soalimg' || $clean === 'gambarsoal') $colIndexMap['soal_img'] = $idx;
                if ($clean === 'pilihana' || $clean === 'opsia') $colIndexMap['pilihan_a'] = $idx;
                if ($clean === 'jawabanimga' || $clean === 'gambarjawabana') $colIndexMap['jawaban_img_a'] = $idx;
                if ($clean === 'pilihanb' || $clean === 'opsib') $colIndexMap['pilihan_b'] = $idx;
                if ($clean === 'jawabanimgb' || $clean === 'gambarjawabanb') $colIndexMap['jawaban_img_b'] = $idx;
                if ($clean === 'pilihanc' || $clean === 'opsic') $colIndexMap['pilihan_c'] = $idx;
                if ($clean === 'jawabanimgc' || $clean === 'gambarjawabanc') $colIndexMap['jawaban_img_c'] = $idx;
                if ($clean === 'pilihand' || $clean === 'opsid') $colIndexMap['pilihan_d'] = $idx;
                if ($clean === 'jawabanimgd' || $clean === 'gambarjawaband') $colIndexMap['jawaban_img_d'] = $idx;
                if ($clean === 'pilihane' || $clean === 'opsie') $colIndexMap['pilihan_e'] = $idx;
                if ($clean === 'jawabanimge' || $clean === 'gambarjawabane') $colIndexMap['jawaban_img_e'] = $idx;
                if ($clean === 'kunci' || $clean === 'kuncijawaban') $colIndexMap['kunci'] = $idx;
                if ($clean === 'pembahasan' || $clean === 'penjelasan') $colIndexMap['pembahasan'] = $idx;
                if ($clean === 'pembahasanimg' || $clean === 'gambarpembahasan') $colIndexMap['pembahasan_img'] = $idx;
                if ($clean === 'kolomid' || $clean === 'kolom') $colIndexMap['kolom_id'] = $idx;
                if ($clean === 'clue' || $clean === 'petunjuk') $colIndexMap['clue'] = $idx;
                if ($clean === 'typesoal' || $clean === 'tipe' || $clean === 'tipesoal') $colIndexMap['typesoal'] = $idx;
            }

            $validatedRows = [];
            $seenNoSoal = [];

            // Validation loop
            for ($i = 1; $i < count($rows); $i++) {
                $row = $rows[$i];
                
                $isEmptyRow = true;
                foreach ($row as $cellValue) {
                    if ($cellValue !== null && trim($cellValue) !== '') {
                        $isEmptyRow = false;
                        break;
                    }
                }
                if ($isEmptyRow) {
                    continue;
                }

                $no_soal = isset($row[$colIndexMap['no_soal']]) ? trim((string)$row[$colIndexMap['no_soal']]) : '';
                $soal_nm = isset($row[$colIndexMap['soal_nm']]) ? trim((string)$row[$colIndexMap['soal_nm']]) : '';
                $soal_img = isset($row[$colIndexMap['soal_img']]) ? trim((string)$row[$colIndexMap['soal_img']]) : '';
                
                $pilihan_a = isset($row[$colIndexMap['pilihan_a']]) ? trim((string)$row[$colIndexMap['pilihan_a']]) : '';
                $jawaban_img_a = isset($row[$colIndexMap['jawaban_img_a']]) ? trim((string)$row[$colIndexMap['jawaban_img_a']]) : '';
                
                $pilihan_b = isset($row[$colIndexMap['pilihan_b']]) ? trim((string)$row[$colIndexMap['pilihan_b']]) : '';
                $jawaban_img_b = isset($row[$colIndexMap['jawaban_img_b']]) ? trim((string)$row[$colIndexMap['jawaban_img_b']]) : '';
                
                $pilihan_c = isset($row[$colIndexMap['pilihan_c']]) ? trim((string)$row[$colIndexMap['pilihan_c']]) : '';
                $jawaban_img_c = isset($row[$colIndexMap['jawaban_img_c']]) ? trim((string)$row[$colIndexMap['jawaban_img_c']]) : '';
                
                $pilihan_d = isset($row[$colIndexMap['pilihan_d']]) ? trim((string)$row[$colIndexMap['pilihan_d']]) : '';
                $jawaban_img_d = isset($row[$colIndexMap['jawaban_img_d']]) ? trim((string)$row[$colIndexMap['jawaban_img_d']]) : '';
                
                $pilihan_e = isset($row[$colIndexMap['pilihan_e']]) ? trim((string)$row[$colIndexMap['pilihan_e']]) : '';
                $jawaban_img_e = isset($row[$colIndexMap['jawaban_img_e']]) ? trim((string)$row[$colIndexMap['jawaban_img_e']]) : '';
                
                $kunci = isset($row[$colIndexMap['kunci']]) ? strtoupper(trim((string)$row[$colIndexMap['kunci']])) : '';
                $pembahasan = isset($row[$colIndexMap['pembahasan']]) ? trim((string)$row[$colIndexMap['pembahasan']]) : '';
                $pembahasan_img = isset($row[$colIndexMap['pembahasan_img']]) ? trim((string)$row[$colIndexMap['pembahasan_img']]) : '';

                $kolom_id = null;
                if (isset($colIndexMap['kolom_id']) && isset($row[$colIndexMap['kolom_id']])) {
                    $rawKolom = trim((string)$row[$colIndexMap['kolom_id']]);
                    if ($rawKolom !== '') {
                        if (!is_numeric($rawKolom)) {
                            return json_encode(['status' => 'error', 'message' => "Baris $rowNum: kolom_id harus berupa angka."]);
                        }
                        $kolom_id = (int)$rawKolom;
                    }
                }

                $clue = null;
                if (isset($colIndexMap['clue']) && isset($row[$colIndexMap['clue']])) {
                    $rawClue = trim((string)$row[$colIndexMap['clue']]);
                    if ($rawClue !== '') {
                        $clue = $rawClue;
                    }
                }

                $typesoal = null;
                if (isset($colIndexMap['typesoal']) && isset($row[$colIndexMap['typesoal']])) {
                    $rawType = trim((string)$row[$colIndexMap['typesoal']]);
                    if ($rawType !== '') {
                        $typesoal = $rawType;
                    }
                }

                $rowNum = $i + 1;

                if ($no_soal === '') {
                    return json_encode(['status' => 'error', 'message' => "Baris $rowNum: Nomor Soal tidak boleh kosong."]);
                }
                if (!is_numeric($no_soal)) {
                    return json_encode(['status' => 'error', 'message' => "Baris $rowNum: Nomor Soal harus berupa angka."]);
                }
                $no_soal = (int)$no_soal;

                if ($soal_nm === '' && $soal_img === '') {
                    return json_encode(['status' => 'error', 'message' => "Baris $rowNum: Teks Soal atau Gambar Soal tidak boleh kosong."]);
                }

                if (($pilihan_a === '' && $jawaban_img_a === '') || 
                    ($pilihan_b === '' && $jawaban_img_b === '')) {
                    return json_encode(['status' => 'error', 'message' => "Baris $rowNum: Pilihan A dan B tidak boleh kosong (harus diisi teks atau nama file gambar)."]);
                }

                if (!in_array($kunci, ['A', 'B', 'C', 'D', 'E', 'Y', 'T'])) {
                    return json_encode(['status' => 'error', 'message' => "Baris $rowNum: Kunci jawaban harus berupa A, B, C, D, atau E."]);
                }

                $optionsMapCheck = [
                    'A' => ['text' => $pilihan_a, 'img' => $jawaban_img_a],
                    'B' => ['text' => $pilihan_b, 'img' => $jawaban_img_b],
                    'C' => ['text' => $pilihan_c, 'img' => $jawaban_img_c],
                    'D' => ['text' => $pilihan_d, 'img' => $jawaban_img_d],
                    'E' => ['text' => $pilihan_e, 'img' => $jawaban_img_e],
                ];

                if (isset($optionsMapCheck[$kunci])) {
                    if ($optionsMapCheck[$kunci]['text'] === '' && $optionsMapCheck[$kunci]['img'] === '') {
                        return json_encode(['status' => 'error', 'message' => "Baris $rowNum: Kunci jawaban adalah $kunci, tetapi pilihan $kunci kosong."]);
                    }
                }

                $seenKey = ($kolom_id !== null ? $kolom_id . '_' : '') . $no_soal;
                if (in_array($seenKey, $seenNoSoal)) {
                    $msg = $kolom_id !== null 
                        ? "Baris $rowNum: Nomor Soal $no_soal untuk kolom_id $kolom_id duplikat di dalam file Excel."
                        : "Baris $rowNum: Nomor Soal $no_soal duplikat di dalam file Excel.";
                    return json_encode(['status' => 'error', 'message' => $msg]);
                }
                $seenNoSoal[] = $seenKey;

                $dbCheck = $this->soalmodel->getSoalByNoSoalGrpMtri($no_soal, $group_id, $materi_id, $kolom_id)->getResult();
                if (count($dbCheck) > 0) {
                    $msg = $kolom_id !== null 
                        ? "Baris $rowNum: Nomor Soal $no_soal (kolom_id $kolom_id) sudah terdaftar di database untuk materi dan group ini."
                        : "Baris $rowNum: Nomor Soal $no_soal sudah terdaftar di database untuk materi dan group ini.";
                    return json_encode(['status' => 'error', 'message' => $msg]);
                }

                $validatedRows[] = [
                    'no_soal' => $no_soal,
                    'kolom_id' => $kolom_id,
                    'clue' => $clue,
                    'typesoal' => $typesoal,
                    'soal_nm' => $soal_nm,
                    'soal_img' => $soal_img,
                    'options' => [
                        'A' => ['text' => $pilihan_a, 'img' => $jawaban_img_a],
                        'B' => ['text' => $pilihan_b, 'img' => $jawaban_img_b],
                        'C' => ['text' => $pilihan_c, 'img' => $jawaban_img_c],
                        'D' => ['text' => $pilihan_d, 'img' => $jawaban_img_d],
                        'E' => ['text' => $pilihan_e, 'img' => $jawaban_img_e]
                    ],
                    'kunci' => $kunci,
                    'pembahasan' => $pembahasan,
                    'pembahasan_img' => $pembahasan_img
                ];
            }

            if (empty($validatedRows)) {
                return json_encode(['status' => 'error', 'message' => 'Tidak ada data soal yang valid ditemukan di dalam file Excel.']);
            }

            $db = \Config\Database::connect();
            $db->transBegin();

            $successCount = 0;
            foreach ($validatedRows as $vRow) {
                $soalData = [
                    'soal_nm' => $vRow['soal_nm'],
                    'group_id' => $group_id,
                    'no_soal' => $vRow['no_soal'],
                    'kunci' => $vRow['kunci'],
                    'materi' => $materi_id,
                    'soal_img' => $vRow['soal_img'] !== '' ? $vRow['soal_img'] : null,
                    'pembahasan_img' => $vRow['pembahasan_img'] !== '' ? $vRow['pembahasan_img'] : null,
                    'pembahasan' => $vRow['pembahasan'],
                    'status_cd' => 'normal'
                ];
                if ($vRow['kolom_id'] !== null) {
                    $soalData['kolom_id'] = $vRow['kolom_id'];
                }
                if ($vRow['clue'] !== null) {
                    $soalData['clue'] = $vRow['clue'];
                }
                if ($vRow['typesoal'] !== null) {
                    $soalData['typesoal'] = $vRow['typesoal'];
                }

                $soal_id = $this->soalmodel->simpansoal($soalData);

                if (!$soal_id) {
                    $db->transRollback();
                    return json_encode(['status' => 'error', 'message' => 'Gagal menyimpan soal nomor ' . $vRow['no_soal']]);
                }

                foreach ($vRow['options'] as $pilihan => $optData) {
                    $jawaban_nm = $optData['text'];
                    $jawaban_img = $optData['img'];

                    if ($jawaban_nm === '' && $jawaban_img === '') {
                        continue;
                    }

                    $jawabanData = [
                        'soal_id' => $soal_id,
                        'jawaban_nm' => $jawaban_nm,
                        'pilihan_nm' => $pilihan,
                        'jawaban_img' => $jawaban_img !== '' ? $jawaban_img : null,
                        'status_cd' => 'normal'
                    ];

                    $this->jawabanmodel->simpanjawaban($jawabanData);
                }

                $successCount++;
            }

            if ($db->transStatus() === FALSE) {
                $db->transRollback();
                return json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan transaksi saat menyimpan data ke database.']);
            }

            $db->transCommit();
            return json_encode([
                'status' => 'success',
                'message' => 'Berhasil mengimpor ' . $successCount . ' soal beserta kunci dan pembahasan.'
            ]);

        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function downloadTemplateSK()
    {
        if ($this->session->get("user_nm") == "") {
            return redirect('/');
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Header khusus Sikap Kerja: no_soal, soal, kunci, clue, kolom_id, typesoal
        $sheet->setCellValue('A1', 'no_soal');
        $sheet->setCellValue('B1', 'soal');
        $sheet->setCellValue('C1', 'kunci');
        $sheet->setCellValue('D1', 'clue');
        $sheet->setCellValue('E1', 'kolom_id');
        $sheet->setCellValue('F1', 'typesoal');

        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '0277BD'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ];
        $sheet->getStyle('A1:F1')->applyFromArray($headerStyle);

        // Auto size
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Example rows
        $sheet->setCellValue('A2', '1');
        $sheet->setCellValue('B2', 'DLIS');
        $sheet->setCellValue('C2', 'D');
        $sheet->setCellValue('D2', 'ISDKL');
        $sheet->setCellValue('E2', '1');
        $sheet->setCellValue('F2', 'text');

        $sheet->setCellValue('A3', '2');
        $sheet->setCellValue('B3', 'SDKL');
        $sheet->setCellValue('C3', 'A');
        $sheet->setCellValue('D3', 'ISDKL');
        $sheet->setCellValue('E3', '1');
        $sheet->setCellValue('F3', 'text');

        $sheet->setCellValue('A4', '1');
        $sheet->setCellValue('B4', 'EQRT');
        $sheet->setCellValue('C4', 'B');
        $sheet->setCellValue('D4', 'QWERT');
        $sheet->setCellValue('E4', '2');
        $sheet->setCellValue('F4', 'text');

        $filename = 'Template_Import_Sikap_Kerja.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function importExcelSK()
    {
        if ($this->session->get("user_nm") == "") {
            return json_encode(['status' => 'error', 'message' => 'Sesi Anda telah habis. Silakan login kembali.']);
        }

        $materi_id = $this->request->getPost('materi_id');
        $group_id = $this->request->getPost('group_id');
        $file = $this->request->getFile('file_excel');

        if (!$materi_id || !$group_id) {
            return json_encode(['status' => 'error', 'message' => 'Materi dan Group Soal harus dipilih.']);
        }

        if (!$file || !$file->isValid()) {
            return json_encode(['status' => 'error', 'message' => 'File Excel tidak ditemukan atau tidak valid.']);
        }

        $ext = $file->getClientExtension();
        if (!in_array($ext, ['xls', 'xlsx'])) {
            return json_encode(['status' => 'error', 'message' => 'Format file harus berupa .xls atau .xlsx.']);
        }

        try {
            $reader = null;
            if ($ext === 'xls') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($file->getTempName());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();
            
            if (count($rows) <= 1) {
                return json_encode(['status' => 'error', 'message' => 'File Excel kosong atau hanya berisi header.']);
            }

            if (count($rows[0]) < 5) {
                return json_encode(['status' => 'error', 'message' => 'Format kolom Excel tidak sesuai. Minimal harus ada kolom no_soal, soal, kunci, clue, dan kolom_id. Download template excel Sikap Kerja.']);
            }

            $colIndexMap = [
                'no_soal' => 0,
                'soal' => 1,
                'kunci' => 2,
                'clue' => 3,
                'kolom_id' => 4,
                'typesoal' => 5,
            ];

            // Auto-detect column indexes from header if available
            foreach ($rows[0] as $idx => $headerText) {
                $clean = strtolower(trim(preg_replace('/[^a-zA-Z0-9]/', '', (string)$headerText)));
                if ($clean === 'nosoal' || $clean === 'no') $colIndexMap['no_soal'] = $idx;
                if ($clean === 'soal' || $clean === 'soalnm' || $clean === 'pertanyaan') $colIndexMap['soal'] = $idx;
                if ($clean === 'kunci' || $clean === 'kuncijawaban' || $clean === 'jawaban') $colIndexMap['kunci'] = $idx;
                if ($clean === 'clue' || $clean === 'petunjuk' || $clean === 'karakter') $colIndexMap['clue'] = $idx;
                if ($clean === 'kolomid' || $clean === 'kolom') $colIndexMap['kolom_id'] = $idx;
                if ($clean === 'typesoal' || $clean === 'tipe' || $clean === 'tipesoal') $colIndexMap['typesoal'] = $idx;
            }

            $validatedRows = [];
            $seenNoSoal = [];

            for ($i = 1; $i < count($rows); $i++) {
                $row = $rows[$i];
                
                $isEmptyRow = true;
                foreach ($row as $cellValue) {
                    if ($cellValue !== null && trim($cellValue) !== '') {
                        $isEmptyRow = false;
                        break;
                    }
                }
                if ($isEmptyRow) {
                    continue;
                }

                $kolom_id = isset($row[$colIndexMap['kolom_id']]) ? trim((string)$row[$colIndexMap['kolom_id']]) : '';
                $no_soal = isset($row[$colIndexMap['no_soal']]) ? trim((string)$row[$colIndexMap['no_soal']]) : '';
                $clue = isset($row[$colIndexMap['clue']]) ? trim((string)$row[$colIndexMap['clue']]) : '';
                $soal_nm = isset($row[$colIndexMap['soal']]) ? trim((string)$row[$colIndexMap['soal']]) : '';
                $kunci = isset($row[$colIndexMap['kunci']]) ? strtoupper(trim((string)$row[$colIndexMap['kunci']])) : '';
                $typesoal = (isset($colIndexMap['typesoal']) && isset($row[$colIndexMap['typesoal']]) && trim((string)$row[$colIndexMap['typesoal']]) !== '')
                    ? trim((string)$row[$colIndexMap['typesoal']]) 
                    : 'text';

                $rowNum = $i + 1;

                if ($kolom_id === '') {
                    return json_encode(['status' => 'error', 'message' => "Baris $rowNum: kolom_id tidak boleh kosong."]);
                }
                if (!is_numeric($kolom_id)) {
                    return json_encode(['status' => 'error', 'message' => "Baris $rowNum: kolom_id harus berupa angka."]);
                }
                $kolom_id = (int)$kolom_id;

                if ($no_soal === '') {
                    return json_encode(['status' => 'error', 'message' => "Baris $rowNum: Nomor Soal tidak boleh kosong."]);
                }
                if (!is_numeric($no_soal)) {
                    return json_encode(['status' => 'error', 'message' => "Baris $rowNum: Nomor Soal harus berupa angka."]);
                }
                $no_soal = (int)$no_soal;

                if ($clue === '') {
                    return json_encode(['status' => 'error', 'message' => "Baris $rowNum: Kolom Clue (panduan huruf/gambar) tidak boleh kosong."]);
                }

                if ($soal_nm === '') {
                    return json_encode(['status' => 'error', 'message' => "Baris $rowNum: Kolom Soal tidak boleh kosong."]);
                }

                if (!in_array($kunci, ['A', 'B', 'C', 'D', 'E', 'Y', 'T'])) {
                    return json_encode(['status' => 'error', 'message' => "Baris $rowNum: Kunci jawaban harus berupa A, B, C, D, atau E."]);
                }

                $seenKey = $kolom_id . '_' . $no_soal;
                if (in_array($seenKey, $seenNoSoal)) {
                    return json_encode(['status' => 'error', 'message' => "Baris $rowNum: Nomor Soal $no_soal untuk kolom_id $kolom_id duplikat di dalam file Excel."]);
                }
                $seenNoSoal[] = $seenKey;

                $dbCheck = $this->soalmodel->getSoalByNoSoalGrpMtri($no_soal, $group_id, $materi_id, $kolom_id)->getResult();
                if (count($dbCheck) > 0) {
                    return json_encode(['status' => 'error', 'message' => "Baris $rowNum: Nomor Soal $no_soal (kolom_id $kolom_id) sudah terdaftar di database untuk materi dan group ini."]);
                }

                $validatedRows[] = [
                    'kolom_id' => $kolom_id,
                    'no_soal' => $no_soal,
                    'clue' => $clue,
                    'soal_nm' => $soal_nm,
                    'kunci' => $kunci,
                    'typesoal' => $typesoal,
                ];
            }

            if (empty($validatedRows)) {
                return json_encode(['status' => 'error', 'message' => 'Tidak ada data soal yang valid ditemukan di dalam file Excel.']);
            }

            $db = \Config\Database::connect();
            $db->transBegin();

            $successCount = 0;
            foreach ($validatedRows as $vRow) {
                $soalData = [
                    'soal_nm' => $vRow['soal_nm'],
                    'group_id' => $group_id,
                    'no_soal' => $vRow['no_soal'],
                    'kunci' => $vRow['kunci'],
                    'materi' => $materi_id,
                    'kolom_id' => $vRow['kolom_id'],
                    'clue' => $vRow['clue'],
                    'typesoal' => $vRow['typesoal'],
                    'sk_group_id' => 0,
                    'status_cd' => 'normal'
                ];

                $soal_id = $this->soalmodel->simpansoal($soalData);

                if (!$soal_id) {
                    $db->transRollback();
                    return json_encode(['status' => 'error', 'message' => 'Gagal menyimpan soal nomor ' . $vRow['no_soal'] . ' kolom ' . $vRow['kolom_id']]);
                }

                // Simpan 1 baris jawaban untuk Sikap Kerja (pilihan_nm = 'ABCDE', jawaban_nm = clue)
                $jawabanData = [
                    'soal_id' => $soal_id,
                    'jawaban_nm' => $vRow['clue'],
                    'pilihan_nm' => 'ABCDE',
                    'jawaban_img' => '',
                    'status_cd' => 'normal'
                ];

                $this->jawabanmodel->simpanjawaban($jawabanData);

                $successCount++;
            }

            if ($db->transStatus() === FALSE) {
                $db->transRollback();
                return json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan transaksi saat menyimpan data ke database.']);
            }

            $db->transCommit();
            return json_encode(['status' => 'success', 'message' => "Berhasil mengimpor $successCount soal Sikap Kerja."]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

}