<?php

namespace Unit\Models;

use App\Models\Paciente;

use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertSame;

test('deve retornar cpf formatado', function () {
    $paciente = Paciente::factory()
        ->withCpf('12345678911')
        ->make();
    
    assertSame('123.456.789-11', $paciente->cpf_formatado);
});

test('nao deve formatar cpf nulo', function () {
    $paciente = Paciente::factory()->make();

    assertNull($paciente->cpf_formatado);
});

test('deve retornar data de nascimento formatada', function () {
    $paciente = Paciente::factory()->make(['data_nascimento' => '2000-01-01']);

    assertSame('01/01/2000', $paciente->data_nascimento_formatada);
});

test('deve retornar telefone formatado', function ($telefone, $telefone_expected) {
    $paciente = Paciente::factory()
        ->withTelefone($telefone)
        ->make();

    assertSame($telefone_expected, $paciente->telefone_formatado);
})->with([
    ['1234567890', '(12) 3456-7890'],
    ['12345678911', '(12) 34567-8911']
]);

test('nao deve formatar telefone nulo', function () {
    $paciente = Paciente::factory()->make();

    assertNull($paciente->telefone_formatado);
});