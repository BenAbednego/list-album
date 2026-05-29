<?php

use App\Models\User;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

test('guest can access landing page', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertSee('Photo Album')
        ->assertSee('Sign In')
        ->assertSee('Sign Up');
});

test('guest is redirected from dashboard to login', function () {
    $this->get('/dashboard')
        ->assertRedirect('/login');
});

test('user can register without name', function () {
    $response = $this->post('/register', [
        'email' => 'test@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123'
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    
    $user = User::where('email', 'test@example.com')->first();
    expect($user->name)->toBe('Test');
});

test('user can login', function () {
    $user = User::factory()->create([
        'email' => 'john@example.com',
        'password' => bcrypt('password123')
    ]);

    $response = $this->post('/login', [
        'email' => 'john@example.com',
        'password' => 'password123'
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertAuthenticatedAs($user);
});

test('logged in user can create an album', function () {
    $user = User::factory()->create();
    
    $response = $this->actingAs($user)
        ->post('/albums', ['name' => 'Trip to Bali']);

    $this->assertDatabaseHas('albums', [
        'user_id' => $user->id,
        'name' => 'Trip to Bali'
    ]);
});

test('user cannot view other users albums', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    
    $albumOfUser2 = Album::create([
        'user_id' => $user2->id,
        'name' => 'Private Album User 2'
    ]);

    $response = $this->actingAs($user1)
        ->get('/dashboard?album_id=' . $albumOfUser2->id);

    $response->assertStatus(200);
    $activeAlbum = $response->viewData('activeAlbum');
    expect($activeAlbum)->toBeNull();
});

test('user can upload and manage photos in their album', function () {
    $user = User::factory()->create();
    $album = Album::create([
        'user_id' => $user->id,
        'name' => 'My Album'
    ]);

    $file = UploadedFile::fake()->image('photo1.jpg');

    $response = $this->actingAs($user)
        ->post('/photos', [
            'album_id' => $album->id,
            'title' => 'Scenic Beach',
            'date' => '2026-05-29',
            'description' => 'A beautiful sunset at the beach.',
            'photo' => $file
        ]);

    $response->assertRedirect('/dashboard?album_id=' . $album->id);
    
    $this->assertDatabaseHas('photos', [
        'album_id' => $album->id,
        'title' => 'Scenic Beach',
        'date' => '2026-05-29'
    ]);

    $photo = Photo::first();
    $filePath = public_path($photo->image_path);
    expect(File::exists($filePath))->toBeTrue();

    // Clean up uploaded file
    File::delete($filePath);
});

test('user can view show and edit photo pages', function () {
    $user = User::factory()->create();
    $album = Album::create([
        'user_id' => $user->id,
        'name' => 'My Album'
    ]);
    $photo = $album->photos()->create([
        'title' => 'Scenic Beach',
        'date' => '2026-05-29',
        'description' => 'Beach sunset',
        'image_path' => 'uploads/test.jpg'
    ]);

    $this->actingAs($user)
        ->get('/photos/' . $photo->id)
        ->assertStatus(200)
        ->assertSee('Scenic Beach');

    $this->actingAs($user)
        ->get('/photos/' . $photo->id . '/edit')
        ->assertStatus(200)
        ->assertSee('Edit Title')
        ->assertSee('Scenic Beach');
});
