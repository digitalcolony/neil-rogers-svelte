<?php
    header('Content-Type: application/xml; charset=utf-8');

    // === Generic feed options
    $feed_title = "Neil Rogers Show";
    $feed_link = "https://neilrogers.org/podcast/";
    $feed_description = "Archived radio shows from Miami Radio Legend Neil Rogers. For more information, visit https://neilrogers.org.";
    $feed_copyright = "1976-2009 The Neil Rogers Show";
    $feed_keywords = "Miami, Radio, Florida, Broward";
    $feed_subtitle = "NEIL God!";
    // How often feed readers check for new material (in seconds) -- mostly ignored by readers
    $feed_ttl = 60 * 60 * 24;
    $feed_lang = "en-us";
    
    // $feed_pub_date will always be 8am of the current day 
    $today = date("Y-m-d");
    $tz = new DateTimeZone('America/New_York');
    $feed_pub_date = new DateTime($today, $tz);
    $feed_pub_date->modify('+8 hours');
    $feed_pub_date_formatted = $feed_pub_date->format("r");

    // === iTunes-specific feed options

    $feed_author = "NeilRogers.org";
    $feed_email = "audio@neilrogers.org  (NeilRogers.org)";
    // TODO REPLACE: 1400x1400 min, 3000x3000 max JPG or PNG
    $feed_image = "http://neilrogers.org/wp-content/uploads/2017/04/neil-rogers1400.jpg";
    $feed_explicit = "yes";
    // TODO: Can not figure out how to validate catgeories with ampersands
    $feed_category = "Comedy";    
    $feed_subcategory = "Food";

    /*echo '<?xml version="1.0" encoding="utf-8" ?>'; */
?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
    <channel>
        <title><?php echo $feed_title; ?></title>
        <link>https://neilrogers.org</link>
        <image>
            <url><?php echo $feed_image; ?></url>
            <title><?php echo $feed_title; ?></title>
            <link>https://neilrogers.org</link>
        </image>
        <description>
            <?php echo $feed_description; ?>
        </description>
        <language><?php echo $feed_lang; ?></language>
        <copyright><?php echo $feed_copyright; ?></copyright>
        <atom:link href="<?php echo $feed_link; ?>" rel="self" type="application/rss+xml"/>
        <lastBuildDate><?php echo $feed_pub_date_formatted; ?></lastBuildDate>

        <itunes:author><?php echo $feed_author; ?></itunes:author>
        <itunes:summary><?php echo $feed_description; ?></itunes:summary>
        <itunes:subtitle><?php echo $feed_subtitle; ?></itunes:subtitle>
        <itunes:owner>
            <itunes:name><?php echo $feed_author; ?></itunes:name>
            <itunes:email><?php echo $feed_email; ?></itunes:email>
        </itunes:owner>
        <itunes:explicit><?php echo $feed_explicit; ?></itunes:explicit>
        <itunes:keywords><?php echo $feed_keywords; ?></itunes:keywords>
        <itunes:image href="<?php echo $feed_image; ?>" />                
        <itunes:category text="<?php echo $feed_category; ?>"/>
        <pubDate><?php echo "Fri, 28 Apr 2017 12:34:00 EDT"; ?></pubDate>               
        <category><?php echo $feed_category; ?></category>
        
        <ttl><?php echo $feed_ttl; ?></ttl>

        <?php
            date_default_timezone_set('America/New_York');
	        // connect to DB
	        include("connect.php");

            // query for X number of podcasts
            $sql = "SELECT C.Title, C.Duration, C.mp3url, C.ShowDateDate, C.FileSize, S.Notes, P.ReleaseTime 
                FROM ineedcof_neil610.clyp C
                INNER JOIN `ineedcof_neil610`.`PodcastRelease` P ON C.ShowDateDate = P.ShowDateDate
                INNER JOIN `ineedcof_neil610`.`SS_Shows` S ON C.ShowDateDate = S.Date
                WHERE P.ReleaseTime < Now()
                ORDER BY ReleaseTime DESC LIMIT 500";


            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {                    
                    $file_title = htmlentities($row["Title"]);
                    $file_url = $row["mp3url"];
                    $file_url = str_replace('https','http',$file_url);
                    $file_author = $feed_author;
                    $file_duration = $row["Duration"]; 
                    $file_description = htmlentities($row["Notes"]);                                      
                    $pub_date = date("r", strtotime($row["ReleaseTime"])); // "Mon, 24 Apr 2017 12:34:00 EDT"
                    $file_size = $row["FileSize"];
                                                 
        ?>

                    <item>
                        <title><![CDATA[<?php echo $file_title; ?>]]></title>
                        <link>
                            <?php echo $file_url; ?>
                        </link>
                        <pubDate><?php echo $pub_date; ?></pubDate>
                        <description>
                            <![CDATA[<?php echo $file_description; ?>]]>
                        </description>
                        <enclosure url="<?php echo $file_url; ?>" length="<?php echo $file_size; ?>" type="audio/mpeg"/>                        
                        <guid>
                            <?php echo $file_url; ?>
                        </guid>
                        <itunes:duration><?php echo $file_duration; ?></itunes:duration>
                        <itunes:summary><![CDATA[
                            <?php echo $file_description; ?>
                        ]]></itunes:summary>
                        <itunes:image href="<?php echo $feed_image; ?>"/>
                        <itunes:keywords>
                            <?php echo $feed_keywords; ?> 
                        </itunes:keywords>
                        <itunes:explicit><?php echo $feed_explicit; ?></itunes:explicit>                        
                    </item>                    

        <?php
            }
        }        
        ?>

    </channel>
</rss>