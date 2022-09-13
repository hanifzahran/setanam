<?php

namespace App\View\Components\layout;

use Illuminate\View\Component;

class sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data =   [
            "sidebarData" =>[
                [
                    "key" => "kategori",
                    "name" => "Kategori",
                    "data" => ["Tanaman","Layanan","Item perawatan"]
                ],
                [
                    "key" => "lokasi",
                    "name" => "Lokasi",
                    "data" => ["Jakarta","Surabaya","Bandung"]
                ],
                [
                    "key" => "harga",
                    "name" => "Harga",
                    "data" => ["Di atas 10K","Di bawah 10K"]
                ],
                [
                    "key" => "cahaya",
                    "name" => "Intensitas Cahaya",
                    "data" =>  ["Tinggi","Sedang","Rendah"]
                ],
            ],
            "newUrl" => url()->full()
        ];
        return view('components.layout.sidebar',$data);
    }
}
