<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Santri;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = DB::table('santris')->join('madrasahs', 'santris.id_madrasah', 'madrasahs.id')
                                        ->join('ribaths', 'santris.id_ribath', 'ribaths.id')
                                        ->select('santris.*', 'madrasahs.nama as nama_madrasah', 'ribaths.nama as nama_ribath')
                                        ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editsantri">Edit</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  
                           data-name="' . $row->nama . '"
                           data-id="' . $row->id . '" 
                           data-original-title="Delete" class="btn btn-danger btn-sm deletesantri">Delete</a>';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    if($row->status == '1') {
                        return 'Aktif';
                    } else if($row->status == '0') {
                        return 'Tidak Aktif';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        $list_madrasah = DB::table('madrasahs')->get();
        $list_ribath = DB::table('ribaths')->get();

        return view('superadmin.santri.index', compact('list_madrasah', 'list_ribath'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $count_santri_by_year = DB::table('santris')->where('tahun_masuk', $request->tahun_masuk)->count();
        $santri = new Santri();
        $nisn = $request->tahun_masuk.'.'.$request->id_ribath.'.'.$request->id_madrasah.'.'.($count_santri_by_year+1);
        $santri->nama = $request->nama;
        $santri->tahun_masuk = $request->tahun_masuk;
        $santri->id_madrasah = $request->id_madrasah;
        $santri->id_ribath = $request->id_ribath;
        $santri->nisn = $nisn;
        $santri->created_at = date('Y-m-d H:i:s');
        // $santri->updated_at = date('Y-m-d H:i:s');

        $santri->save();

        return response()->json(['success' => 'santri saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $santri = DB::table('santris')->find($id);
        return response()->json($santri);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $santri = Santri::find($id);
        $santri->nama = $request->nama;
        $santri->tahun_masuk = $request->tahun_masuk;
        $santri->id_madrasah = $request->id_madrasah;
        $santri->id_ribath = $request->id_ribath;
        $santri->nisn = $request->nisn;
        // $santri->kode = $request->kode;

        $santri->updated_at = date('Y-m-d H:i:s');

        try {
            $santri->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                // $this->flashError('Data Gagal Di Simpan. Karena Email sudah digunakan');
                return response()->json(['error' => 'Email Sudah digunakan.']);
            }
        }

        // $santri->save();

        return response()->json(['success' => 'santri saved successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::table('santris')->where('id', $id)->delete();

        return response()->json(['success' => 'santri deleted successfully.']);
    }
}
