<?php

use App\Models\User;

use function Pest\Laravel\{assertDatabaseCount, assertDatabaseHas};

test("it should be able to create a new question bigger than 255 characters", function () {
    // Arrange - preparar
    $user = User::factory()->create();
    Pest\Laravel\actingAs($user);

    // Act - agir
    $request = Pest\Laravel\post(route("question.store"), [
        "question" => str_repeat("*", 260) . "?",
    ]);

    // Assert - verificar
    $request->assertRedirect(route("dashboard"));
    assertDatabaseCount("questions", 1);
    assertDatabaseHas("questions", [
        "question" => str_repeat("*", 260) . "?",
    ]);

});

it("should check if ends with question mark ?", function () {

})->todo();

it("should have at least 10 characters", function () {
    // Arrange - preparar
    $user = User::factory()->create();
    Pest\Laravel\actingAs($user);

    // Act - agir
    $request = Pest\Laravel\post(route("question.store"), [
        "question" => str_repeat("*", 8) . "?",
    ]);

    // Assert - verificar
    $request->assertSessionHasErrors(["question" => __("validation.min.string", ["min" => 10, "attribute" => "question"])]);
    assertDatabaseCount("questions", 0);
});
