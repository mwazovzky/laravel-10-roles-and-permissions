<?php

namespace Tests\Unit;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        $permissions = Permission::factory()
            ->count(3)
            ->sequence(
                ['name' => 'app.client.view'],
                ['name' => 'app.client.create'],
                ['name' => 'app.client.update'],
            )
            ->create();

        $role = Role::factory()
            ->hasAttached($permissions)
            ->create(['name' => 'app.manager']);

        $this->user = User::factory()
            ->for($role)
            ->create();
    }

    public function testHasPermission(): void
    {
        $this->assertTrue($this->user->hasPermission('app.client.view'));
        $this->assertFalse($this->user->hasPermission('app.client.delete'));
    }

    public function testHasPermissionAny(): void
    {
        $this->assertTrue($this->user->hasPermissionAny(['app.client.view', 'company.client.view']));
        $this->assertFalse($this->user->hasPermissionAny(['app.client.delete', 'company.client.view']));
    }

    public function testHasPermissionAll(): void
    {
        $this->assertTrue($this->user->hasPermissionAll(['app.client.view', 'app.client.create']));
        $this->assertFalse($this->user->hasPermissionAll(['app.client.view', 'app.client.delete']));
    }
}
