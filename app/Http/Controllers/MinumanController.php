<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use App\Models\Minuman;
use App\Models\Penjual;
use Illuminate\Http\Request;

class MinumanController extends Controller
{
    public function index(){
        return view('menu.index',[
            'minumen' => Minuman::all(),
            'makanans' => Makanan::all(),
            'title' => 'Minuman'
        ]);
    }

    public function create(){
        return view('menu.create_mn',[
            'penjuals' => Penjual::all(),
            'title' => 'Makanan'
        ]);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'nama'=> 'required|string|max:100',
            'rasa' => 'required|string|max:100',
            'harga' => 'required|int',
            'penjual_id' => 'required'
        ]);

        Minuman::create($validateData);

        return redirect('/minuman')->with('success', 'Minuman Berhasil Ditambah');
    }

    public function show(Minuman $id){
        return view('menu.read_mn', [
            'minumen'=> $id,
            'title' => 'Minuman',
        ]);
    }

    public function edit(Minuman $id){
        return view('menu.edit_mn', [
            'title' => 'Minuman',
            'penjuals' => Penjual::all(),
            'minumen' => $id
        ]);
    }

    public function update(Request $request, $id){
        $minuman = Minuman::findOrFail($id);
        $validateData = $request->validate([
            'nama'=> 'required|string|max:100',
            'rasa' => 'required|string|max:100',
            'harga' => 'required|int',
            'penjual_id' => 'required'
        ]);
        $minuman->update($validateData);

        return redirect('/minuman')->with('success', 'Minuman Berhasil Diedit');
    }

    public function destroy($id){
        $minuman = Minuman::findOrFail($id);
        $minuman->delete();

        return redirect('/minuman')->with('succes', 'Minuman Berhasil Dihapus');
    }
}
