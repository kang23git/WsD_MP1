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


