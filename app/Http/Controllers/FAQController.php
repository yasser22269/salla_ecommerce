<?php

namespace App\Http\Controllers;

use App\Http\Requests\FAQRequest;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        if ($keyword) {
            $faqs = FAQ::search($keyword);
        } else {
            $faqs = FAQ::all();
        }

        return view('faqs.index', compact('faqs', 'keyword'));
    }

    public function create()
    {
        return view('faqs.create');
    }

    public function store(FAQRequest $request)
    {
        FAQ::create($request->validated());
        return redirect()->route('faqs.index')->with('success', 'FAQ created successfully.');
    }

    public function show(FAQ $faq)
    {
        return view('faqs.show', compact('faq'));
    }

    public function edit(FAQ $faq)
    {
        return view('faqs.edit', compact('faq'));
    }

    public function update(FAQRequest $request, FAQ $faq)
    {
        $faq->update($request->validated());
        return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(FAQ $faq)
    {
        $faq->delete();
        return redirect()->route('faqs.index')->with('success', 'FAQ deleted successfully.');
    }


}
