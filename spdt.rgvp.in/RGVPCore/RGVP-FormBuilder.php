<?php

/* * ****************************************************************** *
 *  This file contains a class, Creates Bootstrap form from mysql table	*	
 *  Date   : 15-August-2018						*
 *  Author : Vivek Pandharkar     					*
 *  Mail   : vivek@pandharkar.com					*
 * 									*
 * ******************************************************************** *
 *    Licence:  GNU General Public License				*
 * 									*
 *   This program is distributed in the hope that it will be useful,	*	
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of	*
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the	*
 *   GNU General Public License for more details.			*											*
 * ******************************************************************** */

class RGVP_FormBuilder {

    var $link;
    var $db;
    var $MySQLCon;
    var $MySQLDB;
    var $Msg;
    var $DBConStatus;

    function __construct() {
        
    }

//Prints result set as a table	
    function RGVPDisplayFormData($result, $format = "border=1") {
        if ($result) {
            echo "<table $format><tr>";
            $totalField = mysqli_field_count($result);
            $totalField = mysqli_fetch_fields($result);
//printing heading
            foreach ($totalField as $Field)
                echo "<th>" . $Field->name . "</th>";
            echo "</tr>";
            //Printing rows
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $v) {
                    echo "<td>" . $v . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Sorry! Not a valid result set: " . mysql_error();
        }
    }

//end of printResult	
//Create combo-box for enumaration fields

    function createList($type, $name) {
        $ENUMvalues = substr($type, 5, strlen($type) - 6);
        echo "<select name='$name'>";
        foreach (explode(',', $ENUMvalues) as $val) {
            $fieldValue = substr($val, 1, strlen($val) - 2);
            echo "<option value='$fieldValue'>$fieldValue</option>";
        }
        echo "</select>";
    }

//Prints form for a table
    function printForm($table, $action, $CommandType = "INSERT", $formclass = 'col-md-6', $skip = "-1") {
        $display_output = "";
        $result = mysql_query("Select * from  $table limit 0,1", $this->link);
        if ($result) {
            $skipfields = explode(',', $skip);
            $stracture = mysql_query("describe $table", $this->link);
            $isEnum = false;
            $display_output .= "<div class='container'>";
            $display_output .= "<form name=" . $table . " action=" . $action . " method='post'>";
            //Printing Fields
            $totalField = mysql_num_fields($result);
            //printing heading
            for ($i = 0; $i < $totalField; $i++) {
                //If this field to avoid cresting input field	
                if (in_array($i, $skipfields))
                    continue;
                //Detacting if this field is ENUM	
                $type = mysql_result($stracture, $i, 1);
                if (strpos($type, 'enum') === false)
                    $isEnum = false;
                else
                    $isEnum = true;
                //echo "<tr>";
                $display_output .= "<div class='row'>\n";
                $fieldname = mysql_field_name($result, $i);
                $fieldlength = mysql_field_len($result, $i);
                $fieldtype = mysql_field_type($result, $i);
                //echo "<td align=left>".mysql_field_name($result,$i) ."</td>";
                //echo "<td align=left> &nbsp;&nbsp;&nbsp;";
                $display_output .= '<div class="' . $formclass . ' col-sm-12">';
                $display_output .= '<label for="txt_' . $fieldname . '">' . $fieldname . '</label>';
                if ($isEnum)
                    $this->createList($type, $fieldname);
                else if ($fieldname == 'password')
                    $display_output .= "<input  class='form-control' type='password' name='txt_" . $fieldname . "' id='txt_" . $fieldname . "' size=20>";
                else if ($fieldlength > 500)
                    $display_output .= "<textarea class='form-control' rows='5' cols='50' wrap='virtual' name='txt_" . $fieldname . "' id='txt_" . $fieldname . "' ></textarea>";
                else
                //echo "<input type=text name=$fieldname size=".($fieldlength+5)*1 .">";
                    $display_output .= '<input class="form-control"  id="txt_' . $fieldname . '" name="txt_' . $fieldname . '" required="" maxlength="' . $fieldlength . '" placeholder="' . $fieldname . '" type="text">';
                //echo "</td>";
                $display_output .= "</div>\n";
                //echo "</tr>";	
                $display_output .= "</div>\n";
            }
            //echo "<tr> <td colspan=2>  <div align=center>
            //		<input type=Submit value=Submit>
            //       <input type=reset value=Reset>
            //	</div></td></tr>";	
            $display_output .= "<div class='row'>
			<input type='hidden' name='CommandType' id='CommandType' value='" . $CommandType . "'>
			<input type=Submit value=Submit>
	        <input type=reset value=Reset>
		</div>";

            $display_output .= "</form></div>";
        }


        else {
            $display_output .= "Sorry! Not a valid result set";
        } return $display_output;
    }

//end of printForm

