<?php
// api/src/Encoder/MultipartDecoder.php

namespace App\Encoder;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\Encoder\DecoderInterface;

final class MultipartDecoder implements DecoderInterface
{
    public const FORMAT = 'multipart';

    public function __construct(private RequestStack $requestStack)
    {
    }

    public function decode(string $data = "", string $format, array $context = []): ?array
    {
        $request = $this->requestStack->getCurrentRequest();
    
        if (!$request) {
            return null;
        }
    
        return array_map(static function ($element) {
            // Check if the element is a string before decoding
            if (is_string($element)) {
                // Multipart form values will be encoded in JSON.
                $decoded = json_decode($element, true);
    
                // Return the decoded value if it's an array, otherwise return the original string
                return is_array($decoded) ? $decoded : $element;
            } else {
                // If the element is not a string, return it as is
                return $element;
            }
        }, $request->request->all()) + $request->files->all();
    }
    

    public function supportsDecoding(string $format): bool
    {
        return self::FORMAT === $format;
    }
}