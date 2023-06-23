<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Institute;
use App\Models\Payment;
use App\Models\Paymenttype;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@chemtor.com',
            'password' => bcrypt('123456'),
        ]);

        Institute::create([
            'name' => 'DRMC',
            'type' => 'Combine',
        ]);
        
        Institute::create([
            'name' => 'St Joseph',
            'type' => 'Combine',
        ]);
        
        Institute::create([
            'name' => 'Holy Cross',
            'type' => 'Combine',
        ]);
        
        Institute::create([
            'name' => 'VNC',
            'type' => 'Girls',
        ]);
        
        Institute::create([
            'name' => 'Rifles Public',
            'type' => 'Combine',
        ]);
        
        Institute::create([
            'name' => 'Munshi',
            'type' => 'Combine',
        ]);
        
        Institute::create([
            'name' => 'City',
            'type' => 'Combine',
        ]);
        
        Institute::create([
            'name' => 'Adamjee',
            'type' => 'Combine',
        ]);
        
        Institute::create([
            'name' => 'Preparatory',
            'type' => 'Combine',
        ]);
        
        Institute::create([
            'name' => 'City College',
            'type' => 'Boys',
        ]);
        
        Institute::create([
            'name' => 'Others',
            'type' => 'Combine',
        ]);
        
        Institute::create([
            'name' => 'BF SHAHEEN',
            'type' => 'Combine',
        ]);
        
        Institute::create([
            'name' => 'NDC',
            'type' => 'Boys',
        ]);
        
        Institute::create([
            'name' => 'SCHOLORS',
            'type' => 'Combine',
        ]);
        
        Institute::create([
            'name' => 'BSAC',
            'type' => 'Combine',
        ]);



        Course::create([
            'name' => 'Nine'
        ]);

        Course::create([
            'name' => 'Ten'
        ]);

        Course::create([
            'name' => 'HSC 1st Year'
        ]);

        Course::create([
            'name' => 'HSC 2nd Year'
        ]);

        Course::create([
            'name' => 'HSC Model Test -1'
        ]);

        Batch::create([
            'name' => '1',
            'course_id' => 5,
            'capacity' => 30,
            'batch_time' => '7:30 PM', 
            'version'=> 'Bangla'
        ]);
        Batch::create([
            'name' => '2',
            'course_id' => 5,
            'capacity' => 30,
            'batch_time' => '8:30 PM', 
            'version'=> 'Bangla'
        ]);
        Batch::create([
            'name' => '3',
            'course_id' => 5,
            'capacity' => 30,
            'batch_time' => '9:30 AM', 
            'version'=> 'Bangla'
        ]);
        Batch::create([
            'name' => '4',
            'course_id' => 5,
            'capacity' => 30,
            'batch_time' => '10:30 AM', 
            'version'=> 'Bangla'
        ]);
        Batch::create([
            'name' => '5',
            'course_id' => 5,
            'capacity' => 30,
            'batch_time' => '11:30 AM', 
            'version'=> 'Bangla'
        ]);
    
    


        // Student::create([
        //     'id' => 102020001,
        //     'name' => 'John Doe',
        //     'profile_image' => '',
        //     'email' => 'john.doe@example.com',
        //     'phone_number' => '01782267068',
        //     'parents_name' => 'Jane Doe',
        //     'parents_number' => '0987654321',
        //     'institute_id' => 2,
        //     'course_id' => 2,
        //     'gender' => 'Male',
        //     'version' => 'English',
        //     'blood_group' => 'A+',
        //     'status' => 'Active',
        // ]);

        // Student::create( [
        //     'id' => 201010001,
        //     'name' => 'Jane Doe',
        //     'profile_image' => '',
        //     'email' => 'jane.doe@example.com',
        //     'phone_number' => '01924165786',
        //     'parents_name' => 'John Doe',
        //     'parents_number' => '1234567890',
        //     'institute_id' => 1,
        //     'course_id' => 1,
        //     'gender' => 'Female',
        //     'version' => 'Bangla',
        //     'blood_group' => 'B+',
        //     'status' => 'Inactive',
        // ]);

        // Paymenttype::create([
        //     'name' => 'Monthly',
        //     'course_id' => 5,
        //     'category' => 'Monthly',
        //     'payable_amount' => '1500.00'
        // ]);

        Paymenttype::create([
            'name' => 'Admission',
            'course_id' => 5,
            'category' => 'One time',
            'payable_amount' => '1000.00'
        ]);

        // Payment::create([
        //     'student_id' => 102020001,
        //     'paymenttype_id' => 2,
        //     'payable_amount' => 1000.00,
        //     'amount_payed' => 1000.00,
        //     'due_amount' => 0.00,
        //     'payment_date' => '2023-04-01',
        //     'payment_status' => 'Paid'
        // ]);


        // Payment::create([
        //     'student_id' => 201010001,
        //     'paymenttype_id' => 2,
        //     'payable_amount' => 1000.00,
        //     'amount_payed' => 800.00,
        //     'due_amount' => 200.00,
        //     'payment_date' => '2023-04-01',
        //     'payment_status' => 'Partial'
        // ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
