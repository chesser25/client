<?php

namespace App\Command\Group;

use App\Constant\Constant;
use App\Constant\Endpoint;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\HttpFoundation\Request;
use App\Command\AbstractBaseCommand;

class CreateGroupCommand extends AbstractBaseCommand
{
    /**
     * @var string $backendDomain
     */
    public function __construct(string $backendDomain)
    {
        parent::__construct($backendDomain);
    }

    /**
     * @var string
     */
    protected static $defaultName = Constant::CREATE_GROUP_COMMAND_NAME;

    protected function configure(): void
    {
        $this->setDescription(Constant::CREATE_GROUP_COMMAND_DESCRIPTION);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper(Constant::QUESTION_KEY);
        $question = new Question(Constant::MESSAGE_TO_ENTER_GROUP_NAME);
        $groupName = $helper->ask($input, $output, $question);
        $url = sprintf("%s/%s", $this->backendDomain, Endpoint::GROUPS_ENDPOINT);
        try
        {
            $response = $this->client->request(Request::METHOD_POST, $url, array(
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