<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AnimalController extends Controller
{
    public $animals = ['ikan', 'ayam', 'kucing'];
    /**
     * Provision a new web server.
     *
     * @return \Illuminate\Http\Response
     */
    function index()
    {
        foreach ($this->animals as $animal){
            echo "$animal <br>";
        }
    }
    function store(Request $request)
    {
        echo "Menambahkan data hewan <br>";
        array_push($this->animals, $request->nama);
        $this->index();
    }
    function update(Request $request, $id)
    {
        echo "Mengedit data hewan <br>";
        // untuk mengedit data
        $this->animal[$id] = $request->nama;
        $this->index();
    }
    function destroy($id)
    {
        // untuk menghapus data
        unset($this->animal[$id], $index); 
        echo "Menghapus data animals id $id";
        $this->index();
        
    }
}