<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Application\Model\Init,
    Application\Model\FileFinder,
    Application\Model\Graber,
    Application\Model\EventsTable;

/**
 * @author Artur Sh. Mamedbekov
 */
class IndexController extends AbstractActionController{
  /**
   * Главная страница проекта.
   */
  public function indexAction(){
    return new ViewModel();
  }

  /**
   * Обработка страниц для заданий.
   */
  public function taskAction(){
    $id = $this->getEvent()->getRouteMatch()->getParam('id');
    $viewModel = null;
    switch($id){
      case 1:
        $init = new Init($this->getServiceLocator()->get('ZendDbAdapterAdapter'));
        $viewModel = new ViewModel([
          'rows' => $init->get(),
        ]);
        break;
      case 3:
        $fileFinder = new FileFinder;
        $viewModel = new ViewModel([
          'files' => $fileFinder->find(),
        ]);
        break;
      case 4:
        $graber = new Graber;
        $events = $graber->getEvents();
        // Не стал дергать БД
        //$eventsTable = new EventsTable($this->getServiceLocator()->get('ZendDbAdapterAdapter'));
        //$eventsTable->addEvents($events);
        $viewModel = new ViewModel([
          'events' => $events,
        ]);
        break;
      default:
        $viewModel = new ViewModel();
    }
    return $viewModel->setTemplate('application/index/task' . $id);
  }
}
