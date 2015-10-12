<?php

function VentriloInfoEX1_Stripe( &$bgidx, $name, $val )
{
	if ( $bgidx % 2 )
		$bgcolname = "#666666";
	else
		$bgcolname = "#333333";
		
	if ( $bgidx % 2 )
		$bgcolval = "#FFFFCC";
	else
		$bgcolval = "#FFFFFF";
		
	echo "  <tr>\n";
	echo "    <td width=\"35%\" bgcolor=\"$bgcolname\"><font color=\"#FFFFFF\">";
	echo "<strong>";
	echo $name;
	echo "</strong>";
	echo "</font></td>\n";
	echo "    <td width=\"65%\" bgcolor=\"$bgcolval\"><font color=\"#000000\">";
	echo "<div align=\"center\">";
	echo $val;
	echo "</div";
	echo "</font></td>\n";
	echo "  </tr>\n";
	
	$bgidx += 1;
}




function VentriloInfoEX1( &$stat )
{
	$bgidx	= 0;
	
	VentriloInfoEX1_Stripe( $bgidx, "Name", $stat->m_name );
	VentriloInfoEX1_Stripe( $bgidx, "Phonetic", $stat->m_phonetic );
	VentriloInfoEX1_Stripe( $bgidx, "Comment", $stat->m_comment );
	VentriloInfoEX1_Stripe( $bgidx, "Auth", $stat->m_auth );
	VentriloInfoEX1_Stripe( $bgidx, "Max Clients", $stat->m_maxclients );
	VentriloInfoEX1_Stripe( $bgidx, "Voice Codec", $stat->m_voicecodec_desc );
	VentriloInfoEX1_Stripe( $bgidx, "Voice Format", $stat->m_voiceformat_desc );
	VentriloInfoEX1_Stripe( $bgidx, "Uptime", $stat->m_uptime );
	VentriloInfoEX1_Stripe( $bgidx, "Platform", $stat->m_platform );
	VentriloInfoEX1_Stripe( $bgidx, "Version", $stat->m_version );
	VentriloInfoEX1_Stripe( $bgidx, "Channel Count", $stat->m_channelcount );
	VentriloInfoEX1_Stripe( $bgidx, "Client Count", $stat->m_clientcount );
}

?>