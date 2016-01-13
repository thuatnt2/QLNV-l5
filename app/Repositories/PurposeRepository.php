<?php
namespace App\Repositories;

use App\Contracts\Repository;
use App\Purpose;

class PurposeRepository extends AbstractRepository
{
    protected $purpose;

    public function __construct(Purpose $purpose)
    {
        $this->purpose = $purpose;
        parent::__construct($this->purpose);
    }
}