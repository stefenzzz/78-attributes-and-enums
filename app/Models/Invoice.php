<?php

declare(strict_types = 1);

namespace App\Models;

use App\Enums\Color;
use App\Enums\InvoiceStatus;
use App\Model;
use PDO;

class Invoice Extends Model
{

    public function create(float $amount, int $userId): int
    {

        $stmt = $this->db->prepare(
            'INSERT INTO invoices(amount, user_id)
            VALUES (?, ?)'
         );

        $stmt->execute([$amount,$userId]);    

        return (int) $this->db->lastInsertId();

    }
    public function find(int $invoiceId): array
    {
        $stmt = $this->db->prepare(
            'SELECT invoices.id, amount, full_name
             FROM invoices
             LEFT JOIN users ON users.id = user_id
             WHERE invoices.id = ? 
            ');
        $stmt->execute([$invoiceId]);

        $invoice = $stmt->fetch();

        return $invoice ? $invoice : [];
    }

    public function all(InvoiceStatus $status)
    {
 
      $stmt = $this->db->prepare(
        'SELECT id, invoice_id, amount, status
         FROM invoices');

      echo '<pre>';
      //check what invoice status this color
      var_dump(InvoiceStatus::fromColor(Color::Gray));

      //check all cases of this enums either pure enum or backed enum

      print_r(InvoiceStatus::cases());

        echo '</pre>';

      //$stmt->execute([$status->value]);  get only all data with one status

      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_OBJ);

    }
}