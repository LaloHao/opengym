<header>
    <div class="header-logo-container">
        <img src="logo-only.png" alt="OpenGym" class="header-logo">
        <span class="header-title">OpenGym</span>
    </div>
    <div class="navigation">
        <?php 
            foreach (NavItems as $key => $value) {
                $classes = '';
                if ($current_item == $key) {
                    $classes = ' class="selected" ';
                }
                echo '<a href="' . $key . '.php"' . $classes .'>';
                echo $value;
                echo '</a>';
            }
        ?>
    </div>
</header>