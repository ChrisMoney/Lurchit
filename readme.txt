Any SOA based application built that does not offer json_decoding will not be able to render
emojis natively. So this for this libary to work, Emojis must be stored using 
utf8mbd encoding. This library then encodes those emojis before they are sent back to 
the mobile client. This allows the code to read the C/C++/Jav Unicode value of the emoji.
After reading this encoding, the library will attempt to re-encode the emoji to a 
html entity decimal encoding that will be serializable by the client.
 
Known bugs*****:
Some emojis that do store correctly i.e. 'Travel Places' may not render at all.
*******

Installation & Implementation:
Upload the detectEmoji.php file into your root folder and reference it with:
include_once 'detectEmoji.php'

Implement the function as so, replacing $text with your string variable:

if (preg_match('/[\x{1F600}-\x{1F64F}]/u', $text)) {
                // call function to replace all unicode values with hex values
                $text = detectEmojis($text);
            }