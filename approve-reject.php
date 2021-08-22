<?php

    require("connect_db.php");
    if(isset($_POST['approve']))
    {
        $query = "UPDATE events SET status = 'approved' WHERE event_id ='".$_POST['event_id']."'";
        mysqli_query($con, $query);
    }
    elseif (isset($_POST['reject']))
    {
        $query = "UPDATE events SET status = 'rejected' WHERE event_id ='".$_POST['event_id']."'";
        mysqli_query($con, $query);
    }
    header("Location: http://placenevents/requested_events.php/");
?>