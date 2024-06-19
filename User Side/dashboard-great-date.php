<?php
class GreatDate {
    public function getGreeting() {
        date_default_timezone_set('Asia/Manila'); // naka set siya timezone to Asia/Manila
        
        $currentTime = date('H');
        $greeting = ($currentTime < 12) ? 'Good morning' : (($currentTime < 18) ? 'Good afternoon' : 'Good evening');
        return $greeting; 
    }
}
?>
<!-- 
Mao ni ang code para sa dashboard
arun makuha ang updated na date karun:

$date = new GreatDate();
$date->displayDate();

ex: 
Good Morning, Christina
Today, Wendsday May 23, 2024
-->