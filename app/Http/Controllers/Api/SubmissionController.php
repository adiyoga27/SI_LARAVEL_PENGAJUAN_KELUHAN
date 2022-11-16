<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Submission\StoreSubmissionRequest;
use App\Http\Resources\SubmissionResource;
use App\Models\Task;
use App\Models\TaskImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $taks = Task::with('images')->where('user_id', $request->user()->id)->get();
        return SubmissionResource::collection($taks)->additional([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
        ]);
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
    public function store(StoreSubmissionRequest $request)
    {
        try {
            DB::beginTransaction();

            $submission = Task::create([
                'user_id' => $request->user()->id,
                'nik' =>  $request->user()->nik,
                'name' => $request->user()->name,
                'title' => $request->title,
                'description' => $request->description,
                'complaint_village' => $request->complaint_village,
                'hp' => $request->hp,
                'latitude' => $request->latitude,
                'longtitude' => $request->longitude,
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $image = $image->store('submission', 'public');
                    TaskImage::create([
                        'task_id' => $submission->id,
                        'url' => $image,
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'message' => 'Berhasil membuat pengaduan',
                'data' => $submission
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal membuat pengaduan',
                'error' => $th->getMessage()
            ], 500);
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
        $task = Task::with('images')->find($id);
        return response()->json([
            'status' => true,
            'message' => 'Berhasil mengambil data',
            'data' => new SubmissionResource($task)
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }

    public function news()
    {
        $news = Task::where('status', '!=', 'pending')->get();
        return SubmissionResource::collection($news)->additional([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
        ]);
    }
}
