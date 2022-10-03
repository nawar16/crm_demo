<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Client;
use App\Models\User;
use App\Http\Requests\Salary\StoreSalayRequest;

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

    public function store(StoreSalayRequest $request)
    {
        $user = auth()->user();
        if ($request->user_external_id && auth()->user()->can('salary-manage')) {
            $user = User::whereExternalId($request->user_external_id)->first();
            if (!$user) {
                Session::flash('flash_message_warning', __('Could not find user'));
                return redirect()->back();
            }
            if(!is_null($user->salary($request->month)->first()))
            {
                Session::flash('flash_message_warning', __('Salary for this month and user already assigned'));
                return redirect()->back();
            }
        }

        Salary::create([
            'user_id' => $user->id,
            'month'   => $request->month,
            'basic_salary' => $request->salary
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

