<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        return view('admin-master.profile.edit', [
            'user' => User::findOrFail(auth()->user()->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $id = auth()->user()->id;

        $request->validate([
            'name' => 'required',
            'phone_number' => 'required'
        ]);

        $data = [
            'name' => $request->get('name'),
            'phone_number' => $request->get('phone_number')
        ];

        if ($request->get('password')) {
            $data['password'] = Hash::make($request->get('password'));
        }

        User::where('id', $id)->update($data);

        flash('Data berhasil diupdate')->success();
        return redirect()->route('profile');
    }
}
