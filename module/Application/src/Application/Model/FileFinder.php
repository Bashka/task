<?php
namespace Application\Model;

/**
 * Класс выполняет поиск файлов по критерию.
 * @author Artur Sh. Mamedbekov
 */
class FileFinder{
  /**
   * @return string[] Массив имен файлов, отвечающих критерию отбора: [A-Za-z0-9]+\.ixt
   */
  public function find(){
    $dir = new \DirectoryIterator(PROJECT_ROOT . '/data/task3');
    $filesName = [];
    foreach($dir as $file){
      $basename = $file->getBasename();
      if(preg_match('/^[A-Za-z0-9]+\.ixt$/', $basename) !== 0){
        $filesName[] = $basename;
      }
    }
    sort($filesName);
    return $filesName;
  }
}
