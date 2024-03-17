<?php
// api/src/Controller/CreateBookPublication.php

namespace App\Controller;

use App\Entity\TeamMember;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
class ImageUploaderController extends AbstractController
{
 
   
    public function __invoke(Request $request): TeamMember
    {
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $mediaObject = new TeamMember();
        $mediaObject->setFile( $uploadedFile);

        return $mediaObject;
    }
}