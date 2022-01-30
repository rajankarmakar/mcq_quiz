<h2>MCQ Quiz system</h2>
<form id="mcq_form">
<?php
if ( is_array( $data ) ) {
    echo '<div>';
    foreach ( $data as $key => $item ) {
        echo "<p>{$item['title']}</p>";
        foreach ( $item['choices'] as $list ) {
            echo "<input type='radio' name='ans[{$key}]' value='{$list}' > {$list} \n";
        }
        echo "<input type='hidden' id='answer-{$key}' value='{$item['answer']}' />";
        echo '<br /> <br />';
    }
    echo '</div>';

} else {
    echo '<p>No post found</p>';
}
?>
<input type="submit" id="submit_result" value="Show Result" />
</form>
<div id="result_container"></div>