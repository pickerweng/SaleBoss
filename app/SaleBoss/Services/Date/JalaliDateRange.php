<?php namespace SaleBoss\Services\Date; 

use Miladr\Jalali\jDateTime;
use SaleBoss\Services\Date\Exceptions\InvalidArgumentException;

class JalaliDateRange
{
    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Parse the date by delimiter
     *
     * @param $date
     * @param $delimiter
     * @return array
     * @throws Exceptions\InvalidArgumentException
     */
    public function parse($date, $delimiter)
    {
        $explodedDate = explode($delimiter, $date);
        $this->checkDateString($explodedDate, $date, $delimiter);
        return $explodedDate;
    }

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Get timestamp
     *
     * @param $date
     * @param string $delimiter
     * @return array|null
     */
    public function getTimestamp($date, $delimiter = '/')
    {
        if (is_null($date)) return null;
        $parsed = $this->parse($date, $delimiter);
        list($jYear, $jMonth, $jDay) = $parsed;
        return $this->calculateTimestamp($jYear, $jMonth, $jDay);
    }


    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Calculate by year, month, day
     *
     * @param $jYear
     * @param int $jMonth
     * @param int $jDay
     * @return array
     */
    public function calculateTimestamp($jYear, $jMonth = 1, $jDay = 1)
    {
        return strtotime(implode('-',jDateTime::toGregorian($jYear, $jMonth, $jDay)));
    }

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * @param $explodedDate
     * @param $date
     * @param $del
     * @throws Exceptions\InvalidArgumentException
     */
    public function checkDateString($explodedDate, $date, $del)
    {
        $count = count($explodedDate);
        if ($count > 3 || $count < 2) {
            $message = "[{$date}] is not an accepted date delimitted by [{$del}]";
            throw new InvalidArgumentException($message);
        }
    }
} 
