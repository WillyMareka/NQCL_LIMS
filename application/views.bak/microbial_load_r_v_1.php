<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
    <HEAD>
        <META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
        <TITLE></TITLE>
        <META NAME="GENERATOR" CONTENT="LibreOffice 4.0.5.2 (Linux)">
        <META NAME="AUTHOR" CONTENT="Alphy Poxy">
        <META NAME="CREATED" CONTENT="20140425;22250000">
        <META NAME="CHANGEDBY" CONTENT="Alphy Poxy">
        <META NAME="CHANGED" CONTENT="20140426;3520000">
        <META NAME="AppVersion" CONTENT="15.0000">
        <META NAME="DocSecurity" CONTENT="0">
        <META NAME="HyperlinksChanged" CONTENT="false">
        <META NAME="LinksUpToDate" CONTENT="false">
        <META NAME="ScaleCrop" CONTENT="false">
        <META NAME="ShareDoc" CONTENT="false">
        <STYLE TYPE="text/css">
            <!--
            @page { size: 8.5in 11in; margin: 1in }
            P { margin-bottom: 0in; direction: ltr; line-height: 100%; widows: 2; orphans: 2 }
            P.western { font-family: "Times New Roman", serif; font-size: 12pt; font-weight: bold }
            P.cjk { font-family: "Times New Roman"; font-size: 12pt; font-weight: bold }
            P.ctl { font-family: "Times New Roman"; font-size: 12pt; font-weight: bold }
            H1 { margin-bottom: 0.04in; direction: ltr; line-height: 100%; widows: 0; orphans: 0 }
            H1.western { font-family: "Arial", serif; font-size: 16pt }
            H1.cjk { font-family: "Times New Roman"; font-size: 16pt }
            H1.ctl { font-family: "Arial"; font-size: 16pt }
            H6 { margin-bottom: 0.04in; direction: ltr; line-height: 100%; widows: 0; orphans: 0; page-break-after: auto }
            H6.western { font-size: 11pt }
            H6.cjk { font-family: "Times New Roman"; font-size: 11pt }
            H6.ctl { font-family: "Times New Roman"; font-size: 11pt }
            -->
        </STYLE>


    </HEAD>
    <center><BODY LANG="en-US" DIR="LTR">
             <?php echo form_open('microbial_load/approve/'.$labref.'/'.$r); ?> 
                         <input name="pname" type="hidden"  value="<?php echo $b_data[0]->component;?>"/>

              <p>
                  
                    </p>
                    <INPUT type="hidden" name="determined" id="determined"/>
                    <br>
                   
            <TABLE WIDTH=600 CELLPADDING=7 CELLSPACING=0 STYLE="page-break-before: always">
                <COL WIDTH=55>
                <COL WIDTH=60>
                <COL WIDTH=37>
                <COL WIDTH=600>
                <COL WIDTH=11>
                <COL WIDTH=57>
                <COL WIDTH=4>
                <COL WIDTH=16>
                <COL WIDTH=44>
                <COL WIDTH=35>
                <COL WIDTH=25>
                <COL WIDTH=7>
                <COL WIDTH=10>
                <COL WIDTH=30>
                <COL WIDTH=73>
                <TR>
                    <TD COLSPAN=3 HEIGHT=4 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>MICROBIOLOGY
                                        LAB NO.</B></FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=5 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>DATE
                                        RECEIVED</B></FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=4 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>DATE
                                        TEST SET</B></FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=3 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>DATE
                                        OF RESULTS</B></FONT></FONT></P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=3 HEIGHT=9 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <H1 CLASS="western" STYLE="margin-top: 0in">
                            <input type="text" value="<?php echo $b_data[0]->micro_number;?>" name="micro_no" id="micro_no">
                            <BR>
                        </H1>
                    </TD>
                    <TD COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <span class="western" style="margin-top: 0in">
                                <input type="text" autocomplete="off" name="date_received" id="date_received" value="<?php echo $b_data[0]->date_recieved;?>"/>
                            </span><BR>
                        </P>
                    </TD>
                    <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <span class="western" style="margin-top: 0in">
                                <input type="text" value="<?php echo $b_data[0]->date_test_set;?>" name="date_set" id="date_set">
                            </span><BR>
                        </P>
                    </TD>
                    <TD COLSPAN=3 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <span class="western" style="margin-top: 0in">
                                <input type="text" value="<?php echo $b_data[0]->date_of_results;?>" name="date_of_result" id="date_of_result">
                            </span><BR>
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=15 HEIGHT=8 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>SAMPLE
                                        PREPARATION</B></FONT></FONT></P>
                    </TD>
                </TR>
                <TR VALIGN=TOP>
                    <TD WIDTH=148 HEIGHT=21 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Smp</FONT></FONT></P>
                    </TD>
                    <TD WIDTH=72 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Unit</FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=3 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Diluent</FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=2 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">V</FONT></FONT><SUB><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">1
                                    </FONT></FONT></SUB><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><I>(ml)</I></FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=2 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">P</FONT></FONT><SUB><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">1
                                    </FONT></FONT></SUB><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><I>(ml)</I></FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=2 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">V</FONT></FONT><SUB><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">2
                                    </FONT></FONT></SUB><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><I>(ml)</I></FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=3 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Plating
                                    Vol</FONT></FONT></P>
                    </TD>
                    <TD WIDTH=88 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Replicates</FONT></FONT></P>
                    </TD>
                </TR>
                <TR VALIGN=TOP>
                    <TD WIDTH=148 HEIGHT=21 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <input type="text" value="<?php echo $b_data[0]->smp;?>" autocomplete="off" name="smp" id="textfield"/>
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=72 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <input type="text" value="<?php echo $b_data[0]->unit;?>" autocomplete="off" name="smp" id="textfield" style="width:50px;"/>                            <BR>
                        </P>
                    </TD>
                    <TD COLSPAN=3 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                <input type="text" value="<?php echo $b_data[0]->diluent;?>" name="diluent" id="textfield3">
                            </span><BR>
                        </P>
                    </TD>
                    <TD COLSPAN=2 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                <input type="text"value="<?php echo $b_data[0]->v1;?>" name="v1" id="textfield4" style="width:50px;">
                            </span><BR>
                        </P>
                    </TD>
                    <TD COLSPAN=2 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                <input type="text" value="<?php echo $b_data[0]->p1;?>" name="p1" id="textfield5" style="width:50px;">
                            </span><BR>
                        </P>
                    </TD>
                    <TD COLSPAN=2 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                <input type="text" value="<?php echo $b_data[0]->v2;?>" name="textfield6" id="textfield6" style="width:50px;">
                            </span><BR>
                        </P>
                    </TD>
                    <TD COLSPAN=3 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                <input type="text" value="<?php echo $b_data[0]->plating;?>"name="plating" id="textfield7" style="width:50px;">
                            </span><BR>
                        </P>
                    </TD>
                    <TD WIDTH=88 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">              
                        <input type="text" value="<?php echo $b_data[0]->replicate;?>" autocomplete="off" name="smp" id="textfield" style="width:50px;"/></TD>
                </TR>
                <TR>
                    <TD COLSPAN=15 HEIGHT=2 VALIGN=TOP BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>RESULTS</B></FONT></FONT></P>
                    </TD>
                </TR>
                <TR VALIGN=TOP>
                    <TD COLSPAN=2 HEIGHT=11 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <BR>
                        </P>
                    </TD>
                    <TD COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <BR>
                        </P>
                    </TD>
                    <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>CFU
                                        X 100</B></FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Negative
                                        Control</B></FONT></FONT></P>
                    </TD>
                </TR>
                <TR>
                    <TD ROWSPAN=3 COLSPAN=2 HEIGHT=9 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Nutrient
                                        Agar</B></FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=5 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Plate
                                    1</FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=4 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                <input type="text" name="cfu[]" value="<?php echo $s_data[0]->cfu;?>" class="cfu"/>
                            </span><BR>
                        </P>
                    </TD>
                    <TD COLSPAN=4 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                <input type="text" value="<?php echo $s_data[0]->cfu1;?>" name="cfu1[]" class="cfu11">
                            </span><BR>
                        </P>
                    </TD>
                </TR>
                <TR VALIGN=TOP>
                    <TD COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Plate
                                    2</FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                <input type="text"  value="<?php echo $s_data[1]->cfu;?>"  name="cfu[]" class="cfu">
                            </span><BR>
                        </P>
                    </TD>
                    <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                <input type="text" value="<?php echo $s_data[1]->cfu1;?>"name="cfu1[]" class="cfu11">
                            </span><BR>
                        </P>
                    </TD>
                </TR>
                <TR VALIGN=TOP>
                    <TD COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=RIGHT STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Average
                                        (A)</B></FONT></FONT>:</P>
                    </TD>
                    <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                <input type="text" value="<?php echo $s_data[2]->cfu;?>" name="date_set" id="date_set">
                            </span><BR>
                        </P>
                    </TD>
                    <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0"><span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                          <input type="text" value="<?php echo $s_data[2]->cfu1;?>"name="cfu1[]2" class="cfu11">
                        </span><BR>
                        </P>
                    </TD>
                </TR>
                <TR VALIGN=TOP>
                    <TD COLSPAN=2 HEIGHT=10 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><BR>
                        </P>
                    </TD>
                    <TD COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" STYLE="widows: 0; orphans: 0"><BR>
                        </P>
                    </TD>
                    <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>CFU
                                        X 100</B></FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Negative
                                        Control</B></FONT></FONT></P>
                    </TD>
                </TR>
                <TR>
                    <TD ROWSPAN=3 COLSPAN=2 HEIGHT=8 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Sabourauds
                                    Dextrose </FONT></FONT>
                        </P>
                        <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Agar</FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=5 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Plate
                                    1</FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=4 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" STYLE="widows: 0; orphans: 0"><span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                <input type="text" value="<?php echo $s_data[3]->cfu;?>" name="cfu[]" id="" class="cfu1">
                            </span><BR>
                        </P>
                    </TD>
                    <TD COLSPAN=4 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" STYLE="widows: 0; orphans: 0"><span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                <input type="text" value="<?php echo $s_data[3]->cfu1;?>" name="cfu1[]" class="cfu12">
                            </span><BR>
                        </P>
                    </TD>
                </TR>
                <TR VALIGN=TOP>
                    <TD COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Plate
                                    2</FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" STYLE="widows: 0; orphans: 0"><span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                <input type="text" value="<?php echo $s_data[4]->cfu;?>" name="cfu[]" class="cfu1">
                            </span><BR>
                        </P>
                    </TD>
                    <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" STYLE="widows: 0; orphans: 0"><span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                <input type="text" value="<?php echo $s_data[4]->cfu1;?>"name="cfu1[]" class="cfu12">
                            </span><BR>
                        </P>
                    </TD>
                </TR>
                <TR VALIGN=TOP>
                    <TD height="24" COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=RIGHT STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Average
                                        (B)</B></FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=RIGHT STYLE="widows: 0; orphans: 0"><span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                <input type="text" value="<?php echo $s_data[5]->cfu;?>" name="average2" id="average2">
                            </span><BR>
                        </P>
                    </TD>
                    <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" STYLE="widows: 0; orphans: 0"><span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                          <input type="text" value="<?php echo $s_data[5]->cfu1;?>"name="cfu1[]3" class="cfu11">
                        </span><BR>
                        </P>
                    </TD>
                </TR>
                <TR VALIGN=TOP>
                    <TD COLSPAN=7 HEIGHT=11 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=RIGHT STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Total
                                        CFU</B></FONT></FONT><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">
                                    (Sum of Averages A and B)</FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=RIGHT STYLE="widows: 0; orphans: 0"><span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                        <input type="text" value="<?php echo $s_data[6]->cfu;?>" name="average" id="average">
                        </span><BR>
                      </P>
                    </TD>
                    <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" STYLE="widows: 0; orphans: 0"><span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                          <input type="text" value="<?php echo $s_data[6]->cfu1;?>"name="cfu1[]4" class="cfu11">
                        </span><BR>
                        </P>
                    </TD>
                </TR>
                <TR>
                          <TR>
                    <TD COLSPAN=15 HEIGHT=30 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>NB</B></FONT></FONT><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">:
                                    Where no CFU are found, report the number as Less Than 100 CFU
                                    (Colony Forming Units).</FONT></FONT></P>
                        <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Limits:
                                        Not More Than 5 x 10</B></FONT></FONT><SUP><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>2</B></FONT></FONT></SUP><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>
                                        CFU per mL/g</B></FONT></FONT><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">.</FONT></FONT></P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=2 HEIGHT=22 VALIGN=TOP BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>CONCLUSION</B></FONT></FONT><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">:</FONT></FONT></P>
                        <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"></FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=13 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=RIGHT STYLE="widows: 0; orphans: 0">
                        <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                            <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><?php if( $b_data[0]->conclusion=='No Microbial Count'){ echo 'The Product Complies  with
                                    the requirements of the Microbial Limit Test.'; }else{
										echo ' The Product Does Not Comply with the requirements of the Microbial Limit Test.';
									}?></FONT></FONT></P>
                    </TD>
                </TR>

            </TABLE>
            <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                      <div id="compendia_specification">
                <label>COMPENDIA:</label>
                <textarea id="compendia" name="compendia" required><?php echo $comspe[0]->compedia;?></textarea>
               <label>SPECIFICATION:</label>
                <textarea id="specification" name="specification" required><?php echo $comspe[0]->specification;?></textarea>
            </div>
            </P>
<!--          <center>   <p><input type="submit" value="Approve" style="background-color: #33ff33;color: #ffffff;" class="Inline"/>&nbsp;&nbsp;<a href="#rejectSample" id="Inline" style="background-color: #F00; color: #ffffff;">Reject</a></p>-->
</center>
            </form>
        </BODY></center>
</HTML>