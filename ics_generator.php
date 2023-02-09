<?php
    class ICSGenerator {
        var $data;
        var $name;
        function __construct($date_debut,$date_fin,$objet,$lieu,$name) {
            $this->name = $name;

			//Evenèment au format ICS
			$ics = "BEGIN:VCALENDAR\n";
			$ics .= "VERSION:2.0\n";
			$ics .= "METHOD:PUBLISH\n";
			$ics .= "BEGIN:VEVENT\n";
			$ics .= "X-WR-TIMEZONE:Europe/Paris\n";
			$ics .= "DTSTART:".date("Ymd\THis",strtotime($date_debut))."\n";
			$ics .= "DTEND:".date("Ymd\THis",strtotime($date_debut))."\n";
			$ics .= "ORGANIZER;CN=Mairie de Beaurains:mailto:contact@mairie-beaurains.fr\n";
			$ics .= "LOCATION:".$lieu."\n";
			$ics .= "TRANSP: OPAQUE\n";
			$ics .= "SEQUENCE:0\nUID:\n";
			$ics .= "DTSTAMP:".date("Ymd\THis")."\n";
			$ics .= "SUMMARY:".$objet."\n";
			$ics .= "DESCRIPTION:\n";
			$ics .= "PRIORITY:5\n";
			$ics .= "CLASS:PUBLIC\n";
			$ics .= "BEGIN:VALARM\n";
			$ics .= "TRIGGER:-PT10M\n";
			$ics .= "ACTION:DISPLAY\n";
			$ics .= "DESCRIPTION:Reminder\n";
			$ics .= "END:VALARM\n";
			$ics .= "END:VEVENT\n";
			$ics .= "END:VCALENDAR\n";
			
			$this->data = $ics;
			
        }
        public function save() {
            file_put_contents("saved-ics/".$this->name.".ics",$this->data);
        }
    }
?>