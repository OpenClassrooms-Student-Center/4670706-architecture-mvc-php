<?php

require_once('src/model/post.php');

function homepage()
{
    $posts = getPosts();

    require('templates/homepage.php');
}
