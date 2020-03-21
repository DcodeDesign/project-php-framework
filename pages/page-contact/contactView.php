<article>
    <header>
        <h1 class="titreBillet"> <?php echo $titre ?></h1>
    </header>
    <p><?php
        foreach($contenu as $key => $items){
            foreach($items as $key => $item){
                echo $item . " ";
            }
            echo "<br/> ";
        }

        ?></p>
</article>

