<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Client;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\DataTables;

class SalariesController extends Controller
{

    public function index()
    {
        if (!auth()->user()->can('salary-view')) {
            session()->flash('flash_message_warning', __('You do not have permission to view this page'));
            return redirect()->back();
        }
        $users = User::get();
        return view('salaries.index')->with('users', $users);
    }

    public function create()
    {
        $users = null;
        if (auth()->user()->can('salary-manage')) {
            $users = User::with(['department'])->get()->pluck('nameAndDepartmentEagerLoading', 'external_id');
        }
        return view('salaries.create')
            ->withUsers($users);
    }

    public function store(Request $request)
    {
        $medical_certificate = null;
        $user = auth()->user();
        if ($request->user_external_id && auth()->user()->can('salary-manage')) {
            $user = User::whereExternalId($request->user_external_id)->first();
            if (!$user) {
                Session::flash('flash_message_warning', __('Could not find user'));
                return redirect()->back();
            }
        }
        if ($request->medical_certificate == true) {
            $medical_certificate = true;
        } elseif ($request->medical_certificate == false) {
            $medical_certificate = false;
        }

        Salary::create([
            'external_id' => Uuid::uuid4()->toString(),
            'reason' => $request->reason,
            'user_id' => $user->id,
            'start_at' => Carbon::parse($request->start_date)->startOfDay(),
            'end_at' => Carbon::parse($request->end_date)->endOfDay(),
            'medical_certificate' => $medical_certificate,
            'comment' => clean($request->comment),
        ]);

        Session::flash('flash_message', __('Salary registered'));
        return redirect()->back();
    }

    public function destroy(Salary $salary)
    {
        if (!auth()->user()->can('salary-manage')) {
            Session::flash('flash_message_warning', __('You do not have sufficient privileges for this action'));
            return redirect()->back();
        }
        $salary->delete();

        return response("OK");
    }
}

