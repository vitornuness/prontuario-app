<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'data_nascimento'   => fake()->date(), 
            'nome'              => fake()->name()
        ];
    }

    public function withCpf(string $cpf = ''): static
    {
        $fake_cpf = str_pad(
            fake()->numberBetween(100, 99999999999), 
            11, '0', STR_PAD_LEFT);

        return $this->state(fn (array $attributes) => [
            'cpf' => empty($cpf) ? $fake_cpf : $cpf
        ]);
    }

    public function withTelefone(string $telefone = ''): static
    {
        return $this->state(fn (array $attributes) => [
            'telefone' => empty($telefone) 
                ? fake()->numberBetween(1000000000, 99999999999) 
                : $telefone
        ]);
    }

    public function withEmail(string $email = ''): static
    {
        return $this->state(fn (array $attributes) => [
            'email' => empty($email) ? fake()->email() : $email
        ]);
    }
}
