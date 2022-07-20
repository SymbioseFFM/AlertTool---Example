<?php

namespace App\Http\Livewire\Alert;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Alert;
use App\Models\Sensor;
use App\Models\Identifier;
use App\Models\Threshold;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use Ddeboer\Imap\Server;

class AlertMailController extends Component
{
    public function readInbox()
    {
        //Zugangsdaten vom E-Mail Postfach
        $inbox_mail = env('INBOX_EMAIL');
        $inbox_password = env('INBOX_PASSWORD');

        //Verbindung mit einem Outlook Postfach ausbauen und ungelesene E-Mails auslesen
        $server = new Server('outlook.office365.com');
        $connection = $server->authenticate($inbox_mail, $inbox_password);
        $mailbox = $connection->getMailbox('INBOX');
        $messages = $mailbox->getMessages(new \Ddeboer\Imap\Search\Flag\Unseen());

        foreach($messages as $message)
        {
            $email = Alert::make();
            
            $header = $message->getHeaders();

            //Falls es sich hierbei um Text mit HTML handelt, die Tags entfernen und abspeichern, ansonsten den Plain Text nehmen
            if($message->getBodyText() == NULL){
                $email->content_stripped = strip_tags($message->getBodyHtml());
            }else{
                $email->content_stripped = $message->getBodyText();
            }

            $email->subject = $message->getSubject();
            $email->content = $message->getBodyHtml();
            $email->email = $message->getFrom()->getAddress();
            $email->progressed = 0;
            $email->received_date = $header['udate'];
            $email->save();

            $message->markAsSeen();
        }
    }

    public function sensorAlert()
    {
        //Holt sich alle Sensoren und Alerts die noch nicht bearbeitet wurden
        $sensors = Sensor::get();
        $alerts = Alert::where('progressed', 0)->get();

        //Für jeden Sensor [...]
        foreach ($sensors as $sensor)
        {
            //[...] sortiere alle Identifiers des Sensors nach der search_id (Zuerst E-Mail, dann Betreff, dann Inhalt)
            $identifiers = Identifier::where('sensor_id', '=', $sensor->id)->orderBy('search_id')->get();

            //[...] prüfe jede E-Mail auf Matches
            foreach ($alerts as $alert)
            {
                //Falls die E-Mail bereits ein Match mit einem Sensor hat, Schleife bei der nächsten E-Mail fortsetzen
                if ($alert->sensors->count() != 0) {
                    continue;
                } else {
                    //Variable in der abgespeichert wird, welche Information der E-Mail auf ein Match durchsucht werden soll (z.B. Subject, Content, Email)
                    $search = "";

                    $match = false;

                    //Prüfe ob die E-Mail mit den Identifiers des Sensors übereinstimmt
                    foreach ($identifiers as $identifier)
                    {
                        $search = $identifier->search->name;

                        switch ($search) {
                            case "E-Mail":
                              $search = "email";
                              break;
                            case "Betreff":
                              $search = "subject";
                              break;
                            case "Inhalt":
                              $search = "content_stripped";
                              break;
                            }

                        $match = str_contains($alert->$search, $identifier->pattern);

                        //Falls eine der Identifiers nicht übereinstimmt Schleife abbrechen und Match=false zurückgeben
                        if ($match == false){
                            break;
                        }
                    }

                    //Falls ein Match zwischen dem Sensor Identifier und der E-Mail besteht [...]
                    if ($match == true) {
                        //[...] prüfe welchen Status die E-Mail hat (Success, Warning, Error, Unknown)
                        if(str_contains($alert->subject, $sensor->pattern->success)){
                            $statusId = 1;
                        }elseif(str_contains($alert->subject, $sensor->pattern->warning)){
                            $statusId = 2;
                        }elseif(str_contains($alert->subject, $sensor->pattern->error)){
                            $statusId = 3;
                        }else{
                            $statusId = 4;
                        }

                        //Falls der Sensor eine Warnschwelle eingerichtet hat, prüfe ob die Warnschwelle aktiv ist.
                        //Falls ja, setze die Warnschwelle auf abgeschlossen.
                        if($sensor->thresholds->count() > 0)
                        {
                            $threshold = $sensor->thresholds()->orderBy('id', 'desc')->first();
                            if($threshold->state == 'start'){
                                $threshold->state = 'end';
                                $threshold->last_match = $alert->received_date;
                                $threshold->save();
                            }
                        }

                        //Pivot Table befüllen
                        $sensor->alerts()->attach($alert, ['status_id' => $statusId, 'progressed' => 0, 'timestamp' => time()]);

                        $sensor->last_match = $alert->received_date;

                        //Falls der Sensor zuvor eine aktive Warnung hatte, diese wieder deaktivieren
                        if($sensor->warning == 1){
                            $sensor->warning = 0;
                        }

                        $sensor->save();

                        //E-Mail als bearbeitet markieren
                        $alert->progressed = 1;
                        $alert->save();
                    }
                }
            }
        }
    }

    public function threshold()
    {
        $sensors = Sensor::where('warning_threshold', 1)->get();

        //Für jeden Sensor der eine Warnschwelle besitzt
        foreach($sensors as $sensor)
        {
            $time = time();

            //Prüfe ob die Warnschwelle übertreten wurde
            if(($sensor->last_match + $sensor->threshold) < $time){
                if($sensor->warning == 0){
                    $sensor->warning = 1;
                    $sensor->save();
                }

                //Falls es bereits eine Überschreitung gibt
                if($sensor->thresholds->count() > 0)
                {
                    $last_threshold = $sensor->thresholds()->orderBy('id', 'desc')->first();
                    //Falls die letzte Überschreitung beendet war, eine Neue eröffnen ansonsten nichts tun
                    if($last_threshold->state == 'end'){
                        $threshold = Threshold::make();
                        $threshold->sensor_id = $sensor->id;
                        $threshold->currentTime = $time;
                        $threshold->last_match = $sensor->last_match;
                        $threshold->progressed = 0;
                        $threshold->threshold = $sensor->threshold;
                        $threshold->state = 'start';

                        $threshold->save();
                    }
                    //Falls es noch keine Überschreitung gibt, ein Log erstellen
                }else{
                    $threshold = Threshold::make();
                    $threshold->sensor_id = $sensor->id;
                    $threshold->currentTime = $time;
                    $threshold->last_match = $sensor->last_match;
                    $threshold->progressed = 0;
                    $threshold->threshold = $sensor->threshold;
                    $threshold->state = 'start';

                    $threshold->save();
                }
            }
        }
    }
}

