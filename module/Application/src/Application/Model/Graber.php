<?php
namespace Application\Model;

/**
 * Класс для получения событий долгового рынка.
 * @author Artur Sh. Mamedbekov
 */
class Graber{
  /**
   * @return string[] Массив событий на долговом рынке.
   */
  public function getEvents(){
    libxml_use_internal_errors(true);

    $page = new \DOMDocument('1.0', 'UTF-8');
    $page->loadHTMLFile('http://www.bills.ru/');

    /**
     * @var object[] Массив событий на долговом рынке.
     */
    $events = [];
    $eventsTable = $page->getElementById('bizon_api_news_list');
    foreach($eventsTable->childNodes as $event){
      $eventObj = [];
      $eventObj['date'] = $event->firstChild->firstChild->data;
      $eventObj['title'] = $event->childNodes->item(2)->childNodes->item(1)->firstChild->data;
      $eventObj['url'] = $event->childNodes->item(2)->childNodes->item(1)->getAttribute('href');
      $events[] = $eventObj;
    }
    return $events;
  }
}
