<?php
// api/src/Serializer/UploadedFileDenormalizer.php

namespace App\Serializer;

use App\Entity\TeamMember;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class UploadedFileDenormalizer implements DenormalizerInterface
{
    public function denormalize($data, string $type, string $format = null, array $context = []): TeamMember
    {
        return $data;
    }

    public function supportsDenormalization($data, string $type, ?string $format = null, array $context = []): bool
    {
        return $data instanceof TeamMember;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [TeamMember::class => true];
    }

}