<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/11/18
 * Time: 4:33 PM
 */
header("Content-Type: application/json;charset=utf-8");
require_once 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$long = $_REQUEST['Long'];
$lat = $_REQUEST['Lat'];

$distance = getDistance($id);

$sql = "SELECT pm.MediaName as MediaName, m.ID as MemberID, m.Username as Username, 
(SELECT PitchDate FROM PitchDeck WHERE Member_ID = m.ID Order By ID DESC Limit 1) as PitchDate,
( 3959 * acos ( cos ( radians($lat) ) * cos( radians( pd.Latitude ) ) * 
cos( radians( pd.Longitude ) - radians($long) ) + sin ( radians($lat) ) * 
sin( radians( pd.Latitude ) ) ) ) AS `distance` 

FROM Members m, ProfileMedia pm, MemberPref mp, PitchDeck pd

WHERE 
mp.Member_ID = m.ID
And pm.Member_ID = m.ID
And pd.Member_ID = m.ID

And 
(
(CASE WHEN mp.NoReligiousPref = 'true' THEN m.Religion = 'Christian' or m.Religion = 'Muslim'
Or m.Religion = 'Spiritual' Or m.Religion = 'Agnostic' Or m.Religion = 'Atheist' Or m.Religion = 'None' END)
Or (mp.Christian = (CASE m.Religion WHEN 'Christian' THEN 'true' END))
Or (mp.Muslim = (CASE m.Religion WHEN 'Muslim' THEN 'true' END))
Or (mp.Spiritual = (CASE m.Religion WHEN 'Spiritual' THEN 'true' END))
Or (mp.Agnostic = (CASE m.Religion WHEN 'Agnostic' THEN 'true' END))
Or (mp.Atheist = (CASE m.Religion WHEN 'Atheist' THEN 'true' END))
)

And
(
(CASE WHEN mp.NoPoliticalPref = 'true' THEN m.Politics = 'Liberal' Or m.Politics = 'Conservative' Or m.Politics = 'Moderate' 
or m.Politics = 'None' END)
Or (mp.Liberal = (CASE m.Politics WHEN 'Liberal' THEN 'true' END))
Or (mp.Conservative = (CASE m.Politics WHEN 'Conservative' THEN 'true' END))
Or (mp.Moderate = (CASE m.Politics WHEN 'Moderate' THEN 'true' END))
)

And
(
((SELECT TIMESTAMPDIFF(YEAR, m.Birthdate, CURDATE())) >= mp.AgeMin And (SELECT TIMESTAMPDIFF(YEAR, m.Birthdate, CURDATE())) <= mp.AgeMax)
)

And
(
(CASE WHEN mp.NoAppearancePref = 'true' THEN m.Build = 'Slim' Or m.Build = 'Average' Or m.Build = 'Athletic' 
Or m.Build = 'Plump' Or m.Build = 'Heavy' Or m.Build = 'Heavy' Or m.Build = 'Overweight' 
And ((m.HeightFeet >= mp.MinHeightFeet And m.HeightInches >= mp.MinHeightInches) And (m.HeightFeet <= mp.MaxHeightFeet And m.HeightInches <= mp.MaxHeightInches)) END)
Or (mp.Slim = (CASE m.Build WHEN 'Slim' THEN 'true' END))
Or (mp.Average = (CASE m.Build WHEN 'Average' THEN 'true' END))
Or (mp.Athletic = (CASE m.Build WHEN 'Athletic' THEN 'true' END))
Or (mp.Plump = (CASE m.Build WHEN 'Plump' THEN 'true' END))
Or (mp.Heavy = (CASE m.Build WHEN 'Heavy' THEN 'true' END))
Or (mp.Overweight = (CASE m.Build WHEN 'Overweight' THEN 'true' END))
And ((m.HeightFeet >= mp.MinHeightFeet And m.HeightInches >= mp.MinHeightInches) And (m.HeightFeet <= mp.MaxHeightFeet And m.HeightInches <= mp.MaxHeightInches))
)  

And
(
(CASE WHEN mp.NoRacePref = 'true' THEN m.Ethnicity = 'White' Or m.Ethnicity = 'Black'
Or m.Ethnicity = 'Hispanic' Or m.Ethnicity = 'MiddleEastern' Or m.Ethnicity = 'Indian'
Or m.Ethnicity = 'NativeAmerican' END)
Or (mp.White = (CASE m.Ethnicity WHEN 'White' THEN 'true' END))
Or (mp.Black = (CASE m.Ethnicity WHEN 'Black' THEN 'true' END))
Or (mp.Hispanic = (CASE m.Ethnicity WHEN 'Hispanic' THEN 'true' END))
Or (mp.MiddleEastern = (CASE m.Ethnicity WHEN 'MiddleEastern' THEN 'true' END))
Or (mp.Indian = (CASE m.Ethnicity WHEN 'Indian' THEN 'true' END))
Or (mp.NativeAmerican = (CASE m.Ethnicity WHEN 'NativeAmerican' THEN 'true' END))
Or (mp.Asian = (CASE m.Ethnicity WHEN 'Asian' THEN 'true' END))
)

