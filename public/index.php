<?php
/**
 * Created by PhpStorm.
 * User: shreya
 * Date: 10/8/18
 * Time: 4:11 PM
 */



main::start("Data.csv");

class main{

    static public function start($flnm){



        $rcds = csv::getRecords($flnm);

        $tbl = html::generateTable($rcds);

        system::printPage($tbl);

    }
}

class html
{

    public static function generateTable($rcds){

        $tbl = '<style>
table {

    border-spacing: 1;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    text-align: left;
    padding: 16px;
}

tr:nth-child(even) {
    background-color: #f2f2f2
}
</style>
        <table>';

        $tbl .= row::tableRow($rcds);
        $tbl .= '</table>';
        return $tbl;
    }

}



class row{
    public  static function tableRow($rcds)
    {
        $i=0;
        $flag = true;
        $tbl = "";
        foreach ($rcds as $key => $value) {
            $tbl .= "<tr class= \"<?=($i++%2==1) ? 'odd'  : ''; ?>\">";
            foreach ($value as $key2 => $value2) {
                if($flag){
                    $tbl .= "<th>".htmlspecialchars($value2)."</th>";

                }else{
                    $tbl .= '<td>' . htmlspecialchars($value2) . '</td>';
                }
            }
            $flag = false;
            $tbl .= "</tr>";
        }

        return $tbl;

    }
}

class tableFactory{

    public static function build(Array $row = null, Array $values  = null)
    {

        $tbl =new table($row , $values);

        return $tbl;

    }

}

class csv{

    public static function getRecords($flnm){

        $file = fopen($flnm,"r");
        $flnms = array();
        $cnt = 0;

        while(! feof($file))
        {
            $record=fgetcsv($file);

            if($cnt==0) {

                $flnms = $record;
                $rcds[] = recordFactory::create($flnms, $flnms);
            }
            else {
                $rcds[] = recordFactory::create($flnms, $record);
            }
            $cnt++;
        }

        fclose($file);

        return $rcds;

    }
}

class record{

    public function __construct(Array $flnms = null , $values = null){

        $record = array_combine($flnms, $values);

        foreach ($record as $property => $value) {
            $this->createProperty($property, $value);
        }
    }
    public function ReturnArray(){

        $array= (array) $this;

        return $array;
    }

    public function createProperty($name = 'First', $value = 'Shreya'){
        $this->{$name} = $value;
    }

}

class recordFactory{

    public static function create(Array $flnms = null, Array $values  = null)
    {

        $record=new record($flnms , $values);

        return $record;

    }

}
class system
{

    public static function printPage($pg)
    {

        echo $pg;
    }
}


