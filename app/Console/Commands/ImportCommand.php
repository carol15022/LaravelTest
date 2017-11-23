<?php

namespace App\Console\Commands;

use App\Mail\ConfirmationEmail;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class ImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mystore:importproducts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import a CSV file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $files = File::allFiles('public/csvfiles');

        foreach ($files as $file) {
            $data = null;
            $data = Excel::load($file, function ($reader){})->get();


            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $insert[] = ['name' => $value->name,
                        'category' => $value->category,
                        'price' => $value->price,
                        'description' => $value->description,
                        'image' => $value->image];

                }

                if (!empty($insert)) {
                    DB::table('products')->insert($insert);
                    $insert = null;
                }
            }
            File::delete($file);
        }
        if($files != [])
            Mail::to('user@example.com')->send(new ConfirmationEmail());


    }
}
