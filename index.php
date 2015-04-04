<?php
header('Content-Type: application/xml; charset=utf-8');

/* RSS 2.0 MP3 SUBSCRIPTION FEED

	 "mp3feed.php" - version 1.1
	 2005 - Canton Becker - canton@gmail.com

	 Yeah, it's pretty basic.
	 But it's free.
	 Here's where to get the latest version:
	 http://www.cantonbecker.com/canton/projects

	 Use at your own risk, or don't use it at all...

*/


// CONFIGURE THESE VARIABLES:

// actual place where your mp3s live on your server's filesystem. TRAILING SLASH REQ'D.
$musicDirectory="/var/www/html/mp3s/";

// corresponding web URL for accessing the music directory. TRAILING SLASH REQ'D.
$musicURL="http://www.mywebsite.com/mp3s/";

// name your feed
$feedTitle="My New and Exciting MP3 Feed";

// where every entry in your feed will link to, sort of like a "for more info" link
$feedLink="http://www.mywebsite.com/mymusic.html";

// describe your feed
$feedDescription="My new music delivered hot and fresh as its made.";

// outline your copyright / creative commons / licensing terms
$feedCopyright="These works are licensed under a Creative Commons License (Some Rights Reserved) -- see www.creativecommons.org/licenses/by-nc-nd/2.0/";

// your email... if you dare!
$authorEmail="myemail@mywebsite.com (Firstname Lastname)";

// how often should feed readers check for new material (in seconds) -- mostly ignored by readers.
$ttl = 1440;

// END OF STUFF YOU NEED TO CONFIGURE!

/* Save this .php file wherever you like on your webserver.
   The URL for this .php file *is* the URL of your podcast feed
   for subscription purposes.

   For every mp3 that you want to podcast, create a correspondingly
   named .txt file that contains a little bit of information about
   the song. Just one or two lines is good.

   It can include basic HTML. My text files are usually something like this:

   		Trance-techno, January 2005. Swirling strings and happy pads.
*/

echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r";
?>

<!-- generator="alien-green-chile-technology/1.1" -->

<rss version="2.0">
    <channel>
        <title><? echo $feedTitle; ?></title>
        <link><? echo $feedLink; ?></link>
        <description><? echo $feedDescription; ?></description>
        <language>en</language>
        <copyright><? echo $feedCopyright; ?></copyright>
        <ttl><? echo $ttl; ?></ttl>


        <?php
        // step through each item...

        $fileDir = opendir($musicDirectory) or die ($php_errormsg);
        while (false !== ($thisFile = readdir($fileDir)))	// step through music directory
        {
            $thisFilePath = $musicDirectory . $thisFile;
            if (is_file($thisFilePath) && strrchr ($thisFilePath, '.') == ".mp3") // not . or .., ends in .mp3
            {
                // only include files that have a corresponding .txt file
                $thisTextPath = substr_replace($thisFilePath, ".txt", (strlen($thisFilePath) - 4));
                if (is_file($thisTextPath))
                {
                    $myFullURL=$musicURL . $thisFile;
                    $myFileSize=filesize($thisFilePath);
                    ?>
                    <item>
                        <title><? echo $thisFile; ?></title>
                        <link><? echo $feedLink; ?></link>
                        <description>
                            <?
                            $textContents = file($thisTextPath);
                            foreach ($textContents as $thisLine) echo htmlspecialchars($thisLine) . "\n";
                            ?>

                        </description>
                        <enclosure url="<? echo $myFullURL; ?>" length="<? echo $myFileSize; ?>" type="audio/mpeg" />
                        <guid><? echo $myFullURL; ?></guid>
                        <author><? echo $authorEmail; ?></author>
                    </item>
                <?
                }
            }
        }
        closedir($fileDir);


        ?>

    </channel>
</rss>

