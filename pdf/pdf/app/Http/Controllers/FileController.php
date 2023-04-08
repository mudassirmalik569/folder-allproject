<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Smalot\PdfParser\Parser;
use Smalot\PdfParser\Encoding\WinAnsiEncoding\Font;
use COMMAND;
// use App\Models\File;
// use setasign\Fpdi\Fpdi;
use Str;
class FileController extends Controller
{
    public function index(){
        return view('index');
    }
    public function store(Request $request){
        $file = $request->file;
        $config = new \Smalot\PdfParser\Config();
        $config->setHorizontalOffset(''); 
        $parser = new \Smalot\PdfParser\Parser([], $config);
        $pdf = $parser->parseFile($file);
        $text = $pdf->getText();
        //echo $text;
        //$text =strtolower($text);
        echo "PO Number: ";
        $wo_date = $this->get_string_between($text,"PO Number:","NTE");
        echo $wo_date;
        echo "<br>NTE: ";
        echo $wo_date = $this->get_string_between($text,"NTE Amt:","Property:");
        echo "<br>Date: ";
        echo $wo_date = $this->get_string_between($text,"ETA","If this ETA");
        echo "<br>Address: ";
        echo $wo_date = $this->get_string_between($text,"Property:","Divisions");
        echo "<br>Divisions Contact: ";
        echo $wo_date = $this->get_string_between($text,"Divisions Contact:","Purchase Order");
        echo "<br>Scope of Work: ";
        echo $wo_date = $this->get_string_between($text,"Scope of Work","On-Site Activity");
        echo "<br>The store address is: ";
        echo $wo_date = $this->get_string_between($text,"The store address is:","Activity Requirements");
        
        

        
     
    }
    public function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

}
