<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DataTables;

class UserController extends Controller
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
            $data = DB::table('users')->where('email', '<>', auth()->user()->email)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editUser">Edit</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  
                           data-name="' . $row->name . '"
                           data-id="' . $row->id . '" 
                           data-original-title="Delete" class="btn btn-danger btn-sm deleteUser">Delete</a>';
                    return $btn;
                })
                ->addColumn('jenis_kelamin', function ($row) {
                    if ($row->jenis_kelamin == 'P') {
                        return 'Perempuan';
                    } else if ($row->jenis_kelamin == 'L') {
                        return 'Laki Laki';
                    }
                    return $row->jenis_kelamin;
                })
                ->addColumn('role', function ($row) {
                    $role_text = '<p class=text-capitalize>' . $row->role . '</p>';
                    return $role_text;
                })
                ->rawColumns(['role', 'jenis_kelamin', 'action'])
                ->make(true);
        }
        return view('superadmin.user.index');
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
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->telepon = $request->telepon;
        $user->password = Hash::make($request->password);
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->alamat = $request->alamat;
        $user->role = $request->role;
        $user->created_at = date('Y-m-d H:i:s');
        // $user->updated_at = date('Y-m-d H:i:s');

        $user->save();


        // $newUser = DB::table('users')->where('email', $request->email)->first();

        //return response()->json($newUser);

        // if($request->role == 'admin') {
        //     DB::table('admins')->insert([
        //         'id_user' => $newUser->id,
        //     ]);
        //     return response()->json(['success'=>'User saved successfully.']);
        // } else if($request->role == 'bendahara') {
        //     DB::table('bendaharas')->insert([
        //         'id_user' => $newUser->id,
        //     ]);
        //     return response()->json(['success'=>'User saved successfully.']);
        // }

        return response()->json(['success' => 'User saved successfully.']);
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
        $User = DB::table('users')->find($id);
        return response()->json($User);
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

        $user = User::find($id);
        if($user->email != $request->email) {
            $this->validate($request, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->telepon = $request->telepon;
        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }
        if ($request->role != '') {
            $user->role = $request->role;
        }
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->alamat = $request->alamat;

        $user->updated_at = date('Y-m-d H:i:s');

        try {
            $user->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                // $this->flashError('Data Gagal Di Simpan. Karena Email sudah digunakan');
                return response()->json(['error' => 'Email Sudah digunakan.']);
            }
        }

        // $user->save();

        return response()->json(['success' => 'User saved successfully.']);
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
        DB::table('users')->where('id', $id)->delete();

        return response()->json(['success' => 'User deleted successfully.']);
    }
}
