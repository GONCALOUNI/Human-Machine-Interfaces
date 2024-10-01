<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetinhosTalk Forum</title>
    <style>
        .bg-light
        {
            background-color: #f87538!important;
        }

        .navbar-nav .nav-link
        {
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar-nav .nav-link:hover
        {
            background-color: #f87538;
            color: #ffffff!important;
        }

        .welcome
        {
            color: #f87538;
        }

        body
        {
            background-image: url('images/pets.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container
        {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
    
        }

        .slogan
        {
            font-size: 16px;
            font-style: italic;
            color: #555555;
            margin-left: 10px;
            vertical-align: bottom;
        }
    
        .post
        {
            margin-bottom: 20px;
            border: 1px solid #aaaaaa;
            padding: 20px;
            border-radius: 8px;
        }
    
        .post-author
        {
            font-weight: bold;
            text-decoration: underline;
            color: #f87538;
        }
    
        .post-date
        {
            font-style: italic;
            color: #888888;
        }

        .post-update
        {
            font-style: italic;
            color: #888888;
        }
    
        .post-content
        {
            margin-top: 10px;
        }

        html
        {
            overflow-y: scroll;
        }
    </style>
</head>
<body>
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <img src="images/logo.png" alt="PetinhosTalk" style="height: 40px;">
        <span class="slogan">Where pets love... finds its place!</span>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                {$MENU_1}
            </li>
            {if isset($WELCOME)}
                <li class="nav-item">
                    {$MENU_2}
                </li>
            {/if}
            <li class="nav-item">
                {$MENU_3}
            </li>
            {if !isset($WELCOME)}
                <li class="nav-item">
                    {$MENU_4}
                </li>
            {/if}
        </ul>
        {if isset($WELCOME)}
            {$WELCOME}
        {/if}
    </div>
    </nav>
    <div class="container shadow">
        {foreach $microposts as $post}
            <div class="post">
                <div class="post-author bold-text">{$post.name}</div>
                <div class="post-date">Created at: {$post.created_at}</div>
                <div class="post-update">Updated at: {$post.updated_at}</div>
                <div class="post-content">{$post.content}</div>
                {if isset($_SESSION['id']) && $_SESSION['id'] == $post.user_id}
                    <div class="post-update">
                        <a href="blog.php?micropost_id={$post.id}">Update Blog</a>
                    </div>
                {/if}
            </div>
        {/foreach}
     </div>
</body>
</html>