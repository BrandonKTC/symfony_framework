<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MicroPostController extends AbstractController
{
    #[Route('/micro-post', name: 'app_micro_post')]
    public function index(MicroPostRepository $posts): Response
    {   
        # CREATE
        // $microPost1 = new MicroPost(); 
        // $microPost1->setTitle('It comes from controller'); 
        // $microPost1->setText('Hi!'); 
        // $microPost1->setCreated(new DateTime()); 
        # UPDATE
        // $microPost = $posts->findOneBy(['title' => "It comes from controller	"]);   
        // $microPost->setText('Just trying the update function'); 
        # REMOVE
        // $microPost = $posts->findOneBy(['title' => "It comes from controller"]); 
        // $posts->remove($microPost, true); 

        // dd($posts->findAll());
        return $this->render('micro_post/index.html.twig', [
            'posts' => $posts->findAll(),
        ]);

    }

    #[Route('/micro-post/{post}', name: 'app_micro_post_show')]
    public function showOne(MicroPost $post): Response {
        // dd($post);
        return $this->render('micro_post/show.html.twig', [
            'post' => $post,
        ]);
    }
}
