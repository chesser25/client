<?php

namespace App\Constant;

class Constant
{
    const QUESTION_KEY = 'question';
    const MESSAGE_TO_ENTER_GROUP_NAME = "Please enter the name of the group: \n";
    const MESSAGE_TO_ENTER_USER_NAME = "Please enter the name of the user: \n";
    const MESSAGE_TO_ENTER_USER_EMAIL = "Please enter the email of the user: \n";
    const NAME_KEY = 'name';
    const EMAIL_KEY = 'email';
    const GROUP_ID_KEY = 'group_id';
    const USER_ID_KEY = 'user_id';
    const CREATE_USER_COMMAND_NAME = 'app:create-user';
    const CREATE_USER_COMMAND_DESCRIPTION = 'Create user';
    const HEADERS_KEY = 'headers';
    const BODY_KEY = 'body';
    const CONTENT_TYPE_KEY = 'Content-Type';
    const JSON_CONTENT_TYPE = 'application/json';
    const ID_KEY = 'id';
    const DELETE_USER_COMMAND_NAME = 'app:delete-user';
    const DELETE_USER_COMMAND_DESCRIPTION = 'Delete user';
    const GET_USER_COMMAND_NAME = 'app:get-user';
    const GET_USER_COMMAND_DESCRIPTION = 'Get user';
    const GET_ALL_USERS_COMMAND_NAME = 'app:get-all-users';
    const GET_ALL_USERS_COMMAND_DESCRIPTION = 'Get all users';
    const UPDATE_USER_COMMAND_NAME = 'app:update-user';
    const UPDATE_USER_COMMAND_DESCRIPTION = 'Update user';
    const CREATE_GROUP_COMMAND_NAME = 'app:create-group';
    const CREATE_GROUP_COMMAND_DESCRIPTION = 'Create group';
    const DELETE_GROUP_COMMAND_NAME = 'app:delete-group';
    const DELETE_GROUP_COMMAND_DESCRIPTION = 'Delete group';
    const GET_ALL_GROUPS_COMMAND_NAME = 'app:get-all-groups';
    const GET_ALL_GROUPS_COMMAND_DESCRIPTION = 'Get all groups';
    const GET_GROUP_COMMAND_NAME = 'app:get-group';
    const GET_GROUP_COMMAND_DESCRIPTION = 'Get group';
    const UPDATE_GROUP_COMMAND_NAME = 'app:update-group';
    const UPDATE_GROUP_COMMAND_DESCRIPTION = 'Update group';
}