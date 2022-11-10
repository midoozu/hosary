<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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

        $printerId =    Printing::defaultPrinter();

    dd($printerId);

        $printJob = Printing::newPrintTask()
            ->printer($printerId)
            ->file('resource/invoices/templates/default.blade.php')
            ->send();

        $printJob->id();
    }
}
