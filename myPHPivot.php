<?php
//  function to pivot ( simply ) an array or an object 
// Arcker / Yoan Roblet - 10/02/2021
// After some research i used some other php classes like phpivot and Pivot from Gonzalo Ayuso
// They both generate html while i only wanted to pivot JSON to feed a datatables




// simply rotate "90°" > no sum no count, data has to be already calculated
function _simplepivot($ArrayToPivot,$PivotColumn,$PivotRow,$value,$removeheader = true){
    $table = array();
    $columns = array();
    $rows = array();

    foreach ($ArrayToPivot as $row)
    {
        if(!in_array($row[$PivotColumn], $columns))$columns[] = $row[$PivotColumn];
        if(!in_array($row[$PivotRow], $rows))$rows[] = $row[$PivotRow];
        $table[$row[$PivotRow]][$row[$PivotColumn]] = $row[$value];
    }
    $newtable =[];
    $newtable[0][0] = $PivotRow;
    for($i = 1; $i <=  count($columns); $i++){
      $newtable[0][$i] = $columns[$i - 1];
    }
    for($j = 1; $j <=  count($rows); $j++){
      $newtable[$j][0] = $rows[$j-1];
      for($i = 1; $i <=  count($columns); $i++){
        $newtable[$j][$i] =  $table[$rows[$j-1]][$columns[$i-1]];
      }
    }
    return $newtable;
}

?>