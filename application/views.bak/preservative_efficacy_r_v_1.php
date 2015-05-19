<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
    <HEAD>
        <script src="<?php echo base_url().'Scripts/jquery-1.10.2.js'?>"></script>
                <script type="text/javascript" src="<?php echo base_url() . 'javascripts/tinymce/tinymce.min.js' ?>"></script>

        <META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
        <TITLE></TITLE>
        <META NAME="GENERATOR" CONTENT="LibreOffice 4.0.5.2 (Linux)">
        <META NAME="AUTHOR" CONTENT="Alphy Poxy">
        <META NAME="CREATED" CONTENT="20140505;16570000">
        <META NAME="CHANGEDBY" CONTENT="Alphy Poxy">
        <META NAME="CHANGED" CONTENT="20140505;16580000">
        <META NAME="AppVersion" CONTENT="15.0000">
        <META NAME="DocSecurity" CONTENT="0">
        <META NAME="HyperlinksChanged" CONTENT="false">
        <META NAME="LinksUpToDate" CONTENT="false">
        <META NAME="ScaleCrop" CONTENT="false">
        <META NAME="ShareDoc" CONTENT="false">
        <STYLE TYPE="text/css">
            input{
                width: 70px;
            }
            .len{
                width:200px;
            }

            <!--
            @page { size: 8.5in 11in; margin: 1in }
            P { margin-bottom: 0.08in; direction: ltr; line-height: 100%; widows: 0; orphans: 0 }
            P.western { font-family: "Times New Roman", serif; font-size: 12pt }
            P.cjk { font-family: "Times New Roman"; font-size: 12pt }
            P.ctl { font-family: "Times New Roman"; font-size: 12pt }
            -->
        </STYLE>
        <SCRIPT>
            $(document).ready(function(){
        tinymce.init({
    selector: ".textr"
 });
          
           
        });
        </SCRIPT>
    </HEAD>
    
 
    <?php echo form_open('preservative_efficacy/approve/'.$labref.'/'.$r); ?> 
           
    <BODY LANG="en-US" DIR="LTR">
        <P CLASS="western" STYLE="margin-bottom: 0in"><CENTER>
              <p>
                         <input name="pname" type="hidden" style="width:250px;" value="<?php echo $d_info[0]->component;?>"/>
                    </p>
                    <br>
            <TABLE DIR="LTR" WIDTH=850 CELLPADDING=7 CELLSPACING=0>
                <COL WIDTH=148>
                <COL WIDTH=22>
                <COL WIDTH=25>
                <COL WIDTH=43>
                <COL WIDTH=58>
                <COL WIDTH=46>
                <COL WIDTH=46>
                <COL WIDTH=22>
                <COL WIDTH=9>
                <COL WIDTH=47>
                <COL WIDTH=57>
                <TR>
                    <TD COLSPAN=2 HEIGHT=4 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">MICROBIOLOGY
                                    LAB NO.</FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=3 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">DATE
                                    RECEIVED</FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=3 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">DATE
                                    TEST SET</FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=3 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">DATE
                                    OF RESULTS</FONT></FONT></P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=2 HEIGHT=23 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER>
                            <input type="text" name="microlab_no" class="micro" id="microlab_no" style="width:100%;" value="<?php echo $d_info[0]->micro_number;?>"/>
                            <BR>
                        </P>
                    </TD>
                    <TD COLSPAN=3 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER>
                            <input type="text" name="date_rec" class="micro" id="date_rec" style="width:100%; " value="<?php echo $d_info[0]->date_recieved;?>"/>
                            <BR>
                        </P>
                    </TD>
                    <TD COLSPAN=3 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER>
                            <input type="text" name="date_set" class="micro" id="date_set" style="width:100%;" value="<?php echo $d_info[0]->date_test_set;?>"/>
                            <BR>
                        </P>
                    </TD>
                    <TD COLSPAN=3 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER>
                            <input type="text" name="date_of_results" class="micro" id="date_of_results" style="width:100%;" value="<?php echo $d_info[0]->date_of_results;?>"/>
                            <BR>
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=11 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">INNOCULUM
                                    PREPARATION (if any)</FONT></FONT></P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=11 HEIGHT=61 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><span class="western" style="margin-bottom: 0in">
                                <textarea class="textr" name="sample_preparation" id="sample_preparation" style="height:100%; width: 1050px"><?php echo $d_info[0]->sample_preparation;?></textarea>
                            </span><BR>
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=11 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>RESULTS</B></FONT></FONT></P>
                    </TD>
                </TR>
                <TR>
                    <TD WIDTH=233 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Incubation
                                        Time (Days)</B></FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=10 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Inoculum
                                        Count (CFU)</B></FONT></FONT></P>
                    </TD>
                </TR>
                <TR>
                    <TD ROWSPAN=2 WIDTH=233 HEIGHT=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><BR>
                        </P>
                    </TD>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="microrganism1" class="microrganism1 len" id="date_rec2" style="width:100%; "value="<?php echo $d_info[0]->micro1;?>"placeholder="First Microorganism"/>
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="microrganism2" class="microrganism2 len" id="date_rec3" style="width:100%; " value="<?php echo $d_info[0]->micro2;?>" placeholder="Second Microorganism"/>
                        </P>
                    </TD>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="microrganism3" class="microrganism3 len" id="date_rec4" style="width:100%; " value="<?php echo $d_info[0]->micro3;?>"placeholder="Third Microorganism"/>
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="microrganism4" class="microrganism4 len" id="date_rec5" style="width:100%; " value="<?php echo $d_info[0]->micro4;?>"placeholder="Fourth Microorganism"/>
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">A</FONT></FONT></P>
                    </TD>
                    <TD WIDTH=71 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">B</FONT></FONT></P>
                    </TD>
                    <TD WIDTH=91 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">A</FONT></FONT></P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">B</FONT></FONT></P>
                    </TD>
                    <TD WIDTH=111 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">A</FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">B</FONT></FONT></P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">A</FONT></FONT></P>
                    </TD>
                    <TD WIDTH=64 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">B</FONT></FONT></P>
                    </TD>
                </TR>
                <TR>
                    <TD ROWSPAN=2 WIDTH=233 HEIGHT=9 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>0</B></FONT></FONT></P>
                    </TD>
                    <TD height="26" COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; ">
                        <P CLASS="western">
                          <input type="text" name="textfield13" id="textfield15"  class="avg0" value="<?php echo $d_count[0]->day_count1;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD WIDTH=71 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield33" id="textfield2"  class="avg0" value="<?php echo $d_countb[0]->day_count1;?>"/>
                          <BR>
                        </P>
                    </TD>
                    <TD WIDTH=91 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield17" id="textfield19"  class="avg0" value="<?php echo $d_count[0]->day_count2;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield37" id="textfield38"  class="avg0" value="<?php echo $d_countb[0]->day_count2;?>"/>
                          <BR>
                        </P>
                    </TD>
                    <TD WIDTH=111 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield21" id="textfield23"  class="avg0" value="<?php echo $d_count[0]->day_count3;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield29" id="textfield31"  class="avg0" value="<?php echo $d_countb[0]->day_count3;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield25" id="textfield27"  class="avg0" value="<?php echo $d_count[0]->day_count4;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD WIDTH=64 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield41" id="textfield"  class="avg0" value="<?php echo $d_countb[0]->day_count4;?>"/>
                          <BR>
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average[]" id="textfield47"  class="avg0" value="<?php echo $d_average[0]->day_avg1;?>"/>
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average2[]" id="textfield47" class="avg00"  value="<?php echo $d_average[0]->day_avg2;?>">				</P>
                    </TD>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average3[]" id="textfield47" class="avg000"  value="<?php echo $d_average[0]->day_avg3;?>">
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average4[]" id="textfield47" class="avg0000"  value="<?php echo $d_average[0]->day_avg4;?>">				</P>
                    </TD>
                </TR>
                <TR>
                    <TD ROWSPAN=2 WIDTH=233 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>7</B></FONT></FONT></P>
                    </TD>
                    <TD height="25" COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield14" id="textfield16"  class="avg0" value="<?php echo $d_count[1]->day_count1;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD WIDTH=71 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield34" id="textfield35"  class="avg0" value="<?php echo $d_countb[1]->day_count1;?>"/>
                          <BR>
                        </P>
                    </TD>
                    <TD WIDTH=91 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield18" id="textfield20"  class="avg0" value="<?php echo $d_count[1]->day_count2;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield38" id="textfield39"  class="avg0" value="<?php echo $d_countb[1]->day_count2;?>"/>
                          <BR>
                        </P>
                    </TD>
                    <TD WIDTH=111 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield22" id="textfield24"  class="avg0" value="<?php echo $d_count[1]->day_count3;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield30" id="textfield32"  class="avg0" value="<?php echo $d_countb[1]->day_count3;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield26" id="textfield28"  class="avg0" value="<?php echo $d_count[1]->day_count4;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD WIDTH=64 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield42" id="textfield42"  class="avg0" value="<?php echo $d_countb[1]->day_count4;?>"/>
                          <BR>
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                          <input type="text" name="textfield2" id="textfield4"  class="avg0" value="<?php echo $d_average[1]->day_avg1;?>"/>
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                          <input type="text" name="textfield6" id="textfield8"  class="avg0" value="<?php echo $d_average[1]->day_avg2;?>"/>
                        </P>
                    </TD>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                          <input type="text" name="textfield7" id="textfield9"  class="avg0" value="<?php echo $d_average[1]->day_avg3;?>"/>
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                          <input type="text" name="textfield10" id="textfield12"  class="avg0" value="<?php echo $d_average[1]->day_avg4;?>"/>
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD ROWSPAN=2 WIDTH=233 HEIGHT=9 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>14</B></FONT></FONT></P>
                    </TD>
                    <TD height="27" COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield15" id="textfield17"  class="avg0" value="<?php echo $d_count[2]->day_count1;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD WIDTH=71 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield35" id="textfield36"  class="avg0" value="<?php echo $d_countb[2]->day_count1;?>"/>
                          <BR>
                        </P>
                    </TD>
                    <TD WIDTH=91 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield19" id="textfield21"  class="avg0" value="<?php echo $d_count[3]->day_count2;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield39" id="textfield40"  class="avg0" value="<?php echo $d_countb[3]->day_count2;?>"/>
                          <BR>
                        </P>
                    </TD>
                    <TD WIDTH=111 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield23" id="textfield25"  class="avg0" value="<?php echo $d_count[2]->day_count3;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield31" id="textfield33"  class="avg0" value="<?php echo $d_countb[2]->day_count3;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield27" id="textfield29"  class="avg0" value="<?php echo $d_count[2]->day_count4;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD WIDTH=64 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield43" id="textfield43"  class="avg0" value="<?php echo $d_countb[1]->day_count4;?>"/>
                          <BR>
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                          <input type="text" name="textfield" id="textfield3"  class="avg0" value="<?php echo $d_average[2]->day_avg1;?>"/>
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                          <input type="text" name="textfield5" id="textfield7"  class="avg0" value="<?php echo $d_average[2]->day_avg2;?>"/>
                        </P>
                    </TD>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                          <input type="text" name="textfield8" id="textfield10"  class="avg0" value="<?php echo $d_average[2]->day_avg3;?>"/>
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                          <input type="text" name="textfield11" id="textfield13"  class="avg0" value="<?php echo $d_average[2]->day_avg4;?>"/>
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD ROWSPAN=2 WIDTH=233 HEIGHT=8 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>28</B></FONT></FONT></P>
                    </TD>
                    <TD height="33" COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield16" id="textfield18"  class="avg0" value="<?php echo $d_count[3]->day_count1;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD WIDTH=71 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield36" id="textfield37"  class="avg0" value="<?php echo $d_countb[3]->day_count1;?>"/>
                          <BR>
                        </P>
                    </TD>
                    <TD WIDTH=91 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield20" id="textfield22"  class="avg0" value="<?php echo $d_count[3]->day_count2;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield40" id="textfield41"  class="avg0" value="<?php echo $d_countb[3]->day_count2;?>"/>
                          <BR>
                        </P>
                    </TD>
                    <TD WIDTH=111 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield24" id="textfield26"  class="avg0" value="<?php echo $d_count[3]->day_count3;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield32" id="textfield34"  class="avg0" value="<?php echo $d_countb[3]->day_count3;?>"/>
                          <BR>
                        </P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield28" id="textfield30"  class="avg0" value="<?php echo $d_count[3]->day_count4;?>"/>
                          <BR>
                      </P>
                    </TD>
                    <TD WIDTH=64 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                          <input type="text" name="textfield44" id="textfield44"  class="avg0" value="<?php echo $d_countb[1]->day_count4;?>"/>
                          <BR>
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                          <input type="text" name="textfield3" id="textfield5"  class="avg0" value="<?php echo $d_average[3]->day_avg1;?>"/>
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg</B></FONT></FONT>
                          <input type="text" name="textfield4" id="textfield6"  class="avg0" value="<?php echo $d_average[3]->day_avg2;?>"/>
                        </P>
                    </TD>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                          <input type="text" name="textfield9" id="textfield11"  class="avg0" value="<?php echo $d_average[3]->day_avg3;?>"/>
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                          <input type="text" name="textfield12" id="textfield14"  class="avg0" value="<?php echo $d_average[3]->day_avg4;?>"/>
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=11 HEIGHT=9 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Comments:</B></FONT></FONT>
                            <textarea class="textr" name="comments" id="comments" style="height:100%; width: 1050px"><?php echo $d_info[0]->comments;?></textarea>
                        </P>
                    </TD>
                </TR>
                <TR>
                <TR>
                    <TD COLSPAN=14 HEIGHT=23 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>NI:
                                    </B></FONT></FONT><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">No
                                    increase </FONT></FONT><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>NR</B></FONT></FONT><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">:
                                    No recovery</FONT></FONT></P>
                    </TD>
                </TR>
                <TR>
                    <TD ROWSPAN=2 COLSPAN=2 HEIGHT=29 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>CONCLUSION</B></FONT></FONT><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">:
                                </FONT></FONT>
                        </P>
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">The
                                    Product </FONT></FONT>
                        </P>
                    </TD>
                    <TD COLSPAN=2 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
