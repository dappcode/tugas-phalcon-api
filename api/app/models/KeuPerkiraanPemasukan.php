<?php

class KeuPerkiraanPemasukan extends \Phalcon\Mvc\Model
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
     * @Column(type="string", nullable=false)
     */
    public $periode;

    /**
     *
     * @var string
     * @Column(type="string", length=54, nullable=false)
     */
    public $judul;

    /**
     *
     * @var string
     * @Column(type="string", length=16, nullable=false)
     */
    public $pemasukan_dari;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $nominal;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $tgl_perkiraan;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $keterangan;

    /**
     *
     * @var string
     * @Column(type="string", length=3, nullable=false)
     */
    public $cabang_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $input_time;

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
        return 'keu_perkiraan_pemasukan';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return KeuPerkiraanPemasukan[]|KeuPerkiraanPemasukan
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return KeuPerkiraanPemasukan
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
