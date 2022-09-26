<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use GuzzleHttp\Client;

abstract class AbstractBaseCommand extends Command
{
    /**
     * @var string
     */
    protected $backendDomain;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @param string
     */
    public function __construct(string $backendDomain)
    {
        $this->backendDomain = $backendDomain;
        $this->client = new Client();
        parent::__construct();
    }
}