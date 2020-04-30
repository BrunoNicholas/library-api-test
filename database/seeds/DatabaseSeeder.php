<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\UserBook;
use App\Models\Book;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $location = 'files/csv';
        $filename = "library-mgt-books.csv";

        // Import CSV to Database
        $filepath = public_path($location."/".$filename);

        // Reading file
        $file = fopen($filepath,"r");

        $importData_arr = array();
        $i = 0;

        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
             $num = count($filedata );
             
            // Skip first row (Remove below comment if you want to skip the first row)
            /*
            if($i == 0){
                $i++;
                continue; 
                }
            */
            for ($c=0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata [$c];
            }
            $i++;
        }
        fclose($file);

        // Insert to MySQL database 
        $a = 0;
        foreach($importData_arr as $importData){
            if ($a != 0) {
                $insertBook 		= new Book();
                $insertBook->title 	= $importData[10];
                $insertBook->original_title = $importData[9];
                $insertBook->publication_year = $importData[8] ? $importData[8] : 2020;
                $insertBook->isbn 	= $importData[5];
                $insertBook->language_code = $importData[11];
                $insertBook->image 	= $importData[21];
                $insertBook->thumbnail = $importData[22];
                $insertBook->average_rating = $importData[12];
                $insertBook->total_ratings = $importData[13];
                $insertBook->save();

                $usercheck = User::where('email',explode(' ', trim($importData[7]))[0] . '@email.com')->get();
                
                if(sizeof($usercheck) < 1){
	                $insertUser = new User();
	                $insertUser->name  		= explode(',', trim($importData[7]))[0];
	                $insertUser->email   	= explode(' ', trim($importData[7]))[0] . '@email.com';
	                $insertUser->password  	= Hash::make('dollar');
	                $insertUser->save();
	            }
            }
            ++$a;
        }

        // $this->call(UsersTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
