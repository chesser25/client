<?php

namespace App\Command\User;

use App\Constant\Endpoint;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\HttpFoundation\Request;
use App\Command\AbstractBaseCommand;
use App\Constant\Constant;

class DeleteUserCommand extends AbstractBaseCommand
{
    /**
     * @param string $backendDomain
     */
    public function __construct(string $backendDomain)
    {
        parent::__construct($backendDomain);
    }

    /**
     * @var string
     */
    protected static $defaultName = Constant::DELETE_USER_COMMAND_NAME;

    protected function configure(): void
    {
        $this
            ->setDescription(Constant::DELETE_USER_COMMAND_DESCRIPTION)
            ->addArgument(Constant::ID_KEY, InputArgument::REQUIRED)
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $userId = $input->getArgument(Constant::ID_KEY);
        $url = sprintf("%s/%s/%u", $this->backendDomain, Endpoint::USERS_ENDPOINT, $userId);
        try
        {
            $response = $this->client->request(Request::METHOD_DELETE, $url);
            $output->writeln($response->getBody());
            return 0;
        }
        catch(\Exception $e)
        {
            $output->writeln($e->getMessage());
            return 1;
        }
    }
}