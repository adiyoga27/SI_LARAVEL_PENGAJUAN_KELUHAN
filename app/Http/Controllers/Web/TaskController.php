<?php

namespace App\Http\Controllers\Web;

use App\Exports\TaskExport;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskTechnician;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
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
                        // 'done'          => url('tasks/done/' . $data->id),
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
    public function schedule(Request $request)
    {
        if ($request->ajax()) {
            $start_at = now()->startOfMonth();
            $end_at = now()->endOfMonth();
            if (isset($request->start_at)) {
                $start_at = $request->start_at;
            }
            if (isset($request->end_at)) {
                $end_at = $request->end_at;
            }
            $data = Task::where('start_at', '>=', $start_at)
                ->where('end_at', '<=', $end_at)
                ->where(fn ($q) => $q->where('status', 'progress')->orWhere('status', 'success'))
                ->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('datatables._action_dinamyc', [
                        'model'           => $data,
                        // 'done'          => url('tasks/done/' . $data->id),
                        'view'          => url('tasks/view/' . $data->id),

                        'confirm_message' =>  'Pengajuan "' . $data->title . '" telah selesai ditanganin ?',

                        'padding'         => '85px',
                    ]);
                })
                ->addColumn('technisianName', function ($data) {
                    $technisians = $data->technician;
                    $technisianName = '';
                    foreach ($technisians as $technisian) {
                        $technisianName .= $technisian->technician?->name . ', ';
                    }
                    return $technisianName;
                })
                ->addColumn('name', function ($data) {
                    return $data->name ?? "";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('schedule');
    }
    public function report(Request $request)
    {
        if ($request->ajax()) {
            $start_at = now()->startOfMonth();
            $end_at = now()->endOfMonth();
            if (isset($request->start_at)) {
                $start_at = $request->start_at;
            }
            if (isset($request->end_at)) {
                $end_at = $request->end_at;
            }
            $data = Task::where('start_at', '>=', $start_at)
                ->where('end_at', '<=', $end_at)
                ->where('status', 'success')
                ->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('datatables._action_dinamyc', [
                        'model'           => $data,
                        // 'done'          => url('tasks/done/' . $data->id),
                        'view'          => url('tasks/view/' . $data->id),

                        'confirm_message' =>  'Pengajuan "' . $data->title . '" telah selesai ditanganin ?',

                        'padding'         => '85px',
                    ]);
                })
                ->addColumn('technisianName', function ($data) {
                    $technisians = $data->technician;
                    $technisianName = '';
                    foreach ($technisians as $technisian) {
                        $technisianName .= $technisian->technician->name . ', ';
                    }
                    return $technisianName;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('report');
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
            $task->start_at = $request->start_date;
            $task->end_at = $request->end_date;
            $task->save();

            TaskTechnician::where('task_id', $id)->get()->each->delete();
            foreach ($request->listTechnician as $key => $value) {
                TaskTechnician::create([
                    'task_id' => $id,
                    'technician_id' => $value
                ]);
            }

            DB::commit();
            return redirect('tasks/pending')->with('success', 'Pengajuan berhasil di approve');
            // return redirect()->back()->with('success', 'Task berhasil di approve');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', "Task Gagal Approve Data");
        }
    }

    public function finish(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $task = Task::find($id);
            $task->status = 'success';
            $task->finish_note = $request->finish_note;
            $task->save();


            DB::commit();
            return redirect('tasks/progress')->with('success', 'Pengajuan berhasil di approve');
            // return redirect()->back()->with('success', 'Task successfully finished');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
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
            return redirect('tasks/progress')->with('success', 'Task berhasil di approve');
            // return redirect()->back()->with('success', 'Data berhasil di approve');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', "Gagal Approve Data");
        }
    }

    public function export(Request $request)
    {
        $start_at = now()->startOfMonth();
        $end_at = now()->endOfMonth();
        if (isset($request->start_at)) {
            $start_at = $request->start_at;
        }
        if (isset($request->end_at)) {
            $end_at = $request->end_at;
        }
        return Excel::download(new TaskExport($start_at, $end_at), 'task-export.xlsx');
    }
}
