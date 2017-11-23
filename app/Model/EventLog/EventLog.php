<?php

namespace App\Model\EventLog;

use Illuminate\Database\Eloquent\Model;

class EventLog extends Model
{
    protected $table = "event_log";
    protected $primaryKey = "ID";
    public $timestamps = false;

    const STUDENT_EVENTS_LOG = array(
        "ADD STUDENT"=> "ADD STUDENT",
        "DELETE STUDENT"=> "DELETE STUDENT",
        "UPDATE STUDENT"=> "UPDATE STUDENT",
        "CHANGE PASSWORD"=> "CHANGE PASSWORD",
        "CONVERT LEGAL STUDENT TO LISTENER"=> "CONVERT LEGAL STUDENT TO LISTENER",
        "CONVERT LISTENER TO LEGAL STUDENT"=> "CONVERT LISTENER TO LEGAL STUDENT",
        "ACTIVE ACCOUNT BY SEND MESSAGE TO EMAIL"=> "ACTIVE ACCOUNT BY SEND MESSAGE TO EMAIL",
        "ACTIVE ACCOUNT BY SET 'VerifiedEmail=1'"=> "ACTIVE ACCOUNT BY SET 'VerifiedEmail=1'"
    );

    const STUDENT_PAPER_LOG = array(
        "SHOW PAPERS" => "SHOW PAPERS",
        "ACCEPT PAPER" => "ACCEPT PAPER",
        "REJECT PAPER" => "REJECT PAPER"
    );

    const TIMETABLE_EVENTS_LOG = array(
        "ADD LESSONS TO TIMETABLE"=> "ADD LESSONS TO TIMETABLE",
        "UPDATE LESSONS ON TIMETABLE"=> "UPDATE LESSONS ON TIMETABLE"
    );


    const LECTURER_EVENTS_LOG = array(
        "ADD LECTURER"=> "ADD LECTURER",
        "DELETE LECTURER"=> "DELETE LECTURER",
        "UPDATE LECTURER"=> "UPDATE LECTURER"
    );

    public static function addEvent($event, $description)
    {
        $e = new EventLog();
        $e->Admin_ID = $_SESSION["USER_ID"];
        $e->Event = $event ;
        $e->Datetime = date("Y-m-d h:i:s", time());
        $e->Description = $description;
        $e->save();

        return "";
    }
}
