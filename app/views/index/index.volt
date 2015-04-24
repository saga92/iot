<h1>Congratulations!</h1>

<p>You're now flying with Phalcon. Great things are about to happen!</p>

<h3>register</h3>

<form action="/index/register" method='POST'>
<input type='text' name='username' value='username'/><br/>
<input type='text' name='passwd' value='password'/><br/>
<input type='text' name='type' value='1'/><br/>
<input type='submit' name='register' value='register'/>
</form>

<br/><br/>

<h3>login</h3>

<form action="/index/login" method='POST'>
<input type='text' name='username' value='username'/><br/>
<input type='text' name='passwd' value='password'/><br/>
<input type='submit' name='login' value='login'/>
</form>

<br/><br/>

<h3>add resource</h3>

<form action="/index/input" method='POST'>
<input type='text' name='host_name' value='host_name'/><br/>
<input type='text' name='detail' value='detail'/><br/>
<input type='text' name='price' value='10.6'/><br/>
<input type='submit' name='add' value='add'/>
</form>
{{inputStatus}}

<h3>delete resource</h3>
<form action="/admin/delres" method='POST'>
<input type='text' name='res_id' value='1'/><br/>
<input type='submit' value='delete'/>
</form>
{{delresStatus}}

<br/><br/>
<h3>list resource</h3>
<a href="/index/list">table</a>
{{res}}
<table border="1">
    <tr>
        <th>id</th>
        <th>host_name</th>
        <th>detail</th>
        <th>price</th>
    </tr>
    {%for r in res%}
    <tr>
        <td>{{r.id}}</td>
        <td>{{r.host_name}}</td>
        <td>{{r.detail}}</td>
        <td>{{r.price}}</td>
    </tr>
    {%endfor%}
</table>

<br/><br/>
<h3>change password</h3>
<form action="/index/changepwd" method='POST'>
<input type='text' name='npwd' value='npwd'/>{{changePwdStatus}}<br/>
<input type='submit' value='change pwd'/>
</form>
