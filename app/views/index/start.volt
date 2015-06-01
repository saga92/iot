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
    <img src="/img/fakestart.jpg" style="height:100%; width:100%"/>
</div>
{% endblock %}
