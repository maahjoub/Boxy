<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Models\Wanted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MembersController extends Controller
{
    public function index()
    {
        $members = Members::withTrashed()->get();
        return view('blade.index', compact(['members']));
    }

    public function add()
    {
        return view('blade.add');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'              => ['required', 'string'],
            'hand'           => ['required', 'numeric', 'between:1,10'],
        ]);
        $this->storeToDataBase($request);
        return redirect('/');
    }

    public function edit($id)
    {
        $member = Members::where('id', $id)->first();
        return view('blade.edit', compact('member'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name'              => ['required', 'string'],
            'hand'           => ['required', 'numeric', 'between:1,10'],
        ]);
        DB::beginTransaction();
        try {
            $member = Members::findOrFail($request->id);
            $member->update([
                'name' => $request->name,
                'hands' => $request->hand,

            ]);
            $wanted = Wanted::where('member_id', $request->id);
            $wanted->update([
                'all_wanted' => ($request->hand * 1000 * 31),
            ]);
            DB::commit();
            return redirect('/');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $Classrooms = Members::findOrFail($id)->delete();
        return redirect('/');
    }

    public function restore($id)
    {
        Members::withTrashed()->find($id)->restore();

        return redirect()->back();
    }

    private function storeToDataBase($request)
    {
        DB::beginTransaction();
        try {
            $member = Members::create([
                'name' => $request->name,
                'hands' => $request->hand,

            ]);
            Wanted::create([
                'member_id' => $member->id,
                'all_wanted' => ($request->hand * 1000 * 31),
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
