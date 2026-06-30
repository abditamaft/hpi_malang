<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('id', 'desc')->get();
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan_id' => 'required|string',
            'pertanyaan_en' => 'required|string',
            'jawaban_id'    => 'required|string',
            'jawaban_en'    => 'required|string',
        ]);

        Faq::create($request->all());

        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pertanyaan_id' => 'required|string',
            'pertanyaan_en' => 'required|string',
            'jawaban_id'    => 'required|string',
            'jawaban_en'    => 'required|string',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update($request->all());

        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil dihapus!');
    }
}