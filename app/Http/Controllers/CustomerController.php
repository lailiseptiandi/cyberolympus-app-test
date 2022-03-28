<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'DESC')->simplePaginate(10);
        return view('dashboard.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sortir(Request $request)
    {
        $name = $request->name;
        $customers = Customer::orderBy('nama', 'ASC')->simplePaginate(10);
        return view('dashboard.customer.index', compact('customers'));
    }
    public function search(Request $request)
    {
        $search = $request->search;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $customers = Customer::where('nama', 'LIKE', '%' . $search . '%')
            ->orWhere(function ($query) use ($start_date, $end_date) {
                $query->whereBetween('created_at', [$start_date, $end_date])
                    ->orWhereBetween('updated_at', [$start_date, $end_date]);
            })
            ->orderBy('created_at')
            ->simplePaginate(10);

        return view('dashboard.customer.index', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customers = Customer::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]
        );

        return response()->json(
            [
                'success' => true
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = array('id' => $request->id);
        $customers = Customer::where($id)->first();
        return response()->json($customers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        // dd($request->all());
        $id = array('id' => $request->id);
        $customers = Customer::where($id)->first();
        return response()->json($customers);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $customers = Customer::where('id', $request->id)->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
