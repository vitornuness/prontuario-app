<?php

namespace Test\Feature\Pacientes;

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

pest()->use(RefreshDatabase::class);

test(
    'pode acessar o formulario de cadastrar pacientes', 
    fn () => get('/pacientes')->assertOk()
);