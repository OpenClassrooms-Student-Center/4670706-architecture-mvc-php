<?php

class Post
{
    public string $title;
    public string $frenchCreationDate;
    public string $content;
    public string $identifier;
}

function getPosts(): array {
    $database = dbConnect();
    $statement = $database->query(
        "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5"
    );
    $posts = [];
    while (($row = $statement->fetch())) {
        $post = new Post();
        $post->title = $row['title'];
        $post->frenchCreationDate = $row['french_creation_date'];
        $post->content = $row['content'];
        $post->identifier = $row['id'];

        $posts[] = $post;
    }

    return $posts;
}

function getPost(string $identifier): Post {
    $database = dbConnect();
    $statement = $database->prepare(
        "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts WHERE id = ?"
    );
    $statement->execute([$identifier]);

    $row = $statement->fetch();
    $post = new Post();
    $post->title = $row['title'];
    $post->frenchCreationDate = $row['french_creation_date'];
    $post->content = $row['content'];
    $post->identifier = $row['id'];

    return $post;
}

function dbConnect()
{
    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'blog', 'password');

    return $database;
}
