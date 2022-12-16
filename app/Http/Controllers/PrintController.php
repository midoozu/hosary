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



//        $printers = Printing::printers();
//
//        foreach ($printers as $printer) {
//            echo $printer->name();
//        }
//
//        $printerId = Printing::defaultPrinterId();
//
//      $printJob = Printing::newPrintTask()
//            ->printer($printerId)
//            ->file('path_to_file.pdf')
//            ->send();
//
//        $printJob->id(); // the id number returned from

        $customer = new Buyer([
            'name'          => 'John Doe',
            'custom_fields' => [
                'email' => 'test@example.com',
            ],
        ]);

        $item = (new InvoiceItem())->title('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->discountByPercent(10)
            ->taxRate(15)
            ->shipping(1.99)
            ->addItem($item);

        return $invoice->stream();
    }
}
