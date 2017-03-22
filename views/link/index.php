<?php
use yii\helpers\Html;
?>
<table class="table table-striped table-hover">
    <tr>
        <td>#</td>
        <td>remote address</td>
        <td>user agent</td>
        <td>date</td>
    </tr>
    <?php foreach ($data as $log): ?>
        <tr>
            <td>
                <?php echo $log->id; ?>
            </td>
            <td>
                <?php echo $log->remote_addr; ?>
            </td>
            <td>
                <?php echo $log->user_agent; ?>
            </td>
            <td>
                <?php echo $log->date; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
