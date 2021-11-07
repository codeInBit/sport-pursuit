## Sport Pursuit

This program reads a CSV file which contains records in a bike hire scheme within a period 


## How I Interpreted/Approched the Task
After studing the task, I figured there are many possible interpretations to the task and by such, multiple possible implmentations. My implementation reflects what apeals to me from the little information provided.

I read the csv file with a PHP inbuild function (fgetcsv), and I made sure to chunk the record while loading it, for better optimization. Since the most important part of the record is the arrival dateTime and departure dateTime as those are two values used to compute journey duration, hence, record without any of these is considered an invalid record.
Difference bnetween arrival dateTime and departure dateTime for valid records are calculated in seconds using PHP inbuilt function (strtotime), then the average of these values is calculated and afterwards the result is converted to hh:mm:ss using PHP inbuilt date() function.


## Technology
This project was built with PHP following the TDD approach, while PHPCS and PHPStan are setup and configured in the codebase as static analysis tool to ensure clean, readable, good code quality and uniform standards across the codebase.


## Installation Process
- Clone the project to your local machine
- Install PHP 8.0 on your local machine


