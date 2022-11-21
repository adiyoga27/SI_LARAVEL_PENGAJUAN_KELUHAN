<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskTechnician;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller
{
    public function show($id)
    {
        $tasks = Task::with('technician')->find($id);
        return response()->json([
            'status' => true,
            'data' => $tasks
        ]);
    }
    public function pending(Request $request)
    {

        if ($request->ajax()) {
            $data = Task::where('status', 'pending')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('datatables._action_dinamyc', [
                        'model'           => $data,
                        'view'          => url('tasks/view/' . $data->id),
                        'padding'         => '85px',
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('task');
    }
    public function progress(Request $request)
    {
        if ($request->ajax()) {
            $data = Task::where('status', 'progress')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('datatables._action_dinamyc', [
                        'model'           => $data,
                        'done'          => url('tasks/done/' . $data->id),
                        'view'          => url('tasks/view/' . $data->id),

                        'confirm_message' =>  'Pengajuan "' . $data->title . '" telah selesai ditanganin ?',

                        'padding'         => '85px',
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('task');
    }
    public function history(Request $request)
    {
        if ($request->ajax()) {
            $data = Task::where('status', 'success')->orWhere('status', 'reject')->orWhere('status', 'progress')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('datatables._action_dinamyc', [
                        'model'           => $data,
                        'view'          => url('tasks/view/' . $data->id),
                        'padding'         => '85px',
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('task');
    }

    public function view($id)
    {
        $technicians = Technician::all();

        $task = Task::with('technician')->find($id);
        return view('task-view', compact(['task', 'technicians']));
    }

    public function approve(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $task = Task::find($id);
            $task->status = 'progress';

            $task->save();

            TaskTechnician::where('task_id', $id)->get()->each->delete();
            foreach ($request->listTechnician as $key => $value) {
                TaskTechnician::create([
                    'task_id' => $id,
                    'technician_id' => $value['technician']
                ]);
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Task berhasil di approve',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json([
                'message' => false,
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function reject(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $task = Task::find($id);
            $task->status = 'reject';
            $task->reject_note = $request->reject_note;
            $task->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Task berhasil di reject',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json([
                'message' => false,
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function done(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $task = Task::find($id);
            $task->update([
                'status' => 'success',
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil di approve');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', "Gagal Approve Data");
        }
    }
}
