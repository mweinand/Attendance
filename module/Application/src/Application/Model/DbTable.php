<?php
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class UserTable extends AbstractTableGateway
{
    protected $table ='user';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;

        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Album());

        $this->initialize();
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

    public function saveAlbum(Album $album)
    {
        $data = array(
            'artist' => $album->artist,
            'title'  => $album->title,
        );

        $id = (int) $album->id;

        if ($id == 0) {
            $this->insert($data);
        } elseif ($this->getAlbum($id)) {
            $this->update(
                $data,
                array(
                    'id' => $id,
                )
            );
        } else {
            throw new \Exception('Form id does not exist');
        }
    }
}