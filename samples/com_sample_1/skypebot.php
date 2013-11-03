<?php
include_once("common.inc.php");
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

$last_day = date('d-M-y');
$last_minute = date('H:i');

// Create skype object
$skype = new COM("Skype4COM.Skype");

// Create sink object
$sink =& new _ISkypeEvents($com);

// Connect to sink
com_event_sink($skype, $sink, "_ISkypeEvents");

// Start minimized and without splash screen
if (!$skype->client()->isRunning()) {
  $skype->client()->start(true, true);
}

//Attach to Skype
$skype->attach(5,false);
//process messages to catch the attachment
com_message_pump(1000);

//Main Loop
if ($sink->attached) {

  initialise($skype);

  //Message loop. Set $sink->terminated to true to quit
  while(!$sink->terminated) {
    com_message_pump(10);
    if (date('H:i') == '16:00') {
      skype_time4tea();
    }
    if (date('H:i')<>$last_minute) {
      skype_check_attach();
    }
    
  }
}

//clear up
$skype = null;

//***************
class _ISkypeEvents {
  var $terminated = false;
  var $attached = false;

  //***************
  function AttachmentStatus($status) {
    global $skype;
    
    if ( $status = $skype->objConverter->TextToAttachmentStatus("AVAILABLE") ) {
      $skype->attach(5,false);
    }
    $this->attached = true;
  }
  
  //***************
	function OnlineStatus(&$pUser, $Status ) {
//    print "Status: $pUser->Handle $Status\n";
	}

  //***************
	function MessageStatus( &$pMessage, $Status ) {
    global $skype, $CurrentUser, $archivechats;

    $myhandle = $CurrentUser->Handle;

    $cmeUnknown = -1;
    $cmeCreatedChatWith = 0;
    $cmeAddedMembers = 2;
    $cmeSetTopic = 3;
    $cmeSaid = 4;
    $cmeLeft = 5;

    if ($pMessage->Type == $cmeSetTopic) {
      skype_SetTopic($pMessage);      
    } else if ($pMessage->Type == $cmeAddedMembers) {
      skype_add_member($pMessage);      
    } else if ($pMessage->Type == $cmeSaid || $pMessage->Type == $cmeUnknown) { 
      if ($Status == 0 || $Status == 2) {
//        print "\n$pMessage->body $Status $pMessage->type";

        skype_archive_message($pMessage);

        if ($pMessage->FromHandle <> $CurrentUser->Handle ) {
      
          if ( substr(strtolower($pMessage->Body),0,4) == 'ping' ) {
            $skype->Chat($pMessage->ChatName)->SendMessage("pong");
          }
        
          if (substr($pMessage->Body,0,1) == '#') {
            $a   = str_word_count($pMessage->Body, 1); 
            switch (strtolower($a[0]) ) {
              case "motd" :
                skype_motd($pMessage);
                break;
              case "restart" :
                skype_restart();
                break;
              case "leave" :
                skype_leave($pMessage);
                break;
              case "google" :
                skype_google($pMessage);
                break;
              case "karma" :
                skype_get_karma($pMessage);
                break;
              case "archive" :
                skype_set_archive($pMessage);
                break;
              case "help" :
                skype_help($pMessage);
                break;
              default:
            }
          }
  
          if (stristr(strtolower($pMessage->Body), 'http://')) {
            skype_tinyurl($pMessage);
          }
  
          if (stristr($pMessage->Body, '++') || stristr($pMessage->Body, '--') ) {
            skype_karma($pMessage);
          }
  
          if (stristr($pMessage->Body, '!') ) {
            skype_shreek($pMessage);
          }
  
        }
      }
    }
	}
}

//***************
function convert_date($date) {

  $date = str_replace(
  array('/01/','/02/','/03/','/04/','/05/','/06/','/07/','/08/','/09/','/10/','/11/','/12/'),
  array(' Jan ',' Feb ',' Mar ',' Apr ',' May ',' Jun ',' Jul ',' Aug ',' Sep ',' Oct ',' Nov ',' Dec ',),
  $date
  );
  return $date;
}

