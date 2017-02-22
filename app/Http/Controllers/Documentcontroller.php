<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class Documentcontroller extends Controller
{
    public function postUploadCsv()
    {
        $rules = array(
            'file' => 'required',
            'num_records' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        // process the form
        if ($validator->fails())
        {
            return Redirect::to('welcome')->withErrors($validator);
        }
        else
        {
            try {
                Excel::load(Input::file('file'), function ($reader) {

                    foreach ($reader->toArray() as $row) {
                       // User::firstOrCreate($row);
                    }
                });
                //Session::flash('success', 'Users uploaded successfully.');
                return redirect(route('welcome'));
            } catch (\Exception $e) {
                //Session::flash('error', $e->getMessage());
                return redirect(route('welcome'));
            }
        }
    }
}
