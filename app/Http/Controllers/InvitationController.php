<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function index(Request $request)
    {
        return view('invitation', [
            'w'      => config('wedding'),
            'guest'  => trim((string) $request->query('to', '')),
            'wishes' => Wish::latest()->take(50)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:60'],
            'attendance' => ['required', 'in:hadir,tidak,ragu'],
            'guests'     => ['nullable', 'integer', 'min:1', 'max:5'],
            'message'    => ['required', 'string', 'max:300'],
        ], [
            'name.required'    => 'Nama wajib diisi.',
            'message.required' => 'Ucapan wajib diisi.',
            'message.max'      => 'Ucapan maksimal 300 karakter.',
        ]);

        Wish::create($data);

        return redirect()->to(route('invitation') . '#ucapan')
            ->with('ok', 'Terima kasih, ucapanmu sudah terkirim.');
    }
}