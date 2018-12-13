<?php
$time_string_epoch = '1544765863000';
$time_string_epoch = substr($time_string_epoch, 0, -3);
$datetime_obj = (new \DateTime())->setTimestamp($time_string_epoch);
//    $datetime_obj->setTimezone(new \DateTimeZone(date_default_timezone_get()));

$dt_obj_local = (new DateTime($datetime_obj->format('Y-m-d H:i:s'), new DateTimeZone('UTC')))
    ->setTimezone(new DateTimeZone(date_default_timezone_get()));
$time_string = $datetime_obj->format('Y-m-d h:i:s');
$time_string_local = $dt_obj_local->format('Y-m-d h:i:s');
$new_geolocation['time'] = $time_string;

/*$rider_name = 'Travis Redgar';
$rider_names=explode(' ',$rider_name);
if (count($rider_names) >= 2){
    $rider_names[1] = strtoupper($rider_names[1][0]) . '.';
}
$rider_name=implode(' ', $rider_names);

echo $rider_name;*/