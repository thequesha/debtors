<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Filters\HasFilter;
use App\Notifications\RussianVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;
use RuntimeException;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, InteractsWithMedia, SoftDeletes, HasFilter;
    
    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new RussianVerifyEmail);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'middle_name',
        'surname',
        'username', // Keeping for backward compatibility but making it nullable
        'email',
        'store_id',
        'phone', // Primary authentication identifier
        'password',
        'birth_date'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('users')
            ->useDisk('users')
            ->singleFile();
    }

    /**
     * Set the user's birth date.
     *
     * @param  string  $value
     * @return void
     */
    public function setBirthDateAttribute($value)
    {
        if ($value) {
            $this->attributes['birth_date'] = date('Y-m-d', strtotime($value));
        }
    }

    /**
     * Add an image to the user's media collection.
     * 
     * @param string|UploadedFile $image Image data (base64 string or uploaded file)
     * @return void
     * @throws RuntimeException
     */
    public function addImage($image): void
    {
        if (is_string($image) && str_starts_with($image, 'data:image')) {
            // Extract MIME type and base64 data
            if (!preg_match('/^data:image\/(jpeg|png);base64,/', $image, $matches)) {
                throw new RuntimeException('Invalid image format. Only JPEG and PNG are supported.');
            }

            $extension = $matches[1];
            if ($extension === 'jpeg') {
                $extension = 'jpg';
            }

            // Generate filename
            $filename = Str::random(10) . '.' . $extension;

            try {
                // Extract and validate base64 data
                $base64_data = substr($image, strpos($image, ',') + 1);
                $image_data = base64_decode($base64_data, true);

                if ($image_data === false) {
                    throw new RuntimeException('Invalid base64 data');
                }

                // Create a temporary file in storage
                Storage::disk('local')->put('temp/' . $filename, $image_data);
                $temp_path = storage_path('app/temp/' . $filename);

                // Add to media collection
                $this->addMedia($temp_path)
                    ->usingName(pathinfo($filename, PATHINFO_FILENAME))
                    ->usingFileName($filename)
                    ->toMediaCollection('users');

                // Clean up
                Storage::disk('local')->delete('temp/' . $filename);
            } catch (\Exception $e) {
                // Clean up on error
                Storage::disk('local')->delete('temp/' . $filename);
                throw new RuntimeException('Ошибка при загрузке изображения: ' . $e->getMessage());
            }
        } elseif ($image instanceof UploadedFile) {
            // Handle uploaded file
            if (!in_array($image->getClientMimeType(), ['image/jpeg', 'image/png'])) {
                throw new RuntimeException('Формат изображения должен быть JPEG или PNG.');
            }

            $extension = $image->getClientOriginalExtension();
            if (strtolower($extension) === 'jpeg') {
                $extension = 'jpg';
            }

            $filename = Str::random(10) . '.' . $extension;

            $this->addMedia($image)
                ->usingName(pathinfo($filename, PATHINFO_FILENAME))
                ->usingFileName($filename)
                ->toMediaCollection('users');
        } else {
            throw new RuntimeException('Формат изображения должен быть JPEG или PNG.');
        }
    }
}
