
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link type='text/css' href='<?php echo base_url(); ?>stylesheets/css/zebra_dialog.css' rel='stylesheet' media='screen' />
        <link rel="stylesheet" href="<?php echo base_url(); ?>stylesheets/styleassay.css" type="text/css" media="screen"/>
        <link href="<?php echo base_url(); ?>stylesheets/jquery_notification.css" type="text/css" rel="stylesheet"/>
        <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery_notification_v.1.js"></script>

        <script src="<?php echo base_url() . 'Scripts/jquery-1.10.2.js' ?>"></script>

        <style type="text/css">


            input[type=text]{
                text-align:center;
                margin:auto;              

            }
            input.time1{
                width: 15px;
            }

            .stage{
                width:50px;
            }
            span.workingweight12{

                margin-right: 100px;
                width: 25px

            }
            input#DM,#DM2,#workingmgml1,
            #conc,#conc_2,#dmgml1,#dmgml{
                width: 100px;
            }

            td{

                text-align:center;

            }
            td#b{
                border:thin #000;
            }


            td#x{
                text-align:right;
            }
            p{
                margin:0 auto;
            }

            table#we td, th{
                border:#000000 1px solid;
                margin:0px;	
            }
            input.areas{
                width: 100px;
            }

            p#show,#hide{
                float: left;

            }
            p#show:hover{
                text-decoration: underline;
                font-weight: bold;
                color: blue;

            }
            p#hide:hover{
                text-decoration: underline;
                font-weight: bold;
                color: blue;

            }
            .active_ingredient[type=text]{
                width: 250px;
            }
            #saveicon{
                display: none;
            }
            #multi[type=text]{
                width: 250px;
            }

            .waiting-circles{ padding: 0; display: inline-block; 
                              position: relative; width: 60px; height: 60px;}
            .waiting-circles-element{ margin: 0 2px 0 0; background-color: #e4e4e4; 
                                      border: solid 1px #f4f4f4;
                                      width: 10px; height: 10px; display: inline-block; 
                                      -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;}
            .waiting-circles-play-0{ background-color: #9EC45F; }
            .waiting-circles-play-1{ background-color: #aEd46F; }
            .waiting-circles-play-2{ background-color: #bEe47F; }
            #Notice{
                color: red;
                font-weight: bolder;
                font-size: 12px;

            }

            form input,select,textarea {
                //width: 70%;
                padding: 1px;
                border: 1px solid #d4d4d4;
                //border-bottom-right-radius: 5px;
                //border-top-right-radius: 4px;

                line-height: 1.5em;
                //float: right;

                /* some box shadow sauce :D */
                box-shadow: inset 0px 2px 2px #ececec;
            }
            form input:focus {
                /* No outline on focus */
                outline: 0;
                /* a darker border ? */
                border: 1px solid #bbb;
            }

            #dissolution{
                float: left;
                margin-left: 0px;
            }
            #diss-top{
                width: 98%;   
                height: 350px;
                padding:10px;
                margin-top: 10px;




            }
            #level1{
                width: 98%;
                height:200px;

                padding: 10px;
                margin-top: 5px;;
            }
            #level2{
                width: 98%;
                height:350px;

                padding: 10px;
                margin-top: 5px;;
            }
            #diss-top,#level1,#level2,#comments{
                background: rgb(246,248,249); /* Old browsers */
                /* IE9 SVG, needs conditional override of 'filter' to 'none' */
                background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2Y2ZjhmOSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjIwJSIgc3RvcC1jb2xvcj0iI2U1ZWJlZSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmNWY3ZjkiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
                background: -moz-linear-gradient(top,  rgba(246,248,249,1) 0%, rgba(229,235,238,1) 20%, rgba(245,247,249,1) 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(246,248,249,1)), color-stop(20%,rgba(229,235,238,1)), color-stop(100%,rgba(245,247,249,1))); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* IE10+ */
                background: linear-gradient(to bottom,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6f8f9', endColorstr='#f5f7f9',GradientType=0 ); /* IE6-8 */
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                border: 1px solid black;
                box-shadow: 3px;
            }
            #tablets tr td{
                border: 1px solid black;
            }
            .dissolution-class[type=text],#tcmean,#tcreading{
                width:50px;
            }
            .dissolution-class1[type=text]{
                width:80px;
            }
            #dissolutio{
                width: 200px;
                height:280px;
                margin-left: 700px;
                position:absolute;
                padding: 10px;
                border: 1px solid black;
            }
            #dissolutio1{
                width: 200px;
                height:280px;
                margin-left: 400px;
                position:absolute;
                padding: 10px;
                border: 1px solid black;
            }
            #di{
                margin-left: 700px;  
            }
            label{
                display: block;
                margin: 5px;
            }
            #comments{
                width: 99.5%;
                height:200px;
                margin-top: 5px;
            }

            .refsub{
                width:150px;
                height: 250px;
                background: rgb(180,221,180); /* Old browsers */
                background: -moz-linear-gradient(top,  rgba(180,221,180,1) 0%, rgba(131,199,131,1) 10%, rgba(82,177,82,1) 24%, rgba(0,138,0,1) 100%, rgba(0,87,0,1) 100%, rgba(0,36,0,1) 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(180,221,180,1)), color-stop(10%,rgba(131,199,131,1)), color-stop(24%,rgba(82,177,82,1)), color-stop(100%,rgba(0,138,0,1)), color-stop(100%,rgba(0,87,0,1)), color-stop(100%,rgba(0,36,0,1))); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* IE10+ */
                background: linear-gradient(to bottom,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b4ddb4', endColorstr='#002400',GradientType=0 ); /* IE6-9 */


                position: absolute;
                -moz-border-radius: 5px;
                -webkit-border-radius: 5px;
                border-radius: 5px;
                box-shadow: 5px;
                padding: 5px;
                z-index: 10px;
                color:white;
                margin: 3px;
                font-weight: bolder;

            }
            .refsub input{
                width:80px;
            }
            .rf{
                display:block;
            }

            input.dissdata{
                width:60px;
            }

            table.toptable
            {
                border-width: 0 0 1px 1px;
                border-spacing: 0;
                border-collapse: collapse;
                border-style: solid;
                margin-left: 10px;
                -moz-border-radius: 5px;
                -webkit-border-radius: 5px;
                border-radius: 5px;
            }
            #top-table-right{
                margin-left: 575px;
                position: absolute;
                top:130px;
            }

            table.toptable td
            {
                margin: 0;
                padding: 4px;
                border-width: 1px 1px 0 0;
                border-style: solid;
            }
            .toptable tr:hover {
                background-color: lightyellow;
            }

            .tg  {border-collapse:collapse;border-spacing:0;border-color:#aaa;}
            .tg td{font-family:Arial, sans-serif;font-size:14px;padding:4px 2px;border-style:solid;border-width:1px;border-color:#aaa;color:#333;background-color:#fff;}
            .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;border-color:#aaa;color:black;}
            .tg .tg-z2zr{background-color:#FCFBE3}

            #assay{
                margin-left: 10px;
            }
            input.s1{
                width: 50px;
                text-align: center;
            }
            #R3,#R32,#R33,#R34,#R35{
                width: 40px;
            }

        </style>


    </head>

    <body>

        <p> <center><legend><h2>NQCL Dissolution Results</h2></legend></center></p>
        <p>
            <?php if ($r > 1) {
                $repeat = $r - 1
                ?>
                <p><center><legend><h2>Sample Results: <?php echo $labref; ?>&nbsp;|&nbsp;Component: <?php echo $component_name[0]->component; ?> &nbsp; <?php echo 'Repeat ' . $repeat; ?> &nbsp;|&nbsp;Posted: <?php echo $diss_conds_conc[0]->date_time; ?>  </h2></legend></center></p>
            <?php } else { ?>
                <p><center><legend><h2>Sample Results: <?php echo $labref; ?>&nbsp;|&nbsp;Component: <?php echo $component_name[0]->component; ?> &nbsp;|&nbsp;Posted: <?php echo $diss_conds_conc[0]->date_time; ?>  </h2></legend></center></p>
        <?php } ?>
        </p>
        <?php echo form_open('dissolution/approve/' . $labref . '/' . $r, array('id' => 'capsUni')); ?> 

        <?php
        //var_dump($diss_conds_conc);
        foreach ($diss_conds_conc as $diss_conds)
            foreach ($stage_2_conds as $diss_conds_2)
                
                ?> 
    

        <div id="diss-top"> 
                <table width="553" class="toptable" >
                    <tr>
                        <td width="33">No</td>
                        <td width="62">Wt(mg)</td>
                        <td width="178">&nbsp;</td>
                        <td width="130">Stage 1</td>
                        <td width="126">Stage 2</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td><input type="text" name="tc1" id="tc1" class="dissolution-class  dissdata" readonly tabindex="1" value="<?php echo $diss_tabs[0]->tab_caps_weights; ?>"/></td>
                        <td>Dissolution Medium</td>
                        <td>
                            <input type="text" name="DM" placeholder="e.g. HCL" id="DM" readonly value="<?php echo $diss_conds->dissolution_medium; ?>"  />
                        </td>
                        <td>   <input type="text" name="DM2" placeholder="e.g. HCL"  id="DM2" readonly class="stage2" value="<?php echo $diss_conds_2->dissolution_medium ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><input type="text" name="tc2" id="tc2" class="dissolution-class dissdata" readonly tabindex="2" value="<?php echo $diss_tabs[1]->tab_caps_weights; ?>"/></td>
                        <td>Volume Used (mL)</td>
                        <td><input type="text" name="R2" placeholder="900"  id="R2" readonly value="<?php echo $diss_conds->volume_used; ?>" /></td>
                        <td><input type="text" name="Rv21" placeholder="900"  id="Rv21" readonly class="stage2" value="<?php echo $diss_conds_2->volume_used; ?>"/></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><input type="text" name="tc3" id="tc3" class="dissolution-class dissdata" readonly tabindex="3" value="<?php echo $diss_tabs[2]->tab_caps_weights; ?>"/></td>
                        <td>Apparatus</td>
                        <td>
                            <input name="apparatus" value="<?php echo $diss_conds->apparatus; ?>"  id="workingp13" class="s1"  required />
                        </td>

                        <td>
                            <input name="apparatus1" value="<?php echo $diss_conds_2->apparatus; ?>"  id="workingp13" class="s1"  required />
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><input type="text" name="tc4" id="tc4" class="dissolution-class dissdata" readonly tabindex="4" value="<?php echo $diss_tabs[3]->tab_caps_weights; ?>"/></td>
                        <td>RPM </td>
                        <td>  <input type="text" name="Rm" value="<?php echo $diss_conds->rotations_per_minute; ?> rpm"  placeholder="e.g 100" value="" id="Rm" required="required" />
                            <td><input type="text" name="Rm2" value="<?php echo $diss_conds_2->rotations_per_minute; ?>rpm" placeholder="" value="" id="Rm2" class="stage2" readonly /></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><input type="text" name="tc5" id="tc5" class="dissolution-class dissdata" readonly tabindex="5" value="<?php echo $diss_tabs[4]->tab_caps_weights; ?>"/></td>
                        <td>Time (mins)</td>
                        <td><input type="text" name="R3" value="<?php echo $diss_conds->time_taken1; ?>"  placeholder="e.g 30" value="" id="R3" required="required"  />
                             <input type="text" name="R3" value="<?php echo $diss_conds->time_taken2; ?>"  placeholder="e.g 30" value="" id="R31" required="required"  />
                             <input type="text" name="R31" value="<?php echo $diss_conds->time_taken3; ?>"  placeholder="e.g 30" value="" id="R32" required="required"  />
                            <input type="text" name="R34" value="<?php echo $diss_conds->time_taken4; ?>"  placeholder="e.g 30" value="" id="R33" required="required"  />
                           <input type="text" name="R35" value="<?php echo $diss_conds->time_taken5; ?>"  placeholder="e.g 30" value="" id="R34" required="required"  />
                           </td>
                            <td>
                                <input type="text" name="R4" value="<?php echo $diss_conds_2->time_taken; ?>" id="" class="stage2 time1"/>


                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><input type="text" name="tc6" id="tc6" class="dissolution-class dissdata" readonly tabindex="6"  value="<?php echo $diss_tabs[5]->tab_caps_weights; ?>"/></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td height="26">Avg</td>
                                    <td>
                                        <input type="text" name="tcmean" id="tcmean" readonly value="<?php echo $diss_conds->diss_mean; ?>"  />
                                    </td>    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>

                                </table>

                                <div>
                                    <table class="tg" id="top-table-right">
                                        <tr>
                                            <th class="tg-031e" colspan="5"><center>TIME (mins)</center></th>

                                        </tr>

                                        <tr class="tg-even">
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $diss_conds->time_taken1; ?>" name="area111" id="area-111" class="dissolution-class1 dissdata tar1" readonly tabindex=""/></td>
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $diss_conds->time_taken2; ?>" name="area121" id="area-121" class="dissolution-class1 dissdata tar2" readonly tabindex=""/></td>
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $diss_conds->time_taken3; ?>" name="area131" id="area-131" class="dissolution-class1 dissdata tar3" readonly tabindex=""/></td>
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $diss_conds->time_taken4; ?>" name="area141" id="area-141" class="dissolution-class1 dissdata tar4" readonly tabindex=""/></td>
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $diss_conds->time_taken5; ?>" name="area151" id="area-151" class="dissolution-class1 dissdata tar5" readonly tabindex=""/></td>
                                        </tr>  
                                        <tr>
                                            <th class="tg-031e" colspan="5"><center>AREAS / ABSORBANCES</center></th>

                                        </tr>



                                        <tr class="tg-even">
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[0]->area_1; ?>" name="area1[]" id="area-11" class="dissolution-class1 dissdata area1" readonly tabindex=""/></td>
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[0]->area_2; ?>" name="area2[]" id="area-12" class="dissolution-class1 dissdata area2" readonly tabindex=""/></td>
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[0]->area_3; ?>" name="area3[]" id="area-13" class="dissolution-class1 dissdata area3" readonly tabindex=""/></td>
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[0]->area_4; ?>" name="area4[]" id="area-14" class="dissolution-class1 dissdata area4" readonly tabindex=""/></td>
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[0]->area_5; ?>" name="area5[]" id="area-15" class="dissolution-class1 dissdata area5" readonly tabindex=""/></td>
                                        </tr>
                                        <tr>
                                            <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[1]->area_1; ?>" name="area1[]" id="area-21" class="dissolution-class1 dissdata area1" readonly tabindex=""/></td>
                                            <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[1]->area_2; ?>" name="area2[]" id="area-22" class="dissolution-class1 dissdata area2" readonly tabindex=""/></td>
                                            <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[1]->area_3; ?>" name="area3[]" id="area-23" class="dissolution-class1 dissdata area3" readonly tabindex=""/></td>
                                            <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[1]->area_4; ?>" name="area4[]" id="area-24" class="dissolution-class1 dissdata area4" readonly tabindex=""/></td>
                                            <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[1]->area_5; ?>" name="area5[]" id="area-25" class="dissolution-class1 dissdata area5" readonly tabindex=""/></td>
                                        </tr>
                                        <tr class="tg-even">
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[2]->area_1; ?>" name="area1[]" id="area-31" class="dissolution-class1 dissdata area1" readonly tabindex=""/></td>
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[2]->area_2; ?>" name="area2[]" id="area-32" class="dissolution-class1 dissdata area2" readonly tabindex=""/></td>
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[2]->area_3; ?>" name="area3[]" id="area-33" class="dissolution-class1 dissdata area3" readonly tabindex=""/></td>
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[2]->area_4; ?>" name="area4[]" id="area-34" class="dissolution-class1 dissdata area4" readonly tabindex=""/></td>
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[2]->area_5; ?>" name="area5[]" id="area-35" class="dissolution-class1 dissdata area5" readonly tabindex=""/></td>
                                        </tr>
                                        <tr>
                                            <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[3]->area_1; ?>" name="area1[]" id="area-41" class="dissolution-class1 dissdata area1" readonly tabindex=""/></td>
                                            <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[3]->area_2; ?>" name="area2[]" id="area-42" class="dissolution-class1 dissdata area2" readonly tabindex=""/></td>
                                            <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[3]->area_3; ?>" name="area3[]" id="area-43" class="dissolution-class1 dissdata area3" readonly tabindex=""/></td>
                                            <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[3]->area_4; ?>" name="area4[]" id="area-44" class="dissolution-class1 dissdata area4" readonly tabindex=""/></td>
                                            <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[3]->area_5; ?>" name="area5[]" id="area-45" class="dissolution-class1 dissdata area5" readonly tabindex=""/></td>
                                        </tr>
                                        <tr class="tg-even">
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[4]->area_1; ?>" name="area1[]" id="area-51" class="dissolution-class1 dissdata area1" readonly tabindex=""/></td>
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[4]->area_2; ?>" name="area2[]" id="area-52" class="dissolution-class1 dissdata area2" readonly tabindex=""/></td>
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[4]->area_3; ?>" name="area3[]" id="area-53" class="dissolution-class1 dissdata area3" readonly tabindex=""/></td>
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[4]->area_4; ?>" name="area4[]" id="area-54" class="dissolution-class1 dissdata area4" readonly tabindex=""/></td>
                                            <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[4]->area_5; ?>" name="area5[]" id="area-55" class="dissolution-class1 dissdata area5" readonly tabindex=""/></td>
                                        </tr>
                                        <tr>
                                            <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[5]->area_1; ?>" name="area1[]" id="area-61" class="dissolution-class1 dissdata area1" readonly tabindex=""/></td>
                                            <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[5]->area_2; ?>" name="area2[]" id="area-62" class="dissolution-class1 dissdata area2" readonly tabindex=""/></td>
                                            <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[5]->area_3; ?>" name="area3[]" id="area-63" class="dissolution-class1 dissdata area3" readonly tabindex=""/></td>
                                            <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[5]->area_4; ?>" name="area4[]" id="area-64" class="dissolution-class1 dissdata area4" readonly tabindex=""/></td>
                                            <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[5]->area_5; ?>" name="area5[]" id="area-65" class="dissolution-class1 dissdata area5" readonly tabindex=""/></td>
                                        </tr>
                                    </table>
                                </div>

                                </div>

                                <div id="level1">
                                    <center><h3><u>3. Subsequent Dillution</u></h3></center></p>
                                    <div id="subsequent">
                                        <table id="assay">


                                            <tr id="test1">
                                                <td>&nbsp;</td>

                                                <td>LC (mg)</td>
                                                <td><span>Vol. Used</span></td>
                                                <td><span>P1</span></td>
                                                <td><span>Vf</span></td>
                                                <td>P2</td>
                                                <td>Vf2</td>
                                                <td>P3</td>
                                                <td>Vf3</td>
                                                <td>P4</td>
                                                <td>Vf4</td>
                                                <td><span>Conc.</span></td>
                                            </tr>


                                            <!--=======================SUBSEQUENT  DISSOLUTIONS AFTER DISSOLUTIONS===============================-->	
                                            <?php
                                            foreach ($subsequent as $sd)
                                                foreach ($stage_2_subsequent as $sd2)
                                                    ;
                                            ?>
                                            <tr>
                                                <td class="workingweight" ><strong>Desired Concetration</strong></td>
                                                <td class="labelclaim" ><input type="text" value="<?php echo $sd->label_claim; ?>" name="labelclaim" placeholder="e.g 20mg"  id="labelclaim" required /></td>
                                                <td class ="vf1" >
                                                    <input type="text" name="vu" value="<?php echo $sd->volume_used; ?>" placeholder="e.g 20mg" value="" id="vu2" readonly />
                                                </td>
                                                <td class="workingp1" >
                                                    <input name="workingp1" value="<?php echo $sd->pipette; ?>" id="workingp13" class="s1"  required />
                                                </td>
                                                <td class="workingv1">
                                                    <input name="workingv"value="<?php echo $sd->volume; ?>"  id="workingp13" class="s1"  required />
                                                </td>
                                                <td class="workingp1" >
                                                    <input name="workingp2" value="<?php echo $sd->pipette2; ?>" id="workingp13" class="s1"  required />
                                                </td>
                                                <td class="workingv1">
                                                    <input name="workingv2"value="<?php echo $sd->volume2; ?>"  id="workingp13" class="s1"  required />
                                                </td>
                                                <td class="workingp1" >
                                                    <input name="workingp3" value="<?php echo $sd->pipette3; ?>" id="workingp13" class="s1"  required />
                                                </td>
                                                <td class="workingv1">
                                                    <input name="workingv3"value="<?php echo $sd->volume3; ?>"  id="workingp13" class="s1"  required />
                                                </td>
                                                <td class="workingp1" >
                                                    <input name="workingp4" value="<?php echo $sd->pipette4; ?>" id="workingp13" class="s1"  required />
                                                </td>
                                                <td class="workingv1">
                                                    <input name="workingv4"value="<?php echo $sd->volume4; ?>"  id="workingp13" class="s1"  required />
                                                </td>
                                                <td class="conc" ><input type="text" value="<?php echo $sd->concetration; ?>" name="conc" placeholder="e.g 20mg" value="" id="conc" readonly /></td>                   
                                            </tr>

                                            <tr id="stage-2">
                                                <td class="workingweight" ><strong>Desired. Conc.</strong></td>
                                                <td class="labelclaim" ><input type="text" name="labelclaim1" placeholder="e.g 20mg" value="<?php echo $sd2->volume_used; ?>" id="labelclaim1" readonly /></td>
                                                <td class ="vf1" >
                                                    <input type="text" name="vu2" value="<?php echo $sd2->volume_used; ?>" placeholder="e.g 20mg" id="vu" readonly />
                                                </td>
                                                <td class="workingp1" >
                                                    <input name="workingp1_2" value="<?php echo $sd2->pipette; ?>" id="workingp13" class="s1"  required />
                                                </td>
                                                <td class="workingv1">
                                                    <input name="workingv_2"value="<?php echo $sd->volume; ?>"  id="workingp13" class="s1"  required />
                                                </td>
                                                <td class="workingp1" >
                                                    <input name="workingp2_2" value="<?php echo $sd2->pipette2; ?>" id="workingp13" class="s1"  required />
                                                </td>
                                                <td class="workingv1">
                                                    <input name="workingv2_2"value="<?php echo $sd2->volume2; ?>"  id="workingp13" class="s1"  required />
                                                </td>
                                                <td class="workingp1" >
                                                    <input name="workingp3_2" value="<?php echo $sd2->pipette3; ?>" id="workingp13" class="s1"  required />
                                                </td>
                                                <td class="workingv1">
                                                    <input name="workingv3_2"value="<?php echo $sd2->volume3; ?>"  id="workingp13" class="s1"  required />
                                                </td>
                                                <td class="workingp1" >
                                                    <input name="workingp4_2" value="<?php echo $sd2->pipette4; ?>" id="workingp13" class="s1"  required />
                                                </td>

                                                <td class="workingv1">
                                                    <input name="workingv4_2"value="<?php echo $sd2->volume4; ?>"  id="workingp13" class="s1"  required />
                                                </td>
                                                <td class="conc" ><input type="text" value="<?php echo $sd2->concetration; ?>" name="conc_2" placeholder="e.g 20mg" value="" id="conc" readonly /></td>                   
                                            </tr>

                                        </table>
                                    </div>
                                </div>



                                <div id="level2">
                                    <div id="sample"> 

                                        <div class="refsub1" style="position:absolute; margin-left: 870px;">
                                            <label class="rf">AREAS / ABSORBANCE</label><br>
                                                <table class="tg-table-light">
                                                    <tr>
                                                        <th></th>
                                                    </tr>
                                                    <tr class="tg-even">
                                                        <td> A &dArr;</td>
                                                        <td ></td>

                                                    </tr>
                                                    <tr class="tg-even">
                                                        <td class="mgml1"><input type="text" value="<?php echo $pareas[0]->peak_area; ?>" name="speak[]" placeholder="965852" value="" id="speaka1" readonly  class="areas" /></td>

                                                    </tr>
                                                    <tr>
                                                        <td class="mgml1"><input type="text" value="<?php echo $pareas[1]->peak_area; ?>" name="speak[]" placeholder="965852" value="" id="speaka2" readonly  class="areas" /></td>

                                                    </tr>
                                                    <tr class="tg-even">
                                                        <td class="mgml1"><input type="text" value="<?php echo $pareas[2]->peak_area; ?>" name="speak[]" placeholder="965852" value="" id="speaka3" readonly class="areas"  /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>B &dArr;</td>
                                                        <td ></td>
                                                    </tr>
                                                    <tr class="tg-even">
                                                        <td class="mgml1"><input type="text" value="<?php echo $pareas[3]->peak_area; ?>" name="speak[]" placeholder="965852" value="" id="speakb1" readonly class="areas"  /></td>
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                        <td class="mgml1"><input type="text" value="<?php echo $pareas[4]->peak_area; ?>" name="speak[]" placeholder="965852" value="" id="speakab2" readonly  class="areas" /></td>
                                                    </tr>
                                                    <tr class="tg-even">
                                                        <td class="mgml1"><input type="text" value="<?php echo $pareas[5]->peak_area; ?>" name="speak[]" placeholder="965852" value="" id="speaka3" readonly  class="areas" /></td>
                                                    </tr>

                                                </table>
                                        </div>

                                        <p><center><h3><u>4. Standards</u></h3></center></p>


                                        <table id="assay">               

                                            <tr id="test">
                                                <td><span>Wt. (mg)</span></td>
                                                <td><span>Vf1</span></td>
                                                <td><span>P1</span></td>
                                                <td><span>Vf2</span></td>
                                                <td><span>P2</span></td>
                                                <td><span>Vf3</span></td>
                                                <td><span>P3</span></td>
                                                <td><span>Vf4</span></td>
                                                <td><span>Concentration</span></td>

                                            </tr>


                                            <!--========================SAMPLE PREPARATION FOR DISSOLUTIONS==============================-->	

                                            <tr>
                                                <td class="workingweight" ><strong>Desired Wt. (mg)</strong></td>
                                                <td class="workingweight" ><input type="text" value="<?php echo $diss_std_prep[0]->weight; ?>" name="workingweight" placeholder="e.g 20mg" value="" id="workingweight" readonly/></td>

                                                <td class="workingvf1" >                          
                                                    <input name="workingvf1" value="<?php echo $diss_std_prep[0]->vf1; ?>"  id="workingvf1" required class="s1"/>

                                                </td>


                                                <td class="workingpipette1" >
                                                    <input name="workingp11" value="<?php echo $diss_std_prep[0]->pipette1; ?>" id="workingp11"  required  class="s1"/>

                                                </td>
                                                <td class="workingvf2">
                                                    <input name="workingvf2" value="<?php echo $diss_std_prep[0]->vf2; ?>"id="workingp11"  required  class="s1"/>
                                                </td>
                                                <td class="workingpipette2" >
                                                    <input name="workingvp12" value="<?php echo $diss_std_prep[0]->pipette2; ?>" id="workingp11"  required  class="s1"/>
                                                </td>
                                                <td class="workingvf3">
                                                    <input name="workingvf3" value="<?php echo $diss_std_prep[0]->vf3; ?>" id="workingp11"  required  class="s1"/>
                                                </td>

                                                <td class="workingpipette2" >
                                                    <input name="workingp13" value="<?php echo $diss_std_prep[0]->pipette3; ?>" id="workingp13" class="s1"  required />


                                                </td>
                                                <td class="workingvf4">
                                                    <input name="workingvf4" value="<?php echo $diss_std_prep[0]->vf4; ?>" id="workingp11"  required  class="s1"/>
                                                </td>

                                                <td class="mgml11"><input type="text" value="<?php echo $diss_std_prep[0]->concetration; ?>" name="workingmgml" placeholder="e.g 0.04mg/ml" id ="workingmgml1" readonly  /></td>
                                            </tr>


                                            <!----================================================================================================================-->


                                            <tr>
                                                <td colspan="8" class="weight" width="10" >&nbsp;</td>
                                            </tr>
                                            <tr>

                                                <td ><strong>Standard A</strong></td>
                                                <td><input type="text" value="<?php echo $diss_std_prep[1]->weight; ?>" name="u_weightA"  id="number"  value="<?php //echo $assayweight['0']->weight;      ?>" class="stdabc"/></td>
                                                <td >
                                                    <input type="text" value="<?php echo $diss_std_prep[1]->vf1; ?>" name="v11" id="v11" readonly/>
                                                </td>
                                                <td >
                                                    <input type="text" value="<?php echo $diss_std_prep[1]->pipette1; ?>" name="standardp1" id="standardp1"  class="s1" readonly/>

                                                </td>
                                                <td>
                                                    <input type="text" value="<?php echo $diss_std_prep[1]->vf2; ?>" name="standardvf" id="standardvf" class="s1" readonly/>

                                                </td>
                                                <td >
                                                    <input type="text" value="<?php echo $diss_std_prep[1]->pipette2; ?>" name="p20" id="p20" class="s1" readonly/>

                                                </td>
                                                <td>
                                                    <input type="text" value="<?php echo $diss_std_prep[1]->vf3; ?>" name="vf3" id="vf3"  class="s1"readonly/>

                                                </td>

                                                <td>
                                                    <input type="text" name="p211" value="<?php echo $diss_std_prep[1]->pipette3; ?>" id="p211"  class="s1" readonly/>

                                                </td>
                                                <td>
                                                    <input type="text" value="<?php echo $diss_std_prep[1]->vf4; ?>" name="vf4" id="vf4"  class="s1" readonly/>

                                                </td>

                                                <td><input type="text" value="<?php echo $diss_std_prep[1]->concetration; ?>" name="dmgml" placeholder="e.g 0.04mg/ml" id ="dmgml" value="" required readonly /></td>
                                            </tr>

                                            <tr>
                                                <td class="weight" ><strong>Standard B</strong></td>
                                                <td class="weight" ><input type="text" name="u_weightB" value="<?php echo $diss_std_prep[2]->weight; ?>" id ="number1" class="stdabc" /></td>
                                                <td class ="vf111" ><input type="text"  id="v2" value="<?php echo $diss_std_prep[2]->vf1; ?>" name="v2" size="15"/></td>
                                                <td class="pipette11111" ><input type="text" id="standardp2" value="<?php echo $diss_std_prep[2]->pipette1; ?>" name="standardp2" class="s1" size="15" readonly/></td>
                                                <td class="vf22222">
                                                    <input type="text" required id="standardvf1" value="<?php echo $diss_std_prep[2]->vf2; ?>" name="standardvf1" class="s1" size="15" readonly/> 
                                                </td>

                                                <td class="pipette21" >
                                                    <input type="text" id="p21" value="<?php echo $diss_std_prep[2]->pipette2; ?>" name="p21" size="15"  class="s1"readonly/> 
                                                </td>
                                                <td class="vf23">
                                                    <input type="text" required value="<?php echo $diss_std_prep[2]->vf3; ?>" id="vf23" name="vf23" size="15" class="s1" readonly/> 
                                                </td>

                                                <td class="pipette21" >
                                                    <input type="text" value="<?php echo $diss_std_prep[2]->pipette3; ?>" id="p22" name="p22" size="15" class="s1" readonly/> 
                                                </td>
                                                <td class="vf23">
                                                    <input type="text" value="<?php echo $diss_std_prep[2]->vf4; ?>" required id="vf24" name="vf24" size="15" class="s1" readonly/> 
                                                </td>

                                                <td class="mgml1"><input type="text" value="<?php echo $diss_std_prep[2]->concetration; ?>" name="dmgml1" placeholder="e.g 0.04mg/ml" value="" id="dmgml1" required readonly /></td>
                                            </tr>



                                        </table>

                                    </div>

                                </div>
                       <input type="hidden" value="<?php echo $component_name[0]->component; ?>" name="active_ing_head"/>
            <input type="hidden" name="" id="component_no" value="<?php echo $diss_tabs[0]->component_no; ?>"



                                <p><input id="submit_result" style="background-color: #33ff33;color: #ffffff; width: 100px; height: 30px;" value="Submit Result"/></p>


                                </form>


                                </body>

                                <script>
                                    $(document).ready(function() {

                                        var nda = 'No Value';
                                        // $("input[value='0']").val(nda);
                                        // $("input:not(apparatus)[value='1']").val(nda);
                                        $("input[value='0']").css("color", "white");
                                        //$("input[value='1']").css("color", "white");
                                        $("input[value='0']").attr("disabled", "disabled");
                                        //$("input[value='1']").attr("disabled", "disabled");
                                        $("input").attr("readonly", "readonly");

                                        $('input[type=text],input[type=number],textarea').attr("readonly", "readonly");

                                        $('#submit_result').prop('value', 'Submit Results');

                                    });

                                </script>
                                <script type="text/javascript">
                                    $(document).ready(function() {

                                        $('#submit_result').click(function() {
                                            dataString2 = $('#capsUni').serialize();
                                            $.ajax({
                                                type: "POST",
                                                url: "<?php echo base_url(); ?>wkstest/sendDissolutionDataToExcel_t/<?php echo $labrefuri; ?>/" + $('#component_no').val(),
                                                data: dataString2,
                                                success: function() {
                                                    alert('Data exported successfully');
                                                },
                                                error: function() {
                                                    alert('An error occured');
                                                }
                                            })
                                        });
                                    });
                                </script>
                                </html>


