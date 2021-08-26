<?php namespace App\Libraries;
//https://www.petanikode.com/codeigniter4-view-cell/

class Wijet
{

    /*public function recentBerita()
    {
        return view('wijet/berita_sekarang');
    }*/

    public function recentBerita(array $params)
    {
        return view('wijet/berita_sekarang', $params);
    }
}