<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Create/Update Language Lines
    |--------------------------------------------------------------------------
    |
    */

    'roles' => [
        'page_title' => 'Управление ролями',
        'page_caption' => 'Шаблон вашей панели управления ролями.',
        'create_button' => 'Новая роль',
        'edit_role' => 'Изменить роль',
        'delete_role' => 'Удалить роль',

        'create' => [
            'page_title' => 'Добавить роль',
            'page_caption' => 'Шаблон создания вашей роли.',
            'form_title' => 'Информация о ролях',

            'messages' => [
                'success' => 'Роль добавлена в вашу систему',
                'danger' => 'Невозможно добавить новую роль.',
                'exists' => 'Роль :Name уже существует для администратора',
            ],
        ],

        'edit' => [
            'page_title' => 'Изменить роль',
            'page_caption' => 'Шаблон редактирования вашей роли.',
            'form_title' => 'Информация о ролях',

            'messages' => [
                'success' => 'Роль успешно обновлена',
                'danger' => 'Невозможно обновить роль.'
            ],
        ],
    ],

    'admins' => [
        'page_title' => 'Список администраторов',
        'page_caption' => 'Ваш шаблон управления пользователями-администраторами.',
        'create_button' => 'Новый пользователь',
        'edit_role' => 'Редактировать пользователя',
        'delete_role' => 'Удалить пользователя',

        'table' => [
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'email' => 'Электронная почта',
        ],

        'create' => [
            'page_title' => 'Добавить пользователя-администратора',
            'page_caption' => 'Ваш шаблон создания пользователя с правами администратора.',
            'form_title' => 'Общая информация',

            'messages' => [
                'success' => 'Добавлен новый пользователь с ролью :Role.',
                'danger' => 'Невозможно добавить нового пользователя.',
            ],
        ],

        'edit' => [
            'page_title' => 'Изменить пользователя-администратора',
            'page_caption' => 'Ваш шаблон редактирования пользователя-администратора.',
            'form_title' => 'Общая информация',

            'messages' => [
                'success' => 'Пользователь успешно обновлен',
                'danger' => 'Не удается обновить пользователя.'
            ],
        ],

        'update-password' => [
            'form_title' => 'Обновить пароль',

            'messages' => [
                'success' => 'Пароль успешно обновлен.',
                'danger' => 'Не удается обновить пароль.',
            ],
        ],

        'invite-user' => [
            'page_title' => 'Пригласить пользователя-администратора',
            'page_caption' => 'Ваш шаблон приглашения администратора.',
            'form_title' => 'Пожалуйста, укажите адрес электронной почты человека, которого вы хотите добавить.',
            'role_section_title' => 'Роль',
            'invites_title' => 'Все приглашенные.',

            'messages' => [
                'success' => 'Приглашение успешно отправлено',
                'danger' => 'Невозможно отправить приглашение',
            ],
        ],
    ],

    'table' => [
        'created_at' => 'Создано в',
        'updated_at' => 'Обновлено в',
        'actions' => 'Действия',
    ],

    'back' => 'Назад',

];
