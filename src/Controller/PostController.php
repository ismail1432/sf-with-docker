<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function index(EntityManagerInterface $manager)
    {
        $post = new Post();

        $post->setcontent("My new content")
            ->setTitle("My new title");

        $manager->persist($post);
        $manager->flush();

        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }
}
