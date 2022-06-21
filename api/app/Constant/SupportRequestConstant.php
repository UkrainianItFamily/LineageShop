<?php

namespace App\Constant;

class SupportRequestConstant
{
    public const SUPPORT_EMAIL = 'admin@admin.com';
    public const SUBJECTS = [
        0 => 'Без темы',
        1 => 'Я оплатил заказ, но продавец не отвечает мне',
        2 => 'Я недоволен выполнением заказа, хочу пожаловаться на продавца',
        3 => 'Платёж с моей банковской карты заблокирован',
        4 => 'Мой аккаунт BucksTrade заблокирован',
        5 => 'Покупатель забыл подтвердить заказ',
        6 => 'У меня есть проблемы с покупателем',
        7 => 'Пожаловаться на нарушение правил в чате',
        8 => 'Пожаловаться на нарушение правил в таблице предложений',
        9 => 'Проблема с платежом или выводом денег',
        10 => 'Восстановить доступ к аккаунту BucksTrade',
        11 => 'Отправить фотографии для отключения задержки',
        12 => 'Прочее',
    ];
    public const OPEN = 1;
    public const CLOSED = 2;
    public const UNREAD = 3;
    public const READ = 4;
    public const StatusNames = [
      '1' => 'Открыт',
      '2' => 'Закрыт',
      '3' => 'Не прочитанно',
      '4' => 'Прочитанно'
    ];
    public const DEFAULT_ORDER_TYPE = 'id';
    public const DEFAULT_ORDER_DIRECTION = 'DESC';


}
