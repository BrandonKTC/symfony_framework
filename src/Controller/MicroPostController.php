<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Form\CommentType;
use App\Form\MicroPostType;
use App\Repository\CommentRepository;
use App\Repository\MicroPostRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
            'posts' => $posts->findAllWithComments(),
        ]);

    }

    #[Route('/micro-post/{post}', name: 'app_micro_post_show')]
    public function showOne(MicroPost $post): Response {
        // dd($post);
        return $this->render('micro_post/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/micro-post/add', name: 'app_micro_post_add', priority: 2)]
    public function add(Request $request, MicroPostRepository $posts): Response {
        $form = $this->createForm(MicroPostType::class, new MicroPost());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $post->setCreated(new DateTime());
            $posts->add($post, true);
            // Add a flash
            $this->addFlash('success', 'Your micro post have been added');
            // Redirect
            return $this->redirectToRoute('app_micro_post');
        }

        return $this->render('micro_post/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/micro-post/{post}/edit', name: 'app_micro_post_edit')]
    public function edit(MicroPost $post, Request $request, MicroPostRepository $posts): Response {

        $form = $this->createForm(MicroPostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $posts->add($post, true);
            // Add a flash
            $this->addFlash('success', 'Your micro post have been updated');
            // Redirect
            return $this->redirectToRoute('app_micro_post');
        }

        return $this->render('micro_post/edit.html.twig', [
            'form' => $form,
            'post' => $post
        ]);
    }

    #[Route('/micro-post/{post}/comment', name: 'app_micro_post_comment')]
    public function addComment(MicroPost $post, Request $request, CommentRepository $comments): Response {

        $form = $this->createForm(CommentType::class, new Comment());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setPost($post);
            $comments->add($comment, true);

            // Add a flash
            $this->addFlash('success', 'Your comment have been added');
            // Redirect
            return $this->redirectToRoute('app_micro_post_show', [
                'post' => $post->getId()
            ]);
        }

        return $this->render('micro_post/comment.html.twig', [
            'form' => $form,
            'post' => $post
        ]);
    }
}
