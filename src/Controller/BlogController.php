<?php


namespace App\Controller;

use App\Model\AbstractManager;
use App\Model\BlogManager;

class BlogController extends AbstractController
{
    public function index(): string
    {
        $blogManager = new BlogManager();
        $blog = $blogManager->selectAll('title');

        return $this->twig->render('Blog/index.html.twig', ['blog' => $blog]);
    }

    public function add(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $blog = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $blogManager = new BlogManager();
            $id = $blogManager->insert($blog);
            header('Location:/Blog/index/' . $id);
        }

        return $this->twig->render('Blog/add.html.twig');
    }


    public function show(int $id): string
    {
        $blogManager = new BlogManager();
        $blog = $blogManager->selectOneById($id);

        return $this->twig->render('Blog/show.html.twig', ['blog' => $blog]);
    }


    public function edit(int $id): string
    {
        $blogManager = new BlogManager();
        $blog = $blogManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $blog = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $blogManager->update($blog);
            header('Location: /Blog/show/' . $id);
        }

        return $this->twig->render('Blog/edit.html.twig', [
            'blog' => $blog,
        ]);
    }

    public function delete(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $blogManager = new BlogManager();
            $blogManager->delete($id);
            header('Location:/blog/index');
        }
    }
}