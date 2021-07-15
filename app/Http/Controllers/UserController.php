<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
    User
};
use DataTables;
use App\Http\Requests\UserPostRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = "
                    <div class='row'>
                        <a href='" . route('user.edit', $row->id) . "' class='btn btn-primary ml-2'>Edit</a>
                        <form method='POST' action='" . route('user.destroy', $row->id) . "' class='col-md-4'>
                            <div class='row'>
                                " . csrf_field() . "
                                <input type='hidden' name='_method' value='DELETE'>
                                <button type='submit' class='btn btn-danger ml-2'>Hapus</button>
                            </div>
                        </form>
                    </div>
                    ";
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin-master.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-master.user.input');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPostRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->get('password'));

        User::create($data);

        flash('Data berhasil ditambah')->success();
        return redirect()->route('user.index');
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
        return view('admin-master.user.input', [
            'user' => User::findOrFail($id)
        ]);
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
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'role' => 'required'
        ]);

        $data = [
            'name' => $request->get('name'),
            'phone_number' => $request->get('phone_number'),
            'role' => $request->get('role'),
        ];

        if ($request->get('password')) {
            $data['password'] = Hash::make($request->get('password'));
        }

        User::where('id', $id)->update($data);

        flash('Data berhasil diupdate')->success();
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        flash('Data berhasil dihapus')->error();
        return redirect()->route('user.index');
    }
}
