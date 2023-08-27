<?php

use App\Models\Question;

it("should list all the questions", function () {
    // Arrange
    // Criar algumas perguntas
    $user      = \App\Models\User::factory()->create();
    $questions = Question::factory()->count(5)->create();

    Pest\Laravel\actingAs($user);

    //Act
    //Acessar a rota
    $response = \Pest\Laravel\get(route("dashboard"));

    //Assert
    //Verificar se as perguntas estão sendo exibidas

    /** @var Question $q */
    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }
});
