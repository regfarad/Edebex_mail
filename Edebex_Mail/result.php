<?php

function finalHour($hInput, $minInput, $lastHMng, $minLastHMng, $firstHAftn, $minFirstHAftn, $nbBusinessHours) {
    $hInputConverted = ($hInput * 3600 + $minInput * 60);
    $lastHMngConverted = ($lastHMng * 3600 + $minLastHMng);
//Différence entre la derniere heure et l'heure entrée
    $firstDuration = $lastHMngConverted - $hInputConverted;
    $nbBusinessHoursConv = ($nbBusinessHours * 3600);
//Calcul du temps restant entre le nombres d'heures de travail et la durée du premier temps écoulé
    $remainingTime = $nbBusinessHoursConv - $firstDuration;
//Calcul du temps final 
    $firstHAftnConverted = ($firstHAftn * 3600 + $minFirstHAftn * 60);
    $finalHour = $firstHAftnConverted + $remainingTime;
    return $finalHour;
}

function checkCalendar($dateInput) {
    //Configuration du calendrier
    $calendar = file_get_contents("calBel.ics");
    $regExpEvent = "/SUMMARY:(.*)/";
    $regExpDate = "/DTSTART;VALUE=DATE:(.*)/";
    $n = preg_match_all($regExpEvent, $calendar, $tabEvent, PREG_PATTERN_ORDER);
    preg_match_all($regExpDate, $calendar, $tabDate, PREG_PATTERN_ORDER);

    //Parcours des tableaux et vérification des dates correspondantes
    $j = 0;
    $found = FALSE;
    while ($j < $n && !$found) {
        $yearCal = substr($tabDate[0][$j], 19, 4);
        $monthCal = substr($tabDate[0][$j], 23, 2);
        $dayCal = substr($tabDate[0][$j], 25, 2);
        $desc = substr($tabEvent[0][$j], 8);
        $dateCalFormed = "$yearCal/$monthCal/$dayCal";
        $dateCal = date('d/m/Y', strtotime($dateCalFormed));

        if ($dateCal == $dateInput) {
            echo "The mail cannot be sent on this date $dateCal because it is $desc";
            header("Refresh:4; url=index.php");
            $found = TRUE;
        }
        ++$j;
    }
    return $found;
}

if (!empty($_POST)) {
    date_default_timezone_set('UTC');
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $date = $_POST['date'];
    $time = $_POST['heure'];
    $dateInput = date('d/m/Y', strtotime($date));

//Récupération du jour, du mois, de l'année 
    $j = date('d', strtotime($date));
    $m = date('m', strtotime($date));
    $y = date('Y', strtotime($date));

//Récupération du jour de la semaine 
    $dayOfDateInput = date("l", mktime(0, 0, 0, $m, $j, $y));
    $nbBusinessHours = 4;

//Récupération de l'heure et de la minute entrée
    $hInput = date('H', strtotime($time));
    $minInput = date('i', strtotime($time));

//Parcours du fichier config.txt et récupération des données de celui-ci
    $filename = "config.txt";
    $handle = @fopen($filename, "r");

    if ($handle) {
        while (!feof($handle)) {
            $buffer = fgets($handle, 4096);
            $tabFile = $buffer;
        }
        fclose($handle);
    }

    list($day1, $day2, $day3, $day4, $firstHMng, $minFirstHMng, $lastHMng, $minLastHMng, $firstHAftn, $minFirstHAftn, $LastHAftn, $minLastHAftn) = split("[|H]", $tabFile);

//Conversion dans le format de l'heure    
    $hInputTime = date('H:i', strtotime("$hInput:$minInput"));
    $firstHMngTime = date('H:i', strtotime("$firstHMng:$minFirstHMng"));
    $lastHMngTime = date('H:i', strtotime("$lastHMng:$minLastHMng"));
    $firstHAftnTime = date('H:i', strtotime("$firstHAftn:$minFirstHAftn"));
    $LastHAftnTime = date('H:i', strtotime("$LastHAftn:$minLastHAftn"));

//Vérification des règles 
    if (!checkCalendar($dateInput)) {
        if ($dayOfDateInput == $day1) {
            if ($hInputTime <= $lastHMngTime) {
                echo "The mail cannot be sent on $day1" . "s between $firstHMngTime and $lastHMngTime";
            }
        } else if ($dayOfDateInput == $day2) {
            if ($hInputTime >= $firstHAftnTime) {
                echo "The mail cannot be sent on $day2" . "s between $firstHAftnTime and $LastHAftnTime";
            }
        } else if ($dayOfDateInput == $day3 || $dayOfDateInput == $day4) {
            echo "The mail cannot be sent on $day3" . "s and $day4" . "s";
        } else {
            if ($hInputTime > $firstHMngTime && $hInputTime < $lastHMngTime) {
                $finalHour = finalHour($hInput, $minInput, $lastHMng, $minLastHMng, $firstHAftn, $minFirstHAftn, $nbBusinessHours);
                $finalHourTime = date('H:i', $finalHour);
                if ($finalHourTime < $LastHAftnTime) {
                    echo "The mail will be sent to $nom $prenom at the mail adress $mail on $dayOfDateInput  $dateInput at $finalHourTime";
                } else {
                    echo "The mail must be sent between  $firstHMngTime and $lastHMngTime";
                }
            }
        }
        header("Refresh:4; url=index.php");
    }

    exit();
}
