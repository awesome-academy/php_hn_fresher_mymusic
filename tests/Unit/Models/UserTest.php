<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class UserTest extends TestCase
{
    const ROLE_ADMIN = 1;
    const ROLE_USER = 0;
    const USER_UNACTIVE = 0;
    const USER_ACTIVE = 1;

    protected $user;

    /**
     * This method is called before each test.
     */
    public function setup(): void
    {
        parent::setUp();
        $this->user = new User();
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        unset($this->user);
        parent::tearDown();
    }

    /**
     * This method test primary key
     */
    public function testPrimaryKey()
    {
        $this->assertEquals('id', $this->user->getKeyName());
    }

    /**
     * This method test $fillable property
     */
    public function testValidFillableProperty()
    {
        $fillable = [
            'first_name',
            'last_name',
            'email',
            'avatar',
            'password',
            'provider',
            'provider_id'
        ];

        $this->assertEquals($fillable, $this->user->getFillable());
    }

    /**
     * This method test $hidden property
     */
    public function testValidHiddenProperty()
    {
        $hidden = [
            'password',
            'remember_token',
        ];

        $this->assertEquals($hidden, $this->user->getHidden());
    }

    /**
     * This method test $casts property
     */
    public function testValidCastsProperty()
    {
        $casts = [
            'email_verified_at' => 'datetime',
            'id' => 'int'
        ];

        $this->assertEquals($casts, $this->user->getCasts());
    }

    /**
     * This method test $appends property
     */
    public function testValidAppendsProperty()
    {
        $appends = [
            'avatar_full_path',
            'full_name',
            'role_description',
            'active_description',
        ];

        $this->assertEquals($appends, $this->user->appends);
    }

    /**
     * This method test method getAvatarFullPathAttribute
     */
    public function testGetAvatarFullPathAttribute()
    {
        $this->user->setRawAttributes([
            'avatar' => 'asset/image/png',
        ]);

        $expected = env('APP_URL') . '/asset/image/png';

        $this->assertEquals($expected, $this->user->getAttributeValue('avatar_full_path'));
    }

    /**
     * This method test method getFullNameAttribute
     */
    public function testGetFullNameAttribute()
    {
        $this->user->setRawAttributes([
            'first_name' => 'Unit',
            'last_name' => 'Test',
        ]);

        $this->assertEquals('Unit Test', $this->user->getAttributeValue('full_name'));
    }

    /**
     * This method test method isAdmin return true
     */
    public function testRoleIsAdmin()
    {
        $this->user->setRawAttributes([
            'role' => static::ROLE_ADMIN,
        ]);

        $this->assertTrue($this->user->isAdmin());
    }

    /**
     * This method test method isAdmin return false
     */
    public function testRoleIsUser()
    {
        $this->user->setRawAttributes([
            'role' => static::ROLE_USER,
        ]);

        $this->assertFalse($this->user->isAdmin());
    }

    /**
     * This method test method getRoleDescriptionAttribute of admin
     */
    public function testAdminRoleDescriptionAttribute()
    {
        $admin = __('common.role.' . static::ROLE_ADMIN);

        $this->user->setRawAttributes([
            'role' => static::ROLE_ADMIN,
        ]);

        $this->assertEquals($admin, $this->user->getRoleDescriptionAttribute());
    }

    /**
     * This method test method getRoleDescriptionAttribute of user
     */
    public function testUserRoleDescriptionAttribute()
    {
        $user = __('common.role.' . static::ROLE_USER);

        $this->user->setRawAttributes([
            'role' => static::ROLE_USER,
        ]);

        $this->assertEquals($user, $this->user->getRoleDescriptionAttribute());
    }

    /**
     * This method test method getActiveDescriptionAttribute return active
     */
    public function testActiveDescriptionAttribute()
    {
        $admin = __('common.active.' . static::USER_ACTIVE);

        $this->user->setRawAttributes([
            'active' => static::USER_ACTIVE,
        ]);

        $this->assertEquals($admin, $this->user->getActiveDescriptionAttribute());
    }

    /**
     * This method test method getActiveDescriptionAttribute return unactive
     */
    public function testUnactiveDescriptionAttribute()
    {
        $admin = __('common.active.' . static::USER_UNACTIVE);

        $this->user->setRawAttributes([
            'active' => static::USER_UNACTIVE,
        ]);

        $this->assertEquals($admin, $this->user->getActiveDescriptionAttribute());
    }

    /**
     * This method test CREATED_AT attribute
     */
    public function testCreatedAtAtrribute()
    {
        $this->user->setRawAttributes([
            'created_at' => '2022-03-25 09:06:12',
        ]);

        $this->assertEquals('25/03/2022 09:06', $this->user->getAttributeValue('created_at'));
    }

    /**
     * This method test UPDATED_AT attribute
     */
    public function testUpdatedAtAtrribute()
    {
        $this->user->setRawAttributes([
            'updated_at' => '2022-03-25 09:06:12',
        ]);

        $this->assertEquals('25/03/2022 09:06', $this->user->getAttributeValue('updated_at'));
    }

    /**
     * This method test relationship of comments
     */
    public function testCommentsRelation()
    {
        $relation = $this->user->comments();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }

    /**
     * This method test relationship of playlists
     */
    public function testPlaylistsRelation()
    {
        $relation = $this->user->playlists();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }

    /**
     * Test case test user account status is active
     */
    public function testActiveStatus()
    {
        $this->user->setRawAttributes([
            'active' => static::USER_ACTIVE,
        ]);

        $result = $this->user->isActive();

        $this->assertTrue($result);
    }

    /**
     * Test case test user account status is unactive (blocked)
     */
    public function testBlockedStatus()
    {
        $this->user->setRawAttributes([
            'active' => static::USER_UNACTIVE,
        ]);

        $result = $this->user->isActive();

        $this->assertFalse($result);
    }

    /**
     * Test case test scopedAdmin return exact query builder
     */
    public function testScopeAdmin()
    {
        $sql = $this->user->admin()->toSql();
        $needed = 'where `role` = ?';

        $this->assertStringContainsString($needed, $sql);
    }

    /**
     * Test case test scopeActive return exact query builder
     */
    public function testScopeActive()
    {
        $sql = $this->user->active()->toSql();
        $needed = 'where `active` = ?';

        $this->assertStringContainsString($needed, $sql);
    }
}