//***************
function initialise(&$skype) {
  global $CurrentUser, $archivechats;

  $CurrentUser = $skype->CurrentUser;

  $result = db_query("SELECT * FROM chat WHERE archive = 1");
  while ($chat = db_fetch_object($result)) {
    $archivechats[$chat->chatname] = 1;
  }

  print "Started\n";
}

//***************
function skype_help(&$pMessage) {
  global $skype;
  
  $output = "Void.Bot Help: \n";
  $output .= "#help \t\t\t// Returns this help \n";
  $output .= "#google searchterms \t// Returns top 3 results for searchterms \n";
  $output .= "#karma phrase \t\t// Returns karma for word or phrase\n";
  $output .= "#karma \t\t// Returns top 5 karma words or phrases\n";
  $output .= "phrase++ \t\t// Adds 1 karma point to word or phrase \n";
  $output .= "phrase-- \t\t// Subtracts 1 karma point from word or phrase\n";
  $output .= "#archive [on|off|blank] \t// Sets Archiving of this chat on, off or returns status\n";
  $output .= "URL \t\t\t// A url anywhere in a message > 72 characters is converted to a tinyurl\n";
  $output .= "'ping' \t\t\t// Returns 'pong'\n";
  $output .= "'!' \t\t\t// Anywhere in a message returns 'heh!'\n";
  $output .= "#leave \t\t\t// Kicks Void.Bot from the chat\n";
  $output .= "#motd \t\t\t// Returns message of the day \n";
  $output .= "Add members \t\t// And it will welcome them.\n";
  $output .= "More detail and archives at http://www.voidstar.com/void.bot\n";
  
  $skype->Chat($pMessage->ChatName)->SendMessage($output);
}

//***************
function skype_google(&$pMessage) {
  global $skype;

  $key = 'O3O3HZk9i3uR27dbzOT8OHfQGFppTIvF';

  try {

    // Create the object
    $google = new Services_Google($key);

    // Setup query options, in this case limit to 100 results total.
    $google->queryOptions['limit'] = 3;
    $google->queryOptions['filter'] = false;
    $google->queryOptions['safeSearch'] = false;

    // Run the search
    $a   = str_word_count($pMessage->Body, 1);
    unset($a[0]);
    $search = trim(implode(' ',$a));
  
    $google->search($search);

    $output = "Google search for '$search'\n";

    // Loop through the results, $google->fetch() will return false once
    // it reaches the limit-th result, or no more results are available.
    foreach($google as $key => $result) {
      $output .=  strip_tags($result->title)." ".$result->URL;
      $output .=  "\n";
    }
  } catch (Exception $e) {
    $output .= "Sorry Google search failed.";
    
  }

  $skype->Chat($pMessage->ChatName)->SendMessage($output);
}

//***************
function skype_tinyurl($pMessage) {
  global $skype;

  $a = trim(stristr($pMessage->Body,'http://'));
  if (stristr($a,' ')) { 
    $a = substr($a,0,strpos($a,' '));
  }
  if (stristr($a,"\n")) { 
    $a = substr($a,0,strpos($a,"\n"));
  }

  if (strlen($a) > 80) {
    $tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=$a");
    $output = "$a\n = TinyUrl: $tinyurl";
    $skype->Chat($pMessage->ChatName)->SendMessage($output);
  }
}

//***************
function skype_karma($pMessage) {
  global $skype;

  $a = trim($pMessage->Body);
  
  if (stristr($a,'++')) {
    $name = substr($a,0,strpos($a,'++'));
    $inc = +1;
  } else {
    $name = substr($a,0,strpos($a,'--'));
    $inc = -1;   
  }

  if (substr($name,-1) <> ' ') {

    $name = check_input(trim($name));

    if (db_result(db_query("SELECT count(*) FROM karma WHERE name='$name'"),0) ) {
      db_query("UPDATE karma SET karma=karma+$inc WHERE name='$name'");
    } else {
      db_query("INSERT INTO karma SET name='$name', karma = $inc");
    }

    $karma = db_fetch_object(db_query("SELECT * FROM karma WHERE name='$name'"));
    $output .= "Karma: $name ";
    if ($karma->karma >= 0 ) {
      $output .= "+$karma->karma";
    } else {
      $output .= "-$karma->karma";
    }

    $skype->Chat($pMessage->ChatName)->SendMessage($output);
  }

}

