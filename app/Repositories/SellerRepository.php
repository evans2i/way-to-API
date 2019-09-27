<?php

namespace App\Repositories;

use App\Models\Seller;
use App\Repositories\BaseRepository;

/**
 * Class SellerRepository
 * @package App\Repositories
 * @version August 30, 2019, 11:45 am UTC
*/

class SellerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'lat',
        'lang',
        'city',
        'street',
        'Block',
        'user_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Seller::class;
    }
}
