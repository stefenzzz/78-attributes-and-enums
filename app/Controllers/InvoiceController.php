<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\{View};
use App\Services\InvoiceService;
use App\Attributes\Get;
use App\Enums\InvoiceStatus;
use App\Models\Invoice;

class InvoiceController
{

    public function __construct(
        private InvoiceService $invoiceService,
        private Invoice $invoice,
    )
    {

    }

    #[Get('/invoice')]
    public function index(): View
    {   
        
        
        $this->invoiceService->process([],25);
        return View::make('index');
    }

    #[Get('/invoice/all')]
    public function getAll(){


        $invoices = $this->invoice->all(InvoiceStatus::Paid);

        return View::make('invoices/index',['invoices' => $invoices]);
    
    }



}