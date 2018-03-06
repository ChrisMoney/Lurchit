<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/6/18
 * Time: 9:19 AM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "Select Members Set Art, Beauty, BoardGames, Books, Business, Cooking, Dancing, Fashion,Outdoors, HomeRepair, Hiking, LiveEvents, MartialArts, Meditation, Movies, Music, NightLife, Performing, Photography , Sports, Technology, Traveling, VideoGames, WorkingOut, Writing, Yoga WHERE ID = $id ";