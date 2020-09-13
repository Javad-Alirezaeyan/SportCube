<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 9/13/20
 * Time: 9:52 AM
 */

namespace App\Http\Date;


class BuildDate
{
    const CURRENT_TIME_ZONE = 'Europe/Vienna';
    const DATE_INTERVAL_SPEC = "P2D";

    private static  function getDifference($firstTimeZone, $secondTimezone)
    {
        $firstTz = new \DateTimeZone($firstTimeZone);
        $t1 = new \DateTime('now', $firstTz);

        $secondTz = new \DateTimeZone($secondTimezone);
        $t2 = new \DateTime('now', $secondTz);

        $first_offset = $t1->getOffset() / 3600;
        $second_offset = $t2->getOffset() / 3600;

        return $first_offset - $second_offset;

    }

    public static function getUpDate(){

        $dateTime = new \DateTime('now', new \DateTimeZone(self::CURRENT_TIME_ZONE));
        $dateTime->add(new \DateInterval(self::DATE_INTERVAL_SPEC));

        $dateTime->setTime(23, 59, 59 );

      /*  $diffTimeZone = self::getDifference('UTC', self::CURRENT_TIME_ZONE );

var_dump($dateTime);
        if($diffTimeZone < 0){
            $dateTime->sub(new \DateInterval("PT".abs($diffTimeZone)."H"));
        }
        else{
            $dateTime->add(new \DateInterval("PT".abs($diffTimeZone)."H"));
        }*/
        $dateTime->setTimezone(new \DateTimeZone("UTC"));
        return $dateTime;
    }

}