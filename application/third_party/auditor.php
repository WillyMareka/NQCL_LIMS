<?php
    
// FILE: auditor.php
// Bring in our "fixed" parser
require_once(APPPATH.'SQL/Parser.php');
 
// Note the use o0f "static" so we never need an instance.
class Auditor {
 
    // This does all the magic.  It makes heavy use of
    // the SQL Parser library (see link above and consult
    // its documentation).
    static function query($query) {
	// We're not interested in SELECT, there are likely
        // millions and they serve no audit purpose.  Pass
        // them through!
        $pos = stripos(ltrim($query),"SELECT");
        if ($pos === 0) { return mysql_query($query); }
 
        // You'll need to modify this for your web app.
        // Alternatively, pass user name in as an argument?
        $username = 'alphy';
 
        // Setup our parser
        $ip_addr  = $_SERVER['REMOTE_ADDR'];
        $parser = new SQL_Parser("",'MySQL');
        $tree = $parser->parse($query);
 
        // Some variables to record our audit data
        $tables = "analysts";
        $type = "update";
        $changes = "";
        $rows = "1";
        $change_list = Array();
 
        // print("$query");
        // print_r("$tree");
        foreach ($tree as $branch) {
 
            // Parse a MySQL UPDATE
            // Note - it is VITAL we check OLD values.  The
            // system in question often sends UPDATES that
            // only change one column yet details them all!
 
            if ($branch[command] == "update") {
                $type = "UPDATE";
                foreach ($branch[tables] as $table) {
                    $tables .= $table[table]." ";
                }
                foreach ($branch[sets] as $set) {
                    $changes .= $set[column][column]."=";
                    // print_r($set[column][column]);
                    foreach ($set[condition][args] as $value) {
                        $changes .= $value[value]." ";
                        $change_list[$set[column][column]] = $value[value];
                    }
                }
                foreach ($branch[where_clause] as $condition) {
                    // print_r($condition);
                    $col = "";
                    $val = "";
                    foreach ($condition as $pair) {
                        if ($col == "") {
                            $col = $pair[column];
                        } else {
                            $val = $pair[value];
                        }
 
                        if ($col != "" && $val != "") {
                            $rows .= $col."=".$val." ";
                            $col = "";
                            $val = "";
                        }
                    }
                }
            }
 
            // If you WERE handling audits on INSERT/DELETE or even SELECT
            // You'd insert your new code block here
        }
 
        //  Now we check against the OLD values
        if ($changes != "") {
            if ($type != "") {
            $old_row = @mysql_query("SELECT * FROM ".$tables." WHERE ".$rows);
            // compare and contrast against change_list
            if ($old_row) {
                if(mysql_num_rows($old_row) == 1) {
                    $finals = "";
                    $row = mysql_fetch_assoc($old_row);
                    // print_r($row);
                    foreach ($change_list as $kk => $vv) {
                        // print("<p>KEY: $kk, VAL: $vv</p>");
                        if ($row[$kk] == $vv || ($row[$kk] == "" && $vv == "NULL") 
                            || ($row[$kk] == "0000-00-00" && $vv == "NULL")) {
                            // print("<p>No Change</p>");
                        } else {
                            if ($finals != "") { $finals .= ", "; }
                            $finals .= "$kk from \"".$row[$kk]."\" to \"$vv\"";
                            // print("<p>Was ".$row[$kk]." will become ".$vv."</p>");
                        }
                    }
 
                    // RECORD the AUDIT
                    if ($finals != "") {
                        $finals = $finals . ".";
                        $auditQry = "INSERT into auditor 
                                     (username,ipaddr,change_type,table_name,table_row,changes) VALUES 
                                     ('$username','$ip_addr','$type','$tables','$rows','$finals')";
                        @mysql_query($auditQry);
                    }
                } /* else {
                    print("Confused, more than one row.  Cannot handle bulk update yet!");
                } */
            }
            }
        }
        return mysql_query($query);
    }
};
 
?>