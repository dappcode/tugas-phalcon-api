<?php

class ViewPengeluaranPerhari extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Primary
     * @Column(type="string", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $periode;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    public $nama_barang;

    /**
     *
     * @var string
     * @Column(type="string", length=2, nullable=true)
     */
    public $akun_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=2, nullable=true)
     */
    public $jml_barang;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=true)
     */
    public $harga_satuan;

    /**
     *
     * @var string
     * @Column(type="string", length=8, nullable=true)
     */
    public $satuan_barang_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $total_harga;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $keterangan;

    /**
     *
     * @var string
     * @Column(type="string", length=3, nullable=true)
     */
    public $cabang_id;

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
        return 'view_pengeluaran_perhari';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ViewPengeluaranPerhari[]|ViewPengeluaranPerhari
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ViewPengeluaranPerhari
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function getDataPengeluaran()
    {
        $requestData = $_REQUEST;
        $requestSearch = strtoupper($requestData['search']['value']);

        $columns = array(
            0 => 'Hari',
            1 => 'Pengeluaran',
            
        );

        $sql = "SELECT * FROM ViewPengeluaranPerhari";
        $query = $this->modelsManager->executeQuery($sql);
        $totalData = count($query);
        $totalFiltered = $totalData;  
        $no = $requestData['start']+1;
        $start = $requestData['start'];
        $length = $requestData['length'];
        if (!empty($requestSearch)) {
            //function mencari data user
                $sql = "SELECT * FROM ViewPengeluaranPerhari WHERE Hari LIKE '%".$requestSearch."%'";
                $sql.= "OR Pengeluaran LIKE '%".$requestSearch."%'";
                $query = $this->modelsManager->executeQuery($sql); 
                $totalFiltered = count($query);
    
                $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
                $query = $this->modelsManager->executeQuery($sql); 
            } else {
            //function menampilkan seluruh data
                $sql = "SELECT * FROM ViewPengeluaranPerhari limit $start,$length" ;
                $query = $this->modelsManager->executeQuery($sql); 
            }

        $data = array();
        

        foreach ($query as $key => $value) {
            $dataUser = array();
            $dataUser[] = $no;
            $dataUser[] = $value->Hari;
            $dataUser[] = $value->Pengeluaran;
            $dataUser[] = '
            <button id="btn-view" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default" 
            onclick="return send_data_view_pengeluaran(\''.$value->Hari.'\');">View</button>';
           

            $data[] = $dataUser;
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

    public function filter($Bulan)
    {
        $requestData = $_REQUEST;
        $requestSearch = $Bulan;
        $filter = '%'.$Bulan.'-%';
        $sql = "SELECT * FROM ViewPengeluaranPerhari WHERE Hari LIKE '$filter'";
        $query = $this->modelsManager->executeQuery($sql);
        $totalData = count($query);
        $totalFiltered = $totalData;  
        //    $no = $requestData['start']+1;
        //    $start = $requestData['start'];
        //    $length = $requestData['length'];
        if (!empty($requestSearch)) {
            //function mencari data user
            $sql = "SELECT * FROM ViewPengeluaranPerhari WHERE Hari LIKE '%".$requestSearch."%'";
            $query = $this->modelsManager->executeQuery($sql); 
            $totalFiltered = count($query);
            $query = $this->modelsManager->executeQuery($sql); 
        } else {
            //function menampilkan seluruh data
            $sql = "SELECT * FROM ViewPengeluaranPerhari WHERE Hari LIKE '$filter'" ;
            $query = $this->modelsManager->executeQuery($sql); 

        }
        $data = array();
        $no = 1;

        foreach($query as $key => $value) {
            $dataAkun = array();
            $dataAkun[] = $no;
            $dataAkun[] = $value->Hari; 
            $dataAkun[] = "Rp ".number_format($value->Pengeluaran);
            $dataAkun[] = '
            <button id="btn-view" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default" 
            onclick="return send_data_view_pengeluaran(\''.$value->Hari.'\');">View</button>';
            $data[] = $dataAkun;
            $no++;
        }
        $json_data = array(
            "draw"            => 0,
            "recordsTotal"    => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $data
        ); 
        return $json_data;
    }
}
