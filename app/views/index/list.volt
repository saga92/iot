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
    {%for r in res%}
    <tr>
        <td>{{r.id}}</td>
        <td>{{r.host_name}}</td>
        <td>{{r.detail}}</td>
        <td>{{r.price}}</td>
        <td>{{r.is_del}}</td>
    </tr>
    {%endfor%}
</table>
