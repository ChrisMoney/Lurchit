<?php 

function detectEmojis($string) {
    $newString = $string;
    
    // encode emoji from database to find out what emoji we have
    $string = json_encode($string);
    
    // replace all emoji unicode instances with hex (decimal) values
    
    // hash
    $string = str_replace('\u0023', '&#35;', $string);
    
    // zero
    $string = str_replace('\u0030', '&#48;', $string);
    
    // one
    $string = str_replace('\u0031', '&#49;', $string);
    
    // two
    $string = str_replace('\u0032', '&#50;', $string);
    
    // three
    $string = str_replace('\u0033', '&#51;', $string);
    
    // four
    $string = str_replace('\u0034', '&#52;', $string);
    
    // five
    $string = str_replace('\u0035', '&#53;', $string);
    
    // six
    $string = str_replace('\u0036', '&#54;', $string);
    
    // seven
    $string = str_replace('\u0037', '&#55;', $string);
    
    // eight
    $string = str_replace('\u0038', '&#56;', $string);
    
    // nine
    $string = str_replace('\u0039', '&#57;', $string);
    
    // copyright
    $string = str_replace('\u00A9', '&#169;', $string);
    
    // registered
    $string = str_replace('\u00AE', '&#174;', $string);
    
    // bang bang
    $string = str_replace('\u203C', '&#8252;', $string);
    
    // exclamation question mark
    $string = str_replace('\u2049', '&#8265;', $string);
    
    // TM (Trademark)
    $string = str_replace('\u2122', '&#8482;', $string);
    
    // I Information Source
    $string = str_replace('"\u2139', '&#8505;', $string);
    
    // Left - Right Arrow
    $string = str_replace('\u2194', '&#8596;', $string);
    
    // arrow up - down
    $string = str_replace('\u2195', '&#8597;', $string);
    
    // arrow upper left
    $string = str_replace('\u2196', '&#8598;', $string);
    
    // arrow upper right
    $string = str_replace('\u2197', '&#8599;', $string);
    
    // arrow lower right
    $string = str_replace('\u2198', '&#8600;', $string);
    
    // arrow lower left
    $string = str_replace('\u2199', '&#8601;', $string);
    
    // arrow left with hook
    $string = str_replace('\u21A9"', '&#8617;', $string);
    
    // arrow right with hook
    $string = str_replace('\u21AA', '&#8618;', $string);
    
    // watch
    $string = str_replace('\u231A', '&#8986;', $string);
    
    // hour glass
    $string = str_replace('\u231B', '&#8987;', $string);
    
    // fast forward
    $string = str_replace('\u23E9', '&#9193;', $string);
    
    // rewind
    $string = str_replace('u23EA', '&#9194;', $string);
    
    // arrow double up
    $string = str_replace('\u23EB', '&#9195;', $string);
    
    // arrow double down
    $string = str_replace('\u23EC', '&#9196;', $string);
    
    // alarm clock
    $string = str_replace('\u23F0', '&#9200;', $string);
    
    // hour glass
    $string = str_replace('\u23F3', '&#9203;', $string);
    
    // M
    $string = str_replace('\u24C2', '&#9410;', $string);
    
    // black small square
    $string = str_replace('\u25AA', '&#9642;', $string);
    
    // small white square
    $string = str_replace('\u25AB', '&#9643;', $string);
    
    // arrow forward
    $string = str_replace('\u25B6', '&#9654;', $string);
    
    // arrow backward
    $string = str_replace('\u25C0', '&#9664;', $string);
    
    // white medium square
    $string = str_replace('\u25FB', '&#9723;', $string);
    
    // black medium square
    $string = str_replace('\u25FC', '&#9724;', $string);
    
    // white medium small square
    $string = str_replace('\u25FB', '&#9723;', $string);
    
    // black medium small square
    $string = str_replace('\u25FE', '&#9726;', $string);
    
    // sunny
    $string = str_replace('\u2600', '&#9728;', $string);
    
    // cloud
    $string = str_replace('\u2601', '&#9729;', $string);
    
    // telephone
    $string = str_replace('\u260E', '&#9742;', $string);
    
    // ballot box with check
    $string = str_replace('\u2611', '&#9745;', $string);
    
    // umbrella
    $string = str_replace('\u2614', '&#9748;', $string);
    
    // coffee
    $string = str_replace('\u2615', '&#9749;', $string);
    
    // point up
    $string = str_replace('\u261D', '&#9757;', $string);
    
    // smiley face (relaxed)
    $string = str_replace('\u263A', '&#9786;', $string);
    
    // aries
    $string = str_replace('\u2648', '&#9800;', $string);
    
    // taraus
    $string = str_replace('\u2649', '&#9801;', $string);
    
    // gemini
    $string = str_replace('\u264A', '&#9802;', $string);
    
    // cancer
    $string = str_replace('\u264B', '&#9803;', $string);
    
    // leo
    $string = str_replace('\u264C', '&#9804;', $string);
    
    // vrigo
    $string = str_replace('\u264D', '&#9805;', $string);
    
    // libra
    $string = str_replace('\u264E', '&#9806;', $string);
    
    // scorpius
    $string = str_replace('\u264F', '&#9807;', $string);
    
    // sagittarius
    $string = str_replace('\u2650', '&#9808;', $string);
    
    // capricorn
    $string = str_replace('\u2651', '&#9809;', $string);
    
    // aquarius
    $string = str_replace('\u2652', '&#9810;', $string);
    
    // pisces
    $string = str_replace('\u2653', '&#9811;', $string);
    
    // spaces
    $string = str_replace('\u2660', '&#9824;', $string);
    
    // clubs
    $string = str_replace('\u2663', '&#9827;', $string);
    
    // hearts
    $string = str_replace('\u2665', '&#9829;', $string);
    
    // diamonds
    $string = str_replace('\u2666', '&#9830;', $string);
    
    // hotsprings
    $string = str_replace('\u2668', '&#9832;', $string);
    
    // recycle
    $string = str_replace('\u267B', '&#9851;', $string);
    
    // wheelchair
    $string = str_replace('\u267F', '&#9855;', $string);
    
    // anchor
    $string = str_replace('\u2693', '&#9875;', $string);
    
    // warning
    $string = str_replace('\u26A0', '&#9888;', $string);
    
    // smiley heart eyes
    $string = str_replace('\ud83d\ude0d', '&#128525;', $string);
    
    // zap
    $string = str_replace('\u26A1', '&#9889;', $string);
    
    // white circle
    $string = str_replace('\u26AA', '&#9898;', $string);
    
    // black circle
    $string = str_replace('\u26AB', '&#9899;', $string);
    
    // soccer ball
    $string = str_replace('\u26BD', '&#9917;', $string);
    
    // baseball
    $string = str_replace('\u26BE', '&#9918;', $string);
    
    // snowman
    $string = str_replace('\u26C4', '&#9924;', $string);
    
    // partly sunny
    $string = str_replace('\u26C5', '&#9925;', $string);
    
    // ophiuchus
    $string = str_replace('\u26CE', '&#9934;', $string);
    
    // no entry
    $string = str_replace('\u26D4', '&#9940;', $string);
    
    // church
    $string = str_replace('\u26EA', '&#9962;', $string);
    
    // fountain
    $string = str_replace('\u26F2', '&#9970;', $string);
    
    // golf
    $string = str_replace('\u26F3', '&#9971;', $string);
    
    // sailboat
    $string = str_replace('\u26F5', '&#9973;', $string);
    
    // tent
    $string = str_replace('\u26FA', '&#9978;', $string);
    
    // fuelpump
    $string = str_replace('\u26FD', '&#9981;', $string);
    
    // scissors
    $string = str_replace('\u2702', '&#9986;', $string);
    
    // green/whit checkmark
    $string = str_replace('\u2705', '&#9989;', $string);
    
    // airplane
    $string = str_replace('\u2708', '&#9992;', $string);
    
    // envelope
    $string = str_replace('\u2709', '&#9993;', $string);
    
    // raised fist
    $string = str_replace('\u270A', '&#9994;', $string);
    
    // raised hand
    $string = str_replace('\u270B', '&#9995;', $string);
    
    // peace sign
    $string = str_replace('\u270C', '&#9996;', $string);
    
    // pencil
    $string = str_replace('\u270F', '&#9999;', $string);
    
    // pen
    $string = str_replace('\u2712', '&#10002;', $string);
    
    // heavy check
    $string = str_replace('\u2714', '&#10004;', $string);
    
    // heavy multiplication
    $string = str_replace('\u2716', '&#10006;', $string);
    
    // sparkles
    $string = str_replace('\u2728', '&#10024;', $string);
    
    // green asterisk
    $string = str_replace('\u2733', '&#10035;', $string);
    
    // orange star
    $string = str_replace('\u2734', '&#10036;', $string);
    
    // snowflake
    $string = str_replace('\u2744', '&#10052;', $string);
    
    // sparkle
    $string = str_replace('\u2747', '&#10055;', $string);
    
    // cross mark red X
    $string = str_replace('\u274C', '&#10060;', $string);
    
    // green X
    $string = str_replace('\u274E', '&#10062;', $string);
    
    // red question mark
    $string = str_replace('\u2753', '&#10067;', $string);
    
    // gray question mark
    $string = str_replace('\u2754', '&#10068;', $string);
    
    // gray exclamation
    $string = str_replace('\u2755', '&#10069;', $string);
    
    // red exclamation
    $string = str_replace('\u2757', '&#10071;', $string);
    
    // heart
    $string = str_replace('&#10084;', '&#10084;', $string);
    
    // heavy plus sign
    $string = str_replace('\u2795', '&#10133;', $string);
    
    // heavy minus sign
    $string = str_replace('\u2796', '&#10134;', $string);
    
    // heavy divison sign
    $string = str_replace('\u2797', '&#10135;', $string);
    
    // arrow right
    $string = str_replace('\u27A1', '&#10145;', $string);
    
    // curly loop
    $string = str_replace('\u27B0', '&#10160;', $string);
    
    // arrow curving up
    $string = str_replace('\u2934', '&#10548;', $string);
    
    // arrow curving down
    $string = str_replace('\u2935', '&#10549;', $string);
    
    // large black square
    $string = str_replace('\u2B1B', '&#11035;', $string);
    
    // large white square
    $string = str_replace('\u2B1C', '&#11036;', $string);
    
    // star
    $string = str_replace('\u2B50', '&#11088;', $string);
    
    // red circle
    $string = str_replace('\u2B55', '&#11093;', $string);
    
    // wavy dash
    $string = str_replace('\u3030', '&#12336;', $string);
    
    // alternation mark
    $string = str_replace('\u303D', '&#12349;', $string);
    
    // congratulations
    $string = str_replace('\u3297', '&#12951;', $string);
    
    // secret
    $string = str_replace('\u3299', '&#12953;', $string);
    
    // red dragon
    $string = str_replace('\uD83C\uDC04', '&#126980;', $string);
    
    // black joker
    $string = str_replace('\uD83C\uDCCF', '&#127183;', $string);
    
    // a
    $string = str_replace('\uD83C\uDD70', '&#127344;', $string);
    
    // b
    $string = str_replace('\uD83C\uDD71', '&#127345;', $string);
    
    // o2
    $string = str_replace('\uD83C\uDD7E', '&#127358;', $string);
    
    // parking
    $string = str_replace('\uD83C\uDD7F', '&#127359;', $string);
    
    // ab
    $string = str_replace('\uD83C\uDD8E', '&#127374;', $string);
    
    // cl
    $string = str_replace('\uD83C\uDD91', '&#127377;', $string);
    
    // cool
    $string = str_replace('\uD83C\uDD92', '&#127378;', $string);
    
    // free (square)
    $string = str_replace('\uD83C\uDD93', '&#127379;', $string);
    
    // id
    $string = str_replace('\uD83C\uDD94', '&#127380;', $string);
    
    // new
    $string = str_replace('\uD83C\uDD95', '&#127381;', $string);
    
    // ng
    $string = str_replace('\uD83C\uDD96', '&#127382;', $string);
    
    // ok
    $string = str_replace('\uD83C\uDD97', '&#127383;', $string);
    
    // sos
    $string = str_replace('\uD83C\uDD98', '&#127384;', $string);
    
    // up
    $string = str_replace('\uD83C\uDD99', '&#127385;', $string);
    
    // vs
    $string = str_replace('\uD83C\uDD9A', '&#127386;', $string);
    
    // cn flag
    $string = str_replace('\uD83C\uDDE8', '&#127464;', $string);
    
    // rn flag
    $string = str_replace('\uD83C\uDDF3', '&#127475;', $string);
    
    // de flag
    $string = str_replace('\uD83C\uDDE9', '&#127465;', $string);
    
    // es flag
    $string = str_replace('\uD83C\uDDEA', '&#127466;', $string);
    
    // fr flag
    $string = str_replace('\uD83C\uDDEB', '&#127467;', $string);
    
    // kr/ru flag
    $string = str_replace('\uD83C\uDDF7', '	&#127479;', $string);
    
    // uk flag
    $string = str_replace('\uD83C\uDDEC', '	&#127468;', $string);
    
    // uk flag alt
    $string = str_replace('\uD83C\uDDE7', '&#127463;', $string);
    
    // IT flag
    $string = str_replace('\uD83C\uDDEE', '&#127470;', $string);
    
    // IT flag alt
    $string = str_replace('\uD83C\uDDF9', '&#127481;', $string);
    
    // JP flag
    $string = str_replace('\uD83C\uDDEF', '&#127471;', $string);
    
    // JP flag alt
    $string = str_replace('\uD83C\uDDF5', '&#127477;', $string);
    
    // KP flag
    $string = str_replace('\uD83C\uDDF0', '&#127472;', $string);
    
    // Ru flag
    $string = str_replace('\uD83C\uDDF7', '&#127479;', $string);
    
    // US flag
    $string = str_replace('\uD83C\uDDFA', '&#127482;', $string);
    
    // US/Es Flag
    $string = str_replace('\uD83C\uDDF8', '&#127480;', $string);
    
    // koko
    $string = str_replace('\uD83C\uDE01', '&#127489;', $string);
    
    // sa
    $string = str_replace('\uD83C\uDE02', '&#127490;', $string);
    
    // u7121
    $string = str_replace('\uD83C\uDE1A', '&#127514;', $string);
    
    // u6307
    $string = str_replace('\uD83C\uDE2F', '&#127535;', $string);
    
    // u7981
    $string = str_replace('\uD83C\uDE32', '&#127538;', $string);
    
    // u7a7a
    $string = str_replace('\uD83C\uDE33', '&#127539;', $string);
    
    // u5408
    $string = str_replace('\uD83C\uDE34', '&#127540;', $string);
    
    // u6e80
    $string = str_replace('\uD83C\uDE35', '&#127541;', $string);
    
    // u6709
    $string = str_replace('\uD83C\uDE36', '&#127542;', $string);
    
    // u6708
    $string = str_replace('\uD83C\uDE37', '&#127543;', $string);
    
    // u7533
    $string = str_replace('\uD83C\uDE38', '&#127544;', $string);
    
    // u5272
    $string = str_replace('\uD83C\uDE39', '&#127545;', $string);
    
    // u55b6
    $string = str_replace('\uD83C\uDE3A', '&#127546;', $string);
    
    // ideograph advantage
    $string= str_replace('\uD83C\uDE50', '&#127568;', $string);
    
    // accept
    $string = str_replace('\uD83C\uDE51', '&#127569;', $string);
    
    // cyclone
    $string = str_replace('\uD83C\uDF00', '&#127744;', $string);
    
    // foggy
    $string = str_replace('\uD83C\uDF01', '&#127745;', $string);
    
    // closed umbrella
    $string = str_replace('\uD83C\uDF02', '&#127746;', $string);
    
    // night with starts
    $string = str_replace('\uD83C\uDF03', '&#127747;', $string);
    
    // sunrise over mountains
    $string = str_replace('\uD83C\uDF04', '&#127748;', $string);
    
    // sunrise
    $string = str_replace('\uD83C\uDF05', '&#127749;', $string);
    
    // city sunset
    $string = str_replace('\uD83C\uDF06', '&#127750;', $string);
    
    // city sunrise
    $string = str_replace('\uD83C\uDF07', '&#127751;', $string);
    
    // rainbow
    $string = str_replace('\uD83C\uDF08', '&#127752;', $string);
    
    // bridge at night
    $string = str_replace('\uD83C\uDF09', '&#127753;', $string);
    
    // water wave/ocean
    $string = str_replace('\uD83C\uDF0A', '&#127754;', $string);
    
    // clean up quotes from emoji created by json encoding
    $string = stripslashes($string);

    return $string;
}

?>