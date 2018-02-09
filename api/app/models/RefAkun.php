<?php

class RefAkun extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Primary
     * @Column(type="string", length=3, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=16, nullable=false)
     */
    public $nama;

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
        return 'ref_akun';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return RefAkun[]|RefAkun
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return RefAkun
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function getData()
    {
        $sql = "select * from ViewPengeluaranPerhari group by Hari";
        $query = $this->modelsManager->executeQuery($sql);

        $no = $requestData["start"]+1;
        $data = array();

        foreach($query as $key => $value) {
            $dataAkun = array();
            $dataAkun[] = $no;
            $dataAkun[] = $value->Hari;
            $dataAkun[] = $value->Pengeluaran;

            $data[] = $dataAkun;
            $no++;
        }

        $json_data = array(
            "draw"            => intval( $requestData['draw'] ),
            "recordsTotal"    => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $data
         );
         return $json_data;
    }
}
