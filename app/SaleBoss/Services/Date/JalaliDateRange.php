<?php namespace SaleBoss\Services\Date; 

use Carbon\Carbon;
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
        if (empty($date)) return null;
        $parsed = $this->parse($date, $delimiter);
        list($jYear, $jMonth, $jDay) = $parsed;
        return $this->calculateTimestamp($jYear, $jMonth, $jDay);
    }

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Get date time string of the end of the day
     *
     * @param $date
     * @param string $delimiter
     * @return null|string
     */
    public function getDayEndStringOf($date, $delimiter = '/')
    {
        if (empty($date)) return null;

        list($gYear, $gMonth, $gDay) = $this->converter($date, $delimiter);

        return Carbon::create($gYear, $gMonth, $gDay)->endOfDay()->toDateTimeString();
    }

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Get end DateTime string of the beginning of the day
     *
     * @param $date
     * @param string $delimiter
     * @return null|string
     */
    public function getDayBeginStringOf($date, $delimiter = '/')
    {
        if (empty($date)) return null;

        list($gYear, $gMonth, $gDay) = $this->converter($date, $delimiter);

        return Carbon::create($gYear, $gMonth, $gDay)->startOfDay()->toDateTimeString();
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
        return strtotime(implode('-',$this->gregorianArray($jYear, $jMonth, $jDay)));
    }

    public function gregorianArray($jYear, $jMonth, $jDay)
    {
        return jDateTime::toGregorian($jYear, $jMonth, $jDay);
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
        if ($count != 3) {
            $message = "[{$date}] is not an accepted date delimitted by [{$del}]";
            throw new InvalidArgumentException($message);
        }
    }

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Converter
     *
     * @param $date
     * @param $delimiter
     * @return array
     */
    private function converter($date, $delimiter)
    {
        $parsed = $this->parse($date, $delimiter);
        list($jYear, $jMonth, $jDay) = $parsed;

        return $this->gregorianArray($jYear, $jMonth, $jDay);
    }
} 
