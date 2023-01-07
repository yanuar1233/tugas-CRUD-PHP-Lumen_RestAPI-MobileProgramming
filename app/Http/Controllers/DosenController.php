<?php

namespace App\Http\Controllers;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    private $dbdosen;

    public function __construct(){
        $dbdosen = DB::table('tb_dosen');
     }
 
     public function index(){
         $request = app('db')->select('select * from tb_dosen');
         return response()->json($request);
     }
 
     public function getOne($id){
         $tb_dosen = $this->dbdosen->find($id);
         if(!$tb_dosen){
             return response()->json([
                 'status' => 'sukses',
                 'message' => 'Matkul '.$id.'tidak ditemukan'
             ], 404);
         }
         return response()->json($tb_dosen);
     }
 
     public function deleteOne($id){
         $deldosen = $this->dbmatkul->where('id', $id)->delete();
         if($del == 0){
             return response()->json([
                 'status' => 'gagal',
                 'message' => 'id matkul tidak ditemukan'],
                 404);
         }
 
         return response()->json([
             'status' => 'sukses',
             'message' => 'matkul dengan id'.$id.'berhasil dihapus']);
     }
 
     public function addOne(Request $request){
         $insertdosen = $this->dbdosen->insertGetId([
            //  'id' => $request->input('id'),
             'nama' => $request->input('nama'),
             'sks' => $request->input('sks'),
             'dosen' => $request->input('dosen'),
         ]);
         return response()->json([
             'status' => 'sukses',
             'message' => 'berhasil menambahkan matkul',
             'id' => $insertdosen
         ]);
     }
 
     public function updateOne(Request $request, $id){
     $updateData = [
        'nama' => $request->input('nama'),
        'sks' => $request->input('sks'),
        'dosen' => $request->input('dosen')];
     $updatedosen =$this->dbdosen
                        ->where('id',$id)
                        ->update($updateData);

    if($updatedosen == 0){
        return response()->json([
            'status' => 'gagal',
            'message' => 'id matkul tidak ditemukan'],
            404);
    }
     return redirect ('index');
     }
 }