//***************
function skype_shreek($pMessage) {
  global $skype;

  if (rand(0,10) > 6 ) {

    $response[] = "heh!";
    $response[] = "ha!";
    $response[] = "haha!";
    $response[] = "yay!";
    $response[] = "grin!";
    $response[] = "excellent!";
    $response[] = "most excellent!";
    $response[] = "hooray!";
    $response[] = "stoked!";
    $response[] = "smokin'!";

    $key = intval(rand(0,count($response)-1));

    $output .= $response[$key];  
    $skype->Chat($pMessage->ChatName)->SendMessage($output);    
  }
}

//***************
function skype_get_karma($pMessage) {
  global $skype;

  $a = str_word_count($pMessage->Body, 1);
  if ($a[1]) {
    $a = trim($pMessage->Body); 
    $name = substr($a,7);
    $name = check_input($name);
    $karma = db_fetch_object(db_query("SELECT * FROM karma WHERE name='$name'"));
    $output .= "Karma: $name ";
    if ($karma->karma >= 0 ) {
      if ($karma) {
        $output .= "+$karma->karma";
      } else {
        $output .= "+0";
      }
    } else {
      $output .= "-$karma->karma";
    }
  } else {
    $output .= "Top Karma:";
    $result = db_query("SELECT * FROM karma ORDER BY karma desc, name LIMIT 7");
    while ($karma = db_fetch_object($result)) {
      if ($karma->karma >= 0 ) {
        $output .= "\n$karma->name +$karma->karma";
      } else {
        $output .= "\n$karma->name $karma->karma";
      }
    }
    $output .= "\nFull list at http://www.voidstar.com/void.bot/index.php/op/karma";
  }

  $skype->Chat($pMessage->ChatName)->SendMessage($output);
}

