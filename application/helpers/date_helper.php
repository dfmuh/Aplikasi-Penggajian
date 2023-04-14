<?php
if (!function_exists('getWeekdaysOfMonth')) {
    function getWeekdaysOfMonth($month, $year)
    {
        $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $weekdays = array();
        for ($i = 1; $i <= $numDays; $i++) {
            $date = strtotime($year . '-' . $month . '-' . $i);
            if (date('N', $date) <= 5) {
                $weekdays[] = date('Y-m-d', $date);
            }
        }
        return $weekdays;
    }
}

if (!function_exists('getWeekdayFromDate')) {
    function getWeekdayFromDate($date)
    {
        $dayOfWeek = date('N', strtotime($date));
        $weekdays = array(
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu'
        );

        return $weekdays[$dayOfWeek];
    }
}
