<style>
    tr,td{
        border: 1px solid black;
        border-collapse: collapse;
        text-align: center;
        padding: 10px;
    }
    table{
        border-collapse: collapse;
        margin-top: 20px;
    }
</style>
<table>
<?php

if(file_exists('uploads/data.csv')){
    if(($file = fopen('uploads/data.csv', 'r')) !== false){
        while(($data = fgetcsv($file, 1000, ';')) !==false){
            echo "<tr>";
            $out = '';
            for($i = 0; $i < count($data); $i++){
                $out.="<td>".$data[$i]."</td>";
            }
            echo $out;
            echo "</tr>";
        }
        fclose($file);
    }
}
?>
</table>