    function RGVP_BuildForm($MySQLiObj, $RGVPDB, $formclass = 'col-md-6', $isModel = false, $insertskip = "-1", $updateskip = "-1", $selectskip = "-1") {
        $RGVP = $GLOBALS["RGVP"];
        $display_output = "";
        $AddForm_Content = "";
        $EditForm_Content = "";
        $insertskipFields = explode(',', $insertskip);
        $updateskipFields = explode(',', $updateskip);
        $selectskipFields = explode(',', $selectskip);
        $table = "";

        /* DataBase Library */
        $result = $MySQLiObj;
        $table = '';
        $ColumnCount = mysqli_num_fields($result);
        $FieldArray = mysqli_fetch_fields($result);
        $HTMLAddFields = "\n<div class='row'>\n";
        $HTMLEditFields = "\n<div class='row'>\n";
        $PHPFields = "";
        $PHPEditFields = "";
        $HTMLJsEditFields = "";
        $HTMLJsFields = "";
        $HTMLPrimaryKey = "";
        $PrimaryKey = "";

        $FormAddFieldPrefix = "add-";
        $FormEditFieldPrefix = "edit-";
        $i = 0;

        $AddForm = "";
        $EditForm = "";
        $ScriptJs = "";
        //$Js = "";
        $AddPHP = "";
        $EditPHP = "";
        $SelectTableCols = "";

        $AddSaveColsJs = "";
        $EditSaveColsJs = "";
        $EditRetriveColsJs = "";

        $ColumnAPISelect = array();
        $ColumnAPIInsert = array();
        $ColumnAPIUpdate = array();
        $ColumnAPIInsertData = array();
        $ColumnAPIUpdateData = array();

        $UpdateAPICols = "";

        /* Insert Form */

        foreach ($FieldArray as $Field) {
            //if (in_array($Field, $insertskipFields))
            //  continue;
            $Field->type = \RGVPCore\RGVP_MySQL_DataTypes::DataType2String($Field->type);
            $Field->flags = \RGVPCore\RGVP_MySQL_DataTypes::Flags2String($Field->flags);
            $table = $Field->table;

            if ($i % 2 == 0) {
                $HTMLAddFields .= "\n</div>\n<div class='row'>\n";
                $HTMLEditFields .= "\n</div>\n<div class='row'>\n";
            }
            
            if (\RGVPCore\RGVPCore::StrContains("PRI_KEY", $Field->flags)) {
                $HTMLPrimaryKey = '<div class="form-group col-sm-6"><label for="' . $FormEditFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label><div class=" col-sm-12"><input type="text" maxlength="' . $Field->length . '" class="form-control" id="' . $FormEditFieldPrefix . $Field->name . '" name="txt_' . $Field->name . '" placeholder="Unable to Fetch ' . $Field->name . '" readonly required></div></div>';
                $HTMLEditFields .= $HTMLPrimaryKey;
                $PrimaryKey = $Field->name;
                $SelectTableCols .= "<th>" . $Field->name . "</th>";
                $HTMLJsEditFields .= '+ "&txt_' . $Field->name . ' =" + $("#' . $FormEditFieldPrefix . $Field->name . '").val()';
                $AddSaveColsJs .= "<td class=\"sorting_1\">' + obj.txt_" . $Field->name . " + '</td>";
                $EditSaveColsJs .= "$('td:eq(" . $i . ")', tr).html(obj." . $Field->name . ");";
                $EditRetriveColsJs .= "$('#" . $FormEditFieldPrefix . $Field->name . "').val(obj." . $Field->name . ");";
                $ColumnAPISelect[] = $PrimaryKey;
            } else if ($Field->type == "VAR_STRING" && $Field->length <= 100) {
                if (!in_array($Field->name, $insertskipFields)) {
                    $HTMLAddFields .= '<div class="form-group col-sm-6"><label for="' . $FormAddFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label><div class=" col-sm-12"><input type="text" maxlength="' . $Field->length . '" class="form-control" id="' . $FormAddFieldPrefix . $Field->name . '" name="txt_' . $Field->name . '" placeholder="Enter ' . $Field->name . '" required></div></div>';
                    $HTMLJsFields .= '+ "&txt_' . $Field->name . ' =" + $("#' . $FormAddFieldPrefix . $Field->name . '").val()';
                    $AddSaveColsJs .= "<td>' + obj." . $Field->name . " + '</td>";
                    $ColumnAPIInsert[] = $Field->name;
                    $ColumnAPIInsertData[] = "txt_" . $Field->name;
                }
                if (!in_array($Field->name, $updateskipFields)) {
                    $HTMLEditFields .= '<div class="form-group col-sm-6"><label for="' . $FormEditFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label><div class=" col-sm-12"><input type="text" maxlength="' . $Field->length . '" class="form-control" id="' . $FormEditFieldPrefix . $Field->name . '" name="txt_' . $Field->name . '" placeholder="Enter ' . $Field->name . '" required></div></div>';

                    $HTMLJsEditFields .= '+ "&txt_' . $Field->name . ' =" + $("#' . $FormEditFieldPrefix . $Field->name . '").val()';
                    $EditSaveColsJs .= "$('td:eq(" . $i . ")', tr).html(obj." . $Field->name . ");";
                    $EditRetriveColsJs .= "$('#" . $FormEditFieldPrefix . $Field->name . "').val(obj." . $Field->name . ");";
                    $ColumnAPIUpdate[] = $Field->name;
                    $ColumnAPIUpdateData[] = "txt_" . $Field->name;
                }
                if (!in_array($Field->name, $selectskipFields)) {
                    $SelectTableCols .= "<th>" . $Field->name . "</th>";
                    $ColumnAPISelect[] = $Field->name;
                }
            } else if ($Field->type == "VAR_STRING" && $Field->length > 100) {
                if (!in_array($Field->name, $insertskipFields)) {
                    $HTMLAddFields .= '<div class="form-group col-sm-6">
                                <label for="' . $FormAddFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="' . $Field->length . '" class="form-control" id="' . $FormAddFieldPrefix . $Field->name . '" name="txt_' . $Field->name . '" placeholder="Enter ' . $Field->name . '" required></textarea>
                                </div></div>';
                    $HTMLJsFields .= '+ "&txt_' . $Field->name . ' =" + $("#' . $FormAddFieldPrefix . $Field->name . '").val()';
                    $AddSaveColsJs .= "<td>' + obj." . $Field->name . " + '</td>";
                    $ColumnAPIInsert[] = $Field->name;
                    $ColumnAPIInsertData[] = "txt_" . $Field->name;
                }
                if (!in_array($Field->name, $updateskipFields)) {
                    $HTMLEditFields .= '<div class="form-group col-sm-6">
                                <label for="' . $FormEditFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="' . $Field->length . '" class="form-control" id="' . $FormEditFieldPrefix . $Field->name . '" name="txt_' . $Field->name . '" placeholder="Enter ' . $Field->name . '" required></textarea>
                                </div></div>';
                    $HTMLJsEditFields .= '+ "&txt_' . $Field->name . ' =" + $("#' . $FormEditFieldPrefix . $Field->name . '").val()';
                    $EditSaveColsJs .= "$('td:eq(" . $i . ")', tr).html(obj." . $Field->name . ");";
                    $EditRetriveColsJs .= "$('#" . $FormEditFieldPrefix . $Field->name . "').val(obj." . $Field->name . ");";
                    $ColumnAPIUpdate[] = $Field->name;
                    $ColumnAPIUpdateData[] = "txt_" . $Field->name;
                }
                if (!in_array($Field->name, $selectskipFields)) {
                    $SelectTableCols .= "<th>" . $Field->name . "</th>";
                    $ColumnAPISelect[] = $Field->name;
                }
            } else if ($Field->type == "LONG" || \RGVPCore\RGVPCore::StrContains("INT", $Field->type)) {
                if (!in_array($Field->name, $insertskipFields)) {
                    $HTMLAddFields .= '<div class="form-group col-sm-6">
                                <label for="' . $FormAddFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="' . \RGVPCore\RGVPCore::GetNumberLength("MIN", $Field->length) . '" max="' . \RGVPCore\RGVPCore::GetNumberLength("MAX", $Field->length) . '" maxlength="' . $Field->length . '" class="form-control" id="' . $FormAddFieldPrefix . $Field->name . '" name="txt_' . $Field->name . '" placeholder="Enter ' . $Field->name . '"  required>
                                </div></div>';
                    $HTMLJsFields .= '+ "&txt_' . $Field->name . ' =" + $("#' . $FormAddFieldPrefix . $Field->name . '").val()';
                    $AddSaveColsJs .= "<td>' + obj." . $Field->name . " + '</td>";
                    $ColumnAPIInsert[] = $Field->name;
                    $ColumnAPIInsertData[] = "txt_" . $Field->name;
                }
                if (!in_array($Field->name, $updateskipFields)) {
                    $HTMLEditFields .= '<div class="form-group col-sm-6">
                                <label for="' . $FormEditFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="' . \RGVPCore\RGVPCore::GetNumberLength("MIN", $Field->length) . '" max="' . \RGVPCore\RGVPCore::GetNumberLength("MAX", $Field->length) . '" maxlength="' . $Field->length . '" class="form-control" id="' . $FormEditFieldPrefix . $Field->name . '" name="txt_' . $Field->name . '" placeholder="Enter ' . $Field->name . '"  required>
                                </div></div>';
                    $HTMLJsEditFields .= '+ "&txt_' . $Field->name . ' =" + $("#' . $FormAddFieldPrefix . $Field->name . '").val()';
                    $EditSaveColsJs .= "$('td:eq(" . $i . ")', tr).html(obj." . $Field->name . ");";
                    $EditRetriveColsJs .= "$('#" . $FormEditFieldPrefix . $Field->name . "').val(obj." . $Field->name . ");";
                    $ColumnAPIUpdate[] = $Field->name;
                    $ColumnAPIUpdateData[] = "txt_" . $Field->name;
                }
                if (!in_array($Field->name, $selectskipFields)) {
                    $SelectTableCols .= "<th>" . $Field->name . "</th>";
                    $ColumnAPISelect[] = $Field->name;
                }
            } else if ($Field->type == "NEWDECIMAL" || \RGVPCore\RGVPCore::StrContains("DECIMAL", $Field->type)) {
                $step = 0.001;
                if ($Field->decimals == "0")
                    $step = 1;
                else if ($Field->decimals == "1")
                    $step = 0.1;
                else if ($Field->decimals == "2")
                    $step = 0.01;
                else if ($Field->decimals == "3")
                    $step = 0.001;
                else if ($Field->decimals == "4")
                    $step = 0.0001;
                else
                    $step = 0.000001;
                if (!in_array($Field->name, $insertskipFields)) {
                    $HTMLAddFields .= '<div class="form-group col-sm-6">
                                <label for="' . $FormAddFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="0.00" max="' . \RGVPCore\RGVPCore::GetNumberLength("MAX", intval($Field->max_length) - 1) . '.' . \RGVPCore\RGVPCore::GetNumberLength("MAX", intval($Field->decimals)) . '" step="' . $step . '" maxlength="' . (intval($Field->max_length) + intval($Field->decimals) + 1) . '" class="form-control" id="' . $FormAddFieldPrefix . $Field->name . '" name="txt_' . $Field->name . '" placeholder="Enter ' . $Field->name . '"  required>
                                </div></div>';
                    $HTMLJsFields .= '+ "&txt_' . $Field->name . ' =" + $("#' . $FormAddFieldPrefix . $Field->name . '").val()';
                    $AddSaveColsJs .= "<td>' + obj." . $Field->name . " + '</td>";
                    $ColumnAPIInsert[] = $Field->name;
                    $ColumnAPIInsertData[] = "txt_" . $Field->name;
                }
                if (!in_array($Field->name, $updateskipFields)) {
                    $HTMLEditFields .= '<div class="form-group col-sm-6">
                                <label for="' . $FormEditFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="0.00" max="' . \RGVPCore\RGVPCore::GetNumberLength("MAX", intval($Field->max_length) - 1) . '.' . \RGVPCore\RGVPCore::GetNumberLength("MAX", intval($Field->decimals)) . '" step="' . $step . '" maxlength="' . (intval($Field->max_length) + intval($Field->decimals) + 1) . '" class="form-control" id="' . $FormEditFieldPrefix . $Field->name . '" name="txt_' . $Field->name . '" placeholder="Enter ' . $Field->name . '"  required>
                                </div></div>';
                    $HTMLJsEditFields .= '+ "&txt_' . $Field->name . ' =" + $("#' . $FormEditFieldPrefix . $Field->name . '").val()';
                    $EditSaveColsJs .= "$('td:eq(" . $i . ")', tr).html(obj." . $Field->name . ");";
                    $EditRetriveColsJs .= "$('#" . $FormEditFieldPrefix . $Field->name . "').val(obj." . $Field->name . ");";
                    $ColumnAPIUpdate[] = $Field->name;
                    $ColumnAPIUpdateData[] = "txt_" . $Field->name;
                }
                if (!in_array($Field->name, $selectskipFields)) {
                    $SelectTableCols .= "<th>" . $Field->name . "</th>";
                    $ColumnAPISelect[] = $Field->name;
                }
            } else if ($Field->type == "BOLB") {
                if (!in_array($Field->name, $insertskipFields)) {
                    $HTMLAddFields .= '<div class="form-group col-sm-6">
                                <label for="' . $FormAddFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label>
                                <div class=" col-sm-12">
                                    <textarea class="form-control" id="' . $FormAddFieldPrefix . $Field->name . '" name="txt_' . $Field->name . '" placeholder="Enter ' . $Field->name . '" required>
                                </div></div>';
                    $HTMLJsFields .= '+ "&txt_' . $Field->name . ' =" + $("#' . $FormAddFieldPrefix . $Field->name . '").val()';
                    $AddSaveColsJs .= "<td>' + obj." . $Field->name . " + '</td>";
                    $ColumnAPIInsert[] = $Field->name;
                    $ColumnAPIInsertData[] = "txt_" . $Field->name;
                }
                if (!in_array($Field->name, $updateskipFields)) {
                    $HTMLEditFields .= '<div class="form-group col-sm-6">
                                <label for="' . $FormEditFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label>
                                <div class=" col-sm-12">
                                    <textarea class="form-control" id="' . $FormEditFieldPrefix . $Field->name . '" name="txt_' . $Field->name . '" placeholder="Enter ' . $Field->name . '" required>
                                </div></div>';
                    $HTMLJsEditFields .= '+ "&txt_' . $Field->name . ' =" + $("#' . $FormEditFieldPrefix . $Field->name . '").val()';
                    $EditSaveColsJs .= "$('td:eq(" . $i . ")', tr).html(obj." . $Field->name . ");";
                    $EditRetriveColsJs .= "$('#" . $FormEditFieldPrefix . $Field->name . "').val(obj." . $Field->name . ");";
                    $ColumnAPIUpdate[] = $Field->name;
                    $ColumnAPIUpdateData[] = "txt_" . $Field->name;
                }
                if (!in_array($Field->name, $selectskipFields)) {
                    $SelectTableCols .= "<th>" . $Field->name . "</th>";
                    $ColumnAPISelect[] = $Field->name;
                }
            } else if ($Field->type == "ENUM" || $Field->flags == "ENUM") {
                if (!in_array($Field->name, $insertskipFields)) {
                    $HTMLAddFields .= '<div class="form-group col-sm-6">
                                <label for="' . $FormAddFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label>
                                <div class=" col-sm-12">
                                ' . $RGVP->DB->FillSelect($Field->table, $Field->name, TRUE, $Field->name, $FormAddFieldPrefix . $Field->name, "ddl_" . $Field->name) . '
                                </div></div>';
                    $HTMLJsFields .= '+ "&ddl_' . $Field->name . ' =" + $("#' . $FormAddFieldPrefix . $Field->name . '").val()';
                    $AddSaveColsJs .= "<td>' + obj." . $Field->name . " + '</td>";
                    $ColumnAPIInsert[] = $Field->name;
                    $ColumnAPIInsertData[] = "ddl_" . $Field->name;
                }
                if (!in_array($Field->name, $updateskipFields)) {
                    $HTMLEditFields .= '<div class="form-group col-sm-6">
                                <label for="' . $FormEditFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label>
                                <div class=" col-sm-12">
                                ' . $RGVP->DB->FillSelect($Field->table, $Field->name, TRUE, $Field->name, $FormEditFieldPrefix . $Field->name, "ddl_" . $Field->name) . '
                                </div></div>';
                    $HTMLJsEditFields .= '+ "&ddl_' . $Field->name . ' =" + $("#' . $FormEditFieldPrefix . $Field->name . '").val()';
                    $EditSaveColsJs .= "$('td:eq(" . $i . ")', tr).html(obj." . $Field->name . ");";
                    $EditRetriveColsJs .= "$('#" . $FormEditFieldPrefix . $Field->name . "').val(obj." . $Field->name . ");";
                    $ColumnAPIUpdate[] = $Field->name;
                    $ColumnAPIUpdateData[] = "ddl_" . $Field->name;
                }
                if (!in_array($Field->name, $selectskipFields)) {
                    $SelectTableCols .= "<th>" . $Field->name . "</th>";
                    $ColumnAPISelect[] = $Field->name;
                }
            } else if ($Field->type == "CHAR") {
                if (!in_array($Field->name, $insertskipFields)) {
                    $HTMLAddFields .= '<div class="form-group col-sm-6">
                                <label for="' . $FormAddFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label>
                                <div class=" col-sm-12">
                                    <select class="form-control" id="' . $FormAddFieldPrefix . $Field->name . '" name="ddl_' . $Field->name . '" placeholder="Enter ' . $Field->name . '"  required>
                                        <option value="NULL">Pending</option>
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div></div>';
                    $HTMLJsFields .= '+ "&ddl_' . $Field->name . ' =" + $("#' . $FormAddFieldPrefix . $Field->name . '").val()';
                    $AddSaveColsJs .= "<td>' + obj." . $Field->name . " + '</td>";
                    $ColumnAPIInsert[] = $Field->name;
                    $ColumnAPIInsertData[] = "ddl_" . $Field->name;
                }
                if (!in_array($Field->name, $updateskipFields)) {
                    $HTMLEditFields .= '<div class="form-group col-sm-6">
                                <label for="' . $FormEditFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label>
                                <div class=" col-sm-12">
                                    <select class="form-control" id="' . $FormEditFieldPrefix . $Field->name . '" name="ddl_' . $Field->name . '" placeholder="Enter ' . $Field->name . '"  required>
                                        <option value="NULL">Pending</option>
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                                </div>';
                    $HTMLJsEditFields .= '+ "&ddl_' . $Field->name . ' =" + $("#' . $FormEditFieldPrefix . $Field->name . '").val()';
                    $EditSaveColsJs .= "$('td:eq(" . $i . ")', tr).html(obj." . $Field->name . ");";
                    $EditRetriveColsJs .= "$('#" . $FormEditFieldPrefix . $Field->name . "').val(obj." . $Field->name . ");";
                    $ColumnAPIUpdate[] = $Field->name;
                    $ColumnAPIUpdateData[] = "ddl_" . $Field->name;
                }
                if (!in_array($Field->name, $selectskipFields)) {
                    $SelectTableCols .= "<th>" . $Field->name . "</th>";
                    $ColumnAPISelect[] = $Field->name;
                }
            } else if ($Field->type == "DATETIME" || $Field->type == "TIMESTAMP") {
                if (!in_array($Field->name, $insertskipFields)) {
                    $HTMLAddFields .= '<div class="form-group col-sm-6">
                                <label for="' . $FormAddFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label>
                                <div class="col-sm-12">
                                    <input type="datetime-local" class="form-control" id="' . $FormAddFieldPrefix . $Field->name . '" name="datetime_' . $Field->name . '" placeholder="Enter ' . $Field->name . '" required>
                                </div></div>';
                    $HTMLJsFields .= '+ "&datetime_' . $Field->name . ' =" + $("#' . $FormAddFieldPrefix . $Field->name . '").val()';
                    $AddSaveColsJs .= "<td>' + obj." . $Field->name . " + '</td>";
                    $ColumnAPIInsert[] = $Field->name;
                    $ColumnAPIInsertData[] = "datetime_" . $Field->name;
                }
                if (!in_array($Field->name, $updateskipFields)) {
                    $HTMLEditFields .= '<div class="form-group col-sm-6">
                                <label for="' . $FormAddFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label>
                                <div class="col-sm-12">
                                    <input type="datetime-local" class="form-control" id="' . $FormEditFieldPrefix . $Field->name . '" name="datetime_' . $Field->name . '" placeholder="Enter ' . $Field->name . '" required>
                                </div></div>';
                    $HTMLJsEditFields .= '+ "&datetime_' . $Field->name . ' =" + $("#' . $FormEditFieldPrefix . $Field->name . '").val()';
                    $EditSaveColsJs .= "$('td:eq(" . $i . ")', tr).html(obj." . $Field->name . ");";
                    $EditRetriveColsJs .= "$('#" . $FormEditFieldPrefix . $Field->name . "').val(obj." . $Field->name . ");";
                    $ColumnAPIUpdate[] = $Field->name;
                    $ColumnAPIUpdateData[] = "datetime_" . $Field->name;
                }
                if (!in_array($Field->name, $selectskipFields)) {
                    $SelectTableCols .= "<th>" . $Field->name . "</th>";
                    $ColumnAPISelect[] = $Field->name;
                }
            } else if ($Field->type == "DATE") {
                if (!in_array($Field->name, $insertskipFields)) {
                    $HTMLAddFields .= '<div class="form-group col-sm-6">
                                <label for="' . $FormAddFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label>
                                <div class=" col-sm-12">
                                    <input type="date" class="form-control" id="' . $FormAddFieldPrefix . $Field->name . '" name="date_' . $Field->name . '" placeholder="Enter ' . $Field->name . '" required>
                                </div></div>';
                    $HTMLJsFields .= '+ "&date_' . $Field->name . ' =" + $("#' . $FormAddFieldPrefix . $Field->name . '").val()';
                    $AddSaveColsJs .= "<td>' + obj." . $Field->name . " + '</td>";
                    $ColumnAPIInsert[] = $Field->name;
                    $ColumnAPIInsertData[] = "date_" . $Field->name;
                }
                if (!in_array($Field->name, $updateskipFields)) {
                    $HTMLEditFields .= '<div class="form-group col-sm-6">
                                <label for="' . $FormEditFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label>
                                <div class=" col-sm-12">
                                    <input type="date" class="form-control" id="' . $FormEditFieldPrefix . $Field->name . '" name="date_' . $Field->name . '" placeholder="Enter ' . $Field->name . '" required>
                                </div></div>';
                    $HTMLJsEditFields .= '+ "&date_' . $Field->name . ' =" + $("#' . $FormEditFieldPrefix . $Field->name . '").val()';

                    $EditSaveColsJs .= "$('td:eq(" . $i . ")', tr).html(obj." . $Field->name . ");";
                    $EditRetriveColsJs .= "$('#" . $FormEditFieldPrefix . $Field->name . "').val(obj." . $Field->name . ");";
                    $ColumnAPIUpdate[] = $Field->name;
                    $ColumnAPIUpdateData[] = "date_" . $Field->name;
                }
                if (!in_array($Field->name, $selectskipFields)) {
                    $SelectTableCols .= "<th>" . $Field->name . "</th>";
                    $ColumnAPISelect[] = $Field->name;
                }
            } else {
                if (!in_array($Field->name, $insertskipFields)) {
                    $HTMLAddFields .= '<div class="form-group col-sm-6">
                                <label for="' . $FormAddFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label>
                                <div class=" col-sm-12">
                                    <input type="text" maxlength="' . $Field->length . '" class="form-control" id="' . $FormAddFieldPrefix . $Field->name . '" name="txt_' . $Field->name . '" placeholder="Enter ' . $Field->name . '" required>
                                </div></div>';
                    $HTMLJsFields .= '+ "&txt_' . $Field->name . ' =" + $("#' . $FormAddFieldPrefix . $Field->name . '").val()';
                    $AddSaveColsJs .= "<td>' + obj." . $Field->name . " + '</td>";
                    $ColumnAPIInsert[] = $Field->name;
                    $ColumnAPIInsertData[] = "txt_" . $Field->name;
                }
                if (!in_array($Field->name, $updateskipFields)) {
                    $HTMLEditFields .= '<div class="form-group col-sm-6">
                                <label for="' . $FormEditFieldPrefix . $Field->name . '" class=" col-sm-12 control-label">' . $Field->name . '</label>
                                <div class=" col-sm-12">
                                    <input type="text" maxlength="' . $Field->length . '" class="form-control" id="' . $FormEditFieldPrefix . $Field->name . '" name="txt_' . $Field->name . '" placeholder="Enter ' . $Field->name . '" required>
                                </div></div>';
                    $HTMLJsEditFields .= '+ "&txt_' . $Field->name . ' =" + $("#' . $FormEditFieldPrefix . $Field->name . '").val()';
                    $EditSaveColsJs .= "$('td:eq(" . $i . ")', tr).html(obj." . $Field->name . ");";
                    $EditRetriveColsJs .= "$('#" . $FormEditFieldPrefix . $Field->name . "').val(obj." . $Field->name . ");";
                    $ColumnAPIUpdate[] = $Field->name;
                    $ColumnAPIUpdateData[] = "txt_" . $Field->name;
                }
                if (!in_array($Field->name, $selectskipFields)) {
                    $SelectTableCols .= "<th>" . $Field->name . "</th>";
                    $ColumnAPISelect[] = $Field->name;
                }
            }
            $i++;
            //$RGVP_Data = $RGVP_Data . "<th>" . $Field->name . "</th>";
        }
        $HTMLJsFields = "";
        $HTMLJsEditFields = "";
        if ($isModel) {
            $AddForm_Content = '<div class="modal fade" id="' . $FormAddFieldPrefix . 'modal" tabindex="-1" role="dialog" aria-labelledby="' . $FormAddFieldPrefix . 'modal-label">'
                    . '<div class="container-fluid" role="document">'
                    . '<div class="modal-content">'
                    . '<form name=form_' . $table . ' id="' . $FormAddFieldPrefix . $table . '">'
                    . '<div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="' . $FormAddFieldPrefix . 'modal-label">Add ' . $table . '</h4>
                        </div>' . "\n" . '<div class="modal-body"><div class="row">' . "\n"
                    . $HTMLAddFields . '</div>'
                    . '</div></div>' . "\n" . '<div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary pull-right">Save changes</button>
                        </div>'
                    . '</form>'
                    . '</div>'
                    . '</div>'
                    . '</div>';
            $EditForm_Content = '<div class="modal fade" id="' . $FormEditFieldPrefix . 'modal" tabindex="-1" role="dialog" aria-labelledby="' . $FormEditFieldPrefix . 'modal-label">'
                    . '<div class="container-fluid" role="document">'
                    . '<div class="modal-content">'
                    . '<form name=form_' . $table . ' id="' . $FormEditFieldPrefix . $table . '">'
                    . '<div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="' . $FormEditFieldPrefix . 'modal-label">Edit ' . $table . '</h4>
                        </div>' . "\n" . '<div class="modal-body">'
                    . $HTMLEditFields
                    . '</div></div>' . "\n" . '<div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary pull-right">Save changes</button>
                        </div>'
                    . '</form>'
                    . '</div>'
                    . '</div>'
                    . '</div>';
            $ScriptJs .= ""
                    . "<script type='text/javascript' language='javascript' class='init'>
                        var action_url= " . '\'<?php echo RGVPAdminAPIURL ?>\'+\'/' . $table . ".php';
        $('btn-reload').on('click', function ()
        {
                // Initialize datatable
                $('#table_" . $table . "').dataTable({
                    'aProcessing': true,
                    'aServerSide': true,
                    'ajax': action_url + '?CommandType=SELECT'
                });            
        });  
        $(document).ready(function () {
            // ATW
                if (top.location.href != location.href)
                    top.location.href = location.href;
                // Initialize datatable
                $('#table_" . $table . "').dataTable({
                    'aProcessing': true,
                    'aServerSide': true,
                    'ajax': action_url + '?CommandType=SELECT'
                }); 
            // Save edited row
                $('#" . $FormEditFieldPrefix . $table . "').on('submit', function (event) {
                    event.preventDefault();
                    $.post(action_url + '?CommandType=UPDATE-SAVE&id=' + $('#" . $FormEditFieldPrefix . $PrimaryKey . "').val(), $(this).serialize(), function (data) {
                        var obj = $.parseJSON(data);
                        var tr = $('a[data-id=\"row-' + $('#" . $FormEditFieldPrefix . $PrimaryKey . "').val() + '\"]').parent().parent();
                        " . $EditSaveColsJs . "
                        $('#" . $FormEditFieldPrefix . "modal').modal('hide');
                    }).fail(function () {
                        alert('Unable to save data, please try again later.');
                    });
                }); 
            // Add new row
                $('#" . $FormAddFieldPrefix . $table . "').on('submit', function (event) {
                    event.preventDefault();
                    $.post(action_url + '?CommandType=INSERT', $(this).serialize(), function (data) {
                        var obj = $.parseJSON(data);
                        $('#table_" . $table . " tbody tr:last').after('<tr role=\"row\">" . $AddSaveColsJs . "<td><a data-id=\"row-' + obj.id + '\" href=\"javascript:editRow(' + obj.id + ');\" class=\"btn btn-default btn-sm\">edit</a>&nbsp;<a href=\"javascript:removeRow(' + obj.id + ');\" class=\"btn btn-default btn-sm\">remove</a></td></tr>');
                        $('#" . $FormAddFieldPrefix . "modal').modal('hide');
                    }).fail(function () {
                        alert('Unable to save data, please try again later.'); });
                });
        });
            // Edit row
            function editRow(id) {
                if ('undefined' != typeof id) {
                    $.getJSON(action_url + '?CommandType=SELECT-WITH-ID&id=' + id, function (obj) {
                        " . $EditRetriveColsJs . "
                        $('#" . $FormEditFieldPrefix . "modal').modal('show')
                    }).fail(function () {
                        alert('Unable to fetch data, please try again later.')
                    });
                } else
                    alert('Unknown row id.');
            }
            // Remove row
            function removeRow(id) {
                if ('undefined' != typeof id) {
                    $.get(action_url + '?CommandType=DELETE&id=' + id, function () {
                        $('a[data-id=\"row-' + id + '\"]').parent().parent().remove();
                    }).fail(function () {
                        alert('Unable to fetch data, please try again later.')
                    });
                } else
                    alert('Unknown row id.');
            }
</script>";
        } else {
            $AddForm_Content = '<div class="container"><form name=form_' . $table . ' id="' . $FormAddFieldPrefix . $table . '">' . $HTMLAddFields . '</form></div>';
            $EditForm_Content = '<div class="container"><form name=form_' . $table . ' id="' . $FormEditFieldPrefix . $table . '">' . $HTMLEditFields . '</form></div>';
        }
        $ReturnArray["AddForm"] = $AddForm_Content;
        $ReturnArray["EditForm"] = $EditForm_Content;
        $ReturnArray["ScriptJS"] = $ScriptJs;
        $ReturnArray["DisplayHTML"] = '<button type="button" style="padding:10px; margin:0 50px 15px 0;" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add-modal"><b>Add More Rows</b></button>
            <div class="row">
                <div class="col-md-12 marginT20">
                    <div class="table-responsive demo-x content">
                        <table id="table_' . $table . '" class="display-table table-hover table-bordered" cellspacing="0" width="100%">
                            <thead class="btn-primary">
                                <tr>
                                    ' . $SelectTableCols . '
                                    <th style="background-image: none">Edit</th>
                                </tr>
                            </thead>
                            <tfoot class="btn-primary">
                                <tr>
                                    ' . $SelectTableCols . '
                                    <th style="background-image: none">Edit</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>' . $AddForm_Content . $EditForm_Content; //. $ScriptJs;
        $ReturnArray["API"] = '<?php include "include.php";' . '// VARIABLES
                        $SelectColumns = array("' . implode('","', $ColumnAPISelect) . '"); // array("id", "name", "email", "mobile", "start_date");
                        $InsertColumns = array("' . implode('","', $ColumnAPIInsert) . '");
                        $UpdateColumns = array("' . implode('","', $ColumnAPIUpdate) . '");
                        $InsertColumnsData = array("' . implode('","', $ColumnAPIInsertData) . '");
                        $ColumnAPIUpdateData = array("' . implode('","', $ColumnAPIUpdateData) . '");
                        $InsertColDataString = "";
                        $UpdateColDataString = "";
                        $sIndexColumn = "' . $PrimaryKey . '";
                        $sTable = "' . $_REQUEST["table"] . '";
                        $RGVP = new \RGVPCore\RGVPCore();
                        $RGVPDBCon = "";
                        $RGVPDBCon = $RGVP->DB::GetConnection();
                        $CommandType = "EMPTY";
                        if (isset($_REQUEST["CommandType"]))
                            $CommandType = $_REQUEST["CommandType"];
                        $posted = $_REQUEST;
                        foreach ($posted as &$val)
                        if(gettype($val) == "string")
                            $val = mysqli_real_escape_string($RGVPDBCon, $val);

                        switch ($CommandType) {
                            case "EMPTY":
                                echo "No Command Type Received.";
                                break;
                            case "INSERT":
                                // AJAX ADD FROM JQUERY
                                if (isset($_REQUEST)) {
                                    //dbinit($gaSql);
                                    foreach ($InsertColumnsData as $FieldData)
                                        $InsertColDataString .= "\'".$posted[$FieldData]."\',";
                                    $InsertColDataString = substr($InsertColDataString, 0, strlen($InsertColDataString)-1);
                                    $Sql_input = "INSERT INTO $sTable (".implode(",", $InsertColumns).") VALUES ($InsertColDataString)";
                                    $Sql_input = str_replace(",,", ",\'\',", $Sql_input);
                                    $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "INSERT"); 
                                    $id = $RGVP->DB->PrimaryKeyID;
                                    $Sql_output = $RGVP->DB->Execute_Query("SELECT ".implode(",",$SelectColumns)." FROM $sTable WHERE $sIndexColumn = " . $id, "GET", "SQLObj");
                                    die(json_encode(mysqli_fetch_assoc($Sql_output)));
                                }
                                break;
                            case "UPDATE-SAVE":
                            // AJAX EDIT FROM JQUERY
                                if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
                                // SAVE DATA
                                    for ($j=0;$j<count($ColumnAPIUpdateData);$j++)
                                    
                                        $UpdateColDataString .=  $UpdateColumns[$j]." = \'".$posted[$ColumnAPIUpdateData[$j]]."\',";
                                    $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString)-1);
                                    $Sql_input = " UPDATE $sTable SET $UpdateColDataString WHERE $sIndexColumn = " . intval($_GET["id"]);
                                        $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");

                                // GET DATA
                                    $Sql_input = "SELECT ".implode(",",$SelectColumns)." FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
                                    $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
                                    die(json_encode(mysqli_fetch_assoc($Sql_output)));
                                }
                                break;
                            case "DELETE":
                        // AJAX REMOVE FROM JQUERY
                                if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
                                    //dbinit($gaSql);
                                    // REMOVE DATA
                                    $Sql_input = " DELETE FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
                                    $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "DELETE");
                                    if ($RGVP->DB->StatusCode == "501" || $RGVP->DB->StatusCode == "503") {
                                        echo $RGVP->DB->Exception . $RGVP->DB->Msg;
                                    }
                                }
                                break;
                            case "SELECT-WITH-ID":
                                if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
                                    $Sql_input = "SELECT ".implode(",",$SelectColumns)." FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
                                    $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
                                    die(json_encode(mysqli_fetch_assoc($Sql_output)));
                                }
                                break; 
                            case "SELECT":
                            // QUERY LIMIT
                                $sLimit = "";
                                if (isset($_GET["iDisplayStart"]) && $_GET["iDisplayLength"] != "-1") {
                                    $sLimit = "LIMIT " . intval($_GET["iDisplayStart"]) . ", " . intval($_GET["iDisplayLength"]);
                                }
                                // QUERY ORDER
                                $sOrder = "";
                                if (isset($_GET["iSortCol_0"])) {
                                    $sOrder = "ORDER BY ";
                                    for ($i = 0; $i < intval($_GET["iSortingCols"]); $i++) {
                                        if ($_GET["bSortable_" . intval($_GET["iSortCol_" . $i])] == "true") {
                                            $sOrder .= $SelectColumns[intval($_GET["iSortCol_" . $i])] . " " . ( $_GET["sSortDir_" . $i] === "asc" ? "asc" : "desc" ) . ", ";
                                        }
                                    }
                                    $sOrder = substr_replace($sOrder, "", -2);
                                    if ($sOrder == "ORDER BY")
                                        $sOrder = "";
                                }
                                // QUERY SEARCH
                                $sWhere = "";
                                if (isset($_GET["sSearch"]) && $_GET["sSearch"] != "") {
                                    $sWhere = "WHERE (";
                                    for ($i = 0; $i < count($SelectColumns); $i++) {
                                        if (isset($_GET["bSearchable_" . $i]) && $_GET["bSearchable_" . $i] == "true") {
                                            $sWhere .= $SelectColumns[$i] . " LIKE \'%" . mysqli_real_escape_string($RGVPDBCon,$_GET["sSearch"]) . "%\' OR ";
                                        }
                                    }
                                    $sWhere = substr_replace($sWhere, "", -3);
                                    $sWhere .= ")";
                                }
                                // BUILD QUERY
                                for ($i = 0; $i < count($SelectColumns); $i++) {
                                    if (isset($_GET["bSearchable_" . $i]) && $_GET["bSearchable_" . $i] == "true" && $_GET["sSearch_" . $i] != "") {
                                        if ($sWhere == "")
                                            $sWhere = "WHERE ";
                                        else
                                            $sWhere .= " AND ";
                                        $sWhere .= $SelectColumns[$i] . " LIKE \'%" . mysqli_real_escape_string($RGVPDBCon,$_GET["sSearch_" . $i]) . "%\' ";
                                    }
                                }
                                // FETCH
                                $sQueryDisplay = "";
                                $sQuery = " SELECT ".implode(",",$SelectColumns)." FROM $sTable $sWhere $sOrder $sLimit ";
                                $sQueryDisplay .= $sQuery . "\n";
                                $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
                                $sQuery = " SELECT COUNT(" . $sIndexColumn . ") FROM $sTable ";
                                $sQueryDisplay .= $sQuery . "\n";
                                $rResultTotal = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj"); 
                                $aResultTotal = mysqli_fetch_array($rResultTotal);
                                $iTotal = $aResultTotal[0];
                                $output = array();
                                while ($aRow = mysqli_fetch_array($rResult)) {
                                    $row = array();
                                    for ($i = 0; $i < count($SelectColumns); $i++) {
                                        if ($SelectColumns[$i] == "version")
                                            $row[] = ( $aRow[$SelectColumns[$i]] == "0" ) ? "-" : $aRow[$SelectColumns[$i]];
                                        else if ($SelectColumns[$i] != " ")
                                            $row[] = $aRow[$SelectColumns[$i]];
                                    }
                                    $output["data"][] = array_merge($row, array(\'<a data-id="row-\' . $row[0] . \'" href="javascript:editRow(\' . $row[0] . \');" class="btn btn-success"><i class="fa fa-edit"></i></a>&nbsp;<a href="javascript:removeRow(\' . $row[0] . \');" class="btn btn-danger" ><i class="fa fa-close"></i></a>\'),$row);
                                }
                                // RETURN IN JSON
                                die(trim(json_encode($output))); // . $sQueryDisplay);
                                //echo "";
                                break;
                        default:
                                echo "Invalid Command.";
                                break;
                        }';
        return $ReturnArray;
    }

}

//end of class
//end of RGVP-BuildForm
