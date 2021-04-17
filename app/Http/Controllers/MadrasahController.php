<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Madrasah;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class MadrasahController extends Controller
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
            $data = DB::table('madrasahs')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editMadrasah">Edit</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  
                           data-name="' . $row->nama . '"
                           data-id="' . $row->id . '" 
                           data-original-title="Delete" class="btn btn-danger btn-sm deleteMadrasah">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('superadmin.madrasah.index');
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

        $madrasah = new Madrasah();
        $madrasah->nama = $request->nama;
        $madrasah->kepala = $request->kepala;
        $madrasah->ttd = $request->ttd;
        $madrasah->stempel = $request->stempel;
        $madrasah->nip = $request->nip;
        $madrasah->created_at = date('Y-m-d H:i:s');
        // $madrasah->updated_at = date('Y-m-d H:i:s');

        $madrasah->save();

        return response()->json(['success' => 'Madrasah saved successfully.']);
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
        $madrasah = DB::table('madrasahs')->find($id);
        return response()->json($madrasah);
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

        $madrasah = Madrasah::find($id);
        $madrasah->nama = $request->nama;
        $madrasah->kepala = $request->kepala;
        $madrasah->ttd = $request->ttd;
        $madrasah->stempel = $request->stempel;
        $madrasah->nip = $request->nip;

        $madrasah->updated_at = date('Y-m-d H:i:s');

        try {
            $madrasah->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                // $this->flashError('Data Gagal Di Simpan. Karena Email sudah digunakan');
                return response()->json(['error' => 'Email Sudah digunakan.']);
            }
        }

        // $madrasah->save();

        return response()->json(['success' => 'Madrasah saved successfully.']);
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
        DB::table('madrasahs')->where('id', $id)->delete();

        return response()->json(['success' => 'Madrasah deleted successfully.']);
    }
}
