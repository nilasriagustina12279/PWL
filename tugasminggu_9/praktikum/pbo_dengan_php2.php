<?php

class FormulirSederhana
{
    //deklarasi variabel
    var $fields = array();
    var $action;
    var $submit = "kirim-form";
    var $jumlahFields = 0;

    function __construct($action, $submit)
    {
        $this->action = $action;
        $this->submit = $submit;
    }

    function tampilkanFormulir()
    {
        // if (isset($_POST['submit'])) {
        //     # code...
        // }
        echo "<form action='" . $this->action . "' method='POST'>";

        echo "<table width='80%'>";

        for ($j = 0; $j < count($this->fields); $j++) {
            # code...
            echo "<tr><td align='right'>" . $this->fields[$j]['label'] . "</td>";

            echo "<td><input type='text' name='" . $this->fields[$j]['name'] . "'></td></tr>";
        }

        echo "<tr><td colspan='2'>";
        echo "<input type='submit' value='" . $this->submit . "'></td</tr>";

        echo "</table>";
    }

    function tambahField($name, $label)
    {
        $this->fields[$this->jumlahFields]['name'] = $name;

        $this->fields[$name]['label'] = $label;
        $this->jumlahFields++;
    }
}