<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/11/18
 * Time: 4:33 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT pm.MediaName as MediaName, m.ID as MemberID, m.Username as Username, (SELECT PitchDate FROM PitchDeck WHERE Member_ID = m.ID Limit 1) as PitchDate
FROM Members m, ProfileMedia pm, MemberPref mp
WHERE m.ID IN (SELECT Member_ID FROM PitchDeck)

And mp.Member_ID = $id 
And pm.Member_ID = m.ID

And 
(
(CASE WHEN mp.NoReligiousPref = 'true' THEN m.Religion = 'Christian' or m.Religion = 'Muslim'
Or m.Religion = 'Spiritual' Or m.Religion = 'Agnostic' Or m.Religion = 'Atheist' END)
Or (mp.Christian = (CASE m.Religion WHEN 'Christian' THEN 'true' ELSE 'false' END))
Or (mp.Muslim = (CASE m.Religion WHEN 'Muslim' THEN 'true' ELSE 'false' END))
Or (mp.Spiritual = (CASE m.Religion WHEN 'Spiritual' THEN 'true' ELSE 'false' END))
Or (mp.Agnostic = (CASE m.Religion WHEN 'Agnostic' THEN 'true' ELSE 'false' END))
Or (mp.Atheist = (CASE m.Religion WHEN 'Atheist' THEN 'true' ELSE 'false' END))
)

And
(
(CASE WHEN mp.NoPoliticalPref = 'true' THEN m.Politics = 'Liberal' Or m.Politics = 'Conservative' Or m.Politics = 'Moderate' END)
Or (mp.Liberal = (CASE m.Politics WHEN 'Liberal' THEN 'true' ELSE 'false' END))
Or (mp.Conservative = (CASE m.Politics WHEN 'Conservative' THEN 'true' ELSE 'false' END))
Or (mp.Moderate = (CASE m.Politics WHEN 'Moderate' THEN 'true' ELSE 'false' END))
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
Or (mp.Slim = (CASE m.Build WHEN 'Slim' THEN 'true' ELSE 'false' END))
Or (mp.Average = (CASE m.Build WHEN 'Average' THEN 'true' ELSE 'false' END))
Or (mp.Athletic = (CASE m.Build WHEN 'Athletic' THEN 'true' ELSE 'false' END))
Or (mp.Plump = (CASE m.Build WHEN 'Plump' THEN 'true' ELSE 'false' END))
Or (mp.Heavy = (CASE m.Build WHEN 'Heavy' THEN 'true' ELSE 'false' END))
Or (mp.Overweight = (CASE m.Build WHEN 'Overweight' THEN 'true' ELSE 'false' END))
And ((m.HeightFeet >= mp.MinHeightFeet And m.HeightInches >= mp.MinHeightInches) And (m.HeightFeet <= mp.MaxHeightFeet And m.HeightInches <= mp.MaxHeightInches))
)  

And
(
(CASE WHEN mp.NoRacePref = 'true' THEN m.Ethnicity = 'White' Or m.Ethnicity = 'Black'
Or m.Ethnicity = 'Hispanic' Or m.Ethnicity = 'MiddleEastern' Or m.Ethnicity = 'Indian'
Or m.Ethnicity = 'NativeAmerican' END)
Or (mp.White = (CASE m.Ethnicity WHEN 'White' THEN 'true' ELSE 'false' END))
Or (mp.Black = (CASE m.Ethnicity WHEN 'Black' THEN 'true' ELSE 'false' END))
Or (mp.Hispanic = (CASE m.Ethnicity WHEN 'Hispanic' THEN 'true' ELSE 'false' END))
Or (mp.MiddleEastern = (CASE m.Ethnicity WHEN 'MiddleEastern' THEN 'true' ELSE 'false' END))
Or (mp.Indian = (CASE m.Ethnicity WHEN 'Indian' THEN 'true' ELSE 'false' END))
Or (mp.NativeAmerican = (CASE m.Ethnicity WHEN 'NativeAmerican' THEN 'true' ELSE 'false' END))
Or (mp.Asian = (CASE m.Ethnicity WHEN 'Asian' THEN 'true' ELSE 'false' END))
)

And
(
(CASE WHEN mp.NoHairPref = 'true' THEN m.Hair = 'Black' Or m.Hair = 'Brown' Or m.Hair = 'Blonde'
Or m.Hair = 'White' Or m.Hair = 'Gray' END)
Or (mp.HairBlack = (CASE m.Hair WHEN 'Black' THEN 'true' ELSE 'false' END))
Or (mp.HairBrown = (CASE m.Hair WHEN 'Brown' THEN 'true' ELSE 'false' END))
Or (mp.HairBlonde = (CASE m.Hair WHEN 'Blonde' THEN 'true' ELSE 'false' END))
Or (mp.HairWhite = (CASE m.Hair WHEN 'White' THEN 'true' ELSE 'false' END))
Or (mp.HairGray = (CASE m.Hair WHEN 'Gray' THEN 'true' ELSE 'false' END))
)

And 
(
(CASE WHEN mp.NoGenderPref = 'true' THEN m.Gender = 'Male' Or m.Gender = 'Female' END)
Or (mp.Male = (CASE m.Gender WHEN 'male' THEN 'true' ELSE 'false' END))
Or (mp.Female = (CASE m.Gender WHEN 'female' THEN 'true' ELSE 'false' END))
)

"