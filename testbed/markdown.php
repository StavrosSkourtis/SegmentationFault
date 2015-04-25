<?php

    require_once '../utils/Parsedown.php';


    $parse = new Parsedown();
    $text = '
# This is my article

* Point one
* Point two
* Point three

```
<?php
   foreach(range(0,10) as $x){
   echo $x;
}
?>
```

Here is some echo `\'inline code\'`;';
    $parse-->setMarkupEscaped(true);
    echo $parse->text($text);
