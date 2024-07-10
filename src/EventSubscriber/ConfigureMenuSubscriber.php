<?php

namespace App\EventSubscriber;

use Ibexa\AdminUi\Menu\Event\ConfigureMenuEvent;
use Ibexa\AdminUi\Menu\MainMenuBuilder;
use JMS\TranslationBundle\Model\Message;
use JMS\TranslationBundle\Translation\TranslationContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ConfigureMenuSubscriber implements EventSubscriberInterface, TranslationContainerInterface
{
    public const ITEM_CONTENT__CUSTOM_PAGE = 'main__content__custom_page';

    public function onMenuConfigure(ConfigureMenuEvent $event): void
    {
        $menu = $event->getMenu();
        $contentMenu = $menu->getChild(MainMenuBuilder::ITEM_CONTENT);
        $contentMenu->addChild(
            self::ITEM_CONTENT__CUSTOM_PAGE,
            [
                'route' => 'app.admin.custompage.menu',
                'extras' => [
                    'translation_domain' => 'menu',
                    'orderNumber' => 70,
                ],
            ]
        );
    }

    public static function getSubscribedEvents(): array
    {
        return [ConfigureMenuEvent::MAIN_MENU => 'onMenuConfigure'];
    }

    public static function getTranslationMessages(): array
    {
        return [
            (new Message(self::ITEM_CONTENT__CUSTOM_PAGE, 'menu'))->setDesc('Custom Page'),
        ];
    }
}