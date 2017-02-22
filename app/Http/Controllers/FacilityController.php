<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use Excel;
use Illuminate\Support\Facades\Log;

class FacilityController extends Controller
{
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

/**
'bcg',
'opv',
'penta',
'pneumo',
'rota',
'measles_rubella',
'yellow_fever',
'meningitis_a',
'vitamin_a_dose',
'nutrition_services',
'phone',
'email'

 */
                       // Log::info($data);

                        if(!empty($value)){

                          if(!empty($value['coordinates'])){

                              $item = new Facility();


                                $item->region = $value['region'] == null ? '' : $value['region'] ;
                                $item->district = $value['district']== null ? '' : $value['district'] ;
                                $item->sub_district = $value['sub_district'] ==null ? '' : $value['sub_district'] ;

                                $item->facility = $value['facility'] == null ? '' : $value['facility'] ;
                                $item->coordinates = $value['coordinates'] == null ? '[0,0]' :  $value['coordinates'] ;

                                 $item->bcg = $value['bcg'];
                                $item->opv = $value['opv'];
                                $item->penta = $value['penta'];
                                $item->pneumo = $value['pneumo'];
                                $item->rota = $value['rota'];
                                $item->measles_rubella = $value['measles_rubella'];
                                $item->yellow_fever = $value['yellow_fever'];
                                $item->meningitis_a = $value['meningitis_a'];
                                $item->vitamin_a_dose = $value['vitamin_adose'];
                                $item->nutrition_services = $value['nutritionservices'];
                                $item->phone = $value['phone'] == null ? '' :  $value['phone'] ;
                                $item->email = $value['email'] == null ? '' :  $value['email'] ;


                                $item->save();

                             // Log::info($value['region']. $value['measles_rubella']);

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
    public function getAllFacilities(){


       $facilities = Facility::all();



        return $facilities;

       /* return Response::json(array(
                'error' => false,
                'merchants' => $facilities->toArray())
        );*/


    }
}
