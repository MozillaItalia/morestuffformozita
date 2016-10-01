<?php
function maxversion($v){
		$a=explode(".", $v);
		return $a[0].".".$a[1];
}

function nicewinversion($v){
	$v=strtolower($v);
	if ($v=="5.01") $v="5.0";
	switch($v){
		case "6.2": $t["system"] =" Windows 8";$t["system_icon"] ="win8";break;
		case "6.3": $t["system"] =" Windows 8.1";$t["system_icon"] ="win81";break;
			case "6.1": $t["system"] =" Windows 7/Server 2008 R2";$t["system_icon"] ="vista";break;
			case "6.0": $t["system"] = "Windows Vista";$t["system_icon"] ="vista";break;
			case "5.2": $t["system"] ="Windows Server Home/Server 2003";$t["system_icon"] = "win_new";break;
			case "5.1": $t["system"] ="Windows XP";$t["system_icon"] = "win_new";break;
			case "5.0": $t["system"] ="Windows 2000";$t["system_icon"] = "win_old";break;
			case "16": $t["system"] = "Windows 3.x";$t["system_icon"] = "win_old";break;
			case "32": $t["system"] = "Windows";$t["system_icon"] = "win_old";break;
			case "me": $t["system"] = "Windows Millenium";$t["system_icon"] = "win_old";break;
			default:$t["system"] = "Windows ".$v;$t["system_icon"] = "winnextgen";break;
	}
	return $t;
}
			
			


function nicemacversion($v){
	$v2 =  maxversion($v);
	switch (true){
			case $v2==="10.1": $v ="Puma";break;
			case $v2==="10.2":$v="Jaguar";break;
			case $v2==="10.3":$v="Panther";break;
			case $v2==="10.4":$v="Tiger";break;
			case $v2==="10.5":$v="Leopard";break;
			case $v2==="10.6":$v="Snow Leopard";break;
			case $v2==="10.7":$v="Lion";break;
			case $v2==="10.8":$v="Mountain Lion";break;
			case $v2==="10.9":$v="Mavericks";break;
			case $v2==="10.10":$v="Yosemite";break;
			case $v2==="10.11":$v="El Capitan";break;
			case $v2==="10.12":$v="Sierra";break;
			case $v2==="10.12":$v="Fuji";break;
			default: $v=false;break;
	}
	return $v;
}


function  nicefedoraversion($v){
	switch ($v){
		case "3": $v = "Core 3 Heidelberg";break;
		case "4": $v = "Core 4 Stentz";
		case "5": $v = "Core 5 Bordeaux";break;
			case "6": $v ="Core 6 Zod";break;
		case "7": $v = "Moonshine";break;
		case "8": $v = "Werewolf";break;
		case "9": $v = "Sulphur"; break;
		case "10": $v= "Cambridge)";break;
		case "11": $v = "Leonidas";break;
		case "12": $v = "Constantine";break;
		case "13": $v = "Goddard"; break;
		case "14" : $v = 	"Laughlin";break;
		case "15": $v = "Lovelock"; break;
}
return $v;
}
function niceubuntuversion($v)
{
		switch ($v){
			case " 10.10"; $v = "Maverick";break;
			case " 10.04"; $v = "LTS Lucid Lynx";break;
			case " 9.10"; $v = "Karmic Koala";break;
			case "9.04": $v="Jaunty Jackalope";break;
			case "8.10": $v="Intrepid Ibex";break;
			case "8.04": $v="LTS Hardy Heron";break;
			case "7.10": $v="Gutsy Gibbon";break;
			case "7.04": $v="Feisty Fawn";break;
			case "6.10": $v = "10 Edgy Eft";break;
			case "6.04": $v="LTS Dapper Drake";break;
			case "5.10": $v = "Breezy Badger";break;
	}
	return $v;
}

function parse_user_agent($ua, $detRobots=false)
{
	$client_data = Array(
		"system" => "",
		"system_icon" => "unknown",
		"browser" => "",
		"browser_icon" => "unknown"
	);
    detectBrowser2($ua, $client_data);
    detectSystem($ua, $client_data);
    if ($detRobots) detectRobot($ua, $client_data);
    return $client_data;
}



