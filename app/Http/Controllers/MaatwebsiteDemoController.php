<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Excel;
use Illuminate\Support\Facades\Log;

class MaatwebsiteDemoController extends Controller
{

    /**
     * Return View file
     *
     * @var array
     */
    public function importExport()
    {
        return view('importExport');
    }

    /**
     * File Export Code
     *
     * @var array
     */
    public function downloadExcel(Request $request, $type)
    {
        $data = Item::get()->toArray();
        return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    /**
     * Import file into database Code
     *
     * @var array
     */
    public function importExcel(Request $request)
    {

        if($request->hasFile('import_file')){
            $path = $request->file('import_file')->getClientOriginalName();

            $destinationPath = public_path() . '/uploads/';
            $uploadSuccess = $request->file('import_file')->move($destinationPath, $path);

            Log::info($uploadSuccess);


            if (is_readable($destinationPath . $path)) {

                Log::info('File uploaded -> ' . $path . ' :: Processing started...');


                Log::info('File is readable -> ' . $path);


                $data = Excel::load($destinationPath . $path, function($reader) {})->get();

                            if(!empty($data) && $data->count()){

                                 foreach ($data->toArray() as $key => $value) {

/*
 *         $table->string('bcg');
            $table->string('opv');
            $table->string('penta');
            $table->string('pneumo');
            $table->string('rota');


            $table->string('measles_rubella');
            $table->string('yellow_fever');
            $table->string('meningitis_a');
            $table->string('vitamin_a_dose');
            $table->string('nutrition_services');

            $table->string('phone');
            $table->string('email');
 *
 *
 * **/


                                     if(!empty($value)){

                                         if(!empty( $value['coordinates'])){

                                             $item = new Item();


                                             $item->region = $value['region'] == null ? '' : $value['region'] ;
                                             $item->district = $value['district']== null ? '' : $value['district'] ;
                                             $item->sub_district = $value['sub_district'] ==null ? '' : $value['sub_district'] ;

                                             $item->facility = $value['facility'] == null ? '' : $value['facility'] ;
                                             $item->coordinates = $value['coordinates'] == null ? '[0,0]' :  $value['coordinates'] ;

                                         /**    $item->coordinates = $value['coordinates'];
                                             $item->coordinates = $value['coordinates'];
                                             $item->coordinates = $value['coordinates'];
                                             $item->coordinates = $value['coordinates'];
                                             $item->coordinates = $value['coordinates'];
                                             $item->coordinates = $value['coordinates'];
                                             $item->coordinates = $value['coordinates'];
                                             $item->coordinates = $value['coordinates'];
                                             $item->coordinates = $value['coordinates'];
                                             $item->coordinates = $value['coordinates'];
                                             $item->coordinates = $value['coordinates'];**/


                                             $item->save();



                                         }





                                     }
                                 }


                                // if(!empty($insert)){
                                 //  Item::insert($insert);
                                     return back()->with('success','Insert Record successfully.');
                                // }

                             }

            }



        }

        return back()->with('error','Please Check your file, Something is wrong there.');
    }

}