<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MY_Printer extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('excel');
        $this->load->library('dompdf_lib');
        $this->load->library('pdf');
        $this->load->library('fpdf_l');
        $this->load->helper('file');
    }

   
    function printClients() {
   $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("clients_templates/clients_template.xlsx");
          $objPHPExcel->getActiveSheet(0);
          $objPageSetup = new PHPExcel_Worksheet_PageSetup();
          $objPageSetup->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
          $objPageSetup->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
          //$objPageSetup->setPrintArea("E5:H7");
          $objPageSetup->setFitToWidth(1);
          $objPHPExcel->getActiveSheet()->setPageSetup($objPageSetup);

          $signatories = $this->getSignatories();

          $worksheet = $objPHPExcel->getActiveSheet();
          $styleArray = array(
          'borders' => array(
          'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN
          )
          )
          );

          $worksheet->getStyle('A1:G3')->getBorders()->getAllBorders()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_WHITE));

          $row2 = 6;
          $i = 1;
          foreach ($signatories as $signatures):
          $col = 0;
          $worksheet
          //->setCellValueByColumnAndRow($col++, $row2, $i)
          ->setCellValueByColumnAndRow($col++, $row2, $signatures->name)
          ->setCellValueByColumnAndRow($col++, $row2, $signatures->email)
          ->setCellValueByColumnAndRow($col++, $row2, $signatures->address)
          ->setCellValueByColumnAndRow($col++, $row2, $signatures->client_type)
          ->setCellValueByColumnAndRow($col++, $row2, $signatures->contact_person)
          ->setCellValueByColumnAndRow($col++, $row2, $signatures->contact_phone)
          ->setCellValueByColumnAndRow($col++, $row2, $signatures->discount_percentage);


          $worksheet->getStyle('A' . $row2 . ":G" . $row2)->applyFromArray($styleArray);

          $worksheet->getStyle('A' . $row2 . ":G" . $row2)->getAlignment()->setWrapText(true);
          $i++;
          $row2++;

          endforeach;
          PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);
          $worksheet->getDefaultColumnDimension('A')->setWidth(10);
          $worksheet->getDefaultColumnDimension('B')->setWidth(5);
          $worksheet->getDefaultColumnDimension('C')->setWidth(5);
          $worksheet->getDefaultColumnDimension('D')->setWidth(1);
          $worksheet->getDefaultColumnDimension('E')->setWidth(5);
          $worksheet->getDefaultColumnDimension('F')->setWidth(5);
          $worksheet->getDefaultColumnDimension('G')->setWidth(5);

          $objDrawing = new PHPExcel_Worksheet_Drawing();
          $objDrawing->setWorksheet($worksheet);
          $objDrawing->setPath('images/nqcl_logo_full.png');
          $objDrawing->setCoordinates('A1');
          $worksheet->mergeCells('A1:G5');
          $objDrawing->setOffsetX(1);
          $objDrawing->setOffsetY(5);

          $style = array(
          'alignment' => array(
          'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
          )
          );
          $titles = array(
          'font'  => array(
          'bold'  => true,
          //'color' => array('rgb' => 'FF0000'),
          'size'  => 8,
          'name'  => 'Calibri'
          ));
          $worksheet->getStyle('A6:G6')->applyFromArray($titles);
          $worksheet->getStyle('A6:G6')->applyFromArray($style);
          $worksheet->getStyle('A1:G4')->applyFromArray($style);
          $worksheet->setCellValue('A6', 'No. ')
          ->setCellValue('A6', 'NAME ')
          ->setCellValue('B6', 'EMAIL ')
          ->setCellValue('C6', 'PHYSICAL ADDRESS ')
          ->setCellValue('D6', 'TYPE')
          ->setCellValue('E6', 'CONTACT PERSON ')
          ->setCellValue('F6', 'CONTACT PHONE ')
          ->setCellValue('G6', 'DISCOUNT ');


          $objPHPExcel->getActiveSheet()->setTitle(date('d-m-Y'));
          //$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
          //unlink('clients_templates/' . "clients.xlsx");
          //$objWriter->save("clients_templates/". "clients.xlsx");
          // Set active sheet index to the first sheet, so Excel opens this as the first sheet
          $objPHPExcel->setActiveSheetIndex(0);

          $objWriter1 = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
          $objWriter1->save('clients_templates/clients.xlsx');
          echo 'Data exported';
          exit;
          }

          function getSignatories() {
          return $this->db->get('clients')->result();
          /* if ($status == 'Expired') {
          return $this->db->where('status', $status)->get('refsubs')->result();
          } else {
          return $this->db->where('standard_type', $status)->get('refsubs')->result();
          }
          } */
    }

    function print_Columns() {

        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("clients_templates/column_template.xlsx");
        $objPHPExcel->getActiveSheet(0);
        $objPageSetup = new PHPExcel_Worksheet_PageSetup();
        $objPageSetup->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPageSetup->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        //$objPageSetup->setPrintArea("E5:H7");
        $objPageSetup->setFitToWidth(1);
        $objPHPExcel->getActiveSheet()->setPageSetup($objPageSetup);

        $signatories = $this->getSignatories1();

        $worksheet = $objPHPExcel->getActiveSheet();
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $row2 = 4;

        foreach ($signatories as $signatures):
            $col = 0;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->column_type)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->serial_no)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->manufacturer)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->column_no)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->column_dimension)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->date_received)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->date_of_expiry);

            $worksheet->getStyle('A' . $row2 . ":G" . $row2)->applyFromArray($styleArray);

            $worksheet->getStyle('A' . $row2 . ":G" . $row2)->getAlignment()->setWrapText(true);
            $row2++;
        endforeach;


        $objPHPExcel->getActiveSheet()->setTitle(date('d-m-Y'));
        //$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //unlink('clients_templates/' . "clients.xlsx");
        //$objWriter->save("clients_templates/". "clients.xlsx");
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter1 = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter1->save('clients_templates/columns.xlsx');
        echo 'Data exported';
        exit;
    }

    function getSignatories1() {
        return $this->db->get('columns')->result();
        /* if ($status == 'Expired') {
          return $this->db->where('status', $status)->get('refsubs')->result();
          } else {
          return $this->db->where('standard_type', $status)->get('refsubs')->result();
          }
          } */
    }

    function print_Standards() {

        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("clients_templates/standards_template.xlsx");
        $objPHPExcel->getActiveSheet(0);
        $objPageSetup = new PHPExcel_Worksheet_PageSetup();
        $objPageSetup->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPageSetup->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        //$objPageSetup->setPrintArea("E5:H7");
        $objPageSetup->setFitToWidth(1);
        $objPHPExcel->getActiveSheet()->setPageSetup($objPageSetup);

        $signatories = $this->getStandards();

        $worksheet = $objPHPExcel->getActiveSheet();
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $worksheet->setCellValue('A2', 'NQCL ' . ' STANDARDS LIST');
        $row2 = 4;

        foreach ($signatories as $signatures):
            $col = 0;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->name)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->source)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->batch_no)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->rs_code)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->potency . $signatures->potency_unit)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->init_mass . $signatures->init_mass_unit)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->status)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->application)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->standard_type)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->date_of_expiry);

            $worksheet->getStyle('A' . $row2 . ":J" . $row2)->applyFromArray($styleArray);

            $worksheet->getStyle('A' . $row2 . ":J" . $row2)->getAlignment()->setWrapText(true);
            $row2++;
        endforeach;


        $objPHPExcel->getActiveSheet()->setTitle(date('d-m-Y'));
        //$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //unlink('clients_templates/' . "clients.xlsx");
        //$objWriter->save("clients_templates/". "clients.xlsx");
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter1 = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter1->save('clients_templates/standards.xlsx');
        echo 'Data exported';
        exit;
    }

    function getStandards() {
        return $this->db->get('refsubs')->result();
        /* if ($status == 'Expired') {
          return $this->db->where('status', $status)->get('refsubs')->result();
          } else {
          return $this->db->where('standard_type', $status)->get('refsubs')->result();
          }
          } */
    }

    function print_request() {


        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("clients_templates/sample_template.xlsx");
        $objPHPExcel->getActiveSheet(0);
        $signatories = $this->getSamples();

        $worksheet = $objPHPExcel->getActiveSheet();

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $row2 = 2;

        foreach ($signatories as $signatures):
            $col = 0;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->request_id)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->name)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->product_name)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->active_ing)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->designation_date)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->manufacturer_name)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->batch_no)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->exp_date);


            $worksheet->getStyle('A' . $row2 . ":H" . $row2)->applyFromArray($styleArray);

            $worksheet->getStyle('A' . $row2 . ":H" . $row2)->getAlignment()->setWrapText(true);

            $row2++;
        endforeach;

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->setTitle(date('d-m-Y'));

        $objWriter1 = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter1->save('clients_templates/requests.xlsx');
        echo 'Data exported';
        exit;
    }

    function getSamples() {
        return $this->db->query('SELECT r.request_id, r.product_name,r.active_ing,r.designation_date,r.manufacturer_name,r.exp_date,r.batch_no, c.name FROM request r, clients c WHERE r.client_id = c.id ORDER BY r.request_id LIMIT 10')->result();
    }

}