function detectBrowser2($ua, &$client_data) {
	global $txt;
	
    // 
    // Check browsers
    // 
  
    // Camino
    if(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*Camino\/([\d\.]+).*/si', $ua, $matches))
      {
      $client_data['browser'] = "Camino" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'camino';
      }

    // Netscape
    elseif(preg_match('/mozilla.*netscape[0-9]?\/([0-9a-z\+\-\.]+).*/si', $ua, $matches))
      {
      $client_data['browser'] = "Netscape" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'netscape';
      }
      
    // Epiphany
    elseif(preg_match('/mozilla.*gecko\/[0-9]+.*epiphany\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) || preg_match('/mozilla.*applewebkit.*Epiphany\/([0-9\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Epiphany" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'epiphany';
      }

    // Galeon
    elseif(preg_match('/mozilla.*gecko\/[0-9]+.*galeon\/([0-9a-z\+\-\.]+).*/si', $ua, $matches))
      {
      $client_data['browser'] = "Galeon" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'galeon';
      }

    // Flock
    elseif(preg_match('/mozilla.*gecko\/[0-9]+.*flock\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) || preg_match('/mozilla.*applewebkit.*Flock\/([0-9\.]+).*/si', $ua, $matches) )
    {
      $client_data['browser'] = "Flock" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'flock';
      }

    // Minimo
    elseif(preg_match('/mozilla.*gecko\/[0-9]+.*minimo\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Minimo" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'mozilla';
      }

    // K-Meleon
    elseif(preg_match('/mozilla.*gecko\/[0-9]+.*k\-meleon\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "K-Meleon" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'k-meleon';
      }

    // K-Ninja
    elseif(preg_match('/mozilla.*gecko\/[0-9]+.*k-ninja\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "K-Ninja" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'k-ninja';
      }

    // Kazehakase
    elseif(preg_match('/mozilla.*gecko\/[0-9]+.*kazehakase\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Kazehakase" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'kazehakase';
      }

    // SeaMonkey
    elseif(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*seamonkey\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "SeaMonkey" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'seamonkey';
      }
      // Songbird
      elseif(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*Songbird\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Songbird" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'songbird';
      }

    // Iceape

    elseif(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*iceape\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Iceape" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'iceape';
      }
      
      // Fennec
    elseif(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*Fennec\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Fennec" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'fennec';
      }
      
      // Palemoon
      elseif(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*Palemoon\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Pale Moon" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'palemoon';
      }
      
      // Waterfox
      elseif(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*WaterFox\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "WaterFox" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'waterfox';
      }
      
      
      
      /* Cometbird */
      
            elseif(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*Cometbird\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Cometbird" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'cometbird';
      }
      
    // Firefox
    elseif(preg_match('/mozilla\/5\.0.*rv:[0-9\.]+.*gecko\/[0-9]+.*firefox\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Firefox" . ($matches[1] ? " ".$matches[1] : "");
       if (preg_match('/.*;.* x64;/si', $ua)) $client_data["browser"].= " (64 bit)";
      $client_data['browser_icon'] = 'firefox';
      }

    // Iceweasel

    elseif(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*iceweasel\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Iceweasel" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'iceweasel';
      }

    // Bon Echo
    elseif(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*BonEcho\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Bon Echo" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'deerpark';
      }

    // Gran Paradiso
    elseif(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*GranParadiso\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Gran Paradiso" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'deerpark';
      }

    // Shiretoko
    elseif(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*Shiretoko\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Shiretoko" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'deerpark';
      }

    // Minefield
    elseif(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*Minefield\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Minefield" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'minefield';
      }

    // Thunderbird
    elseif(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*thunderbird\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Thunderbird" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'thunderbird';
      }

    // Icedove

    elseif(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*icedove\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Icedove" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'icedove';
      }

    // Firebird
    elseif(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*firebird\/([0-9a-z\+\-\.]+).*/si', $ua, $matches))
      {
      $client_data['browser'] = "Firebird" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'phoenix';
      }

    // Phoenix
    elseif(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*phoenix\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Phoenix" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'phoenix';
      }
      
      // Other Gecko based browser

    elseif(preg_match('/mozilla.*rv:([0-9\.]+).*gecko\/[0-9]+ ([\w\s]+)\/([\d\.]+)*/si', $ua, $matches) )
      {
      $client_data['browser'] = $matches[2]." ".$matches[3]. " (Gecko".$matches[1]." ".$txt['OS_Browser_Compatible'].")";
      $client_data['browser_icon'] = "deerpark";
   }

      
    // Konqueror
    elseif(preg_match('/mozilla.*konqueror\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Konqueror" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'konqueror';
      if(preg_match('/khtml\/([0-9a-z\+\-\.]+).*/si', $ua, $matches))
        {
        $client_data['browser'] = "Konqueror" . ($matches[1] ? " ".$matches[1] : "");
	}
      }

	// Opera
    elseif((preg_match('/opera ([0-9a-z\+\-\.]+).*/si', $ua, $matches) || preg_match('/^opera\/([0-9a-z\+\-\.]+).*/si', $ua, $matches)) )
      {
      $client_data['browser'] = "Opera" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'opera';
      if (preg_match('/opera mini/si', $ua))
        {
        preg_match('/opera mini\/([0-9a-z\+\-\.]+).*/si', $ua, $matches);
        $client_data['browser'] .= " (Opera Mini" . ($matches[1] ? " ".$matches[1] : "") . ")";
        }
      elseif(preg_match('/Version\/([0-9]+\.[0-9]+)/', $ua, $matches)) 
        {
        $client_data['browser'] = "Opera " . $matches[1];
        }
    }

    // OmniWeb
    elseif(preg_match('/mozilla.*applewebkit\/[0-9]+.*omniweb\/v[0-9\.]+/si', $ua, $matches) )
      {
      $client_data['browser'] = "OmniWeb";
      $client_data['browser_icon'] = 'omniweb';
      }

    // SunriseBrowser
    elseif(preg_match('/mozilla.*applewebkit\/[0-9]+.*sunrisebrowser\/([0-9a-z\+\-\.]+)/si', $ua, $matches) )
      {
      $client_data['browser'] = "SunriseBrowser" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'sunrise';
      }

    // DeskBrowse
    elseif(preg_match('/mozilla.*applewebkit\/[0-9]+.*deskbrowse\/([0-9a-z\+\-\.]+)/si', $ua, $matches) )
      {
      $client_data['browser'] = "DeskBrowse" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'deskbrowse';
      }

    // Shiira
    elseif(preg_match('/mozilla.*applewebkit.*shiira\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Shiira" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'shiira';
      }
      // Iron
      elseif(preg_match('/mozilla.*applewebkit.*Iron\/([0-9\.]+).*/si', $ua, $matches) )
      {
	      $client_data['browser'] = "Iron" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'iron';
    }
    
    // Midori
    elseif(preg_match('/^amaya\/([0-9\.]+).*libwww.*/si', $ua, $matches) )
      {
	      $client_data['browser'] = "Amaya" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'amaya';
    }
    // Midori
    elseif(preg_match('/Midori\/([0-9\.]+).*Webkit.*/si', $ua, $matches) )
      {
	      $client_data['browser'] = "Midori" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'midori';
    }
    
    // Arora
    elseif(preg_match('/mozilla.*applewebkit.*Arora\/([0-9\.]+).*/si', $ua, $matches) )
      {
	      $client_data['browser'] = "Arora" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'arora';
    }
    
    // Chromium
    elseif(preg_match('/mozilla.*applewebkit.*Chromium\/([0-9a-z\+\-\.]+).*/si', $ua, $matches)  )
      {
      $client_data['browser'] = "Chromium" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'chromium';
      }
      
      // Comodo Dragon 
    
    elseif(preg_match('/mozilla.*applewebkit.*Comodo_Dragon\/([0-9\.]+)/si', $ua, $matches) ) {
			$client_data['browser'] = "Comodo Dragon" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'dragon';
    }
    
    // Edge by Mycrosoft
    
    elseif(preg_match('/mozilla.*applewebkit.*Edge\/([0-9\.]+)/si', $ua, $matches) ) {
			$client_data['browser'] = "Edge" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'edge';
    }
    
    // vivaldi
    
    elseif(preg_match('/mozilla.*applewebkit.*Vivaldi\/([0-9\.]+)/si', $ua, $matches) ) {
			$client_data['browser'] = "Vivaldi" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'vivaldi';
    }
    // Dooble
    
    elseif(preg_match('/mozilla.*applewebkit.*Dooble\/([0-9\.]+)/si', $ua, $matches) ) {
			$client_data['browser'] = "Dooble Web Browser" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'dooble';
    }
    
    

    // Chrome
    elseif(preg_match('/mozilla.*applewebkit.*chrome\/([0-9a-z\+\-\.]+).*/si', $ua, $matches)  )
      {
      $client_data['browser'] = "Chrome" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'chrome';
      }
      
		// Maxthon (new version based on webkit
		elseif(preg_match('/mozilla.*applewebkit.*Maxthon\/([0-9\.]+)/si', $ua, $matches) ) {
			$client_data['browser'] = "Maxthon" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'maxthon';
    }
    
    // Safari (use version string if available)
    elseif(preg_match('/mozilla.*applewebkit.*version\/([0-9\.]+).*safari\/[0-9a-z\+\-\.]+/si', $ua, $matches))
      {
      $client_data['browser'] = "Safari" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'safari';
			}
			
			      // MSIe and MSIE based browser
      
            // Avant Browser
      elseif(preg_match('/mozilla.*MSIE.*Avant Browser.*/si', $ua )) {
	      $client_data['browser'] = "Avant Browser" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'avantbrowser';
   }
   // Slim Browser
      elseif(preg_match('/mozilla.*MSIE.*Slim\s*Browser.*/si', $ua )) {
	      $client_data['browser'] = "SlimBrowser" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'slimbrowser	';
   }
   
   // Maxthon (before passing to webkit
      elseif(preg_match('/mozilla.*MSIE.*Maxthon.*/si', $ua )) {
	      $client_data['browser'] = "Maxthon" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'maxthon	';
   }
      // Sleipnir
      elseif(preg_match('/mozilla.*MSIE.*Sleipnir\/([0-9\.]+).*/si', $ua, $matches) ) {
	      $client_data['browser'] = "Sleipnir" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'sleipnir';
   }



    // MSIE
    elseif(preg_match('/microsoft.*internet.*explorer/si', $ua, $matches) )
      {
      $client_data['browser'] = "MS Internet Explorer 1.0";
      $client_data['browser_icon'] = 'msie';
      }
    elseif(preg_match('/mozilla.*MSIE ([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "MS Internet Explorer" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'msie';
      }
      
      // Internet Explorer 11+
      
      elseif(preg_match('/mozilla\/5\.0.*Trident.*MAARJS; rv:([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "MS Internet Explorer" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'msie';
      }
      // Navigator
      
    elseif(preg_match('/mozilla.*navigator[0-9]?\/([0-9a-z\+\-\.]+).*/si', $ua, $matches))
      {
      $client_data['browser'] = "Netscape" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'netscape';
      }
			
    // Dillo
    
    elseif(preg_match('/dillo\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Dillo" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'dillo';
      }
      
      // Dolfin
      elseif(preg_match('/Dolfin\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Dolfin" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'dolfin';
      }
      
      // Jasmine
      elseif(preg_match('/Jasmine\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Jasmine" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'jasmine';
      }

    // iCab
    elseif(preg_match('/icab\/([0-9a-z\+\-\.]+).*/si', $ua, $matches))
      {
      $client_data['browser'] = "iCab" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'icab';
      }
      
      // Tapatalk
      
      elseif (preg_match("/Mozilla\/5\.0.*\bTapatalk\b/si", $ua, $matches)){
	     $client_data["browser"] = "Tapatalk";
	     $client_data["browser_icon"] = "tapatalk";
     }
     
      
      // W3M
      
      elseif(preg_match('/^w3m\/([0-9a-z\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "W3M" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'w3m';
      }

    // Lynx
    elseif(preg_match('/^lynx\/([0-9a-z\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Lynx" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'lynx';
      }

    // Links
    elseif(preg_match('/^links \(([0-9a-z\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Links" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'links';
      }

    // Elinks
    elseif(preg_match('/^elinks \(([0-9a-z\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "ELinks" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'links';
      }
    elseif(preg_match('/^elinks\/([0-9a-z\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "ELinks" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'links';
      }
    elseif(preg_match('/^elinks$/si', $ua, $matches) )
      {
      $client_data['browser'] = "ELinks";
      $client_data['browser_icon'] = 'links';
      }
      

    // Amiga Aweb
    elseif(preg_match('/Amiga\-Aweb\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Amiga Aweb" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'aweb';
      }

    // Amiga Voyager
    elseif(preg_match('/AmigaVoyager\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Amiga Voyager" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'voyager';
      }

    // QNX Voyager
    elseif(preg_match('/QNX Voyager ([0-9a-z.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "QNX Voyager" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'qnx';
      }

    // IBrowse
    elseif(preg_match('/IBrowse\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "IBrowse" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'ibrowse';
      }

    // Openwave
    elseif(preg_match('/UP\.Browser\/([0-9a-zA-Z\.]+).*/s', $ua, $matches) )
      {
      $client_data['browser'] = "Openwave" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'openwave';
      }
    elseif(preg_match('/UP\/([0-9a-zA-Z\.]+).*/s', $ua, $matches) )
      {
      $client_data['browser'] = "Openwave" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'openwave';
      }

    // NetFront
    elseif(preg_match('/NetFront\/([0-9a-z\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "NetFront" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'netfront';
      }

    // PlayStation Portable
    elseif(preg_match('/psp.*playstation.*portable[^0-9]*([0-9a-z\.]+)\)/si', $ua, $matches) )
      {
      $client_data['browser'] = "PSP" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'playstation';
      }

    // Netscape Navigator
    elseif(preg_match('/Mozilla\/([0-4][0-9\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Netscape Navigator" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'netscape_old';
      }
      
      // Firefox for iOS
      
      elseif(preg_match('/Mozilla\/5\.0.*\(KHTML, like Gecko\) FxiOS\/([0-9\.]+).*/si', $ua, $matches) )
      {
	      	$client_data['browser'] = "Firefox per iOS" . ($matches[1] ? " ".$matches[1] : "");
	      	$client_data['browser_icon'] = 'firefox';
      	}

    // Catch all for other Webkit compatible browser
    elseif(preg_match('/Webkit|KHTML/si', $ua, $matches) )
      {
      $client_data['browser'] = "Webkit " . $txt['OS_Browser_Compatible'];
      $client_data['browser_icon'] = 'webkit';
      }
      
      // Easter Egg
      elseif ($ua=="3.14159265") {
	      	$client_data["browser"] = "Discovery";
	      	$client_data["browser_icon"] = "discovery";
      } 
}   // End of detect browser function

function detectSystem($ua, &$client_data){
	// $client_data["system"] = "";
	
	    // Windows
    if(preg_match('/Windows nt ([0-9\.]+).*/si',	 $ua, $matches) ||  preg_match('/Windows (me)/si', $ua, $matches) || preg_match('/Windows ([\d\.]+)/si', $ua, $matches)  )
      {
      $client_data = array_merge($client_data, nicewinversion($matches[1]));
      }
      elseif (preg_match('/Windows CE/si', $ua, $matches) )
      {
	      	$client_data["system"] = "Windows CE";
	      	$client_data["system_icon"] = "win_old";
      }
      elseif (preg_match('/Windows NT|Windows/si', $ua, $matches) )
      {
	      	$client_data["system"] = "Windows";
	      	$client_data["system_icon"] = "win_old";
      }
      
      // Android

   elseif (preg_match('/Android[\b\s]*([\d\.]+)*.*/si', $ua, $matches)) 
        {
	        $client_data["system"].=(isset( $matches[1])) ? " Android ".$matches[1] : "Android";
	        $client_data["system_icon"] = "android";
        }
    // Linux
    elseif(preg_match('/linux/si', $ua))
      {
      $client_data['system'] = "Linux";
      $client_data['system_icon'] = "linux";
      if(preg_match('/mdv/si', $ua) || preg_match('/mandriva/si', $ua))
        {
        $client_data['system'] .= " (Mandriva";
        $client_data['system_icon'] = "mandriva";
        // Try to detect version
        if(preg_match('/mdv([0-9.]*)/si', $ua, $matches))
          {
          $client_data['system'] .= ($matches[1] ? " ".$matches[1].")" : ")");
          }
        else
	  {
          $client_data['system'] .= ")";
	  }
        }
      elseif(preg_match('/mdk/si', $ua))
        {
        $client_data['system'] .= " (Mandrake)";
        $client_data['system_icon'] = "mandriva";
        }
      elseif(preg_match('/kanotix/si', $ua))
        {
        $client_data['system'] .= " (Kanotix)";
        $client_data['system_icon'] = "kanotix";
        }
      elseif(preg_match('/lycoris/si', $ua))
        {
        $client_data['system'] .= " (Lycoris)";
        $client_data['system_icon'] = "lycoris";
        }
      elseif(preg_match('/knoppix/si', $ua))
        {
        $client_data['system'] .= " (Knoppix)";
        $client_data['system_icon'] = "knoppix";
        }
      elseif(preg_match('/centos/si', $ua))
        {
        $client_data['system'] .= " (CentOS)";
        $client_data['system_icon'] = "centos";
        // Try to detect version
        if(preg_match('/\.el3/si', $ua))
          {
          $client_data['system'] .= " 3.x)";
          }
        elseif(preg_match('/\.el4/si', $ua))
          {
          $client_data['system'] .= " 4.x)";
          }
        elseif(preg_match('/\.el5/si', $ua))
          {
          $client_data['system'] .= " 5.x)";
          }
        else
	  {
          $client_data['system'] .= ")";
	  }
        }
      elseif(preg_match('/gentoo/si', $ua))
        {
        $client_data['system'] .= " (Gentoo)";
        $client_data['system_icon'] = "gentoo";
        }
      elseif(preg_match('/(?:fedora)+(?:.*\.fc([\d+]+))*/si', $ua, $matches))          {
	      $client_data["system"].=" ". rtrim("(Fedora ".nicefedoraversion($matches[1])).")";
	      $client_data["system_icon"] = "fedora";
     }
        // Kubuntu / Xubuntu
        elseif (preg_match("/\b(Xubuntu|Kubuntu)\b/si", $ua, $matches))
        {
	        	$client_data["system"].= " (". $matches[1].")";
	        	$client_data["system_icon"] = strtolower($matches[1]);
        }
        
        // Ubuntu
        
        elseif (preg_match("/Ubuntu(?:\/|\b)*([\d\.]+)/si", $ua, $matches)){
        	$client_data["system"].=" (Ubuntu ".niceubuntuversion($matches[1]).")";
        	$client_data["system_icon"] = "ubuntu";
      }
	        	
			// Slachware
			
      elseif(preg_match('/slackware/si', $ua))
        {
        $client_data['system'] .= " (Slackware)";
        $client_data['system_icon'] = "slackware";
        }
      elseif(preg_match('/pclinuxos/si', $ua))
        {
        $client_data['system'] .= " (PCLinuxOS)";
        $client_data['system_icon'] = "pclinuxos";
        }
      elseif(preg_match('/zenwalk ([0-9.]*)/si', $ua, $matches))
        {
        $client_data['system'] .= " (Zenwalk".($matches[1] ? " ".$matches[1] : "").")";
        $client_data['system_icon'] = "zenwalk";
        }
      elseif(preg_match('/suse/si', $ua))
        {
        $client_data['system'] .= " (Suse)";
        $client_data['system_icon'] = "suse";
        }
      elseif(preg_match('/redhat/si', $ua) || preg_match('/red hat/si', $ua))
        {
        $client_data['system'] .= " (Red Hat";
        $client_data['system_icon'] = "redhat";
        // Try to detect version
        if(preg_match('/\.el4/si', $ua))
          {
          $client_data['system'] .= " Enterprise Linux 4.x)";
          }
        elseif(preg_match('/\.el5/si', $ua))
          {
          $client_data['system'] .= " Enterprise Linux 5.x)";
          }
        else
	  {
          $client_data['system'] .= ")";
	  }
        }
      elseif(preg_match('/debian/si', $ua))
        {
        $client_data['system'] .= " (Debian)";
        $client_data['system_icon'] = "debian";
        }
        elseif (preg_match('/Maemo ([0-9\.]*).*/si', $ua, $matches)) 
        {
	        $client_data["system"].=  "(Maemo)" . ($matches[1] ? " ".$matches[1] : "");
	        $client_data["system_icon"] = "maemo";
        }
        
        // Mint. this is the smartest regex, I would like to  use regex like this for all checks.

        elseif (preg_match("/(?:Mint)+(?:(?:\/([\d\.]+)*)(?:\s\(([\w\s]+))*)*/si",$ua, $matches) )
        {
	        $client_data["system"].= rtrim(" (Mint ". $matches[1]." ".$matches[2]).")";
	        $client_data["system_icon"] = "mint";
        }
        elseif (preg_match('/Pardus/', $ua))
        {
	        $client_data["system"].=" (Pardus)";
	        $client_data["system_icon"] = "pardus";
        }
      elseif(preg_match('/PLD\/([0-9.]*) \(([a-z]{2})\)/si', $ua, $matches))
        {
        $client_data['system'] .= " (PLD".($matches[1] ? " ".$matches[1] : "").($matches[2] ? " ".$matches[2] : "").")";
        $client_data['system_icon'] = "pld";
        }
      elseif(preg_match('/PLD\/([a-zA-Z.]*)/si', $ua, $matches))
        {
        $client_data['system'] .= " (PLD".($matches[1] ? " ".$matches[1] : "").")";
        $client_data['system_icon'] = "pld";
        }
      }

    // BSD
    elseif(preg_match('/bsd/si', $ua) )
      {
      $client_data['system'] = "BSD";
      $client_data['system_icon'] = "bsd";
      if (preg_match('/freebsd/si', $ua))
        {
        $client_data['system'] = "FreeBSD";
        }
      elseif(preg_match('/openbsd/si', $ua))
        {
        $client_data['system'] = "OpenBSD";
        }
      elseif(preg_match('/netbsd/si', $ua))
        {
        $client_data['system'] = "NetBSD";
        }
      }

    // Mac OS (X)
    elseif (preg_match("/mac|68k|powerpc/si", $ua))
    {
      $client_data['system'] = "Mac OS";
      $client_data['system_icon'] = "macos";
            if (preg_match("/(iPhone|iPad)/si", $ua, $matches))
        {
	        $client_data["system"] =  $matches[1];
	        $client_data["system_icon"] =  strtolower($matches[1]);
        }
      elseif(preg_match('/mac os x(?:\s|\b)([0-9\._]+)?/si', $ua, $matches)){
        $client_data['system'] .= " X";
       $matches[1]=str_replace("_",".", $matches[1]);
        $client_data['system'] .= (isset($matches[1])) ? " ".$matches[1]." ".nicemacversion($matches[1]) : "";
      }
   }  // End of user agent that contain Linux
   
   
   
    // ReactOS
    elseif(preg_match('/ReactOS ([0-9a-zA-Z\+\-\. ]+).*/s', $ua, $matches))
      {
      $client_data['system'] = "ReactOS" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['system_icon'] = "reactos";
      }

    // SunOs
    elseif(preg_match('/sunos/si', $ua) )
      {
      $client_data['system'] = "Solaris";
      $client_data['system_icon'] = "solaris";
      }

    // Syllable
    elseif(preg_match('/syllable/si', $ua) )
      {
      $client_data['system'] = "Syllable";
      $client_data['system_icon'] = "syllable";
      }
	  
    // Amiga
    elseif(preg_match('/amiga/si', $ua) )
      {
      $client_data['system'] = "Amiga";
      $client_data['system_icon'] = "amiga";
      }

    // Irix
    elseif(preg_match('/irix/si', $ua) )
      {
      $client_data['system'] = "IRIX";
      $client_data['system_icon'] = "irix";
      }

    // OpenVMS
    elseif(preg_match('/open.*vms/si', $ua) )
      {
      $client_data['system'] = "OpenVMS";
      $client_data['system_icon'] = "openvms";
      }

    // BeOs
    elseif(preg_match('/beos/si', $ua) )
      {
      $client_data['system'] = "BeOS";
      $client_data['system_icon'] = "beos";
      }

    // QNX
    elseif(preg_match('/QNX/si', $ua) && preg_match('/Photon/si', $ua) )
      {
      $client_data['system'] = "QNX";
      $client_data['system_icon'] = "qnx";
      }

    // OS/2 Warp
    elseif(preg_match('/OS\/2.*Warp ([0-9.]+).*/si', $ua, $matches) )
      {
      $client_data['system'] = "OS/2 Warp" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['system_icon'] = "os2";
      }

    // Java on mobile
    elseif(preg_match('/j2me/si', $ua) )
      {
      $client_data['system'] = "Java Platform Micro Edition";
      $client_data['system_icon'] = "java";
      }

    // Symbian Os
    elseif(preg_match('/symbian|SymbOS/si', $ua) )
      {
      $client_data['system'] = "Symbian OS";
      $client_data['system_icon'] = "symbian";
      // try to get version
      if(preg_match('/SymbianOS\/([0-9a-z\+\-\.]+).*/si', $ua, $matches))
        {
	$client_data['system'] .= ($matches[1] ? " ".$matches[1] : "");
	}
      }

    // Palm Os
    elseif(preg_match('/palmos/si', $ua) )
      {
      $client_data['system'] = "Palm OS";
      $client_data['system_icon'] = "palmos";
      // try to get version
      if(preg_match('/PalmOS ([0-9a-z\+\-\.]+).*/si', $ua, $matches))
        {
	$client_data['system'] .= ($matches[1] ? " ".$matches[1] : "");
	}
      }

    // PlayStation Portable
    elseif(preg_match('/psp.*playstation.*portable/si', $ua) )
      {
      $client_data['system'] = "PlayStation Portable";
      $client_data['system_icon'] = 'playstation';
      }

    // Nintentdo Wii
    elseif(preg_match('/Nintendo Wii/si', $ua) )
      {
      $client_data['system'] = "Nintendo Wii";
      $client_data['system_icon'] = 'wii';
      }
      
      elseif ($ua=="3.14159265") {
	      $client_data["system"] = "Hal 9000";
	      $client_data["system_icon"] = "hal9000";
     }

    // Try to detect some mobile devices...

        
    $client_data["pda"]="";
    // Nokia
    if(preg_match('/Nokia[ ]{0,1}([0-9a-zA-Z\+\-\.]+){0,1}.*/s', $ua, $matches)) $client_data['pda']= "Nokia" . ($matches[1] ? " ".$matches[1] : "");

    		// Motorola
    elseif(preg_match('/mot\-([0-9a-zA-Z\+\-\.]+){0,1}\//si', $ua, $matches))
	$client_data['pda'] = "Motorola" . ($matches[1] ? " ".$matches[1] : "");
    elseif(preg_match('/sie\-([0-9a-zA-Z\+\-\.]+){0,1}\//si', $ua, $matches)) $client_data['pda'] = "Siemens" . ($matches[1] ? " ".$matches[1] : "");
    
    // Kindle
    elseif (preg_match("/Mozilla\/5\.0.*\bKindle|Silk\b/si", $ua, $matches)){
	     $client_data['system'] = "Kindle";
	     $client_data["system_icon"] = "kindle";
     }
    // Samsung
    elseif(preg_match('/samsung\-([0-9a-zA-Z\+\-\.]+){0,1}\//si', $ua, $matches)) $client_data['pda'] = "Samsung" . ($matches[1] ? " ".$matches[1] : "");
    // SonyEricsson & Ericsson
    elseif(preg_match('/SonyEricsson[ ]{0,1}([0-9a-zA-Z\+\-\.]+){0,1}.*/s', $ua, $matches)) $client_data['pda'] = " / Sony Ericsson" . ($matches[1] ? " ".$matches[1] : "");
    elseif(preg_match('/Ericsson[ ]{0,1}([0-9a-zA-Z\+\-\.]+){0,1}.*/s', $ua, $matches)) $client_data['pda'] = "Ericsson" . ($matches[1] ? " ".$matches[1] : "");
    
    // Alcatel
    elseif(preg_match('/Alcatel\-([0-9a-zA-Z\+\-\.]+){0,1}.*/s', $ua, $matches)) $client_data['pda'] = "Alcatel" . ($matches[1] ? " ".$matches[1] : "");

    // Panasonic
    elseif(preg_match('/Panasonic\-{0,1}([0-9a-zA-Z\+\-\.]+){0,1}.*/s', $ua, $matches)) $client_data['pda'] = "Panasonic" . ($matches[1] ? " ".$matches[1] : "");

    // Philips
    elseif(preg_match('/Philips\-([0-9a-z\+\-\@\.]+){0,1}.*/si', $ua, $matches)) $client_data['pda'] = "Philips" . ($matches[1] ? " ".$matches[1] : "");
    elseif(preg_match('/Acer\-([0-9a-z\+\-\.]+){0,1}.*/si', $ua, $matches)) $client_data['pda'] = "Acer" . ($matches[1] ? " ".$matches[1] : "");
    // BlackBerry
    elseif(preg_match('/BlackBerry(?:\b)*(?:([0-9a-zA-Z\+\-\.]+)\/)?/si', $ua, $matches)) $client_data['pda'] = "BlackBerry" . ($matches[1] ? " ".$matches[1] : "");
	
    if ($client_data["pda"] != "") {
	    	if ($client_data["system"]!="") $client_data["system"].= " (".$client_data["pda"].")";
	    	else {
		    	$client_data["system"]  =$client_data["pda"];
		   $client_data["system_icon"] = "mobile";
	   }
	    if ($client_data["browser"]=="") {
		    $client_data["browser"] = "Mobile";
		    $client_data["browser_icon"] = "mobile";
}}
}  // End of detectSystem function

function detectRobot($ua, &$client_data)
{
	if ($client_data["browser"]==""){
	// Various robots and not human browser like wget
    // Googlebot
    if (preg_match('/Googlebot\/([0-9a-z\+\-\.]+).*/s', $ua, $matches) )
      {
      $client_data['browser'] = "Googlebot" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'google';
      }

    // Googlebot Image
    elseif(preg_match('/Googlebot\-Image\/([0-9a-z\+\-\.]+).*/s', $ua, $matches) )
      {
      $client_data['browser'] = "Googlebot Image " . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'google';
      }
      
      // FeedBurner
      
      elseif (preg_match("/^FeedBurner\/*([\d\.]*)/", $ua, $matches))
      {
	      	$client_data["browser"] = ($matches[1]) ? "FeedBurner ".$matches[1] : "Feedburner";
	      	$client_data["browser_icon"] ="feedburner";
      }

    // Gigabot
    elseif(preg_match('/Gigabot\/([0-9a-z\+\-\.]+).*/s', $ua, $matches) )
      {
      $client_data['browser'] = "Gigabot" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'gigabot';
      }

    // W3C Validator
    elseif(preg_match('/^W3C_Validator\/([0-9a-z\+\-\.]+)$/s', $ua, $matches) )
      {
      $client_data['browser'] = "W3C Validator" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'w3c';
      }

    // W3C CSS Validator
    elseif(preg_match('/W3C_CSS_Validator_[a-z]+\/([0-9a-z\+\-\.]+)$/s', $ua, $matches) )
      {
      $client_data['browser'] = "W3C CSS Validator" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // MSN Bot
    elseif(preg_match('/msnbot(-media|)\/([0-9a-z\+\-\.]+).*/s', $ua, $matches) )
      {
      $client_data['browser'] = "MSNBot" . ($matches[2] ? " ".$matches[2] : "");
      $client_data['browser_icon'] = 'w3c';
      }

    // Psbot
    elseif(preg_match('/psbot\/([0-9a-z\+\-\.]+).*/s', $ua, $matches) )
      {
      $client_data['browser'] = "Psbot" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'psbot';
      }

    // IRL crawler
    elseif(preg_match('/IRLbot\/([0-9a-z\+\-\.]+).*/s', $ua, $matches) )
      {
      $client_data['browser'] = "IRL crawler" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // Seekbot
    elseif(preg_match('/Seekbot\/([0-9a-z\+\-\.]+).*/s', $ua, $matches) )
      {
      $client_data['browser'] = "Seekport Robot" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // Microsoft Research Bot
    elseif(preg_match('/^MSRBOT /s', $ua) )
      {
      $client_data['browser'] = "MSRBot";
      $client_data['browser_icon'] = 'robot';
      }

    // cfetch/voyager
    elseif(preg_match('/^(cfetch|voyager)\/([0-9a-z\+\-\.]+)$/s', $ua, $matches) )
      {
      $client_data['browser'] = "voyager" . ($matches[2] ? " ".$matches[2] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // BecomeBot
    elseif(preg_match('/BecomeBot\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "BecomeBot" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // SnapBot
    elseif(preg_match('/SnapBot\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "SnapBot" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // Yeti
    elseif(preg_match('/Yeti\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Yeti" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'robot';
      }
    // Yandex
    elseif(preg_match('/Yandex\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Yandex Crawler" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // spbot
    elseif(preg_match('/spbot\/([0-9a-z\+\-\.]+); \+http:\/\/www\.seoprofiler\.com\//si', $ua, $matches) )
      {
      $client_data['browser'] = "SEOprofiler.com bot" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // DotBot
    elseif(preg_match('/DotBot\/([0-9a-z\+\-\.]+); http:\/\/www\.dotnetdotcom\.org\//si', $ua, $matches) )
      {
      $client_data['browser'] = "DotBot" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'robot';
      }
	
    // Twiceler
    elseif(preg_match('/Twiceler-([0-9\.]+) http:\/\/www.cuill.com/si', $ua, $matches) )
      {
      $client_data['browser'] = "Twiceler" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // Alexa
    elseif(preg_match('/^ia_archiver$/s', $ua) )
      {
      $client_data['browser'] = "Alexa";
      $client_data['browser_icon'] = 'robot';
      }

    // Inktomi Slurp
    elseif(preg_match('/Slurp.*inktomi/s', $ua) )
      {
      $client_data['browser'] = "Inktomi Slurp";
      $client_data['browser_icon'] = 'robot';
      }

    // Yahoo Slurp
    elseif(preg_match('/Yahoo!.*Slurp/s', $ua) )
      {
      $client_data['browser'] = "Yahoo! Slurp";
      $client_data['browser_icon'] = 'yahoo';
      }
      
      // Bingbot
      
      elseif (preg_match("/Bingbot\/*([\d\.]*)/si", $ua, $matches)){
	      	$client_data["browser"] = ($matches[1]) ? "Bingbot ".$matches[1] : "Bingbot";
	      	$client_data["browser_icon"] = "bing";
      }

    // Ask.com
    elseif(preg_match('/Ask Jeeves\/Teoma/s', $ua) )
      {
      $client_data['browser'] = "Ask.com";
      $client_data['browser_icon'] = "askcom";
      }
      // Wget
      
    elseif(preg_match('/^Wget\/([0-9a-z\+\-\.]+).*/si', $ua, $matches) )
      {
      $client_data['browser'] = "Wget" . ($matches[1] ? " ".$matches[1] : "");
      $client_data['browser_icon'] = 'wget';
      }
      elseif (preg_match("/^Python/si", $ua)){
      	$client_data["browser"] = "Python";
      	$client_data["browser_icon"] = "python";
    }	
      if ($client_data["browser"] != ""){
	      $client_data["system"] = "Robot";
	      $client_data["system_icon"] = "robot";
		}
}
}
?>
