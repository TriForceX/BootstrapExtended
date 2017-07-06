=== Plugin Name ===
Contributors: c0ns0l3
Tags: taxonomy, post, order, post order,admin, admin order
Requires at least: 4.4
Tested up to: 4.7.2
Stable tag: 4.7.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Order your WordPress posts and tags with simple order system

== Description ==
Advanced system of ordering your posts and terms.
You can re-order all of it right in the default screen of list posts/tags in your admin page.

== Installation ==
1. Загрузите плагин в `/wp-content/plugins/advanced-order` папку, или проинсталируйте через страницу установки плагинов в вашем WordPress.
2. Активируйте плагин в вашем WordPress на странице Плагинов
3. Используйте Настройки->Advanced Order для конфигурации плагина

== Screenshots ==
1. Управляющий елемент сортировки
2. Демонстрация настроек

== Changelog ==
* 2.0
  * Исправлен баг, который ломал сортировку плагина Advanced Custom Fields (наконец-то)
  * Добавлены оповещения пользователю о том, что у него не выбраны типы данных, которые нужно сортировать
  * Добавлена возможность перевода
* 1.41
	* Исправлен баг на версии 4.6 с отработкой проверки в Админке на визуальном редакторе
* 1.4
    * Исправлен баг фронт-енда на перезапись запроса в get_posts() на сортировку по умолчанию.
* 1.3
    * Исправлена фильтрация для категорий/рубрик (при просмотре категорий или рубрик, значение post_type = '' в следствии чего не меняется сортировка по умолчанию)
    * Теперь если же в рубриках и категориях при post_type = '' автоматически добавляется сортировка по menu_order
* 1.2
    * Исправлен CSS при перемещении елементов
* 1.1
    * Исправленный фильтр запросов в $wpdb->terms для COUNT(*)
    * Исправлена ошибка при удалении Терма
    * Добавлено отключение кеширования при сортировках
    * Исправлена ошибка с преобразованием типов для получения максимального значение сортировки в термах
    * Поправлено кеширование при записи данных сортировки
    * Мелкие поправки в безопасности
* 1.0
	* Первый выпуск плагина

= Please Vote and Enjoy =
Your votes really make a difference! Thanks.

== Frequently Asked Questions ==
= Q. I have a question =
A. Ask your question on support page.

== Upgrade Notice ==
* No upgrade notice yet