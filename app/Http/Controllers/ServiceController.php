<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicesRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view("Dashboard.Services.index", compact('services'));
    }

    public function store(ServicesRequest $request)
    {
        $service = new Service();
        $service->name = $request->name;
        $service->price = $request->price;
        $service->description = $request->description;
        $service->save();

        return redirect()->route('Services.index')
                         ->with('success', 'تم إضافة الخدمة بنجاح');
    }

    public function update(ServicesRequest $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();

        return redirect()->route('Services.index')
                         ->with('success', 'تم تحديث الخدمة بنجاح');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('Services.index')
                         ->with('success', 'تم حذف الخدمة بنجاح');
    }
}
