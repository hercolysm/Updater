<?php

namespace Updater\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioModel extends Model
{
    /**
     * The table associated with the Model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
}