And
(
(CASE WHEN mp.NoHairPref = 'true' THEN m.Hair = 'Black' Or m.Hair = 'Brown' Or m.Hair = 'Blonde'
Or m.Hair = 'White' Or m.Hair = 'Gray' END)
Or (mp.HairBlack = (CASE m.Hair WHEN 'Black' THEN 'true' END))
Or (mp.HairBrown = (CASE m.Hair WHEN 'Brown' THEN 'true' END))
Or (mp.HairBlonde = (CASE m.Hair WHEN 'Blonde' THEN 'true' END))
Or (mp.HairWhite = (CASE m.Hair WHEN 'White' THEN 'true' END))
Or (mp.HairGray = (CASE m.Hair WHEN 'Gray' THEN 'true' END))
)

And 
(
(CASE WHEN mp.NoGenderPref = 'true' THEN m.Gender = 'Male' Or m.Gender = 'Female' END)
Or (mp.Male = (CASE m.Gender WHEN 'male' THEN 'true' END))
Or (mp.Female = (CASE m.Gender WHEN 'female' THEN 'true' END))
)

And
(
(CASE WHEN mp.NoEyesPref = 'true' THEN m.Eyes = 'Black' Or m.Eyes = 'Brown'
Or m.Eyes = 'Hazel' Or m.Eyes = 'Green' Or m.Eyes = 'Blue' END)
Or (mp.EyesBlack = (CASE m.Eyes WHEN 'Black' THEN 'true' END))
Or (mp.EyesBrown = (CASE m.Eyes WHEN 'Brown' THEN 'true' END))
Or (mp.EyesHazel = (CASE m.Eyes WHEN 'Hazel' THEN 'true' END))
Or (mp.EyesGreen = (CASE m.Eyes WHEN 'Green' THEN 'true' END))
Or (mp.EyesBlue = (CASE m.Eyes WHEN 'Blue' THEN 'true' END))
)

And
(
(CASE WHEN mp.NoEducationPref = 'true' THEN m.Education = 'HighSchool'
Or m.Education = 'SomeCollege' Or m.Education = 'Bachelor' Or m.Education = 'Master'
Or m.Education = 'Doctorate' END)
Or (mp.HighSchool = (CASE m.Education WHEN 'HighSchool' THEN 'true' END))
Or (mp.SomeCollege = (CASE m.Education WHEN 'SomeCollege' THEN 'true' END))
Or (mp.Bachelor = (CASE m.Education WHEN 'Bachelor' THEN 'true' END))
Or (mp.Master = (CASE m.Education WHEN 'Master' THEN 'true' END))
Or (mp.Doctorate = (CASE m.Education WHEN 'Doctorate' THEN 'true' END))
)

And
(
(CASE WHEN mp.NoHasKidsPref = 'true' THEN m.HasKids = 'Yes' Or m.HasKids = 'No' END)
Or (mp.HasKids = (CASE m.HasKids WHEN 'Yes' THEN 'true' END))
Or (mp.HasNoKids = (CASE m.HasKids WHEN 'No' THEN 'true' END))
)

And 
(
(CASE WHEN mp.NoWantsKidsPref = 'true' THEN m.WantsKids = 'Yes' Or m.WantsKids = 'No' Or m.WantsKids = 'Not Sure' END)
Or (mp.WantsKids = (CASE m.WantsKids WHEN 'Yes' THEN 'true' END))
Or (mp.WantsNoKids = (CASE m.WantsKids WHEN 'No' THEN 'true' END))
)

And
(
(CASE WHEN mp.NoSmokingPref = 'true' THEN m.Smoke = 'Yes' Or m.Smoke = 'No' Or m.Smoke = 'Socially' Or m.Smoke = 'Daily' END)
Or (mp.NoSmoking = (CASE m.Smoke WHEN 'No' THEN 'true' END))
Or (mp.SocialSmoker = (CASE m.Smoke WHEN 'Socially' THEN 'true' END))
Or (mp.DailySmoker = (CASE m.Smoke WHEN 'Daily' THEN 'true' END))
)

