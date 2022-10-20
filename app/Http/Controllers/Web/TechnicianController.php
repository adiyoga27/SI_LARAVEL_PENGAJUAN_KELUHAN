<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Technician\StoreTechnicianRequest;
use App\Models\TaskTechnician;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TechnicianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Technician::all();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('datatables._action_dinamyc', [
                        'model'           => $data,
                        'delete'          => route('technician.destroy', $data->id),
                        'edit'          => route('technician.edit', $data->id),
                        'confirm_message' =>  'Anda akan menghapus data "' . $data->name . '" ?',
                        'padding'         => '85px',
                    ]);
                })
                ->addColumn('status', function ($data) {
                    return $this->checkAvaibaleTechnician($data->id);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('technician');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTechnicianRequest $request)
    {
        try {
            DB::beginTransaction();
            Technician::create($request->all());
            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $technician = Technician::find($id);

        return response()->json([
            'status' => true,
            'data' => $technician
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $technician = Technician::find($id);

        return response()->json([
            'status' => true,
            'data' => $technician
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTechnicianRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $technician = Technician::find($id);
            $technician->update($request->all());
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Technician::destroy($id);
            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th);
        }
    }

    public function checkAvaibaleTechnician($technician_id)
    {
        $task = TaskTechnician::where('technician_id', $technician_id)->whereHas('task', function ($query) {
            $query->where('status', 'progress');
        })->first();

        if ($task) {
            return false;
        }

        return true;
    }

    public function getTechnician()
    {
        $technicians = Technician::all();


        return response()->json([
            'status' => true,
            'data' => $technicians
        ]);
    }
}
