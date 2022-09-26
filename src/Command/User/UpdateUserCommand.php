<?php

namespace App\Command\User;

use App\Constant\Constant;
use App\Constant\Endpoint;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\HttpFoundation\Request;
use App\Command\AbstractBaseCommand;

class UpdateUserCommand extends AbstractBaseCommand
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
    protected static $defaultName = Constant::UPDATE_USER_COMMAND_NAME;

    protected function configure(): void
    {
        $this 
            ->setDescription(Constant::UPDATE_USER_COMMAND_DESCRIPTION)
            ->addArgument(Constant::GROUP_ID_KEY, InputArgument::REQUIRED)
            ->addArgument(Constant::USER_ID_KEY, InputArgument::REQUIRED)
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Get url
        $groupId = $input->getArgument(Constant::GROUP_ID_KEY);
        $userId = $input->getArgument(Constant::USER_ID_KEY);
        $url = sprintf("%s/%s/%u/%s/%u", $this->backendDomain, Endpoint::GROUPS_ENDPOINT, $groupId, Endpoint::USERS_PATH, $userId);

        // Get data from questions
        $helper = $this->getHelper(Constant::QUESTION_KEY);
        $questionToGetUsername = new Question(Constant::MESSAGE_TO_ENTER_USER_NAME);
        $questionToGetEmail = new Question(Constant::MESSAGE_TO_ENTER_USER_EMAIL);
        $username = $helper->ask($input, $output, $questionToGetUsername);
        $email = $helper->ask($input, $output, $questionToGetEmail);

        // Send request and output result
        try
        {
            $response = $this->client->request(Request::METHOD_PUT, $url, array(
                Constant::HEADERS_KEY => array(
                    Constant::CONTENT_TYPE_KEY => Constant::JSON_CONTENT_TYPE
                ),
                Constant::BODY_KEY => json_encode(array(
                    Constant::NAME_KEY =>  $username,
                    Constant::EMAIL_KEY => $email
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