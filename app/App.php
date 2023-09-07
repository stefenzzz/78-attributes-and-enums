<?php

declare(strict_types = 1);

namespace App;

use App\Attributes\Route;
use App\Exceptions\RouteNotFoundException;
use App\Services\{
    InvoiceService, 
    SalesTaxService,
    PaymentGatewayServiceInterface,
    StripePayment, 
    EmailService,
    PaddlePayment,
    IndividualPayment,
};

class App
{

    private static DB $db;


    public function __construct(protected Container $container, protected Router $router, protected array $request ,protected Config $config)
    {
        
        static::$db = new DB($config->db ?? []);
        
        $this->container->set(PaymentGatewayServiceInterface::class,PaddlePayment::class);

        
        
    }

    public function run()
    {
       
        
        try{

            echo $this->router->resolve($this->request['requestUri'],$this->request['requestMethod']);


        }catch(RouteNotFoundException $e){

          
            echo $e->getMessage().'<br>';
            http_response_code(404);
            echo View::make('errors/404');
        }
    }

    public static function db():DB
    {
        return static::$db;
    }

}