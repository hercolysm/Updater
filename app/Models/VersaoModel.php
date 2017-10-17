<?php

namespace Updater\Models;

use Illuminate\Database\Eloquent\Model;

class VersaoModel extends Model
{
    /**
     * The table associated with the Model.
     *
     * @var string
     */
    protected $table = 'versao';

    /**
     * Primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_versao';

}
