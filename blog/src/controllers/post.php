<?php

require_once('src/model.php');
require_once('src/model/comment.php');

function post(string $identifier)
{
    $post = getPost($identifier);
    $comments = getComments($identifier);

    require('templates/post.php');
}
