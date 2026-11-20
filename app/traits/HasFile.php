<?php

namespace App\traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

trait HasFile
{
        abstract protected function fileColumn(): string;

    protected static function bootFileHandling()
    {
        static::deleting(function ($model) {
            $column = $model->fileColumn();
            $filePath = $model->{$column};

            if ($filePath && Storage::disk('local')->exists($filePath)) {
                Storage::disk('local')->delete($filePath);
            }
        });
    }

    public function getFileUrl(): ?string{
        $column = $this->fileColumn();
        $value = $this->{$column};

        if (! $value) {
            return null;
        }

        if (Str::startsWith($value, ['http://', 'https://'])) {
            return $value;
        }

        // return Storage::disk('local')->url($value);
        return url("{$value}");
    }

    public function setFile(
        UploadedFile $uploadedFile,
        string $path,
        bool $hasName  = false,
        string $disk = 'local',
    ) {
        $column = $this->fileColumn();
        if ($this->{$column}) {
            Storage::disk('local')->delete($this->{$column});
        }

        $originalName = $uploadedFile->getClientOriginalName();

        // Prevent overwriting an existing file in the same folder/version.
        // This typically means the file is already part of another media resource,
        // and creating a duplicate here would be redundant or conflict with version control.
        if ($hasName) {
            $fullPath = $path . '/' . $originalName;
            if (Storage::disk($disk)->exists($fullPath)) {
                abort(Response::HTTP_BAD_REQUEST, "A file named '{$originalName}' already exists in this folder.");
            }

            $storedPath = $uploadedFile->storeAs($path, $originalName, $disk);
        } else {
            $storedPath = $uploadedFile->store($path, $disk);
        }

        $this->update([$column => $storedPath]);
        return true;
    }

}
