<?php
namespace Application\Model;

use Zend\Db\Adapter\Adapter;

/**
 * Интерфейс взаимодействия с таблицей bills_ru_events.
 * @author Artur Sh. Mamedbekov
 */
class EventsTable{
  /**
   * @var Adapter Соединение с БД.
   */
  private $dbAdapter;

  /**
   * @param mixed $dbAdapter
   */
  public function __construct(Adapter $dbAdapter){
		$this->dbAdapter = $dbAdapter;
  }

  /**
   * Метод добавляет события в таблицу.
   * @param object[] $events Массив объектов, описывающих события.
   */
  public function addEvents($events){
    $stmt = $this->dbAdapter->createStatement('
      INSERT INTO bills_ru_events (
        `date`,
        `title`,
        `url`
      ) 
      VALUES (
        :date,
        :title,
        :url
      )');
    foreach($events as $event){
      $stmt->execute($event);
    }
  }
}
