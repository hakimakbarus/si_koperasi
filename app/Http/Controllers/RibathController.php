<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ribath;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RibathController extends Controller
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
            $data = DB::table('ribaths')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editRibath">Edit</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  
                           data-name="' . $row->nama . '"
                           data-id="' . $row->id . '" 
                           data-original-title="Delete" class="btn btn-danger btn-sm deleteRibath">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('superadmin.ribath.index');
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

        $ribath = new Ribath();
        $ribath->nama = $request->nama;
        // $ribath->kode = $request->kode;
        $ribath->created_at = date('Y-m-d H:i:s');
        // $ribath->updated_at = date('Y-m-d H:i:s');

        $ribath->save();

        return response()->json(['success' => 'Ribath saved successfully.']);
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
        $ribath = DB::table('ribaths')->find($id);
        return response()->json($ribath);
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

        $ribath = Ribath::find($id);
        $ribath->nama = $request->nama;
        // $ribath->kode = $request->kode;

        $ribath->updated_at = date('Y-m-d H:i:s');

        try {
            $ribath->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                // $this->flashError('Data Gagal Di Simpan. Karena Email sudah digunakan');
                return response()->json(['error' => 'Email Sudah digunakan.']);
            }
        }

        // $ribath->save();

        return response()->json(['success' => 'Ribath saved successfully.']);
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
        DB::table('ribaths')->where('id', $id)->delete();

        return response()->json(['success' => 'Ribath deleted successfully.']);
    }
}
