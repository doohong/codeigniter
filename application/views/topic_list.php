<ul>
<?php
foreach($topics as $entry){
?>
    <li>
    <a href="/index.php/topic/get/<?=$entry->id?>"><?=$entry->id?></a></li>
<?php
}
?>
</ul>