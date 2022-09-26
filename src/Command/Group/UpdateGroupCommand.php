<?php

namespace App\Command\Group;

use App\Constant\Constant;
use App\Constant\Endpoint;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\HttpFoundation\Request;
use App\Command\AbstractBaseCommand;

class UpdateGroupCommand extends AbstractBaseCommand
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
    protected static $defaultName = Constant::UPDATE_GROUP_COMMAND_NAME;

    protected function configure(): void
    {
        $this 
            ->setDescription(Constant::UPDATE_GROUP_COMMAND_DESCRIPTION)
            ->addArgument(Constant::ID_KEY, InputArgument::REQUIRED)
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $groupId = $input->getArgument(Constant::ID_KEY);
        $helper = $this->getHelper(Constant::QUESTION_KEY);
        $question = new Question(Constant::MESSAGE_TO_ENTER_GROUP_NAME);
        $groupName = $helper->ask($input, $output, $question);
        try
        {
            $url = sprintf("%s/%s/%u", $this->backendDomain, Endpoint::GROUPS_ENDPOINT, $groupId);
            $response = $this->client->request(Request::METHOD_PUT, $url, array(
                Constant::HEADERS_KEY => array(
                    Constant::CONTENT_TYPE_KEY => Constant::JSON_CONTENT_TYPE
                ),
                Constant::BODY_KEY => json_encode(array(
                    Constant::NAME_KEY => $groupName
                ))
            ));
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