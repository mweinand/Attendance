<?php
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class DbTable extends AbstractTableGateway
{	
    protected $table;
	
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;

        $this->resultSetPrototype = new ResultSet();
    }
    
    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }

    public function findById($id)
    {
        $id  = (int) $id;

        $rowset = $this->select(array(
            'id' => $id,
        ));

        $row = $rowset->current();

        if (!$row) {
            throw new \Exception("Could not find row $id");
        }

        return $row;
    }
        
    public function deleteById($id)
    {
        $this->delete(array(
            'id' => $id,
        ));
    }

    public function save(IEntity $entity)
    {
        $id = (int) $entity->id;
		$data = $entity->toArray();

        if ($id == 0) {
				$this->insert($data);
				$entity->setId($this->getLastInsertValue());
            
        } elseif ($this->findById($id)) {
            $this->update(
                $data,
                array(
                    'id' => $id,
                )
            );
        } else {
            throw new \Exception('ID does not exist');
        }
    }
}
