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

{% block content %}
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <ul class="nav nav-sidebar">
        <li><a href="/index/list">Overview</a></li>
        <li><a href="/admin/add">Add Resource</a></li>
        <li><a href="/admin/delres">Delete Resource</a></li>
        <li><a href="/admin/report">Reports</a></li>
        <li><a href="/admin/analyze">Analytics</a></li>
      </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h2 class="sub-header">What is the cloud os platform?</h2>
      <div><strong style="font-size:25px">A:</strong> Buy the resource in the cloud. It's a total light weight solution for your company.</div>
    </div>
  </div>
</div>
{% endblock %}
