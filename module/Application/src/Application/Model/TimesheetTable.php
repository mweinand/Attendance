<?php
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class TimesheetTable extends DbTable
{
    protected $table ='timesheet';

    public function __construct(Adapter $adapter)
    {
        parent::__construct($adapter);

		$this->resultSetPrototype->setArrayObjectPrototype(new Timesheet());

		$this->initialize();
    }

}
?>