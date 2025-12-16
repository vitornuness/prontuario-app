<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'cpf', 
        'data_nascimento', 
        'email',
        'nome', 
        'telefone' 
    ];

    /**
     * Cria um atributo com o cpf no formato `000.000.000-00`.
     */
    protected function cpfFormatado(): Attribute
    {
        return Attribute::get(
            fn (mixed $value, array $attributes) => 
                isset($attributes['cpf']) && !empty($attributes['cpf']) 
                ? substr($attributes['cpf'], 0, 3)
                    .'.'
                    .substr($attributes['cpf'], 3, 3)
                    .'.'
                    .substr($attributes['cpf'], 6, 3)
                    .'-'
                    .substr($attributes['cpf'], 9)
                : null
        );
    }

    /**
     * Cria um atributo com a data de nascimento no formato `d/m/Y`.
     * 
     * @return Attribute
     */
    protected function dataNascimentoFormatada(): Attribute
    {
        
        return Attribute::get(
            fn (mixed $value, array $attributes) => 
                date('d/m/Y', strtotime($attributes['data_nascimento']))
        );
    }

    /**
     * Cria um atributo com o telefone no formato `(00) 00000-0000`.
     * 
     * @return Attribute
     */
    protected function telefoneFormatado(): Attribute
    {
        return Attribute::get(
            fn (mixed $value, array $attributes) => 
                isset($attributes['telefone']) && !empty($telefone = $attributes['telefone']) 
                ? '('
                    .substr($telefone, 0, 2)
                    .') '
                    .substr($telefone, 2, ($tamanho_telefone = strlen($telefone)) - 6)
                    .'-'
                    .substr($telefone, $tamanho_telefone - 4)
                : null
        );
    }
}
