<?php

namespace App\Http\Controllers;

use App\Models\makanan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {
        $data=User::orderby('id','desc',)->paginate(10);
        return view('admin.users', compact('data'));
    }

    public function deleteusers($id)
    {
        $data=User::find($id);
        $data->delete();
        return redirect()->back()->with('success','Data berhasil dihapus!');
    }

    public function editusersview($id)
    {
        $data=User::find($id);
        return view("admin.editusers",compact("data"));
    }

    public function editusers(request $request, $id)
    {
        $data=User::find($id);

        $data->name=$request->name;
        $data->email=$request->email;

        $data->save();

        return redirect()->route('users')->with('success', 'Data berhasil diedit!');
    }

    public function menumakanan()
    {
        $data=makanan::all();
        return view("admin.menumakanan", compact("data"));
    }
    public function tambahmakanan()
    {
        return view("admin.tambahmakanan");
    }

    public function uploadmakanan(request $request)
    {
        $data=new makanan;

        $gambar=$request->gambar;
        $imagename =time().'.'.$gambar->getClientOriginalExtension();
             $request->gambar->move('foodimage',$imagename);

             $data->gambar=$imagename;

             $data->nama=$request->nama;
             $data->harga=$request->harga;
             $data->deskripsi=$request->deskripsi;

        $data->save();

        return redirect()->back();
    }

    public function deletemenu($id)
    {
        $data=makanan::find($id);
        $data->delete();
        return redirect()->back()->with('succes','Data Berhasil dihapus!');
    }

    public function editmakanan($id)
    {
        $data=makanan::find($id);
        return view("admin.editview",compact("data"));
    }

    public function edit(request $request, $id)
    {
        $data=makanan::find($id);

        $gambar=$request->gambar;

        $imagename =time().'.'.$gambar->getClientOriginalExtension();
            $request->gambar->move('foodimage',$imagename);

            $data->gambar=$imagename;

            $data->nama=$request->nama;
            $data->harga=$request->harga;
            $data->deskripsi=$request->deskripsi;

            $data->save();

            return redirect()->back();
    }

}
