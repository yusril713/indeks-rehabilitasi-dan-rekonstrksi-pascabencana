<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Provinsi;
use Livewire\Component;

class Country extends Component
{
    public $selectProv;
    public $selectKab;
    public $selectKec;
    public $selectKel;

    public $listKab = [];
    public $listKec = [];
    public $listKel = [];

    public function render()
    {
        if(!empty($this->selectKec)) {
            $this->listKel = Kelurahan::where('id_kec', $this->selectKec)->orderBy('nama')->get();
        }
        if(!empty($this->selectKab)) {
            $this->listKec = Kecamatan::where('id_kab', $this->selectKab)->orderBy('nama')->get();
        }
        if(!empty($this->selectProv)) {
            $this->listKab = Kabupaten::where('id_prov', $this->selectProv)->orderBy('nama')->get();
        }

        return view('livewire.admin.country')
            ->withCountries(Provinsi::orderBy('nama')->get());
    }
}
