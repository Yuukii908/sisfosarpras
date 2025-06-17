<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with('user')->latest()->paginate(15);
        return view('admin.loans.index', compact('loans'));
    }

    public function show(Loan $loan)
    {
        $loan->load('user', 'approver');
        return view('admin.loans.show', compact('loan'));
    }

    public function approve(Request $request, Loan $loan)
    {
        if ($loan->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Peminjaman ini sudah diproses sebelumnya.');
        }

        $request->validate([
            'admin_notes' => 'nullable|string|max:500'
        ]);

        $loan->update([
            'status' => 'approved',
            'admin_notes' => $request->admin_notes,
            'approved_by' => Auth::id(),
            'approved_at' => now()
        ]);

        return redirect()->route('admin.loans.index')
            ->with('success', 'Peminjaman berhasil disetujui.');
    }

    public function reject(Request $request, Loan $loan)
    {
        if ($loan->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Peminjaman ini sudah diproses sebelumnya.');
        }

        $request->validate([
            'admin_notes' => 'required|string|max:500'
        ]);

        $loan->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
            'approved_by' => Auth::id(),
            'approved_at' => now()
        ]);

        return redirect()->route('admin.loans.index')
            ->with('success', 'Peminjaman berhasil ditolak.');
    }

    public function markReturned(Loan $loan)
    {
        if ($loan->status !== 'approved') {
            return redirect()->back()
                ->with('error', 'Hanya peminjaman yang disetujui yang bisa ditandai sebagai dikembalikan.');
        }

        $loan->update(['status' => 'returned']);

        return redirect()->route('admin.loans.index')
            ->with('success', 'Peminjaman berhasil ditandai sebagai dikembalikan.');
    }
}