<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\KelasModel;

use App\Controllers\BaseController;

class KelasController extends BaseController
{
    public $kelasModel;

    protected $helpers=['Form'];

    public function __construct(){
        $this->kelasModel = new KelasModel();
    }

    public function index()
    {
        $data = [
            'title' => 'List Kelas',
            'kelas' => $this->kelasModel->getKelas(),
        ];
        return view('list_kelas', $data);
    }

    public function create()
    {   
        $data =[
            'title'=>'Create Kelas',            
        ];
        return view('create_kelas', $data);
    }

    public function store()
    {
        if(!$this->validate([
            'nama_kelas' => [
                'rules' => 'required|is_unique[kelas.nama_kelas]',
                'errors' => [
                    'required' => '{field} harus di isi!!',
                    'is_unique' => 'kelas sudah ada!!'
                ]
            ], 
            'daya_tampung' => [
                'rules' => 'required|integer',
                'errors'=> [
                    'required' => '{field} harus di isi!!',
                    'integer' => 'di isi dengan integer!'
                ]
            ],       
        ])){
            
            return redirect()->back()->withInput();
        }
        $data =[
            'nama_kelas'=>$this->request->getVar('nama_kelas'),
            'daya_tampung'=>$this->request->getVar('daya_tampung'),
        ];
        $this->kelasModel->saveKelas($data);

        return redirect() ->to('/kelas');
    }

    public function edit($id)
    {
        $kelas = $this->kelasModel->getKelas($id);

        $data = [
            'title' => 'Edit Kelas',
            'kelas' => $kelas,
        ];

        return view('edit_kelas', $data);
    }

    public function update($id)
    {
        $kelas_awal = $this->kelasModel->getKelas($id);

        if($kelas_awal['nama_kelas'] == $this->request->getVar('nama_kelas')){
            $is_unique = '';
        }
        else{
            $is_unique = '|is_unique[kelas.nama_kelas]';
        }

        if(!$this->validate([
            
            'nama_kelas' => [
                'rules' => 'required'.$is_unique,
                'errors' => [
                    'required' => '{field} harus di isi!!',
                    'is_unique' => 'kelas sudah ada!!'
                ]
            ],
            'daya_tampung' => [
                'rules' => 'required|integer',
                'errors'=> [
                    'required' => '{field} harus di isi!!',
                    'integer' => 'di isi dengan integer!'
                ]
            ],          
        ])){
            
            return redirect()->back()->withInput();
        }

        $data = [
            'nama_kelas'  => $this->request->getVar('nama_kelas'),
            'daya_tampung' => $this->request->getVar('daya_tampung'),
        ];

        $result = $this->kelasModel->updateKelas($data, $id);

        if(!$result){
            return redirect()->back()->withInput()
                ->with('error', 'Gagal Menyimpan data');
        }

        return redirect()->to(base_url('/kelas'));
    }

    public function destroy($id)
    {
        $result = $this->kelasModel->deleteKelas($id);
        if(!$result){
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
        return redirect()->to(base_url('/kelas'))
            ->with('success', 'Berhasil menghapus data');
    }
}
