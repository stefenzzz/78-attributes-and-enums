<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\{View, App, Container};
use App\Services\InvoiceService;
use App\Attributes\Get;
use App\Attributes\Post;

// use PDO;
// use App\Models\{User,Invoice,SignUp};

class HomeController
{
    
    
    public function __construct()
    {

    }
    #[Get('/')]
    #[Post(routePath: '/home')]
    public function index():View
    {   
      
        return View::make('index');
    }
}