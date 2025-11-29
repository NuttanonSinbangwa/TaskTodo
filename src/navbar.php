<style>
    html,
    body {
        width: 100%;
        overflow-x: hidden;
    }


    .top-nav {
        position: fixed;
        top: 0;
        right: 0;
        display: flex;
        gap: 20px;
        padding: 12px 40px;
        background: #fff;
    }

    .top-nav a {
        margin-left: 20px;
        text-decoration: none;
        color: #333;
        font-size: 15px;
        font-weight: 500;
        transition: 0.2s;
    }

    .top-nav a:hover {
        color: #4CAF50;
    }

    @media(max-width: 600px) {
        .top-nav {
            justify-content: space-around;
            padding-right: 20px;
            /* ลดให้เหมาะกับมือถือ */
        }

        .top-nav a {
            margin-left: 0;
        }
    }
</style>

<div class="top-nav">
    <a href="index.php">HOME</a>
    <a href="todos.php">OVERVIEW</a>
    <a href="#">HOW TO</a>
    <a href="logout.php">LOG OUT</a>
</div>