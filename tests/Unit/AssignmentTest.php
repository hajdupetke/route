<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Assignment;
use App\Models\User;
use App\Enums\AssignmentStatus;
use App\Enums\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssignmentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test of an admin user creating an assignment
     * @test
     */
    public function test_assignment_creation(): void
    {
        $this->withoutExceptionHandling();
        $driver = User::factory()->create(['role' => UserRole::Driver]);
        $admin = User::factory()->create(['role' => UserRole::Admin]);

        $data = [
            "status" => AssignmentStatus::Assigned->value,
            "start_address" => "1074, Budapest Vörösmarty utca 2.",
            "delivery_address" => "2013, Pomáz, Huszár utca 32.",
            "recipient_name" => "Varga Lajos",
            "recipient_phone_number" => "+36 30 221 2415",
            'driver' => $driver->id,
        ];

        $response = $this->actingAs($admin)->post(route('assignment.store'), $data);

        $assignment = Assignment::where(["start_address" => "1074, Budapest Vörösmarty utca 2.",
            "delivery_address" => "2013, Pomáz, Huszár utca 32.",
            "recipient_name" => "Varga Lajos",
            "recipient_phone_number" => "+36 30 221 2415",])->first();

        $response->assertRedirect(route('assignment.show', $assignment));
        $this->assertDatabaseHas('assignments', [
            "start_address" => "1074, Budapest Vörösmarty utca 2.",
            "delivery_address" => "2013, Pomáz, Huszár utca 32.",
            "recipient_name" => "Varga Lajos",
            "recipient_phone_number" => "+36 30 221 2415",
            "status" => AssignmentStatus::Assigned->value,
        ]);
    }

    public function test_assignment_editing(): void
    {
        $admin = User::factory()->create(['role' => UserRole::Admin]);
        $driver = User::factory()->create(['role' => UserRole::Driver]);
        $assignment = $driver->assignments()->create([
            "start_address" => "1074, Budapest Vörösmarty utca 2.",
            "delivery_address" => "2013, Pomáz, Huszár utca 32.",
            "recipient_name" => "Varga Lajos",
            "recipient_phone_number" => "+36 30 221 2415",
            "status" => AssignmentStatus::Assigned->value,
        ]);

        $response = $this->actingAs($admin)->put(route('assignment.update', $assignment), [
            'recipient_name' => "Vargané Erzsébet",
            'recipient_phone_number' => "06201234567",
            "status" => AssignmentStatus::InProgress->value,
        ]);
        $response->assertRedirect(route('assignment.show', $assignment));
        $this->assertDatabaseHas('assignments', [
            "start_address" => "1074, Budapest Vörösmarty utca 2.",
            "delivery_address" => "2013, Pomáz, Huszár utca 32.",
            'recipient_name' => "Vargané Erzsébet",
            'recipient_phone_number' => "06201234567",
            "status" => AssignmentStatus::InProgress->value,
        ]);
    }

    public function test_assignment_deletion(): void
    {
        $admin = User::factory()->create(['role' => UserRole::Admin]);
        $driver = User::factory()->create(['role' => UserRole::Driver]);
        $assignment = $driver->assignments()->create([
            "start_address" => "1074, Budapest Vörösmarty utca 2.",
            "delivery_address" => "2013, Pomáz, Huszár utca 32.",
            "recipient_name" => "Varga Lajos",
            "recipient_phone_number" => "+36 30 221 2415",
            "status" => AssignmentStatus::Assigned->value,
        ]);

        $response = $this->actingAs($admin)->delete(route('assignment.destroy', $assignment));

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseMissing('assignments', [
            'id' => $assignment->id,
        ]);
    }

    public function test_status_change(): void
    {
        $driver = User::factory()->create(['role' => UserRole::Driver]);
        $assignment = $driver->assignments()->create([
            "start_address" => "1074, Budapest Vörösmarty utca 2.",
            "delivery_address" => "2013, Pomáz, Huszár utca 32.",
            "recipient_name" => "Varga Lajos",
            "recipient_phone_number" => "+36 30 221 2415",
            "status" => AssignmentStatus::Assigned->value,
        ]);

        $response = $this->actingAs($driver)->put(route('assignment.update', $assignment), [
            "status" => AssignmentStatus::InProgress->value,
        ]);
        $response->assertRedirect(route('assignment.show', $assignment));
        $this->assertDatabaseHas('assignments', [
            "start_address" => "1074, Budapest Vörösmarty utca 2.",
            "delivery_address" => "2013, Pomáz, Huszár utca 32.",
            "recipient_name" => "Varga Lajos",
            "recipient_phone_number" => "+36 30 221 2415",
            "status" => AssignmentStatus::InProgress->value,
        ]);
    }
}
