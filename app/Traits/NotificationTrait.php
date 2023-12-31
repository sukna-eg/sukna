<?php
namespace App\Traits;

trait NotificationTrait
{

    public function send($content, $title, $token, $many = false)
    {
        $msg = array
            (
            'body' => $content,
            'title' => $title,
            // 'route_id'=>$route_id,
            // 'type'=>$type,
            'receiver' => 'Aya',
            'sound' => 'mySound', /*Default sound*/
        );
        if ($many) {
            $fields = array
                (
                'registration_ids' => $token,
                'notification' => $msg,
                 'priority' => 'high',

            );
        } else {
            $fields = array
                (
                "to" => $token,
                "notification" => $msg,
                'priority' => 'high',
            );
        }

        $headers = array
            (
            "Authorization: key=" . env("FIREBASE_API_KEY"),
            "Content-Type: application/json",
        );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);



        return true;
    }


    public function sendPartnerNoti($title,$content,$type,$id,$token)
    {
        $msg['title']=$title;
        $msg['body']=$content;
        $msg['sound'] ='mySound';

        $data = [
            'partner_id' => $id,
            'type' => $type,


        ];

            $fields = array
                (
              'registration_ids' => $token,
                "notification" => $msg,
                "data"=> $data,

                );


        $headers = array
            (
            "Authorization: key=" . env("FIREBASE_API_KEY"),
            "Content-Type: application/json"
        );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        //dd($result);
        curl_close($ch);

        return true;
    }


    public function sendAdminNoti($title,$content,$type,$token)
    {
        $msg['title']=$title;
        $msg['body']=$content;
        $msg['sound'] ='mySound';
        $data = [

            'type' => $type,


        ];

            $fields = array
                (
                "to" => $token,
                "notification" => $msg,
                "data"=> $data,

                );


        $headers = array
            (
            "Authorization: key=" . env("FIREBASE_API_KEY"),
            "Content-Type: application/json"
        );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        //dd($result);
        curl_close($ch);

        return true;
    }


    public function sendUserNoti($title,$content,$id,$type,$token)
    {
        $msg['title']=$title;
        $msg['body']=$content;
        $msg['sound'] ='mySound';
        $data = [


            'partner_id' => $id,
            'type' => $type,


        ];

            $fields = array
                (
                "to" => $token,
                "notification" => $msg,
                "data"=> $data,

                );


        $headers = array
            (
            "Authorization: key=" . env("FIREBASE_API_KEY"),
            "Content-Type: application/json"
        );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        //dd($result);
        curl_close($ch);

        return true;
    }

    public function confirmQuestion($title,$content,$type,$token)
    {
        $msg['title']=$title;
        $msg['body']=$content;
        $msg['sound'] ='mySound';
        $data = [



            'type' => $type,


        ];

            $fields = array
                (
                "to" => $token,
                "notification" => $msg,
                "data"=> $data,

                );


        $headers = array
            (
            "Authorization: key=" . env("FIREBASE_API_KEY"),
            "Content-Type: application/json"
        );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        //dd($result);
        curl_close($ch);

        return true;
    }

    public function sendReplay($title,$content,$type,$token)
    {
        $msg['title']=$title;
        $msg['body']=$content;
        $msg['sound'] ='mySound';
        $data = [



            'type' => $type,


        ];

            $fields = array
                (
                "to" => $token,
                "notification" => $msg,
                "data"=> $data,

                );


        $headers = array
            (
            "Authorization: key=" . env("FIREBASE_API_KEY"),
            "Content-Type: application/json"
        );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        //dd($result);
        curl_close($ch);

        return true;
    }

    public function confirmPartner($title,$content,$type,$token)
    {
        $msg['title']=$title;
        $msg['body']=$content;
        $msg['sound'] ='mySound';
        $data = [



            'type' => $type,


        ];

            $fields = array
                (
                "to" => $token,
                "notification" => $msg,
                "data"=> $data,

                );


        $headers = array
            (
            "Authorization: key=" . env("FIREBASE_API_KEY"),
            "Content-Type: application/json"
        );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        //dd($result);
        curl_close($ch);

        return true;
    }


    public function sendRate($title,$content,$status,$doctor_id,$doctor_name,$doctor_image, $token)
    {
        $msg['title']=$title;
        $msg['body']=$content;
        $data = [
            'status' => $status,
            'doctorId' => $doctor_id,
            'doctorName' => $doctor_name,
            'doctorImage' => $doctor_image,
            'click_action'=> "FLUTTER_NOTIFICATION_CLICK",

        ];

            $fields = array
                (
                "to" => $token,
                "notification" => $msg,
                "data"=> $data,

                );


        $headers = array
            (
            "Authorization: key=" . env("FIREBASE_API_KEY"),
            "Content-Type: application/json"
        );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        //dd($result);
        curl_close($ch);

        return true;
    }

    public function sendUpdate($title,$content,$status,$apointment_id, $token)
    {
        $msg['title']=$title;
        $msg['body']=$content;
        $data = [
            'status' => $status,
            'appointmentId' => $apointment_id,
            'click_action'=> "FLUTTER_NOTIFICATION_CLICK",

        ];

            $fields = array
                (
                "to" => $token,
                "notification" => $msg,
                "data"=> $data,

                );


        $headers = array
            (
            "Authorization: key=" . env("FIREBASE_API_KEY"),
            "Content-Type: application/json"
        );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        //dd($result);
        curl_close($ch);

        return true;
    }
}
