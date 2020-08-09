# webstats
An easy way to collect useful statistical information about web page views without any client side code.

## Features
- Records the date and time a page was viewed, the referrer (if any), the viewer's country and whether the user is a bot or a real person (through their IP address).
- You can add ```?notrack``` at the end of the URL if you want to visit your page without counting it as a view.
- Information is displayed in a neat, responsive table.
- Insightful charts such as the number of views during different days of the week are available in [insights](insights).

## Prerequisites
- PHP 7+ (May work on older versions but hasn't been tested)

## Setup
- Download the code as a ZIP file and extract it such that these files are in a folder named 'webstats'.
- Place the folder in the root directory of your webspace. (If you choose to upload it elsewhere, you must update the $statFilePath variable in settings.php)
- Recommended: set up .htaccess password protection for this folder.

### To collect stats for a web page
Add the following at the end of the page's index.php file:
```
include '{$_SERVER['DOCUMENT_ROOT']}/webstats/stats.php';
```

#### If your website has index.html pages instead
Create an index.php file in that directory and add this code in it:
```
<?php
echo file_get_contents("./index.html");
include '{$_SERVER['DOCUMENT_ROOT']}/webstats/stats.php';
?>
```
You may want to rename your index.html file to something else to be extra safe that it doesn't clash with index.php.

## Testing
Open the page on your browser. The page's index.php file will run the code in stats.php which will record the information. To view this information, simply open the /webstats directory of your webspace. You can also open /webstats/insights for processed data.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

## Acknowledgements
- Special thanks to the developers of [Chart.js](https://www.chartjs.org/) for making it so easy to create beautiful and responsive charts.
- Also many thanks to the people behind the [IP Legit API](https://iplegit.com) for providing their insightful database for free of charge.