And
(
(CASE WHEN mp.NoDrinkingPref = 'true' THEN m.Drink = 'Yes' Or m.Drink = 'No' Or m.Drink = 'Socially' Or m.Drink = 'Daily' END)
Or (mp.NoDrinking = (CASE m.Drink WHEN 'No' THEN 'true' END))
Or (mp.SocialDrinker = (CASE m.Drink WHEN 'Socially' THEN 'true' END))
Or (mp.DailyDrinker = (CASE m.Drink WHEN 'Daily' THEN 'true' END))
)

And 
(
(m.Art = (SELECT Art FROM Members WHERE ID = $id And Art = 'true'))
Or (m.Beauty = (SELECT Beauty FROM Members WHERE ID = $id And Beauty = 'true'))
Or (m.BoardGames = (SELECT BoardGames FROM Members WHERE ID = $id And BoardGames = 'true'))
Or (m.Books = (SELECT Books FROM Members WHERE ID = $id And Books = 'true'))
Or (m.Business = (SELECT Business FROM Members WHERE ID = $id AND Business = 'true'))
Or (m.Cooking = (SELECT Cooking FROM Members WHERE ID = $id AND Cooking = 'true'))
Or (m.Dancing = (SELECT Dancing FROM Members WHERE ID = $id AND Dancing = 'true'))
Or (m.Fashion = (SELECT Fashion FROM Members WHERE ID = $id AND Fashion = 'true'))
Or (m.Outdoors = (SELECT Outdoors FROM Members WHERE ID = $id AND Outdoors = 'true'))
Or (m.HomeRepair = (SELECT HomeRepair FROM Members WHERE ID = $id AND HomeRepair = 'true'))
Or (m.Hiking = (SELECT Hiking FROM Members WHERE ID = $id AND Hiking = 'true'))
Or (m.LiveEvents = (SELECT LiveEvents FROM Members WHERE ID = $id AND LiveEvents = 'true'))
Or (m.MartialArts = (SELECT MartialArts FROM Members WHERE ID = $id AND MartialArts = 'true'))
Or (m.Meditation = (SELECT Meditation FROM Members WHERE ID = $id AND Meditation = 'true'))
Or (m.Movies = (SELECT Movies FROM Members WHERE ID = $id AND Movies = 'true')) 
Or (m.Music = (SELECT Music FROM Members WHERE ID = $id AND Music = 'true'))
Or (m.NightLife = (SELECT NightLife FROM Members WHERE ID = $id AND NightLife = 'true'))
Or (m.Performing = (SELECT Performing FROM Members WHERE ID = $id AND Performing = 'true'))
Or (m.Photography = (SELECT Photography FROM Members WHERE ID = $id AND Photography = 'true'))
Or (m.Sports = (SELECT Sports FROM Members WHERE ID = $id AND Sports = 'true'))
Or (m.Technology = (SELECT Technology FROM Members WHERE ID = $id AND Technology = 'true'))
Or (m.Traveling = (SELECT Traveling FROM Members WHERE ID = $id AND Traveling = 'true'))
Or (m.VideoGames = (SELECT VideoGames FROM Members WHERE ID = $id AND VideoGames = 'true'))
Or (m.WorkingOut = (SELECT WorkingOut FROM Members WHERE ID = $id AND WorkingOut = 'true'))
Or (m.Writing = (SELECT Writing FROM Members WHERE ID = $id AND Writing = 'true'))
Or (m.Yoga = (SELECT Yoga FROM Members WHERE ID = $id AND Yoga = 'true'))
)

And 
(
(m.Dating = (SELECT Dating FROM Members WHERE ID = $id And Dating = 'true'))
Or (m.Friends = (SELECT Friends FROM Members WHERE ID = $id And Friends = 'true'))
Or (m.Networking = (SELECT Networking FROM Members WHERE ID = $id And Networking = 'true'))
)

And
(
m.ID NOT IN (SELECT Blocked_ID FROM Block WHERE Blocker_ID = $id)
)

Group By MemberID
HAVING distance <= $distance

";

$myArray = array();

if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
    while ($pitchDeck = mysqli_fetch_assoc($result)) {
        
        // format profile photo
        $mediaName = $pitchDeck['MediaName'];
        $pitchDeck['MediaName'] = "http://api.flickpitch.com/api/media/$mediaName";
        
            $flickPitchDate = $pitchDeck['PitchDate'];
            $pitchDeck['PitchDate'] = calculate_time_span($flickPitchDate);
            
            $myArray[] = $pitchDeck;
            }
    echo json_encode($myArray, JSON_NUMERIC_CHECK);
    
}
else {
    echo http_response_code(400);
}
}
else {
    echo http_response_code(500);
}