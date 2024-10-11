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
        if (Grade::where('Name->ar', $request->Name)->orWhere('Name->en', $request->Name_en)->exists()) {
            return redirect()->back()->withErrors(['error' => __('grades.Already_Exist')]);
        }

        try {
            $grade = new Grade();

            $grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];

            $grade->Notes = $request->Notes;

            $grade->save();

            toastr()->success(__('messages.success'));

            return redirect()->route('grades.index');

        } catch (\Throwable $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update(StoreGradeRequest $request)
    {
        if ($request->id) {
            $grade = Grade::where('Name->ar', $request->Name)->orWhere('Name->en', $request->Name_en)->first();

            if ($grade && $grade->id != $request->id) {
                return redirect()->back()->withErrors(['error' => __('grades.Already_Exist')]);
            }
        } else {
            if (Grade::where('Name->ar', $request->Name)->orWhere('Name->en', $request->Name_en)->exists()) {
                return redirect()->back()->withErrors(['error' => __('grades.Already_Exist')]);
            }

        }
        try {
            $id = $request->id;

            $grade = Grade::findOrFail($id);

            $grade->update([

                $grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name],

                $grade->Notes = $request->Notes
            ]);


            toastr()->success(__('messages.success'));

            return redirect()->route('grades.index');

        } catch (\Throwable $th) {

            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
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
