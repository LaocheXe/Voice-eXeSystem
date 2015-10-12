<?php
/***********************************/
//       www.defiantz.org          // 
//          voice.php              //
//		   created by              //
//        Moc & LaocheXe           //
/***********************************/

require_once('../../class2.php');
require_once(HEADERF);
include_lan(e_PLUGIN.'voice/languages/'.e_LANGUAGE.'.php'); // see e107 doc on including LAN using v2 standards

e107::css('voice','voice.css');

$sql  = e107::getDB();
$text = '';

// Check if there are servers listed in the database
// If the count returns 0, there is no need to continue and so an message is displayed and the page is rendered.
if(!$sql->count('voice_exesystem'))
{
  $text = "No servers found.";
  e107::getRender()->tablerender(LAN_VOI_VIEWERS, $text);
  require_once(FOOTERF);
  exit;
}

// Define sTypeName function
function define_sTypeName($sType)
{
  switch ($sType)
  {
    //case 0:
     // $sTypeName = LAN_VOI_TYPE_UNK;
     // break;
    case 1:
      $sTypeName = LAN_VOI_TYPE_MUM;
      break;
    case 2:
      $sTypeName = LAN_VOI_TYPE_TS3;
      break;
    case 3:
      $sTypeName = LAN_VOI_TYPE_VEN;
      break;
  }
 return $sTypeName;
}

function define_sButton($sType)
{
	switch ($sType)
	{
	 case 1:
	  $sButton = '<span class="icon-ble"></span> ';
      break;
    case 2:
	  $sButton = '<span class="icon-ts3"></span> ';
      break;
    case 3:
	  $sButton = '<span class="icon-vent"></span> ';
      break;
	}
	return $sButton;
}
function define_sUrlA($sType)
{
	switch ($sType)
	{
	 case 1:
	  $sUrlA = 'ble/ble.php?id=';
      break;
    case 2:
	  $sUrlA = 'ts3/ts3.php?id=';
      break;
    case 3:
	  $sUrlA = 'vent/vent.php?id=';
      break;
	}
	return $sUrlA;
}

// Server types: 0, 1, 2, 3. They are put into the variable $i and we loop through them.
// This could be made dynamic when the voice types are stored in a separate database table. (ie. retrieve those values and loop through them)
for ($i = 1; $i <= 3; $i++)
{
  // Retrieve servers with specific voice_type and store them in the $server array.
  $servers    = $sql->retrieve('voice_exesystem', 'voice_id, voice_name', 'voice_type = '.$i.'', true);
  $sTypeName  = define_sTypeName($i); // call the define function to retrieve the appropriate sTypeName
  $sButton = define_sButton($i);
  $sUrlA = define_sUrlA($i);
  
  $text .= "<h3>".$sTypeName."</h3>";

  $text .= "<table border='1'>";

  foreach($servers as $server)
  {
	  // Table
	  // Server ID (Debug only) - Will be removed
	  // Online/Offline Status (Future)
    $text .= '
    <tr>
      <td>'.$server['voice_id'].'</td>
      <td><a href="viewers/'.$sUrlA.''.$server['voice_id'].'">'.$sButton.' '.$server['voice_name'].'</a></td>
	  <td></td>
    </tr>';
  }

  $text .= "</table>";
}




function define_sUTypeName($sUType)
{
  switch ($sUType)
  {
    case 0:
      $sUTypeName = LAN_VOI_TYPE_UNK;
      break;
  }
  return $sUTypeName;
}
for ($k = 0; $k <= 0; $k++)
{
  $servers1    = $sql->retrieve('voice_exesystem', 'voice_id, voice_name', 'voice_type = '.$k.'', true);
  $sUTypeName  = define_sUTypeName($k); // call the define function to retrieve the appropriate sTypeName
  
  $text .= "<h3>".$sUTypeName."</h3>";
  $text .= "<table border='1'>";
  
  foreach($servers1 as $server1)
  {
	$text .= '
    <tr>
      <td>'.$server1['voice_id'].'</td>
      <td>'.$server1['voice_name'].'</td>
	  <td></td>
    </tr>';
  }
  $text .= '</table>';
}


e107::getRender()->tablerender(LAN_VOI_VIEWERS, $text);
require_once(FOOTERF);
exit;
?>
