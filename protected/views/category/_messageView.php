<div class="category_message">
    <div class="category_messsage_left">
        <div class="category_message_title"><?php echo $model->title; ?></div>
        <div class="category_message_url"><?php echo $model->url; ?></div>
    </div>
    <div class="category_message_right">
        <div class="category_message_date"><?php echo $model->getDate();?></div>
        <div class="category_message_controls">
            <a href="/mobile/ithrive/index.php/message/update/<?php echo $model->id; ?>" title="Update" class="update">
                    <img alt="Update" src="/mobile/ithrive/assets/b111dc47/gridview/update.png">
                </a>
                <a href="/mobile/ithrive/index.php/message/delete/<?php echo $model->id; ?>" title="Delete" class="delete">
                    <img alt="Delete" src="/mobile/ithrive/assets/b111dc47/gridview/delete.png">
                </a>
        </div>
    </div>
    <div class="clear"></div>
</div>
