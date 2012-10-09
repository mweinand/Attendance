<?php
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class UserTable extends DbTable
{
    protected $table ='user';

    public function __construct(Adapter $adapter)
    {
        parent::__construct($adapter);

		$this->resultSetPrototype->setArrayObjectPrototype(new User());

		$this->initialize();
    }
}
