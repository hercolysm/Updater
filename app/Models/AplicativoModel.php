<?php

namespace Updater;

use Illuminate\Database\Eloquent\Model;

class AplicativoModel extends Model
{
    /**
     * The table associated with the Model.
     *
     * @var string
     */
    protected $table = 'aplicativo';

    /**
     * Primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_aplicativo';
}
