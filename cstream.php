<meta http-equiv="refresh" content="5" />      
<div style="text-align: center; padding: 20px; border: 1px solid #000000; margin-bottom: 10px; margin-top: 10px;">Real Time Feed of all chat room messages</div>    
      <?php
        define(DBHOST, "DATABASE_HOST");
        define(DBNAME, "DATABASE_NAME");
        define(DBUSER, "DATABASE_USER");
        define(DBPASS, "DATABASE_PASS");
        // Connecting, selecting database
        $dbconn = pg_connect('host=' . DBHOST . 'dbname=' . DBNAME .  'user=' . DBUSER .  'password=' . DBPASS)
            or die('Could not connect: ' . pg_last_error());

        // Performing SQL query
        $query = "SELECT jm.to_jid,jm.from_jid,jm.body_string,jm.sent_date,jm.history_flag FROM jm ORDER BY jm.sent_date DESC limit 50";
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());

        // Printing results in HTML

        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
              $toParts_1 = explode("/", $line['to_jid']);
              $fromParts_1 = explode("/", $line['from_jid']);
              //ONLY SHOW CHAT ROOM COMMUNICATIONS IN LIVE STREAM
              $crIdent = array('NAME-OF-CHAT-ROOM','NAME-OF-CHAT-ROOM');
              if (in_array($toParts_1[0], $crIdent) OR in_array($fromParts_1[0], $crIdent)) {
                  if ($line['body_string'] != 'This room is not anonymous.' && $line['history_flag'] != 'H') {
                  
                if (isset($toParts_1[1])) {
                    //var_dump($toParts_1[1]);
                    $toID = explode("_", $toParts_1[1]);
                }
                if (isset($fromParts_1[1])) {
                    //var_dump($fromParts_1[1]);
                    $fromID = explode("_", $fromParts_1[1]);
                }
                $dateParts = explode(" ",$line['sent_date']);
                $timeParts = explode(".", $dateParts[1]);
                $date = date_create($dateParts[0]." ".$timeParts[0]);
                date_sub($date, date_interval_create_from_date_string('4 hours'));
                $messageThread[$timeParts[0]] = "<span style='color: #840427;font-weight: bold;'>TO:</span> " . $toParts_1[0] . "<br /><span style='color: #840427;font-weight: bold;'>FROM:</span> " . $fromParts_1[0] . "<br /><span style='color: #840427; font-weight: bold;'>DATE:</span> " . date_format($date, 'Y-m-d H:i:s') . "<br /><span style='font-style: italic;'>" . $line['body_string'] . "</span><br />=============================================================================<br />";
                unset($dateParts);
                unset($timeParts);
              
              }
              
                }
        }

        // Free resultset
        pg_free_result($result);

        // Closing connection
        pg_close($dbconn);
        //asort($messageThread);
        if (!isset($messageThread)) {
            echo 'No recent messages to display';
        }
        else {
            foreach ($messageThread as $message) {
                echo $message;
            }
        }
      ?>


