<?php

namespace App\Helpers;



use PhpOffice\PhpSpreadsheet\Style\Fill;

class SetCell{
    public static function setColorCell($color){
        return ['fill' => [
            'fillType' =>  fill::FILL_SOLID,
            'startColor' => [
                'rgb' => $color
            ]
        ],];
    }

    public static function fontBOLD(){
        return ['font' => [
            'bold' => true,
        ]];
    }

    public static function setColorBlue($color){
        return ['fill' => [
            'fillType' =>  fill::FILL_SOLID,
            'startColor' => [
                'rgb' => $color
            ]
        ],];
    }
    public static function setColorGrey($color){
        return ['fill' => [
            'fillType' =>  fill::FILL_SOLID,
            'startColor' => [
                'rgb' => $color
            ]
        ],];
    }

    public static function setFont($font){
        return ['font' => [
            'name' => $font,
        ],];
    }

    public static function setBorderAll(){
        return ['borders' => array(
            'allBorders' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => array('argb' => '000000'),
            ),
        ),];
    }
    public static function setBorderSizeThin(){
        return ['borders' => array(
            'allBorders' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ),
        ),];
    }

    public static function setBorderSizeMedium(){
        return ['borders' => array(
            'allBorders' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
            ),
        ),];
    }

    public static function setTextCenter(){
        return ['alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        ],];
    }


}