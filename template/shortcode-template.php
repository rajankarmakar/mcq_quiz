<h2>MCQ Quiz system</h2>
<?php if ( empty( $data ) ) { ?>

<p> No quiz found </p>

<?php } else { ?>
<form>
    <?php foreach( $data as $quiz ): ?>

        <h6> <?php print_r( $quiz ); ?> </h6>

        

    <?php endforeach; ?>

    <?php }; ?>

    <input type="s_result" id="s_result">
</form>