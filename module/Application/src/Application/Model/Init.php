<?php
namespace Application\Model;

use Zend\Db\Adapter\Adapter;

/**
 * Класс тестирования базы данных для задания 1.
 * @author Artur Sh. Mamedbekov
 */
final class Init{
  /** Нормальный результат выполнения скрипта */
  const NORMAL  = 0;
  /** Недопустимый результат выполнения скрипта */
  const ILLEGAL = 1;
  /** Ошибочное выполнение скрипта */
  const FAILED  = 2;
  /** Удачное выполнение скрипта */
  const SUCCESS = 3;

  /**
   * @var Adapter Соединение с БД.
   */
  private $dbAdapter;

  /**
   * @var integer Числовая ссылка на тип результата работы скрипта. Используется для заполненеия тестовой таблицы данными.
   */
  private $currentResult = -1;

  /**
   * @return string[] Параметры запроса, используемые для заполнения тестовой таблицы случайными данными.
   */
  private function getStmtParams(){
    $this->currentResult++;
    return [
      'name' => 'script_' . time(),
      'start' => time(),
      'end' => time(),
      'result' => $this->currentResult,
    ];
  }

  /**
   * Метод создает тестируемую таблицу в базе данных.
   */
  private function create(){
    $stmt = $this->dbAdapter->createStatement('
      CREATE TABLE IF NOT EXISTS test
      (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `script_name` VARCHAR(25),
        `start_time` INT,
        `end_time` INT,
        `result` TINYINT UNSIGNED
      )');
    $stmt->execute();
  }

  /**
   * Метод заполняет тестируемую таблицу данными.
   */
  private function fill(){
    $stmt = $this->dbAdapter->createStatement('
      INSERT INTO test (
        `script_name`,
        `start_time`,
        `end_time`,
        `result`
      ) 
      VALUES (
        :name,
        :start,
        :end,
        :result
      )');
    // 5 записей при каждом вызове.
    for($i = 0; $i < 5; $i++){
      $stmt->execute($this->getStmtParams());
    }
  }

  /**
   * @param Adapter $dbAdapter Активное соединение с БД.
   */
  public function __construct(Adapter $dbAdapter){
    $this->dbAdapter = $dbAdapter;
    $this->create();
    $this->fill();
  }

  /**
   * @return array Массив данных, отвечающих критерию: результат = normal или success.
   */
  public function get(){
    $stmt = $this->dbAdapter->createStatement('
      SELECT *
      FROM test
      WHERE `result` IN (' . join([self::NORMAL, self::SUCCESS], ',') . ')
    ');
    return $stmt->execute();
  }
}
