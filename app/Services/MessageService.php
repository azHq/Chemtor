<?php

namespace App\Services;

use App\Models\Message;
use App\Models\Student;

class MessageService
{
    public function send_message(String $message, String $student_id_csv)
    {
        $url = "http://66.45.237.70/api.php";

        $studentIdsArray = explode(',', $student_id_csv);
        $phoneNumbers = Student::whereIn('id', $studentIdsArray)->pluck('phone_number')->toArray();
        $phoneNumbers = implode(',', $phoneNumbers);


        $data= array(
            'username'=>"01782267068",
            'password'=>"6BNPADM4",
            'number'=>"$phoneNumbers",
            'message'=>"$message"
        );

        // $ch = curl_init(); // Initialize cURL
        // curl_setopt($ch, CURLOPT_URL,$url);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $smsresult = curl_exec($ch);
        // $p = explode("|",$smsresult);
        // $sendstatus = $p[0];
        $sendstatus = "1002";

        $status = '';
        switch ($sendstatus) {
            case "1000":
                $status = 'Invalid user or Password';
                break;
            case "1002":
                $status = 'Empty Number';
                break;
            case "1003":
                $status = 'Invalid message or empty message';
                break;
            case "1004":
                $status = 'Invalid number';
                break;
            case "1005":
                $status = 'All Number is Invalid';
                break;
            case "1006":
                $status = 'Insufficient Balance';
                break;
            case "1009":
                $status = 'Inactive Account';
                break;
            case "1010":
                $status = 'Max number limit exceeded';
                break;
            case "1101":
                $status = 'Success';
                break;
            default:
                $status = 'Unknown status';
                break;
        }

        foreach ($studentIdsArray as $studentId) {
            // dd($studentId);

            $sms = new Message();
            $sms->student_id = $studentId;
            $sms->message = $message;
            $sms->status_code = $sendstatus;
            $sms->status = $status;
            $sms->save();
        }

        return $status;
    }
}


?>