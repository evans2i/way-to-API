<?php

namespace App\Repositories;

use App\Models\Buyer;
use App\Repositories\BaseRepository;

/**
 * Class BuyerRepository
 * @package App\Repositories
 * @version August 30, 2019, 11:44 am UTC
*/

class BuyerRepository extends BaseRepository
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
        return Buyer::class;
    }
}
