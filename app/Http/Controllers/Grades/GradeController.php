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

    public function store(StoreGradeRequest $request)
    {
        try {
            $grade = new Grade();

            $grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];

            $grade->Notes = $request->Notes;

            $grade->save();

            toastr()->success(__('messages.success'));

            return redirect()->route('grades.index');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update(StoreGradeRequest $request)
    {
        try {

            $Grades = Grade::findOrFail($request->id);

            $Grades->update([

                $Grades->Name = ['ar' => $request->Name, 'en' => $request->Name_en],

                $Grades->Notes = $request->Notes,
            ]);
            toastr()->success(trans('messages.Update'));

            return redirect()->route('grades.index');
        } catch
        (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Request $request)
    {
        $grade = Grade::findOrFail($request->id);

        $grade->delete();

        toastr()->success(__('messages.Delete'));

        return redirect()->route('grades.index');

    }

}
