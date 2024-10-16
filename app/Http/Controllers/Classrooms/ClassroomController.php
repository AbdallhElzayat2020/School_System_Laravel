<?php

namespace App\Http\Controllers\Classrooms;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::all();
        $classes = Classroom::all();
        return view('Pages.Classesrooms.classes', compact('classes', 'grades'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(StoreClassRequest $request)
    {

        $List_Classes = $request->List_Classes;

        try {

            // $validated = $request->validated();
            foreach ($List_Classes as $List_Class) {

                $My_Classes = new Classroom();

                $My_Classes->Name = ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']];

                $My_Classes->grade_id = $List_Class['grade_id'];

                $My_Classes->save();

            }

            toastr()->success(trans('messages.success'));

            return redirect()->route('classrooms.index');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }






    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        try {
            $Classrooms = Classroom::findOrFail($request->id);

            $Classrooms->update([
                'Name' => ['ar' => $request->Name, 'en' => $request->Name_en],
                'grade_id' => $request->grade_id,
            ]);

            toastr()->success(trans('messages.Update'));

            return redirect()->route('classrooms.index');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $Classrooms = Classroom::findOrFail($request->id);

        $Classrooms->delete();

        toastr()->success(trans('messages.Delete'));

        return redirect()->route('classrooms.index');
    }

    public function Filter_Classes(Request $request)
    {
        $grades = Grade::all();

        $Search = Classroom::select('*')->where('grade_id','=',$request->grade_id)->get();

        return view('Pages.Classesrooms.classes',compact('grades'))->withDetails($Search);
    }
}
