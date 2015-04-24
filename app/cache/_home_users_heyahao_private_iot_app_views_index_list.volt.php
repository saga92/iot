<br/><br/>
<h3>list resource</h3>
<a href="/index/list">table</a>
<table border="1">
    <tr>
        <th>id</th>
        <th>host_name</th>
        <th>detail</th>
        <th>price</th>
        <th>is_del</th>
    </tr>
    <?php foreach ($res as $r) { ?>
    <tr>
        <td><?php echo $r->id; ?></td>
        <td><?php echo $r->host_name; ?></td>
        <td><?php echo $r->detail; ?></td>
        <td><?php echo $r->price; ?></td>
        <td><?php echo $r->is_del; ?></td>
    </tr>
    <?php } ?>
</table>
