I got the inspiration of updating and sharing this PHP Class after a good Don Jajo of mine did.... I thought i should at least spare some time as he did to FORK the repo via https://github.com/donjajo/NGStatesLGA so i can contribute to the PHP Class as someone wished if the methods can be at least Chain-able. And now, its not only Chain-able but i added and modify some methods...

 

 
## User Guide 

``` php
require "nsl.php";
```


``` php
$nsl = new NSL('nsl_data') ; // pass as argument path/to/nsl_data file without extention, only json format supported for now. if no argument passed, the default data file name is nsl_data
```

 
 ### Getting Results

To get raw result as it is fetched from the nsl_data file to do your manipulation yourself, use

``` php
$result = $nsl->get();
```

#### `To get all the states`


``` php
$result = $nsl->state()->get(); // returns array of states
```


#### `To get states and their capital`

``` php
$result = $nsl->stateAndCapital()->get();
```

#### `To get local gov under a state`


``` php
$result = $nsl->stateLga('state_name')->get();
```

check in the code to see comment on every method for the function they perform


#### `Counting Results`

To count the number of result, chain the countResult() before the get() method, do like below

``` php
$result_num = $nsl->stateLga('state_name')->countResult()->get();
```

#### Formatting Output

Output can be formatted in JSON and CSV(comma seperated values) . the standard output format is ARRAY.. ARRAY Object will be added in the update to come

###### example formatting;

``` php
$result = $nsl->stateLga('state_name')->stdout('json')->get();
```

**NB**:  only normal array and one level up associate array result can be output via the csv stdout format e.g `array('mike', 'gattel');` and `array(array('mike' => 'gattel'), array())`



 


