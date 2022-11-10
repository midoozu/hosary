<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Rawilk\Printing\Facades\Printing;

class PrintController extends Controller
{
    public function print(){

        $printers = Printing::printers();

        foreach ($printers as $printer) {
            echo $printer->name();
        }

        $printerId =    Printing::defaultPrinterId();

        dd($printerId);

      $printJob = Printing::newPrintTask()
            ->printer($printerId)
            ->file('path_to_file.pdf')
            ->send();

        $printJob->id(); // the id number returned from
    }
}
