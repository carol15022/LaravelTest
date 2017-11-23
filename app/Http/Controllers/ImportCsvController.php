<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

class ImportCsvController extends Controller
{
    public function import()
    {
        return view('importCsv');
    }

    public function importCsv()
    {
        if(Input::hasFile('import_file')){
            $file = Input::file("import_file");
            $fileName = $file->getClientOriginalName();


            if (File::exists('/public/csvfiles') == false){
                $path = public_path('csvfiles');
                File::makeDirectory($path, 0777, true, true);
            }

            var_dump($file->move($path, $fileName));
        }

        return redirect()->route('products.index');

    }
}
