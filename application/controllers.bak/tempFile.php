 function postRepeats($labref) {
        $component_no = $this->uri->segment(5);
        $head=  $this->input->post('head');
        if ($this->checkPostingSummary($labref, $head)==1 && ($component_no == '1')) {
            
           

                $data = $this->getLastWorksheet();
                echo $worksheetIndex = $data[0]->no_of_sheets;
                //standard Assay
                $assayDesired = $this->input->post('assayDesired');
                $stdA = $this->input->post('standardA');
                $stdB = $this->input->post('standardB');
                $dconcetration = $this->input->post('dconcetration');

                //sample preparation, powder Weight
                $samplDesiredpw = $this->input->post('sampleDesiredpw');
                $sastandarda = $this->input->post('sastandarda');
                $sastandardb = $this->input->post('sastandardb');
                $sastandardc = $this->input->post('sastandardc');

                //sample API weight
                $samplDesiredap = $this->input->post('sampleDesiredap');
                $apstandarda = $this->input->post('apstandarda');
                $apstandardb = $this->input->post('apstandardb');
                $apstandardc = $this->input->post('apstandardc');
                $sampleconcetration = $this->input->post('sampleconcetration');
                //Uniformity of weight
                $tabscapsaverage = $this->input->post('tabcapssaverage');
                // $capsaverage = $this->input->post('capsaverage');
                //tab and cap status
                // $tabstatus = $this->input->post('tabstatus');
                // $capstatus= $this->input->post('capstatus');
                //Dissolution Tabs
                $tab1 = $this->input->post('tab1');
                $tab2 = $this->input->post('tab2');
                $tab3 = $this->input->post('tab3');
                $tab4 = $this->input->post('tab4');
                $tab5 = $this->input->post('tab5');
                $tab6 = $this->input->post('tab6');

                //Dissolution Other Tests
                $desiredweight = $this->input->post('desiredweight');
                $disstda = $this->input->post('disstda');
                $disstdb = $this->input->post('disstdb');
                $concetration = $this->input->post('concetration');
                $tabaverage = $this->input->post('tabaverage');

                $head = $this->input->post('head');

                $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");


                echo 'Worksheet loaded';
                $NewWorksheetIndex = $worksheetIndex * 0;
                $objPHPExcel->setActiveSheetIndex($NewWorksheetIndex);
                $objPHPExcel->getActiveSheet()


                        //Sample and Standard Assay Information
                        ->setCellValue('D49', $stdA)
                        ->setCellValue('D50', $stdB)
                        ->setCellValue('D51', $assayDesired)
                        ->setCellValue('D52', $dconcetration)
                        ->setCellValue('F90', $samplDesiredpw)
                        ->setCellValue('F91', $samplDesiredap)
                        ->setCellValue('F82', $sastandarda)
                        ->setCellValue('F83', $sastandardb)
                        ->setCellValue('F84', $sastandardc)
                        ->setCellValue('F86', $apstandarda)
                        ->setCellValue('F87', $apstandardb)
                        ->setCellValue('F88', $apstandardc)
                        ->setCellValue('G81', $sampleconcetration)
                        //Dissolution
                        ->setCellValue('B65', $head)
                        ->setCellValue('B66', $tab1)
                        ->setCellValue('B67', $tab2)
                        ->setCellValue('B68', $tab3)
                        ->setCellValue('B69', $tab4)
                        ->setCellValue('B70', $tab5)
                        ->setCellValue('B71', $tab6)

                        //Other Dssolution Data     
                        ->setCellValue('B106', $head)
                        ->setCellValue('C107', $desiredweight)
                        ->setCellValue('C108', $disstda)
                        ->setCellValue('C109', $disstdb)
                        ->setCellValue('C110', $concetration)
                        ->setCellValue('C111', $tabaverage);

                
            $speakr = $this->input->post('speak');
            $smpeakr = $this->input->post('smpeak');
            $speakdr = $this->input->post('speakd');
            
            $area_1r = $this->input->post('area1');
            $area_2r = $this->input->post('area2');
            $area_3r = $this->input->post('area3');
            $area_4r = $this->input->post('area4');
            $area_5r = $this->input->post('area5');
                
                     $worksheet = $objPHPExcel->getActiveSheet();    
                $row = 15;
            foreach ($speakr as $labels):
                $col = 8;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $labels);
                $row++;
            endforeach;

            $row2 = 41;
            foreach ($smpeakr as $labels):
                $col = 8;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row2 = 120;
            foreach ($speakdr as $labels):
                $col = 8;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row = 68;
            for ($i = 0; $i < count($area_1r); $i++) {
                $col = 12;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $area_1r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_2r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_3r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_4r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_5r[$i]);
                $row++;
            }




                $objPHPExcel->getActiveSheet()->setTitle("Sample Summary");

                $dir = "workbooks";

                if (is_dir($dir)) {

                  

                    //$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

                    //$objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                  
                   // $this->insertData($labref);


                    echo 'Data exported - success';
                } else {
                    echo 'Dir does not exist';
                }
            } elseif ($this->checkPostingSummary($labref, $head)==1 && $component_no == '2' ) {
                $labref = $this->uri->segment(3);
                $head = $this->input->post('head');

                //standard Assay
                $assayDesired = $this->input->post('assayDesired');
                $stdA = $this->input->post('standardA');
                $stdB = $this->input->post('standardB');
                $dconcetration = $this->input->post('dconcetration');

                //sample preparation, powder Weight
                $samplDesiredpw = $this->input->post('sampleDesiredpw');
                $sastandarda = $this->input->post('sastandarda');
                $sastandardb = $this->input->post('sastandardb');
                $sastandardc = $this->input->post('sastandardc');

                //sample API weight
                $samplDesiredap = $this->input->post('sampleDesiredap');
                $apstandarda = $this->input->post('apstandarda');
                $apstandardb = $this->input->post('apstandardb');
                $apstandardc = $this->input->post('apstandardc');
                $sampleconcetration = $this->input->post('sampleconcetration');


                $tab1 = $this->input->post('tab1');
                $tab2 = $this->input->post('tab2');
                $tab3 = $this->input->post('tab3');
                $tab4 = $this->input->post('tab4');
                $tab5 = $this->input->post('tab5');
                $tab6 = $this->input->post('tab6');

                //Dissolution Other Tests
                $desiredweight = $this->input->post('desiredweight');
                $disstda = $this->input->post('disstda');
                $disstdb = $this->input->post('disstdb');
                $concetration = $this->input->post('concetration');
                $tabaverage = $this->input->post('tabaverage');


                $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                        ->setCellValue('C53', 'Assay Standards  repeat- ' . $head)
                        ->setCellValue('E92', 'Sample Assay repeat - ' . $head)
                        ->setCellValue('D54', $assayDesired)
                        ->setCellValue('D55', $stdA)
                        ->setCellValue('D56', $stdB)
                        ->setCellValue('D57', $dconcetration)
                        ->setCellValue('F102', $samplDesiredpw)
                        ->setCellValue('F103', $samplDesiredap)
                        ->setCellValue('F94', $sastandarda)
                        ->setCellValue('F95', $sastandardb)
                        ->setCellValue('F96', $sastandardc)
                        ->setCellValue('F98', $apstandarda)
                        ->setCellValue('F99', $apstandardb)
                        ->setCellValue('F100', $apstandardc)
                        ->setCellValue('G93', $sampleconcetration)

                        //Dissolution
                        ->setCellValue('B73', $head)
                        ->setCellValue('B74', $tab1)
                        ->setCellValue('B75', $tab2)
                        ->setCellValue('B76', $tab3)
                        ->setCellValue('B77', $tab4)
                        ->setCellValue('B78', $tab5)
                        ->setCellValue('B79', $tab6)

                        //Other Dssolution Data 
                        ->setCellValue('C112', $head)
                        ->setCellValue('C114', $desiredweight)
                        ->setCellValue('C115', $disstda)
                        ->setCellValue('C116', $disstdb)
                        ->setCellValue('C117', $concetration)
                        ->setCellValue('C118', $tabaverage);
                
                $speakr = $this->input->post('speak');
            $smpeakr = $this->input->post('smpeak');
            $speakdr = $this->input->post('speakd');
            
            $area_1r = $this->input->post('area1');
            $area_2r = $this->input->post('area2');
            $area_3r = $this->input->post('area3');
            $area_4r = $this->input->post('area4');
            $area_5r = $this->input->post('area5');
            
                     $worksheet = $objPHPExcel->getActiveSheet();    
            
                $row = 15;
            foreach ($speakr as $labels):
                $col = 11;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $labels);
                $row++;
            endforeach;

            $row2 = 41;
            foreach ($smpeakr as $labels):
                $col = 11;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row2 = 120;
            foreach ($speakdr as $labels):
                $col = 11;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row = 78;
            for ($i = 0; $i < count($area_1r); $i++) {
                $col = 12;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $area_1r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_2r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_3r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_4r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_5r[$i]);
                $row++;
            }


                

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                echo 'exported';
            } elseif ($this->checkPostingSummary($labref, $head)==1 && $component_no == '3') {
                $labref = $this->uri->segment(3);
                $head = $this->input->post('head');

                //standard Assay
                $assayDesired = $this->input->post('assayDesired');
                $stdA = $this->input->post('standardA');
                $stdB = $this->input->post('standardB');
                $dconcetration = $this->input->post('dconcetration');

                //sample preparation, powder Weight
                $samplDesiredpw = $this->input->post('sampleDesiredpw');
                $sastandarda = $this->input->post('sastandarda');
                $sastandardb = $this->input->post('sastandardb');
                $sastandardc = $this->input->post('sastandardc');

                //sample API weight
                $samplDesiredap = $this->input->post('sampleDesiredap');
                $apstandarda = $this->input->post('apstandarda');
                $apstandardb = $this->input->post('apstandardb');
                $apstandardc = $this->input->post('apstandardc');
                $sampleconcetration = $this->input->post('sampleconcetration');


                $tab1 = $this->input->post('tab1');
                $tab2 = $this->input->post('tab2');
                $tab3 = $this->input->post('tab3');
                $tab4 = $this->input->post('tab4');
                $tab5 = $this->input->post('tab5');
                $tab6 = $this->input->post('tab6');

                //Dissolution Other Tests
                $desiredweight = $this->input->post('desiredweight');
                $disstda = $this->input->post('disstda');
                $disstdb = $this->input->post('disstdb');
                $concetration = $this->input->post('concetration');
                $tabaverage = $this->input->post('tabaverage');


                $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                        ->setCellValue('C53', 'Assay Standards repeat - ' . $head)
                        ->setCellValue('E104', 'Sample Assay repeat - ' . $head)
                        ->setCellValue('D61', $assayDesired)
                        ->setCellValue('D59', $stdA)
                        ->setCellValue('D60', $stdB)
                        ->setCellValue('D62', $dconcetration)
                        ->setCellValue('F114', $samplDesiredpw)
                        ->setCellValue('F115', $samplDesiredap)
                        ->setCellValue('F106', $sastandarda)
                        ->setCellValue('F107', $sastandardb)
                        ->setCellValue('F108', $sastandardc)
                        ->setCellValue('F110', $apstandarda)
                        ->setCellValue('F111', $apstandardb)
                        ->setCellValue('F112', $apstandardc)
                        ->setCellValue('G105', $sampleconcetration)

                        //Dissolution
                        ->setCellValue('B81', $head)
                        ->setCellValue('B82', $tab1)
                        ->setCellValue('B83', $tab2)
                        ->setCellValue('B84', $tab3)
                        ->setCellValue('B85', $tab4)
                        ->setCellValue('B86', $tab5)
                        ->setCellValue('B87', $tab6)

                        //Other Dssolution Data   
                        ->setCellValue('B119', $head)
                        ->setCellValue('C121', $desiredweight)
                        ->setCellValue('C122', $disstda)
                        ->setCellValue('C123', $disstdb)
                        ->setCellValue('C124', $concetration)
                        ->setCellValue('C125', $tabaverage);
                
                $speakr = $this->input->post('speak');
            $smpeakr = $this->input->post('smpeak');
            $speakdr = $this->input->post('speakd');
            
            $area_1r = $this->input->post('area1');
            $area_2r = $this->input->post('area2');
            $area_3r = $this->input->post('area3');
            $area_4r = $this->input->post('area4');
            $area_5r = $this->input->post('area5');
            
                     $worksheet = $objPHPExcel->getActiveSheet();    
                
                $row = 24;
            foreach ($speakr as $labels):
                $col = 11;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $labels);
                $row++;
            endforeach;

            $row2 = 53;
            foreach ($smpeakr as $labels):
                $col = 11;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row2 = 120;
            foreach ($speakdr as $labels):
                $col = 17;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row = 88;
            for ($i = 0; $i < count($area_1r); $i++) {
                $col = 12;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $area_1r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_2r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_3r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_4r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_5r[$i]);
                $row++;
            }



                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
            } elseif ($this->checkPostingSummary($labref, $head)==1 && $component_no == '4') {
                $labref = $this->uri->segment(3);
                $head = $this->input->post('head');

                //standard Assay
                $assayDesired = $this->input->post('assayDesired');
                $stdA = $this->input->post('standardA');
                $stdB = $this->input->post('standardB');
                $dconcetration = $this->input->post('dconcetration');

                //sample preparation, powder Weight
                $samplDesiredpw = $this->input->post('sampleDesiredpw');
                $sastandarda = $this->input->post('sastandarda');
                $sastandardb = $this->input->post('sastandardb');
                $sastandardc = $this->input->post('sastandardc');

                //sample API weight
                $samplDesiredap = $this->input->post('sampleDesiredap');
                $apstandarda = $this->input->post('apstandarda');
                $apstandardb = $this->input->post('apstandardb');
                $apstandardc = $this->input->post('apstandardc');
                $sampleconcetration = $this->input->post('sampleconcetration');


                $tab1 = $this->input->post('tab1');
                $tab2 = $this->input->post('tab2');
                $tab3 = $this->input->post('tab3');
                $tab4 = $this->input->post('tab4');
                $tab5 = $this->input->post('tab5');
                $tab6 = $this->input->post('tab6');

                //Dissolution Other Tests
                $desiredweight = $this->input->post('desiredweight');
                $disstda = $this->input->post('disstda');
                $disstdb = $this->input->post('disstdb');
                $concetration = $this->input->post('concetration');
                $tabaverage = $this->input->post('tabaverage');


                $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                        ->setCellValue('C63', 'Assay Standards repeat- ' . $head)
                        ->setCellValue('E116', 'Sample Assay repeat- ' . $head)
                        ->setCellValue('D66', $assayDesired)
                        ->setCellValue('D64', $stdA)
                        ->setCellValue('D65', $stdB)
                        ->setCellValue('D67', $dconcetration)
                        ->setCellValue('F126', $samplDesiredpw)
                        ->setCellValue('F127', $samplDesiredap)
                        ->setCellValue('F118', $sastandarda)
                        ->setCellValue('F119', $sastandardb)
                        ->setCellValue('F120', $sastandardc)
                        ->setCellValue('F122', $apstandarda)
                        ->setCellValue('F123', $apstandardb)
                        ->setCellValue('F124', $apstandardc)
                        ->setCellValue('G117', $sampleconcetration)

                        //Dissolution
                        ->setCellValue('B89', $head)
                        ->setCellValue('B91', $tab1)
                        ->setCellValue('B92', $tab2)
                        ->setCellValue('B93', $tab3)
                        ->setCellValue('B94', $tab4)
                        ->setCellValue('B95', $tab5)
                        ->setCellValue('B96', $tab6)

                        //Other Dssolution Data 
                        ->setCellValue('B126', $head)
                        ->setCellValue('C128', $desiredweight)
                        ->setCellValue('C129', $disstda)
                        ->setCellValue('C130', $disstdb)
                        ->setCellValue('C131', $concetration)
                        ->setCellValue('C132', $tabaverage);
                
                $speakr = $this->input->post('speak');
            $smpeakr = $this->input->post('smpeak');
            $speakdr = $this->input->post('speakd');
            
            $area_1r = $this->input->post('area1');
            $area_2r = $this->input->post('area2');
            $area_3r = $this->input->post('area3');
            $area_4r = $this->input->post('area4');
            $area_5r = $this->input->post('area5');
            
                     $worksheet = $objPHPExcel->getActiveSheet();    
                
                $row = 24;
            foreach ($speakr as $labels):
                $col = 14;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $labels);
                $row++;
            endforeach;

            $row2 = 53;
            foreach ($smpeakr as $labels):
                $col = 14;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row2 = 128;
            foreach ($speakdr as $labels):
                $col = 11;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row = 98;
            for ($i = 0; $i < count($area_1r); $i++) {
                $col = 15;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $area_1r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_2r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_3r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_4r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_5r[$i]);
                $row++;
            }



                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
            } elseif ($this->checkPostingSummary($labref, $head)==1 && $component_no == '5') {
                $labref = $this->uri->segment(3);
                $head = $this->input->post('head');

                //standard Assay
                $assayDesired = $this->input->post('assayDesired');
                $stdA = $this->input->post('standardA');
                $stdB = $this->input->post('standardB');
                $dconcetration = $this->input->post('dconcetration');

                //sample preparation, powder Weight
                $samplDesiredpw = $this->input->post('sampleDesiredpw');
                $sastandarda = $this->input->post('sastandarda');
                $sastandardb = $this->input->post('sastandardb');
                $sastandardc = $this->input->post('sastandardc');

                //sample API weight
                $samplDesiredap = $this->input->post('sampleDesiredap');
                $apstandarda = $this->input->post('apstandarda');
                $apstandardb = $this->input->post('apstandardb');
                $apstandardc = $this->input->post('apstandardc');
                $sampleconcetration = $this->input->post('sampleconcetration');


                $tab1 = $this->input->post('tab1');
                $tab2 = $this->input->post('tab2');
                $tab3 = $this->input->post('tab3');
                $tab4 = $this->input->post('tab4');
                $tab5 = $this->input->post('tab5');
                $tab6 = $this->input->post('tab6');

                //Dissolution Other Tests
                $desiredweight = $this->input->post('desiredweight');
                $disstda = $this->input->post('disstda');
                $disstdb = $this->input->post('disstdb');
                $concetration = $this->input->post('concetration');
                $tabaverage = $this->input->post('tabaverage');


                $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                        ->setCellValue('C68', 'Assay Standards repeat - ' . $head)
                        ->setCellValue('E128', 'Sample Assay repeat- ' . $head)
                        ->setCellValue('D71', $assayDesired)
                        ->setCellValue('D69', $stdA)
                        ->setCellValue('D70', $stdB)
                        ->setCellValue('D72', $dconcetration)
                        ->setCellValue('F138', $samplDesiredpw)
                        ->setCellValue('F139', $samplDesiredap)
                        ->setCellValue('F130', $sastandarda)
                        ->setCellValue('F131', $sastandardb)
                        ->setCellValue('F132', $sastandardc)
                        ->setCellValue('F134', $apstandarda)
                        ->setCellValue('F135', $apstandardb)
                        ->setCellValue('F136', $apstandardc)
                        ->setCellValue('G129', $sampleconcetration)

                        //Dissolution
                        ->setCellValue('B55', $head)
                        ->setCellValue('B98', $tab1)
                        ->setCellValue('B99', $tab2)
                        ->setCellValue('B90', $tab3)
                        ->setCellValue('B91', $tab4)
                        ->setCellValue('B92', $tab5)
                        ->setCellValue('B93', $tab6)

                        //Other Dssolution Data
                        ->setCellValue('B133', $head)
                        ->setCellValue('C135', $desiredweight)
                        ->setCellValue('C136', $disstda)
                        ->setCellValue('C137', $disstdb)
                        ->setCellValue('C138', $concetration)
                        ->setCellValue('C139', $tabaverage);
                
                $speakr = $this->input->post('speak');
            $smpeakr = $this->input->post('smpeak');
            $speakdr = $this->input->post('speakd');
            
            $area_1r = $this->input->post('area1');
            $area_2r = $this->input->post('area2');
            $area_3r = $this->input->post('area3');
            $area_4r = $this->input->post('area4');
            $area_5r = $this->input->post('area5');
            
                     $worksheet = $objPHPExcel->getActiveSheet();    
                
                $row = 32;
            foreach ($speakr as $labels):
                $col = 11;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $labels);
                $row++;
            endforeach;

            $row2 = 53;
            foreach ($smpeakr as $labels):
                $col = 17;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row2 = 128;
            foreach ($speakdr as $labels):
                $col = 14;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row = 108;
            for ($i = 0; $i < count($area_1r); $i++) {
                $col = 12;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $area_1r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_2r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_3r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_4r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_5r[$i]);
                $row++;
            }



                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
            }
         else {
            $this->getDataToExcel();
        }
    }