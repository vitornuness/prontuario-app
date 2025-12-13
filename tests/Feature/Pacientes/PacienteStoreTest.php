<?php

namespace Tests\Feature\Pacientes;

use App\Models\Paciente;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseEmpty;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

define('URI_PACIENTES_STORE',       '/pacientes');
define('PARAMETRO_CPF',             'cpf');
define('PARAMETRO_DATA_NASCIMENTO', 'data_nascimento');
define('PARAMETRO_EMAIL',           'email');
define('PARAMETRO_NOME',            'nome');
define('PARAMETRO_TELEFONE',        'telefone');
define('TABELA_PACIENTES',          'pacientes');

define('REQUEST_PARAMETROS_DATA_NASCIMENTO_E_NOME_VAZIOS', [
    [
        PARAMETRO_NOME              => '', 
        PARAMETRO_DATA_NASCIMENTO   => ''
    ], 
    [
        PARAMETRO_NOME, 
        PARAMETRO_DATA_NASCIMENTO
    ]
]);
define('REQUEST_PARAMETROS_DATA_NASCIMENTO_E_NOME_NULOS', [
    [
        PARAMETRO_NOME              => null, 
        PARAMETRO_DATA_NASCIMENTO   => null
    ], 
    [
        PARAMETRO_NOME, 
        PARAMETRO_DATA_NASCIMENTO
    ]
]);
define('REQUEST_SOMENTE_DATA_NASCIMENTO', [
    [ PARAMETRO_DATA_NASCIMENTO => today()->format('Y-01-01') ], 
    [ PARAMETRO_NOME ]
]);
define('REQUEST_SOMENTE_NOME', [
    [ PARAMETRO_NOME =>  fake()->name() ], 
    [ PARAMETRO_DATA_NASCIMENTO ]
]);

define('NOVE_DIGITOS', '123456789');
define('DEZ_DIGITOS', '1234567890');
define('DOZE_DIGITOS', '123456789012');

pest()->use(RefreshDatabase::class);

test('pode cadastrar um novo paciente', function () {
    $paciente = [
        PARAMETRO_CPF               => str_pad(
                                        fake()->numberBetween(100, 99999999999), 
                                        11, '0', STR_PAD_LEFT
                                    ),
        PARAMETRO_DATA_NASCIMENTO   => fake()->date(),
        PARAMETRO_EMAIL             => fake()->email(),  
        PARAMETRO_NOME              => fake()->name(), 
        PARAMETRO_TELEFONE          => fake()->numberBetween(1000000000, 99999999999)
    ];

    post(URI_PACIENTES_STORE, $paciente)
        ->assertRedirect(URI_PACIENTES_STORE)
        ->assertSessionHas('alert', 'Paciente cadastrado com sucesso.');
    assertDatabaseHas(TABELA_PACIENTES, $paciente);
});

test('pode cadastrar um novo pacientes apenas com nome e data de nascimento', function () {
    $paciente = [
        PARAMETRO_DATA_NASCIMENTO   => fake()->date(),
        PARAMETRO_NOME              => fake()->name()
    ];

    post(URI_PACIENTES_STORE, $paciente)
        ->assertRedirect(URI_PACIENTES_STORE);
    assertDatabaseHas(TABELA_PACIENTES, $paciente);
});

test('nao pode cadastrar um novo paciente sem nome eou data de nascimento', function ($paciente, $errors) {
    post(URI_PACIENTES_STORE, $paciente)
        ->assertRedirectBackWithErrors($errors);
    assertDatabaseEmpty(TABELA_PACIENTES);
})->with([
    REQUEST_PARAMETROS_DATA_NASCIMENTO_E_NOME_VAZIOS,
    REQUEST_PARAMETROS_DATA_NASCIMENTO_E_NOME_NULOS,
    REQUEST_SOMENTE_DATA_NASCIMENTO,
    REQUEST_SOMENTE_NOME,
]);

test('nao pode cadastrar um novo paciente se informado um cpf ja cadastrado', function () {
    $paciente = Paciente::factory()->withCpf('12345678911')->create();

    post(URI_PACIENTES_STORE, [
        PARAMETRO_CPF               => $paciente->cpf, 
        PARAMETRO_DATA_NASCIMENTO   => fake()->date(), 
        PARAMETRO_NOME              => fake()->name()
    ])
        ->assertRedirectBackWithErrors([PARAMETRO_CPF]);
    assertDatabaseCount(TABELA_PACIENTES, 1);
});

test('nao pode cadastrar um novo paciente se informado um cpf diferente de 11 digitos', function ($cpf) {
    post(URI_PACIENTES_STORE, [
        PARAMETRO_CPF               => $cpf, 
        PARAMETRO_DATA_NASCIMENTO   => fake()->date(), 
        PARAMETRO_NOME              => fake()->name()
    ])
        ->assertRedirectBackWithErrors([PARAMETRO_CPF]);
    assertDatabaseEmpty(TABELA_PACIENTES);
})->with([
    DEZ_DIGITOS,
    DOZE_DIGITOS
]);

test('nao pode cadastrar um novo paciente se informado um telefone que nao 
esteja entre 10 e 11 digitos', function ($telefone) {
    post(URI_PACIENTES_STORE, [
        PARAMETRO_TELEFONE          => $telefone, 
        PARAMETRO_DATA_NASCIMENTO   => fake()->date(), 
        PARAMETRO_NOME              => fake()->name()
    ])
        ->assertRedirectBackWithErrors([PARAMETRO_TELEFONE]);
    assertDatabaseEmpty(TABELA_PACIENTES);
})->with([
    NOVE_DIGITOS, 
    DOZE_DIGITOS
]);