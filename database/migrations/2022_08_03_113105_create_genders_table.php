<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Gender;

class CreateGendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->timestamps();
        });

        //An array of gender
        $genders =  array(
            [
                'name' => 'Male',
            ],
            [
                'name' => 'Female',
            ],
        );

    //Insert gengers
    foreach ($genders as $gender){
                $new_gender = new Gender();
                $new_gender->name =$gender['name'];
                $new_gender->save();
            }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genders');
    }
}