<?php if($d_info[0]->comply =='COMPLIES'){;?>
                        <input type="radio" name="comply" id="radio" value="COMPLIES" checked>
<?php  } else{ ?>
  <input type="radio" name="comply" id="radio" value="COMPLIES" >
  <?php } ?>
                    </TD>
                    <TD COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        Complies
                    </TD>
                    <TD ROWSPAN=2 COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        With the requirements of the Preservative Efficacy Test
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=2 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
<?php if($d_info[0]->comply =='DOES NOT COMPLY'){;?>
                        <input type="radio" name="comply" id="radio2" value="DOES NOT COMPLY" checked>
                        <?php } else { ?>
                             <input type="radio" name="comply" id="radio2" value="DOES NOT COMPLY"><?php } ?>   


                    </TD>
                    <TD COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        Does Not Comply
                    </TD>
                </TR>

            </TABLE>
                               <div id="compendia_specification">
                <label>COMPENDIA:</label>
                <textarea id="compendia" name="compendia" required="required"><?php echo $comspec[0]->compedia;?></textarea>
               <label>SPECIFICATION:</label>
               <TEXTAREA id="specification" name="specification" required="required"><?php echo $comspec[0]->specification;?>"</TEXTAREA>
            </div>
        </CENTER><BR>
    </form>
    </P>
</BODY>
</HTML>