<?php
/**
 * DateQuery.php
 *
 * @package   expanding-archives
 * @copyright Copyright (c) 2022, Ashley Gibson
 * @license   GPL2+
 */

namespace Ashleyfae\ExpandingArchives\Helpers;

use Ashleyfae\ExpandingArchives\ValueObjects\Month;
use DateTime;
use Exception;
use ValueError;

class DateQuery
{
    protected array $years = [];

    public function queryPeriods(): array
    {
        global $wpdb;

        $months = get_transient('expanding_archives_months');

        if (false === $months) {
            $earliestDateClause = '';
            if ($earliestDate = $this->getEarliestDate()) {
                $earliestDateClause = $wpdb->prepare(" AND post_date > %s ", $earliestDate->format('Y-m-d H:i:s'));
            }

            $query = "
SELECT DISTINCT MONTH(post_date) AS month , YEAR(post_date) AS year, COUNT(id) as post_count
FROM {$wpdb->posts}
WHERE post_status = 'publish'
AND post_date <= now()
{$earliestDateClause}
AND post_type = 'post'
GROUP BY month, year
ORDER BY post_date DESC";

            /**
             * Filters the query for retrieving date periods.
             *
             * @since 1.1.1
             *
             * @param  string  $query
             */
            $query = apply_filters('expanding_archives_query', $query);

            $months = $wpdb->get_results($query);

            set_transient('expanding_archives_months', $months, DAY_IN_SECONDS);
        }

        return (array) apply_filters('expanding-archives/months', $months);
    }

    /**
     * Gets the earliest date to include in queries.
     *
     * @return DateTime|null
     */
    protected function getEarliestDate(): ?DateTime
    {
        /**
         * Filters the earliest date to include in the widget. This can be any format supported by the DateTime
         * constructor. For example: `-5 years` for a relative date, or `2024-03-23` for an exact date, etc.
         *
         * If null (default value) then all dates are included.
         *
         * @since 2.1.0
         */
        $earliestDateString = apply_filters('expanding-archives/earliest-date', null);
        if (empty($earliestDateString)) {
            return null;
        }

        try {
            return new DateTime($earliestDateString);
        } catch (Exception|ValueError $e) {
            return null;
        }
    }

    public function getPeriods(): array
    {
        foreach ($this->queryPeriods() as $period) {
            if (! array_key_exists((int) $period->year, $this->years)) {
                $this->years[(int) $period->year] = [];
            }

            $this->years[(int) $period->year][] = new Month(
                (int) $period->year,
                (int) $period->month,
                (int) $period->post_count
            );
        }

        return $this->years;
    }

}