//***************
function skype_set_archive($pMessage) {
  global $skype, $archivechats;

  $chatname = check_input($pMessage->ChatName);
  $chatFriendlyName = check_input($skype->Chat($pMessage->ChatName)->FriendlyName);
  $chat = db_fetch_object(db_query("SELECT * FROM chat WHERE chatname = '$chatname'"));
  
  if ( !$chat ) {
    db_query("INSERT INTO chat
              SET chatname = '$chatName',
              friendlyname = '$chatFriendlyName';
             ");
    $chat = db_fetch_object(db_query("SELECT * FROM chat WHERE chatname = '$chatName'"));
  }
  
  $a = str_word_count($pMessage->Body, 1);

  if (strtolower($a[1]) == 'on') {
    db_query("UPDATE chat SET archive=1 WHERE chatname='$chatName'");
    $output .= "*** Archiving of messages in this chat turned on.";
    $output .= "\nWARNING: messages in this chat are now visible on the web at:";
    $output .= "\nhttp://www.voidstar.com/void.bot/index.php/chat/$chat->cid";
    $archivechats[$chatName] = 1;
  }

  if (strtolower($a[1]) == 'off') {
    db_query("UPDATE chat SET archive=0 WHERE chatname='$chatName'");
    $output .= "*** Archiving of messages in this chat turned off";
    unset($archivechats[$chatName]);
  }

  if (!$a[1]) {
    $output .= "*** Archiving of messages in this chat is currently turned ";
    if ($chat->archive) {
      $output .= "on";
      $output .= "\nWARNING: messages in this chat are visible on the web at:";
      $output .= "\nhttp://www.voidstar.com/void.bot/index.php/chat/$chat->cid";
    } else {
      $output .= "off";
    }
  }
  
  $skype->Chat($pMessage->ChatName)->SendMessage($output);
  
}

//***************
function skype_leave($pMessage) {
  global $skype;

  $target = trim(substr($pMessage->body,6));
  if ($target) {
    $chatName = check_input($target);
  } else {
    $chatName = check_input($pMessage->ChatName);
  }

  db_query("UPDATE chat SET archive=0 WHERE chatname='$chatName'");
    
  $output .= "Bye!";
  $skype->Chat($pMessage->ChatName)->SendMessage($output);
  try {
    $skype->Chat($chatName)->Leave;
  } catch (Exception $e) {
  }
  
}

//***************
function skype_archive_message($pMessage) {
  global $skype, $archivechats;

  $chatname = check_input($pMessage->ChatName);

//  if ($archivechats[$pMessage->ChatName]) {
  if (db_result(db_query("SELECT count(*) FROM chat WHERE chatname ='$chatname' AND archive=1"),0)) {

    $authorhandle = check_input($pMessage->FromHandle);
    $authordisplayname = check_input($pMessage->FromDisplayName);
    $body = check_input($pMessage->Body);
    $timestamp = strtotime(convert_date($pMessage->Timestamp));
    $type = check_input($pMessage->Type);

    db_query("INSERT INTO archivemsg
              SET timestamp = $timestamp,
              chatname ='$chatname',
              authorhandle = '$authorhandle',
              authordisplayname = '$authordisplayname',
              body = '$body',
              type = $type
              ");
  }
}

//***************
function skype_SetTopic($pMessage) {
  global $skype, $archivechats;

  $chatname = check_input($pMessage->ChatName);
  $chatfriendlyname = check_input($skype->Chat($pMessage->ChatName)->FriendlyName);
  $authorhandle = check_input($pMessage->FromHandle);
  $authordisplayname = check_input($pMessage->FromDisplayName);
  $body = check_input("*** changed the chat topic to '$chatfriendlyname' ***");
  $timestamp = strtotime(convert_date($pMessage->Timestamp));

  $chat = db_fetch_object(db_query("SELECT * FROM chat WHERE chatname = '$chatname'"));
  
  if ( $chat ) {
    db_query("UPDATE chat
              SET friendlyname = '$chatfriendlyname'
              WHERE chatname = '$chatname'
             ");    
  } else {
    db_query("INSERT INTO chat
              SET chatname = '$chatname',
              friendlyname = '$chatfriendlyname'
             ");
  }

  if ($chat->archive) {

    db_query("INSERT INTO archivemsg
              SET timestamp = $timestamp,
              chatname ='$chatname',
              authorhandle = '$authorhandle',
              authordisplayname = '$authordisplayname',
              body = '$body'
              ");
  }

}

//***************
function skype_time4tea() {
  global $last_day, $skype;

  $today = date('d-M-y');
  $now = date('H:i');
  $text_array = file('fringe.txt');
  $count = count($text_array);

  if ($now > '16:00' && $today <> $last_day) {
    $last_day = $today;
    foreach ($skype->BookmarkedChats as $chat) {
      $off = intval(rand(0,$count-1));
      $msg = "/me says: ".$text_array[$off];
      $chat->SendMessage($msg);
    }
  }
}

//***************
function skype_restart() {
  global $sink;

  $sink->terminated = true;

}

//***************
function skype_check_attach() {
  global $skype, $last_minute;

  if ($skype->AttachmentStatus <> 0 ) {
    $skype->attach(5,false);
  }

  $last_minute = date('H:i');

}

//***************
function skype_motd($pMessage) {
  global $skype;

  $text_array = file('fringe.txt');
  $count = count($text_array);
  $off = intval(rand(0,$count-1));

  $msg = $text_array[$off];
  $skype->Chat($pMessage->ChatName)->SendMessage($msg);

}

//***************
function skype_add_member($pMessage) { 
  global $skype;

  $users = $pMessage->Users;
  foreach ($users as $user) {
    if ($user->DisplayName) { 
      $msg = "Welcome, $user->DisplayName\n";
    } else if ($user->FullName) { 
      $msg = "Welcome, $user->FullName\n";
    } else {
      $msg = "Welcome, $user->Handle\n";
    }
    $skype->Chat($pMessage->ChatName)->SendMessage($msg);
  }
}


?>
