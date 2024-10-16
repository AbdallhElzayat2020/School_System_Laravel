<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionRequest;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
      /**
       * Display a listing of the resource.
       */
      public function index()
      {
            $grades = Grade::with(['Sections'])->get();

            $list_Grades = Grade::all();

            return view('Pages.Sections.sections', compact('grades', 'list_Grades'));
      }
      public function getClasses($id)
      {
            $list_classes = Classroom::where('grade_id', $id)->pluck('Name', 'id');

            return $list_classes;
      }


      /**
       * Store a newly created resource in storage.
       */
      // public function store(StoreSectionRequest $request)
      public function store(StoreSectionRequest $request)
      {
            // return $request;
            try {
                  $sections = new Section();
                  $sections->section_name = ['en' => $request->Name_Section_En, 'ar' => $request->Name_Section_Ar];
                  $sections->grade_id = $request->grade_id;
                  $sections->classroom_id = $request->Class_id;
                  $sections->status = 1;
                  $sections->save();

                  toastr()->success(trans('messages.success'));

                  return redirect()->route('sections.index');
            } catch (\Throwable $th) {
                  return redirect()->back()->withErrors(['error' => $th->getMessage()]);
            }
      }


      /**
       * Update the specified resource in storage.
       */
      public function update(StoreSectionRequest $request)
      {
      //     dd($request->all());
      try {
              $Sections = Section::findOrFail($request->id);
              $Sections->section_name = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
              $Sections->grade_id = $request->grade_id;
              $Sections->classroom_id = $request->Class_id;

              if (isset($request->status)) {
                  $Sections->status = 1;
              } else {
                  $Sections->status = 2;
              }

              $Sections->save();
              toastr()->success(trans('messages.Update'));

              return redirect()->route('sections.index');
          } catch (\Exception $e) {
              return redirect()->back()->withErrors(['error' => $e->getMessage()]);
          }
      }

      /**
       * Remove the specified resource from storage.
       */
      public function destroy(Request $request)
      {
            Section::findOrFail($request->id)->delete();
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('sections.index');
      }
}
