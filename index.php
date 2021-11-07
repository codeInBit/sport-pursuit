<?php

/**
 * Duration Class
 */
class Duration
{
	/**
	 * Read CSV report and retun average journey duration
	 * 
     * @return string
	 */
	public function averageDuration(): string
	{
		$arrayOfJourneyDuration = [];
		$formatAverageDuration = null;

		try {
			if (($open = fopen("data.csv", "r")) !== FALSE) {
	
				while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {   
					if ($this->validRecord($data)) {
						$arrayOfJourneyDuration[] = $this->journeyDuration($data);
					} 
				}

				fclose($open);

				if (!$arrayOfJourneyDuration) {
					return "Sorry, there are no valid records in the CSV report";	
				}

				$averageDuration = $this->averageJourneyDuration($arrayOfJourneyDuration);
				$formatAverageDuration = date("H:i:s", $averageDuration);
			} else {
				return "CSV file doesn't exist in current working directory";
			}
	
			return "The average journey duration accross all bikes and stattion for the reporting period is {$formatAverageDuration}";	
		} catch (\Exception $e) {
			throw $e;
		}

	}

	/**
	 * @property array $duration
	 * 
     * @return bool
	 */
	public function validRecord(array $record): bool
	{
		if ((empty($record[2])) || (empty($record[3]))) {
			return  false;
		}

		return true;
	}

	/**
	 * @property array $duration
	 * 
	 * @return int
	 */
	public function journeyDuration(array $record): int
	{
		if ((empty($record[2])) || (empty($record[3]))) {
			return 0;
		}

		return $this->dataTimeDifference($record[2], $record[3]);
	}

	/**
	 * Get difference between two datetime in seconds
	 *
	 * @property string $dateTime1
	 * @property string $dateTime2
	 *
	 * @return int 
	 */
	public function dataTimeDifference($dateTime1, $dateTime2): int
	{
		return strtotime($dateTime2) - strtotime($dateTime1);
	}

	/**
	 * Calculate average/mean of values in an array
	 *
	 * @property array $duration
	 * 
	 * @return int
	 */
	public function averageJourneyDuration(array $duration): int
	{
		$sumOfElementInArray = array_sum($duration);
		$numberOfElementInArray = count($duration);

		return ceil($sumOfElementInArray / $numberOfElementInArray);
	}
}

$duration = new Duration();
echo $duration->averageDuration();
