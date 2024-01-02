<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateScheduleRequest;
use App\Http\Requests\StoreScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return ScheduleResource::collection(Schedule::all()->load('subject'));
    }
    public function create()
    {
        return view('pages.schedule.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScheduleRequest $request)
    {
        Schedule::create([
            'subject_id'=>$request['subject_id'],
            'hari' => $request['hari'],
            'jam_mulai'=>$request['jam_mulai'],
            'jam_selesai'=>$request['jam_selesai'],
            'ruangan'=>$request['ruangan'],
            'kode_absensi'=>$request['kode_absensi'],
            'tahun_akademik'=>$request['tahun_akademik'],
            'semester'=>$request['semester'],
            'created_by'=>$request['created_by'],
            'updated_by'=>$request['updated_by'],
            'deleted_by'=>$request['deleted_by']
        ]);

        return redirect(route('schedule.index'))->with('success', 'data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        return view('pages.schedule.edit')->with('schedules', $schedule);
    }
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $validate = $request->validated();
        $schedule->update($validate);
        return redirect()->route('schedule.index')->with('success', 'Edited Schedule Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedule.index')->with('success','Delete schedule succesfully');
    }
}
