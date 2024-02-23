<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnalyticsRequest;
use App\Models\Analytics;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        $analyticsData = Analytics::all();
        return view('analytics.index', compact('analyticsData'));
    }

    public function create()
    {
        return view('analytics.create');
    }

    public function store(AnalyticsRequest $request)
    {
        Analytics::create($request->validated());
        return redirect()->route('analytics.index')->with('success', 'Analytics data created successfully.');
    }

    public function show(Analytics $analyticsData)
    {
        return view('analytics.show', compact('analyticsData'));
    }

    public function edit(Analytics $analyticsData)
    {
        return view('analytics.edit', compact('analyticsData'));
    }

    public function update(AnalyticsRequest $request, Analytics $analyticsData)
    {
        $analyticsData->update($request->validated());
        return redirect()->route('analytics.index')->with('success', 'Analytics data updated successfully.');
    }

    public function destroy(Analytics $analyticsData)
    {
        $analyticsData->delete();
        return redirect()->route('analytics.index')->with('success', 'Analytics data deleted successfully.');
    }
}
