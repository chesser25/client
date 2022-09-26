<?php

namespace App\Command\User;

use App\Constant\Endpoint;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Command\AbstractBaseCommand;
use App\Constant\Constant;
use Symfony\Component\Console\Input\InputArgument;

class GetAllUsersCommand extends AbstractBaseCommand
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
    protected static $defaultName = Constant::GET_ALL_USERS_COMMAND_NAME;

    protected function configure(): void
    {
        $this
            ->setDescription(Constant::GET_ALL_USERS_COMMAND_DESCRIPTION)
            ->addArgument(Constant::GROUP_ID_KEY, InputArgument::REQUIRED)
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $groupId = $input->getArgument(Constant::GROUP_ID_KEY);
        $url = sprintf("%s/%s/%u/%s", $this->backendDomain, Endpoint::GROUPS_ENDPOINT, $groupId, Endpoint::USERS_PATH);
        try
        {
            $response = $this->client->request(Request::METHOD_GET, $url);
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