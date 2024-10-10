<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeRequest;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $grades = Grade::all();

        return view('Pages.Grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(StoreGradeRequest $request)
    {

        $grade = new Grade();
        $grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
        $grade->Notes = $request->Notes;
        $grade->save();
        // toastr()->success(trans('messages.success'));
        return redirect()->route('grades.index')-with('success', trans('messages.success'));
    }

    /**
     * Display the specified resource.
     *
     *
     *
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     *
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     *
     *
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {

    }

}

?>
