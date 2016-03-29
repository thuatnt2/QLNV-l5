<?php
namespace App\Repositories;

use App\Contracts\Repository;
use App\Network;

class NetworkRepository extends AbstractRepository
{
    protected $network;

    public function __construct(Network $network)
    {
        $this->network = $network;
        parent::__construct($this->network);
    }

    public function formatNetwork($items)
    {
        $output = [];
        foreach ($items as $item) {
            $output[$item->symbol] = ['name' => 'network['.$item->id.']', 'value' => $item->id];
        }
        return $output;
    }
    
}