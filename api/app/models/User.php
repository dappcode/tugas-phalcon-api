<?php

class User extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id;

     /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=false)
     */
    public $cabang_id;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=false)
     */
    public $username;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=false)
     */
    public $password;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("qodr");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ref_user';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return User[]|User
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return User
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function getDataUser()
    {
        $requestData = $_REQUEST;
        

        $columns = array(
            0 => 'cabang_id',
            1 => 'username',
            2 => 'password',
            3 => 'type',
        );

        $sql = "SELECT * FROM User";
        $query = $this->modelsManager->executeQuery($sql);
        $totalData = count($query);
        $totalFiltered = $totalData;  
        // $no = $requestData['start']+1;
        // $start = $requestData['start'];
        // $length = $requestData['length'];
        
        
        $data = array();
        
        $no = 1;
        foreach ($query as $key => $value) {
            $dataUser = array();
            $dataUser[] = $no;
            $dataUser[] = $value->cabang_id;
            $dataUser[] = $value->username;
            $dataUser[] = $value->password;
            $dataUser[] = $value->type;
            $dataUser[] = '
               <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default" 
               onclick="return send_data_edit(\''.$value->id.'\');">Edit</button>
               <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete"
                onclick="return send_data_delete(\''.$value->id.'\');">Delete</button>
            ';
        

            $data[] = $dataUser;
            $no++;
        }

                
        $json_data = array(
			// "draw"            => intval( $requestData['draw'] ),
			"recordsTotal"    => intval( $totalData ),
			"recordsFiltered" => intval( $totalFiltered ), 
			"data"            => $data
		);
        
        return $json_data; 
    }
}
