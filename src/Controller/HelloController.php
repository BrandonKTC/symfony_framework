<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Repository\CommentRepository;
use App\Repository\MicroPostRepository;
use App\Repository\UserProfileRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController

{
    private array $messages = [
        ["message" => "Hello", "created" => "2023/12/12"],
        ["message" => "Hi", "created" => "2023/10/12"],
        ["message" => "Bye!", "created" => "2022/05/12"],
    ];

    #[Route('/{limit<\d+>?3}', name: 'app_index')]
    public function index(MicroPostRepository $posts, CommentRepository $comments ,  $limit): Response {

        // $user = new User();
        // $user->setEmail("email@email.com");
        // $user->setPassword("password");

        // $profile = new UserProfile();
        // $profile->setUser($user);
        // $profiles->add($profile, true);

        // $profile = $profiles->find(1);
        // $profiles->remove($profile, true);

        // $post = $posts->find(10);
        // $comment = $post->getComments()[0];

        // $post->removeComment($comment);
        // $posts->add($post, true);

        // $post->setTitle('Hello');
        // $post->setText('Hello');
        // $post->setCreated(new DateTime());

        // $comment = new Comment();
        // $comment->setText('Hello');
        // $comment->setPost($post);
        // // $post->addComment($comment);
        // // $posts->add($post, true);
        // $comments->add($comment, true);



        return $this->render('hello/index.html.twig', [
            'messages' => $this->messages,
            'limit' => $limit
        ]);
        // return new Response(implode(',', array_slice($this->messages, 0, $limit)));
    }

    #[Route('/messages/{id<\d+>}', name: 'app_show_one')]
    public function showOne($id): Response {
        return $this->render('hello/show_one.html.twig',
    [
        'message' => $this->messages[$id]
    ]);
        // return new Response($this->messages[$id]);
    }
}