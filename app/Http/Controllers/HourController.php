<?php

namespace App\Http\Controllers;

use App\Models\Hour;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('user'))
        {
            $id = Auth::user()->id;
            $allMyHours = DB::table('hours')->where('user_id' , '=' , $id)->orderByRaw('date DESC')->get();
            return view('user.allHours', compact('allMyHours'));
        }
        if(Auth::user()->hasRole('administrator'))
        {
            $id = Auth::user()->id;
            $allMyHours = DB::table('hours')->where('user_id' , '=' , $id)->orderByRaw('date DESC')->get();
            return view('admin.allHours', compact('allMyHours'));
        }
        if(Auth::user()->hasRole('superadministrator'))
        {
            $id = Auth::user()->id;
            $allMyHours = DB::table('hours')->where('user_id' , '=' , $id)->orderByRaw('date DESC')->get();
            return view('super.allHours', compact('allMyHours'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->hasRole('user'))
        {
            return view ('user.addHour');
        }
        if(Auth::user()->hasRole('administrator'))
        {
            return view('admin.addHour');
        }
        if(Auth::user()->hasRole('superadministrator'))
        {
            return view('super.addHour');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $entry = Hour::where('user_id', '=', $request->user()->id)->where('date', '=', $request->Date)->first();
        if($entry === null) {
            if (Auth::user()->isAbleTo('hour-create')) {
                try {
                    $hour = new Hour();
                    $hour->user_id = $request->user()->id;
                    $hour->date = $request->Date;
                    $hour->hour = $request->Hour;
                    $hour->save();
                    return back()->with('date_added', 'Date and Hour has been Added successfully.');
                } catch (\Exception $exception) {
                    return Redirect::back()->withErrors(['msg', 'The Message']);
                }
            }
        }else{
            return back()->with('date_duplicate', 'THE ENTERED DATE EXIST');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        if(Auth::user()->hasRole('superadministrator'))
        {
            $data = DB::table('hours')->select('id', 'user_id', 'date', 'hour', 'hours.created_at', 'hours.updated_at')->where('user_id', '=', $id)->orderByRaw('date DESC')->get();
            return view ('super.hourdetail', compact('data'));
        }else{
            return back()->with('hasNotPermission', 'YOU DO NOT HAVE ACCESS TO THIS SECTION!!!');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        if(Auth::user()->isAbleTo('hour-update'))
        {
            $date = Hour::find($id);
            if(Auth::user()->hasRole('user'))
            {
                if($date->user_id === Auth::user()->id)
                    return view('user.edit-hour', compact('date'));
                else
                    return back()->with('alert', 'You have no permission to access!!!');
            }elseif(Auth::user()->hasRole('administrator'))
            {
                if($date->user_id === Auth::user()->id)
                    return view('admin.edit-hour', compact('date'));
                else
                    return back()->with('alert', 'You have no permission to access!!!');
            }elseif(Auth::user()->hasRole('superadministrator'))
            {
                if($date->user_id === Auth::user()->id)
                {
                    return view('super.edit-hour', compact('date'));
                }else
                    return view('super.edit-staff-hour', compact('date'));
            }


        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $hour = Hour::find($request->id);
        $hour->hour = $request->Hour;
        $hour->save();
        return back()->with('hour_update', 'Hour has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if(Auth::user()->hasRole('superadministrator'))
        {
                Hour::where('id', $id)->delete();
                return back()->with('hour_deleted', 'Hour has been deleted successfully!');

        }else
            return back()->with('alert_deleted', 'You do not have access to delete hour');

    }

    public function staffHour()
    {
        if(Auth::user()->hasRole('superadministrator'))
        {
            $staffHour = DB::table('users')->join('hours', 'users.id' , '=', 'hours.user_id')->select('users.id', 'users.name', DB::raw('sum(hour) as sum'))
                ->groupBy('users.id')->orderByRaw('user_id ASC')->get();
            return view('super.staffHour', compact('staffHour'));
        }
        else{
            return back()->with('hasNotPermission', 'YOU DO NOT HAVE ACCESS TO THIS SECTION!!!');
        }
    }

}
