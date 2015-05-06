{% extends "layouts/layouts.volt" %}

{% block navbar %}
<div id="navbar" class="navbar-collapse collapse">
  <ul class="nav navbar-nav navbar-right">
    <li><a href="/index/login">login in</a></li>
  </ul>
</div>
{% endblock %}

{% block link %}
<!-- Bootstrap core CSS -->
<link href="/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="/css/dashboard.css" rel="stylesheet">
<link href="/css/my.css" rel="stylesheet">
{% endblock %}

{% block script %}
<script src="/js/jquery.min.js"></script>
<script src="/js/holder.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/my.js"></script>
{% endblock %}

{% block content %}
<div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="/img/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" id="chpwdform">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="password" id="fpwd" class="form-control" placeholder="new password" required autofocus value=""/>
                <input name="password" id="spwd" type="password" id="inputPassword" class="form-control" placeholder="new password again" required value=""/>
                <input name="type" type="hidden" id='inputType' value='0'/>
            </form><!-- /form -->
            <button id="confi" class="btn btn-lg btn-primary btn-block btn-signin">Confirm</button>
            <a href="#" class="forgot-password" id="chpwdstatus">
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
{% endblock %}

