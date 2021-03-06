{% extends "layouts/layouts.volt" %}

{% block link %}
<!-- Bootstrap core CSS -->
<link href="/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="/css/dashboard.css" rel="stylesheet">
{% endblock %}

{% block script %}
<script src="/js/jquery.min.js"></script>
<script src="/js/holder.js"></script>
<script src="/js/bootstrap.min.js"></script>
{% endblock %}

{% block brand %}
<a class="navbar-brand" href="/index/listnormal">IOT --- cloud os platform</a>
{% endblock%}

{% block content %}
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <ul class="nav nav-sidebar">
        <li><a href="/index/listnormal">Overview</a></li>
        <li><a href="/index/buynormal">Buy</a></li>
        <li class="active"><a href="/index/historynormal">History <span class="sr-only">(current)</span></a></li>
      </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h2 class="sub-header">My Buy History</h2>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>resource id</th>
              <th>host name</th>
              <th>detail</th>
              <th>price</th>
              <th>month</th>
              <th>util time</th>
              <th>action</th>
            </tr>
          </thead>
          <tbody>
            {%for r in res%}
            <tr>
              <td>{{r.rid}}</td>
              <td>{{r.hname}}</td>
              <td>{{r.rdetail}}</td>
              <td>{{r.price}}</td>
              <td>{{r.mu}}</td>
              <td>{{r.utime}}</td>
              <td><a href="/index/start">start</a></td>
            </tr>
            {%endfor%}
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
{% endblock %}
