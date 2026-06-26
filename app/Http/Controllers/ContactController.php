<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'telepon' => 'required|regex:/^[0-9]{10,15}$/',
            'message' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorType = 4; // generic
            if ($errors->has('name') || $errors->has('email') || $errors->has('telepon') || $errors->has('message')) {
                if ($request->filled('name') && $request->filled('email') && $request->filled('telepon') && $request->filled('message')) {
                    if ($errors->has('email')) {
                        $errorType = 2; // email invalid
                    } elseif ($errors->has('telepon')) {
                        $errorType = 3; // telepon invalid
                    }
                } else {
                    $errorType = 1; // empty fields
                }
            }

            return redirect()->route('home', ['error' => $errorType])->withInput();
        }

        Pesan::create([
            'nama' => $request->name,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'pesan' => $request->message,
            'status' => 'unread',
            'tanggal' => now(),
        ]);

        return redirect()->route('home', ['success' => 1]);
    }
}
