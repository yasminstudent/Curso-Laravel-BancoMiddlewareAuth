<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    // o laravel prevê que o nome da tabela é o nome da model no plural,
    // mas é possível dizer ao laravel o nome, caso seja diferente do que ele prevê
    protected $table = 'tarefas';

    // o laravel prevê que a chave primária tem o nome de id, mas tbm é possível informar outro nome
    protected $primaryKey = 'id';

    // a framework tbm entende que a chave primária é autoincrementada,
    // para mudar isso, basta definir o atributo seguinte como falso:
    public $incrementing = true;

    // se não definido ele entende a chave primária como um inteiro
    // protected $keyType = 'string';

    // o laravel assume que a tabela terá os campos created_at e update_at
    // caso não tenha, definir a seguinte propriedade como falso:
    public $timestamps = false;

    // caso exista esses campos mas com um nome diferente:
    //public const CREATED_AT = 'data_criacao';
    //public const UPDATED_AT = 'data_atualizacao';

    //campos que poderam ser editados ou criados em massa (com o update)
    protected $fillable = ['titulo'];
}
